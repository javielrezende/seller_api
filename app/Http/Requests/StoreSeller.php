<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeller extends FormRequest
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
            'name' => 'required|between:5,50',
            'email' => 'required|email:filter|unique:sellers,email',
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
            'name.required' => json_encode([
                'code' => 'name_required',
                'message' => 'Campo nome é obrigatório'
            ]),
            'name.between' => json_encode([
                'code' => 'name_size_wrong',
                'message' => 'Campo nome precisa ter entre 5 e 50 caracteres'
            ]),
            'email.required' => json_encode([
                'code' => 'email_required',
                'message' => 'Campo E-mail é obrigatório'
            ]),
            'email.email' => json_encode([
                'code' => 'email_invalid',
                'message' => 'Campo E-mail inválido'
            ]),
            'email.unique' => json_encode([
                'code' => 'email_must_be_unique',
                'message' => 'Campo E-mail precisa ser unico'
            ]),
        ];
    }
}
