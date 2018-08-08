<?php 
	$categorias = get_terms( 'category');
 ?>
<ul class="list-group">
	<li class="list-group-item active" data-slug="">Todos</li>
	
	<?php if ( !empty($categorias) && !is_wp_error( $categorias ) ): ?>		
		<?php foreach ($categorias as $categoria) { ?>
			<li class="list-group-item" data-slug="<?php echo $categoria->slug; ?>"><?php echo $categoria->name; ?></li>
		<?php } ?>		
	<?php endif ?>
	
</ul>