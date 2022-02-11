<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortBy as SortBy;


class Mark extends Model
{
    //
    use SortBy;
    protected $fillable = [
        'client_id',
         'price',

    ];

    public function advert()
    {
        return $this->belongsTo('App\Advert', 'advert_id', 'id');
    }

}
