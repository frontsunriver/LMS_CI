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
                                        <div class="name p-1" style="display: inline-block;">Exam:<?=$nemodes['nemodes']?>-<?=$cursonom['cursonom']?> </div>

                                    </div>
                                    <div class="card-body">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Exam Name</th>
                                                    <th>Number of Questions</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
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
    <!-- <script type="text/javascript" src="<?= base_url('/assets/js/exam.js') ?>"></script>  -->
    <script>
        $(document).ready(function(){
            $("#example").DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                paging: false,
                ordering: false,
                info: false,
                // "bInfo":false,
                ajax: {
                    url: "getExamList",
                    type: 'POST',
                    "data": {
                        "nemo": <?=$nemodes['nemo']?>,
                        "cod": <?=$cursonom['cod']?>,
                    }
                },
                columns: [
                {
                    data: 'title'
                },
                {
                    data:'quizeCount'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        console.log(data);
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
                }]
                // columnDefs: [{
                //         targets: -1,
                //         title: 'Actions',
                //         orderable: false,
                //         render: function(data, type, full, meta) {
                //             return '\
                //             <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
                //                 <i class="la la-edit"></i>\
                //             </a>\
                //             <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                //                 <i class="la la-trash"></i>\
                //             </a>\
                //         ';
                //         },
                //     },
                // ],
            });
        });

    </script>
<?= $this->endSection()?>