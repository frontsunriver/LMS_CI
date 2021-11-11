<?= $this->extend('layout/main') ?>
<?= $this->section('head') ?>
    <script src="//cdn.tiny.cloud/1/51dzbcm0r82iy8a2yrit963nkv27b2lm3qhz7fftmvxn7glv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/dashboard.css') ?>">   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css"/>
    <style>
        .ck-content {
            height: 200px;
        }
        .bi{
            padding:3px;
        }
    </style>
<?= $this->endSection()?>
<?= $this->section('title') ?>
    Exam
<?= $this->endSection()?>
<?= $this->section('body') ?>
    <div id="main-wrap" class="container-fluid p-0">
        <?= $this->include('layout/sidebar') ?>
        <main class="main">              
            <div id="main-right" class="col-md-9 ms-sm-auto col-lg-10">
            <?= $this->include('layout/top-bar') ?>
            <?= $this->include('layout/top-menu') ?>
            <section class="px-md-4 bg-light">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('/exam'); ?>">Exam</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('/exam/examdetail'); ?>/<?= $nemodes['nemo']?>/<?=$cursonom['cod']?>"><?=$nemodes['nemodes']?>-<?=$cursonom['cursonom']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-left shadow">
                                <div class="card-style card">
                                <div class="card-header">
                                    <div class="name p-1" style="display: inline-block;">Create Exam of <?=$nemodes['nemodes']?>-<?=$cursonom['cursonom']?></div>
                                    <a type="button" href="<?php echo base_url('/exam'); ?>" class=" btn float-end py-1 px-2 btn-success me-2 btn-lg">Cancel</a></button>
                                </div>
                                <div class="card-body row">
                                    <div class = "col-4">
				                    <input type="hidden" id="is_exam" value='<?=$exam_id?>'>
				                    <input type="hidden" id="ini_table" value= "false">
				                    <input type="hidden" id="nemo" value= <?=$nemodes['nemo']?>>
				                    <input type="hidden" id="cod" value= <?=$cursonom['cod']?>>

                                        <div class="col-lg-12"  style = "margin-bottom : 20px" data-plugin-portlet id="portlet-1">
                                            <section class="card card-question" id="card-1" data-portlet-item>
                                                <header class="card-header portlet-handler">
                                                    <div class="card-actions">
                                                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                                    </div>
                                                    <h4 class="name p-1"><i class="bi bi-question-circle"></i>Questions</h4>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <button type="button" style = "width: -webkit-fill-available;" class="btn btn btn-outline-secondary btn-lg" data-goto="multi-choice" onclick = "showUniqueModal();"><i class="fa fa-dot-circle-o"></i> Unique Answer</button>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <button type="button" style = "width: -webkit-fill-available;" class="btn btn btn-outline-secondary btn-lg" data-goto="checkbox" onclick = "showMultipleModal();"><i class="fa fa-check-square-o"></i> Multiple Answer</button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <button type="button" style = "width: -webkit-fill-available;" class="btn btn btn-outline-secondary btn-lg" data-goto="true-false" onclick = "showMatchModal();">
                                                                <i class="fa fa-check"></i><i class="fa fa-close"></i> Match Answer the Question</button>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <button type="button" style = "width: -webkit-fill-available;" class="btn btn btn-outline-secondary btn-lg" data-goto="fill-blank" onclick = "showBlankModal();"><i class="fa fa-minus"></i> Complete the word</button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <button type="button" style = "width: -webkit-fill-available;" class="btn btn-outline-secondary btn-lg" data-goto="manual" onclick = "showFreeModal();"><i class="fa fa-server"></i> Free Answer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-12"  style = "margin-bottom : 20px"  data-plugin-portlet id="portlet-1">
                                            <section class="card card-question" id="card-1" data-portlet-item>
                                                <header class="card-header portlet-handler">
                                                    <div class="card-actions">
                                                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                                    </div>
                                                    <h4 class="name p-1"><i class="bi bi-gear"></i>Popular Settings</h4>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2">Limit Time</label>
                                                        <div style="color: red; font-weight: bold;font-size:11px;" class="col-sm-12 text-sm-left">You can put 0 to ignore time limitation.</div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="number" name="limit_time" id = "limit_time" class="form-control" placeholder="Time Limitation" required="" value="<?php echo isset($limit_time)?$limit_time :""?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2">Minimum Pass Percent</label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" name="min_percent" id = "pass_percent" class="form-control" placeholder="Minimum Pass Percent (%)" required="" value="<?php echo isset($pass_percent)?$pass_percent:""?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "card-footer">
                                                    <a type="button" href="javascript:savePopularset();" class="btn float-end py-1 px-2 btn-primary me-2 btn-lg"><i class = "bi bi-send"></i>Save</a></button>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div class = "col-8">
                                        <div class="col-lg-12"  style = "margin-bottom : 20px"  data-plugin-portlet id="portlet-1">
                                            <section class="card card-question" id="card-1" data-portlet-item>
                                                <header class="card-header portlet-handler">
                                                    <div class="card-actions">
                                                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                                    </div>
                                                    <h4 class="name p-1"><i class="bi bi-share"></i>About Exam</h4>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2"><h3>Exam Title</h3></label>
                                                        <div style="color: red; font-weight: bold;font-size:11px;" class="col-sm-12 text-sm-left">You have to input the title of exam.</div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" name="exam_title" id = "exam_title" class="form-control" placeholder="title" required="" value="<?php echo isset($title)?$title:""?> ">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2"><h3>About exam</h3></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="exam_content" style= "min-height:100px !important" id = "exam_content" aria-label="With textarea" ><?php echo isset($content)?$content:""?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "card-footer">
                                                    <button class="btn float-end py-1 px-2 btn-primary me-2 btn-lg" type="button" onclick = "saveExam();"><i class = "bi bi-send"></i>Save</button>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-lg-12"  style = "margin-bottom : 20px"  data-plugin-portlet id="portlet-1">
                                            <section class="card card-question" id="card-1" data-portlet-item>
                                                <header class="card-header portlet-handler">
                                                    <div class="card-actions">
                                                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                                    </div>
                                                    <h4 class="name p-1"><i class="bi bi-list"></i>List of Questions</h4>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                <table id="qusList" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Content of Exam</th>
                                                            <th>Type of Exam</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Content of Exam</th>
                                                            <th>Type of Exam</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
            </div>
    </main>
