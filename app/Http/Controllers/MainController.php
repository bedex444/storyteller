<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Story;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $stories = Story::all();
        return view('welcome', compact('stories'));
    }

    public function stories(Request $request)
    {
        $filter = $request->query('region');
        $stories = $filter ? Story::where('region', $filter)->get() : Story::all();
        return view('stories', ['stories' => $stories]);
    }

    public function story($id)
    {
        $story = Story::with('comments')->findOrFail($id);

        return view('story', ['story' => $story]);
    }

    public function comment(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required'
        ], [
            'name.required' => 'Enter your name',
            'comment.required' => 'Enter your comment'
        ]);

        Comment::create([
            'story_id' => $id,
            'name' => $request->name,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Comment submitted');
    }
}
