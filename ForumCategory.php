<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    protected $table = 'forum_categories';
    protected $primaryKey = 'topic_id';

    protected $fillable = ['topic_id','value'];

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class,'topic_id','id');
    }

    public function themes()
    {
        return $this->hasMany(Forum::class,'category_id','id');
    }

    public function last_theme()
    {
        return $this->themes()->orderBy('created_at','desc')->first();
    }


}
