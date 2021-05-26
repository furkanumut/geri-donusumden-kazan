<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'iban_number' => ['min:20', 'max:32'],
        ]);

        if (!empty($request->input('password'))) {
            $request->validate([
                'password' => ['min:8'],
            ]);
        }
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');

        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->iban_number = $request->input('iban_number');
        $user->save();
        return view('profile', compact('user'));
    }
}
