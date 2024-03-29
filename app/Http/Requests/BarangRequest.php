<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BarangRequest extends FormRequest
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
            'nama' => [$conditionalRule, 'string', 'max:255'],
            'kategori' => [$conditionalRule, 'string', 'max:255'],
            'harga' => [$conditionalRule, 'integer'],
        ];
    }
}
