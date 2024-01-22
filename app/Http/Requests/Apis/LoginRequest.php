<?php

namespace App\Http\Requests\Apis;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'string', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function validationData()
    {
        return $this->all();
    }

    protected  function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors() , 'statusCode' => 422], 422));
    }
}
