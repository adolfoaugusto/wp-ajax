jQuery(function($){
	/* listar posts 
		(x)função php
		(x)admin-ajax.php
		( )função js
	**/

	var page = 1;
	var slug = $('.list-group-item.active').data('slug');
	var listarPostsAjax = function(page){
		$.ajax({
			url: wp.ajaxurl,
			type: 'GET',
			data: {
				action: 'listarPosts',
				page: page,
				slug: slug
			},
			beforeSend:function(){
				$('.progress').removeClass('d-none');
			}
		})
		.done(function(resposta) {
			$('.progress').addClass('d-none');
			$('#lista-posts').html(resposta); 
		})
		.fail(function(){
			console.log('Ops, Algo deu errado');
		})
	}
	listarPostsAjax(page, slug);

	//ação do botão da categoria (list-group-item)
	$('.list-group-item').on('click', function() {
		slug =$(this).data('slug');
		listarPostsAjax(1, slug);
		$('.list-group-item').removeClass('active');
		$(this).addClass('active');
	});

	//ação do botão da paginação (list-group-item)
	$('body').on('click', '.page-item', function() {
		page = $(this).find('span').text();
		listarPostsAjax(page, slug);
		$('.page-item').removeClass('active');
		$(this).addClass('active');
	});

	//ação do botão limpar busca (#btn-limpar)
	$('#btn-limpar').on('click', function() {
		listarPostsAjax(page);
		$(this).addClass('d-none');
		$('#campo-busca').val('');
		// $('#btn-limpar')
	});

	//ação qndo digitar na busca (#btn-limpar)
	$('#campo-busca').on('keyup', function() {
		listarPostsAjax(page);
		$('#btn-limpar').removeClass('d-none');
		// $('#btn-limpar')
	});
	

	/* detalhe post **/
	var detalhesPostAjax = function(){
		$.ajax({
			url: wp.ajaxurl,
			type: 'GET',
			data: {
				action: 'detalhesPost'
			},
			beforeSend:function(){
				$('.progress').removeClass('d-none');
			}
		})
		.done(function(resposta) {
			$('.progress').addClass('d-none');

		})
		.fail(function(){
			console.log('Ops, Algo deu errado');
		})
	}

	// ação do botão leia mais (.btn-detalhes)
	$('.btn-detalhes').on('click', function() {
		detalhesPostAjax();
	});


	/* curtir post **/
	var curtirPostToggleAjax = function(){
		$.ajax({
			url: wp.ajaxurl,
			type: 'GET',
			data: {
				action: 'curtirPostToggle',
			},
			beforeSend:function(){
				$('.progress').removeClass('d-none');
			}
		})
		.done(function(resposta) {
			$('.progress').addClass('d-none');
		})
		.fail(function(){
			console.log('Ops, Algo deu errado');
		})
		
	}
	
	// ação do botão curtir (.btn-curtir)
	$('.btn-curtir').on('click', function() {
		curtirPostToggleAjax();
	});


})