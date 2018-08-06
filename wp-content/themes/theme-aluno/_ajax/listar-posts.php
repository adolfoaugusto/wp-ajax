<?php 

function listarPosts(){ 
	$page = $_GET['page'];
	$slug = $_GET['slug'];
	$search = $_GET['search'];

	$args = [
		'post_type'=>'post',
		'posts_per_page'=>4,
		'paged'=>($page)? $page :1,
		'category_name' => $slug,
		's' => $search
	];

	$posts = new WP_Query($args);
	$total_pages = $posts->max_num_pages;

	if( $posts->have_posts() ): ?>	
	<!-- item -->
	<div class="itens">
		<?php while($posts->have_posts()): $posts->the_post(); ?>
		<div class="item" data-id="<?php the_ID(); ?>">
			<div class="card">
				<div class="card-body">
					<h4><?php the_title(); ?></h4>
					<?php the_excerpt(); ?>
				</div>
				<div class="card-footer text-right">
					<button type="button" class="btn btn-sm btn-primary btn-detalhes">Leia mais</button>
					<button type="button" class="btn btn-sm btn-info btn-curtir"><span class="text">Gostei</span> <span class="badge badge-light">0</span></button>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
	<!-- paginacao -->
	<?php if ($total_pages > 0): ?>
		<section class="paginacao">
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<?php for ($i=1; $i <= $total_pages; $i++) { ?>
					<li class="page-item <?php echo ($i==$page)? 'active' : ''; ?>"><span class="page-link"><?php echo $i; ?></a></li>
					<?php } ?>
				</ul>
			</nav>
		</section>
	<?php endif ?>
	<!-- fim paginacao -->
	<!-- fim item -->
	<?php else: ?>
		<div class="alert alert-danger text-center">
			<h3>Nenhum post encontrado</h3>
		</div>
	<?php endif;

	exit;
}

add_action( 'wp_ajax_listarPosts', 'listarPosts');
add_action( 'wp_ajax_nopriv_listarPosts', 'listarPosts');