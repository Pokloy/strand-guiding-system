@extends('layouts.assessor.master')
@section('page_styles')

@stop
@section('title', 'User Story')

@section('page_content')

    <div class="container">

        <div class="row mt-4">

            <div class="col-sm-12">
                
                <h4>{{ $strand->name }}</h4>
                <span>Strand Status: </span><span class="badge badge-pill {{ $strand->status == 'Active' ? 'badge-success' : 'badge-danger' }} ">{{ $strand->status }}</span>
                <span><i class="fas fa-info-circle mx-2 text-secondary" data-toggle="collapse" href="#collapseStrandAbout" role="button" aria-expanded="false" aria-controls="collapseStrandAbout"></i></span>

                <div class="collapse mt-3" id="collapseStrandAbout">
                    <div class="card card-body" style="border-left: 3px solid #007bff">
                        {{ $strand->about }}
                    </div>
                </div>

            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-sm-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="questions-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions" aria-selected="true">List of Questions</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="students" aria-selected="false">Students</a>
                    </li> -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                        
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <span>
                                    @if($items == 1 || $items == 0)
                                        <span class="font-weight-bold">Item:</span> <span>{{ $items }}</span>
                                    @else
                                        <span class="font-weight-bold">Items:</span> <span>{{ $items }}</span>
                                    @endif
                                </span>
                                <br>
                                @if($items <= 5)
                                    <span>
                                        <span class="font-weight-bold">Note:</span>
                                        <span class="text-secondary">There should be at least five questions. Please add more questions.</span>
                                        <span class="text-danger font-weight-bold">*</span>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#ListofQuestionsModal">@php echo $items == 0 ? 'Add Questions' : 'Modify List of Questions' @endphp</button>
                            </div>
                        </div>
                        <div class="row mt-3 mb-5 pb-5">
                            <div class="col-sm-12">
                                <table class="table table-hover" id="tblquestions">
                                    <thead>
                                        <tr>
                                            <th scope="col">Questions</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_tblquestions">
                                        <!-- <tr>
                                            <th scope="row">1</th>
                                            <td>Multiple Choice</td>
                                            <td>What is the smallest unit of life?</td>
                                            <td>
                                                <i class="fas fa-tasks p_cursor text-secondary action_q mr-2"></i>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane" id="students" role="tabpanel" aria-labelledby="students-tab">
                        <span>Students</span>
                    </div>
                </div>
            </div>
        </div>    

    </div>

    <!-- region modals -->

        <div class="modal fade" id="ListofQuestionsModal" tabindex="-1" role="dialog" aria-labelledby="ListofQuestionsModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ListofQuestionsModalTitle">
                            <i class="fas fa-tasks mr-2"></i>
                            {{ $strand->name }} - List of Questions
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-5">
                        <div class="container">

                            <!-- region List of Question Section -->

                                <div class="row" id="d_row_list">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary px-4" onclick="switchView('add')">Add</button>
                                    </div>
                                    <div class="col-sm-12 mt-3">
                                        <!-- region alerts and loading -->
                                            <div class="card mb-2 bg-light" id="confirm_delete_msg" style="border-left: 2px solid #dc3545">
                                                <div class="card-body">
                                                    <i class="fas fa-exclamation-triangle mr-2 text-danger"></i>
                                                    <span>
                                                        Are you sure to delete this question?
                                                        <input type="hidden" id="txt_questionid2dlt">
                                                        <button type="button" class="btn btn-secondary float-right px-3" id="btn_cancel_dltQ" onclick="show_confirm_dlt('hide', '')"><small>Cancel</small></button>
                                                        <button type="button" class="btn btn-secondary float-right px-4 mr-2" id="btn_yes_dltQ"><small>Yes</small></button>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card mb-2 bg-light successAlert" id="success_msg_d">
                                                <div class="card-body">
                                                    <i class="fas fa-check-circle mr-2 text-success"></i>
                                                    <span>
                                                        <!-- success message here -->
                                                    </span>
                                                </div>
                                            </div>
                                        <!-- endregion -->
                                        <br>
                                        <table class="table" id="tblquestions2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Question</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_tblquestions2">
                                                <!-- region table question sample row -->
                                                    <tr>
                                                        <td>
                                                            <div class="card bg-light action_q">
                                                                <div class="card-body">
                                                                    <span class="p_cursor" data-toggle="collapse" href="#collapseAnswers" aria-expanded="false" aria-controls="collapseExample">
                                                                        <i class="fas fa-angle-down p_cursor text-secondary action_q mr-2"></i>
                                                                        <span>What is the smallest unit of life?</span>
                                                                    </span>

                                                                    <span class="float-right">
                                                                        <i class="fas fa-pen p_cursor text-secondary action_q mr-2"></i>
                                                                        <i class="fas fa-trash p_cursor text-secondary action_q"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="collapse" id="collapseAnswers">
                                                                <div class="card card-body">
                                                                    <form>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Bacteria">
                                                                            <label class="form-check-label" for="exampleRadios1">
                                                                                Bacteria
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Organism">
                                                                            <label class="form-check-label" for="exampleRadios1">
                                                                                Organism
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Cell">
                                                                            <label class="form-check-label" for="exampleRadios1">
                                                                                Cell
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="None of the above">
                                                                            <label class="form-check-label" for="exampleRadios1">
                                                                                None of the above
                                                                            </label>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <!-- endregion -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <!-- endregion -->

                            <!-- region Add New Question Section -->

                                <div class="row" id="d_row_add" style="display: none">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary px-3" onclick="switchView('list')">View List</button>

                                        <form class="mt-3">

                                            <!-- region alerts and loading -->
                                                <div class="card mb-2 bg-light errorAlert" id="error_msg_a">
                                                    <div class="card-body">
                                                        <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                                                        <span>
                                                            <!-- error message here -->
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="card mb-2 bg-light successAlert" id="success_msg_a">
                                                    <div class="card-body">
                                                        <i class="fas fa-check-circle mr-2 text-success"></i>
                                                        <span>
                                                            <!-- success message here -->
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="card mb-2" id="addQuestion_loading">
                                                    <div class="card-body">
                                                        <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                                        <span class="ml-2">
                                                            <!-- success message here -->
                                                            Please wait...
                                                        </span>
                                                    </div>
                                                </div>
                                            <!-- endregion -->

                                            <input type="hidden" value="{{ $strand->strand_id }}" id="txt_addQ_strandid">
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <label class="font-weight-bold" for="txt_addQ_question">Question</label>
                                                    <textarea class="form-control" id="txt_addQ_question" rows="3"></textarea>
                                                </div> 
                                            </div>


                                            <br>
                                            <label class="font-weight-bold">Responses</label>
                                            <span>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_addQ_correct_answer" choice="choice1">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_addQ_choice1" rows="2" placeholder="choice 1"></textarea>
                                                    </div> 
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_addQ_correct_answer" choice="choice2">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_addQ_choice2" rows="2" placeholder="choice 2"></textarea>
                                                    </div> 
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_addQ_correct_answer" choice="choice3">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_addQ_choice3" rows="2" placeholder="choice 3"></textarea>
                                                    </div> 
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_addQ_correct_answer" choice="choice4">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_addQ_choice4" rows="2" placeholder="choice 4"></textarea>
                                                    </div> 
                                                </div>
                                            </span>
                                            <button type="button" class="btn float-right btn-primary mt-3 px-5" id="btnAddQuestion">Add</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            
                            <!-- endregion -->

                            <!-- region Edit Question Section -->

                                <div class="row" id="d_row_edit" style="display: none">
                                    <div class="col-sm-12">
                                        <button class="btn btn-secondary px-3" onclick="switchView('list')">Cancel Edit</button>

                                        <form class="mt-3">

                                            <!-- region alerts and loading -->
                                                <div class="card mb-2 bg-light errorAlert" id="error_msg_e">
                                                    <div class="card-body">
                                                        <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                                                        <span>
                                                            <!-- error message here -->
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="card mb-2 bg-light successAlert" id="success_msg_e">
                                                    <div class="card-body">
                                                        <i class="fas fa-check-circle mr-2 text-success"></i>
                                                        <span>
                                                            <!-- success message here -->
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="card mb-2" id="editQuestion_loading">
                                                    <div class="card-body">
                                                        <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                                        <span class="ml-2">
                                                            <!-- success message here -->
                                                            Please wait...
                                                        </span>
                                                    </div>
                                                </div>
                                            <!-- endregion -->
                                            <input type="hidden" value="{{ $strand->strand_id }}" id="txt_editQ_strandid">
                                            <input type="hidden" id="txt_editQ_questionid">
                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <label class="font-weight-bold" for="txt_editQ_question">Question</label>
                                                    <textarea class="form-control" id="txt_editQ_question" rows="3"></textarea>
                                                </div> 
                                            </div>


                                            <br>
                                            <label class="font-weight-bold">Responses</label>
                                            <span>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_editQ_correct_answer" choice="choice_e1">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_editQ_choice_e1" rows="2" placeholder="choice 1"></textarea>
                                                    </div> 
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_editQ_correct_answer" choice="choice_e2">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_editQ_choice_e2" rows="2" placeholder="choice 2"></textarea>
                                                    </div> 
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_editQ_correct_answer" choice="choice_e3">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_editQ_choice_e3" rows="2" placeholder="choice 3"></textarea>
                                                    </div> 
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-sm-1 d-flex align-items-center">
                                                        <input type="radio" class="form-control remove_outline" name="txt_editQ_correct_answer" choice="choice_e4">
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" id="txt_editQ_choice_e4" rows="2" placeholder="choice 4"></textarea>
                                                    </div> 
                                                </div>
                                            </span>
                                            <button type="button" class="btn float-right btn-primary mt-3 px-5" id="btnEditQuestion">Save</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            
                            <!-- endregion -->


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="Multiple_modalAnswers" tabindex="-1" role="dialog" aria-labelledby="Multiple_modalAnswersTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Multiple_modalAnswersTitle">Multiple Choice Responses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="span_m_answers">
                            <form>
                                <!-- add content here which are the responses -->
                            </form>     
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="$('#Multiple_modalAnswers').modal('hide');">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- endregion -->

    

