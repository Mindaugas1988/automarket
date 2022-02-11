<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortBy as SortBy;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Advert extends Model implements TranslatableContract
{
    //
    use Translatable;
    use SortBy;
    protected $table = 'adverts';
    public $translatedAttributes = ['status','fuel','type','gearbox','defect','driven_wheel','steering',
        'cooler','country','color','registration_country','reg_type'];

    protected $fillable = [
        'user_id',
        'category',
        'logo',
        'brand',
        'model',
        'price',
        'years',
        'ta_years',
        'video_url',
        'comment',
        'mobile_code',
        'number',
        'email',
        'city',
        'country_code',
        'flag_class'

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function cover()
    {
        if ($this->photos()->count()>0){
            return Storage::url($this->photos()->first()->image);
        }else{
            return $this->avatar;
        }
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function marks()
    {
        return $this->hasMany('App\Mark');
    }

    public function accesories()
    {
        return $this->hasMany(Translations\AccesoriesTranslation::class, 'advert_id','id');
    }

    public function other()
    {
        return $this->hasOne(AdvertField::class, 'advert_id','id');
    }


}
