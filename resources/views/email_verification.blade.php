@extends('layouts.master')
@section('page_title', 'Email Verification')

@section('page_content')    
    <br><br><br>
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 card-verification px-5 py-5">
                <h1>Enter your verification code</h1>
                <span>Input the verification code we sent to <span class="text-primary">{{ $email }}</span></span>
                <input type="text" class="form-control form-control-lg mt-3" id="txt_verification_code" style="text-align: center; font-size: 40px" maxlength="4">
                <span id="span_err_verif_code" style="display: none;">
                    <br>
                    <span class="text-danger">Verification code you provided is incorrect</span>
                    <br>
                </span>
                <button type="button" class="btn btn-primary btn-rounded px-5 py-2 mt-4" id="btn_verify"><span class="mx-3">Verify</span></button>
                <br><br>
                {{-- <span class="resend-code text-primary" id="span_resendVerif">Resend Code</span> <br> --}}
                <span class="resend-code text-primary" id="spanCancelRegistration">Cancel Registration</span>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

     <!-- region Modals -->
        <div class="modal fade" id="validatingProgressModal" role="dialog" aria-labelledby="validatingProgressModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container pt-5 pb-4">
                            <div class="row">
                                <div class="col-sm-12 text-center mb-4">
                                    <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                    <span class="ml-2">
                                        Verifying. Please wait...
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- verification first error modal -->
        <div class="modal fade" id="VerificationErrorModal" tabindex="-1" role="dialog" aria-labelledby="VerificationErrorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container pt-3 pb-4">
                            <div class="row">
                                <div class="col-sm-12 text-center mb-2">
                                    <h2 class="icon-error text-danger"></h2><p> {{Session::get('error')}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button class="btn btn-secondary btn-rounded px-5" data-dismiss="modal"><small>OK</small></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confCancelModal" tabindex="-1" role="dialog" aria-labelledby="confCancelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container pt-5 pb-4">
                            <div class="row">
                                <div class="col-sm-12 text-center font-weight-bold" id="div_cancel_confirm">
                                    <span>Are you sure you want to cancel registration?</span>
                                    <br><br>
                                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-dismiss="modal"><small>No</small></button>
                                    <button type="button" class="btn btn-primary btn-rounded px-4" id="btnYes"><small>Yes</small></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- endregion -->
@stop

@section('page_scripts')
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script>
        
        $(document).ready(function(){

            @if(Session::get("error") == "Kindly verify your registration first")
                $("#VerificationErrorModal").modal("show");
            @endif

            fetchVerification_Send();
        });

        $("#btn_verify").click(function(){

            var verif_id = "{{ $verif_id }}";
            var verif_code = $("#txt_verification_code").val()

            $.ajax({
                url: "{{ route('registration.verify') }}",
                method: 'POST',
                data: {
                    verif_id: verif_id,
                    verif_code: verif_code
                },
                dataType: 'json',
                success:function(data)
                {
                    if(data.status == true && data.message == "valid")
                    {
                        // $("#loading_AssessmentPage").modal("show");
                        // setTimeout(function(){
                        //     $("#loading_AssessmentPage").modal("hide");
                        // }, 2000);
                        window.location = "{{ route('preassessment') }}";
                    }
                    else {
                        if(data.status == true && data.message == "invalid_code")
                        {
                            showVerificationError("show");
                            setTimeout(function(){
                                showVerificationError("hide");
                            }, 3000);
                        }
                    }
                },
                error:function(err)
                {
                    console.log(err);
                }
            }); 
        });

        $("span#span_resendVerif").click(function(){
            $.ajax({
                url: "{{ route('resendVerif.validate') }}",
                method: 'POST',
                data: {
                    verif_id: {{ $verif_id }}
                },
                dataType: 'json',
                success:function(data)
                {
                    // console.log(data);
                    if(data.status == true && data.message == "validated")
                    {
                        if(data.is_sent == 0)
                        {
                            fetchVerification_Send();
                        }
                        else
                        {
                            //alert("already sent!");
                        }
                    }
                    else
                    {
                        console.log(data);
                    }
                },
                error:function(err)
                {
                    console.log(err);
                }
            }); 
        });

        $("#spanCancelRegistration").click(function(){
            $("#confCancelModal").modal("show");
        });

        $("button#btnYes").click(function(){
            
            $.ajax({
                url: "{{ route('student.unregister') }}",
                method: 'POST',
                data: {
                    view : "verification"
                },
                dataType: 'json',
                success:function(data)
                {
                    console.log(data);
                    if(data.status == true && data.message == "cancelled")
                    {
                        $("#confCancelModal").modal('hide');
                        window.location = "{{ route('registration') }}";
                    }
                    else
                    {
                        console.log(data);
                    }
                },
                error:function(err)
                {
                    console.log(err);
                }
            });
        })

        //region script_functions

            function resend()
            {

            }


            function loading(view)
            {
                if(view == "show")
                {
                    $("#validatingProgressModal").modal("show");
                }
                else if(view == "hide")
                {
                    $("#validatingProgressModal").modal("hide");
                }
            }

            function fetchVerification_Send(resend = false)
            {
                $("#txt_verification_code").focus();

                let email = "{{ $email }}";
                let verif_id = "{{ $verif_id }}";

                // fetch verification details
                $.ajax({
                    url: "{{ route('fetch.verification.details') }}",
                    method: 'POST',
                    data: {
                        verif_id: verif_id
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        if(data.status == true && data.message == "fetched")
                        {
                            if(data.vdetails[0].is_sent == 0 && !resend)
                            {
                                var gmail_body = '<!DOCTYPE html>'+
                                                    '<html lang="en">'+
                                                    '<head>'+
                                                        '<meta charset="UTF-8">'+
                                                        '<meta name="viewport" content="width=device-width, initial-scale=1.0">'+
                                                        '<meta http-equiv="X-UA-Compatible" content="ie=edge">'+
                                                        '<title>ACT StrandGuide | Verification</title>'+
                                                    '</head>'+
                                                    '<body style="background-color: #f8f9fA; font-family: sans-serif;line-height: 1.15;">'+
                                                        '<br><br><br>'+
                                                        '<div style="margin: auto; width: 40%; padding-right: 35px; padding-left: 35px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s;background-color: #fff;border-radius: 5px;">'+
                                                        ' <div style="text-align: center;">'+
                                                                '<br>'+
                                                                '<h2>'+
                                                                    '<b><span style="color: #007bff">ACT</span></b>'+
                                                                    '<span style="color: #6c757d">StrandGuide</span>'+
                                                                '</h2>'+
                                                                '<br>'+
                                                                '<span style="font-size: 28px">Complete you Registration</span><br>'+
                                                                '<p>Please enter this verification code in the verification process.</p>'+
                                                                '<br>'+
                                                                '<span style="font-size: 50px;">'+data.vdetails[0].verification_code+'</span>'+
                                                                '<br><br>'+
                                                                '<p>'+
                                                                    'If you didn\'t register in '+
                                                                    '<b>'+
                                                                        '<span style="color: #007bff">ACT</span>'+
                                                                        '<span style="color: #6c757d">StrandGuide</span>'+
                                                                    '</b>,'+
                                                                    '<br> please ignore this message.</p>'+
                                                            '</div>'+
                                                            '<br><br><br>'+
                                                        
                                                        '</div>'+
                                                        '<br><br><br>'+
                                                    '</body>'+
                                                    '</html>';
                                                    
                                                    // account 1
                                                    // Email.send({
                                                    //     securityToken: "5cc2cb9f-87e3-40e7-8ba4-7f9c5fd25875",
                                                    //     Host : "smtp.elasticemail.com",
                                                    //     Username : "johanbrooker08@gmail.com",
                                                    //     Password : "2C507B488940614611C0182904C3490BB0FF",
                                                    //     To : email,
                                                    //     From : "johanbrooker08@gmail.com",
                                                    //     Subject : "Please verify your email to complete ACT StrandGuide Registration",
                                                    //     Body : gmail_body
                                                    // }).then(function(message){
                                                    //     if(message == "OK")
                                                    //     {
                                                    //         updateVerificationDetails(verif_id);
                                                    //     }
                                                    //     else
                                                    //     {
                                                    //         console.log("There is a problem in sending the verification code")
                                                    //     }
                                                    // });

                                                    // account 2 -> main account
                                                    Email.send({
                                                        securityToken: "d6c3a986-7057-49dd-882e-5f574a510ff0",
                                                        Host : "smtp.elasticemail.com",
                                                        Username : "actstrandguide@gmail.com",
                                                        Password : "AF5CF3053A12E091717341BF2122A2E9E9C7",
                                                        To : email,
                                                        From : "actstrandguide@gmail.com",
                                                        Subject : "Please verify your email to complete ACT StrandGuide Registration",
                                                        Body : gmail_body
                                                    }).then(function(message){
                                                        if(message == "OK")
                                                        {
                                                            updateVerificationDetails(verif_id);
                                                        }
                                                        else
                                                        {
                                                            console.log("There is a problem in sending the verification code")
                                                        }
                                                    });
                            }
                            else {
                                //alert("you cannot be able to send again");
                            }
                        }
                        else
                        {
                            console.log(data);
                        }
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }
                }); 
            }

            function updateVerificationDetails(verif_id)
            {
                $.ajax({
                    url: "{{ route('update.verification.details') }}",
                    method: 'POST',
                    data: {
                        verif_id: verif_id
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        if(data.status == true && data.message == "updated")
                        {
                            $("#txt_verification_code").focus();
                        }
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }
                });   
            }

            function showVerificationError(option)
            {
                if (option == "show")
                {
                    $("#txt_verification_code").addClass("is-invalid");
                    $("#span_err_verif_code").show();
                }
                else
                {
                    $("#txt_verification_code").removeClass("is-invalid");
                    $("#span_err_verif_code").hide();
                }
            }

        //endregion script_functions
    </script>  
@stop
