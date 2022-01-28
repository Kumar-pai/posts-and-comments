<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Posts;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        return response($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $params =  $request->only([
            'title',
            'content',
        ]);

        $params['uuid'] = Str::uuid(45);

        $posts = Posts::create($params);

        return response($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        $posts->load('comments');

        return response($posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string',
            'content' => 'sometimes|required|string'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $params =  $request->only([
            'title',
            'content',
        ]);

        $posts->update($params);

        return response($posts);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Posts $posts)
    {
        $posts->comments()->delete();
        $posts->delete();

        return response(['message' => 'success delete']);
    }
}
