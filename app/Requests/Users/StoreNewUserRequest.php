<?php
namespace App\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNewUserRequest extends FormRequest {

    /**
     * Declare if action is allowed
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required'
        ];
    }


    /**
     * Failed Validation Manage
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(validationErrors($validator->errors()->all()));
        }
    }
}
