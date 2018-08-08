<?php 

function detalhesPost(){
	get_template_part( '_parts/detalhes' );
	exit;
}

add_action( 'wp_ajax_detalhesPost', 'detalhesPost');
add_action( 'wp_ajax_nopriv_detalhesPost', 'detalhesPost');