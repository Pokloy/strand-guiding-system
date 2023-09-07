@extends('layouts.student.master')
@section('page_title', 'Assessment')

@section('page_content')
        <div class="container py-5">
            <div class="row cardPreassessment px-5 py-5 mt-3">
                <div class="col-sm-6 py-5">
                    <h3>
                        <span class="font-weight-bold text-primary">ACT</span>
                        <span class="text-secondary">StrandGuide <br> Online Assessment</span>
                    </h3>
                    <br>

                    <span>
                        Be sure to have a strong internet connection before taking the assessment, so that everything proceeds smoothly. 
                        <span class="font-weight-bold text-primary">StrandGuide</span> will evaluate the results of this assessment and generate comprehensive results that will be sent through Gmail after the assessment has been completed.
                        In this assessment, you will receive feedback based on the answers you provide. Make sure you answer this assessment to the best of your ability. Good luck and stay focused.

                        <br><br>
                        Click the "Begin Assessment" button below if you are ready.
                    </span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>
                        <a href="{{ route('process.assessment') }}" role="button" class="btn btn-primary btn-rounded px-4 mt-1">
                            
                            <?php 

                                if(Session::has('assessment_status'))
                                {
                                    echo "Continue Assessment";
                                }
                                else
                                {
                                    echo "Begin Assessment";
                                }
                                
                            ?>
                        </a>
                        <button class="btn btn-outline-secondary btn-rounded px-4 mt-1" onclick="confirm_cancelAssessment(<?php echo $student_id ?>)">
                            Cancel Assessment
                        </button>
                    </center>
                </div>
                <div class="col-sm-6 py-5">
                    <img class="img-fluid" src="{{ asset('assets/img/draw/isometric_homepage.jpg') }}" alt="">
                </div>
            </div>



        </div>


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
@stop
@section('page_scripts')
    <script>
        $(document).ready(function(){
            /*
                defaults
            */
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
            
            function cancelAssessment()
            {
                $.ajax({
                    url: "{{ route('student.unregister') }}",
                    method: 'POST',
                    data: {
                        student_id: s_student_id,
                        view : "preassessment"
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
        //endregion script_functions
        
    </script>
@stop
