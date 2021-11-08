<!doctype html>
<html lang="es">
  
    <?= $this->include('partials/head') ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/lib/toast/src/jquery.toast.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/lib/confirm/css/jquery-confirm.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style.css') ?>">    

    <title>SIE-NET</title>
  
  <body class="overflow-hidden page-login">
    <div id="fix-section" class="fixed-bottom inline-block rounded-start mb-5 fs-3 text-white title-bottom-area rounded-pill"><b>Intranet</b></div>    
    <div class="wallpaper wrapper">
    	<div class="row">
    		<div class="col-sm-8 d-none d-sm-block">
    			<div class="vh-100"></div>
    		</div>
    		<div class="col-sm-4 bg-login-form pos-relative content bg-login box-login vh-100">
                <section class="vertical-alg p-5">
                    <img src="<?php echo base_url('/assets/img/logo.png')?>" alt="logo" width="220px" class="mb-3 d-block img-center">
                    <h1 id="title-login" class="label-s mb-3 fs-5"><b>Ingresar</b></h1>
                    <!-- form -->
                    <?php echo form_open('', ['id' => 'form-login', 'autocomplete' => 'off', 'accept-charset' => 'utf-8']) ?>
                        <?php echo form_input(['type'  => 'hidden','name'  => csrf_token(),'id'    => 'token_nonce','value' => csrf_hash()])?>
                        <?php
                        // is data cookie
                        $checked = (get_cookie('remember_me', true) ? true : false);
                        if( $checked ) {
                            $cookie = (object) json_decode(get_cookie('remember_me'), true);
                            $cookie_user = $cookie->name_user;
                            $cookie_pass = $cookie->password_user;
                        } else {
                            $cookie_user = '';
                            $cookie_pass = '';
                        }
                        ?>
                        <div class="row g-3">
                            <div class="col-12 mb-1">
                                <div class="input-group has-validation csf-s">
                                    <?php echo form_input('name_user', @$cookie_user, ['placeholder'=> 'Usuario', 'class' => 'form-control', 'maxlength' => 8, 'autocomplete' => 'off'], 'text')?>
                                    <span class="input-group-text"><i class="bg-ico ico-user"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group has-validation csf-s">
                                    <?php echo form_password('password_user', @$cookie_pass, ['placeholder'=> 'Contraseña', 'class' => 'form-control', 'maxlength' => 12, 'autocomplete' => 'off'])?>
                                    <span class="input-group-text unlock-pass trans" role="button"><i class="bg-ico ico-pass"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mb-0">
                                <?php 
                                echo form_checkbox('remember_me', 'on', $checked, ['id'=> 'remember_me', 'class'=> 'form-check-input inline-block align-middle m-0 color-primary'])?>
                                <?php echo form_label('Recuerdame', 'remember_me', ['class'=> 'form-check-label inline-block align-middle label-s fw-normal'])?>
                            </div>
                            <div class="col-12 text-center">
                                <?php echo form_submit('', 'Acceder', ['id'=> 'btn-login-user', 'class' => 'btn btn-secondary d-inline px-5 trans'])?>
                            </div>
                        </div>
                    <?php echo form_close()?>
                    <!-- end form -->
                    <div class="text-center mt-4 mb-4 list-social">
                        <div class="d-inline"><a href="#"><img src="<?php echo base_url('/assets/img/icon/fb.png') ?>" width="37px" alt="Facebook"></a></div>
                        <div class="d-inline"><a href="#"><img src="<?php echo base_url('/assets/img/icon/twt.png') ?>" width="37px" alt="Twitter"></a></div>
                        <div class="d-inline"><a href="#"><img src="<?php echo base_url('/assets/img/icon/ig.png') ?>" width="37px" alt="Instagram"></a></div>
                    </div>
                    <img src="<?php echo base_url('/assets/img/logo2.png')?>" alt="logo2" width="145px" class="d-block img-center d-none d-sm-block">
                </section>
    		</div>
    	</div>
    </div>
    
    <?php /*<section id="notif-bar" class="d-hidden d-block fixed-bottom inline-block">
        <span class="align-middle"><img class="logo" src="<?php echo base_url('/assets/img/logo2.png')?>" alt="logo3" height="28px"></span>
        <span class="lright"><a href="#" class="label-s">Agregar sitio web a la pantalla principal</a> <a href="#" class="close">X</a></span>
    </section>*/ ?>
    <!-- defer -->
    <?= $this->include("partials/defer") ?>
    <!-- scripts -->    
    <script src="<?php echo base_url('assets/lib/toast/dist/jquery.toast.min.js')?>"></script>
    <script src="<?php echo base_url('assets/lib/sublimeSlideshow/jquery.sublimeSlideshow.js')?>"></script>
    <script src="<?php echo base_url('assets/lib/confirm/js/jquery-confirm.min.js')?>"></script>
    <!-- app -->
    <script src="<?php echo base_url('assets/script/jquery.user.login.js')?>"></script>
  </body>
</html>