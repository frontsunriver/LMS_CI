var initialModal = '' + 
'<input type="hidden" id="last_num" value="1">' + 
'<div class="input-group mb-3" id="div0">' +
    '<div class="input-group-text">' +
'        <input class="form-check-input " type="radio" name="flexRadioDefault" value="0" checked="">' + 
    '</div>' + 
    '<input type="text" id="input0" class="form-control input" aria-label="Text input with radio button" value="">' + 
'</div>' + 
'<div class="input-group mb-3" id="div1">' + 
    '<div class="input-group-text">' + 
        '<input class="form-check-input " type="radio" name="flexRadioDefault" value="1">' + 
    '</div>' + 
    '<input type="text" id="input1" class="form-control input" aria-label="Text input with radio button" value="">' + 
    '<button type="button" class = "btn btn-secondary btn-sm" onclick="removeQuestion(1,0)"><i class = "bi bi-trash"></i>Remove</button>' +
'</div>' + 
'' ;
var initialMultiModal = '' + 
'<input type="hidden" id="multi_last_num" value="1">' + 
'<div class="input-group mb-3" id="multi_div0">' +
    '<div class="input-group-text">' +
'        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value="0">' + 
    '</div>' + 
    '<input type="text" id="multi_input0" class="form-control input" aria-label="Text input with radio button" value="">' + 
'</div>' + 
'<div class="input-group mb-3" id="multi_div1">' + 
    '<div class="input-group-text">' + 
        '<input class="form-check-input " type="checkbox" name="flexRadioDefault" value="1">' + 
    '</div>' + 
    '<input type="text" id="multi_input1" class="form-control input" aria-label="Text input with radio button" value="">' + 
    '<button type="button" class = "btn btn-secondary btn-sm" onclick="removeQuestion(1,1)"><i class = "bi bi-trash"></i>Remove</button>' +
'</div>' + 
'' ;
var initialBlankModal = '' + 
'<input type="hidden" id="blank_last_num" value="0">' + 
'' ;
var initialMatchModal = ''+
'<input type="hidden" id="match_last_num" value= 1>'+
'<div class = "mb-3 form-group row" id = match_div0>'+
    '<div class="col-5">'+
        '<input type="text" id = "multi_input0l" class="form-control input" aria-label="Text input with radio button" value = "">'+
    '</div>'+
    '<div class="col-5">'+
        '<input type="text" id = "multi_input0r" class="form-control input" aria-label="Text input with radio button" value = "">'+
    '</div>'+
    '<div class="col-2">'+
        '<button type = "button" class = "btn btn-secondary" onclick = "removeQuestion(0,4)"><i class = "bi bi-trash"></i>Remove</button>'+
    '</div>'+
