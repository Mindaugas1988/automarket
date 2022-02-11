<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use Illuminate\Http\Request;
use App\Notifications\MarkAdvert;
use App\Events\MarksUpdateStatus;
use App\Advert;
use App\User;
use Cookie;
use Carbon\Carbon;
use App\Mark;

class MarkController extends Controller
{
    //

    public function getmark(Request $request){
        $id = $request->id;
        $advert = Advert::find($id);
        $client = Cookie::get('marked_cookie');
        $mark = $advert->marks()->where('client_id',$client)->exists();
        if ($mark){
            return response()->json([
                'status'=> $this->unmark($advert,$client)
            ]);
        }else{
            return response()->json([
                'status'=> $this->setmark($advert,$client)
            ]);
        }

    }

    private function setmark($advert, $client)
    {

        $user = User::find($advert->user_id);
        $data = [
            'client_id' => $client,
            'price' => $advert->price,
        ];
        $advert->marks()->create($data);
        $count = Mark::where('client_id',$client)->count();
        MarksUpdateStatus::dispatch($count);
        $user->notify(new MarkAdvert($advert));
        return 'fas fa-heart';


    }

    private function unmark($advert, $client)
    {

        $advert->marks()->where('client_id',$client)->delete();
        $count = Mark::where('client_id',$client)->count();
        MarksUpdateStatus::dispatch($count);
        return 'far fa-heart';

    }

    public function checkmark(Request $request)
    {
        $id = $request->id;
        $advert = Advert::find($id);
        $client = Cookie::get('marked_cookie');
        $mark = $advert->marks()->where('client_id',$client)->exists();
        if ($mark){
            return response()->json([
                'status'=> 'fas fa-heart'
            ]);
        }else{
            return response()->json([
                'status'=> 'far fa-heart'
            ]);
        }
    }


    public function all_marks()
    {

        $client = Cookie::get('marked_cookie');
        $marks = Mark::where('client_id',$client)->count();

        return response()->json([
            'status'=> $marks
        ]);


    }

    public function marks(Request $request)
    {
        $sort = $request->query('sort');
        $client = Cookie::get('marked_cookie');
        $all_marks =  Mark::where('client_id',$client);
        $marks_count = $all_marks->get()->count();
        $marks = $all_marks->sort($sort);


        return view('marked',compact('marks','marks_count','sort'));
    }
}
