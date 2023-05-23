<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class StoreClient extends FormRequest
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
            'name' => 'required|string',
            'dbo' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
        ];
    }


    public function messages()
    {
        return[
            'name.required' => 'Name is required',
            'dbo.required' => 'Dbo is required',
            'phone.required' => 'phone is required',
            'email.required' => 'email is required',
            'address.required' => 'address is required'
        ];    
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'fail',
                'data' => [
                    'errors' => $validator->errors(),
                ]
            ])
        );
    }
    
}
