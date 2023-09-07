@extends('layouts.student.master')
@section('page_title', 'Assessment')

@section('page_content')

        @php
            
        @endphp

        @php
        
        @endphp

        <!-- region Modals -->

            <!-- confirm cancelation of assessment modal -->
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
                        <span class="float-right"><span class="font-weight-bold">Apao, Cariel Jay</span><br>
                        <small class="text-secondary">act.cjapao@gmail.com</small></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                    </div>
                </div>  
            </div>
        <!-- endregion Header -->

        <!-- region Assessment Content -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-question py-2" style="border-radius: 5px">
                           <div class="container py-3 px-4">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <span class="font-weight-bold">Assessment Progress Overview</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 py-3">
                                        <center>
                                            <div class="container-fluid" role="progressbar" 
                                                aria-valuenow="0" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100" 
                                                style="--value:0" 
                                                id="circle_progress">
                                            </div>
                                            {{-- <button class="btn btn-sm btn-primary" id="sampleClick">Click Me</button> --}}
                                        </center>
                                    </div>
                                </div>
                           </div>
                        </div>
                        <div class="card-question py-3 px-5 mt-4" style="border-radius: 5px">
                            <span>No. of Answered Questions: <span class="font-weight-bold" id="span_question_answered">{{ $count_done_answered }}</span></span>
                        </div>
                        <div class="card-question py-3 px-5 mt-2" style="border-radius: 5px">
                            <span>Total No. of Questions: <span class="font-weight-bold" id="span_question_total">{{ $total_no_questions }}</span></span>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card mb-2 bg-light errorAlert" id="error_msg_next" style="display: none;">
                            <div class="card-body">
                                <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                                <span>
                                    <!-- error message here -->
                                </span>
                            </div>
                        </div>
                        <?php
                            echo "<input type='hidden' value='".$questions->count()."' id='txt_q_totalcount' />"; 
                            $count = 0;
                            $ques = $questions->shuffle();
                            foreach($ques as $q)
                            {
                                $count++;
                                ?>
                                    <div class="card card-question <?php echo $count == 1 ? "Qs" : ""; ?>sty_question" item-no="<?php echo $count; ?>" style="border-left: 4px solid #007bff">
                                        {{-- <div class="card-header px-4">
                                            <span class="font-weight-bold">@php echo "Q".$count; @endphp</span>
                                        </div> --}}
                                        <div class="card-body py-5 px-5">
                                            <h5 class="card-title">@php echo $q->question @endphp</h5>
                                            
                                            <div class="form-check mt-4">
                                                <input class="form-check-input"
                                                    question-id="<?php echo $q->question_id ?>" 
                                                    type="radio"
                                                    name="rb_question<?php echo $q->question_id ?>"
                                                    id="rb_q<?php echo $q->question_id ?>_a1"
                                                    value="<?php echo $q->choice1 ?>"
                                                    strand-code="<?php echo $q->code ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a1">
                                                    <?php echo $q->choice1 ?>
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" 
                                                    question-id="<?php echo $q->question_id ?>" 
                                                    type="radio" 
                                                    name="rb_question<?php echo $q->question_id ?>" 
                                                    id="rb_q<?php echo $q->question_id ?>_a2" 
                                                    value="<?php echo $q->choice2 ?>"
                                                    strand-code="<?php echo $q->code ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a2">
                                                    <?php echo $q->choice2 ?>
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" 
                                                    question-id="<?php echo $q->question_id ?>" 
                                                    type="radio" 
                                                    name="rb_question<?php echo $q->question_id ?>" 
                                                    id="rb_q<?php echo $q->question_id ?>_a3" 
                                                    value="<?php echo $q->choice3 ?>"
                                                    strand-code="<?php echo $q->code ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a3">
                                                    <?php echo $q->choice3 ?>
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" 
                                                    question-id="<?php echo $q->question_id ?>" 
                                                    type="radio" 
                                                    name="rb_question<?php echo $q->question_id ?>" 
                                                    id="rb_q<?php echo $q->question_id ?>_a4" 
                                                    value="<?php echo $q->choice4 ?>"
                                                    strand-code="<?php echo $q->code ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a4">
                                                    <?php echo $q->choice4 ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }

                        ?>

                        <button type="button" class="btn btn-lg btn-primary float-right btn-rounded px-5 mt-4" id="btn_next"><small class="mx-5">Next</small></button>
                    </div>
                </div>
            </div>
            

        <!-- endregion  Assessment Content -->
        
       

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


        {{-- <div class="container mt-4">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-lg btn-primary btn-rounded px-5 mt-2" onclick="submitAssessment()"><small>Submit Assessment</small></button>
                    <button class="btn btn-lg btn-secondary btn-rounded px-5 mt-2"  onclick="confirm_cancelAssessment(<?php echo $student_id ?>)"><small>Cancel Assessment</small></button>
                </div>
            </div>
        </div> --}}


