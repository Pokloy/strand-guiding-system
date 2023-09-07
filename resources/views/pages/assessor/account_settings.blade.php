@extends('layouts.assessor.master')
@section('page_styles')

@stop
@section('title', 'Settings')

@section('page_content')

    <div class="container">
        <div class="row py-3 px-4 mt-3">
            <div class="col-sm-12">
                <h3>Account Settings</h3>
                <small class="text-secondary">Change your profile and account settings</small>
            </div>
        </div>
        @if($current_user->sec_ques == "" || $current_user->sec_ans == "")

            <div class="row px-3">
                <div class="col-sm-12">
                    <div class="card mb-3 bg-light warningAlert">
                        <div class="card-body">
                            <i class="fas fa-exclamation-circle mr-2 text-warning"></i>
                            <span>
                                <span class="font-weight-bold">Warning: </span>
                                <span>Our system has noticed that you haven't set up your security question and answer. As soon as possible, this needs to be addressed.</span>
                                <span class="text-primary underline_text" id="span_goto_securitySettings">Click here</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="row card_accountSettings pt-5 pb-5 px-4 mx-3">
            
            <div class="col-sm-12 mb-2">

                <div class="card mb-3 bg-light errorAlert" id="error_msg" style="display: none">
                    <div class="card-body">
                        <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                        <span>
                            <!-- error message here -->
                        </span>
                    </div>
                </div>

                <div class="card mb-2 bg-light successAlert" id="success_msg" style="display: none">
                    <div class="card-body">
                        <i class="fas fa-check-circle mr-2 text-success"></i>
                        <span>
                            <!-- success message here -->
                        </span>
                    </div>
                </div>

                <div class="card mb-2" id="updateAccount_loading" style="display: none">
                    <div class="card-body">
                        <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                        <span class="ml-2">
                            <!-- success message here -->
                            Please wait...
                        </span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 mb-2">
                <span class="text-secondary" style="font-size: 16px"><i class="fas fa-user"></i>&nbsp;&nbsp;Profile Settings</span>
            </div>
            <input type="hidden" value="{{ $current_user->user_id }}" id="txt_user_id">
            <div class="col-sm-4 mt-2">
                <div class="form-group">
                    <label for="txt_fname_a">First Name</label>
                    <input type="text" class="form-control form-control-lg" id="txt_fname" autocomplete="off" value="{{ $current_user->fname }}">
                </div>
            </div>
            <div class="col-sm-4 mt-2">
                <div class="form-group">
                    <label for="txt_fname_a">Middle Name</label>
                    <input type="text" class="form-control form-control-lg" id="txt_mname" autocomplete="off" value="{{ $current_user->mname }}">
                </div>
            </div>
            <div class="col-sm-4 mt-2">
                <div class="form-group">
                    <label for="txt_fname_a">Last Name</label>
                    <input type="text" class="form-control form-control-lg" id="txt_lname" autocomplete="off" value="{{ $current_user->lname }}">
                </div>
            </div>

            <div class="col-sm-12 mt-3 mb-2">
                <span class="text-secondary" style="font-size: 16px"><i class="fas fa-lock"></i>&nbsp;&nbsp;Account Settings</span>
            </div>

            <div class="col-sm-4 mt-2">
                <div class="form-group">
                    <label for="txt_fname_a">Username</label>
                    <input type="text" class="form-control form-control-lg" id="txt_uname" autocomplete="off" value="{{ $current_user->uname }}" disabled>
                </div>
            </div>

            <div class="col-sm-4 mt-2" id="div_password_cu">
                <div class="form-group">
                    <label for="txt_fname_a">Password</label>
                    <input type="password" class="form-control form-control-lg" id="txt_currentpassword" autocomplete="off" value="">
                    <small id="passwordHelp" class="form-text text-muted">To continue updating your account, kindly provide your password.</small>
                </div>
            </div>

            <div class="col-sm-4 mt-2 py-5">
                <span class="text-primary underline_text" id="span_change_password">Change Password</span>
            </div>

            <div class="col-sm-4 mt-2 d_none" id="div_password_new">
                <div class="form-group">
                    <label for="txt_fname_a">New Password</label>
                    <input type="password" class="form-control form-control-lg" id="txt_newpassword" autocomplete="off" value="">
                </div>
            </div>
            <div class="col-sm-4 mt-2 d_none" id="div_password_conf">
                <div class="form-group">
                    <label for="txt_fname_a">Confirm New Password</label>
                    <input type="password" class="form-control form-control-lg" id="txt_confpassword" autocomplete="off" value="">
                </div>
            </div>
            <div class="col-sm-4 mt-2"></div>

            <div class="col-sm-12 mt-3">
                <button type="button" class="btn btn-primary btn_round px-5 py-2" style="border-radius: 30px" id="btn_saveChanges"><span class="mx-2">&nbsp;Save&nbsp;</span></button>
                {{-- <button type="button" class="btn btn-outline-secondary btn_round px-5" style="border-radius: 30px">Cancel</button> --}}
            </div>

        </div>

    </div>
