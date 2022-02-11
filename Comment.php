<?php

namespace App;

use App\Traits\SortBy as SortBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jcc\LaravelVote\Traits\Votable;


class Comment extends Model
{
    //
    use Votable;
    use SortBy;

    protected $fillable = [
        'user_id',
        'reply_to',
        'email',
        'name',
        'comment',
        'ip',
        'url'
    ];


    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logo()
    {
        if($this->user){
            if(Str::is('images/avatars/*', $this->user->avatar)) {
                $avatar = asset(Storage::url($this->user->avatar));
            }
            else if(Str::is('https://graph.facebook.com/*', $this->user->avatar) || Str::is('
         https://lh3.googleusercontent.com/*', $this->user->avatar)){
                $avatar = $this->user->avatar;
            }
            else{
                $avatar = asset($this->user->avatar);
            }


        }else{
            $avatar = asset($this->avatar);
        }
        return $avatar;


    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function answers(){
        return $this::where('reply_to',$this->getKey())->get();
    }

}
