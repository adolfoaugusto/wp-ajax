<?php 
function listarPosts(){ 
	$page = $_POST['page'];
	$slug = $_POST['slug'];
	$search = $_POST['search'];
	$args = [
		'post_type'			=> 'post',
		'posts_per_page'	=> 2,
		'paged'				=> ($page)? $page :1,
		'category_name' 	=> $slug,
		's' 				=> $search
	];
	$posts = new WP_Query($args);
	$total_pages = $posts->max_num_pages;
	if( $posts->have_posts() ){		
		$itens = [];
		while($posts->have_posts()) : $posts->the_post();			
			$likes = get_post_meta(get_the_ID(), 'likes', true );
			$item = [
				'ID'		=> get_the_ID(),
				'titulo'	=> get_the_title(),
				'resumo'	=> get_the_excerpt(),
				'likes'		=> $likes
			];
			array_push($itens, $item);
		endwhile;
		$resposta = [
			'msg' => 'varios posts foram encontrados..',
			'pages' => $total_pages,
			'page' => $page,
			'posts' => $itens
		];
		wp_send_json_success( $resposta );
	}else{
		$resposta = [
			'msg' => 'Nenhum post encontrado!..',
		];
		wp_send_json_error( $resposta);
	}
}

add_action( 'wp_ajax_listarPosts', 'listarPosts');
add_action( 'wp_ajax_nopriv_listarPosts', 'listarPosts');