<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_penjualan', function (Blueprint $table) {
            $table->id();

            $table->string('nota');
            $table->foreign('nota')
                ->references('id_nota')
                ->on('penjualan')
                ->cascadeOnDelete();

            $table->string('kode_barang');
            $table->foreign('kode_barang')
                ->references('kode')
                ->on('barang')
                ->cascadeOnDelete();

            $table->index(['nota', 'kode_barang']);
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_penjualan');
    }
};
