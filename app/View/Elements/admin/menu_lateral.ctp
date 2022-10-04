<?php 
	$menu = $this->fetch('menu');
	
	if($menu) {
?>
	<div class="span3">
		<div class="well sidebar-nav">
			<ul class="nav nav-list">	
				<?php echo $menu ?>
			</ul>
		</div>
		<a class="well btn-esconder" href="javascript: void(0)"><?php echo $this->Html->icon('chevron-left') ?> Esconder </a>
		<a class="well btn-mostrar" href="javascript: void(0)"><?php echo $this->Html->icon('chevron-right') ?> Mostrar menu </a>		
	</div>
<?php 
	}
?>