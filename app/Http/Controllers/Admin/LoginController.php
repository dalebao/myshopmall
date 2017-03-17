<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirect = '/admin/info';


    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
        $this->username = 'email';
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }


}