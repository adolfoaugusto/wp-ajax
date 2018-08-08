<?php 

function curtirPostToggle(){
	$postID = $_POST['id'];
	$tipo = $_POST['tipo'];

	$likes = get_post_meta($postID, 'likes', true );

	if ($tipo == 'like') {
		# +1
		update_post_meta( $postID, 'likes', $likes +1, $likes );
	}else{
		# -1
		update_post_meta( $postID, 'likes', $likes -1, $likes );
	}
	$likes = get_post_meta($postID, 'likes', true );
	echo $likes;

	exit;
}

add_action( 'wp_ajax_curtirPostToggle', 'curtirPostToggle');
add_action( 'wp_ajax_nopriv_curtirPostToggle', 'curtirPostToggle');