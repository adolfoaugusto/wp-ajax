<?php 

function curtirPostToggle(){
	echo "post curtido";
	exit;
}

add_action( 'wp_ajax_curtirPostToggle', 'curtirPostToggle');
add_action( 'wp_ajax_nopriv_curtirPostToggle', 'curtirPostToggle');