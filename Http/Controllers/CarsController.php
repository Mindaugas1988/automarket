<?php
namespace App\Http\Controllers;
use App\Advert;
use App\Traits\Save as Save;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//
use App\Http\Requests\CarRequest;

class CarsController extends Controller
{
    use Save;

    public function store(CarRequest $request)
    {
        //
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
            'power' => $request->input('data.power'),
            'power_si' => $request->input('data.power_si'),
            'doors' => $request->input('data.doors'),
            'seats_number' => $request->input('data.seats_number'),
            'vin' => $request->input('data.vin'),
            'modification' => $request->input('data.modification'),
            'co_emission' => $request->input('data.co_emission'),
            'cylinders_number' => $request->input('data.cylinders_number'),
            'gears_number' => $request->input('data.gears_number'),
            'mileage' => $request->input('data.mileage'),
            'torque' => $request->input('data.torque'),
            'weight' => $request->input('data.weight'),
            'wheel' => $request->input('data.wheel'),
        ];
        $fillable = [
            'user_id' => Auth::id(),
            'category' => 'car',
            'country_code' => $request->input('data.country_code'),
            'flag_class' => $request->input('data.current_flag'),
            'brand' => $request->input('data.brand'),
            'model' => $request->input('data.model'),
            'logo' => $request->input('data.logo'),
            'years' => $date,
            'price' => $request->input('data.price'),
            'ta_years' => $ta_date,
            'video_url' => $this->get_youtube_id($request->input('data.video_url')),
            'mobile_code' => $request->input('data.mobile_code'),
            'number' => $request->input('data.number'),
            'email' => $request->input('data.email'),
            'comment' => $request->input('data.comment'),
            'city' => $request->input('data.city'),
            'lt' => [
                'fuel' => $request->input('data.fuel.lt'),
                'type' => $request->input('data.type.lt'),
                'gearbox' => $request->input('data.gearbox.lt'),
                'defect' => $request->input('data.defect.lt'),
                'driven_wheel' => $request->input('data.driven_wheel.lt'),
                'steering' => $request->input('data.steering.lt'),
                'registration_country' => $request->input('data.registration_country.lt'),
                'country' => $request->input('data.country.lt'),
                'color' => $request->input('data.color.lt'),
                'status' => $request->input('data.status.lt')],
            'en' => [
                'fuel' => $request->input('data.fuel.en'),
                'type' => $request->input('data.type.en'),
                'gearbox' => $request->input('data.gearbox.en'),
                'defect' => $request->input('data.defect.en'),
                'driven_wheel' => $request->input('data.driven_wheel.en'),
                'steering' => $request->input('data.steering.en'),
                'registration_country' => $request->input('data.registration_country.en'),
                'country' => $request->input('data.country.en'),
                'color' => $request->input('data.color.en'),
                'status' => $request->input('data.status.en')],
            'ru' => [
                'fuel' => $request->input('data.fuel.ru'),
                'type' => $request->input('data.type.ru'),
                'gearbox' => $request->input('data.gearbox.ru'),
                'defect' => $request->input('data.defect.ru'),
                'driven_wheel' => $request->input('data.driven_wheel.ru'),
                'steering' => $request->input('data.steering.ru'),
                'registration_country' => $request->input('data.registration_country.ru'),
                'country' => $request->input('data.country.ru'),
                'color' => $request->input('data.color.ru'),
                'status' => $request->input('data.status.ru')],

        ];

        if ($request->has('data.features')){
            foreach ($request->input('data.features') as $value) {
                array_push($features, $value);
            }
        }
        return $this->create($request->photos,$fillable,$features,$others);

    }


    public function update(CarRequest $request,Advert $advert)
    {
        //

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
            'power' => $request->input('data.power'),
            'power_si' => $request->input('data.power_si'),
            'doors' => $request->input('data.doors'),
            'seats_number' => $request->input('data.seats_number'),
            'vin' => $request->input('data.vin'),
            'modification' => $request->input('data.modification'),
            'co_emission' => $request->input('data.co_emission'),
            'cylinders_number' => $request->input('data.cylinders_number'),
            'gears_number' => $request->input('data.gears_number'),
            'mileage' => $request->input('data.mileage'),
            'torque' => $request->input('data.torque'),
            'weight' => $request->input('data.weight'),
            'wheel' => $request->input('data.wheel'),
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
            'mobile_code' => $request->input('data.mobile_code'),
            'number' => $request->input('data.number'),
            'email' => $request->input('data.email'),
            'comment' => $request->input('data.comment'),
            'city' => $request->input('data.city'),
            'lt' => [
                'fuel' => $request->input('data.fuel.lt'),
                'type' => $request->input('data.type.lt'),
                'gearbox' => $request->input('data.gearbox.lt'),
                'defect' => $request->input('data.defect.lt'),
                'driven_wheel' => $request->input('data.driven_wheel.lt'),
                'steering' => $request->input('data.steering.lt'),
                'registration_country' => $request->input('data.registration_country.lt'),
                'country' => $request->input('data.country.lt'),
                'color' => $request->input('data.color.lt'),
                'status' => $request->input('data.status.lt')],
            'en' => [
                'fuel' => $request->input('data.fuel.en'),
                'type' => $request->input('data.type.en'),
                'gearbox' => $request->input('data.gearbox.en'),
                'defect' => $request->input('data.defect.en'),
                'driven_wheel' => $request->input('data.driven_wheel.en'),
                'steering' => $request->input('data.steering.en'),
                'registration_country' => $request->input('data.registration_country.en'),
                'country' => $request->input('data.country.en'),
                'color' => $request->input('data.color.en'),
                'status' => $request->input('data.status.en')],
            'ru' => [
                'fuel' => $request->input('data.fuel.ru'),
                'type' => $request->input('data.type.ru'),
                'gearbox' => $request->input('data.gearbox.ru'),
                'defect' => $request->input('data.defect.ru'),
                'driven_wheel' => $request->input('data.driven_wheel.ru'),
                'steering' => $request->input('data.steering.ru'),
                'registration_country' => $request->input('data.registration_country.ru'),
                'country' => $request->input('data.country.ru'),
                'color' => $request->input('data.color.ru'),
                'status' => $request->input('data.status.ru')],

        ];

        if ($request->has('data.features')){
            foreach ($request->input('data.features') as $value) {
                array_push($features, $value);
            }
        }

        return $this->update_advert($fillable,$features,$others,$advert);
    }


}
