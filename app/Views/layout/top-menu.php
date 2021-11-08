<div class="top-btns d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 border-bottom shadow px-2">
    <div class="menu-auto">
      <div class="scrolly-mob row text-center">
        <div class="main-top-menu d-inline">
          <?php if( $user_top_menu->btn_inicio_link != '' && $user_top_menu->btn_inicio_icon != '') { // begin ?>
          <a href="<?php echo $user_top_menu->btn_inicio_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_inicio_icon)?>" width="37px"><span class="d-block">Inicio</span>
          </a>
          <?php } // end ?>
          <?php if( $user_top_menu->btn_calendario_link != '' && $user_top_menu->btn_calendario_icon != '') { // begin ?>
          <a href="<?php echo $user_top_menu->btn_calendario_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_calendario_icon)?>" width="37px"><span class="d-block">Calendario</span>
          </a>
          <?php } // end ?>
          <?php if( $user_top_menu->btn_mensajeria_link != '' && $user_top_menu->btn_mensajeria_icon != '') { // begin ?>
          <a href="<?php echo $user_top_menu->btn_mensajeria_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_mensajeria_icon)?>" width="37px"><span class="d-block">Mensajería</span>
          </a>
          <?php } // end ?>
          <?php if( $user_top_menu->btn_cursos_link != '' && $user_top_menu->btn_cursos_icon != '') { // begin ?>
          <a href="<?php echo $user_top_menu->btn_cursos_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_cursos_icon)?>" width="37px"><span class="d-block">Cursos</span>
          </a>
          <?php } // end ?>
          <?php if( $user_top_menu->btn_comunicados_link != '' && $user_top_menu->btn_comunicados_icon != '') { // begin ?>
          <a href="<?php echo $user_top_menu->btn_comunicados_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_comunicados_icon)?>" width="37px"><span class="d-block">Comunicados</span>
          </a>
          <?php } // end ?>
          <?php if( $user_top_menu->btn_asistencia_link != '' ) { // begin ?>
          <a href="<?php echo $user_top_menu->btn_asistencia_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_asistencia_icon)?>" width="37px"><span class="d-block">Asistencias</span>
          </a>
          <?php } // end ?>
          <?php if( $user_top_menu->btn_notificacion_link != '' && $user_top_menu->btn_notificacion_icon != '') { // begin ?>
          <a href="<?php echo $user_top_menu->btn_notificacion_link?>" class="btn-menu trans">
            <img src="<?= base_url('/assets/img/top/'.$user_top_menu->btn_notificacion_icon)?>" width="37px"><span class="d-block">Notificaciones</span>
          </a>
          <?php } // end ?>
        </div>
      </div>
    </div>
</div>