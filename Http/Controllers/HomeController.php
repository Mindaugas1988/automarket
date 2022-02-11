<?php

namespace App\Http\Controllers;

use App\Advert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $adverts = Advert::orderBy('created_at','desc')->take(6)->get();
        return view('main',compact('adverts'));
    }
}
