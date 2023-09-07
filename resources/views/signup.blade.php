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
        <title>StrandGuide | Sign Up</title>
    </head>
    <body>

        <div class="container mt-4">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 cardManual px-5 py-4">
                    <center>
                        <h2 class="font-weight-bold">
                            <span class="text-primary">ACT</span>
                            <span class="text-secondary">SHS STRAND GUIDING SYSTEM</span>
                        </h2>

                        <span class="font-weight-bold">
                            <span class="text-secondary">INTEGRATED SCHOOL DIVISION</span>
                        </span>
                    </center>
                    <form action="#" class="mt-5">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="font-weight-bold pl-1 text-primary" style="border-left: 4px solid #007bff;font-size:20px;">
                                    <span class="text-primary">REGISTRATION</span><span class="text-secondary"> FORM</span>
                                </span>
                            </div>
                        </div>
                        <!-- Personal  Information Fields-->
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <span class="text-secondary">Personal Information</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <label for="input_username">First Name</label>
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

                            <div class="col-sm-4">
                                <label for="input_username">Last Name</label>
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

                            <div class="col-sm-4">
                                <label for="input_username">Email Address</label>
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
                        <!-- Account  Information Fields-->
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <span class="text-secondary">Account  Information</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-sm-4">
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

                            <div class="col-sm-4">
                                <label for="input_username">Password</label>
                                <input
                                    type="password"
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

                            <div class="col-sm-4">
                                <label for="input_username">Confirm Password</label>
                                <input
                                    type="password"
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
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <span>
                                    <input type="checkbox"> By clicking I agree, you consent to the collection, generation,
                                    use, processing, storage and retention of your personal data by
                                    the Company for the purpose(s) described in this document. Please
                                    ensure that you have completely read and understood the terms above
                                    before signing up. Read our Privacy Policy
                                </span>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="px-5 btn btn-lg btn-primary btn-rounded"><small class="ml-2">CREATE ACCOUNT</small></button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <center>
                                    <small class="font-weight-bold text-primary">
                                        <span class="text-secondary">Already have an account?</span>
                                        <span class="cur-pointer">Sign In</span>
                                    </small>
                                </center>
                            </div>
                        </div>
                    </form>
                    
                    <!-- <button type="button" class="btn-block btn btn-primary mt-2"><i class="icon-user-plus"></i><span class="ml-2">REGISTER</span></button> -->
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

        <script src="{{ asset('assets/bootstrap/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>
