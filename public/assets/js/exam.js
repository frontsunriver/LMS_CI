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
    '<button type="button" onclick="removeQuestion(1,0)">remove</button>' +
'</div>' + 
'' ;
var initialMultiModal = '' + 
'<input type="hidden" id="multi_last_num" value="1">' + 
'<div class="input-group" id="multi_div0">' +
    '<div class="input-group-text">' +
'        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value="0">' + 
    '</div>' + 
    '<input type="text" id="multi_input0" class="form-control input" aria-label="Text input with radio button" value="">' + 
'</div>' + 
'<div class="input-group" id="multi_div1">' + 
    '<div class="input-group-text">' + 
        '<input class="form-check-input " type="checkbox" name="flexRadioDefault" value="1">' + 
    '</div>' + 
    '<input type="text" id="multi_input1" class="form-control input" aria-label="Text input with radio button" value="">' + 
    '<button type="button" onclick="removeQuestion(1,1)">remove</button>' +
'</div>' + 
'' ;

function showUniqueModal(){
    clearModal(0);
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
        $("#uniqueModal").modal("show");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showMultipleModal(){
    clearModal(1);
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
        $("#multipleModal").modal("show");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showMatchModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
    }else{
        alertErrorSwl();
        return false;
    }
}
function showBlankModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
    }else{
        alertErrorSwl();
        return false;
    }
}
function showFreeModal(){
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
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
function addQuestion(val){
    if(val == 0){
        var num = $("#last_num").val();
        $("#last_num").val(++num);
        $('#qus_modal').append("<div class='input-group' id = 'div"+num+"'><div class='input-group-text'><input class='form-check-input' type='radio' name='flexRadioDefault'></div><input type='text' id = 'input"+num+"'class='form-control input' aria-label='Text input with radio button' value = ''><button type = 'button' onclick = 'removeQuestion("+num+","+val+")'>remove</button></div>");
    }else if(val == 1){
        var num = $("#multi_last_num").val();
        $("#multi_last_num").val(++num);
        $('#multi_qus_modal').append("<div class='input-group' id = 'multi_div"+num+"'><div class='input-group-text'><input class='form-check-input' type='checkbox' name='flexRadioDefault'></div><input type='text' id = 'multi_input"+num+"'class='form-control input' aria-label='Text input with radio button' value = ''><button type = 'button' onclick = 'removeQuestion("+num+","+val+")'>remove</button></div>");
    }else if(val == 2){

    }else if(val == 3){

    }else{
        
    }
}
function removeQuestion(val1, val2){
    if(val2 == 0){
        $("#div"+val1+"").remove();
    }else if(val2 == 1 ){
        $("#multi_div"+val1+"").remove();
    }else if(val2 == 2){

    }else if(val2 == 3){

    }else{

    }
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
function saveMultiQus(){
    var content = $('#multi_qus_content').val();
    var inputList = $("#multi_qus_modal > div");
    var limitTime = $("#limit_time").val();
    var examid = $("#is_exam").val();
    var quizeid = $("#quiz_id").val();
    var qus = new Array();
    for(var i = 0; i < inputList.length; i++){
        var checkbox = inputList[i].children[0].children[0].checked;
        var text = inputList[i].children[1].value;
        var quesItem = {
            answer : checkbox,
            question : text 
        }
        qus.push(quesItem);
    }
    $.post("/exam/create/question",
        {
            type: 1,
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
                $("#multipleModal").modal("hide");
                $('#multipleModal').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea,select")
                            .val('')
                            .end()
                        .find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                    })
                $("#multi_qus_modal").html("");
                $("#multi_qus_modal").html(initialMultiModal);
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
                }else if(row.type == 1){
                    return 'Multiple Answer';
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
var clearModal = function(val) {
    if(val == 0){
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
    }else if(val == 1){
        $('#multipleModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })
        $("#multi_qus_modal").html("");
        $("#multi_qus_modal").html(initialMultiModal);
    }else if(val == 2){

    }else if(val == 3){

    }else{

    }
    
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
            console.log(data);
            if(status == "success"){
                result = JSON.parse(data);
                if(result.data.type == "0"){
                    createUniqueModal(data);
                }else if(result.data.type == "1"){
                    createMultipleModal(data);
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
    var id = data.id;
    var problems = JSON.parse(temp.data.qus_answer);
    $("#qus_content").val(content);
    $("#quiz_id").val(id);
    $("#qus_modal").html("");
    var html = '<input type="hidden" id="last_num" value="' + (problems.length - 1) + '">';
    console.log(problems);
    for(var i = 0; i < problems.length; i++) {
        if(i == 0) {
            if(problems[i].answer == "true"){
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value="" checked></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }else {
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value=""></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }
        }else {
            if(problems[i].answer == "true"){
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value="" checked></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button type="button" onclick="removeQuestion(' + i + ',0)">remove</button></div>';
            }else {
                html += '<div class="input-group" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value=""></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button type="button" onclick="removeQuestion(' + i + ',0)">remove</button></div>';
            }
        }
        
    }

    $("#qus_modal").html(html);
    $("#uniqueModal").modal('show');
}
var createMultipleModal = function(data){
    var temp = JSON.parse(data);
    var data = temp.data;
    var content = data.ques_content;
    var id = data.id;
    var problems = JSON.parse(temp.data.qus_answer);
    $("#multi_qus_content").val(content);
    $("#quiz_id").val(id);
    $("#multi_qus_modal").html("");
    var html = '<input type="hidden" id="multi_last_num" value="' + (problems.length - 1) + '">';
    for(var i = 0; i < problems.length; i++) {
        if(i == 0) {
            if(problems[i].answer == "true"){
                html += '<div class="input-group" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value="" checked></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }else {
                html += '<div class="input-group" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value=""></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }
        }else {
            if(problems[i].answer == "true"){
                html += '<div class="input-group" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value="" checked></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button type="button" onclick="removeQuestion(' + i + ',1)">remove</button></div>';
            }else {
                html += '<div class="input-group" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value=""></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button type="button" onclick="removeQuestion(' + i + ',1)">remove</button></div>';
            }
        }
        
    }

    $("#multi_qus_modal").html(html);
    $("#multipleModal").modal('show');
}