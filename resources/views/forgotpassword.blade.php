@extends('layouts.master')
@section('page_title', 'SHS Career Guidance System')

@section('page_content')
    <div class="container mt-5 pt-4">

        @if(!Session::has('validate_username') && !Session::has('validate_securityQA') && !Session::has('done_reset'))

            {{-- First Step --}}
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 card_signIn px-5 py-5">
                    <h2>Forgot Password</h2>
                    <span class="text-secondary">Please enter your account username.</span>
                    <div class="card mb-3 bg-light errorAlert mt-3" id="verifyUsername_error_msg" style="display: none">
                        <div class="card-body">
                            <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                            <span>
                                <!-- error message here -->
                            </span>
                        </div>
                    </div>
                    <div class="card my-2" id="verifyUsername_loading" style="display: none">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                            <span class="ml-2">
                                <!-- success message here -->
                                Please wait...
                            </span>
                        </div>
                    </div>
                    <input type="text" class="form-control form-control-lg mt-3" placeholder="Username" value="" id="txtusername">

                    <center>
                        <button type="button" class="btn btn-primary mt-5" id="btnContinue">Continue</button>
                    </center>
                </div>
                <div class="col-sm-2"></div>
            </div>

        @elseif(Session::has('validate_username') && !Session::has('validate_securityQA') && !Session::has('done_reset'))

            {{-- Second Step --}}
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 card_signIn px-5 py-5">
                    <h2>Security Question Verification</h2>
                    <span class="text-secondary">Please answer the question below to reset your password.</span>

                    <h5 class="font-weight-bold mt-4" id="h5_securityQuestion">{{ $validateUsername->sec_ques }}</h5>
                    <div class="card mb-2 bg-light errorAlert mt-3" id="securityQuestion_error_msg" style="display: none">
                        <div class="card-body">
                            <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                            <span>
                                <!-- error message here -->
                            </span>
                        </div>
                    </div>
                    <div class="card my-1" id="securityQuestion_loading" style="display: none">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                            <span class="ml-2">
                                <!-- success message here -->
                                Please wait...
                            </span>
                        </div>
                    </div>
                    <input type="text" class="form-control form-control-lg mt-2" value="" id="txtsecurity_answer">

                    <center>
                        <button type="button" class="btn btn-primary mt-5 px-4" id="btnVerify">Verify</button>
                    </center>
                </div>
                <div class="col-sm-2"></div>
            </div>

        @elseif(Session::has('validate_username') && Session::has('validate_securityQA') && !Session::has('done_reset'))

            {{-- Third Step --}}
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 card_signIn px-5 py-5">
                    <h2>Reset Your Password</h2>
                    <p class="text-secondary">Enter your new password</p>
                    <div class="card mb-3 bg-light errorAlert mt-3" id="resetPassword_error_msg" style="display: none">
                        <div class="card-body">
                            <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                            <span>
                                <!-- error message here -->
                            </span>
                        </div>
                    </div>
                    <div class="card" id="resetPassword_loading" style="display: none">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                            <span class="ml-2">
                                <!-- success message here -->
                                Please wait...
                            </span>
                        </div>
                    </div>
                    <label class="mt-1" for="txt_fname_a">New Password</label>
                    <input type="password" class="form-control form-control-lg" id="txt_newpassword" autocomplete="off" value="">
                    <br>
                    <label for="txt_fname_a">Confirm New Password</label>
                    <input type="password" class="form-control form-control-lg" id="txt_confpassword" autocomplete="off" value="">

                    <center>
                        <button type="button" class="btn btn-primary mt-5" id="btnReset">Reset Password</button>
                    </center>
                </div>
                <div class="col-sm-2"></div>
            </div>
        @elseif(Session::has('validate_username') && Session::has('validate_securityQA') && Session::has('done_reset'))
            
            {{-- Done --}}
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 card_signIn px-5 py-5">
                    <h2 class="text-success font-weight-bold">Success</h2>
                    <p class="text-secondary">Your password has been successfully reset.</p>

                    <center>
                        <button type="button" class="btn btn-primary mt-3 px-4" id="btnDone">Done</button>
                    </center>
                </div>
                <div class="col-sm-2"></div>
            </div>

        @endif

    </div>

@stop

