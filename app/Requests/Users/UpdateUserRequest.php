<?php
namespace App\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;

class UpdateUserRequest extends FormRequest{

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|exists:User,id',
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required'

        ];
    }

    /**
     * Failed Validation
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
