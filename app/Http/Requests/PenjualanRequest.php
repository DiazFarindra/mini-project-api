<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenjualanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $conditionalRule = Rule::when($this->isMethod('patch'), 'sometimes', 'required');

        return [
            'tgl' => [$conditionalRule, 'date', 'date_format:Y-m-d'],
            'kode_pelanggan' => [$conditionalRule, 'string', 'exists:pelanggan,id_pelanggan'],

            'barang' => [$conditionalRule, 'array', 'min:1'],
            'barang.*' => [$conditionalRule, 'in_array:kode_barang,qty'],
            'barang.*.kode_barang' => [$conditionalRule, 'string', 'exists:barang,kode'],
            'barang.*.qty' => [$conditionalRule, 'integer'],
        ];
    }
}
