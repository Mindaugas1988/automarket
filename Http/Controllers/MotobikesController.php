<?php

namespace App\Http\Controllers;
use App\Advert;
use App\Traits\Save as Save;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\MotobikeRequest;
use Illuminate\Support\Facades\Auth;

class MotobikesController extends Controller
{
    use Save;


    public function store(MotobikeRequest $request)
    {


        $years_string = ''.$request->input('data.years').'-'.$request->input('data.month').'-01';
        $ta_years_string = ''.$request->input('data.ta_years').'-'.$request->input('data.ta_month').'-01';
        if ($request->input('data.ta_years') == null){
            $ta_date = null;
        }else{
            $ta_date = new Carbon($ta_years_string);
        }

        $date = new Carbon($years_string);
        $features = [];
        $others = [
            'engine' => $request->input('data.engine'),
            'tire' => $request->input('data.tire'),
            'mileage' => $request->input('data.mileage'),
            'torque' => $request->input('data.torque'),
            'power' => $request->input('data.power'),
            'power_si' => $request->input('data.power_si'),
        ];
        $fillable = [
            'user_id' => Auth::id(),
            'category' => 'motobike',
            'country_code' => $request->input('data.country_code'),
            'flag_class' => $request->input('data.current_flag'),
            'brand' => $request->input('data.brand'),
            'model' => $request->input('data.model'),
            'logo' => $request->input('data.logo'),
            'years' => $date,
            'price' => $request->input('data.price'),
            'ta_years' => $ta_date,
            'video_url' => $this->get_youtube_id($request->input('data.video_url')),
            'comment' => $request->input('data.comment'),
            'mobile_code' => $request->input('data.mobile_code'),
            'number' => $request->input('data.number'),
            'email' => $request->input('data.email'),
            'city' => $request->input('data.city'),
            'lt' => [
                'status' => $request->input('data.status.lt'),
                'type' => $request->input('data.type.lt'),
                'defect' => $request->input('data.defect.lt'),
                'country' => $request->input('data.country.lt'),
                'color' => $request->input('data.color.lt'),
                'registration_country' => $request->input('data.registration_country.lt'),
                'reg_type' => $request->input('data.reg_type.lt'),
                'fuel' => $request->input('data.fuel.lt'),
                'cooler' => $request->input('data.cooler.lt'),
                ],
            'en' => [
                'status' => $request->input('data.status.en'),
                'type' => $request->input('data.type.en'),
                'defect' => $request->input('data.defect.en'),
                'country' => $request->input('data.country.en'),
                'color' => $request->input('data.color.en'),
                'registration_country' => $request->input('data.registration_country.en'),
                'reg_type' => $request->input('data.reg_type.en'),
                'fuel' => $request->input('data.fuel.en'),
                'cooler' => $request->input('data.cooler.en'),
            ],
            'ru' => [
                'status' => $request->input('data.status.ru'),
                'type' => $request->input('data.type.ru'),
                'defect' => $request->input('data.defect.ru'),
                'country' => $request->input('data.country.ru'),
                'color' => $request->input('data.color.ru'),
                'registration_country' => $request->input('data.registration_country.ru'),
                'reg_type' => $request->input('data.reg_type.ru'),
                'fuel' => $request->input('data.fuel.ru'),
                'cooler' => $request->input('data.cooler.ru'),
            ],

        ];

        if ($request->has('data.features')){
            foreach ($request->input('data.features') as $value) {
                array_push($features, $value);
            }
        }
        return $this->create($request->photos,$fillable,$features,$others);
    }


    public function update(MotobikeRequest $request,Advert $advert)
    {

        $this->authorize('update', $advert);

        $years_string = ''.$request->input('data.years').'-'.$request->input('data.month').'-01';
        $ta_years_string = ''.$request->input('data.ta_years').'-'.$request->input('data.ta_month').'-01';
        if ($request->input('data.ta_years') == null){
            $ta_date = null;
        }else{
            $ta_date = new Carbon($ta_years_string);
        }

        $date = new Carbon($years_string);
        $features = [];
        $others = [
            'engine' => $request->input('data.engine'),
            'tire' => $request->input('data.tire'),
            'mileage' => $request->input('data.mileage'),
            'torque' => $request->input('data.torque'),
            'power' => $request->input('data.power'),
            'power_si' => $request->input('data.power_si'),
        ];
        $fillable = [
            'country_code' => $request->input('data.country_code'),
            'flag_class' => $request->input('data.current_flag'),
            'brand' => $request->input('data.brand'),
            'model' => $request->input('data.model'),
            'logo' => $request->input('data.logo'),
            'years' => $date,
            'price' => $request->input('data.price'),
            'ta_years' => $ta_date,
            'video_url' => $this->get_youtube_id($request->input('data.video_url')),
            'comment' => $request->input('data.comment'),
            'mobile_code' => $request->input('data.mobile_code'),
            'number' => $request->input('data.number'),
            'email' => $request->input('data.email'),
            'city' => $request->input('data.city'),
            'lt' => [
                'status' => $request->input('data.status.lt'),
                'type' => $request->input('data.type.lt'),
                'defect' => $request->input('data.defect.lt'),
                'country' => $request->input('data.country.lt'),
                'color' => $request->input('data.color.lt'),
                'registration_country' => $request->input('data.registration_country.lt'),
                'reg_type' => $request->input('data.reg_type.lt'),
                'fuel' => $request->input('data.fuel.lt'),
                'cooler' => $request->input('data.cooler.lt'),
            ],
            'en' => [
                'status' => $request->input('data.status.en'),
                'type' => $request->input('data.type.en'),
                'defect' => $request->input('data.defect.en'),
                'country' => $request->input('data.country.en'),
                'color' => $request->input('data.color.en'),
                'registration_country' => $request->input('data.registration_country.en'),
                'reg_type' => $request->input('data.reg_type.en'),
                'fuel' => $request->input('data.fuel.en'),
                'cooler' => $request->input('data.cooler.en'),
            ],
            'ru' => [
                'status' => $request->input('data.status.ru'),
                'type' => $request->input('data.type.ru'),
                'defect' => $request->input('data.defect.ru'),
                'country' => $request->input('data.country.ru'),
                'color' => $request->input('data.color.ru'),
                'registration_country' => $request->input('data.registration_country.ru'),
                'reg_type' => $request->input('data.reg_type.ru'),
                'fuel' => $request->input('data.fuel.ru'),
                'cooler' => $request->input('data.cooler.ru'),
            ],

        ];

        if ($request->has('data.features')){
            foreach ($request->input('data.features') as $value) {
                array_push($features, $value);
            }
        }
        return $this->update_advert($fillable,$features,$others,$advert);
    }


}
