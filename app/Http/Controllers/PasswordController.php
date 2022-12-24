<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('password.edit');
    }

    public function update(UpdatePasswordRequest $request)
{
    $request->user()->update([
        'password' => Hash::make($request->get('password'))
    ]);

    return redirect()->route('user.password.edit')->with('success', 'Password Berhasil Diperbarui');
}
}
