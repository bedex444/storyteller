<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = auth()->user();

        return view('profile', ['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'current_password' => 'sometimes',
            'password' => 'required_with:current_password|confirmed'
        ], [
            'name.required' => 'Name is rquired',
            'email.required' => 'Email is rquired',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match'
        ]);

        $user = User::find(auth()->user()->id);

        $updateData = [
            'name' => $request->input('name')
        ];

        if (!is_null($request->password)) {
            if (!hash_equals($user->password, $request->password)) {
                return back()->with('error', 'Current password not valid');
            }

            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return to_route('profile.edit')->with('success', 'Profile updated successfully');
    }
}
