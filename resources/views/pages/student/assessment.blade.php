@extends('layouts.student.master')
@section('page_title', 'Assessment')

@section('page_content')

        @php
            // strand progress percentage (start)

                // stem progress algorithm (start)
                    $stem_percentage = 0;
                    $stem_total_q = 0;
                    $stem_answered = 0;
                    $stem_unanswered = 0;

                    // get the total number of unanswered questions
                    foreach($stem_questions as $q)
                    {
                        if((int)$q->is_answered == 0)
                        {
                            $stem_unanswered++;
                        }
                        else if((int)$q->is_answered == 1)
                        {
                            $stem_answered++;
                        }
                        $stem_total_q++;
                    }

                    // formulate the percentage
                    if($stem_answered < 1)
                    {
                        $stem_percentage = 0;
                    }
                    else {
                        $stem_percentage = ($stem_answered / $stem_total_q) * 100;
                    }
                // stem progress algorithm (end)

                // =========================================================================================================================================================================================
                
                // gas progress algorithm (start)
                    $gas_percentage = 0;
                    $gas_total_q = 0;
                    $gas_answered = 0;
                    $gas_unanswered = 0;

                    // get the total number of unanswered questions
                    foreach($gas_questions as $q)
                    {
                        if((int)$q->is_answered == 0)
                        {
                            $gas_unanswered++;
                        }
                        else if((int)$q->is_answered == 1)
                        {
                            $gas_answered++;
                        }
                        $gas_total_q++;
                    }

                    // formulate the percentage
                    if($gas_answered < 1)
                    {
                        $gas_percentage = 0;
                    }
                    else {
                        $gas_percentage = ($gas_answered / $gas_total_q) * 100;
                    }
                // gas progress algorithm (end)

                // =========================================================================================================================================================================================

                // abm progress algorithm (start)
                    $abm_percentage = 0;
                    $abm_total_q = 0;
                    $abm_answered = 0;
                    $abm_unanswered = 0;

                    // get the total number of unanswered questions
                    foreach($abm_questions as $q)
                    {
                        if((int)$q->is_answered == 0)
                        {
                            $abm_unanswered++;
                        }
                        else if((int)$q->is_answered == 1)
                        {
                            $abm_answered++;
                        }
                        $abm_total_q++;
                    }

                    // formulate the percentage
                    if($abm_answered < 1)
                    {
                        $abm_percentage = 0;
                    }
                    else {
                        $abm_percentage = ($abm_answered / $abm_total_q) * 100;
                    }
                // abm progress algorithm (end)

                // =========================================================================================================================================================================================

                // humss progress algorithm (start)
                    $humss_percentage = 0;
                    $humss_total_q = 0;
                    $humss_answered = 0;
                    $humss_unanswered = 0;

                    // get the total number of unanswered questions
                    foreach($humss_questions as $q)
                    {
                        if((int)$q->is_answered == 0)
                        {
                            $humss_unanswered++;
                        }
                        else if((int)$q->is_answered == 1)
                        {
                            $humss_answered++;
                        }
                        $humss_total_q++;
                    }

                    // formulate the percentage
                    if($humss_answered < 1)
                    {
                        $humss_percentage = 0;
                    }
                    else {
                        $humss_percentage = ($humss_answered / $humss_total_q) * 100;
                    }
                // humss progress algorithm (end)

            // strand progress percentage (end)

        @endphp

        @php

            $lastname = '';
            $firstname = '';
            $email = '';

            // get the account details
            foreach($stem_questions as $q)
            {
                if($lastname != "" || $firstname != "" || $email != "")
                {
                    break;
                }
                else
                {
                    $lastname = $q->lastname;
                    $firstname = $q->firstname;
                    $email = $q->email;
                }
            }
        
        @endphp

        <!-- region Modals -->

            <!-- submit error modal -->
            <div class="modal fade" id="Message_AssessmentModal" tabindex="-1" role="dialog" aria-labelledby="checking_AssessmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container pt-3 pb-4">
                                <div class="row">
                                    <div class="col-sm-12 text-center mb-2">
                                        <h2 class="icon-error text-danger"></h2><p> Please take all the assessments</p>
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

            <!-- evaluating progress of assessment modal -->
            <div class="modal fade" id="evaluating_AssessmentModal" tabindex="-1" role="dialog" aria-labelledby="evaluating_AssessmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container pt-5 pb-4">
                                <div class="row">
                                    <div class="col-sm-12 text-center mb-4">
                                        <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                        <span class="ml-2">
                                            Evaluating Assessment. Please wait...
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- endregion -->

        <br>
        <!-- region Header -->
            <div class="container my-3">
                <div class="row py-3">
                    <div class="col-sm-6 pt-1">
                        <h2 class="pl-3"><span class="text-primary font-weight-bold">Assessment</span><span class="text-secondary"> Progress</span></h2>
                    </div>
                    <div class="col-sm-6">
                        <span class="float-right"><span class="font-weight-bold">@php echo $lastname.', '.$firstname @endphp</span><br><small class="text-secondary"><?php echo $email; ?></small></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                    </div>
                </div>  
            </div>
        <!-- endregion Header -->
        
        <!-- region STEM Strand Card -->
            <div class="container">
                {{--  style="border-left: 4px solid #ffc107" --}}
                <div class="row bg-light cardManual px-5 py-3">
                    <div class="col-sm-3">
                        <h3 class="text-warning">STEM</h3>
                        <small class="text-secondary">Science Technology Engineering Mathematics</small> 
                    </div>
                    <div class="col-sm-7">
                        <span class="font-weight-bold">Assessment Status</span><br>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: @php echo $stem_percentage @endphp%;"
                                aria-valuenow="@php echo $stem_percentage @endphp" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                @php echo $stem_percentage == 0 ? '0%' : $stem_percentage.'% Completed' @endphp
                            </div>
                        </div>
                        <div class="mt-2 container-fluid text-center">
                            <small class="text-secondary">
                                <span>@php echo $stem_answered @endphp</span> out of <span>@php echo $stem_total_q @endphp</span> Questions Answered
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center">
                            <?php
                                if($stem_total_q == $stem_answered)
                                {
                                    ?>
                                        <span class="ml-4 text-secondary"><span>Done</span><i class="icon-check ml-2"></i></span>
                                    <?php
                                }
                                else {
                                    ?>
                                        <a href="{{ route('assessment.stem') }}" role="button" class="btn btn-outline-warning btn-rounded px-5">
                                            <small>@php echo $stem_answered == 0 ? 'Take' : 'Continue' @endphp</small>
                                        </a>
                                   <?php
                                }
                            ?>

                    </div>
                </div>
            </div>
        <!-- endregion STEM Strand Card -->

        <!-- region GAS Strand Card -->
            <div class="container mt-2">
                {{--  style="border-left: 4px solid #17a2b8" --}}
                <div class="row bg-light cardManual px-5 py-3">
                    <div class="col-sm-3">
                        <h3 class="text-info">GAS</h3>
                        <small class="text-secondary">General Academic Strand</small>
                        <br><br>
                    </div>
                    <div class="col-sm-7">
                        <span class="font-weight-bold">Assessment Status</span><br>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: @php echo $gas_percentage @endphp%;"
                                aria-valuenow="@php echo $gas_percentage @endphp" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                @php echo $gas_percentage == 0 ? '0%' : $gas_percentage.'% Completed' @endphp
                            </div>
                        </div>
                        <div class="mt-2 container-fluid text-center">
                            <small class="text-secondary">
                                <span>@php echo $gas_answered @endphp</span> out of <span>@php echo $gas_total_q @endphp</span> Questions Answered
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center">
                        <?php
                            if($gas_total_q == $gas_answered)
                            {
                                ?>
                                    <span class="ml-4 text-secondary"><span>Done</span><i class="icon-check ml-2"></i></span>
                                <?php
                            }
                            else {
                                ?>
                                    <a href="{{ route('assessment.gas') }}" role="button" class="btn btn-outline-info btn-rounded px-5">
                                        <small>@php echo $gas_answered == 0 ? 'Take' : 'Continue' @endphp</small>
                                    </a>
                                <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        <!-- endregion GAS Strand Card -->

        <!-- region ABM Strand Card -->
            <div class="container mt-2">
                {{--  style="border-left: 4px solid #dc3545" --}}
                <div class="row bg-light cardManual px-5 py-3">
                    <div class="col-sm-3">
                        <h3 class="text-danger">AMB</h3>
                        <small class="text-secondary">Accountancy, Business and Management</small> 
                    </div>
                    <div class="col-sm-7">
                        <span class="font-weight-bold">Assessment Status</span><br>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: @php echo $abm_percentage @endphp%;"
                                aria-valuenow="@php echo $abm_percentage @endphp" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                @php echo $abm_percentage == 0 ? '0%' : $abm_percentage.'% Completed' @endphp
                            </div>
                        </div>
                        <div class="mt-2 container-fluid text-center">
                            <small class="text-secondary">
                                <span>@php echo $abm_answered @endphp</span> out of <span>@php echo $abm_total_q @endphp</span> Questions Answered
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center">
                        <?php
                            if($abm_total_q == $abm_answered)
                            {
                                ?>
                                    <span class="ml-4 text-secondary"><span>Done</span><i class="icon-check ml-2"></i></span>
                                <?php
                            }
                            else {
                                ?>
                                    <a href="{{ route('assessment.abm') }}" role="button" class="btn btn-outline-danger btn-rounded px-5">
                                        <small>@php echo $abm_answered == 0 ? 'Take' : 'Continue' @endphp</small>
                                    </a>
                                <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        <!-- endregion ABM Strand Card -->

        <!-- region HUMSS Strand Card -->
            <div class="container mt-2">
                {{--  style="border-left: 4px solid #28a745" --}}
                <div class="row bg-light cardManual px-5 py-3">
                    <div class="col-sm-3">
                        <h3 class="text-success">HUMSS</h3>
                        <small class="text-secondary">Humanities and Social Sciences</small> 
                        <br><br>
                    </div>
                    <div class="col-sm-7">
                        <span class="font-weight-bold">Assessment Status</span><br>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: @php echo $humss_percentage @endphp%;"
                                aria-valuenow="@php echo $humss_percentage @endphp" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                @php echo $humss_percentage == 0 ? '0%' : $humss_percentage.'% Completed' @endphp
                            </div>
                        </div>
                        <div class="mt-2 container-fluid text-center">
                            <small class="text-secondary">
                                <span>@php echo $humss_answered @endphp</span> out of <span>@php echo $humss_total_q @endphp</span> Questions Answered
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center">
                        <?php
                            if($humss_total_q == $humss_answered)
                            {
                                ?>
                                    <span class="ml-4 text-secondary"><span>Done</span><i class="icon-check ml-2"></i></span>
                                <?php
                            }
                            else {
                                ?>
                                    <a href="{{ route('assessment.humss') }}" role="button" class="btn btn-outline-success btn-rounded px-5">
                                        <small>@php echo $humss_answered == 0 ? 'Take' : 'Continue' @endphp</small>
                                    </a>
                                <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        <!-- endregion HUMMS Strand Card -->

         <!-- region Modals -->

            <!-- confirm cancelation of assessment modal -->
            <div class="modal fade" id="conf_cancelAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="conf_cancelAssessmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container pt-5 pb-4">
                                <div class="row">
                                    <div class="col-sm-12 text-center mb-4" id="div_cancel_progress">
                                        <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                        <span class="ml-2">
                                            Cancelling Assessment. Please wait...
                                        </span>
                                    </div>
                                    <div class="col-sm-12 text-center font-weight-bold" id="div_cancel_confirm">
                                        <span>Are you sure to cancel this assessment?</span>
                                        <br><br>
                                        <button type="button" class="btn btn-secondary px-5 btn-rounded" data-dismiss="modal"><small>No</small></button>
                                        <button type="button" class="btn btn-primary px-5 btn-rounded" onclick="cancelAssessment()"><small>Yes</small></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- endregion -->


        <div class="container mt-4">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-lg btn-primary btn-rounded px-5 mt-2" onclick="submitAssessment()"><small>Submit Assessment</small></button>
                    <button class="btn btn-lg btn-secondary btn-rounded px-5 mt-2"  onclick="confirm_cancelAssessment(<?php echo $student_id ?>)"><small>Cancel Assessment</small></button>
                </div>
            </div>
        </div>


@stop
@section('page_scripts')
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    $(document).ready(function(){
        cancelassessment_display("confirm");
    });

     //region loading

        $(document).bind('ajaxStart', function (){
            cancelassessment_display("progress");
        }).bind('ajaxStop', function (){
            cancelassessment_display("confirm");
        });
        
    // endregion loading
    var div = {
        confirm : $("#div_cancel_confirm"),
        progress : $("#div_cancel_progress")
    }

    //region script_functions

        var s_student_id;

        function confirm_cancelAssessment(student_id)
        {
            $("#conf_cancelAssessmentModal").modal('show');
            s_student_id = student_id;
        }

        function submitAssessment()
        {
            let stem_score = {{ $stem_percentage }};
            let gas_score = {{ $gas_percentage }};
            let abm_score = {{ $abm_percentage }};
            let humss_score = {{ $humss_percentage }};

            if(stem_score == 100 && gas_score == 100 && abm_score == 100 && humss_score == 100)
            {
                $("#evaluating_AssessmentModal").modal('show');
                $.ajax({
                    url: "{{ route('rank.scores') }}",
                    method: 'POST',
                    data: {
                        student_id : {{ $student_id }}
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        if(data.status == true && data.message == "ranked")
                        {
                            //region gmail feedback version 1
                                // // student 
                                // let fname = data.details.firstname;
                                // let email = data.details.email;

                                // // scores
                                // let stem_score = parseInt(data.details.stem_score);
                                // let gas_score = parseInt(data.details.gas_score);
                                // let humss_score = parseInt(data.details.humss_score);
                                // let abm_score = parseInt(data.details.abm_score);

                                // // score in percentage format
                                // let stem_score_per = stem_score / parseInt(data.stem_totalQ) * 100;
                                // let gas_score_per = gas_score / parseInt(data.gas_totalQ) * 100;
                                // let humss_score_per = humss_score / parseInt(data.humss_totalQ) * 100;
                                // let abm_score_per = abm_score / parseInt(data.abm_totalQ) * 100;

                                // // get rank
                                // var stemrank = data.student_data.indexOf(stem_score) + 1;
                                // var gasrank = data.student_data.indexOf(gas_score) + 1;
                                // var humssrank = data.student_data.indexOf(humss_score) + 1;
                                // var abmrank = data.student_data.indexOf(abm_score) + 1;

                                // // assign suggestion
                                // var stemSuggesstion = generateSuggestion(stemrank, getRemark(stem_score_per));
                                // var gasSuggestion = generateSuggestion(gasrank, getRemark(gas_score_per));
                                // var humssSuggestion = generateSuggestion(humssrank, getRemark(humss_score_per));
                                // var abmSuggestion = generateSuggestion(abmrank, getRemark(abm_score_per));

                                // //region gmail function
                                //     var gmail_body='<!DOCTYPE html>'+
                                //                     '<html lang="en">'+
                                //                     '<head>'+
                                //                         '<meta charset="UTF-8">'+
                                //                         '<meta name="viewport" content="width=device-width, initial-scale=1.0">'+
                                //                         '<meta http-equiv="X-UA-Compatible" content="ie=edge">'+
                                //                         '<title>Assessment Evaluation and Feedback</title>'+
                                //                     '</head>'+
                                //                     '<body style="background-color: #f8f9fA; font-family: sans-serif;line-height: 1.15;">'+
                                //                         '<br><br><br>'+
                                //                         '<div style="margin: auto; width: 85%; padding-right: 35px; padding-left: 35px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s; background-color: #fff;border-top: 4px solid #007bff; border-radius:5px">'+
                                //                             '<br>'+
                                //                             '<h2>'+
                                //                                 '<b><span style="color: #007bff">ACT</span></b>'+
                                //                                 '<span style="color: #6c757d">StrandGuide Online Assessment</span>'+
                                //                             '</h2>'+
                                //                             '<br>'+
                                //                             '<span>Hi <b>'+fname+'</b>!</span>'+
                                //                             '<br><br>'+
                                //                             '<span>Your assessment has been evaluated by ACT StrandGuide.... orem ipsum dolor sit, amet consectetur adipisicing elit. Enim nulla sed reiciendis dicta consectetur explicabo voluptates. Quas, hic cupiditate quidem incidunt iusto ab, sapiente repudiandae ipsam consequuntur debitis, cum deserunt?</span>'+
                                //                             '<br><br>'+
                                //                             '<span><b>Assessment Score Result</b></span>'+
                                //                             '<br><br>'+
                                //                             '<div style="overflow-x:auto;">'+
                                //                                 '<table style="border-collapse: collapse;width: 100%;border: 1px solid #ddd;">'+
                                //                                     '<tr>'+
                                //                                         '<th style="text-align: left; padding: 8px;"><small>Strand</small></th>'+
                                //                                         '<th style="text-align: left; padding: 8px;"><small>Score in Percentage</small></th>'+
                                //                                         '<th style="text-align: left; padding: 8px;"><small>Rank</small></th>'+
                                //                                         '<th style="text-align: left; padding: 8px;"><small>Remarks</small></th>'+
                                //                                         '<th style="text-align: left; padding: 8px;"><small>Suggestions</small></th>'+
                                //                                     '</tr>'+
                                //                                     '<tr style="background-color: #f2f2f2">'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >STEM</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+stem_score_per+'%</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+stemrank+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+getRemark(stem_score_per)+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;">'+stemSuggesstion+'</td>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >GAS</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+gas_score_per+'%</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+gasrank+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+getRemark(gas_score_per)+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;">'+gasSuggestion+'</td>'+
                                                                        
                                //                                     '</tr>'+
                                //                                     '<tr style="background-color: #f2f2f2">'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >ABM</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+abm_score_per+'%</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+abmrank+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+getRemark(abm_score_per)+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;">'+humssSuggestion+'</td>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >HUMSS</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+humss_score_per+'%</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+humssrank+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small>'+getRemark(humss_score_per)+'</small></td>'+
                                //                                         '<td style="text-align: left; padding: 8px;">'+abmSuggestion+'</td>'+
                                //                                     '</tr>'+
                                //                                 '</table>'+
                                //                                 '<br>'+
                                //                                 '<table style="border-collapse: collapse;width: 25%;border: 1px solid #ddd;">'+
                                //                                     '<tr style="background-color: #f2f2f2">'+
                                //                                         '<th style="text-align: left; padding: 8px;"><small>Remarks Hierarchy Legend</small></th>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >1. Excellent</small></td>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >2. Good</small></td>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >3. Average</small></td>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >4. Needs Improvement</small></td>'+
                                //                                     '</tr>'+
                                //                                     '<tr>'+
                                //                                         '<td style="text-align: left; padding: 8px;"><small >5. Poor</small></td>'+
                                //                                     '</tr>'+
                                //                                 '</table>'+
                                //                             '</div>'+

                                                            
                                                            
                                //                             ' <br><br><br>'+
                                //                         '</div>'+
                                                        
                                //                     '</body>'+
                                //                     '</html>';
                                // //endregion gmail function 
                            //endregion gmail feedback version 1
                                                                    
                            //region gmail feedback version 2
                                // student 
                                let fname = data.details.firstname;
                                let email = data.details.email;

                                // scores
                                let stem_score = parseInt(data.details.stem_score);
                                let gas_score = parseInt(data.details.gas_score);
                                let humss_score = parseInt(data.details.humss_score);
                                let abm_score = parseInt(data.details.abm_score);

                                // score in percentage format
                                let stem_score_per = stem_score / parseInt(data.stem_totalQ) * 100;
                                let gas_score_per = gas_score / parseInt(data.gas_totalQ) * 100;
                                let humss_score_per = humss_score / parseInt(data.humss_totalQ) * 100;
                                let abm_score_per = abm_score / parseInt(data.abm_totalQ) * 100;

                                // get rank
                                var stemrank = data.student_data.indexOf(stem_score) + 1;
                                var gasrank = data.student_data.indexOf(gas_score) + 1;
                                var humssrank = data.student_data.indexOf(humss_score) + 1;
                                var abmrank = data.student_data.indexOf(abm_score) + 1;

                                //region gmail function
                                    var gmail_body='<!DOCTYPE html>'+
                                                    '<html lang="en">'+
                                                    '<head>'+
                                                        '<meta charset="UTF-8">'+
                                                        '<meta name="viewport" content="width=device-width, initial-scale=1.0">'+
                                                        '<meta http-equiv="X-UA-Compatible" content="ie=edge">'+
                                                        '<title>Assessment Evaluation and Feedback</title>'+
                                                    '</head>'+
                                                    '<body style="background-color: #f8f9fA; font-family: sans-serif;line-height: 1.15;">'+
                                                        '<br><br><br>'+
                                                        '<div style="margin: auto; width: 85%; padding-right: 35px; padding-left: 35px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s; background-color: #fff;border-top: 4px solid #007bff; border-radius:5px">'+
                                                            '<br>'+
                                                            '<h2>'+
                                                                '<b><span style="color: #007bff">ACT</span></b>'+
                                                                '<span style="color: #6c757d">StrandGuide Online Assessment</span>'+
                                                            '</h2>'+
                                                            '<br>'+
                                                            '<span>Hi <b>'+fname+'</b>!</span>'+
                                                            '<br><br>'+
                                                            '<span>Your assessment has been evaluated by ACT StrandGuide.... orem ipsum dolor sit, amet consectetur adipisicing elit. Enim nulla sed reiciendis dicta consectetur explicabo voluptates. Quas, hic cupiditate quidem incidunt iusto ab, sapiente repudiandae ipsam consequuntur debitis, cum deserunt?</span>'+
                                                            '<br><br>'+
                                                            '<span><b>Assessment Score Result</b></span>'+
                                                            '<br><br>'+
                                                            '<div style="overflow-x:auto;">'+
                                                                '<table style="border-collapse: collapse;width: 100%;border: 1px solid #ddd;">'+
                                                                    '<tr>'+
                                                                        '<th style="text-align: left; padding: 8px;"><small>Strand</small></th>'+
                                                                        '<th style="text-align: left; padding: 8px;"><small>Score in Percentage</small></th>'+
                                                                        '<th style="text-align: left; padding: 8px;"><small>Rank</small></th>'+
                                                                    '</tr>'+
                                                                    '<tr style="background-color: #f2f2f2">'+
                                                                        '<td style="text-align: left; padding: 8px;"><small >STEM</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+stem_score_per+'%</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+stemrank+'</small></td>'+
                                                                    '</tr>'+
                                                                    '<tr>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small >GAS</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+gas_score_per+'%</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+gasrank+'</small></td>'+
                                                                        
                                                                    '</tr>'+
                                                                    '<tr style="background-color: #f2f2f2">'+
                                                                        '<td style="text-align: left; padding: 8px;"><small >ABM</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+abm_score_per+'%</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+abmrank+'</small></td>'+
                                                                    '</tr>'+
                                                                    '<tr>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small >HUMSS</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+humss_score_per+'%</small></td>'+
                                                                        '<td style="text-align: left; padding: 8px;"><small>'+humssrank+'</small></td>'+
                                                                    '</tr>'+
                                                                '</table>'+
                                                                '<br>'+
                                                            '</div>'+

                                                            
                                                            
                                                            ' <br><br><br>'+
                                                        '</div>'+
                                                        '<br><br>'+
                                                        
                                                    '</body>'+
                                                    '</html>';
                                //endregion gmail function 
                            //endregion gmail feedback version 2


                            Email.send({
                                securityToken: "5cc2cb9f-87e3-40e7-8ba4-7f9c5fd25875",
                                Host : "smtp.elasticemail.com",
                                Username : "johanbrooker08@gmail.com",
                                Password : "2C507B488940614611C0182904C3490BB0FF",
                                To : email,
                                From : "johanbrooker08@gmail.com",
                                Subject : "Assessment has been evaluated",
                                Body : gmail_body
                            }).then(function(message){
                                if(message == "OK")
                                {
                                    window.location.href = "{{ route('feedback.assessment') }}";
                                }
                            });
                        }
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }
                    
                });
            }
            else
            {
                $("#Message_AssessmentModal").modal("show");
            }
        }

        function getRemark(score)
        {
            if(score >= 81 && score <= 100)
            {
                return "Excellent";
            }
            else if(score >= 61 && score <= 80)
            {
                return "Good";
            }
            else if(score >= 41 && score <= 60)
            {
                return "Average";
            }
            else if(score >= 21 && score <= 40)
            {
                return "Needs Improvement";
            }
            else if(score >= 0 && score <= 20)
            {
                return "Poor";
            }
        }

        function generateSuggestion(rank, remark)
        {
            if(rank == 1)
            {
                if(remark == "Excellent")
                {
                    return '<small style="color: #28a745"><b>Highly Recommended Strand</b></small>'; 
                }
                else
                {
                    return '<small style="color: #28a745"><b>Prefered Strand</b></small>';
                }
            }
            else {
                return '<small>-</small>';
            }
        }

        function cancelassessment_display(view)
        {
            if(view == "confirm")
            {
                div.confirm.show();
                div.progress.hide();
            }
            else if(view == "progress")
            {
                div.confirm.hide();
                div.progress.show();
            }
        }

        function cancelAssessment()
        {
            $.ajax({
                url: "{{ route('student.unregister') }}",
                method: 'POST',
                data: {
                    student_id: s_student_id
                },
                dataType: 'json',
                success:function(data)
                {
                    if(data.status == true && data.message == "cancelled")
                    {
                        $("#conf_cancelAssessmentModal").modal('hide');
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
        }

    //endregion script_functions
    
</script>
@stop