</div>
<input type="hidden" id="quiz_id"/>
<!-- unique answer modal beggin-->
<div class="modal fade" id="uniqueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Unique Answers.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class = "input-group mb-3">
                    <textarea class="form-control" name="qus_content" id = "qus_content" style = "min-height : 200px !important" aria-label="Type here Question..." placeholder = "Type here problem..."></textarea>
                </div>
                <div class = "input-group mb-3" id = "qus_modal">
                    <input type="hidden" id="last_num" value= 1>
                    <div class="input-group mb-3" id = "div0">
                        <div class="input-group-text" >
                            <input class="form-check-input "  type="radio" name="flexRadioDefault"  value = "0" checked>
                        </div>
                        <input type="text" id = "input0" class="form-control input" aria-label="Text input with radio button" value = "">
                    </div>
                    <div class="input-group mb-3" id = "div1">
                        <div class="input-group-text">
                            <input class="form-check-input "  type="radio" name="flexRadioDefault"  value = "1">
                        </div>
                        <input type="text" id = "input1" class="form-control input" aria-label="Text input with radio button" value = "">
                        <button type = "button" class = "btn btn-secondary btn-sm" onclick = "removeQuestion(1, 0)"><i class = "bi bi-trash"></i>Remove</button>
                    </div>
                </div>
                <div class = "form-group">
                    <button type = "button" class = "btn btn-primary " onclick = "addQuestion(0)"><i class = "bi bi-plus"></i>Add</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick = "saveUniqQus()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- unique answer modal end -->

