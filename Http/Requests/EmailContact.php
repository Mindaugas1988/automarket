<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function sanitize()
    {
        return $this->only(['advert_email','email','title','text']);
    }

    public function validator($factory)
    {
        return $factory->make(
            $this->sanitize(), $this->container->call([$this, 'rules']), $this->messages(),$this->attributes()
        );
    }

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
            'advert_email' => ['required','string','email'],
            'email' => ['required','string','email'],
            'title' => ['required','string'],
            'text' => ['required','string'],
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json(
            [
                'errors' => $validator->errors(),
                'status' => false
            ]
        ));
    }
}
