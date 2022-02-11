<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class AccesoriesTranslation extends Model
{
    //
    public $timestamps = false;
    protected $table = 'accesories_translation';
    protected $fillable = ['lt','en','ru'];

    public function advertsable()
    {
        return $this->belongsTo('App\Advert','advert_id','id');
    }
}
