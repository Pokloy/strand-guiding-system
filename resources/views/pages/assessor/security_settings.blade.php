@extends('layouts.assessor.master')
@section('page_styles')

@stop
@section('title', 'Security Settings')

@section('page_content')

    <div class="container">
        
        <div class="row py-3 px-4 mt-3">
            <div class="col-sm-12">
                <h3>Security Settings</h3>
                <small class="text-secondary">Your security question and security answer need to be set up</small>
            </div>
        </div>

        @if($current_user->sec_ques == "" || $current_user->sec_ans == "")
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
                <div class="col-sm-12 mt-1">
                    <div class="form-group">
                        <label for="txt_fname_a">Security Question</label>
                        <select class="form-control form-control-lg" id="slct_s_question">
                            <option value="" selected>Please select your security question...</option>
                            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                            <option value="What was your first car?">What was your first car?</option>
                            <option value="What elementary school did you attend?">What elementary school did you attend?</option>
                            <option value="What is the name of the town where you were born?">What is the name of the town where you were born?</option>
                            <option value="What was the name of the boy or the girl you first kissed?">What was the name of the boy or the girl you first kissed?</option>
                            <option value="Where were you when you had your first kiss?">Where were you when you had your first kiss?</option>
                            <option value="In what city did you meet your spouse/significant other?">In what city did you meet your spouse/significant other?</option>
                            <option value="What is the middle name of your youngest child?">What is the middle name of your youngest child?</option>
                            <option value="What was the name of your first stuffed animal?">What was the name of your first stuffed animal?</option>
                            <option value="In what city or town did your mother and father meet?">In what city or town did your mother and father meet?</option>
                            <option value="What is your oldest cousin's first and last name?">What is your oldest cousin's first and last name?</option>
                            <option value="What was the first exam you failed?">What was the first exam you failed?</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 mt-2">
                    <div class="form-group">
                        <label for="txt_fname_a">Security Answer</label>
                        <input type="text" class="form-control form-control-lg" id="slct_s_answer" autocomplete="off" value="">
                    </div>
                </div>
                <div class="col-sm-12 mt-2 mb-4">
                    <button type="button" class="btn btn-primary float-right btn-rounded" id="btnContinue">Continue</button>
                </div>


            </div>
        @else
            <div class="row card_accountSettings py-4 px-4 mx-3">
                <div class="col-sm-12 mb-2">
                    <h2 class="font-weight-bold text-success">Success!</h2>
                    <span>Your Security Question and Security Answer has been successfully set up.</span>
                </div>
                <div class="col-sm-12 mt-2 mb-5">
                    <button type="button" class="btn btn-primary float-right btn-rounded px-4" id="btnDone">Done</button>
                </div>
            </div>
        @endif
        
    </div>
    

@stop

@section('page_scripts')
<script>
    $(document).ready(function(){
        
    });

    var fields = {
        q : $("#slct_s_question"),
        a : $("#slct_s_answer")
    }

    var alerts = {
        u : {
            err : $("div#error_msg div span"),
            suc :  $("div#success_msg div span")
        }
    }

    $("#btnContinue").click(function(){
        loading("show");
        if(!validate(fields.q) || !validate(fields.a))
        {
            loading("hide");
            showAlert("error", "Please make sure the fields are not empty");
        } 
        else
        {
            hideAlerts();
            $.ajax({
                url : "{{ route('security.settings.update') }}",
                method : "POST",
                data : {
                    question : fields.q.val(),
                    answer : fields.a.val()
                },
                dataType : "json",
                success : function(data)
                {
                    if(data.status == true && data.message == "setup")
                    {
                        loading("hide");
                        setTimeout(function(){
                            location.reload();
                        },1500);
                    }
                },
                error : function(err)
                {
                    console.log(err);
                }
            });
        }
    });

    $("#btnDone").click(function(){
        window.location = "{{ route('account.settings.load') }}";
    });

    //region script_functions

        function showAlert(alert, message)
        {
            if(alert == "error")
            {
                alerts.u.err.text(message);
                $("#error_msg").show();
            }
            else
            {
                alerts.u.suc.text(message);
                $("#success_msg").show();
            }
            return;
        }

        function hideAlerts()
        {
            alerts.u.err.text("");
            $("#error_msg").hide();
        }

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
    //endregion script_functions
</script>


@stop