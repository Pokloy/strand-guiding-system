@extends('layouts.assessor.master')
@section('page_styles')

@stop
@section('title', 'Users')

@section('page_content')

    <div class="container">
        <div class="row py-3 px-4 mt-3">
            <div class="col-sm-2">
                <h3 class="mt-1">List of Users</h3>
            </div>
            <div class="col-sm-10">
                <button type="button" class="btn btn-primary float-right" id="btn_showaddUserModal"><i class="fas fa-user-plus"></i> Add User</button>
            </div>
        </div>
        <div class="row cardUsers bg-white py-5 px-4 mx-3">
            <div class="col-sm-12">
                <table class="table table-hover" id="table_users">
                    <caption>List of Users</caption>
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>Account Status</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            @if(Session::get('user_id') != $u->user_id)
                                <tr>
                                    <td>{{ $u->fname }}</td>
                                    <td>{{ $u->mname }}</td>
                                    <td>{{ $u->lname }}</td>
                                    <td>{{ $u->uname }}</td>
                                    <td>
                                        {{ $u->utype == "admin" ? "Administrator" : "Staff" }}
                                    </td>
                                    <td class="font-weight-bold {{ $u->status == 'Inactive' ? 'text-danger' : 'text-success' }}">{{ $u->status }}</td>
                                    <td>
                                        <i class="fas fa-user-edit p_cursor text-primary" style="font-size: 20px" onclick="fetchUserDetails({{ $u->user_id }})"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addStrandModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="addUserModalTitle"><i class="fas fa-user-plus"></i> &nbsp;Add User Account</h5>
                    {{-- <button type="button" class="close" onclick="cancelAdd()">
                    <span aria-hidden="true">&times;</span>
                    </button> --}}
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

                        <div class="card mb-2" id="addUser_loading">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                <span class="ml-2">
                                    <!-- success message here -->
                                    Please wait...
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_fname_a">First Name</label>
                            <input type="text" class="form-control form-control-lg" id="txt_fname_a" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_mname_a">Middle Name</label>
                            <input type="text" class="form-control form-control-lg" id="txt_mname_a" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_lname_a">Last Name</label>
                            <input type="text" class="form-control form-control-lg" id="txt_lname_a" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_uname_a">Username</label>
                            <input type="text" class="form-control form-control-lg" id="txt_uname_a" autocomplete="off" disabled>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_pass_a">Password</label>
                            <input type="password" class="form-control form-control-lg" id="txt_pass_a" autocomplete="off" disabled>
                            
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_usertype_a">User Type</label>
                            <select class="form-control form-control-lg" id="txt_usertype_a">
                                <option value="" selected>Please select user type</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary" onclick="cancelAdd()">Cancel</button>
                    <button type="button" class="btn btn-primary px-4" id="btnAddUser">Add</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Edit User Modal -->
    <div class="modal fade off_overflowY" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editStrandModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="editUserModalTitle"><i class="fas fa-user"></i> &nbsp;Edit User Account Details</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> --}}
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

                        <div class="card mb-2" id="editUser_loading">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/loading1.gif') }}" alt="Loading" width="20">
                                <span class="ml-2">
                                    <!-- success message here -->
                                    Please wait...
                                </span>
                            </div>
                        </div>

                        <input type="hidden" value="" id="txt_userid_e">
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_fname_e">First Name</label>
                            <input type="text" class="form-control form-control-lg" id="txt_fname_e" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_mname_e">Middle Name</label>
                            <input type="text" class="form-control form-control-lg" id="txt_mname_e" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_lname_e">Last Name</label>
                            <input type="text" class="form-control form-control-lg" id="txt_lname_e" autocomplete="off">
                        </div>
                        {{-- <div class="form-group">
                            <label class="font-weight-bold" for="txt_uname_e">Username</label>
                            <input type="text" class="form-control form-control-lg" id="txt_uname_e" autocomplete="off">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label class="font-weight-bold" for="txt_pass_e">Password</label>
                            <input type="password" class="form-control form-control-lg" id="txt_pass_e" autocomplete="off">
                        </div> --}}
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_usertype_e">User Type</label>
                            <select class="form-control form-control-lg" id="txt_usertype_e">
                                <option value="" selected>Please select user type</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="txt_status_e">Account Status</label>
                            <select class="form-control form-control-lg" id="txt_status_e">
                                <option value="" selected>Please select account status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    
                    </form>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancel</button>
                    <button type="button" class="btn btn-primary px-4" id="btnUpdateUser">Save</button>
                </div>
            </div>
        </div>
    </div>

@stop



