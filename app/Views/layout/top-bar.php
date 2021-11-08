<header class="main-navbar navbar navbar-dark sticky-top bg-main flex-md-nowrap">
    <div class="navbar-nav navbar-left">
      <div class="main-right-navbar d-flex text-muted pt-0">
        <div class="item-menu">
          <a href="#" class="toggle-bar trans text-decoration-none inline-menu"><span class="btn-navbar-toggle btn-icon"></span>  <span id="title-selected-module" class="title-main text-white"><?php // begin text
          foreach ($user_menu as $key => $row) { 
            if( $row->m_modulo == '00' && $row->m_codigo==$ruta[1]) {
               echo $row->m_nombre;
               break;
            }
          } // end text ?></span></a>
        </div>
      </div>
    </div>

    <div class="navbar-nav navbar-right">

      <div class="main-right-navbar d-flex text-muted pt-0">
        <div class="item-menu">
        <a href="#" class="trans text-decoration-none inline-menu dropdown-toggle calendar-ico-left" id="ddlPeriod" data-bs-toggle="dropdown" aria-expanded="false"><?php 
        echo ( session('speriodo') == '' ? date('Y') : session('speriodo') );
        ?></a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="ddlPeriod">
            <?php foreach ($list_periods as $key => $value) { // list periods ?>
                <li><a class="dropdown-item selectable_period <?php 
                // is selected
                echo (session('speriodo') == $value->cfg_periodo ? 'active' : '');
                ?>" href="javascript:;" data-id="<?php echo $value->cfg_vicente?>"><?php echo $value->cfg_periodo?></a></li>
            <?php } // end periods ?>
          </ul>
        </div>
        <?php  
        // set avatar-user
        //$avatar = base_url('/recursos/2021/institucion').'/'.$general_logo;
        $avatar = $general_logo;
        // if photo
        if( file_exists(APPPATH.'../public/recursos/2021/personal/'.$user_info->p_codigo.'.jpg') ) {
          $avatar = base_url('/recursos/2021/personal/'.$user_info->p_codigo.'.jpg');
        } // end photo
        ?>
        <div class="item-menu">
          <a href="#" class="trans text-decoration-none inline-menu dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false"><img class="profile-photo" src="<?= $avatar?>" alt="Usuario"><span class="username hidden-xl"><?= $user_info->fullname?></span>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><a class="dropdown-item" href="#">Mi perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">Cerrar Sesión</a></li>
          </ul>
        </div>
        <?php /*<div class="display-xl item-menu">
          <a href="#" id="btn-menu-mobile" class="trans text-decoration-none inline-menu">
            <span class="btn-navbar-toggle btn-icon"></span>
          </a>
        </div> */?>
      </div>

    </div>
</header>