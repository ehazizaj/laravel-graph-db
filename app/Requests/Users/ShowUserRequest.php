<?php

namespace App\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;

class ShowUserRequest extends FormRequest{

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
            'user' => 'required|exists:User,id',
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


    /**
     * Merge Request Data
     *
     * @return array
     */
    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'user' => Route::input('user'),
        ]);
    }

}
