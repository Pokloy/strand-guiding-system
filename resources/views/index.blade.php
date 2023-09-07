@extends('layouts.master')
@section('page_title', 'SHS Career Guidance System')

@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a href="{{ route('n_loadIndex') }}">
                        <img class="img-fluid" src="{{ asset('assets/img/Logo/Logo.png') }}" alt="ACT Logo" width="100px">
                    </a>
                    
                    <div class="mt-4">
                        <a class="navbar-brand font-weight-bold text-primary ml-3" href="{{ route('n_loadIndex') }}">
                            StrandGuide
                        </a>
                        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> --}}
                    </div>
                
                    {{-- <div class="collapse navbar-collapse mt-4" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                        <form action="#" class="form-inline my-2 my-lg-0" id="form_login_asadmin">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Login As Admin</button>
                        </form>
                    </div> --}}
                </nav>
            </div>
        </div>

        <br>

        <div class="row pt-5 px-2">
            <div class="col-sm-6 py-5">
                {{-- <h2 class="font-weight-bold text-primary">CHOOSE THE RIGHT STRAND</h2> --}}
                <h2 class="font-weight-bold">Welcome to <span class="text-primary">StrandGuide</span>!</h2>
                <h4 class="text-dark mt-4">A <span class="font-weight-bold text-primary">Guide</span> in Choosing the <span class="font-weight-bold text-primary">Right</span> Academic Strand for Senior High School.</h4>
                <p style="font-size: 45px" class="text-dark mt-4"></p>
                <br>
                <p>
                    Confused about which academic strand to choose in senior high school? We're here to help you with the ACT StrandGuide.
                    Take the StrandGuide online assessment to see what academic strand you will attend in your senior high school and we can provide you with some suggestions.

                    <br><br>To proceed with the online assessment please register yourself.
                </p>
                <br>

                @php

                    // the values must be fetched from db
                    $stemCount = 5;
                    $gasCount = 5;
                    $humssCount = 5;
                    $abmCount = 5;

                    $total_assessment_questions = $stemCount + $gasCount + $humssCount + $abmCount;

                @endphp

                @if($count_questions <= $total_assessment_questions)
                    <small class="text-dark" id="span_no_add">
                        <span class="font-weight-bold">Note:</span>
                        <br> <span class="text-secondary">Registration is not yet ready.</span> 
                        <br> <span class="text-secondary">There may be a delay in completing the assessment questions.</span>
                    </small>
                    <br>
                @endif

                @php
                    $isDisabled;
                    $area_disabled;
                    if($count_questions <= $total_assessment_questions) {
                        $isDisabled = "disabled";
                        $area_disabled = "true";
                    }
                    else{
                        $isDisabled = "";
                        $area_disabled = "false";
                    }
                @endphp

                <a href="{{ route('registration')}}" role="button" class="btn btn-lg btn-primary btn-rounded px-5 mt-2 {{ $isDisabled }}" aria-disabled="{{ $area_disabled }}"><small class="mx-4">Register</small></a>
                <a href="{{ route('signin')}}" role="button" class="btn btn-lg btn-outline-primary btn-rounded px-4 mt-2"><small class="mx-4">Login as Admin</small></a>
            </div>
            <div class="col-sm-6">
                <img class="img-fluid" src="{{ asset('assets/img/draw/isometric_index_homepage.jpg') }}" alt="">
            </div>
        </div>
    </div>

    <!-- region Modals -->
        <!-- register first error modal -->
        {{-- <div class="modal fade" id="RegistrationErrorModal" tabindex="-1" role="dialog" aria-labelledby="checking_AssessmentModalLabel" aria-hidden="true">
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
        </div> --}}
    <!-- endregion -->

@stop

@section('page_scripts')
    <script>
        $(document).ready(function(){

        });

        //region script_functions
        //endregion script_functions
    </script>  
@stop
