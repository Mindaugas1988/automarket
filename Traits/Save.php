<?php


namespace App\Traits;


use App\Advert;
use Illuminate\Support\Facades\Storage;

trait Save
{

    protected function get_youtube_id($url){
        if ($url != null){
            parse_str( parse_url( $url, PHP_URL_QUERY ), $video_id );
            $results = 'https://www.youtube.com/embed/'.$video_id['v'];
            return $results;
        }else{
            return null;
        }
    }



    protected function create($photos, array $data, array $features, array $others)
    {
        //
        $advert = Advert::create($data);
        $advert->other()->create($others);
        $advert->accesories()->createMany($features);

        foreach ($photos as $photo) {
            $filename = Storage::disk('public')->put('photos/'.$advert->id.'/', $photo);
            $advert->photos()->create([
                'image' => $filename
            ]);
        }

        return response()->json([
            'location' => route('advert',['category' => $advert->category,'item' => $advert->id]),
            'status'=> true
        ]);
    }

    protected function update_advert(array $data, array $features, array $others, $advert)
    {
        //
        $advert->update($data);
        $advert->other()->update($others);
        $advert->accesories()->delete();
        $advert->comments()->delete();
        $advert->accesories()->createMany($features);



        return response()->json([
            'message' => trans('custom.success_update'),
            'status'=> true
        ]);
    }

}