@stop
@section('page_scripts')
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    var next__ = 1;
    var item = {};
    const student_exam_answer =  new Array();
    var txt_q_totalcount = parseInt($("input#txt_q_totalcount").val());
    var reach_lastQ = false;
    var current_question_id = 0; // for identifying if there is an answer

    var Alert_E = {
        e : $("div#error_msg_next div span")
    };

    // var progress_value = 0;

    // var progress = document.getElementById("circle_progress");
    // $("#sampleClick").click(function(){
    //     // alert("ready");
    //     progress_value = progress_value + 2;
       
    //     progress.style.setProperty('--value', progress_value);
    // });

    $(document).ready(function(){
        /*
            default display of message
        */
        showCorrespondingQuestion(next__);
        generateProgress({{ $progress }});
    });

    //region loading

        $(document).bind('ajaxStart', function (){
            $("#checking_AssessmentModal").modal("show");
        }).bind('ajaxStop', function (){
            $("#checking_AssessmentModal").modal("hide");
        });
        
    // endregion loading

    // check if browser refresh/back&forward button were pressed
    // window.onbeforeunload = function() { 
    //     $.ajax({
    //         url: " route('testing') ",
    //         method: 'GET',
    //         data: {
    //             data : "data"
    //         },
    //         dataType: 'json',
    //         success:function(data)
    //         {
    //             console.log(data);
    //         },
    //         error:function(err)
    //         {
    //             console.log(err);
    //         }
    //     });
    // };

    $("input[question-id]").change(function(){
        let student_answer = $(this).val();
        let question_id = $(this).attr('question-id');
        let strand_code = $(this).attr('strand-code');

        item = {};
        item.student_answer = student_answer;
        item.question_id = question_id;
        item.strand_code = strand_code;

        current_question_id = question_id;
    });
    
    $("#btn_next").click(function()
    {
        // check if next__ variable exceeds 1 the total number of questions
        if(reach_lastQ == true && next__ > txt_q_totalcount)
        {
            alert("Ready to calculate score1");
        }
        else
        {   
            // check if current question was being answered
            if($("input[name='rb_question"+current_question_id+"']").val() == undefined)
            {
                Alert_E.e.text("Kindly select an answer");
                $("div#error_msg_next").show();
            }
            else
            {
                Alert_E.e.text("");
                $("div#error_msg_next").hide();

                student_exam_answer.push(item);
                if(next__ < txt_q_totalcount)
                {
                    $(this).html("<small class='mx-5'>Next</small>"); 
                }
                else if(next__ == txt_q_totalcount)
                {
                    // change button text
                    $(this).html("<small class='mx-5'>Next</small>");
                }

                // check if ready to save/finish answering
                if(reach_lastQ == true)
                {
                    generateProgress(100);
                    check_student_answers(student_exam_answer);
                }
                else
                {
                    updateProgress(current_question_id);
                    //reset current_question_id variable
                    current_question_id = 0;
                    // show next
                    showCorrespondingQuestion(next__);
                }
            }
            
        }

    });

    //region script_functions
        function updateProgress(question_id)
        {
            $.ajax({
                url: "{{ route('assessment.updateProgress') }}",
                method: 'POST',
                data: {
                    question_id: question_id //this is the current question that was being viewed
                },
                dataType: 'json',
                success:function(data)
                {
                    if(data.status == true && data.message == "updated")
                    {
                        //console.log(data);
                        generateProgress(data.progress, data.total_questions, data.answered);
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

        var progress = document.getElementById("circle_progress");

        function generateProgress(progressValue, t_questions, t_answered)
        {
            // update circular progress
            progress.style.setProperty('--value', Math.round(progressValue));

            // update number of answered questions
            $("#span_question_answered").text(t_answered);
            $("#span_question_total").text(t_questions);
        }

        function showCorrespondingQuestion(item_no)
        {
            // check if the item no == 1 or first question
            if(item_no == 1)
            {
                $("div[item-no='"+item_no+"']").removeClass("Qs");
            }
            
            // the questions will keep showing if the current count does not exceed the total number of questions
            if(item_no <= txt_q_totalcount)
            {
                $("div[item-no]").hide();
                $("div[item-no='"+item_no+"']").show();
            }
            
            // check if the count variable next exceeds the total number of question
            if(item_no == txt_q_totalcount)
            {
                reach_lastQ = true;
            }
            else
            {
                next__++;
            }
        }

        function check_student_answers(answers)
        {
            $("#evaluating_AssessmentModal").modal('show');
            $.ajax({
                url: "{{ route('assessment.check_answers') }}",
                method: 'POST',
                data: {
                    answers : answers,
                    student_id : {{ $student_id }}
                },
                dataType: 'json',
                success:function(data)
                {
                    if(data.status == true && data.message == "checked")
                    {
                        evaluateAssessment();
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

        function evaluateAssessment()
        {
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
                                                        '<span>Your assessment has been reviewed by the <span>ACT<span> StrandGuide. Due to the Data Privacy Act, this system will not fully record this result and will dispose of it after its intended use. This feedback shows the results of your assessment of the StrandGuide. Don\'t take this result as an official indicator of your knowledge since you still have the capability to go beyond this result if you continue to study hard. We appreciate your time in completing the assessment. Have a wonderful day.</span>'+
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

                        // account 1
                        // Email.send({
                        //     securityToken: "5cc2cb9f-87e3-40e7-8ba4-7f9c5fd25875",
                        //     Host : "smtp.elasticemail.com",
                        //     Username : "johanbrooker08@gmail.com",
                        //     Password : "2C507B488940614611C0182904C3490BB0FF",
                        //     To : email,
                        //     From : "johanbrooker08@gmail.com",
                        //     Subject : "Assessment has been evaluated",
                        //     Body : gmail_body
                        // }).then(function(message){
                        //     if(message == "OK")
                        //     {
                        //         window.location.href = "{{ route('feedback.assessment') }}";
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
    //endregion script_functions
    
</script>
@stop
