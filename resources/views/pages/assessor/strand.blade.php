@extends('layouts.assessor.master')
@section('page_styles')

@stop

@section('title', 'Strands')

@section('page_content')
    <div class="container">

        <div class="row my-3">
            <div class="col-sm-12">
                <h3>List of Strands</h3>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="academic-tab" data-toggle="tab" href="#academic" role="tab" aria-controls="academic" aria-selected="true">Academic</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li> -->
                </ul>
                <div class="tab-content mb-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="academic" role="tabpanel" aria-labelledby="academic-tab">
                        <div class="container">
                        
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <form>
                                        <div class="form-row my-2">
                                            <div class="col-sm-8">
                                                @if(Session::get('utype') == "admin")
                                                    <button type="button" class="btn btn-primary mb-2" id="btn_Addstrand">Add Strand</button>
                                                    <small class="text-dark" id="span_no_add" style="display: none">
                                                        <br>
                                                        <span class="font-weight-bold">Note:</span>
                                                        <br> <span class="text-secondary">Academic strands have already been completed.</span> 
                                                        <br> <span class="text-secondary">You cannot add strands anymore.</span>
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="col-sm-4 pr-4">
                                                {{-- <form>
                                                    <div class="form-row">
                                                      <div class="col-sm-1 pt-1">
                                                        <i class="fas fa-search" class="float-right"></i>
                                                      </div>
                                                      <div class="col-sm-11">
                                                        <input type="text" class="form-control mb-2 bg-light" id="txtsearch_strand" placeholder="">
                                                      </div>
                                                    </div>
                                                </form> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row" style="width: 99%; display: none" id="loadStrand_loading">
                                <div class="card mb-2 bg-light">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                        <span class="ml-2">
                                            <!-- success message here -->
                                            Loading strands. Please wait...
                                        </span>
                                    </div>
                                </div>
                            </div>
                            

                            {{-- region List of Strands --}}
                                @if(Session::get('utype') == "admin")
                                    {{-- region admin list of strands --}}
                                        @if(count($strandList) == 0)
                                            <span class="text-secondary">No available strand</span>
                                        @else
                                            <div id="list_of_strands">
                                                @foreach($strandList as $strand)

                                                    <div class="row card_strand py-4 px-5 d-flex align-items-center mt-2" style="width: 99%;">

                                                        <div class="col-sm-1 text-center">
                                                            <img class="img-fluid" src="{{ asset('assets/img/ResourcesandIcons/cap.png') }}" alt="cap logo">
                                                        </div>

                                                        <div class="col-sm-9 pl-5">
                                                            <span class="text-secondary">{{ $strand->code }}</span>
                                                            <h4>{{ $strand->name }}</h4>
                                                            
                                                            @if($strand->status == "Active")
                                                                <span class="badge badge-pill badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-pill badge-danger">Inactive</span>
                                                            @endif

                                                            
                                                            
                                                            <span class="text-secondary p_cursor card_item mx-2" onclick="fetchStrandDetails({{ $strand->strand_id }})"><i class="fas fa-pen"></i></span>

                                                            <span
                                                                class="text-secondary p_cursor card_item" 
                                                                tabindex="0"
                                                                role="button"
                                                                data-placement="bottom"
                                                                data-toggle="popover"
                                                                data-trigger="focus"
                                                                data-content="{{ $strand->about }}">
                                                                <i class="fas fa-info-circle"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-sm-2 text-center">
                                                            <a href="{{ route('viewstrand.load', ['strand_id' => $strand->strand_id]) }}" class="btn btn-outline-primary px-4 float-right" role="button">View</a>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    {{-- endregion admin list of strands --}}
                                @else
                                    {{-- region faculty list of strands --}}
                                        @if(count($strandList) == 0)
                                            <span class="text-secondary">No available strand</span>
                                        @else
                                            <div class="row">
                                                @foreach($strands as $strand)

                                                    <div class="card card_strand_faculty col-sm-3 cur-pointer mt-3 ml-3 pt-2" style="width: 23rem;">
                                                        <div class="card-body put_bg_cap">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h6 class="card-title text-primary font-weight-bold">{{ $strand['code'] }}</h6>
                                                                <p class="text-dark" style="font-size: 18px">{{ $strand['name'] }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-12">
                                                                <small class="text-secondary">Total No. of Questions</small><br>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <span class="font-weight-bold" style="font-size: 33px">{{ $strand['count'] }}</span>
                                                            </div>
                                                            <div class="col-sm-4 pt-3">
                                                                <p class="float-right mr-3 text-primary underline_text" strand-id-fromStaff="{{ $strand['strand_id'] }}">View</p>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>

                                        @endif
                                    {{-- endregion faculty list of strands --}}
                                @endif
                            {{-- endregion List of Strands --}}

                        </div>
                    </div>


                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>




    </div>

    <!-- region Modals -->

        <!-- Add Strand Modal -->
        <div class="modal fade off_overflowY" id="addStrandModal" tabindex="-1" role="dialog" aria-labelledby="addStrandModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="addStrandModalTitle"><i class="fas fa-graduation-cap"></i> Add Strand</h5>
                    </div>
                    <div class="modal-body px-4">

                        <form>
                            
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

                            <div class="card mb-2" id="addStrand_loading">
                                <div class="card-body">
                                    <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                    <span class="ml-2">
                                        <!-- success message here -->
                                        Please wait...
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_strandcode_a">Strand Code</label>
                                <input type="text" class="form-control form-control-lg" id="txt_strandcode_a">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_strandname_a">Strand Name</label>
                                <input type="text" class="form-control form-control-lg" id="txt_strandname_a">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_strandstatus_a">Status</label>
                                <select class="form-control form-control-lg" id="txt_strandstatus_a">
                                    <option value="" selected>Please select strand status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_aboutstrand_a">About Strand</label>
                                <textarea class="form-control form-control-lg" id="txt_aboutstrand_a" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary px-4" id="btnAddStrand">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Strand Modal -->
        <div class="modal fade off_overflowY" id="editStrandModal" tabindex="-1" role="dialog" aria-labelledby="editStrandModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="editStrandModalTitle"><i class="fas fa-graduation-cap"></i> Edit Strand</h5>
                    </div>
                    <div class="modal-body px-4">

                        <form>
                            
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

                            <div class="card mb-2" id="editStrand_loading">
                                <div class="card-body">
                                    <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                    <span class="ml-2">
                                        <!-- success message here -->
                                        Please wait...
                                    </span>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" id="txt_strandid_e">
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_strandcode_e">Strand Code</label>
                                <input type="text" class="form-control form-control-lg" id="txt_strandcode_e">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_strandname_e">Strand Name</label>
                                <input type="text" class="form-control form-control-lg" id="txt_strandname_e">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_strandstatus_e">Status</label>
                                <select class="form-control form-control-lg" id="txt_strandstatus_e">
                                    <option value="" selected>Please select strand status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="txt_aboutstrand_e">About Strand</label>
                                <textarea class="form-control form-control-lg" id="txt_aboutstrand_e" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-secondary" id="cancelEditStrand">Cancel</button>
                        <button type="button" class="btn btn-primary px-4" id="btnEditStrand">Save</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- endregion -->
@stop

@section('page_scripts')
    <script>

        var A_BTN = {
            addStrand : $("#btnAddStrand")
        };

        var A_TXT = {
            name : $("#txt_strandname_a"),
            code : $("#txt_strandcode_a"),
            status : $("#txt_strandstatus_a"),
            about : $("#txt_aboutstrand_a")
        };

        var Alert_A = {
            e : $("div#error_msg_a div span"),
            s : $("div#success_msg_a div span")
        };

        var E_BTN = {
            editSrand : $("#btnEditStrand")
        }

        var E_TXT = {
            id : $("#txt_strandid_e"),
            name : $("#txt_strandname_e"),
            code : $("#txt_strandcode_e"),
            status : $("#txt_strandstatus_e"),
            about : $("#txt_aboutstrand_e")
        };

        var Alert_E = {
            e : $("div#error_msg_e div span"),
            s : $("div#success_msg_e div span")
        };

        var s_lists = {
            admin : $("div#div_strand_list_A"),
            faculty : $("div#div_strand_list_F")
        };
        

        //region loading
        
            // $(document).bind('ajaxStart', function (){
            //         $("#addStrand_loading").show();
            // }).bind('ajaxStop', function (){
            //         $("#addStrand_loading").hide();
            // });

            $(document).bind('ajaxStart', function (){
                    $("#editStrand_loading").show();
            }).bind('ajaxStop', function (){
                    $("#editStrand_loading").hide();
            });

        // endregion loading

        $(document).ready(function(){
            check_no_of_strands();
            /*
                defualt display
            */
            $("div#error_msg_a").hide();
            $("div#success_msg_a").hide();
            $("div#addStrand_loading").hide();

            $("div#error_msg_e").hide();
            $("div#success_msg_e").hide();
            $("div#editStrand_loading").hide();
        });

        $("#btn_Addstrand").click(function(){
            $("#addStrandModal").modal("show");
        });

        A_BTN.addStrand.click(function(){
            $("#addStrand_loading").show();
            if(!validate_a(A_TXT.code) || !validate_a(A_TXT.name) || !validate_a(A_TXT.status) || !validate_a(A_TXT.about))
            {
                Alert_A.e.text("Please make sure the fields are not empty");
                $("div#error_msg_a").show();
            }
            else
            {
                Alert_A.e.text("");
                $("#error_msg_a").hide();

                $.ajax({
                    url: "{{ route('strand.add') }}",
                    method: 'POST',
                    data: {
                        name: A_TXT.name.val(),
                        code: A_TXT.code.val(),
                        status: A_TXT.status.val(),
                        about: A_TXT.about.val()
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        $("#addStrand_loading").hide();
                        if(data.status == true && data.message == "saved")
                        {
                            Alert_A.s.text("Strand Added Successfully");
                            $("div#success_msg_a").show();
                            setTimeout(function(){
                                $("#success_msg_a").hide();
                            },2000);
                            setTimeout(function(){
                                $("#addStrandModal").modal("hide");
                            },2500);
                            setTimeout(function(){
                                location.reload();
                            },3000);
                        }
                        else if(data.status == false && data.message == "not save")
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
        });

        E_BTN.editSrand.click(function(){
            if(!validate_a(E_TXT.code) || !validate_a(E_TXT.name) || !validate_a(E_TXT.status) || !validate_a(E_TXT.about))
            {
                Alert_E.e.text("Please make sure the fields are not empty");
                $("div#error_msg_e").show();
            }
            else
            {
                Alert_E.e.text("");
                $("#error_msg_e").hide();

                $.ajax({
                    url: "{{ route('strand.update') }}",
                    method: 'POST',
                    data: {
                        id: E_TXT.id.val(),
                        name: E_TXT.name.val(),
                        code: E_TXT.code.val(),
                        status: E_TXT.status.val(),
                        about: E_TXT.about.val()
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        console.log(data);
                        if(data.status == true && data.message == "updated")
                        {
                            Alert_E.s.text("Strand Details Updated Successfully");
                            $("div#success_msg_e").show();
                            setTimeout(function(){
                                $("#success_msg_e").hide();
                            },2000);
                            setTimeout(function(){
                                $("#editStrandModal").modal("hide");
                            },2300);
                            setTimeout(function(){
                                location.reload();
                            },3000);
                        }
                        else if(data.status == false)
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
        });

        $("button#cancelEditStrand").click(function(){
            $("#editStrandModal").modal("hide");
        });

        $('[data-toggle="popover"]').popover({
            trigger: 'focus'
        });

        $("#txtsearch_strand").keyup(function(){
            
            let key = $(this).val();
            if(key != "")
            {
                $("#loadStrand_loading").show();
                $.ajax({
                    url: "{{ route('strand.search') }}",
                    method: 'POST',
                    data: {
                        key : key
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        $("#loadStrand_loading").hide();
                        let strands_html = '';
                        
                        for(var i=0;i < data.strands.length; i++)
                        {
                            let status = data.strands[i].status == "Active" ?
                                        '<span class="badge badge-pill badge-success">Active</span>' : 
                                        '<span class="badge badge-pill badge-danger">Inactive</span>';

                            strands_html += '<div class="row card_strand py-4 px-5 d-flex align-items-center mt-2" style="width: 99%;">'+
                                                '<div class="col-sm-1 text-center">'+
                                                    '<img class="img-fluid" src={{ asset("assets/img/ResourcesandIcons/cap.png") }} alt="cap logo">'+
                                                '</div>'+
                                                '<div class="col-sm-9 pl-5">'+
                                                    '<span class="text-secondary">'+data.strands[i].code+'</span>'+
                                                    '<h4>'+data.strands[i].name+'</h4>'+
                                                    status+
                                                    '<span class="text-secondary p_cursor card_item mx-2" onclick="fetchStrandDetails('+data.strands[i].strand_id+')"><i class="fas fa-pen"></i></span>'+
                                                    '<span'+
                                                        'class="text-secondary p_cursor card_item"'+
                                                        'tabindex="0"'+
                                                        'role="button"'+
                                                        'data-placement="bottom"'+
                                                        'data-toggle="popover"'+
                                                        'data-trigger="focus"'+
                                                       ' data-content="'+data.strands[i].about+'">'+
                                                        '<i class="fas fa-info-circle"></i>'+
                                                    '</span>'+
                                                '</div>'+
                                                '<div class="col-sm-2 text-center">'+
                                                    '<a href={{ route("viewstrand.load", ["strand_id" => '+data.strands[i].strand_id+']) }} class="btn btn-primary px-4 float-right" role="button">Details</a>'+
                                                '</div>'+
                                            '</div>';
                        }

                        $("#list_of_strands").html("");
                        $("#list_of_strands").html(strands_html);
                    },
                    error:function(err)
                    {
                        console.log(err);
                    }
                });
            }
           
        });

        $("p[strand-id-fromStaff]").click(function(){
            $strand_id = $(this).attr('strand-id-fromStaff');
            window.location = "/view-strand/"+$strand_id;
        });

        //region script_functions
        
            // validate fields in adding strand
            function validate_a(caller)
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

            function fetchStrandDetails(id)
            {
                $.ajax({
                    url: "{{ route('strand.fetch') }}",
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success:function(data)
                    {
                        console.log(data);
                        if(data.status == true && data.message == "fetched")
                        {
                            E_TXT.id.val(data.strand.strand_id);
                            E_TXT.name.val(data.strand.name);
                            E_TXT.code.val(data.strand.code);
                            E_TXT.status.val(data.strand.status);
                            E_TXT.about.val(data.strand.about);
                            
                            $("#editStrandModal").modal("show");
                        }
                        else if(data.status == false)
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

            function check_no_of_strands()
            {
                $.ajax({
                    url: "{{ route('strand.count') }}",
                    method: "POST",
                    dataType: "json",
                    success:function(data)
                    {
                        var sCodes = [];
                        //get the codes
                        for(var i = 0;i<data.sCodes.length;i++)
                        {
                            sCodes.push(data.sCodes[i].code);
                        }
                        if(sCodes.includes("STEM") && sCodes.includes("GAS") && sCodes.includes("HUMSS") && sCodes.includes("ABM") && sCodes.length >= 4)
                        {
                            $("#btn_Addstrand").attr('disabled', true);
                            $("#span_no_add").show();
                        }
                    },
                    error:function(err)
                    {
                        console.log(data);
                    }
                });
            }
            

        // endregion script_functions


    </script>
@stop