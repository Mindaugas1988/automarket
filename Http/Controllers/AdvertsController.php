<?php

namespace App\Http\Controllers;

use App\Advert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App;


class AdvertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function advert($category,$item,Request $request){
        $sort = $request->query('sort');
        $advert = Advert::find($item);
        $comments = $advert->comments()->where('reply_to',null)->sort($sort);
        return view('advert',compact('advert','comments','sort'));
    }



    public function my_adverts(Request $request)
    {
        //
        $sort = $request->query('sort');
        $adverts = Advert::where('user_id',Auth::id())->sort($sort);

        return view('sign.my-adverts',compact('adverts','sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        //
        return view('sign.store-advert.new-advert');
    }

    public function new_car(Advert $advert)
    {
        //
        return view('sign.store-advert.new-car');
    }

    public function new_motobike(Advert $advert)
    {
        //
        return view('sign.store-advert.new-motobike');
    }


    public function update_car(Advert $advert)
    {
        $advert->other;
        $advert->accesories;
        $translate = ['lt'=> $advert->translate('lt'),'en'=> $advert->translate('en'),'ru'=> $advert->translate('ru')];
        $advert = collect($advert);
        $advert = $advert->merge($translate);
        return view('sign.update-advert.update-car',compact('advert'));
    }

    public function update_motobike(Advert $advert)
    {
        //
        $advert->other;
        $advert->accesories;
        $translate = ['lt'=> $advert->translate('lt'),'en'=> $advert->translate('en'),'ru'=> $advert->translate('ru')];
        $advert = collect($advert);
        $advert = $advert->merge($translate);
        return view('sign.update-advert.update-motobike',compact('advert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $advert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        $this->authorize('delete', $advert);

        Storage::deleteDirectory('/public/photos/'.$advert->id);
        $advert->photos()->delete();
        $advert->delete();
        return redirect()->to('/');
    }

    //



}
