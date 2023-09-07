@extends('layouts.master')
@section('page_title', 'Registration')

@section('page_content')
    <div class="container mt-4">
        <div class="row cardRegistration">
            <div class="col-sm-6 bg-primary px-5 py-5">
                <br>    
                <center>
                    <h3 class="font-weight-bold">
                        <span class="text-warning">ACT</span>
                        <span class="text-light">SENIOR HIGH SCHOOL STRAND GUIDING SYSTEM</span>
                    </h3>
                    <h6 class="font-weight-bold">
                        <span class="text-light">INTEGRATED SCHOOL DIVISION</span>
                    </h6>
                </center>
                <br>
                <br>
                <br>
                <center>
                    <h5 class="mt-5">
                        <span class="text-warning font-weight-bold">REGISTRATION</span>
                    </h5>
                </center>
                <span class="text-light">
                    Welcome to the ACT Senior High School StrandGuide System Registration. Before taking the exam, you need to register first. Please provide your valid contact information, including your email address, so that we can send you the feedback via email. 
                </span>
            </div>
            <div class="col-sm-6 px-5 py-5" style="background-color: #ffff">
                <center>
                    <img class="img-fluid" src="{{ asset('assets/img/draw/register_draw2.png')}}" alt="Registration Drawing" width="180">
                </center>
                <br>

                <form action="{{ route('student.register') }}" method="POST" id="form_registration">
                    @csrf
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <label for="input_fname">First Name</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="input_fname"
                                name="input_fname"
                                value="{{ old('input_fname') }}"
                            >
                            <small class="text-danger">
                                <span id="span_msg_input_fname">
                                    @error('input_fname'){{ $message }} @enderror
                                </span>
                            </small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <label for="input_lname">Last Name</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="input_lname"
                                name="input_lname"
                                value="{{ old('input_lname') }}">
                            <small class="text-danger">
                                <span id="span_msg_input_lname">
                                    @error('input_lname'){{ $message }} @enderror
                                </span>
                            </small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <label for="input_email">Email Address</label>
                            <input
                                type="email"
                                class="form-control form-control-lg"
                                id="input_email"
                                name="input_email"
                                value="{{ old('input_email') }}">
                            <small class="text-danger">
                                <span id="span_msg_input_email">
                                    @error('input_email'){{ $message }} @enderror
                                </span>
                            </small>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn-block btn btn-lg btn-outline-primary btn-rounded" id="btn_register"><i class="icon-check2"></i><small class="ml-2">REGISTER</small></button>
                        </div>
                    </div>
                </form>
                
                <!-- <button type="button" class="btn-block btn btn-primary mt-2"><i class="icon-user-plus"></i><span class="ml-2">REGISTER</span></button> -->
            </div>
        </div>
    </div>

    <!-- region Modals -->
        <!-- register first error modal -->
        <div class="modal fade" id="RegistrationErrorModal" tabindex="-1" role="dialog" aria-labelledby="RegistrationErrorModalLabel" aria-hidden="true">
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
    <!-- endregion -->

@stop

@section('page_scripts')
    <script>
        $(document).ready(function(){

            @if(Session::get("error") == "Kindly register first")
                $("#RegistrationErrorModal").modal("show");
            @endif

            check_error_msg();

            setTimeout(() => {
                clear_error();
            }, 5000);

        });

        $("form#form_registration").submit(function(){
            $("button#btn_register").attr('disabled', true);
        });

        //region script_functions

            // check the span for error messages if errors exists
            function check_error_msg()
            {
                let error_fname = $("span#span_msg_input_fname").text();
                if(error_fname.replace(/\s/g, '') == "FirstNameisrequired")
                {
                    $("input#input_fname").addClass("is-invalid");
                }

                let error_lname = $("span#span_msg_input_lname").text();
                if(error_lname.replace(/\s/g, '') == "LastNameisrequired")
                {
                    $("input#input_lname").addClass("is-invalid");
                }

                let error_email = $("span#span_msg_input_email").text();
                if(error_email.replace(/\s/g, '') == "EmailAddressisrequired")
                {
                    $("input#input_email").addClass("is-invalid");
                }
            }

            function clear_error()
            {
                // clear the span error messages
                $("span#span_msg_input_fname").text("");
                $("span#span_msg_input_lname").text("");
                $("span#span_msg_input_email").text("");

                $("input#input_fname").removeClass("is-invalid");
                $("input#input_lname").removeClass("is-invalid");
                $("input#input_email").removeClass("is-invalid");
            }

        //endregion script_functions
    </script>  
@stop
