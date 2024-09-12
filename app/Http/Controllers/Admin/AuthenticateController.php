<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRequest\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{

    public function login()
    {
        return view('admin.authenticate.login');
    }

    public function postLogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($arr))
        {
            return redirect('/');
        }
        else
        {
            return redirect()->back()->with('error', 'Email or password is incorrect!');
        }
    }

    public function register()
    {
        return view('admin.authenticate.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $arr = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ];
        $user = User::create($arr);
        Auth::attempt(['email' => $arr['email'], 'password' => $request->password]);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
