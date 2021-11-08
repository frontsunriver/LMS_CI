<div id="sidebar" class="sidebar">
  <nav id="sidebarMenu" class="pt-0 col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    
    <div id="desktop-expand" class="position-sticky pt-3">
      <div class="profile-user text-center">
        <img src="<?= base_url('/assets/img/logo.png')?>" alt="logo" width="120px" class="mb-1 d-inline logo">
        <span class="d-block username text-white"><?= $user_info->fullname?></span>
        <span class="d-block role text-white"><?= $user_info->profile?></span>
        <select class="toggle-menu text-white mt-2 mb-2" id="select-menu">
          <?php foreach ($user_menu as $key => $row) { 
                  if( $row->m_modulo == '00' ) { ?>
                    <option value="<?php echo $row->m_codigo?>" <?= ($row->m_codigo==$ruta[1])?"selected":"" ?>><?php echo $row->m_nombre?></option>
          <?php } } // end selector ?>
        </select>
      </div>

      <ul id="vertical-menu" class="nav nav-style list-unstyled ps-0 flex-column <?= ($ruta[1])?"":'hide-dropdown"' ?>">
        <!--<?= $ruta[1] ?>-->
          <?php foreach ($user_menu as $key => $row) { 

                if( $row->m_modulo != '00' && $row->m_tipo == 'D' ) { ?>

                  <li class="men_item men_<?php echo $row->m_modulo?>" <?= ($row->m_modulo==$ruta[1])?"":'style="display: none"' ?>>
                    <a class="btn btn-toggle <?= ($row->m_codigo==$ruta[2])?'':'collapsed' ?> w-100" data-bs-toggle="collapse" data-bs-target="#m_<?php echo $row->m_codigo?>" aria-expanded="<?= ($row->m_codigo==$ruta[2])?'true':'false' ?>">
                      <img src="<?php echo base_url('/assets/img/left/'.$row->m_icono)?>" alt="btn" width="28px" class="icon"> <?php echo $row->m_nombre?>
                    </a>                    
                    <div class="collapse <?= ($row->m_codigo==$ruta[2])?'show':'' ?>" id="m_<?php echo $row->m_codigo?>">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <?php foreach ($user_menu as $key => $sub) { 
                                if( $sub->m_modulo != '00' 
                                  && $sub->m_tipo == 'I' 
                                  && $sub->m_menupad == $row->m_codigo ) { 
                                  ?>
                                  <li><a href="#" class="sub-item w-100 m-0"><?php echo $sub->m_nombre?></a></li>
                        <?php } } // end subitem ?>
                      </ul>
                    </div>
                  </li>

                <?php } // parent item ?>

              <?php if( $row->m_modulo != '00' && $row->m_tipo == 'O' ) { ?>
                  <li class="men_item men_<?php echo $row->m_modulo?>"  <?= ($row->m_modulo==$ruta[1])?"":'style="display: none"' ?>>
                    <a class="btn btn-toggle btn-single collapsed w-100" href="<?= base_url('/'.$row->enlace); ?>">
                      <img src="<?php echo base_url('/assets/img/left/'.$row->m_icono)?>" alt="btn" width="28px" class="icon"> <?php echo $row->m_nombre?>
                    </a>
                  </li>

              <?php } // unique item ?>
        <?php } // end menu ?>
        
      </ul>
    </div>

    <div id="desktop-toggle" class="position-sticky">
      <ul class="list-menu">
        <li><a href="#" class="toggle-bar item-bar item-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Navegación"><img src="<?= base_url('/assets/img/left/droopmenu.svg')?>" alt="btn" width="28px" class="btn-icon"></a></li>
        <?php foreach ($user_menu as $key => $row) { 

                if( $row->m_modulo != '00' && $row->m_tipo == 'D' ) { ?>

                  <li><a href="#" class="item-bar men_item men_<?php echo $row->m_modulo?>" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $row->m_nombre?>" style="display: none;"><img src="<?php echo base_url('/assets/img/left/'.$row->m_icono)?>" alt="btn" width="28px" class="btn-icon"></a></li>                  

                <?php } // parent item ?>

              <?php if( $row->m_modulo != '00' && $row->m_tipo == 'O' ) { ?>
                  
                  <li><a href="#" class="item-bar men_item men_<?php echo $row->m_modulo?>" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $row->m_nombre?>" style="display: none;"><img src="<?php echo base_url('/assets/img/left/'.$row->m_icono)?>" alt="btn" width="28px" class="btn-icon"></a></li>

              <?php } // unique item ?>
        <?php } // end menu ?>
            
      </ul>
    </div>

  </nav>
</div>