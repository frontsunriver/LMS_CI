window.onload = function(){
$(".vme").on(
    'click',
    function(e){
        var id2=e['currentTarget'].dataset.ref;
        var myModal3 = new bootstrap.Modal(document.getElementById('Modal3'), {});
        $("#Modal3 .modal-body").html($("#"+id2).html());
        //
        $(".evento").on(
            'click',
            function(e){
                myModal3.hide();
                var myModal = new bootstrap.Modal(document.getElementById('Modal'), {})
                myModal.show();
                $("#ModalLabel").html("");
                $("#Modal .modal-body").html("Cargando...");
                //console.log(e['currentTarget'].dataset.id);
                var id=e['currentTarget'].dataset.id;
                var nemo=e['currentTarget'].dataset.nemo;
                var cod=e['currentTarget'].dataset.cod;
                var title=e['currentTarget'].dataset.titlemod;
                $.ajax({
                    type: 'post',
                    url: app_main.url + '/calendario/evento',
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    data: {
                        'id': id,
                        'nemo': nemo,
                        'cod': cod
                    },
                    success: function(response) {
                        $("#ModalLabel").html(title);
                        $("#Modal .modal-body").html(response);
                        tinymce.init({
                            selector:'textarea#tinyhtml',
                            plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons save',
                            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | a11ycheck ltr rtl | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | image media link',
                            tinydrive_token_provider: 'jwt.php',
                            menubar: '',
                            readonly : 2
                        });
                        var myModalEl = document.getElementById('Modal')
                        myModalEl.addEventListener('hidden.bs.modal', function (event) {
                          tinymce.remove('#tinyhtml');
                          myModal3.show();
                        })
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('Error: ' + thrownError);
                    }
                });

            }
        )
        //
        myModal3.show();
    });
$(".edt-evt").on(
    'click',
    function(e){
        //console.log(e['currentTarget'].dataset.id);
        var id=e['currentTarget'].dataset.id;
        var nemo=e['currentTarget'].dataset.nemo;
        var cod=e['currentTarget'].dataset.cod;
        var title=e['currentTarget'].dataset.titlemod;
        $.ajax({
            type: 'post',
            url: app_main.url + '/calendario/edt_evento',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {
                'id': id,
                'nemo': nemo,
                'cod': cod
            },
            success: function(response) {
                var myModal = new bootstrap.Modal(document.getElementById('Modal'), {})
                var myModal2 = new bootstrap.Modal(document.getElementById('Modal2'), {})
                $("#ModalLabel").html("Nuevo evento : "+title);
                $("#Modal .modal-body").html(response);
                $("#Modal .modal-save").css({"display":"block"});

                $("#formularioEvento").on(
                    "submit",
                    function(evt){
                        evt.preventDefault();
                        
                        var formH=document.getElementById("formularioEvento");
                        var form=new FormData(formH);
                        form.append("nemo",nemo);
                        form.append("cod",cod);

                        var xhr = new XMLHttpRequest(); 
                        xhr.open('POST',app_main.url + '/calendario/save_evento',true); // 
                        xhr.setRequestHeader('X-Requested-With','XMLHttpRequest'); //if you have included the setRequestHeader remove that line as you need the // multipart/form-data as content type.
                        xhr.onload = function(){ 
                            if(xhr.responseText=="ok"){
                                $.alert({
                                    icon: 'fa fa-info-circle',
                                    title: 'Evento modificado',
                                    content: 'El evento se ha modificado correctamente.',
                                    type: 'green',
                                    typeAnimated: true,
                                    escapeKey: true,
                                    buttons: {
                                        close: {
                                            text: 'Aceptar',
                                            btnClass: 'btn-green',
                                            keys: ['enter']
                                        }
                                    }
                                });
                                myModal.hide();
                                document.location.reload();
                            }else{
                                $.alert({
                                    icon: 'fa fa-info-circle',
                                    title: 'Error',
                                    content: 'El evento no se ha registrado correctamente.<br>'+xhr.responseText,
                                    type: 'red',
                                    typeAnimated: true,
                                    escapeKey: true,
                                    buttons: {
                                        close: {
                                            text: 'Aceptar',
                                            btnClass: 'btn-red',
                                            keys: ['enter']
                                        }
                                    }
                                });}
                        }
                        xhr.send(form);
                    }
                )
                $('#fecha').datepicker({
                    format:'Y-m-d',
                    timepicker:false
                });
        
                tinymce.init({
                    selector:'textarea#tinyhtml',
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                        });
                    },
                    plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons save',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | a11ycheck ltr rtl | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | image media link',
                    tinydrive_token_provider: app_main.url +'/assets/tiny/jwt.php',
                    menubar: ''
                });
                $("#secciones_btn").on(
                    'click',
                    function (e){
                        var codprof=e['currentTarget'].dataset.codprof;
                        var nemo=$("#nemo")[0].value;
                        var cod=$("#cod")[0].value;
                        var secc=$("#secc")[0].value;
                        $("#Modal2 .modal-body").html("Cargando...");
                        $.ajax({
                            type: 'post',
                            url: app_main.url + '/calendario/secciones',
                            headers: {'X-Requested-With': 'XMLHttpRequest'},
                            data: {
                                'codprof': codprof,
                                'nemo': nemo,
                                'cod': cod,
                                'secc': secc
                            },
                            success: function(response) {
                                $("#Modal2 .modal-body").html(response);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log('Error: ' + thrownError);
                            }
                        });
                        myModal.hide();
                        myModal2.show();
                    }
                );
                $("#file_b").on(
                    'click',
                    function (e){
                        var cntf=0;
                        for (var i = 0; i < 10 ; i++) {
                            if($("#dfile_"+i).length){
                                cntf++;
                            }
                        }
                        var files=$(".file_");
                        for (var i = 0; i < 10-cntf ; i++) {
                            if(files[i].value==""){files[i].click();return;}
                        }
                        
                    }
                );
                $(".file_").on(
                    'change',
                    function (e){
                        var files=$(".file_");
                        var cnt=0;
                        $("#file_l").html("");
                        var appn="";
                        for (var i = 0; i < 10 ; i++) {
                            if($("#dfile_"+i).length){
                                cnt++;
                            }
                        }
                        for (var i = 0; i < 10 ; i++) {
                            if(files[i].value!=""){
                                appn='<div class="col-12 p-2 border-bottom">';
                                appn+='<span class="m-2">';
                                appn+='<img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;">';
                                appn+='<a href="#">'+files[i].files[0].name+'</a>';
                                appn+='</span><button type="button" class="btn btn-danger p-0 px-2" id="file_b" onclick="eliminarFile('+i+')">Eliminar</button></div>';
                                $("#file_l").append(appn);
                                cnt++;
                            }
                        }
                        if(cnt==10){
                            $("#file_b").hide();
                        }else{
                            $("#file_b").show();
                        }
                        
                    }
                );
                $("#retorno").on(
                    'change',
                    function (e){
                        var id=e['currentTarget'].checked;
                        if(id==true){
                            $("#feed_fecha").attr("readonly",false);
                            $("#feed_fecha").attr("required",true);
                            $('#feed_fecha').datepicker({
                                minDate:0,
                                format:'Y-m-d H:i:s',
                                timepicker:true
                            });
                        }else{
                            $("#feed_fecha").attr("readonly",true);
                            $("#feed_fecha").attr("required",false);
                            $('#feed_fecha').datepicker("destroy");
                        }
                    }
                    )
                myModal.show();
                var myModalEl = document.getElementById('Modal')
                myModalEl.addEventListener('hidden.bs.modal', function (event) {
                  tinymce.remove('#tinyhtml');
                  $("#Modal .modal-save").css({"display":"none"});
                })
                var myModalEl2 = document.getElementById('Modal2')
                myModalEl2.addEventListener('hidden.bs.modal', function (event) {
                    tinymce.init({
                        selector:'textarea#tinyhtml',
                        setup: function (editor) {
                            editor.on('change', function () {
                                editor.save();
                            });
                        },
                        plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons save',
                        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | a11ycheck ltr rtl | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | image media link',
                        tinydrive_token_provider: app_main.url +'/assets/tiny/jwt.php',
                        menubar: ''
                    });
                    var sel=$(".seccion_selected");
                    var sel_s="";
                    var title="";
                    $("#secciones").html("");
                    for (var i = 0; i <= sel.length - 1; i++) {
                        if(sel[i].checked==true){
                            sel_s+=sel[i].dataset.info+";";
                            title=sel[i].dataset.title;
                            title=title.split("|");
                            $("#secciones").html($("#secciones").html()+"<span>"+title[0]+" - "+title[1]+"</span><br>");
                        }
                    }
                    sel_s=sel_s.substr(0,sel_s.length-1);
                    $("#secc")[0].value=sel_s;
                    $("#Modal .modal-save").css({"display":"block"});
                })
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error: ' + thrownError);
            }
        });

    }
)
$(".del-evt").on(
    'click',
    function(e){
        //console.log(e['currentTarget'].dataset.id);
        var id=e['currentTarget'].dataset.id;
        $.ajax({
            type: 'post',
            url: app_main.url + '/calendario/del_evento',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {
                'id': id
            },
            success: function(response) {
                $.alert({
                    icon: 'fa fa-info-circle',
                    title: 'Evento eliminado',
                    content: 'El evento se ha eliminado correctamente.',
                    type: 'red',
                    typeAnimated: true,
                    escapeKey: true,
                    buttons: {
                        close: {
                            text: 'Aceptar',
                            btnClass: 'btn-red',
                            keys: ['enter']
                        }
                    }
                });
                document.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error: ' + thrownError);
            }
        });

    }
)
$(".evento").on(
    'click',
    function(e){
        //console.log(e['currentTarget'].dataset.id);
        var id=e['currentTarget'].dataset.id;
        var nemo=e['currentTarget'].dataset.nemo;
        var cod=e['currentTarget'].dataset.cod;
        var title=e['currentTarget'].dataset.titlemod;
        $.ajax({
            type: 'post',
            url: app_main.url + '/calendario/evento',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {
                'id': id,
                'nemo': nemo,
                'cod': cod
            },
            success: function(response) {
                var myModal = new bootstrap.Modal(document.getElementById('Modal'), {})
                $("#ModalLabel").html(title);
                $("#Modal .modal-body").html(response);
                tinymce.init({
                    selector:'textarea#tinyhtml',
                    plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons save',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | a11ycheck ltr rtl | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | image media link',
                    tinydrive_token_provider: 'jwt.php',
                    menubar: '',
                    readonly : 2
                });
                myModal.show();
                var myModalEl = document.getElementById('Modal')
                myModalEl.addEventListener('hidden.bs.modal', function (event) {
                  tinymce.remove('#tinyhtml');
                })
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error: ' + thrownError);
            }
        });

    }
)
$(".combo").on(
    'click',
    function(e){
        //console.log(e['currentTarget'].dataset.id);
        var id=e['currentTarget'].dataset.id;
        var nemo=e['currentTarget'].dataset.nemo;
        var cod=e['currentTarget'].dataset.cod;
        var title=e['currentTarget'].innerHTML;
        $.ajax({
            type: 'post',
            url: app_main.url + '/calendario/new_evento',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: {
                'comboId': id,
                'nemo': nemo,
                'cod': cod
            },
            success: function(response) {
                var myModal = new bootstrap.Modal(document.getElementById('Modal'), {})
                var myModal2 = new bootstrap.Modal(document.getElementById('Modal2'), {})
                $("#ModalLabel").html("Nuevo evento : "+title);
                $("#Modal .modal-body").html(response);
                $("#Modal .modal-save").css({"display":"block"});

                $("#formularioEvento").on(
                    "submit",
                    function(evt){
                        evt.preventDefault();
                        
                        var formH=document.getElementById("formularioEvento");
                        var form=new FormData(formH);
                        form.append("nemo",nemo);
                        form.append("cod",cod);

                        var xhr = new XMLHttpRequest(); 
                        xhr.open('POST',app_main.url + '/calendario/save_evento',true); // 
                        xhr.setRequestHeader('X-Requested-With','XMLHttpRequest'); //if you have included the setRequestHeader remove that line as you need the // multipart/form-data as content type.
                        xhr.onload = function(){ 
                            if(xhr.responseText=="ok"){
                                $.alert({
                                    icon: 'fa fa-info-circle',
                                    title: 'Evento registrado',
                                    content: 'El evento se ha registrado correctamente.',
                                    type: 'green',
                                    typeAnimated: true,
                                    escapeKey: true,
                                    buttons: {
                                        close: {
                                            text: 'Aceptar',
                                            btnClass: 'btn-green',
                                            keys: ['enter']
                                        }
                                    }
                                });
                                myModal.hide();
                                document.location.reload();
                            }else{
                                $.alert({
                                    icon: 'fa fa-info-circle',
                                    title: 'Error',
                                    content: 'El evento no se ha registrado correctamente.<br>'+xhr.responseText,
                                    type: 'red',
                                    typeAnimated: true,
                                    escapeKey: true,
                                    buttons: {
                                        close: {
                                            text: 'Aceptar',
                                            btnClass: 'btn-red',
                                            keys: ['enter']
                                        }
                                    }
                                });}
                        }
                        xhr.send(form);
                    }
                )
                $('#fecha').datepicker({
                    format:'Y-m-d',
                    timepicker:false
                });
        
                tinymce.init({
                    selector:'textarea#tinyhtml',
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                        });
                    },
                    plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons save',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | a11ycheck ltr rtl | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | image media link',
                    tinydrive_token_provider: app_main.url +'/assets/tiny/jwt.php',
                    menubar: ''
                });
                $("#secciones_btn").on(
                    'click',
                    function (e){
                        var codprof=e['currentTarget'].dataset.codprof;
                        var nemo=$("#nemo")[0].value;
                        var cod=$("#cod")[0].value;
                        var secc=$("#secc")[0].value;
                        $("#Modal2 .modal-body").html("Cargando...");
                        $.ajax({
                            type: 'post',
                            url: app_main.url + '/calendario/secciones',
                            headers: {'X-Requested-With': 'XMLHttpRequest'},
                            data: {
                                'codprof': codprof,
                                'nemo': nemo,
                                'cod': cod,
                                'secc': secc
                            },
                            success: function(response) {
                                $("#Modal2 .modal-body").html(response);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log('Error: ' + thrownError);
                            }
                        });
                        myModal.hide();
                        myModal2.show();
                    }
                );
                $("#file_b").on(
                    'click',
                    function (e){
                        var files=$(".file_");
                        for (var i = 0; i < 10 ; i++) {
                            if(files[i].value==""){files[i].click();return;}
                        }
                        
                    }
                );
                $(".file_").on(
                    'change',
                    function (e){
                        var files=$(".file_");
                        var cnt=0;
                        $("#file_l").html("");
                        var appn="";
                        for (var i = 0; i < 10 ; i++) {
                            if(files[i].value!=""){
                                appn='<div class="col-12 p-2 border-bottom">';
                                appn+='<span class="m-2">';
                                appn+='<img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;">';
                                appn+='<a href="#">'+files[i].files[0].name+'</a>';
                                appn+='</span><button type="button" class="btn btn-danger p-0 px-2" id="file_b" onclick="eliminarFile('+i+')">Eliminar</button></div>';
                                $("#file_l").append(appn);
                                cnt++;
                            }
                        }
                        if(cnt==10){
                            $("#file_b").hide();
                        }else{
                            $("#file_b").show();
                        }
                        
                    }
                );
                $("#retorno").on(
                    'change',
                    function (e){
                        var id=e['currentTarget'].checked;
                        if(id==true){
                            $("#feed_fecha").attr("readonly",false);
                            $("#feed_fecha").attr("required",true);
                            $('#feed_fecha').datepicker({
                                minDate:0,
                                format:'Y-m-d H:i:s',
                                timepicker:true
                            });
                        }else{
                            $("#feed_fecha").attr("readonly",true);
                            $("#feed_fecha").attr("required",false);
                            $('#feed_fecha').datepicker("destroy");
                        }
                    }
                    )
                myModal.show();
                var myModalEl = document.getElementById('Modal')
                myModalEl.addEventListener('hidden.bs.modal', function (event) {
                  tinymce.remove('#tinyhtml');
                  $("#Modal .modal-save").css({"display":"none"});
                })
                var myModalEl2 = document.getElementById('Modal2')
                myModalEl2.addEventListener('hidden.bs.modal', function (event) {
                    tinymce.init({
                        selector:'textarea#tinyhtml',
                        setup: function (editor) {
                            editor.on('change', function () {
                                editor.save();
                            });
                        },
                        plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons save',
                        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | a11ycheck ltr rtl | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | charmap emoticons | image media link',
                        tinydrive_token_provider: app_main.url +'/assets/tiny/jwt.php',
                        menubar: ''
                    });
                    var sel=$(".seccion_selected");
                    var sel_s="";
                    var title="";
                    $("#secciones").html("");
                    for (var i = 0; i <= sel.length - 1; i++) {
                        if(sel[i].checked==true){
                            sel_s+=sel[i].dataset.info+";";
                            title=sel[i].dataset.title;
                            title=title.split("|");
                            $("#secciones").html($("#secciones").html()+"<span>"+title[0]+" - "+title[1]+"</span><br>");
                        }
                    }
                    sel_s=sel_s.substr(0,sel_s.length-1);
                    $("#secc")[0].value=sel_s;
                    $("#Modal .modal-save").css({"display":"block"});
                })
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error: ' + thrownError);
            }
        });

    }
)

