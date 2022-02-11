<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $table = 'forum_topics';
    protected $primaryKey = 'id';

    protected $fillable = ['value'];

    public function categories()
    {
        return $this->hasMany(ForumCategory::class,'topic_id','id');
    }

}
