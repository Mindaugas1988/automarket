<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class AdvertTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'adverts_translation';
    protected $fillable = ['status','fuel','type','gearbox','defect','driven_wheel','steering',
        'cooler','country','color','registration_country','reg_type'];
}
