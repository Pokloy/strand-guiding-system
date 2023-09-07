<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('assets/img/Logo/icon.ico') }}" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/manual.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/icomoon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
        <title>StrandGuide | Sign In</title>
    </head>
    <body>
        <div class="container mt-4 pt-4">
            <div class="row">

                @if($admin_count == 0)
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 card_signIn px-5 py-5">
                        <center>
                            <h4 class="font-weight-bold">
                                <span class="text-primary">STRANDGUIDE</span>
                                <span class="text-secondary">REGISTRATION</span>
                            </h4>
                            <img class="mt-1" width="100" src="{{ asset('assets/img/Logo/Logo.png')}}" alt="ACT Logo">
                        </center>
                        <br>
                        @if(Session::has('unregistered'))
                            <form action="{{ route('register_admin') }}" method="POST">
                                @csrf
                                @if(Session::has('not_valid'))
                                    <div class="card mb-2 bg-light errorAlert" id="error_msg_not_valid">
                                        <div class="card-body">
                                            <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                                            <span>
                                                {{Session::get('not_valid')}}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="input_firstname">First Name</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            id="input_firstname"
                                            name="input_firstname"
                                            value="{{ old('input_firstname') }}"
                                        >
                                        <small class="text-danger">
                                            <span id="span_msg_input_firstname">
                                                @error('input_firstname'){{ $message }} @enderror
                                            </span>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label for="input_middlename">Middle Name</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            id="input_middlename"
                                            name="input_middlename"
                                            value="{{ old('input_middlename') }}"
                                        >
                                        <small class="text-danger">
                                            <span id="span_msg_input_middlename">
                                                @error('input_middlename'){{ $message }} @enderror
                                            </span>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label for="input_lastname">Last Name</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            id="input_lastname"
                                            name="input_lastname"
                                            value="{{ old('input_lastname') }}"
                                        >
                                        <small class="text-danger">
                                            <span id="span_msg_input_lastname">
                                                @error('input_lastname'){{ $message }} @enderror
                                            </span>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn-block btn btn-lg btn-primary btn-rounded"><i class="icon-sign-in"></i><small class="ml-2">REGISTER</small></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <center>
                                            <small class="font-weight-bold text-primary">
                                                <span class="cur-pointer" id="back_to_home">Back to Home</span>
                                            </small>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        @endif
                        
                        <!-- <button type="button" class="btn-block btn btn-primary mt-2"><i class="icon-user-plus"></i><span class="ml-2">REGISTER</span></button> -->
                    </div>
                    <div class="col-sm-3"></div>
                @elseif($admin_count > 0)
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 card_signIn px-5 py-5">
                        @if(Session::has('registered'))
                            <center>
                                <h4 class="font-weight-bold">
                                    <span class="text-primary">STRANDGUIDE</span>
                                    <span class="text-secondary">REGISTRATION</span>
                                </h4>
                                <img class="mt-1" width="100" src="{{ asset('assets/img/Logo/Logo.png')}}" alt="ACT Logo">
                            </center>
                            <br>
                            <div class="row mt-2 mb-3">
                                <div class="col-sm-12">
                                    <span class="font-weight-bold">
                                        Here is your <span class="text-primary">StrandGuide</span> admin account. <br>
                                        Please make sure you remember your username and password.
                                    </span>
                                    <br>
                                    <br>
                                    <span><span class="font-weight-bold">Username</span>: <span class="text-secondary">user-01</span></span>
                                    <br>
                                    <span>
                                        <span class="font-weight-bold">Password</span>:
                                        <span id="span_default_pass" class="text-secondary" data-visible="hide">*******</span>
                                        <i class="fas fa-eye p_cursor" id="i_pass_visibility"></i>
                                    </span>
                                    <br>
                                    <br>
                                    <small>
                                        <i>(Note: A friendly reminder that your password is currently in a default setup. Please change your password as soon as possible for security reasons.)</i>
                                    </small>
                                    <br>
                                    <br>
                                    <center>
                                        <form action="{{ route('registerSession.remove') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">Sign In Now</button>
                                        </form>
                                    </center>
                                </div>
                            </div>
                        @else
                            <center>
                                <h3 class="font-weight-bold">
                                    <span class="text-primary">ACT</span>
                                    <span class="text-secondary">SENIOR HIGH SCHOOL STRAND GUIDING SYSTEM</span>
                                </h3>

                                <h6 class="font-weight-bold">
                                    <span class="text-primary">INTEGRATED SCHOOL DIVISION</span>
                                </h6>
                                <img class="mt-3" width="150" src="{{ asset('assets/img/Logo/Logo.png')}}" alt="ACT Logo">
                            </center>
                            <br>
                            <form action="{{ route('signin_user') }}" method="POST">
                                @csrf
                                @if(Session::has('not_valid'))
                                    <div class="card mb-2 bg-light errorAlert" id="error_msg_not_valid">
                                        <div class="card-body">
                                            <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                                            <span>
                                                {{Session::get('not_valid')}}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if(Session::has('loggedout'))
                                    <div class="card mb-2 bg-light successAlert" id="error_msg_not_valid">
                                        <div class="card-body">
                                            <i class="fas fa-check-circle mr-2 text-success"></i>
                                            <span>
                                                {{ Session::get('loggedout') }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label for="input_username">Username</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            id="input_username"
                                            name="input_username"
                                            value="{{ old('input_username') }}"
                                        >
                                        <small class="text-danger">
                                            <span id="span_msg_input_username">
                                                @error('input_username'){{ $message }} @enderror
                                            </span>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label for="input_username">Password</label>
                                        <input
                                            type="password"
                                            class="form-control form-control-lg"
                                            id="input_password"
                                            name="input_password"
                                            value="{{ old('input_password') }}">
                                        <small class="text-danger">
                                            <span id="span_msg_input_password">
                                                @error('input_password'){{ $message }} @enderror
                                            </span>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <small class="font-weight-bold text-primary cur-pointer float-right" id="small_forgot_password">Forgot Password?</small>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn-block btn btn-lg btn-primary btn-rounded" id="btnSignIn"><i class="icon-sign-in"></i><small class="ml-2">SIGN IN</small></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <center>
                                            <small class="font-weight-bold text-primary">
                                                <span class="cur-pointer" id="back_to_home">Back to Home</span>
                                            </small>
                                        </center>
                                    </div>
                                </div>
                            </form>

                        @endif

                    </div>
                    <div class="col-sm-3"></div>
                @endif
                
            </div>
        </div>

        <!-- region Modals -->
            <!-- register first error modal -->
            <div class="modal fade" id="SignInErrorModal" tabindex="-1" role="dialog" aria-labelledby="SignInErrorModalLabel" aria-hidden="true">
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

            <div class="modal fade" id="RegisterFirstModal" tabindex="-1" role="dialog" aria-labelledby="RegisterFirstModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container pt-3 pb-4">
                                <div class="row">
                                    <div class="col-sm-12 text-center mb-2">
                                        <h2 class="icon-error text-danger"></h2><p>It seems that your are the first user, kindly register first.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="btn btn-secondary btn-rounded px-5" data-dismiss="modal"><small>OK</small></button>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- endregion -->

        <!-- Choose account type to sign up modal -->
        <div class="modal fade" id="ChooseAccountTypeModal" tabindex="-1" role="dialog" aria-labelledby="ChooseAccountTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row py-5 mb-3">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-4 ml-5 text-center pt-5 cur-pointer" onclick="SelectAccountType('assessor')" id="acc_assessor">
                                    <!-- color: #007bff -->
                                    <img class="img-fluid" src="{{ asset('assets/img/ResourcesandIcons/assessor.png')}}" alt="Assessor Icon">
                                    <hr>
                                    <span class="font-weight-bold text-secondary" id="span_assessor">Assessor</span>
                                </div>
                                <div class="col-sm-4 ml-4 text-center pb-2 cur-pointer" onclick="SelectAccountType('student')" id="acc_student">
                                    <!-- color: F9A826 -->
                                    <img class="img-fluid" src="{{ asset('assets/img/ResourcesandIcons/student.png')}}" alt="Assessor icon">
                                    <hr>
                                    <span class="font-weight-bold text-secondary" id="span_student">Student</span>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-12 text-center">
                                    <button class="btn btn-primary btn-rounded px-5 py-2" disabled="true" id="btnContinue">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/bootstrap/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script>

            var Btn = {
                signIn : $('button#btnSignIn')
            }

            var Spn_Err = {
                u : $('span#span_msg_input_username'),
                p : $('span#span_msg_input_password')
            }

            $(document).ready(function(){  
                // if(Spn_Err.u.text() != "")
                // {
                //     $('input#input_username').addClass('is-invalid');
                // }
                // if(Spn_Err.p.text() != "")
                // {
                //     $('input#input_password').addClass('is-invalid');
                // }

                @if(Session::get("error") == "Kinly login first")
                    $("#SignInErrorModal").modal("show");
                @endif

                @if($admin_count == 0)
                    $("#RegisterFirstModal").modal("show");
                @endif


                
                check_error_msg();

                setTimeout(() => {
                    clear_error();
                }, 5000);
            });

            $("span#span_signUp").click(function(){
                $("#ChooseAccountTypeModal").modal('show');
            });

            $("span#back_to_home").click(function(){
                window.location = "{{ route('n_loadIndex') }}";
            });

            $("#i_pass_visibility").click(function(){
                let cur_vsblty = $("#span_default_pass").attr("data-visible");
                if(cur_vsblty == "hide")
                {
                    change_pass_vsblty("show");
                }
                else
                {
                    change_pass_vsblty("hide");
                }
            });

            $("#small_forgot_password").click(function(){
                window.location = "{{ route('forgot.password.load') }}";
            });

            //region script_functions

                // check the span for error messages if errors exists
                function change_pass_vsblty(to_state)
                {
                    if(to_state == "hide")
                    {
                        // change text to asterisk characters
                        $("#span_default_pass").text("*******");
                        // change data attribute current value to hide
                        $("span#span_default_pass").attr("data-visible", "hide");
                        
                        // change icon to show
                        $("#i_pass_visibility").removeClass("fa-eye-slash");
                        $("#i_pass_visibility").addClass("fa-eye");
                    }
                    else if(to_state == "show")
                    {
                        // change text to string characters
                        $("#span_default_pass").text("user-01");
                        // change data attribute current value to hide
                        $("span#span_default_pass").attr("data-visible", "show");
                        
                        // change icon to hide
                        $("#i_pass_visibility").removeClass("fa-eye");
                        $("#i_pass_visibility").addClass("fa-eye-slash");
                    }
                }

                function check_error_msg()
                {
                    // has already admin acc
                    let error_uname = $("span#span_msg_input_username").text();
                    if(error_uname.replace(/\s/g, '') == "Usernameisrequired")
                    {
                        $("input#input_username").addClass("is-invalid");
                    }

                    let error_password = $("span#span_msg_input_password").text();
                    if(error_password.replace(/\s/g, '') == "Passwordisrequired")
                    {
                        $("input#input_password").addClass("is-invalid");
                    }

                    //no admin acc
                    let error_fname = $("span#span_msg_input_firstname").text();
                    if(error_fname.replace(/\s/g, '') == "Firstnameisrequired")
                    {
                        $("input#input_firstname").addClass("is-invalid");
                    }
                    let error_mname = $("span#span_msg_input_middlename").text();
                    if(error_mname.replace(/\s/g, '') == "Middlenameisrequired")
                    {
                        $("input#input_middlename").addClass("is-invalid");
                    }
                    let error_lname = $("span#span_msg_input_lastname").text();
                    if(error_lname.replace(/\s/g, '') == "Lastnameisrequired")
                    {
                        $("input#input_lastname").addClass("is-invalid");
                    }
                }

                function clear_error()
                {
                    // with admin
                    $("span#span_msg_input_username").text("");
                    $("span#span_msg_input_password").text("");

                    $("input#input_username").removeClass("is-invalid");
                    $("input#input_password").removeClass("is-invalid");

                    // without admin
                    $("span#span_msg_input_firstname").text("");
                    $("span#span_msg_input_middlename").text("");
                    $("span#span_msg_input_lastname").text("");

                    $("input#input_firstname").removeClass("is-invalid");
                    $("input#input_middlename").removeClass("is-invalid");
                    $("input#input_lastname").removeClass("is-invalid");
                }

                function SelectAccountType(acc)
                {
                    //clear the acc border first
                    $("div#acc_assessor").removeClass('acc_type_assessor');
                    $("div#acc_student").removeClass('acc_type_student');
                    //remove the acc text color
                    $("span#span_student").removeClass('span_color_student');
                    $("span#span_assessor").removeClass('span_color_assessor');


                    //set the acc border color
                    $("div#acc_"+acc).addClass('acc_type_'+acc);
                    //set the acc text color
                    $("span#span_"+acc).addClass('span_color_'+acc);
                    //remove disable attr to the button
                    $("button#btnContinue").attr("disabled", false);
                }

            //endregion script_functions
            
        </script>
    </body>
</html>
