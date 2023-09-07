$(document).ready(function(){
    modalAlert.addTask.hide();
    Tables.task.DataTable();
});

var Forms = {
    addTask : $("form#form_addTask"),
    getTaskDetails : $("[data-id]")
};

var Input = {
    term : $("#txt_term"),
    course : $("#txt_course"),
    type : $("#txt_type"),
    task : $("#txt_task"),
    portal : $("#txt_submissionPortal"),
    link : $("#txt_submissionLink"),
};

var Modal = {
    addTask : $("#addTaskModal")
}

var modalAlert = {
    addTask : $("#alertAddTask")
}

var Buttons = {
    
}

var Tables = {
    task : $("#tblTaskList")
}

Forms.addTask.submit(function(e){
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
                modalAlert.addTask.show();
                setTimeout(function() {
                    modalAlert.addTask.hide();
                }, 2000);
                setTimeout(function(){
                    Modal.addTask.modal('hide');
                }, 2400);
                setTimeout(function(){
                    location.reload();
                }, 2800)
            }
        },
        error : function(err)
        {
            if(err.status == 422)
            {
                $.each(err.responseJSON.errors, function(key, val){
                    // set the error message in the errormessage element
                    $("small#msg_" + key).html("<i class='fas fa-exclamation-triangle'></i> "+val[0]);
                    // set errormessage element into visible
                    $("small#msg_" + key).css("display","block");
    
                    //display errorborders for error fields
                    if(key == "txt_task")
                    {
                        $("textarea#" + key).addClass("is-invalid");
                    }
                    else if(key == "txt_submissionPortal" || key == "txt_submissionLink")
                    {
                        $("input#" + key).addClass("is-invalid");
                    }
                    else
                    {
                        $("select#" + key).addClass("is-invalid");
                    }
                });
            }
            else if(err.status == 500)
            {
                console.log(err);
            }
        }
    });
});

var viewTaskModal = {
    modal : $("#viewTaskModal"),
    task : $("span#task"),
    course : $("span#course"),
    type : $("span#taskType"),
    status : $("span#status"),
    logo : $("img#imgPortalLogo"),
    portal : $("span#sportal"),
    link : $("a#slink")
}

Forms.getTaskDetails.submit(function(e){
    e.preventDefault();

    $.ajax({
        url : $(this).attr('action'),
        method  : 'post',
        data    : new FormData(this),
        processData : false,
        contentType : false,
        dataType    : 'json',
        success :  function(data)
        {
            if(data.status == true)
            {
                viewTaskModal.task.text(data.task.task);
                viewTaskModal.course.text(data.task.title);
                viewTaskModal.type.text(data.task.taskType);
                viewTaskModal.status.text(data.task.status);
                if(data.task.submissionPortal == "Google Classroom")
                {
                    viewTaskModal.logo.attr('src', sourceClassroom);
                }
                else if(data.task.submissionPortal == "Schoology")
                {
                    viewTaskModal.logo.attr('src', sourceSchoology);
                }
                else
                {
                    viewTaskModal.logo.attr('src', sourceOthers);
                }
                viewTaskModal.portal.text(data.task.submissionPortal);
                viewTaskModal.link.attr("href", data.task.submissionLink);
                viewTaskModal.modal.modal("show");
            }
            else
            {
                alert("There is a problem!");
            }
        },
        error : function(err)
        {
            console.log(err);
        }
    });

});

