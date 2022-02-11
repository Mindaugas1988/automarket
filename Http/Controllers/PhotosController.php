<?php

namespace App\Http\Controllers;

use App;
use App\Events\PhotosUpdateStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Photo;
use App\Advert;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$photos)
    {
        $advert = Advert::find($id);
       foreach ($photos as $photo) {
            $filename = Storage::disk('public')->put('photos/'.$id.'/', $photo);
            $image = new Photo(['image' => $filename]);
            $advert->photos()->save($image);
        }
        PhotosUpdateStatus::dispatch($advert->photos);

        return response()->json([
            'success' => trans('custom.success_update'),
            'status'=> true
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $id = $request->id;

        if ($request->hasFile('photos')){
            $photos = count([$request->photos]);
            foreach(range(0, $photos) as $index) {
                $rules['photos.' . $index] = 'image|mimes:jpeg,jpg,png|max:2000';
            }
        }
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => false
            ]);
        }

        return $this->create($id,$request->photos);




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $advert = Advert::find($id);

        foreach ($request->photos as $photo){
            Photo::find($photo['id'])->delete();
            Storage::disk('public')->delete($photo['image']);
        }

        PhotosUpdateStatus::dispatch($advert->photos);

        return response()->json([
            'success' => trans('custom.success_remove'),
            'status'=> true
        ]);



    }
}
