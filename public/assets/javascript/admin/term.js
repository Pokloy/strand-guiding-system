$(document).ready(function(){
    Modal.alert.hide();
    Modal.editalert.hide();
    Table.terms.DataTable();
});

var Table = {
    terms : $("#tblTermList")
};

var Form = {
    addTerm : $("#form_addTerm"),
    editTerm : $("#form_editTerm")
};

var Modal = {
    addTerm : $("#addTermModal"),
    alert : $("#alertAddTerm"),
    alertMsg : $("#p_alert_msg"),

    editTerm : $("#editTermModal"),
    editalert : $("#editAlertTerm"),
    editalertMsg : $("div#editAlertTerm p#p_alert_msg")
};

var Input = {
    editsem : $("select#txt_editsem"),
    editacad : $("input#txt_editacademic")
};

//=======================================ADD TERM=======================================================================
//======================================================================================================================

Form.addTerm.submit(function(e){
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
                Modal.alertMsg.text(data.term.term + " successfully added to terms");
                Modal.alert.show();
                setTimeout(function() {
                    //hide the alert and clear the message
                    Modal.alert.hide();
                    Modal.alertMsg.text("");
                }, 2000);
                setTimeout(function(){
                    //hide the modal
                    Modal.addTerm.modal('hide');
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
                    if(key == "txt_sem")
                    {
                        $("select#" + key).addClass("is-invalid");
                    }
                    else{
                        $("input#" + key).addClass("is-invalid");
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
//=======================================GET THE DATA TO BE MODIFIED====================================================
//======================================================================================================================
$('a.editTerm').click(function(e){
    e.preventDefault();

    var id = $(this).attr('term-id');

    $.ajax({
        url : "/getTermDetails/" + id,
        method  : 'post',
        data : 
        { 
            _token : '{{ csrf_token() }}' 
        },
        processData : false,
        contentType : false,
        dataType    : 'json',
        success : function(data)
        {
            if(data.status == true)
            {
                var sem = "";
                var a_y = "";
                var term = data.term.term;
                var firstSem = "First Semester ";
                var secondSem = "Second Semester ";

                //checking if First and Second Semester exist in the term and terminate
                //it for the result will be the academic year.
                if(term.includes(firstSem) || term.includes(secondSem))
                {
                    if(term.includes(firstSem))
                    {
                        sem = firstSem;
                        a_y = term.replace(firstSem, '');
                    }
                    else if(term.includes(secondSem))
                    {
                        sem = secondSem;
                        a_y = term.replace(secondSem, '');
                    }
                }

                sem == "First Semester " ? Input.editsem.prop("selectedIndex", 1).val() : Input.editsem.prop("selectedIndex", 2).val();
                Input.editacad.val(a_y);

                //check if txt_edittermid already existed, then remove to restrict duplicate appends
                //after remove, insert the new txt_edittermid
                $termid = $("input#txt_edittermid");
                if($termid.length == 1)
                {
                    $termid.remove();
                }
                var termId = "<input type='hidden' name='txt_edittermid' id='txt_edittermid' value='"+data.term.id+"'>";
                Form.editTerm.append(termId);
                Modal.editTerm.modal('show');
            }
        },
        error : function(err)
        {
            console.log(err);
        }
    });
});

//=======================================SAVE THE MODIFIED DATA=========================================================
//======================================================================================================================
Form.editTerm.submit(function(e){
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
                console.log(data);
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
                    Modal.editTerm.modal('hide');
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
                    if(key == "txt_editsem")
                    {
                        $("select#" + key).addClass("is-invalid");
                    }
                    else if(key == "txt_editacademic"){
                        $("input#" + key).addClass("is-invalid");
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