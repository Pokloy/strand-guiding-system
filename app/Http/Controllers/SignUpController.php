<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    function loadSignUpPage()
    {
        return view('signup');
    }
}