$("#saveForm").on(
    'click',
    function(e){
        $("#formularioEvento").submit();    
    }
)
$("#filtro_curso").on(
    'keyup',
    function (e){
        var txt=e['currentTarget'].value;
        txt=txt.toLowerCase();
        var cursos=$(".curso");
        cursos.css({"display":"block"});
        if (txt=="") {return;}
        for (var i = cursos.length - 1; i >= 0; i--) {
            var stxt=cursos[i].dataset.search;
            stxt=stxt.toLowerCase();
            if(stxt.search(txt)==-1){
                $(cursos[i]).css({"display":"none"});
            }
        }
    }
    )

}
function eliminarFile(index){
    var files=$(".file_");
    files[index].value="";
    $("#file_l").html("");
    var cnt=0;
    var appn="";
    for (var i = 0; i < 10 ; i++) {
        if(files[i].value!=""){
            appn='<div class="col-12 p-2 border-bottom">';
            appn+='<span class="m-2">';
            appn+='<img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;">';
            appn+='<a href="#">'+files[i].files[0].name+'</a>';
            appn+='</span><button type="button" class="btn btn-danger p-0 px-2" id="file_b" onclick="eliminarFile('+i+')">Eliminar</button></div>';
            $("#file_l").append(appn);
            cnt++;
        }
    }
    if(cnt==10){
        $("#file_b").hide();
    }else{
        $("#file_b").show();
    }
}
function eliminarDFile(id){
    var files_=$("#dfile_"+id);
    files_.remove();
    var files=$(".file_");
    $("#file_l").html("");
    var cnt=0;
    var appn="";
    for (var i = 0; i < 10 ; i++) {
        if($("#dfile_"+i).length){
            cnt++;
            console.log(cnt);
        }
    }
    for (var i = 0; i < 10 ; i++) {
        if(files[i].value!=""){
            appn='<div class="col-12 p-2 border-bottom">';
            appn+='<span class="m-2">';
            appn+='<img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;">';
            appn+='<a href="#">'+files[i].files[0].name+'</a>';
            appn+='</span><button type="button" class="btn btn-danger p-0 px-2" id="file_b" onclick="eliminarFile('+i+')">Eliminar</button></div>';
            $("#file_l").append(appn);
            cnt++;
        }
    }
    if(cnt==10){
        $("#file_b").hide();
    }else{
        $("#file_b").show();
    }
}