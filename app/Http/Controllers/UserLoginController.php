<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    //
    public function showLoginForm(Request $request)
    {
    
        return view('frontend.pages.login.login-form');
    }
}
