<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $stories = Story::all();
        return view('welcome', compact('stories'));
    }
}
