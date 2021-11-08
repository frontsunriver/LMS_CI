<div>
		<!--<?= print_r($secc); ?>-->
	<div class="border-bottom row p-2" style="font-weight: bold;">
		<div class="col-1"></div>
		<div class="col-3">Nemo</div>
		<div class="col-4">Salon</div>
		<div class="col-4">Curso</div>
	</div>
	<?php foreach ($cursos as $key){ 
		$code="";
		$code2="";
		$nemo="";
		$cod="";
		$secciones=explode(";", $secc);
		if($curso['nemo']==$key->nemo && $curso['cod']==$key->cursocod){
			$code=" checked disabled ";
		}
		foreach ($secciones as $seccion){
			$nemo=explode("|",$seccion)[0];
			$cod=explode("|",$seccion)[1];
			if($nemo==$key->nemo && $cod==$key->cursocod){
				$code2=" checked ";
				break;
			}
		}
		?>
		<!-- <?= $nemo." ".$key->nemo.":".$cod." ".$key->cursocod; ?>-->
		<div class="border-bottom row p-2">
			<div class="col-1">
				<input type="checkbox" class="form-check-input <?= ($code)?"":"seccion_selected"; ?>" <?= $code; ?> <?= $code2; ?> data-info="<?= $key->nemo."|".$key->cursocod; ?>" data-title="<?= $key->nemodes."|".$key->cursonom; ?>">
			</div>
			<div class="col-3"><?= $key->nemo; ?></div>
			<div class="col-4"><?= $key->nemodes; ?></div>
			<div class="col-4"><?= $key->cursonom; ?></div>
		</div>
	<?php } ?>
	
</div>