@section('page_scripts')
<script>
    $(document).ready(function(){
        $("table#table_users").DataTable();

        /*
            defualt display
        */
        $("div#error_msg_a").hide();
        $("div#success_msg_a").hide();
        $("div#addUser_loading").hide();

        $("div#error_msg_e").hide();
        $("div#success_msg_e").hide();
        $("div#editUser_loading").hide();
    });

    var u_fields = {
        a : {
            fname : $("#txt_fname_a"),
            mname : $("#txt_mname_a"),
            lname : $("#txt_lname_a"),
            uname : $("#txt_uname_a"),
            pass  : $("#txt_pass_a"),
            utype : $("#txt_usertype_a")
        },
        e : {
            user_id : $("#txt_userid_e"),
            fname : $("#txt_fname_e"),
            mname : $("#txt_mname_e"),
            lname : $("#txt_lname_e"),
            // uname : $("#txt_uname_e"),
            // pass  : $("#txt_pass_e"),
            utype : $("#txt_usertype_e"),
            status : $("#txt_status_e")
        }
    }

    var alerts = {
        a : {
            err : $("div#error_msg_a div span"),
            suc :  $("div#success_msg_a div span")
        },
        e : {
            err : $("div#error_msg_e div span"),
            suc :  $("div#success_msg_e div span")
        }
    }

    $("#btn_showaddUserModal").click(function(){
        $.ajax({
            url: '{{ route("get.last_userid") }}',
            method: 'post',
            dataType: 'json',
            success:function(data){

                u_fields.a.uname.val(data.new_account);
                u_fields.a.pass.val(data.new_account);

                $("#addUserModal").modal('show');
            },
            error:function(err){
                console.log(err);
            }
        });
    });

    $("button#btnAddUser").click(function(){
        loading_a("show");
        if(!validate_a(u_fields.a.fname) ||
           !validate_a(u_fields.a.mname) ||
           !validate_a(u_fields.a.lname) ||
           !validate_a(u_fields.a.uname) ||
           !validate_a(u_fields.a.pass) ||
           !validate_a(u_fields.a.utype)) {
            
            alerts.a.err.text("Please make sure the fields are not empty");
            $("div#error_msg_a").show();
            loading_a("hide");
        }
        else
        {
            hideAlerts("add");
            $.ajax({
                url: "{{ route('user.add') }}",
                method: 'POST',
                data: {
                    fname : u_fields.a.fname.val(),
                    mname : u_fields.a.mname.val(),
                    lname : u_fields.a.lname.val(),
                    uname : u_fields.a.uname.val(),
                    pass : u_fields.a.pass.val(),
                    utype: u_fields.a.utype.val(),
                },
                dataType: 'json',
                success:function(data)
                {
                    var $modal = $("div#addUserModal");
                    if(data.status == true && data.message == "saved")
                    {
                        loading_a("hide");
                        alerts.a.suc.text("User Added Successfully");
                        $("div#success_msg_a").show();
                        setTimeout(function(){
                            $("#success_msg_a").hide();
                        },1500);
                        setTimeout(function(){
                           $modal.modal('hide');
                        },2500);
                        setTimeout(function(){
                            location.reload();
                        },3300);
                    }
                    else if(data.status == false && data.message == "unsave")
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

    $("button#btnUpdateUser").click(function(){
        loading_e("show");
        if(!validate_e(u_fields.e.fname) ||
           !validate_e(u_fields.e.mname) ||
           !validate_e(u_fields.e.lname) ||
           !validate_e(u_fields.e.utype) ||
           !validate_e(u_fields.e.status)) {
            
            alerts.e.err.text("Please make sure the fields are not empty");
            $("div#error_msg_e").show();
            loading_e("hide");
        }
        else
        {
            hideAlerts("edit");
            $.ajax({
                url: "{{ route('user.update') }}",
                method: 'POST',
                data: {
                    user_id : u_fields.e.user_id.val(),
                    fname : u_fields.e.fname.val(),
                    mname : u_fields.e.mname.val(),
                    lname : u_fields.e.lname.val(),
                    utype : u_fields.e.utype.val(),
                    status : u_fields.e.status.val(),
                },
                dataType: 'json',
                success:function(data)
                {
                    var $modal = $("div#editUserModal");
                    if(data.status == true && data.message == "updated")
                    {
                        loading_e("hide");
                        alerts.e.suc.text("User Details Updated Successfully");
                        $("div#success_msg_e").show();
                        setTimeout(function(){
                            $("#success_msg_e").hide();
                        },1500);
                        setTimeout(function(){
                           $modal.modal('hide');
                        },2500);
                        setTimeout(function(){
                            location.reload();
                        },3300);
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
    });

    //region script_functions

        // validate fields in adding strand
        function fetchUserDetails(userid)
        {
            $.ajax({
                url: "{{ route('user.fetch') }}",
                method: 'POST',
                data: {
                    userid : userid
                },
                dataType: 'json',
                success:function(data)
                {
                    u_fields.e.user_id.val(data.details.user_id);
                    u_fields.e.fname.val(data.details.fname);
                    u_fields.e.mname.val(data.details.mname);
                    u_fields.e.lname.val(data.details.lname);
                    // u_fields.e.uname.val(data.details.uname);
                    // u_fields.e.pass.val(data.details.pass);

                    $utype = data.details.utype;
                    $utype == "admin" ? $("#txt_usertype_e").prop("selectedIndex", 1).val() : $("#txt_usertype_e").prop("selectedIndex", 2).val();

                    $status = data.details.status;
                    $status == "Active" ? $("#txt_status_e").prop("selectedIndex", 1).val() : $("#txt_status_e").prop("selectedIndex", 2).val();

                    $("#editUserModal").modal("show");

                },
                error:function(err)
                {
                    console.log(err);
                }
            });

        }

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

        function validate_e(caller)
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

        function loading_a(action)
        {
            if(action == "show")
            {
                $("div#addUser_loading").show();
            }
            else
            {
                $("div#addUser_loading").hide();
            }
            return;
        }
        function loading_e(action)
        {
            if(action == "show")
            {
                $("div#editUser_loading").show();
            }
            else
            {
                $("div#editUser_loading").hide();
            }
            return;
        }

        function hideAlerts(operation)
        {
            if(operation == "add")
            {
                alerts.a.err.text("");
                $("div#error_msg_a").hide();
            }
            else
            {
                alerts.e.err.text("");
                $("div#error_msg_e").hide();
            }
        }

        function cancelAdd()
        {
            $("div#addUserModal").modal("hide");
        }

        function cancelEdit()
        {
            $("div#editUserModal").modal("hide");
        }

    //endregion script_functions
</script>

@stop