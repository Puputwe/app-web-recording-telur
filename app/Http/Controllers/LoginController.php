<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    public function halamanlogin(){
        
        return view('login.login');
    }
     
    public function postlogin(Request $request)
    {
           
        $email = $request->email;
        $password = $request->password;
        
        if (Auth::Attempt(['email'=>$email, 'password'=>$password, 'status'=>'aktif']))
        {
        return redirect('/dashboard')->with('success', 'Anda Berhasil Login..');
        }elseif (Auth::Attempt(['email'=>$email, 'password'=>$password, 'status'=>'non-aktif']))
        {
        return redirect('/login')->with('warwar', 'Akun anda blum aktif, Silakan hubungi Admin');
        }
        else
        {
         return redirect('/login')->with('error', ' Gagal Login, email dan password Tidak Sesuai !!');
        }
        
    }

    public function register(){

        $role = Role::all();
        return view('login.register', compact('role'));
    }

    public function postregister(Request $request)
    {

        $request->validate([
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ], [
            'email.required' => 'Email sudah terdaftar',
            'password.required' => 'Password minimal 8 karakter'
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role_id'   => $request->role_id,
            'status'    => 'non-aktif',
            'remember_token'  => Str::random(60),
            'created_at'=> $request->created_at,
            'updated_at'=> $request->updated_at,
        ]);
        return redirect('/login')->with('toast_success', 'Registrasi Berhasil !!');
    }

    public function logout(Request $request){
        Auth::logout();

        request()->session()->invalidate();

        return redirect('/');
    }
}