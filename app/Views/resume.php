<?= $this->extend('layout/main') ?>

<?= $this->section('head') ?>

    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/dashboard.css') ?>">    

<?= $this->endSection()?>

<?= $this->section('title') ?>

    Dashboard

<?= $this->endSection()?>

<?= $this->section('body') ?>

    <div id="main-wrap" class="container-fluid p-0">

        <?= $this->include('layout/sidebar') ?>

        <main class="main">              

            <div id="main-right" class="col-md-9 ms-sm-auto col-lg-10">

              <?= $this->include('layout/top-bar') ?>

              <?= $this->include('layout/top-menu') ?>

              <section class="px-md-4 bg-light">
                  
                  <div class="container-fluid p-0">
                    <div class="row">
                      <div class="col-12">
                        
                        <!-- card box -->
                        <div class="card-style card text-left shadow">
                            <div class="card-header">
                              <span class="name">Notificaciones</span>
                            </div>
                            <div class="card-body">
                              <div class="card-text">
                                  
                                  <div class="row g-3 align-items-center color-main">
                                    <div class="col-auto form-left">
                                      <label for="select-degree" class="col-form-label">Grado</label>
                                    </div>
                                    <div class="col-auto form-right">
                                      <select class="form-select" id="select-degree">
                                        <option>Secundaria 1 - A</option>
                                      </select>
                                    </div>
                                    <div class="col-auto form-left">
                                      <label for="select-period" class="col-form-label">Periodo</label>
                                    </div>
                                    <div class="col-auto form-right">
                                      <select class="form-select" id="select-period">
                                        <option>1 Bimestre</option>
                                      </select>
                                    </div>
                                    <div class="col-auto">
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Todos</label>
                                      </div>
                                    </div>
                                    <div class="col-auto">
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Leído</label>
                                      </div>
                                    </div>
                                    <div class="col-auto">
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                        <label class="form-check-label" for="inlineRadio3">No leído</label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              
                              <div class="table-style table-responsive-xl mt-3">
                                <table id="grid-notifications" class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col"><span class="ps-4">Fecha</span></th>
                                        <th scope="col">Módulo</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Leer</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php for ($i=0; $i < 5; $i++) { ?>
                                        <tr>
                                          <td><span>20-07-2021</span></td>
                                          <td><span><b>Secundaria - 1 - A - Educación para el trabajo</b></span></td>
                                          <td><span><b>Envío de tarea inglés</b></span></td>
                                          <td><a href="#"><img src="<?= base_url('/assets/img/top/leer.svg')?>" width="32"></a></td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                </table>
                              </div>

                            </div>
                        </div>
                        <!-- end card box -->
                      </div>
                    </div>
                  </div>
              </section>

            </div>
        </main>
    </div>

<?= $this->endSection()?>