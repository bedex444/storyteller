<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::mine()->with('story')->get();

        return view('comments.index', [
            'data' => $comments
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::mine()->with('story')->find($id);

        return view('comments.show', ['data' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        $user = auth()->user();

        $this->validate($request, [
            'comment' => 'required'
        ], [
            'comment.required' => 'Enter your response'
        ]);

        $parent = Comment::findOrFail($id);

        Comment::create([
            'name' => $user->name,
            'comment' => $request->comment,
            'parent_id' => $id,
            'story_id' => $parent->id
        ]);

        return back()->with('success', 'Response submitted');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return to_route('comments.index')->with('success', 'Comment deleted');
    }
}
