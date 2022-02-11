<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    //

    public function remove(Request $request)
    {
        Auth::user()->notifications()->where('id',$request->id)->delete();
        return response()->json([
            'status'=> true
        ]);
    }
}
