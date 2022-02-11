<?php

namespace App;

use App\Traits\SortBy as SortBy;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class Car extends Model implements TranslatableContract
{
    use Translatable;
    use SortBy;

    protected $table = 'cars';
    public $translatedAttributes = ['fuel','type','gearbox','defect','driven_wheel','steering_collum',
        'registration_country','country','color','status'];


    protected $fillable = [
        'advert_id',
        'brand',
        'model',
        'logo',
        'years',
        'month',
        'engine',
        'power',
        'power_si',
        'doors',
        'seats_number',
        'price',
        'ta_years',
        'ta_month',
        'vin',
        'modification',
        'co_emission',
        'cylinders_number',
        'gears_number',
        'mileage',
        'torque',
        'weight',
        'wheel',
        'video_url',
        'mobile_code',
        'number',
        'email',
        'comment',
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




    //
}
