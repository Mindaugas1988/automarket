<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        //
        $topics = ForumTopic::get();

        return view('forum',compact('topics'));
    }

    public function my_topics()
    {
        //
        return view('sign.my-topics');
    }

    public function categories()
    {
        //
        return view('forum-categories');
    }

    public function single()
    {
        //
        return view('forum-single');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Forum::create([
            'user_id' => Auth::id(),
            'category_id' => $request->input('id'),
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        return redirect()->back()->with('success', trans('custom.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mumis = new Theme;
        return response()-> view('sign.topic-edit',compact('id','mumis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        //
    }
}
