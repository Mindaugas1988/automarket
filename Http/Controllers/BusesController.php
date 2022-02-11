<?php

namespace App\Http\Controllers;

use App\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusesController extends Controller
{

    var $rules = array(
        'brand'=> ['required','string'],
        'years'=> ['required','numeric'],
        'type'=> ['required','array'],
        'defect'=> ['required','array'],
        'fuel'=> ['required','array'],
        'gearbox'=> ['required','array'],
        'seats_number'=> ['required','numeric'],
        'price'=> ['required','numeric','between:100,300000', 'regex:/^[0-9]+$/'],
        //
        'ta_years'=> ['nullable','numeric'],
        'model'=> ['nullable','string'],
        'mileage'=> ['nullable','numeric', 'between:0,10000000', 'regex:/^[0-9]+$/'],
        'overall_mass'=> ['nullable','numeric','between:1000,100000','regex:/^[0-9]+$/'],
        'fuel_tank'=> ['nullable','numeric','between:100,1000','regex:/^[0-9]+$/'],
        'engine'=> ['nullable','regex:/^(\d+)?([.]?\d{0,2})?$/'],
        'own_weight'=> ['nullable','numeric','between:1000,100000','regex:/^[0-9]+$/'],
        'power'=> ['nullable','numeric','between:30,1000', 'regex:/^[0-9]+$/'],
        'vin'=> ['nullable','string','size:17','regex:/^[a-zA-Z\d]+$/'],
        'color'=> ['nullable','array'],
        'video_url'=> ['nullable','string','url','regex:/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/'],
        //
        'mobile_code'=> ['required','string','regex:/^\+/'],
        'number'=> ['required','numeric','digits_between:7,10','regex:/^[0-9]+$/'],
        'email'=> ['required','string','email'],
        'country'=> ['required','array'],
        'city'=> ['nullable','string','required_if:country_code,lt']
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function check_validation($request,$rules){
        $validator = Validator::make($request,$rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => false
            ]);
        }


        return response()->json([
            'message' => trans('custom.success_update'),
            'status'=> true
        ]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->check_validation($request->data,$this->rules);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //
    }
}