@stop

@section('page_scripts')
    <script>
        
        var BTN = {
            addQ : $("#btnAddQuestion"),
            editQ : $("#btnEditQuestion"),
            c_dQ: $("#btn_cancel_dltQ"),
            y_dQ: $("#btn_yes_dltQ")
        }

        var TXT_addQ = {
            
            //region question details
            
                strandid : $("#txt_addQ_strandid"),
                question : $("#txt_addQ_question"),
                answer : "",

            //endregion question details

            //region question type choices

                mc : {
                    c1 : $("#txt_addQ_choice1"),
                    c2 : $("#txt_addQ_choice2"),
                    c3 : $("#txt_addQ_choice3"),
                    c4 : $("#txt_addQ_choice4")
                },

                tf : {

                },

                ii : {
                    
                }

            //endregion question type choices
        }

        var Alert_A = {
            e : $("div#error_msg_a div span"),
            s : $("div#success_msg_a div span")
        };

        var TXT_editQ = {
            
            //region question details

                questionid: $("#txt_editQ_questionid"),
                strandid : $("#txt_editQ_strandid"),
                type : $("#txt_editQ_questiontype"),
                p_correct : $("#txt_editQ_correctP"),
                p_wrong : $("#txt_editQ_wrongP"),
                question : $("#txt_editQ_question"),
                answer : "",

            //endregion question details

            //region question type choices

                mc : {
                    c1 : $("#txt_editQ_choice_e1"),
                    c2 : $("#txt_editQ_choice_e2"),
                    c3 : $("#txt_editQ_choice_e3"),
                    c4 : $("#txt_editQ_choice_e4")
                },

                tf : {

                },

                ii : {
                    
                }

            //endregion question type choices
        }

        var Alert_E = {
            e : $("div#error_msg_e div span"),
            s : $("div#success_msg_e div span")
        };

        var Alert_D = {
            s : $("div#success_msg_d div span")
        };

        //region loading
        
            $(document).bind('ajaxStart', function (){
                    $("#addQuestion_loading").show();
            }).bind('ajaxStop', function (){
                    $("#addQuestion_loading").hide();
            });

            $(document).bind('ajaxStart', function (){
                    $("#editQuestion_loading").show();
            }).bind('ajaxStop', function (){
                    $("#editQuestion_loading").hide();
            });

        // endregion loading

        $(document).ready(function(){
            fetchQuestionList_main();
            fetchQuestionList();

            $("#tblquestions").DataTable();

            /*
                defualt display
            */

            $("div#error_msg_a").hide();
            $("div#success_msg_a").hide();
            $("div#addQuestion_loading").hide();

            $("div#error_msg_e").hide();
            $("div#success_msg_e").hide();
            $("div#editQuestion_loading").hide();

            $("div#success_msg_d").hide();
            
            show_confirm_dlt('hide', '');
        });

        BTN.addQ.click(function(){

            // check the fields of the question details

            if(!val_addQ(TXT_addQ.question))
            {
                Alert_A.e.text("Please make sure the fields are not empty");
                $("div#error_msg_a").show();
            }
            else
            {
                Alert_A.e.text("");
                $("#error_msg_a").hide();

                if(!val_addQ(TXT_addQ.mc.c1) || !val_addQ(TXT_addQ.mc.c2) || !val_addQ(TXT_addQ.mc.c3) || !val_addQ(TXT_addQ.mc.c4))
                {
                    Alert_A.e.text("Please make sure the fields are not empty");
                    $("div#error_msg_a").show();
                }
                else
                {
                    Alert_A.e.text("");
                    $("#error_msg_a").hide();
                    // check if the user selected the correct answer
                    
                    if(TXT_addQ.answer == "")
                    {
                        Alert_A.e.text("Kindly select the correct answer for this question");
                        $("div#error_msg_a").show();
                    }
                    else
                    {
                        Alert_A.e.text("");
                        $("#error_msg_a").hide();
                        $.ajax({
                            url: "{{ route('add.question') }}",
                            method: "POST",
                            data: {
                                // question details
                                strandid: TXT_addQ.strandid.val(),
                                question: TXT_addQ.question.val(),
                                answer: TXT_addQ.answer,
                                // question choices
                                c1: TXT_addQ.mc.c1.val(),
                                c2: TXT_addQ.mc.c2.val(),
                                c3: TXT_addQ.mc.c3.val(),
                                c4: TXT_addQ.mc.c4.val()
                            },
                            dataType: "json",
                            success:function(data)
                            {
                                if(data.status == true && data.message == "added")
                                {
                                    Alert_A.s.text("Question Added Successfully");
                                    $("div#success_msg_a").show();
                                    clear_fields();
                                    
                                    setTimeout(function(){
                                        $("#success_msg_a").hide();
                                    },2000);
                                    setTimeout(function(){
                                        // update the datatable for the list of questions
                                        fetchQuestionList();
                                        switchView('list');
                                    },2500);
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
                }
            }

        });

        BTN.editQ.click(function(){

            // check the fields of every question type

            if(!val_addQ(TXT_editQ.question))
            {
                Alert_E.e.text("Please make sure the fields are not empty");
                $("div#error_msg_e").show();
            }
            else
            {
                Alert_E.e.text("");
                $("#error_msg_e").hide();

                if(!val_addQ(TXT_editQ.mc.c1) || !val_addQ(TXT_editQ.mc.c2) || !val_addQ(TXT_editQ.mc.c3) || !val_addQ(TXT_editQ.mc.c4))
                {
                    Alert_E.e.text("Please make sure the fields are not empty");
                    $("div#error_msg_e").show();
                }
                else
                {
                    Alert_E.e.text("");
                    $("#error_msg_e").hide();
                    // check if the user selected the correct answer
                    
                    if(TXT_editQ.answer == "")
                    {
                        Alert_E.e.text("Kindly select the correct answer for this question");
                        $("div#error_msg_a").show();
                    }
                    else
                    {
                        Alert_E.e.text("");
                        $("#error_msg_e").hide();
                        
                        $.ajax({
                            url: "{{ route('update.question') }}",
                            method: "POST",
                            data: {
                                // question details
                                questionid: TXT_editQ.questionid.val(),
                                strandid: TXT_editQ.strandid.val(),
                                question: TXT_editQ.question.val(),
                                answer: TXT_editQ.answer,
                                // question choices
                                c1: TXT_editQ.mc.c1.val(),
                                c2: TXT_editQ.mc.c2.val(),
                                c3: TXT_editQ.mc.c3.val(),
                                c4: TXT_editQ.mc.c4.val()
                            },
                            dataType: "json",
                            success:function(data)
                            {
                                if(data.status == true && data.message == "updated")
                                {
                                    Alert_E.s.text("Question Updated Successfully");
                                    $("div#success_msg_e").show();
                                    clear_fields();

                                    // update the datatable for the list of questions
                                    fetchQuestionList();
                                    
                                    setTimeout(function(){
                                        $("#success_msg_e").hide();
                                    },2000);
                                    setTimeout(function(){
                                        switchView('list');
                                    },2500);
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
                }
            }
        });

        BTN.y_dQ.click(function(){
            var questionid = $("#txt_questionid2dlt").val();
            show_confirm_dlt('hide', '');
            $.ajax({
                url: "{{ route('delete.question') }}",
                method: "POST",
                data: {
                    questionid: questionid
                },
                dataType: "json",
                success:function(data)
                {
                    if(data.status == true && data.message == "deleted")
                    {
                        Alert_D.s.text("Question Deleted Successfully");
                        $("div#success_msg_d").show();
                        clear_fields();

                        // update the datatable for the list of questions
                        fetchQuestionList();
                        
                        setTimeout(function(){
                            $("#success_msg_d").hide();
                        },2000);
                        setTimeout(function(){
                            switchView('list');
                        },2500);
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

        });

        // selecting of correct answer event handler for add question

        $("input[name='txt_addQ_correct_answer']").change(function(){
            let correct_answer = $(this).attr("choice");
            TXT_addQ.answer = $("textarea#txt_addQ_" + correct_answer).val();
        });

        // selecting of correct answer event handler for edit question

        $("input[name='txt_editQ_correct_answer']").change(function(){
            let correct_answer = $(this).attr("choice");
            TXT_editQ.answer = $("textarea#txt_editQ_" + correct_answer).val();
        });


        //region script_functions
            function switchView(view)
            {
                $("div#d_row_list").hide();
                $("div#d_row_add").hide();
                if(view == 'add')
                {
                    $("div#d_row_add").show();
                    $("div#d_row_list").hide();
                    $("div#d_row_edit").hide();
                }
                else if(view == 'list')
                {
                    $("div#d_row_list").show();
                    $("div#d_row_add").hide();
                    $("div#d_row_edit").hide();
                }
                else if(view == 'edit')
                {
                    $("div#d_row_edit").show();
                    $("div#d_row_list").hide();
                    $("div#d_row_add").hide();
                }
            }

            function val_addQ(caller)
            {
                if(caller.val() == "")
                {
                    caller.addClass("is-invalid");
                    return false;
                }
                else
                {
                    caller.removeClass("is-invalid");
                    return true;
                }
            }

            function clear_fields()
            {
                TXT_addQ.question.val("");
                TXT_addQ.answer = "";

                TXT_addQ.mc.c1.val("");
                TXT_addQ.mc.c2.val("");
                TXT_addQ.mc.c3.val("");
                TXT_addQ.mc.c4.val("");

                $("input[name='txt_addQ_correct_answer']").prop('checked', false);
            }

            function fetchQuestionList_main()
            {
                
                $.ajax({
                    url: "{{ route('view.questions') }}",
                    method: "post",
                    data: {
                        strandid: {{ $strand->strand_id }}
                    },
                    dataType: "json",
                    success:function(data)
                    {
                        let html = '';

                        for(var i=0;i<data.questions.length;i++)
                        {
                            html += '<tr>'+
                                        '<td>'+data.questions[i].question+'</td>'+
                                        '<td>'+
                                            '<i class="fas fa-tasks p_cursor text-secondary action_q mr-2" onclick=showChoices('+data.questions[i].question_id+')></i>'+
                                        '</td>'+
                                    '</tr>';
                        }


                        var o = $("#tblquestions").DataTable();
                        o.destroy();

                        $("#tbody_tblquestions").empty();
                        $("#tbody_tblquestions").html(html);

                        $("#tblquestions").DataTable();
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }
                });
            }
            
            function fetchQuestionList()
            {
                
                $.ajax({
                    url: "{{ route('view.questions') }}",
                    method: "post",
                    data: {
                        strandid: {{ $strand->strand_id }}
                    },
                    dataType: "json",
                    success:function(data)
                    {
                        console.log(data);
                        let html = '';

                        for(var i=0;i<data.questions.length;i++)
                        {
                            let choices = '';
                            for(var c = 1;c<=4;c++)
                            {
                                var is_correct = ''; 
                                if(data.questions[i]["choice"+c] == data.questions[i].answer)
                                {
                                    is_correct = 'checked=""';
                                }
                                choices += '<div class="form-check">'+
                                                '<input '+is_correct+' class="form-check-input" type="radio" name="choice'+i+'" value="'+data.questions[i]["choice"+c]+'">'+
                                                '<label class="form-check-label" for="choice'+i+'">'+
                                                    data.questions[i]["choice"+c]+
                                                '</label>'+
                                            '</div>';
                            }

                            html += '<tr>' + 
                                        '<td>'+

                                            '<div class="card bg-light action_q">'+
                                                '<div class="card-body">'+

                                                    '<span class="p_cursor" data-toggle="collapse" href="#collapseAnswers'+i+'" aria-expanded="false" aria-controls="collapseExample">'+
                                                        '<i class="fas fa-angle-down p_cursor text-secondary action_q mr-2"></i>'+
                                                        '<span>'+data.questions[i].question+'</span>'+
                                                    '</span>'+

                                                    '<span class="float-right">'+
                                                        '<i class="fas fa-pen p_cursor text-secondary action_q mr-2" onclick=fetchQuestion_details('+data.questions[i].question_id+')></i>'+
                                                        '<i class="fas fa-trash p_cursor text-secondary action_q" onclick=show_confirm_dlt("show",'+data.questions[i].question_id+')></i>'+
                                                    '</span>'+

                                                '</div>'+
                                            '</div>'+

                                            '<div class="collapse" id="collapseAnswers'+i+'">'+
                                                '<div class="card card-body">'+
                                                    '<form>'+
                                                        choices
                                                    '</form>'+
                                                '</div>'+
                                            '</div>'+

                                        '</td>'+
                                    '</tr>';
                        }


                        var o = $("#tblquestions2").DataTable();
                        o.destroy();

                        $("#tbody_tblquestions2").empty();
                        $("#tbody_tblquestions2").html(html);

                        $("#tblquestions2").DataTable();
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }
                });
            }

            function fetchQuestion_details(questionid)
            {
                $.ajax({
                    url: '{{ route("fetch.question") }}',
                    method: 'POST',
                    data: {
                        questionid: questionid,
                        strandid: {{ $strand->strand_id }}
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        console.log(data);
                        
                        // set the fields
                        TXT_editQ.answer = data.question[0].answer;
                        TXT_editQ.questionid.val(data.question[0].question_id)
                        TXT_editQ.question.val(data.question[0].question);
                        
                        for(var a=1;a<=4;a++)
                        {
                            $("#txt_editQ_choice_e"+a).val(data.question[0]["choice"+a]);
                            
                            // check if the choice is the correct answer

                            if(data.question[0]["choice"+a] == data.question[0].answer)
                            {
                                TXT_editQ.answer = data.question[0].answer;
                                $("input[name='txt_editQ_correct_answer'][choice='choice_e"+a+"']").prop("checked", true);
                            }
                        }
                        // show span for edit question
                        switchView("edit");
                        // hide the confirm deletion alert
                        $("#confirm_delete_msg").hide();
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }

                });
            }

            function show_confirm_dlt(o, questionid = "")
            {
                $('#ListofQuestionsModal').scrollTop(0);
                if(o == "hide")
                {   
                    $("#txt_questionid2dlt").val("");
                    $("#confirm_delete_msg").hide();
                }
                else if(o == "show")
                {
                    $("#txt_questionid2dlt").val(questionid);
                    $("#confirm_delete_msg").show();
                }
            }

            function showChoices(questionid)
            {
                $.ajax({
                    url: '{{ route('get.Q_answers') }}',
                    method: 'POST',
                    data: {
                        questionid: questionid
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        console.log(data);
                        if(data.status == true && data.message == "responses fetched")
                        {
                            let html = '';

                            // show modal multiple choice
                            for(var r=1;r<=4;r++)
                            {
                                var is_correct = '';
                                if(data.question["choice"+r] == data.question.answer)
                                {
                                    is_correct = 'checked';
                                }
                                html += '<div class="form-check">'+
                                            '<input '+is_correct+' class="form-check-input" type="radio" name="choice'+r+'" value="'+data.question["choice"+r]+'">'+
                                            '<label class="form-check-label" for="choice'+r+'">'+data.question["choice"+r]+'</label>'+
                                        '</div>';
                            }

                            $("span#span_m_answers form").html(html);
                            $("#Multiple_modalAnswers").modal('show');
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
                })

                
            }

        //endregion script_functions
    </script>
@stop




        

