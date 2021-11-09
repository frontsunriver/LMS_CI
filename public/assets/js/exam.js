var initialModal = '' + 
'<input type="hidden" id="last_num" value="1">' + 
'<div class="input-group" id="div0">' +
    '<div class="input-group-text">' +
'        <input class="form-check-input " type="radio" name="flexRadioDefault" value="0" checked="">' + 
    '</div>' + 
    '<input type="text" id="input0" class="form-control input" aria-label="Text input with radio button" value="">' + 
'</div>' + 
'<div class="input-group" id="div1">' + 
    '<div class="input-group-text">' + 
        '<input class="form-check-input " type="radio" name="flexRadioDefault" value="1">' + 
    '</div>' + 
    '<input type="text" id="input1" class="form-control input" aria-label="Text input with radio button" value="">' + 
    '<button type="button" onclick="removeQuestion(1)">remove</button>' +
'</div>' + 
'' ;

function showUniqueModal(){
    clearModal();
    var is_exam = $('#is_exam').val();
    if(is_exam != "false"){
        $("#uniqueModal").modal("show");
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
    var quizeid = $("#quiz_id").val();
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
            examid : examid,
            quizeid : quizeid
        },
        function(data, status){
            if(status == "success"){
                Swal.fire({
                    icon: 'success',
                    text: 'Your examination has been successfully saved!',
                })
                var table = $('#qusList').DataTable();
                table.ajax.reload();
                $("#uniqueModal").modal("hide");
                $('#uniqueModal').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea,select")
                            .val('')
                            .end()
                        .find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                    })
                $("#qus_modal").html("");
                $("#qus_modal").html(initialModal);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Somethings wrong...',
                  })
            }
        });
        $("#quiz_id").val("");
}
function ini_ques_tbl(){
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
            "data": function(d){
                d.exam_id = $("#is_exam").val();
            }
        },
        columns: [
        {data:'ques_content' },
        { 
            data: 'type',
            render: function(data, type, row){
                if(row.type == 0){
                    return 'Unique Answer';
                }
            }
        },
        {
            data: null,
            render: function(data, type, row) {
                return '\
                    <a href="javascript:editQuize(' + row.id + ')" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
                        Edit\
                    </a>\
                    |\
                    <a href="javascript:deleteQuize(' +row.id + ')" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                        delete\
                    </a>\
                ';
            }
        }],
    });
}
// 2021:11:19:11:36


var clearModal = function() {
    $('#uniqueModal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
                .val('')
                .end()
            .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })
    $("#qus_modal").html("");
    $("#qus_modal").html(initialModal);
}


var deleteQuize = function(id){
    $.post("/exam/unique/delete",
        {
            id : id
        },
        function(data, status){
            if(status == "success"){
                var table = $('#qusList').DataTable();
                table.ajax.reload();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Somethings wrong...',
                  })
            }
        });
}

var editQuize = function(id){
    $.post("/exam/quiz/getQuizById",
        {
            id : id
        },
        function(data, status){
            if(status == "success"){
                result = JSON.parse(data);
                if(result.data.type == "0"){
                    createUniqueModal(data);
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
var createUniqueModal = function(data){
    var temp = JSON.parse(data);
    var data = temp.data;
    var content = data.ques_content;
    var answer = data.answer;
    var id = data.id;
    var question_array = data.question.split("&");
    $("#qus_content").val(content);
    $("#quiz_id").val(id);
    $("#qus_modal").html("");
    var html = '<input type="hidden" id="last_num" value="' + (question_array.length - 2) + '">';
    for(var i = 0; i < question_array.length - 1; i++) {
        if(i == 0) {
            if(Number(answer) == i){
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value="" checked></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + question_array[i] + '"></div>';
            }else {
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value=""></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + question_array[i] + '"></div>';
            }
        }else {
            if(Number(answer) == i){
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value="" checked></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + question_array[i] + '"><button type="button" onclick="removeQuestion(' + i + ')">remove</button></div>';
            }else {
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value=""></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + question_array[i] + '"><button type="button" onclick="removeQuestion(' + i + ')">remove</button></div>';
            }
        }
        
    }

    $("#qus_modal").html(html);
    $("#uniqueModal").modal('show');
}