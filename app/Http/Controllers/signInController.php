<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // for encrypting the userpassword

/*
    Controllers
*/

/*
    Requests
*/
use App\Http\Requests\SignInRequest;
use App\Http\Requests\AdminRegisterRequest;

/*
    Models
*/
use App\Models\UserModel;

class signInController extends Controller
{
    function loadSignInpage()
    {
        // pull all the session data from forgot password
        session()->pull('validate_username');
        session()->pull('validate_securityQA');
        session()->pull('done_reset');

        $admin_count = UserModel::where('utype', "admin")
                                ->where('status', 'Active')
                                ->get()->count();
        if($admin_count == 0 )
        {
            session()->put('unregistered', 1);
        }
        return view('signIn', compact('admin_count'));
    }

    function signInUser(SignInRequest $r)
    {
        $username = $r->input_username;
        $password = $r->input_password;

        //validate user
        $user = UserModel::where('uname', $username)
                         ->where('status', 'Active')->first();
        if($user)
        {
            $pass = Hash::check($r->input_password, $user->pass);
            if($user == true && $pass == true)
            {
                session()->put('user_id', $user->user_id);
                session()->put('utype', $user->utype);
                return redirect('/home');
            }
            else
            {
                return back()->with('not_valid','Invalid Username or Password');
            }
        }
        else
        {
            return back()->with('not_valid','Invalid Username or Password');
        }
    }

    function adminRegister(AdminRegisterRequest $r)
    {
        $user = new UserModel;
        $user->fname = $r->input_firstname;
        $user->mname = $r->input_middlename;
        $user->lname = $r->input_lastname;
        $user->uname = "user-01";
        $user->pass = Hash::make("user-01");
        $user->utype = "admin";
        $user->status = "Active";
        $save_user = $user->save();

        if($save_user)
        {
            session()->put('registered', 1);
            session()->pull('unregistered');
            return redirect('/signIn');
        }
        else
        {
            return "Error: Saving first account failed.";
        }
    }

    function removeRegister_session()
    {
        session()->pull('registered');
        if(!session()->has('registered'))
        {
            return redirect('/signIn');
        }
    }

    function logout()
    {
        if(session()->has('user_id') && session()->has('utype'))
        {
            session()->pull('user_id');
            session()->pull('utype');
            return redirect('/signIn')->with('loggedout', 'You have been successfully logged out');
        }
    }
}
