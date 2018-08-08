<?php 

function detalhesPost(){
	$id = $_POST['id'];
	$detalhes = get_post( $id );

	if ($detalhes) {
		$post = [
			'titulo' => $detalhes->post_title,
			'conteudo' => wpautop( $detalhes->post_content )
		];
		wp_send_json_success( $post );
	}else{
		$resposta = [ 
			'msg' => 'Não encontramos o conteúdo do post'
		];
		wp_send_json_error( $resposta );
	}
	exit;
}

add_action( 'wp_ajax_detalhesPost', 'detalhesPost');
add_action( 'wp_ajax_nopriv_detalhesPost', 'detalhesPost');