'</div>'+
'';

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
    clearModal(4);
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
        $("#matchModal").modal("show");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showBlankModal(){
    clearModal(2);
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
        $("#blankModal").modal("show");
    }else{
        alertErrorSwl();
        return false;
    }
}
function showFreeModal(){
    clearModal(3);
    var is_exam = $('#is_exam').val();
    if(is_exam != 0){
        $("#freeModal").modal("show");
    }else{
        alertErrorSwl();
        return false;
    }
}
function savePopularset(){
    var is_exam = $('#is_exam').val();
    var limit_time = $('#limit_time').val();
    var pass_percent = $('#pass_percent').val();

    if(is_exam != 0){
        $.post("/exam/save/popular",
        {
            exam_id : is_exam,
            limit_time : limit_time,
            pass_percent : pass_percent
        },
        function(data, status){
            if(status == "success"){
                Swal.fire({
                    icon: 'success',
                    text: 'Your examination has been successfully saved!',
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Somethings wrong...',
                  })
            }
        });
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
        $('#qus_modal').append("<div class='input-group mb-3' id = 'div"+num+"'><div class='input-group-text'><input class='form-check-input' type='radio' name='flexRadioDefault'></div><input type='text' id = 'input"+num+"'class='form-control input' aria-label='Text input with radio button' value = ''><button type = 'button' class = 'btn btn-secondary btn-sm' onclick = 'removeQuestion("+num+","+val+")'><i class='bi bi-trash'></i><i class = 'bi bi-trash'></i>Remove</button></div>");
    }else if(val == 1){
        var num = $("#multi_last_num").val();
        $("#multi_last_num").val(++num);
        $('#multi_qus_modal').append("<div class='input-group mb-3' id = 'multi_div"+num+"'><div class='input-group-text'><input class='form-check-input' type='checkbox' name='flexRadioDefault'></div><input type='text' id = 'multi_input"+num+"'class='form-control input' aria-label='Text input with radio button' value = ''><button type = 'button' class = 'btn btn-secondary btn-sm' onclick = 'removeQuestion("+num+","+val+")'><i class = 'bi bi-trash'></i>Remove</button></div>");
    }else if(val == 2){
        var num = $("#blank_last_num").val();
        $("#blank_last_num").val(++num);
        var text = '';
        text += YourEditor.getData();
        text = text.replace("&nbsp;","");
        var text_array = text.split("</p>");
        var temp = ''
        if(text_array.length == 1){
            temp += '[Blank]';
        }else{
            for(var i = 0; i < text_array.length - 1 ; i++){
                if(i == text_array.length - 2){
                    temp += text_array[i] + ' [Blank]</p>';
                }else {
                    temp += text_array[i] + ' </p>';
                }
            }
        }
        YourEditor.setData(temp);
        $('#blank_qus_modal').append("<div class='input-group mb-3' id = 'blank_div"+num+"'><input type='text' id = 'blank_input"+num+"'class='form-control input' aria-label='Text input with radio button' value = ''><button type = 'button' class = 'btn btn-secondary btn-sm' onclick = 'removeQuestion("+num+","+val+")'><i class = 'bi bi-trash'></i>Remove</button></div>");
    }else if(val == 3){

    }else{
        var num = $("#match_last_num").val();
        $("#match_last_num").val(++num);
        $('#match_qus_modal').append(
            '<div class = "row mb-3 form-group" id = match_div'+num+'>'+
                '<div class="col-5">'+
                    '<input type="text" id = "multi_input'+num+'l" class="form-control input" aria-label="Text input with radio button" value = "">'+
                '</div>'+
                '<div class="col-5">'+
                    '<input type="text" id = "multi_input'+num+'r" class="form-control input" aria-label="Text input with radio button" value = "">'+
                '</div>'+
                '<div class="col-2">'+
                    '<button type = "button" class = "btn btn-secondary" onclick = "removeQuestion('+num+','+val+')"><i class = "bi bi-trash"></i>Remove</button>'+
                '</div>'+
            '</div>'
        )
    }
}
function removeQuestion(val1, val2){
    if(val2 == 0){
        $("#div"+val1+"").remove();
    }else if(val2 == 1 ){
        $("#multi_div"+val1+"").remove();
    }else if(val2 == 2){
        $("#blank_div"+val1+"").remove();
        var text = YourEditor.getData();
        var temp = text.split("[Blank]");
        var result = '';
        for(var i = 0; i<temp.length; i++){
            if(val1 - 1 == i){
                result += temp[i];
            }else{
                if(i != temp.length - 1){
                    result += temp[i]+'[Blank]';
                }else{
                    result += temp[i];
                }
            }
        }
        YourEditor.setData(result);
    }else if(val2 == 3){

    }else{
        $("#match_div"+val1+"").remove();
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
function saveBlankQus(){
    var content = YourEditor.getData();
    var inputList = $("#blank_qus_modal > div");
    var limitTime = $("#limit_time").val();
    var examid = $("#is_exam").val();
    var quizeid = $("#quiz_id").val();
    var qus = new Array();
    for(var i = 0; i < inputList.length; i++){
        var text = inputList[i].children[0].value;
        var quesItem = {
            question : text
        }
        qus.push(quesItem);
    }
    content = content.replace(/\[Blank\]/g,"__");
    $.post("/exam/create/question",
        {
            type: 2,
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
                $("#blankModal").modal("hide");
                $('#blankModal').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea,select")
                            .val('')
                            .end()
                        .find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                    })
                $("#blank_qus_modal").html("");
                $("#blank_qus_modal").html(initialBlankModal);
                YourEditor.setData("");
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
function saveFreeQus(){
    var content = freeEditor.getData();
    var limitTime = $("#limit_time").val();
    var examid = $("#is_exam").val();
    var quizeid = $("#quiz_id").val();
    $.post("/exam/create/question",
        {
            type: 3,
            content: content,
            questions : "",
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
                $("#freeModal").modal("hide");
                $('#freeModal').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea,select")
                            .val('')
                            .end()
                        .find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                    })
                freeEditor.setData("");
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
function saveMatchQus(){
    var content = $('#match_qus_content').val();
    var inputList = $("#match_qus_modal > div");
    var limitTime = $("#limit_time").val();
    var examid = $("#is_exam").val();
    var quizeid = $("#quiz_id").val();
    var qus = new Array();
    console.log(inputList[0].children[0].children[0].value);
    for(var i = 0; i < inputList.length; i++){
        var left = inputList[i].children[0].children[0].value;
        var right = inputList[i].children[1].children[0].value;
        var quesItem = {
            left : left,
            right : right 
        }
        qus.push(quesItem);
    }
    $.post("/exam/create/question",
        {
            type: 4,
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
                $("#matchModal").modal("hide");
                $('#matchModal').on('hidden.bs.modal', function (e) {
                    $(this)
                        .find("input,textarea,select")
                            .val('')
                            .end()
                        .find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                    })
                $("#match_qus_modal").html("");
                $("#match_qus_modal").html(initialMatchModal);
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
    $('#qusList tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    var table = $("#qusList").DataTable({
        "language": {
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       ">",
                "previous":   "<"
            },
          },
        initComplete: function () {
            this.api().columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        },
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
                }else if(row.type == 2){
                    return 'Blank Answer';
                }else if(row.type == 3){
                    return 'Free Answer';
                }else{
                    return 'Match Answer';
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
        $('#blankModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })
        $("#blank_qus_modal").html("");
        $("#blank_qus_modal").html(initialBlankModal);
        YourEditor.setData("");
        // YourEditor.ui.view.editable.element.style.height = '200px';
        YourEditor.config.height = 200;
    }else if(val == 3){
        freeEditor.setData("");
        freeEditor.ui.view.editable.element.style.height = '200px';
    }else{
        $('#matchModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })
        $("#match_qus_modal").html("");
        $("#match_qus_modal").html(initialMatchModal);
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
            if(status == "success"){
                result = JSON.parse(data);
                if(result.data.type == "0"){
                    createUniqueModal(data);
                }else if(result.data.type == "1"){
                    createMultipleModal(data);
                }else if(result.data.type == "2"){
                    createBlankModal(data);
                }else if(result.data.type == "3"){
                    createFreeModal(data);
                }else{
                    createMatchModal(data);
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
                html += '<div class="input-group mb-3" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value="" checked></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }else {
                html += '<div class="input-group mb-3" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value=""></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }
        }else {
            if(problems[i].answer == "true"){
                html += '<div class="input-group mb-3" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value="" checked></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button class="btn btn-secondary btn-sm" type="button" onclick="removeQuestion(' + i + ',0)"><i class = "bi bi-trash"></i>Remove</button></div>';
            }else {
                html += '<div class="input-group mb-3" id="div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="radio" name="flexRadioDefault" value=""></div><input type="text" id="input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button class="btn btn-secondary btn-sm" type="button" onclick="removeQuestion(' + i + ',0)"><i class = "bi bi-trash"></i>Remove</button></div>';
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
                html += '<div class="input-group mb-3" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value="" checked></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }else {
                html += '<div class="input-group mb-3" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value=""></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"></div>';
            }
        }else {
            if(problems[i].answer == "true"){
                html += '<div class="input-group mb-3" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value="" checked></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button class = "btn btn-secondary btn-sm" type="button" onclick="removeQuestion(' + i + ',1)"><i class = "bi bi-trash"></i>Remove</button></div>';
            }else {
                html += '<div class="input-group mb-3" id="multi_div' + i + '"><div class="input-group-text">        <input class="form-check-input " type="checkbox" name="flexRadioDefault" value=""></div><input type="text" id="multi_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button type="button" class = "btn btn-secondary btn-sm" onclick="removeQuestion(' + i + ',1)"><i class = "bi bi-trash"></i>Remove</button></div>';
            }
        }
        
    }

    $("#multi_qus_modal").html(html);
    $("#multipleModal").modal('show');
}
var createBlankModal = function(data){
    var temp = JSON.parse(data);
    var data = temp.data;
    var content = data.ques_content;
    var id = data.id;
    var problems = JSON.parse(temp.data.qus_answer);
    content = content.replace(/\_\_/g,"[Blank]");
    YourEditor.setData(content);
    $("#quiz_id").val(id);
    $("#blank_qus_modal").html("");
    var html = '<input type="hidden" id="blank_last_num" value="' + (problems.length - 1) + '">';
    for(var i = 0; i < problems.length; i++) {
        html += '<div class="input-group mb-3" id="blank_div' + i + '"><input type="text" id="blank_input' + i + '" class="form-control input" aria-label="Text input with radio button" value="' + problems[i].question + '"><button type="button" class = "btn btn-secondary btn-sm" onclick="removeQuestion(' + i + ',2)"><i class = "bi bi-trash"></i>Remove</button></div>';
    }
    $("#blank_qus_modal").html(html);
    $("#blankModal").modal('show');
}
var createFreeModal = function(data){
    var temp = JSON.parse(data);
    var data = temp.data;
    var content = data.ques_content;
    var id = data.id;
    freeEditor.setData(content);
    freeEditor.ui.view.editable.element.style.height = '200px';
    $("#quiz_id").val(id);
    $("#freeModal").modal('show');
}
var createMatchModal = function(data){
    var temp = JSON.parse(data);
    var data = temp.data;
    var content = data.ques_content;
    var id = data.id;
    var problems = JSON.parse(temp.data.qus_answer);
    $("#match_qus_content").val(content);
    $("#quiz_id").val(id);
    $("#match_qus_modal").html("");
    var html = '<input type="hidden" id="multi_last_num" value="' + (problems.length - 1) + '">';
    for(var i = 0; i < problems.length; i++) {
        html += '<div class = "row form-group mb-3" id = match_div0>';
        if(i == problems.length){
            html += '<div class="col-6">' +
                        '<input type="text" id = "match_input'+i+'l" class="form-control input" aria-label="Text input with radio button" value = "'+problems[i].left+'">'+
                    '</div>' +
                    '<div class="col-6">' +
                        '<input type="text" id = "match_input'+i+'r" class="form-control input" aria-label="Text input with radio button" value = "'+problems[i].right+'">'+
                    '</div>' +
                    '<div class="col-2">' +
                        '<button type = "button" class = "btn btn-secondary" onclick = "removeQuestion('+i+',4)"><i class = "bi bi-trash"></i>Remove</button>'+
                    '</div>' +
                '</div>';
        }else{
            html += '<div class="col-5">' +
                        '<input type="text" id = "match_input'+i+'l" class="form-control input" aria-label="Text input with radio button" value = "'+problems[i].left+'">'+
                    '</div>' +
                    '<div class="col-5">' +
                        '<input type="text" id = "match_input'+i+'r" class="form-control input" aria-label="Text input with radio button" value = "'+problems[i].right+'">'+
                    '</div>' +
                    '<div class="col-2">' +
                        '<button type = "button" class = "btn btn-secondary" onclick = "removeQuestion('+i+',4)"><i class = "bi bi-trash"></i>Remove</button>'+
                    '</div>' +
                '</div>';
        }
        
    }

    $("#match_qus_modal").html(html);
    $("#matchModal").modal('show');
}                        
var deleteExam = function(id){
    $.post("/exam/delete",
    {
        id : id
    },
    function(data, status){
        var result = JSON.parse(data);
        console.log(result);
        if(result.data == true){
            Swal.fire({
                icon: 'success',
                text: 'Your examination has been successfully saved!',
            })
            var table = $('#example').DataTable();
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
var showHideExam = function(id){
    var showFlag = $("#showFlag").val();
    if(Number(showFlag) == 0){
        $("#showFlag").val(1);
        toggleExam(id,1);
    }else{
        $("#showFlag").val(0);
        toggleExam(id,0);
    }
}
var toggleExam = function(id,flag){
    $.post("/exam/show",
        {
            id : id,
            flag : flag
        },
        function(data, status){
            var result = JSON.parse(data);
            if(result.data == true){
                if(flag == 0){
                    $("#show_exam").html("");
                    $("#show_exam").html("<i class='bi bi-eye-slash-fill'></i><input type='hidden' id='showFlag' value='"+flag+"'>");
                }else{
                    $("#show_exam").html("");
                    $("#show_exam").html("<i class='bi bi-eye'></i><input type='hidden' id='showFlag' value='"+flag+"'>");
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
