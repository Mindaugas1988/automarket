<?php

namespace App;

use App\Traits\SortBy as SortBy;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class Motobike extends Model implements TranslatableContract
{
    //
    use Translatable;
    use SortBy;
    protected $table = 'motobikes';
    public $translatedAttributes = ['status','type','defect','country','color','registration_country','reg_type','fuel','cooler'];

    protected $fillable = [
        'advert_id',
        'brand',
        'model',
        'logo',
        'years',
        'month',
        'engine',
        'price',
        'ta_years',
        'ta_month',
        'tire',
        'mileage',
        'torque',
        'power',
        'power_si',
        'video_url',
        'comment',
        'mobile_code',
        'number',
        'email',
        'city'
    ];

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }


    public function accesories()
    {
        return $this->morphMany(Translations\FeaturesTranslation::class, 'advertsable');
    }



}
