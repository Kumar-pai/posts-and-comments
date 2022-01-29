<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Posts;
use App\Repositories\CommentsRepository;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Posts $posts)
    {
        return response($posts->comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Posts $posts)
    {
        $validator = Validator::make($request->all(), [
            'messages' => 'required',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $params = $request->only([
            'messages',
        ]);

        $posts->comments()->create($params);

        $posts->load('comments');

        return response($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Posts $posts, CommentsRepository $comments)
    {
        return response($comments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts, CommentsRepository $comments)
    {
        $validator = Validator::make($request->all(), [
            'messages' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $params = $request->only([
            'messages',
        ]);

        $comments->update($params);

        return response($comments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Posts $posts, CommentsRepository $comments)
    {
        $comments->delete();

        return response(['message' => 'success delete']);
    }
}
