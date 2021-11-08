<!doctype html>
<html lang="es">
<head>
	<!--  head -->
	<?= $this->include("partials/head")?>
	<?= $this->renderSection('head')?>	
	<title>SIE-NET</title>
</head>
<body class="overflow-x">
	<!--  body -->
	<?php echo $this->renderSection('body')?>
	<!--  defer -->
	<?= $this->include("partials/defer")?>
	<?= $this->renderSection('defer')?>
</body>
</html>