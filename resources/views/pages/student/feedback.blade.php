<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/manual.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/icomoon/style.css') }}">
    <title>StrandGuide | Assessment</title>
</head>
<body>

    <div class="container">

        {{-- <div class="row mt-3">
            <div class="col-sm-12 text-center">
                <h2><span class="text-primary">Assessment</span><span class="text-dark"> Feedback</span></h2>
            </div>
        </div> --}}
        <br>
        <div class="row mt-5 px-5 py-5 mb-5 cardAssessment_success" style="border-top: 5px solid #007AFF">
            <div class="col-sm-12">
                <h1 class="font-weight-bold text-primary" style="font-size: 50px">Success!</h1>
                <h4>We have successfully evaluated your assessment. Please check your email for the evaluation results.</h4>

                <br><br>
                <h5><span>We are pleased to have assisted you in selecting an academic strand through <span class="font-weight-bold text-primary">StrandGuide</span>. </span>
                <span>It is our hope that <span class="font-weight-bold text-primary">StrandGuide</span> helped you make an informed decision on your Senior High School Career.</span></h5>
            
                <br><br>
                <button class="btn btn-secondary btn-rounded px-5 py-2 float-right" onclick="exitAssessment()"><span class="mx-3">Done</span></button>
            
            </div>
            {{-- <div class="col-sm-6">
                <img src="{{ asset('assets/img/draw/evaluated.png') }}" class="img-fluid" alt="Responsive image">
            </div> --}}
        </div>




    </div>

    <!-- region Modals -->

        <!-- confirm cancelation of assessment modal -->
        <div class="modal fade" id="ExitAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="ExitAssessmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container pt-5 pb-4">
                            <div class="row">
                                <div class="col-sm-12 text-center mb-4">
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
    <script src="{{ asset('assets/bootstrap/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        //region script_functions
            function exitAssessment()
            {
                $("#ExitAssessmentModal").modal("show");
                $.ajax({
                    url: "{{ route('assessment.exit') }}",
                    method: 'POST',
                    data: {
                        student_id: {{Session::get('assessment_status')}}
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        if(data.status == true && data.message == "exit")
                        {
                            $("#ExitAssessmentModal").modal("hide");
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
</body>
</html>        
        