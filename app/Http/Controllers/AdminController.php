<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::isAdmin()->get();

        return view('admins.index', [
            'data' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'status' => 'required',
        ], [
            'name.required' => 'Name is rquired',
            'email.required' => 'Email is rquired',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'status' => 'Status is required',
        ]);

        $destination = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => $request->input('status'),
            'role' => 'admin'
        ]);

        return to_route('admins.index')->with('action.success', 'Admin added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::isAdmin()->find($id);
        return view('admins.show', ['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  User::isAdmin()->find($id);
        return view('admins.edit', ['data' => $user]);
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
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'sometimes|confirmed',
            'status' => 'required',
        ], [
            'name.required' => 'Name is rquired',
            'email.required' => 'Email is rquired',
            'email.unique' => 'Email already exists',
            'password.sometimes' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'status' => 'Status is required',
        ]);

        $user = User::isAdmin()->findOrFail($id);

        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'status' => $request->input('status')
        ];

        if (!is_null($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return to_route('admins.index')->with('action.success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::isAdmin()->findOrFail($id);

        $user->delete();

        return to_route('admins.index')->with('action.success', 'Admin deleted');
    }
}
