<?php

namespace App\Http\Controllers;

use App\Notifications\RepllyToComment;
use App\Notifications\LikedNotification;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App;
use App\User;
use App\Comment;
use App\Advert;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    private function is_notify($request, $comment){
        if ($request->filled('form.reply_id')) {
            $reply_comment = Comment::find($request->input('form.reply_id'));
            //
            if ($reply_comment->user && $reply_comment->user->id != Auth::id()){
                $id = $reply_comment->user->id;
                $user = User::find($id);
                $user->notify(new RepllyToComment($comment));
            }
        }
    }

    public function store(CommentRequest $request)
    {

        $id = $request->id;
        $advert = Advert::find($id);

        if ($this->create($request, $advert)){
            return response()->json([
                'status'=> true
            ]);
        }

    }


    public function create($request, $advert)
    {
        //
        if(Auth::check()){
            $data = [
                'user_id' => Auth::id(),
                'reply_to' => $request->input('form.reply_id'),
                'email' => $request->input('form.email'),
                'name' => $request->input('form.name'),
                'comment' => $request->input('form.comment'),
                'ip' => $request->ip(),
                'url' => $request->input('current_url')
            ];
        }else{

            $data = [
                'reply_to' => $request->input('form.reply_id'),
                'email' => $request->input('form.email'),
                'name' => $request->input('form.name'),
                'comment' => $request->input('form.comment'),
                'ip' => $request->ip(),
                'url' => $request->input('current_url')
            ];
        }

        $comment = $advert->comments()->create($data);
        $this->is_notify($request,$comment);
        return $comment;



    }

    public function up_vote(Request $request){

        $comment = Comment::find($request->id);

        if (Auth::user()){
            if (!Auth::user()->hasDownVoted($comment)) {
                if(!$comment->isVotedBy(Auth::user())){
                    Auth::user()->upVote($comment);
                    $user = User::find($comment->user->id);
                    $user->notify(new LikedNotification($comment));
                }
            }
        }

        return $comment->upVoters()->count();

    }


    public function down_vote(Request $request){

        $comment = Comment::find($request->id);

        if (Auth::user()){
            if (!Auth::user()->hasUpVoted($comment)) {
                if(!$comment->isVotedBy(Auth::user())){
                    Auth::user()->downVote($comment);
                    $user = User::find($comment->user->id);
                    $user->notify(new LikedNotification($comment));

                }
            }
        }

        return $comment->downVoters()->count();


    }


}