<!-- multiple answer modal beggin-->
<div class="modal fade" id="multipleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Multiple Answers.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class = "form-group mb-3">
                    <textarea class="form-control" name="multi_qus_content" style = "min-height : 200px !important" id = "multi_qus_content" aria-label="Type here Question..."></textarea>
                </div>
                <div class = "form-group" id = "multi_qus_modal">
                    <input type="hidden" id="multi_last_num" value= 1>
                    <div class="input-group mb-3" id = "multi_div0">
                        <div class="input-group-text" >
                            <input class="form-check-input "  type="checkbox" name="flexRadioDefault"  value = "0">
                        </div>
                        <input type="text" id = "multi_input0" class="form-control input" aria-label="Text input with radio button" value = "">
                    </div>
                    <div class="input-group mb-3" id = "multi_div1">
                        <div class="input-group-text">
                            <input class="form-check-input "  type="checkbox" name="flexRadioDefault"  value = "1">
                        </div>
                        <input type="text" id = "multi_input1" class="form-control input" aria-label="Text input with radio button" value = "">
                        <button type = "button" class = "btn btn-secondary btn-sm" onclick = "removeQuestion(1,1)">Remove</button>
                    </div>
                </div>
                <div class = "form-group">
                    <button type = "button" class = "btn btn-primary" onclick = "addQuestion(1)"><i class = "bi bi-plus"></i>Add</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick = "saveMultiQus()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- multiple answer modal end -->

<!--  blank modal beggin-->
<div class="modal fade" id="blankModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Blank Answers.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="form-group editArea mb-3">
                    <textarea class="form-control form-control-lg" id="blank_quiz" placeholder="Type question here. Example: Practice makes you [Blank]" height="20"></textarea>
                </div>
                <div class="form-group mb-3">
                    <button type="button" class = "btn btn-primary" onclick = "addQuestion(2)"><i class = "bi bi-plus"></i>add blank</button>
                </div>
                <div class="form-group" id = "blank_qus_modal">
                    <input type="hidden" id="blank_last_num" value= 0>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick = "saveBlankQus()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--  blank modal end -->
<!-- free modal beggin-->
<div class="modal fade" id="freeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Free Answers.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class = "form-group mb-3 editArea">
                    <textarea class="form-control form-control-lg"  id="free_quiz" placeholder="Type question here."></textarea>
                </div>
                <input type="hidden" id="free_last_num" value= 0>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick = "saveFreeQus()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- free modal end -->
<!-- match modal beggin-->
<div class="modal fade" id="matchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Match Answers.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class = "form-group mb-3">
                    <textarea class="form-control" name="match_qus_content" style = "min-height:200px !important" id = "match_qus_content" placeholder="Type here Question..."></textarea>
                </div>
                <div class = "form-group" id = "match_qus_modal">
                    <input type="hidden" id="match_last_num" value= 1>
                    <div class = "form-group row mb-3" id = match_div0>
                        <div class="form-group col-5">
                            <input type="text" id = "match_input0l" class="form-control input" aria-label="Text input with radio button" value = "">
                        </div>
                        <div class="form-group col-5">
                            <input type="text" id = "match_input0r" class="form-control input" aria-label="Text input with radio button" value = "">
                        </div>
                        <div class="form-group col-2">
                            <button type = "button" class = "btn btn-secondary" onclick = "removeQuestion(1,4)">Remove</button>
                        </div>
                    </div>
                </div>
                <div class = "form-group">
                    <button type = "button" class ="btn btn-primary" onclick = "addQuestion(4)"><i class = "bi bi-plus"></i>Add</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick = "saveMatchQus()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- match modal end -->
<?= $this->endSection()?>
<?= $this->section('defer')?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="<?= base_url('/assets/js/exam.js') ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let YourEditor;
        let freeEditor;
        ClassicEditor
        .create( document.querySelector( '#blank_quiz' ) )
        .then( editor => {
            YourEditor = editor;
            editor.ui.view.editable.element.style.height = '200px';
        } )
        .catch( error => {
                console.error( error );
        } );
        $(document).ready(function(){
            ini_ques_tbl();
        });
        ClassicEditor
        .create( document.querySelector( '#free_quiz' ) )
        .then( editor => {
            freeEditor = editor;
            editor.ui.view.editable.element.style.height = '200px';
        } )
        .catch( error => {
                console.error( error );
        } );

    </script>

<?= $this->endSection()?>

