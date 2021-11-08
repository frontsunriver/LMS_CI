<div class="row">
	<form id="formularioEvento" enctype="multipart/form-data" method="post">
	<input  name="id" value="<?= $id; ?>" type="hidden">
	<input  name="tipoid" value="<?= $comboId; ?>" type="hidden">
	<input  name="nemo" value="<?= $curso['nemo']; ?>" type="hidden" id="nemo">
	<input  name="cod" value="<?= $curso['cod']; ?>" type="hidden" id="cod">
	<input  name="secc" value="" type="hidden" id="secc">

	<div class="row mb-2">
		<div class="col-2">
			<label for="titulo" class="col-form-label">Titulo:</label>
		</div>
		<div class="col-10">
			<input type="text" id="titulo" name="titulo" class="form-control" required value="<?php echo($evento->t_titulo) ?>" <?= $mode ?>>
		</div>
	</div>
	
	<div class="row mb-2">
		<div class="col-2">
			<label for="fecha" class="col-form-label">Fecha:</label>
		</div>
		<div class="col-3">
			<input  name="txt_fecha" id="fecha" class="form-control" value="<?php echo($evento->t_fecha) ?>" <?= $mode ?>>
		</div>
		<div class="col-3">
			<label for="fecha" class="col-form-label">Fecha de creacion:</label>
		</div>
		<div class="col-4">
			<input  name="fecha_crea" class="form-control" value="<?php echo($evento->t_fechacreacion)?$evento->t_fechacreacion:$fecha_creacion; ?>" readonly>
		</div>
	</div>

	<div class="mb-2 pb-2 border-bottom">
		<label class="col-form-label">Descripcion</label>
		
		<textarea id="tinyhtml" style="width:100%;height:250px;" name="desc" ><?= trim($evento->t_descripcion); ?></textarea>
		
	</div>
	<?php if($evento->t_chkretorno==1 || !$mode){ ?>
	<div class="mb-2 pb-2 border-bottom">
		<div class="row">
			<div class="col-2">
				<label class="col-form-label form-check-label" for="retorno">Retorno:</label>
			</div>
			<div class="col-1">
				<div class="form-check form-switch">
					<input type="checkbox" class="p-2 form-check-input" name="retorno" style="margin-top: calc(.375rem + 3px);" id="retorno" role="switch" <?= ($evento->t_chkretorno==1)?'checked':''; ?> <?= $enable; ?>>
				</div>
			</div>
			<div class="col-2"></div>
			<div class="col-3">
				<label class="col-form-label">Fecha de entrega:</label>
			</div>
			<div class="col-4">
				<input class="form-control" name="fecha_entr" id="feed_fecha"  value="<?= ($evento->t_fecharetorno)?$evento->t_fecharetorno:$fecha; ?>" 
				<?= ($edit && $evento->t_chkretorno==1)?"":"readonly"; ?>>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="mb-2 pb-2 border-bottom">
		<div class="row">
			<div class="col-2">
				<label class="col-form-label form-check-label" for="posted">Publicado:</label>
			</div>
			<div class="col-1">
				<div class="form-check form-switch">
					<input type="checkbox" class="p-2 form-check-input" name="publicado" style="margin-top: calc(.375rem + 3px);" id="posted" role="switch" <?= ($evento->t_chkpublicado==1)?'checked':''; ?> <?= $enable; ?>>
				</div>
			</div>
		</div>
	</div>

	<div class="mb-2 pb-2">
		<div class="row border-bottom">
			<div class="col-3">
				<label class="col-form-label">Archivos adjuntos</label>
			</div>
			<?php if(!$mode && $evento->t_adjunto10==''){ ?>
			<div class="col-3" >
				<button type="button" class="btn btn-success p-2 py-1" id="file_b">Añadir</button>
			</div>
			<?php } ?>
		</div>
		<div class="row" id="file_l">
			
		</div>
		<div style="display: none;">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
			<input type="file" name="file[]" class="file_">
		</div>
		<div class="row">
			<?php if($edit){
				echo ($evento->t_adjunto01!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_0"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto01.'">'.$evento->t_adjunto01.'</a><input name="dfile_0" type="hidden" value="'.$evento->t_adjunto01.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(0)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto02!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_1"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto02.'">'.$evento->t_adjunto02.'</a><input name="dfile_1" type="hidden" value="'.$evento->t_adjunto02.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(1)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto03!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_2"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto03.'">'.$evento->t_adjunto03.'</a><input name="dfile_2" type="hidden" value="'.$evento->t_adjunto03.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(2)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto04!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_3"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto04.'">'.$evento->t_adjunto04.'</a><input name="dfile_3" type="hidden" value="'.$evento->t_adjunto04.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(3)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto05!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_4"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto05.'">'.$evento->t_adjunto05.'</a><input name="dfile_4" type="hidden" value="'.$evento->t_adjunto05.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(4)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto06!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_5"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto06.'">'.$evento->t_adjunto06.'</a><input name="dfile_5" type="hidden" value="'.$evento->t_adjunto06.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(5)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto07!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_6"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto07.'">'.$evento->t_adjunto07.'</a><input name="dfile_6" type="hidden" value="'.$evento->t_adjunto07.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(6)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto08!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_7"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto08.'">'.$evento->t_adjunto08.'</a><input name="dfile_7" type="hidden" value="'.$evento->t_adjunto08.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(7)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto09!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_8"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto09.'">'.$evento->t_adjunto09.'</a><input name="dfile_8" type="hidden" value="'.$evento->t_adjunto09.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(8)">Eliminar</button></div>':'';
				echo ($evento->t_adjunto10!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_9"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto10.'">'.$evento->t_adjunto10.'</a><input name="dfile_9" type="hidden" value="'.$evento->t_adjunto10.'"><button type="button" class="btn btn-danger p-0 px-2 ms-2" id="file_b" onclick="eliminarDFile(9)">Eliminar</button></div>':'';
			}else{
				echo ($evento->t_adjunto01!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_0"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto01.'">'.$evento->t_adjunto01.'</a><input name="dfile_0" type="hidden" value="'.$evento->t_adjunto01.'"></div>':'';
				echo ($evento->t_adjunto02!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_1"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto02.'">'.$evento->t_adjunto02.'</a><input name="dfile_1" type="hidden" value="'.$evento->t_adjunto02.'"></div>':'';
				echo ($evento->t_adjunto03!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_2"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto03.'">'.$evento->t_adjunto03.'</a><input name="dfile_2" type="hidden" value="'.$evento->t_adjunto03.'"></div>':'';
				echo ($evento->t_adjunto04!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_3"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto04.'">'.$evento->t_adjunto04.'</a><input name="dfile_3" type="hidden" value="'.$evento->t_adjunto04.'"></div>':'';
				echo ($evento->t_adjunto05!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_4"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto05.'">'.$evento->t_adjunto05.'</a><input name="dfile_4" type="hidden" value="'.$evento->t_adjunto05.'"></div>':'';
				echo ($evento->t_adjunto06!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_5"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto06.'">'.$evento->t_adjunto06.'</a><input name="dfile_5" type="hidden" value="'.$evento->t_adjunto06.'"></div>':'';
				echo ($evento->t_adjunto07!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_6"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto07.'">'.$evento->t_adjunto07.'</a><input name="dfile_6" type="hidden" value="'.$evento->t_adjunto07.'"></div>':'';
				echo ($evento->t_adjunto08!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_7"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto08.'">'.$evento->t_adjunto08.'</a><input name="dfile_7" type="hidden" value="'.$evento->t_adjunto08.'"></div>':'';
				echo ($evento->t_adjunto09!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_8"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto09.'">'.$evento->t_adjunto09.'</a><input name="dfile_8" type="hidden" value="'.$evento->t_adjunto09.'"></div>':'';
				echo ($evento->t_adjunto10!='')?'<div class="filest col-12 p-2 border-bottom ms-2" id="dfile_9"><img src="https://img.icons8.com/ios/12/000000/attach.png" style="vertical-align: middle;margin-right:4px;"><a target="_blank" href="'.$path."/".$evento->t_adjunto10.'">'.$evento->t_adjunto10.'</a><input name="dfile_9" type="hidden" value="'.$evento->t_adjunto10.'"></div>':'';
			}

			?>
		</div>
	</div>

	<div class="mb-2 pb-2 border-bottom">
		<div class="row">
			<div class="col-2">
				<label class="col-form-label">Orden</label>	
			</div>
			<div class="col-1">
				<input class="form-control" name="orden" value="<?=($evento->t_orden) ?>" <?= $mode; ?> >
			</div>
			<div class="col-9">
				
			</div>
			
			
		</div>
	</div>


	<div class="mb-2 pb-2">
		<div class="row">
			<div class="col-11">
				<label class="col-form-label">Dirigido a:</label><br>
				<div style="color: #1f25a5;font-size: 9pt;">
					<span><?= $nombre_salon." - ".$nombre_curso; ?></span><br>
					<div id="secciones">
					</div>
				</div>
			</div>
			<?php if(!$mode){ ?>
			<div class="col-1 p-1">
				<img src="<?= base_url('/assets/img/editar.png');?>" height="18px" id="secciones_btn"  data-codprof="<?= $cod_prof; ?>">
			</div>
			<?php } ?>
			
		</div>
	</div>
	</form>
</div>