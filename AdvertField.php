<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertField extends Model
{
    protected $table = 'adverts_other_fields';
    public $timestamps = false;

    protected $fillable = [
        'advert_id',
        'engine',
        'power',
        'power_si',
        'doors',
        'seats_number',
        'vin',
        'modification',
        'co_emission',
        'cylinders_number',
        'gears_number',
        'mileage',
        'torque',
        'weight',
        'euro_standart',
        'wheel',
        'tire',
    ];

    public function master()
    {
        return $this->belongsTo('App\Advert','advert_id','id');
    }

}
