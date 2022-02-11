<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class UserTranslation extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['country','name'];

}
