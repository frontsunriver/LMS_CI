<?= $this->extend('layout/main') ?>

<?= $this->section('head') ?>
    
    <script src="https://cdn.tiny.cloud/1/51dzbcm0r82iy8a2yrit963nkv27b2lm3qhz7fftmvxn7glv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/dashboard.css') ?>">   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css"/>
    <style>

        .bi{
            font-size: 20px;
            color: darkorchid;
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
                                        <a type="button" href="<?php echo base_url('/exam/createExam/'.$nemodes['nemo'].'/'.$cursonom['cod']); ?>" class=" btn float-end py-1 px-2 btn-success me-2">create exam</a></button>
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
                                            <tfoot>
                                                <tr>
                                                    <th>Exam Name</th>
                                                    <th>Number of Questions</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
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
    <script type="text/javascript" src="<?= base_url('/assets/js/exam.js') ?>"></script> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );
            $("#example").DataTable({
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
                    url: "/exam/getExamList",
                    type: 'POST',
                    "data": {
                        "nemo": <?=$nemodes['nemo']?>,
                        "cod": <?=$cursonom['cod']?>,
                    }
                },
                columns: [
                {data: 'title' },
                {data:'quizeCount' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '\
                            <a href="/exam/editExam/'+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
                                <i class="bi bi-gear"></i>\
                            </a>\
                            <a href="javascript:showHideExam('+row.id+');" class="btn btn-sm btn-clean btn-icon" title="show exam" id="show_exam'+row.id+'">\
                                <i class="bi '+row.icon+'"><input type="hidden" id="showFlag" value="'+row.toggle+'"></i>\
                            </a>\
                            <a href="javascript:" class="btn btn-sm btn-clean btn-icon" title="Download">\
                                <i class="bi bi-download"></i>\
                            </a>\
                            <a href="javascript:" class="btn btn-sm btn-clean btn-icon" title="Result">\
                                <i class="bi bi-file-earmark-text-fill"></i>\
                            </a>\
                            <a href="javascript:deleteExam('+row.id+');" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                                <i class="bi bi-trash"></i>\
                            </a>\
                        ';
                    }
                }],
            });
        });

    </script>
<?= $this->endSection()?>

