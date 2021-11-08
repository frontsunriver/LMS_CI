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
                      <li class="breadcrumb-item"><a href="<?php echo base_url('/calendario/curso/'.$curso['nemo'].'/'.$curso['cod']); ?>"><?= $nombre_salon." - ".$nombre_curso; ?></a></li>
                      <li class="breadcrumb-item active" aria-current="page">Calendario</li>
                    </ol>
                  </nav>

                  <div class="container-fluid p-0">
                    <div class="row">
                      <div class="col-12">
                        
                        <!-- card box -->
                        <div class="text-left shadow">
                            <div class="card-style card">
                              <div class="card-header">
                                <span class="name align-middle">Calendario</span>
                              </div>
                              <div class="text-center p-2">
                                <a style="color: white;text-decoration: none;" href="<?= base_url('calendario/mes/'.$curso['nemo'].'/'.$curso['cod'].'/'.$mes_ant.'/'.$ano_ant); ?>"><button class="btn btn-success py-1 px-2 float-start" type="button">Anterior</button></a>
                                <span class="name align-middle"><?= $meses[$mes]." ".$ano; ?></span>
                                <a style="color: white;text-decoration: none;" href="<?= base_url('calendario/mes/'.$curso['nemo'].'/'.$curso['cod'].'/'.$mes_sig.'/'.$ano_sig); ?>"><button class="btn btn-success py-1 px-2 float-end" type="button">Siguiente</button></a>
                              </div>
                              <div class="row m-0 p-0">
                                <div class="cs-7 border border-start-0"><b>Domingo</b></div>
                                <div class="cs-7 border border-start-0"><b>Lunes</b></div>
                                <div class="cs-7 border border-start-0"><b>Martes</b></div>
                                <div class="cs-7 border border-start-0"><b>Miercoles</b></div>
                                <div class="cs-7 border border-start-0"><b>Jueves</b></div>
                                <div class="cs-7 border border-start-0"><b>Viernes</b></div>
                                <div class="cs-7 border border-start-0"><b>Sabado</b></div>
                                <div style="clear:both;"></div>
                              </div>
                              <?php for ($i=0; $i < 6; $i++) { 
                                ?>
                              <div class="row m-0 p-0">  
                              <?php for ($j=0; $j<7; $j++){ 
                                if($primer<=(($i*7+$j)+1)){$inicio++;}
                                if($ultimo+$primer<=(($i*7+$j)+1)){$inicio=null;}
                                $cnt=0;
                                foreach ($eventos as $evento) {
                                  if(substr($evento->t_fecha, -2)==$inicio){
                                    $cnt++;
                                  }
                                }
                                $eventos_html="";
                                $movil_html="";
                                $display="";
                                if($cnt>=4){
                                  $eventos_html.="<div class='hom_f'><button class='vme btn btn-primary p-0 px-1 mb-1 w-100' style='text-align:left' type='button' data-ref='day$inicio'";
                                  $eventos_html.=">Ver eventos";
                                  $eventos_html.="</button></div>";
                                  $display=' style="display:none"';
                                }
                                if($cnt>0){
                                  $movil_html.="<div class='hom2_f'><button class='vme btn btn-primary p-0 px-1 mb-1 w-100' style='text-align:left' type='button' data-ref='day$inicio'";
                                  $movil_html.=">$cnt";
                                  $movil_html.="</button></div>";
                                }
                                $evento_html="<div class='hom_f'>";
                                $evento_html.="<div id='day$inicio' $display>";
                                foreach ($eventos as $evento) {
                                  if(substr($evento->t_fecha, -2)==$inicio){
                                    $evento_html.="<div><button class='evento btn btn-primary p-0 px-1 mb-1 w-100' style='text-align:left' type='button' ";
                                    $evento_html.="data-id='".$evento->t_idevento."' data-nemo='".$curso['nemo']."' data-cod='".$curso['cod']."' ";
                                    $evento_html.="data-titlemod='".$evento->t_abreviatura." - ".$nombre_salon." - ".$nombre_curso." - ".$profesor->p_nomcomp."' ";
                                    $evento_html.=">$evento->t_titulo";
                                    $evento_html.="</button></div>";
                                  }
                                }
                                $evento_html.="</div>";
                                $evento_html.="</div>";
                                
                                ?>
                                <div class="cws-7 cs-7 border border-top-0 border-start-0">
                                  <div><?= $inicio; ?></div>
                                  <?= $evento_html; ?>
                                  <?= $movil_html; ?>
                                  <?= $eventos_html; ?>
                                </div>
                              <?php 
                                
                                }
                              ?>
                              </div>
                              <?php 
                                if($ultimo+$primer<=(($i*7+$j)+1)){break;}
                                }
                              ?>
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

<div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel3" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" style="max-width: 450px;">
    <div class="modal-content">
      <div class="modal-header px-3 py-2" style="background-color: #015aac;">
        <h6 class="modal-title" style="color: white;" id="ModalLabel3">Eventos</h6>
      </div>
      <div class="modal-body px-3 py-2 fix_p">
        
      </div>
      <div class="modal-footer px-3 py-2">
        <button type="button" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection()?>