<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MotobikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
     */

    public function sanitize()
    {
        $this->merge([
            'data' => json_decode($this->input('data'), true)
        ]);
        $array = [
            'data.status',
            'data.brand',
            'data.model',
            'data.years',
            'data.engine',
            'data.type',
            'data.defect',
            'data.price',
            //
            'data.logo',
            'data.ta_years',
            'data.tire',
            'data.color',
            'data.mileage',
            'data.torque',
            'data.registration_country',
            'data.power',
            'data.reg_type',
            'data.fuel',
            'data.cooler',
            'data.video_url',
            //
            'data.mobile_code',
            'data.number',
            'data.email',
            'data.country',
            'data.city',
            'data.country_code',
            'data.current_flag'
        ];
        return $this->only($array);
    }

    public function validator($factory)
    {
        return $factory->make(
            $this->sanitize(), $this->container->call([$this, 'rules']),$this->messages(), $this->attributes()
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
        $rules = [
            'data.status' => ['required','array'],
            'data.brand'=> ['required','string'],
            'data.model'=> ['required','string'],
            'data.years'=> ['required','numeric'],
            'data.engine'=> ['required','regex:/^(\d+)?([.]?\d{0,2})?$/'],
            'data.type'=> ['required','array'],
            'data.defect'=> ['required','array'],
            'data.price'=> ['required','numeric','between:100,300000', 'regex:/^[0-9]+$/'],
            //
            'data.logo'=> ['nullable','string'],
            'data.ta_years'=> ['nullable','numeric'],
            'data.tire'=> ['nullable','numeric','digits_between:1,3'],
            'data.color'=> ['nullable','array'],
            'data.mileage'=> ['nullable','numeric', 'between:0,10000000', 'regex:/^[0-9]+$/'],
            'data.torque'=> ['nullable','numeric', 'between:10,10000', 'regex:/^[0-9]+$/'],
            'data.registration_country'=> ['nullable','array'],
            'data.power'=> ['nullable','numeric','between:30,1000', 'regex:/^[0-9]+$/'],
            'data.reg_type'=> ['nullable','array'],
            'data.fuel'=> ['nullable','array'],
            'data.cooler'=> ['nullable','array'],
            'data.video_url'=> ['nullable','string','url','regex:/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/'],
            //
            'data.mobile_code'=> ['required','string','regex:/^\+/'],
            'data.number'=> ['required','numeric','digits_between:7,10','regex:/^[0-9]+$/'],
            'data.email'=> ['required','string','email'],
            'data.country'=> ['required','array'],
            'data.city'=> ['nullable','string','required_if:data.country_code,lt'],
            'data.country_code' => ['required','string'],
            'data.current_flag' => ['required','string']
            //
        ];

        if ($this->hasFile('photos')){
            $photos = count([$this->photos]);
            foreach(range(0, $photos) as $index) {
                $rules['photos.' . $index] = 'image|mimes:jpeg,jpg,png|max:2000';
            }
        }

        return $rules;


    }

    public function messages()
    {
        return [

        ];
    }

    public function attributes()
    {
        return [
            'data.status' => '',
            'data.brand'=> '',
            'data.model'=> '',
            'data.years'=> '',
            'data.engine'=> '',
            'data.type'=> '',
            'data.defect'=> '',
            'data.price'=> '',
            //
            'data.logo'=> '',
            'data.ta_years'=> '',
            'data.tire'=> '',
            'data.color'=> '',
            'data.mileage'=> '',
            'data.torque'=> '',
            'data.registration_country'=> '',
            'data.power'=> '',
            'data.reg_type'=> '',
            'data.fuel'=> '',
            'data.cooler'=> '',
            'data.video_url'=> '',
            //
            'data.mobile_code'=> '',
            'data.number'=> '',
            'data.email'=> '',
            'data.country'=> '',
            'data.city'=> ''
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
