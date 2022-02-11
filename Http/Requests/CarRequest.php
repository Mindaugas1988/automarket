<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'data.fuel',
            'data.type',
            'data.gearbox',
            'data.power',
            'data.driven_wheel',
            'data.defect',
            'data.steering',
            'data.doors',
            'data.seats_number',
            'data.price',
            //
            'data.logo',
            'data.ta_years',
            'data.vin',
            'data.modification',
            'data.co_emission',
            'data.cylinders_number',
            'data.color',
            'data.gears_number',
            'data.mileage',
            'data.torque',
            'data.weight',
            'data.euro_standart',
            'data.wheel',
            'data.registration_country',
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
            'data.fuel'=> ['required','array'],
            'data.type'=> ['required','array'],
            'data.gearbox'=> ['required','array'],
            'data.power'=> ['required','numeric','between:30,1000', 'regex:/^[0-9]+$/'],
            'data.driven_wheel'=> ['required','array'],
            'data.defect'=> ['required','array'],
            'data.steering'=> ['required','array'],
            'data.doors'=> ['required','string'],
            'data.seats_number'=> ['required','numeric'],
            'data.price'=> ['required','numeric','between:100,300000', 'regex:/^[0-9]+$/'],
            //
            'data.logo' => ['nullable','string'],
            'data.ta_years'=> ['nullable','numeric'],
            'data.vin'=> ['nullable','string','size:17','regex:/^[a-zA-Z\d]+$/'],
            'data.modification'=> ['nullable','string'],
            'data.co_emission'=> ['nullable','numeric','between:0,1000', 'regex:/^[0-9]+$/'],
            'data.cylinders_number'=> ['nullable','numeric','between:1,12'],
            'data.color'=> ['nullable','array'],
            'data.gears_number'=> ['nullable','numeric'],
            'data.mileage'=> ['nullable','numeric', 'between:0,10000000', 'regex:/^[0-9]+$/'],
            'data.torque'=> ['nullable','numeric', 'between:10,10000', 'regex:/^[0-9]+$/'],
            'data.weight'=> ['nullable','numeric', 'between:500,3500', 'regex:/^[0-9]+$/'],
            'data.euro_standart'=> ['nullable','string'],
            'data.wheel'=> ['nullable','string'],
            'data.registration_country'=> ['nullable','array'],
            'data.video_url'=> ['nullable','string','url','regex:/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/'],
            //
            'data.mobile_code'=> ['required','string','regex:/^\+/'],
            'data.number'=> ['required','numeric','digits_between:7,10','regex:/^[0-9]+$/'],
            'data.email'=> ['required','string','email'],
            'data.country'=> ['required','array'],
            'data.city'=> ['nullable','string','required_if:data.country_code,lt'],
            'data.country_code' => ['required','string'],
            'data.current_flag' => ['required','string']
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
            'data.fuel'=> '',
            'data.type'=> '',
            'data.gearbox'=> '',
            'data.power'=> '',
            'data.driven_wheel'=> '',
            'data.defect'=> '',
            'data.steering'=> '',
            'data.doors'=> '',
            'data.seats_number'=> '',
            'data.price'=> '',
            //
            'data.logo' => '',
            'data.ta_years'=> '',
            'data.vin'=> '',
            'data.modification'=> '',
            'data.co_emission'=> '',
            'data.cylinders_number'=> '',
            'data.color'=> '',
            'data.gears_number'=> '',
            'data.mileage'=> '',
            'data.torque'=> '',
            'data.weight'=> '',
            'data.euro_standart'=> '',
            'data.wheel'=> '',
            'data.registration_country'=> '',
            'data.video_url'=> '',
            //
            'data.mobile_code'=> '',
            'data.number'=> '',
            'data.email'=> '',
            'data.country'=> '',
            'data.city'=> ''
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
