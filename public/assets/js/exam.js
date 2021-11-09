function showUniqueModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != "false"){
        var unique = new bootstrap.Modal($("#uniqueModal"), {});
        unique.show();
    }else{
        alertErrorSwl();
        return false;
    }
}
function showMultipleModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != "false"){
        console.log("yes");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showMatchModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != "false"){
        console.log("yes");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showBlankModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != "false"){
        console.log("yes");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showFreeModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != "false"){
        console.log("yes");
    }else{
        alertErrorSwl();
        return false;
    }
}

function saveExam(){
    $('.alert').alert()
    var title = $("#exam_title").val();
    var content = $("#exam_content").val();
    var iscurso = $("#cod").val();
    var idsalon = $("#nemo").val();
    
    if(title == ""){
        alert("you must input the title of Exam!");
    }else{
        $.post("/exam/create/save",
        {
            title: title,
            content: content,
            iscurso : iscurso,
            idsalon : idsalon
        },
        function(data, status){
            if(status == "success"){
                Swal.fire({
                    icon: 'success',
                    text: 'Your examination has been successfully saved!',
                })
                $("#is_exam").val(data);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Somethings wrong...',
                  })
            }
        });
    }
}
function alertErrorSwl(){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'You have to add exam before edit a question!',
      })
}
function addQuestion(){
    var num = $("#last_num").val();
    $("#last_num").val(++num);
    $('#qus_modal').append("<div class='input-group' id = 'div"+num+"'><div class='input-group-text'><input class='form-check-input' type='radio' name='flexRadioDefault' id = "+num+"></div><input type='text' id = 'input"+num+"'class='form-control input' aria-label='Text input with radio button' value = ''><button type = 'button' onclick = 'removeQuestion("+num+")'>remove</button></div>");
}
function removeQuestion(val){
    $("#div"+val+"").remove();
}
function saveUniqQus(){
    var content = $('#qus_content').val();
    var inputList = $("#qus_modal > div");
    var limitTime = $("#limit_time").val();
    var examid = $("#is_exam").val();
    var qus = new Array();
    for(var i = 0; i < inputList.length; i++){
        var radio = inputList[i].children[0].children[0].checked;
        var text = inputList[i].children[1].value;
        var quesItem = {
            answer : radio,
            question : text 
        }
        qus.push(quesItem);
    }
    $.post("/exam/create/question",
        {
            type: 0,
            content: content,
            questions : qus,
            limitTime : limitTime,
            examid : examid
        },
        function(data, status){
            if(status == "success"){
                Swal.fire({
                    icon: 'success',
                    text: 'Your examination has been successfully saved!',
                })
                if(exam_id != "false"){
                    var table = $('#qusList').DataTable();
                    table.ajax.reload();
                }else{
                    ini_ques_tbl(data);
                    $("#is_exam").val();
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Somethings wrong...',
                  })
            }
        });
}
function ini_ques_tbl(data){
    $("#qusList").DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        retrieve: true,
        ajax: {
            url: "/exam/getQuesList",
            type: 'POST',
            "data": {
                "exam_id" : data
            }
        },
        columns: [
        {data:'ques_content' },
        {data: 'type' },
        {
            data: null,
            render: function(data, type, row) {
                return '\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
                        Edit\
                    </a>\
                    |\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                        delete\
                    </a>\
                ';
            }
        }],
    });
}
