<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\ForumTopic;
use App\ForumCategory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.index');
    }

    public function articles()
    {
        //
        return view('dashboard.articles');
    }

    public function forum()
    {
        //
        $topics = ForumTopic::select('id','value')->get();
        return view('dashboard.forum',compact('topics'));
    }

    public function create_topic(Request $request){

        $validator = Validator::make($request->only('value'),['value' => 'required|unique:forum_topics|max:255']);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator,'topic')
                ->withInput();
        }
        ForumTopic::create(
         ['value' => $request->input('value')]
        );

        return redirect()->back()->with('topic.success', trans('custom.success_store'));


    }

    public function create_category(Request $request){

        $array = [
            'topic_id' => 'required',
            'value' => 'required|unique:forum_topics|max:255'

        ];

        $validator = Validator::make($request->only('topic_id','value'),$array);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator,'category')
                ->withInput();
        }

        ForumCategory::create(
            [
                'topic_id' => $request->input('topic_id'),
                'value' => $request->input('value')
            ]
        );

        return redirect()->back()->with('category.success', trans('custom.success_store'));


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
