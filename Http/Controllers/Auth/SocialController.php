<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;
use Socialite;
use App\User;
class SocialController extends Controller
{
    //

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    private function get_countries_info($country_code){
        $path = url('json-resources/countries.json');
        $file = json_decode(file_get_contents($path), true);
        $collection = collect($file['countries']);
        $countries = $collection->firstWhere('iso', '==',Str::lower($country_code) );
        return $countries;
    }

    public function handleProviderCallback($provider)
    {
        $position = Location::get();
        $countries = $this->get_countries_info($position->countryCode);
        $getInfo = Socialite::driver($provider)->user();

        if (User::where('email', '=', $getInfo->email)->exists()) {
            $user = $this->updateUser($getInfo,$provider);
        }else{
            $user = $this->createUser($getInfo,$provider,$countries);
        }

        Auth()->login($user);
        return redirect()->to('/profile');
    }

    function createUser($getInfo,$provider, array $countries){

        $user = User::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'email' => $getInfo->email,
        ],[
            'email'    => $getInfo->email,
            'provider' => $provider,
            'avatar' => $getInfo->avatar,
            'provider_id' => $getInfo->id,
            'mobile_code'=> $countries['number_code'],
            'country_code'=> $countries['iso'],
            'flag_class'=> $countries['class'],
            'lt' => ['country' => $countries['lt'],'name'=> $getInfo->name],
            'en' => ['country' => $countries['en'], 'name'=> $getInfo->name],
            'ru' => ['country' => $countries['ru'], 'name'=> $getInfo->name],
        ]);

        return $user;
    }

    function updateUser($getInfo,$provider){

        $user = User::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'email' => $getInfo->email,
        ],[
            'email'    => $getInfo->email,
            'provider' => $provider,
            'provider_id' => $getInfo->id,
            'lt' => ['name'=> $getInfo->name],
            'en' => ['name'=> $getInfo->name],
            'ru' => ['name'=> $getInfo->name],
        ]);

        return $user;
    }
}
