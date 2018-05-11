<?php

/**********************************
* variavéis globais
***********************************/
// assets folder
define('CSS_FOLDER', get_template_directory_uri().'/_assets/_css');
define('JS_FOLDER', get_template_directory_uri().'/_assets/_js');
$ajax_path = get_template_directory() . '/_ajax/';

/**********************************
* INCLUDES
***********************************/
require_once($ajax_path.'listar-posts.php');
require_once($ajax_path.'datalhes-post.php');
require_once($ajax_path.'curtir-post-toggle.php');

require_once('_inc/limpar-codigo.php');

/**********************************
* ASSETS
***********************************/
function app_scripts() {
	// versão
	$versao 	= rand(0,999);

	// jQuery
	wp_enqueue_script('jquery');

	// bootstrap
	wp_enqueue_script( 'popper', JS_FOLDER . '/popper.min.js', null, 1, true );
	wp_enqueue_script( 'bootstrap', JS_FOLDER . '/bootstrap.js', null, 1, true );
	wp_enqueue_style( 'bootstrap', CSS_FOLDER . '/bootstrap.css', 1, 1, 'all' );
	// tema
	wp_enqueue_style( 'theme', get_stylesheet_uri(), 1, $versao, 'all' );
	//app js
	wp_enqueue_script( 'app', JS_FOLDER . '/app.js', null, $versao, true );

	$wpVars=[
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	];
	wp_localize_script( 'app', 'wp', $wpVars);

}

add_action("wp_enqueue_scripts", "app_scripts");