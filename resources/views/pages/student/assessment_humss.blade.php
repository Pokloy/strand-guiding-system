@extends('layouts.student.master')
@section('page_title', 'HUMSS Assessment')

@section('page_content')

    <!-- region Modals -->

        <!-- confirm cancelation of assessment modal -->
        <div class="modal fade" id="checking_AssessmentModal" tabindex="-1" role="dialog" aria-labelledby="checking_AssessmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container pt-5 pb-4">
                            <div class="row">
                                <div class="col-sm-12 text-center mb-4" id="div_cancel_progress">
                                    <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                    <span class="ml-2">
                                        Loading. Please wait...
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- endregion -->

    <div class="container mt-5">
        
        <div class="row">
            <div class="col-sm-12">
                {{--  <small class="text-secondary">(20% Completed)</small> --}}
                <h2><span class="text-success">HUMSS</span> Strand Assessment</h2>
                <small class="text-secondary">Humanities and Social Sciences</small>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <!-- <?php
                    foreach ($humss_questions as $q) {
                        ?>
                            <span class="badge badge-pill <?php echo $q->is_answered == 0 ? 'bg-light' : 'bg-warning' ?> px-2 py-2" onclick="showCorrespondingQuestion(<?php echo $q->question_id ?>)"> </span>
                        <?php      
                    }
                ?> -->
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12">
                {{-- @for($c=1;$c<=$humss_total_no_q;$c++)
                    <span class="badge badge-pill badge-warning px-2 py-2"> </span>
                @endfor  --}}
                
                <div class="card mb-2 bg-light errorAlert" id="error_msg_next" style="display: none">
                    <div class="card-body">
                        <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                        <span>
                            <!-- error message here -->
                        </span>
                    </div>
                </div>

                <div class="card cardManual pt-4 pb-4 px-3" style="border-left: 4px solid #28a745">
                    <div class="card-body">
                        <?php
                            echo "<input type='hidden' value='".$humss_questions->count()."' id='txt_q_totalcount' />"; 
                            $count = 0; 
                        
                            foreach ($humss_questions as $q) {
                                $count++;
                                ?>
                                    <!-- region The rest of the Questions -->
                                        <div class="<?php echo $count == 1 ? "Qs" : ""; ?> sty_question" item-no="<?php echo $count ?>">
                                            <h5 class="card-title"><?php echo $count ?>. <?php echo $q->question ?></h5>
                                            <div class="mx-5 mt-5">
                                                <input class="form-check-input" question-id="<?php echo $q->question_id ?>" type="radio" name="rb_question<?php echo $q->question_id ?>" id="rb_q<?php echo $q->question_id ?>_a1" value="<?php echo $q->choice1 ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a1">
                                                    <?php echo $q->choice1 ?>
                                                </label> <br><br>
                                                <input class="form-check-input" question-id="<?php echo $q->question_id ?>" type="radio" name="rb_question<?php echo $q->question_id ?>" id="rb_q<?php echo $q->question_id ?>_a2" value="<?php echo $q->choice2 ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a2">
                                                    <?php echo $q->choice2 ?>
                                                </label><br><br>
                                                <input class="form-check-input" question-id="<?php echo $q->question_id ?>" type="radio" name="rb_question<?php echo $q->question_id ?>" id="rb_q<?php echo $q->question_id ?>_a3" value="<?php echo $q->choice3 ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a3">
                                                    <?php echo $q->choice3 ?>
                                                </label><br><br>
                                                <input class="form-check-input" question-id="<?php echo $q->question_id ?>" type="radio" name="rb_question<?php echo $q->question_id ?>" id="rb_q<?php echo $q->question_id ?>_a4" value="<?php echo $q->choice4 ?>">
                                                <label class="form-check-label p_cursor" for="rb_q<?php echo $q->question_id ?>_a4">
                                                    <?php echo $q->choice4 ?>
                                                </label>
                                            </div>
                                        </div>
                                    <!-- endregion The rest of the Questions -->
                                <?php

                            }    
                        
                        
                        ?>
                        



                        <button type="button" class="btn btn-primary btn-rounded mt-5 float-right px-5" id="btn_next">Next</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('page_scripts')
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

        $(document).ready(function(){
            /*
                default display of message
            */
            showCorrespondingQuestion(next__);
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
        //         url: "{{ route('testing') }}",
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

            item = {};
            item.student_answer = student_answer;
            item.question_id = question_id;

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
                    //reset current_question_id variable
                    current_question_id = 0;
                    Alert_E.e.text("Kindly select an answer");
                    $("div#error_msg_next").hide();

                    student_exam_answer.push(item);
                    if(next__ < txt_q_totalcount)
                    {
                        $(this).text("Next"); 
                    }
                    else if(next__ == txt_q_totalcount)
                    {
                        // change button text
                        $(this).text("Finish");
                    }
                    

                    // check if ready to save/finish answering
                    if(reach_lastQ == true)
                    {
                        check_student_answers(student_exam_answer);
                    }
                    else
                    {
                        // show next
                        showCorrespondingQuestion(next__);
                    }
                }
                
            }

        });

        //region script_functions
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
                $.ajax({
                    url: "{{ route('assessment.check_answers') }}",
                    method: 'POST',
                    data: {
                        s_code : "HUMSS",
                        answers : answers,
                        student_id : {{ $student_id }}
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        $("#checking_AssessmentModal").modal('hide');
                        window.location = "{{ route('assessment') }}";
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
