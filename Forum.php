<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    //
    protected $table = 'forum';
    protected $primaryKey = 'topic_id';

    protected $fillable = ['category_id','user_id','title','content'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class,'category_id','id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
