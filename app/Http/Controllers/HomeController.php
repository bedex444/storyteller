<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Story;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $isAdmin = auth()->user()->is_admin;

        $data = [];

        if ($isAdmin) {
            $users = User::where('is_admin', false)->count();

            $data['users'] = $users;
        }

        $data['stories'] = Story::count();

        return view('home', $data);
    }
}