@stop

@section('page_scripts')

<script>
    $(document).ready(function(){
        
        $("div#error_msg").hide();
        $("div#success_msg").hide();
        $("div#updateAccount_loading").hide();

        $("#txt_currentpassword").focus();
    });

    var u_fields = {
        u : {
            fname : $("#txt_fname"),
            mname : $("#txt_mname"),
            lname : $("#txt_lname"),
            uname : $("#txt_uname"),
            curr_pass : $("#txt_currentpassword"),
            new_pass : $("#txt_newpassword"),
            conf_pass : $("#txt_confpassword")
        }
    }

    var alerts = {
        u : {
            err : $("div#error_msg div span"),
            suc :  $("div#success_msg div span")
        }
    }

    var is_pass_included = false;

    $("#span_change_password").click(function()
    {
        if($(this).text() == "Change Password")
        {
            $(this).text("Cancel");
            is_pass_included = true;
        }
        else
        {
            $(this).text("Change Password")
            is_pass_included = false;
        }

        $("div#div_password_new").toggleClass("d_none");
        $("div#div_password_conf").toggleClass("d_none");

        $("#txt_currentpassword").focus();
    });

    $("#btn_saveChanges").click(function(){
        loading("show");
        // check if the password will be included
        let is_validated = false;
        if(is_pass_included)
        {
            if(
                !validate(u_fields.u.fname) ||
                !validate(u_fields.u.mname) ||
                !validate(u_fields.u.lname) ||
                !validate(u_fields.u.curr_pass) ||
                !validate(u_fields.u.new_pass) ||
                !validate(u_fields.u.conf_pass))
            {
                alerts.u.err.text("Please make sure the fields are not empty");
                $("div#error_msg").show();
                loading("hide");
            }
            else
            {
                // check if passwords match
                if(u_fields.u.new_pass.val() != u_fields.u.conf_pass.val())
                {
                    alerts.u.err.text("Passwords does not match");
                    $("div#error_msg").show();
                    loading("hide");
                }
                else
                {
                    is_validated = true;
                }
            }
        }
        else 
        {
            if(
                !validate(u_fields.u.fname) ||
                !validate(u_fields.u.mname) ||
                !validate(u_fields.u.lname) ||
                !validate(u_fields.u.curr_pass))
            {
                alerts.u.err.text("Please make sure the fields are not empty");
                $("div#error_msg").show();
                loading("hide");
            }
            else
            {
                is_validated = true;
            }
        }

        if(is_validated)
        {
            hideAlerts("update");
            $.ajax({
                url : "{{ route('user.update.account') }}",
                method : "post",
                data : {
                    user_id : {{Session::get('user_id')}},
                    fname : u_fields.u.fname.val(),
                    mname : u_fields.u.mname.val(),
                    lname : u_fields.u.lname.val(),
                    uname : u_fields.u.uname.val(),
                    curr_pass : u_fields.u.curr_pass.val(),
                    new_pass : u_fields.u.new_pass.val()
                },
                dataType : "json",
                success : function(data)
                {
                    console.log(data);
                    if(data.status == true && data.message == "updated")
                    {
                        loading("hide");
                        alerts.u.suc.text("Settings Updated Successfully");
                        $("div#success_msg").show();
                        setTimeout(function(){
                            $("#success_msg").hide();
                        },1500);
                        setTimeout(function(){
                            location.reload();
                        },2500);
                    }
                    else if(data.status == false && data.message == "incorrect_password")
                    {
                        loading("hide");
                        alerts.u.err.text("The password you provided is incorrect");
                        $("div#error_msg").show();
                        u_fields.u.curr_pass.addClass("is-invalid");
                    }
                    else
                    {
                        console.log(data);
                    }
                },
                error : function(err)
                {
                    console.log(err);
                }
            })
        }

    });

    $("#span_goto_securitySettings").click(function(){
        window.location = "{{ route('security.settings.load') }}";
    });
    
    //region script_functions
        function validate(caller)
        {
            if(caller.val() == "")
            {
                caller.addClass("is-invalid");
                return false;
            }
            else
            {
                caller.removeClass("is-invalid");
                return true;
            }
        }

        function loading(action)
        {
            if(action == "show")
            {
                $("div#updateAccount_loading").show();
            }
            else
            {
                $("div#updateAccount_loading").hide();
            }
            return;
        }

        function hideAlerts(operation)
        {
            if(operation == "update")
            {
                alerts.u.err.text("");
                $("div#error_msg").hide();
            }
        }
    //endregion script_functions


</script>

@stop