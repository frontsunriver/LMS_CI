<?= $this->extend('layout/main') ?>

<?= $this->section('head') ?>
    
    <script src="https://cdn.tiny.cloud/1/51dzbcm0r82iy8a2yrit963nkv27b2lm3qhz7fftmvxn7glv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/dashboard.css') ?>">   
    <script type="text/javascript" src="<?= base_url('/assets/js/calendario.js') ?>"></script> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

<?= $this->endSection()?>

<?= $this->section('title') ?>

    Calendario

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
                      <li class="breadcrumb-item"><a href="<?php echo base_url('/calendario/'); ?>">LMS</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $nombre_salon." - ".$nombre_curso; ?></li>
                    </ol>
                  </nav>

                  <div class="container-fluid p-0">
                    <div class="row">
                      <div class="col-12">
                        
                        <!-- <?php print_r($curso); ?> -->

                        <!-- card box -->
                        <div class="text-left shadow">
                            <div class="card-style card">
                              <div class="card-header">
                                <div class="name p-1" style="display: inline-block;">Curso: <?= $nombre_salon." - ".$nombre_curso; ?></div>
                                <button type="button" class=" btn float-end py-1 px-2 btn-success me-2"><b><a style="color: white;text-decoration: none;" href="<?= base_url('calendario/mes/'.$curso['nemo'].'/'.$curso['cod']); ?>">Calendario</a></b></button>
                                <div class="dropdown float-end">
                                  <button class="btn btn-success dropdown-toggle py-1 px-2 me-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <b>Agregar</b>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php foreach ($combos as $combo): ?>
                                      <li><a class="dropdown-item combo" href="#" data-id="<?= $combo->t_id; ?>" data-nemo="<?= $curso['nemo']; ?>" data-cod="<?= $curso['cod']; ?>"><?= $combo->t_descripcion; ?></a></li>
                                    <?php endforeach ?>
                                  </ul>
                                </div>

                              </div>
                              <div class="card-body">
                                
                                <?php 
                                  $hoy = date("Y-m-d");
                                  foreach($periodos as $periodo) { 
                                  $i=$periodo->bimestre;
                                  $active=($hoy>=$periodo->fechai && $hoy<=$periodo->fechat)?true:false;
                                ?>
                          <div class="accordion mb-3" id="accordion">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading<?= $i; ?>">
                                <button class="accordion-button  <?= ($active!=true)?"collapsed":""; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="true" aria-controls="collapse<?= $i; ?>">
                                  <b class="pe-3">Bimestre <?= $i; ?>º </b>[Desde: <?= $periodo->fechai." - Hasta: ".$periodo->fechat; ?>
                                </button>
                              </h2>
                              <div id="collapse<?= $i; ?>" class="accordion-collapse collapse <?= ($active==true)?"show":""; ?>" aria-labelledby="heading<?= $i; ?>" data-bs-parent="#accordion">
                                <div class="accordion-body p-1">
                                  <?php foreach ($eventos as $evento){ 
                                    if($evento->t_fecha>=$periodo->fechai && $evento->t_fecha<=$periodo->fechat){
                                    ?>
                                    <div class="m-2 p-3 border rounded">
                                      <div class="row border-bottom">
                                        <div role="button" class="evento col-10" data-id="<?= $evento->t_idevento; ?>" data-nemo="<?= $curso['nemo']; ?>" data-cod="<?= $curso['cod']; ?>" data-titlemod="<?= ($evento->t_abreviatura." - ".$nombre_salon." - ".$nombre_curso." - ".$profesor->p_nomcomp); ?>">
                                          <div class="pb-2"><b style="color:#444877"><?= $nombre_salon." - ".$nombre_curso; ?></b> - <b style="color:#488438"><?= $profesor->p_nomcomp; ?></b> - <?= $evento->t_titulo; ?> - Publico una <b><?= $evento->t_abreviatura?></b><br>Para el <?=$evento->t_fecha?> - Creada el <?= $evento->t_fechacreacion; ?></div>
                                        </div>
                                        <div class="col-2 text-center">
                                          <img src="<?= base_url('/assets/img/'.(($evento->t_chkpublicado==1)?"visible.png":"hidden.png")); ?>" height="24px" style="display: inline-block;opacity: .8;">
                                          <button class="btn btn-success dropdown-toggle py-1 px-2 mx-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">opciones
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item edt-evt" href="#" data-id="<?= $evento->t_idevento; ?>" data-nemo="<?= $curso['nemo']; ?>" data-cod="<?= $curso['cod']; ?>" data-titlemod="<?= ($evento->t_abreviatura." - ".$nombre_salon." - ".$nombre_curso." - ".$profesor->p_nomcomp); ?>"><img src="<?= base_url("/assets/img/ico-editar.png")?>" height="16px" class="mx-1">Editar</a></li>
                                            <li><a class="dropdown-item del-evt" href="#" data-id="<?= $evento->t_idevento; ?>"><img src="<?= base_url("/assets/img/ico-eliminar.png")?>" height="16px" class="mx-1">Eliminar</a></li>
                                          </ul>
                                          
                                        </div>
                                      </div>
                                      <div class="bg-white p-2 mt-2 rounded"><?= html_entity_decode($evento->evento_descripcion,ENT_QUOTES); ?></div>
                                    </div>
                                    
                                  <?php }} ?>
                                </div>
                              </div>
                            </div>
                          </div>

                                <?php } ?>

                               </div>
                              </div>
                            <div class="row">

                              

                            </div>
                          </div> 

                        </div>
                          
                    </div>
                  </div>
              </section>

            </div>
        </main>
    </div>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 600px;">
    <div class="modal-content">
      <div class="modal-header px-3 py-2" style="background-color: #015aac;">
        <h6 class="modal-title" style="color: white;" id="ModalLabel">Modal title</h6>
        <button type="button" style="color:white;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-3 py-2">
        ...
      </div>
      <div class="modal-footer px-3 py-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary modal-save" style="display: none;" id="saveForm">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="ModalLabel2" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" style="max-width: 450px;">
    <div class="modal-content">
      <div class="modal-header px-3 py-2" style="background-color: #015aac;">
        <h6 class="modal-title" style="color: white;" id="ModalLabel2">Seleccion de secciones</h6>
      </div>
      <div class="modal-body px-3 py-2">
        
      </div>
      <div class="modal-footer px-3 py-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" href="#Modal" data-bs-toggle="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection()?>