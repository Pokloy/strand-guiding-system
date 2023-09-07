<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // for encrypting the userpassword

/*
    Requests
*/


/*
    Models
*/
use App\Models\UserModel;

class UserController extends Controller
{
    function loaduserspage()
    {
        $users = UserModel::all();
        return view('pages.assessor.users', compact('users'));
    }

    function loadAccountSettings()
    {
        $current_user = $this->getCurrentUser();
        return view('pages.assessor.account_settings', compact('current_user'));
    }

    function loadSecuritySettings()
    {
        $current_user = $this->getCurrentUser();
        return view('pages.assessor.security_settings', compact('current_user'));
    }

    function loadForgotPassword()
    {
        if(session()->has('validate_username') && !session()->has('validate_securityQA'))
        {
            $validateUsername = UserModel::where("user_id", session()->get('validate_username'))->first();
            return view('forgotpassword', compact('validateUsername'));
        }
        else
        {
            return view('forgotpassword');
        }
    }

    function getCurrentUser()
    {
        $current_user_id = session()->get('user_id');
        $current_user = UserModel::where('user_id', $current_user_id)->first();
        return $current_user;
    }

    function addDummyUser()
    {
        $user = new UserModel;
        $user->fname = "Cariel Jay";
        $user->mname = "Barangan";
        $user->lname = "Apao";
        $user->uname = "user-01";
        $user->pass = Hash::make("user-01");
        $user->utype = "admin";
        $save_user = $user->save();

        if($save_user)
        {
            return "saved";
        }
        else
        {
           return "not saved";
        }
    }

    function getLast_UserId()
    {
        $last_user = UserModel::all()->sortDesc()->first();

        if($last_user)
        {
            $new_acc_id = (int)$last_user->user_id + 1;
            $acc = (string)$new_acc_id;
            $acc = strlen($acc) == 1 ? "user-0".$new_acc_id : "user-".$new_acc_id;
            
            return response()->json([
                'status' => true,
                'message' => 'got',
                'new_account' => $acc 
            ]);  
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Generating new account failed'
            ]);  
        }        
    }

    function addUser(Request $r)
    {
        $user = new UserModel;
        $user->fname = $r->fname;
        $user->mname = $r->mname;
        $user->lname = $r->lname;
        $user->uname = $r->uname;
        $user->pass = Hash::make($r->pass);
        $user->utype = $r->utype;
        $save_user = $user->save();

        if($save_user)
        {
            return response()->json([
                'status' => true,
                'message' => 'saved',
            ]);
        }
        else
        {
            return response()->json([
                'status' => true,
                'message' => 'unsaved',
            ]);
        }
    }

    function fetchUser(Request $r)
    {
        $user_id = $r->userid;
        $user_details = UserModel::where('user_id', $user_id)->first();

        if($user_details)
        {
            return response()->json([
                'status' => true,
                'message' => 'fetched',
                'details' => $user_details
            ]);
        }
        else
        {
            return response()->json([
                'status' => true,
                'message' => 'unfetch',
            ]);
        }
    }

    function updateUser(Request $r)
    {
        $user = UserModel::where('user_id', $r->user_id);
        $save = $user->update(
            [
                'fname' => $r->fname,
                'mname' => $r->mname,
                'lname' => $r->lname,
                'utype' => $r->utype,
                'status' => $r->status
            ]
        );

        if($save)
        {
            return response()->json([
                'status' => true,
                'message' => 'updated'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Updating strand details failed'
            ]);
        }
    }

    function updateAccount(Request $r)
    {
        $uname = $r->uname;
        $current_password = $r->curr_pass;
        $new_password = $r->new_pass;

        // get account
        $account = UserModel::where('uname', $uname)->first();

        if($account)
        {
            // validate password
            $acc_pass = Hash::check($current_password, $account->pass);

            if($acc_pass)
            {
                if($new_password == "")
                {
                    $user_acc = UserModel::where('user_id', $account->user_id);
                    $save = $user_acc->update(
                        [
                            'fname' => $r->fname,
                            'mname' => $r->mname,
                            'lname' => $r->lname
                        ]
                    );

                    if($save)
                    {
                        return response()->json([
                            'status' => true,
                            'message' => 'updated'
                        ]);
                    }
                }
                else
                {
                    $user_acc = UserModel::where('user_id', $account->user_id);
                    $save = $user_acc->update(
                        [
                            'fname' => $r->fname,
                            'mname' => $r->mname,
                            'lname' => $r->lname,
                            'pass' => Hash::make($new_password)
                        ]
                    );

                    if($save)
                    {
                        return response()->json([
                            'status' => true,
                            'message' => 'updated'
                        ]);
                    }
                }
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => 'incorrect_password'
                ]);
            }
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Error: Invalid Account!'
            ]);
        }
    }

    function setupSecurity(Request $r)
    {
        $current_user_id = session()->get('user_id');
        $current_user = UserModel::where('user_id', $current_user_id);

        $setUp = $current_user->update(
            [
                'sec_ques' => $r->question,
                'sec_ans' => strtolower($r->answer),
            ]
        );

        if($setUp)
        {
            return response()->json([
                'status' => true,
                'message' => 'setup'
            ]);
        }
    }

    function validateUsernameForgotPass(Request $r)
    {
        $username = $r->username;
        $verifyUsername = UserModel::where("uname", $username)->get();
        $count = $verifyUsername->count();

        if($count == 1)
        {
            if($verifyUsername[0]['sec_ques'] == "" && $verifyUsername[0]['sec_ans'] == "")
            {
                return response()->json([
                    'status' => true,
                    'message' => 'unset'
                ]);
            }
            else 
            {
                session()->put('validate_username', $verifyUsername[0]['user_id']);
                return response()->json([
                    'status' => true,
                    'message' => 'valid'
                ]);
            }
        }
        else if($count == null)
        {
            return response()->json([
                'status' => true,
                'message' => 'invalid',
            ]);
        }
    }

    function verifySecurityQA(Request $r)
    {
        $s_question = $r->s_question;
        $s_answer = strtolower($r->s_answer);
        $user_id = session()->get('validate_username');

        $verifyUsername = UserModel::where("user_id", $user_id)
                                   ->where("sec_ques", $s_question)
                                   ->where("sec_ans", $s_answer);

        $verified = $verifyUsername->get()->count();
        
        if($verified == 1)
        {
            session()->put('validate_securityQA', 1);
            return response()->json([
                'status' => true,
                'message' => 'correct',
            ]);
        }
        else if($verified == null)
        {
            return response()->json([
                'status' => true,
                'message' => 'incorrect',
            ]);
        }
    }

    function resetPassword(Request $r)
    {
        $user_id = $r->user_id;
        $newPassword = $r->newPassword;

        $userAccount = UserModel::where("user_id", $user_id);
        $resetPassword = $userAccount->update(
            [
                'pass' => Hash::make($newPassword)
            ]
        );

        if($resetPassword)
        {
            session()->put('done_reset', 1);
            return response()->json([
                'status' => true,
                'message' => 'reset'
            ]);
        }
    }




}