@section('page_scripts')
    <script>
        $(document).ready(function(){

        });

        $("#btnContinue").click(function(){
            loading("show", $("div#verifyUsername_loading"));
            let username = $("#txtusername");
            if(username.val() == "")
            {
                loading("hide", $("div#verifyUsername_loading"));
                username.addClass("is-invalid");
                error(true, "Username is required", $("#verifyUsername_error_msg div span"), $("#verifyUsername_error_msg"));
            }
            else
            {
                username.removeClass("is-invalid");
                error(false, "", $("#verifyUsername_error_msg div span"), $("#verifyUsername_error_msg"));
                
                $.ajax({
                    url : "{{ route('username.verify.forgotPass') }}",
                    method : "post",
                    data : {
                        username : username.val()
                    },
                    dataType : "json",
                    success : function(data)
                    {
                        loading("hide", $("div#verifyUsername_loading"));
                        if(data.status == true && data.message == "valid")
                        {
                            location.reload();
                        }
                        else if(data.status == true && data.message == "unset")
                        {
                            error(true, "There is no security question and answer setup yet", $("#verifyUsername_error_msg div span"), $("#verifyUsername_error_msg"));
                        }
                        else if(data.status == true && data.message == "invalid")
                        {
                            error(true, "The username you provided is invalid", $("#verifyUsername_error_msg div span"), $("#verifyUsername_error_msg"));
                        }
                    },
                    error : function(err)
                    {
                        console.log(err);
                    }
                });
            }
        });

        $("#btnVerify").click(function(){
            loading("show", $("div#securityQuestion_loading"));
            
            let security_answer = $("#txtsecurity_answer");
            let security_question = $("#h5_securityQuestion");

            if(security_answer.val() == "")
            {
                security_answer.addClass("is-invalid");
                loading("hide", $("div#securityQuestion_loading"));
                error(true, "Security answer is required", $("#securityQuestion_error_msg div span"), $("#securityQuestion_error_msg"));
            }
            else
            {
                security_answer.removeClass("is-invalid");
                error(false, "", $("#securityQuestion_error_msg div span"), $("#securityQuestion_error_msg"));
                $.ajax({
                    url : "{{ route('securityQA.verify.forgotPass') }}",
                    method : "post",
                    data : {
                        s_answer : security_answer.val(),
                        s_question : security_question.text()
                    },
                    dataType : "json",
                    success : function(data)
                    {
                        loading("hide", $("div#securityQuestion_loading"));
                        if(data.status == true && data.message == "correct")
                        {
                            location.reload();
                        }
                        else
                        {
                            error(true, "Security answer you provided is incorrect", $("#securityQuestion_error_msg div span"), $("#securityQuestion_error_msg"));
                        }
                    },
                    error : function(err)
                    {
                        console.log(err);
                    }
                });
            }
        });

        $("#btnReset").click(function(){
            loading("show", $("div#resetPassword_loading"));
            let newPassword = $("#txt_newpassword");
            let confPassword = $("#txt_confpassword");
            
            if(!validateField(newPassword) || !validateField(confPassword))
            {
                loading("hide", $("div#resetPassword_loading"));
                error(true, "Please make sure the fields are not empty", $("#resetPassword_error_msg div span"), $("#resetPassword_error_msg"));
            }
            else
            {
                if(newPassword.val() != confPassword.val())
                {
                    loading("hide", $("div#resetPassword_loading"));
                    errorFieldReset(newPassword, confPassword, "invalid");
                    error(true, "Passwords does not match", $("#resetPassword_error_msg div span"), $("#resetPassword_error_msg"));
                }
                else
                {
                    errorFieldReset(newPassword, confPassword, "valid");
                    error(false, "", $("#resetPassword_error_msg div span"), $("#resetPassword_error_msg"));
                    
                    $.ajax({
                        url : "{{ route('reset.password.forgotPass') }}",
                        method : "post",
                        data : {
                            newPassword : newPassword.val(),
                            user_id : "{{ Session::get('validate_username') }}"
                        },
                        dataType : "json",
                        success : function(data)
                        {
                            loading("hide", $("div#resetPassword_loading"));
                            if(data.status == true && data.message == "reset")
                            {
                                location.reload();
                            }
                        },
                        error : function(err)
                        {
                            console.log(err);
                        }
                    });
                }
            }
        });

        $("#btnDone").click(function(){
            window.location = "{{ route('signin') }}";
        });
        
        //region script_functions

            function errorFieldReset(pass, confpass, state)
            {
                if(state == "invalid")
                {
                    pass.addClass("is-invalid");
                    confpass.addClass("is-invalid");
                }
                else
                {
                    pass.removeClass("is-invalid");
                    confpass.removeClass("is-invalid");
                }
            }
            function validateField(field)
            {
                if(field.val() == "")
                {
                    field.addClass("is-invalid");
                    return false;
                }
                else
                {
                    field.removeClass("is-invalid");
                    return true;
                }
            }

            function error(isVisible, text = "", errAlert, errMsg)
            {
                if(isVisible == true)
                {
                    errAlert.text(text);
                    errMsg.show();
                }
                else
                {
                    errAlert.text(text);
                    errMsg.hide();
                }
            }

            function loading(action, loading)
            {
                if(action == "show")
                {
                    loading.show();
                }
                else
                {
                    loading.hide();
                }
            }
        //endregion script_functions
    </script>  
@stop
