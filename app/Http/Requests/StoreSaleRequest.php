<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'sellerId' => 'required|exists:sellers,id',
            'price' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sellerId.required' => json_encode([
                'code' => 'seller_required',
                'message' => 'Campo Vendedor é obrigatório'
            ]),
            'sellerId.exists' => json_encode([
                'code' => 'seller_not_founded',
                'message' => 'Vendedor não encontrado'
            ]),
            'price.required' => json_encode([
                'code' => 'price_required',
                'message' => 'Campo preço é obrigatório'
            ]),
            'price.numeric' => json_encode([
                'code' => 'price_not_number',
                'message' => 'Campo preço precisa ser um número'
            ]),
        ];
    }
}
