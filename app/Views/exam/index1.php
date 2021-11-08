<?= $this->extend('layout/main') ?>

<?= $this->section('head') ?>

    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/dashboard.css') ?>">     
    <script type="text/javascript" src="<?= base_url('/assets/js/calendario.js') ?>"></script>    

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
                <li class="breadcrumb-item active" aria-current="page">LMS</li>
              </ol>
            </nav>

            <div class="container-fluid p-0">
              <div class="row">
                <div class="col-12">
                  <!-- card box -->
                  <div class="text-left shadow">
                      <div class="card-style card">
                        <div class="card-header">
                          <span class="name">Exams List</span>
                        </div>
                        <div class="card-body">
                          <div class="card-text">
                            <div class="row g-3 align-items-center color-main">
                              <div class="col-auto form-left">
                                <label for="filtro_curso" class="col-form-label">Buscar exámenes:</label>
                              </div>
                              <div class="col-4 form-right">
                                <input type="text" class="form-control" id="filtro_curso" placeholder="exámenes" />
                              </div>
                            </div>
                        </div>
                        </div>
                      </div>
                      <div class="row mx-0 bg-white">
                        <?php foreach ($exam_list as $key) { ?>
                          <div class="col-12 col-md-6 col-lg-4 col-xl-3 curso" data-search="<?php echo $key->id; ?>">
                            <a href="<?php echo base_url('/exam/detail?id='.$key->id); ?>" style="text-decoration: none;color: #212529;">
                            <div class="card my-2 mx-1" >
                              <div class="row no-gutters">
                                <div class="col-4">
                                  <img src="<?php echo base_url('/assets/img/curso.png')?>" >
                                </div>
                                <div class="col-8">
                                  <div class="card-body">
                                    <b class="card-text"><?= $key->title; ?></b><br>
                                    <b class="card-text"><?= $key->content; ?></b>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </a>
                          </div>
                        <?php } ?>
                      </div>
                    </div> 
                  </div>
                </div>
              <div>
            </div>
          </section>
        </main>
  </div>

<?= $this->endSection()?>