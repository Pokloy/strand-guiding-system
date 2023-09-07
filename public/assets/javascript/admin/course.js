$(document).ready(function(){
    Modal.alert.hide();
    Modal.editalert.hide();

    Table.tasks.DataTable();
});

var Table = {
    tasks : $("#tblCourseList")
};

var Form = {
    addCourse : $("#form_addCourse"),
    editCourse : $("form#form_editCourse"),
    saveEditCourse : $("form#form_saveEditCourse")
};

var Modal = {
    addCourse : $("#addCourseModal"),
    alert : $("#alertAddCourse"),
    alertMsg : $("#p_alert_msg"),

    editCourse : $("#editCourseModal"),
    editalert : $("#alertEditCourse"),
    editalertMsg : $("div#alertEditCourse p#p_alert_msg"),
};

var Input = {
    editTitle : $("input#txt_editcoursetitle"),
    editInstructor : $("input#txt_editcourseinstructor")
}
//=======================================ADD COURSE=====================================================================
//======================================================================================================================
Form.addCourse.submit(function(e){
    e.preventDefault();

    $.ajax({
        url : $(this).attr('action'),
        method  : 'post',
        data    : new FormData(this),
        processData : false,
        contentType : false,
        dataType    : 'json',
        success : function(data)
        {
            if(data.status == true)
            {
                //set the alert message
                Modal.alertMsg.text(data.course.title + " successfully added to course list");
                Modal.alert.show();
                setTimeout(function() {
                    //hide the alert and clear the message
                    Modal.alert.hide();
                    Modal.alertMsg.text("");
                }, 2000);
                setTimeout(function(){
                    //hide the modal
                    Modal.addCourse.modal('hide');
                }, 2400);
                setTimeout(function(){
                    location.reload();
                }, 2800)
            }
        },
        error : function(err)
        {
            if(err.status == 422) // error code 422 means, Uprocessable Entity -> empty fields
            {
                $.each(err.responseJSON.errors, function(key, val){
                    // set the error message in the errormessage element
                    $("small#msg_" + key).html("<i class='fas fa-exclamation-triangle'></i> "+val[0]);
                    // set errormessage element into visible
                    $("small#msg_" + key).css("display","block");
    
                    //display errorborders for error fields
                    $("input#" + key).addClass("is-invalid");
                });
            }
            else if(err.status == 500)
            {
                console.log(err);
            }
        }
    });
});

//============================RETRIEVE DATA=============================================================================
//==============================TO EDIT=================================================================================

Form.editCourse.submit(function(e){
    e.preventDefault();

    $.ajax({
        url : $(this).attr('action'),
        method  : 'post',
        data    : new FormData(this),
        processData : false,
        contentType : false,
        dataType    : 'json',
        success : function(data)
        {
            if(data.status == true)
            {
                //set the fields
                Input.editTitle.val(data.course.title);
                Input.editInstructor.val(data.course.instructor);

                //check if txt_editcourseid already existed, then remove to restrict duplicate appends
                //after remove, insert the new txt_editcourseid
                $courseid = $("input#txt_editcourseid");
                if($courseid.length == 1)
                {
                    $courseid.remove();
                }
                var courseId = "<input type='hidden' name='txt_editcourseid' id='txt_editcourseid' value='"+data.course.id+"'>";
                Form.saveEditCourse.append(courseId);
                //show modal
                Modal.editCourse.modal('show');
            }
        },
        error : function(err)
        {
            console.log(err);
        }
    });
});

//================================SAVE THE MODIFICATIONS================================================================
//======================================================================================================================

Form.saveEditCourse.submit(function(e){
    e.preventDefault();

    $.ajax({
        url : $(this).attr('action'),
        method  : 'post',
        data    : new FormData(this),
        processData : false,
        contentType : false,
        dataType    : 'json',
        success : function(data)
        {
            if(data.status == true)
            {
                //set the alert message
                Modal.editalertMsg.text("Modifications has been saved");
                Modal.editalert.show();
                setTimeout(function() {
                    //hide the alert and clear the message
                    Modal.editalert.hide();
                    Modal.editalertMsg.text("");
                }, 2000);
                setTimeout(function(){
                    //hide the modal
                    Modal.editCourse.modal('hide');
                }, 2400);
                setTimeout(function(){
                    location.reload();
                }, 2800)
            }
        },
        error : function(err)
        {
            if(err.status == 422) // error code 422 means, Uprocessable Entity -> empty fields
            {
                $.each(err.responseJSON.errors, function(key, val){
                    // set the error message in the errormessage element
                    $("small#msg_" + key).html("<i class='fas fa-exclamation-triangle'></i> "+val[0]);
                    // set errormessage element into visible
                    $("small#msg_" + key).css("display","block");
    
                    //display errorborders for error fields
                    $("input#" + key).addClass("is-invalid");
                });
            }
            else if(err.status == 500)
            {
                console.log(err);
            }
        }
    });
});
