@extends('layouts.assessor.master')
@section('page_styles')

@stop
@section('title', 'Home')

@section('page_content')

    @php

        use App\Models\UserModel;

        $user_id = Session::get('user_id');
        $current_user = UserModel::where('user_id', $user_id)->first();

    @endphp

    <div class="container">

        <div class="row alert alert-primary mt-4 py-5 px-5 mx-1 animate_fadein">
            <div class="col-sm-12">
                <h2>Welcome to <span class="text-primary">StrandGuide</span>, {{ Session::get('utype') == "admin" ? "Admin" : "" }} {{ $current_user->fname }}!</h2>
                
                @if(Session::get('utype') == "admin")
                    <span>Go and manage StrandGuide system now!</span>
                    <div class="mx-4 mt-4">
                        <span><i class="fas fa-check text-success"></i> <span class="ml-2">Manage academic strands</span></span> <br>
                        <span><i class="fas fa-check text-success"></i> <span class="ml-2">Manage user accounts</span></span> <br>
                        <span><i class="fas fa-check text-success"></i> <span class="ml-2">Manage questions and answers of every academic strand</span></span>
                    </div>
                @else
                    <span>Go add more questions for StrandGuide assessment now!</span>
                @endif
                <br>
                <br>
                <a href="{{ route('strand.load') }}" role="button" class="btn btn-primary mt-4 px-3">{{ Session::get('utype') == "admin" ? "Manage Strands" : "View Strands" }}</a>
            </div>
        </div>

        @if(Session::get('utype') == "admin")
            
            <div class="row mt-4">
                <div class="col-sm-12">
                    <span class="text-secondary ml-3">Quick Overview</span>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-3 mt-4">
                   <div class="card_dashboard py-3 px-4">
                        <div class="row">
                            <div class="col-sm-3 text-center pt-2">
                                <i class="fas fa-graduation-cap" style="font-size: 32px; color: #cce5ff"></i>
                            </div>
                            <div class="col-sm-9">
                                <small class="total_class text-secondary">Total No. of Strands</small>
                                <h3 class="font-weight-bold">{{ $strand_count }}</h3>
                            </div>
                        </div>
                   </div>
                </div>

                <div class="col-sm-3 mt-4">
                    <div class="card_dashboard py-3 px-4">
                         <div class="row">
                             <div class="col-sm-3 text-center pt-2">
                                 <i class="fas fa-file-alt" style="font-size: 32px; color: #cce5ff"></i>
                             </div>
                             <div class="col-sm-9">
                                 <small class="total_class text-secondary">Total No. of Questions</small>
                                 <h3 class="font-weight-bold">{{ $question_count }}</h3>
                             </div>
                         </div>
                    </div>
                 </div>

                <div class="col-sm-3 mt-4">
                    <div class="card_dashboard py-3 px-4">
                         <div class="row">
                             <div class="col-sm-3 text-center pt-2">
                                 <i class="fas fa-user-plus" style="font-size: 32px; color: #cce5ff"></i>
                             </div>
                             <div class="col-sm-9">
                                 <small class="total_class text-secondary">Registration</small>
                                 <h3 class="font-weight-bold">{{ $student_count }}</h3>
                             </div>
                         </div>
                    </div>
                 </div>

                 <div class="col-sm-3 mt-4">
                    <div class="card_dashboard py-3 px-4">
                         <div class="row">
                             <div class="col-sm-3 text-center pt-2">
                                 <i class="fas fa-users" style="font-size: 32px; color: #cce5ff"></i>
                             </div>
                             <div class="col-sm-9">
                                 <small class="total_class text-secondary">Accounts</small>
                                 <h3 class="font-weight-bold">{{ $staff_count }}</h3>
                             </div>
                         </div>
                    </div>
                 </div>



                
            </div>

        @else
            <div class="row mt-4">
                <div class="col-sm-12">
                    <span class="text-secondary ml-3">Quick Overview</span>
                </div>
            </div>
            <div class="row">

            <div class="col-sm-3 mt-4">
                <div class="card_dashboard py-3 px-4">
                    <div class="row">
                        <div class="col-sm-3 text-center pt-2">
                            <i class="fas fa-graduation-cap" style="font-size: 32px; color: #cce5ff"></i>
                        </div>
                        <div class="col-sm-9">
                            <small class="total_class text-secondary">Total No. of Strands</small>
                            <h3 class="font-weight-bold">{{ $strand_count }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3 mt-4">
                <div class="card_dashboard py-3 px-4">
                     <div class="row">
                         <div class="col-sm-3 text-center pt-2">
                             <i class="fas fa-file-alt" style="font-size: 32px; color: #cce5ff"></i>
                         </div>
                         <div class="col-sm-9">
                             <small class="total_class text-secondary">Total No. of Questions</small>
                             <h3 class="font-weight-bold">{{ $question_count }}</h3>
                         </div>
                     </div>
                </div>
            </div>
            
        @endif







    </div>

@stop