<?php $objPermOpc 		= 	new permisos(); ?>

<?php if ($objPermOpc->tienePermiso(900)) { ?>

<body topmargin="0" leftmargin="0">
	<div class="contenidos" align="center" id="contenidos" style="z-index: 100">
		<iframe src="modules/AccountingSys/index.php" scrolling="auto" name="contenido" id="contenido" frameborder="0" width="100%" height="800px"></iframe>
	</div>
</body>

<?php }else{ get_noPermission(); }?>