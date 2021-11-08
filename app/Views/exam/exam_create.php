<?= $this->extend('layout/main') ?>
<?= $this->section('head') ?>
    <script src="https://cdn.tiny.cloud/1/51dzbcm0r82iy8a2yrit963nkv27b2lm3qhz7fftmvxn7glv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/dashboard.css') ?>">   
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
                    <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-left shadow">
                                <div class="card-style card">
                                <div class="card-header">
                                    <div class="name p-1" style="display: inline-block;">Create Exam of <strong><h4><?=$nemodes['nemodes']?>-<?=$cursonom['cursonom']?></h4></strong></div>
                                    <a type="button" href="" class=" btn float-end py-1 px-2 btn-success me-2 btn-lg">save</a></button>
                                    <a type="button" href="<?php echo base_url('/exam'); ?>" class=" btn float-end py-1 px-2 btn-success me-2 btn-lg">cancle</a></button>
                                </div>
                                <div class="card-body row">
                                    <div class = "col-4">
				                    <input type="hidden" id="is_exam" value= "false">
                                        <div class="col-lg-12"  style = "margin-bottom : 20px" data-plugin-portlet id="portlet-1">
                                            <section class="card card-question" id="card-1" data-portlet-item>
                                                <header class="card-header portlet-handler">
                                                    <div class="card-actions">
                                                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                                    </div>
                                                    <h2 class="card-title"><i class="el el-question-sign"></i>Questions</h2>
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
                                                            <button type="button" style = "width: -webkit-fill-available;" class="btn btn-outline-secondary btn-lg" data-goto="manual"><i class="fa fa-server"></i> Free Answer</button>
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
                                                    <h2 class="card-title"><i class="el el-question-sign"></i>Popular Settings</h2>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2">Limit Time</label>
                                                        <div style="color: red; font-weight: bold;font-size:11px;" class="col-sm-12 text-sm-left">You can put 0 to ignore time limitation.</div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="number" name="limit_time" class="form-control" placeholder="Time Limitation" required="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2">Minimum Pass Percent</label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" name="min_percent" class="form-control" placeholder="Minimum Pass Percent (%)" required="" value="">
                                                        </div>
                                                    </div>
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
                                                    <h2 class="card-title"><i class="el el-question-sign"></i>About Exam</h2>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2"><h3>Exam Title</h3></label>
                                                        <div style="color: red; font-weight: bold;font-size:11px;" class="col-sm-12 text-sm-left">You can input the title of exam.</div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text" name="limit_time" class="form-control" placeholder="title" required="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-12 control-label text-sm-left pt-2"><h3>About of exam.</h3></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" aria-label="With textarea"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end" style = "margin-top : 20px;">
                                                        <button class="btn btn-primary me-md-2 btn-lg" type="button">Save</button>
                                                        <button class="btn btn-primary btn-lg" type="button">Button</button>
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
                                                    <h2 class="card-title"><i class="el el-question-sign"></i>List of Questions</h2>
                                                </header>
                                                <div id="quiz_type_div" class="card-body">
                                                <table id="qusList" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Exam Name</th>
                                                            <th>Number of Questions</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
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
<?= $this->endSection()?>
<?= $this->section('defer')?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#qusList").DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                paging: false,
                ordering: false,
                info: false,
                // "bInfo":false,
                ajax: {
                    url: "/exam/getExamList",
                    type: 'POST',
                    "data": {
                        "nemo": 2021001,
                        "cod": 01,
                    }
                },
                columns: [
                {data: 'title' },
                {data:'quizeCount' },
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
        });

    </script>
    <script type="text/javascript" src="<?= base_url('/assets/js/exam.js') ?>"></script>

<?= $this->endSection()?>

