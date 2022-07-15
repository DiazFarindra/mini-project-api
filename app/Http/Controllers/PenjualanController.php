<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Http\Resources\Collection\PenjualanCollection;
use App\Http\Resources\PenjualanResource;
use App\Models\Barang;
use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penjualan::get();

        return new PenjualanCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenjualanRequest $request)
    {
        $data = $request->validated();

        // take data from request barang array
        $barang = []; // array to store barang data
        $kode = []; // to store kode barang
        $qty = []; // to store qty barang
        foreach ($request->barang as $value) {
            $barang[] = [
                'kode_barang' => $value['kode_barang'],
                'qty' => $value['qty'],
            ];

            $kode[] = $value['kode_barang'];
            $qty[] = $value['qty'];
        }

        // subtotal for penjualan
        $subtotal = 0; // flag variable to store subtotal
        $subtotal = Barang::query()->whereIn('kode', $kode)->get()->map(function ($item) use ($qty, $subtotal) {
            collect($qty)->map(function ($qty) use ($item, $subtotal) {
                return $subtotal += $item->harga * $qty;
            });
        });
        $data['subtotal'] = $subtotal;

        DB::transaction(function () use ($data, $barang) {
            // insert penjualan data
            $commit = Penjualan::create([
                'tgl' => $data['tgl'],
                'kode_pelanggan' => $data['kode_pelanggan'],
                'subtotal' => $data['subtotal'],
            ]);

            // insert item penjualan data
            $result = data_fill($barang, '*.nota', $commit->id_nota);
            ItemPenjualan::create($result);
        });

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        return response()->json([
            'penjualan' => new PenjualanResource($penjualan),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(PenjualanRequest $request, Penjualan $penjualan)
    {
        $data = $request->validated();

        // take data from request barang array
        $barang = []; // array to store barang data
        $kode = []; // to store kode barang
        $qty = []; // to store qty barang
        foreach ($request->barang as $value) {
            $barang[] = [
                'kode_barang' => $value['kode_barang'],
                'qty' => $value['qty'],
            ];

            $kode[] = $value['kode_barang'];
            $qty[] = $value['qty'];
        }

        // subtotal for penjualan
        $subtotal = 0; // flag variable to store subtotal
        $subtotal = Barang::query()->whereIn('kode', $kode)->get()->map(function ($item) use ($qty, $subtotal) {
            collect($qty)->map(function ($qty) use ($item, $subtotal) {
                return $subtotal += $item->harga * $qty;
            });
        });
        $data['subtotal'] = $subtotal;

        DB::transaction(function () use ($data, $barang, $penjualan) {
            // insert penjualan data
            $commit = tap($penjualan)->update([
                'tgl' => $data['tgl'],
                'kode_pelanggan' => $data['kode_pelanggan'],
                'subtotal' => $data['subtotal'],
            ]);

            // insert item penjualan data
            ItemPenjualan::query()->where('nota', $penjualan->id_nota)->delete();
            $result = data_fill($barang, '*.nota', $penjualan->id_nota);
            ItemPenjualan::create($result);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
