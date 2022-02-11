<?php

namespace App\Http\Controllers;

use App;
use App\Advert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search_car()
    {
        //
        return view('search-advert.cars');
    }

    public function search_motobike()
    {
        //
        return view('search-advert.motobikes');
    }


    public function index()
    {
        //
        return view('search');
    }

    public function count(){
        $cars = Advert::where('category','car')->count();
        $motobikes = Advert::where('category','motobike')->count();
        return response()->json(['cars'=>$cars,'motobikes'=>$motobikes]) ;
    }

    public function load_brands(Request $request)
    {
        //
        $type = $request->type;
        $results = Advert::where('category',$type)->select('logo','brand')->distinct()->get();
        return response()->json($results) ;

    }

    public function load_models(Request $request)
    {
        //
        $array = [];
        $type = $request->type;
        $brand = $request->brand;
        $results = Advert::where([['category', '=', $type],['brand','=',$brand]])
            ->select('model')->distinct()->get();


        foreach ($results as $value){
            array_push($array, $value['model']);
        }
        return response()->json($array) ;

    }


    public function search_results(Request $request, $type)
    {
        //Between
        $sort = $request->query('sort');
        $min_price = $request->input('min_price');
        $max_price =$request->input('max_price');
        $date_from = date($request->input('min_year').'-01-01');
        $date_to = date($request->input('max_year').'-12-31');
        $min_engine = ($request->has('min_engine')) ? $request->input('min_engine') : null;
        $max_engine = ($request->has('max_engine')) ? $request->input('max_engine') : null;
        $min_power = ($request->has('min_power')) ? $request->input('min_power') : null;
        $max_power = ($request->has('max_power')) ? $request->input('max_power') : null;
        $min_mileage = ($request->has('min_mileage')) ? $request->input('min_mileage') : null;
        $max_mileage = ($request->has('max_mileage')) ? $request->input('max_mileage') : null;
        //Between

        $main = $request->only(['brand','model','city']);
        $other = $request->only(['doors','seats_number','vin','modification','co_emission','cylinders_number',
        'gears_number','torque','weight','euro_standart','wheel','tire']);
        $multi = $request->only(['type','fuel','cooler','status']);
        $second = $request->only(['gearbox','defect','driven_wheel','steering','country','color','registration_country','reg_type']);



        $search = Advert::where('category',$type)
            ->where($main)
            ->whereBetween('years',[$date_from, $date_to])
            ->whereBetween('price', [$min_price, $max_price])
            ->whereMultiTranslation($multi)
            ->whereArrayTranslation($second)
            ->whereHas('other',function (Builder $query) use ($min_engine,$max_engine,$min_power,$max_power,$min_mileage,$max_mileage,$other) {
                if ($min_engine != null && $max_engine != null){
                    $query->whereBetween('engine', [$min_engine,$max_engine]);
                }
                if ($min_power != null && $max_power != null){
                    $query->whereBetween('power', [$min_power,$max_power]);
                }
                if ($min_mileage != null && $max_mileage != null){
                    $query->whereBetween('mileage', [$min_mileage,$max_mileage]);
                }
                    $query->where($other);
            });

            $results = $search->sort($sort);


        return view('search-results',compact('results','sort','main','type'));
    }



}
