<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::mine()->get();

        return view('stories.index', [
            'data' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required',
            'region' => 'required',
            'story' => 'required',
            'cover' => 'required|file|mimetypes:image/*',
            'pictures.*' => 'required|file|mimetypes:image/*'
        ], [
            'location_name.required' => 'Location name is rquired',
            'region' => 'Region is required',
            'story' => 'Story is required',
            'cover.*.required' => 'Please upload an image',
            'cover.*.mimetypes' => 'Only image files are allowed',
            'pictures.*.required' => 'Please upload an image',
            'pictures.*.mimetypes' => 'Only image files are allowed',
        ]);

        $cover = $request->file('cover');
        $pictures = $request->file('pictures');
        $filePaths = [];

        if ($cover) {
            $coverPath = 'public/stories/'.date('Y-m-d');
            $fileName = time() . "." . $cover->getClientOriginalExtension();
            $stored = $cover->storeAs($coverPath, $fileName);

            $cover = $stored;
        }

        foreach($pictures  as $image) {
            $destinationPath = 'public/stories/'.date('Y-m-d');
            $fileName = now() . "." . $image->getClientOriginalExtension();
            $stored = $image->storeAs($destinationPath, $fileName);

            $filePaths[] = $stored;
        }

        $destination = Story::create([
            'location_name' => $request->input('location_name'),
            'region' => $request->input('region'),
            'story' => $request->input('story'),
            'cover' => $cover,
            'pictures' => json_encode($filePaths),
            'user_id' => auth()->id()
        ]);

        return to_route('stories.index')->with('success', 'Story created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story =  Story::mine()->find($id);

        $pictures = collect(json_decode($story->pictures));

        $files = [];
        $pictures->each(function ($image) use (&$files) {
            $file = Storage::url($image);
            $files[] = [
                'path' => $image,
                'url' => $file,
                'name' => basename($image)
            ];
        });

        $cover = Storage::url($story->cover);
        $story->cover = [
            'path' => $story->cover,
            'url' => $cover,
            'name' => basename($story->cover)
        ];

        return view('stories.show', ['data' => $story, 'files' => $files]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $story = Story::mine()->findOrFail($id);

        $pictures = collect(json_decode($story->pictures));

        $files = [];
        $pictures->each(function ($image) use (&$files) {
            $file = Storage::url($image);
            $files[] = [
                'path' => $image,
                'url' => $file,
                'name' => basename($image)
            ];
        });

        $cover = Storage::url($story->cover);
        $story->cover = [
            'path' => $story->cover,
            'url' => $cover,
            'name' => basename($story->cover)
        ];

        return view('stories.edit', ['data' => $story, 'files' => $files]);
    }

    public function remove_file($id, $file)
    {
        $story = Story::findOrFail($id);

        $pictures = json_decode($story->pictures);
        $files = [];

        foreach($pictures as $image) {
            if (basename($image) === $file) {
                Storage::delete($image);
            } else {
                $files[] = $image;
            }
        }

        $story->update([
            'pictures' =>  json_encode($files)
        ]);

        return back()->with('success', 'Story picture deleted');
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
        $this->validate($request, [
            'location_name' => 'required',
            'region' => 'required',
            'story' => 'required',
            'pictures.*' => 'sometimes|file|mimetypes:image/*'
        ], [
            'location_name.required' => 'Location name is rquired',
            'region' => 'Region is required',
            'story' => 'Story is required',
            'cover.*.required' => 'Please upload an image',
            'cover.*.mimetypes' => 'Only image files are allowed',
            'pictures.*.required' => 'Please upload an image',
            'pictures.*.mimetypes' => 'Only image files are allowed',
        ]);

        $user = auth()->user();

        $story = Story::mine()->findOrFail($id);

        $uploaded_pictures = json_decode($story->pictures);

        $cover = $request->file('cover');
        $pictures = $request->file('pictures') ?? [];
        $files = [];

        if ($cover) {
            $coverPath = 'public/stories/'.date('Y-m-d');
            $fileName = now() . "." . $cover->getClientOriginalExtension();
            $stored = $cover->storeAs($coverPath, $fileName);

            $cover = $stored;
        }

        foreach($pictures  as $image) {
            $destinationPath = 'public/stories/'.date('Y-m-d');
            $fileName = now() . "." . $image->getClientOriginalExtension();
            $stored = $image->storeAs($destinationPath, $fileName);

            $files[] = $stored;
        }

        $story = $story->update([
            'location_name' => $request->input('location_name'),
            'region' => $request->input('region'),
            'story' => $request->input('story'),
            'cover' => $cover ? $cover : $story->cover,
            'pictures' => json_encode(array_merge($uploaded_pictures, $files))
        ]);

        return to_route('stories.index')->with('success', 'Story updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $story = Story::isMine($user)->findOrFail($id);

        if (Storage::exists($story->cover)) {
            Storage::delete($story->cover);
        }

        $images = json_decode($story->images);

        foreach($images as $image) {
            if (Storage::exists($image)) {
                Storage::delete($image);
            }
        }

        $story->delete();

        return to_route('stories.index')->with('success', 'Story deleted');
    }
}
