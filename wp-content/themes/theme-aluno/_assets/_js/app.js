jQuery(function($){
	/* listar posts 
		(x)função php
		(x)admin-ajax.php
		( )função js
	**/

	var page = 1;
	var slug = $('.list-group-item.active').data('slug');
	var search = '';

	var rlp = null;

	var listarPostsAjax = function(page, slug, search){
		rlp = $.ajax({
			url: wp.ajaxurl,
			type: 'GET',
			data: {
				action: 'listarPosts',
				page: page,
				slug: slug,
				search: search
			},
			beforeSend:function(){
				$('.progress').removeClass('d-none');
				if (rlp != null) {
					rlp.abort();
				}
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
	listarPostsAjax(page);

	//ação do botão da categoria (list-group-item)
	$('.list-group-item').on('click', function() {
		slug =$(this).data('slug');
		listarPostsAjax(page, slug, search);
		$('.list-group-item').removeClass('active');
		$(this).addClass('active');
	});

	//ação do botão da paginação (list-group-item)
	$('body').on('click', '.page-item', function() {
		page = $(this).find('span').text();
		listarPostsAjax(page, slug, search);
		$('.page-item').removeClass('active');
		$(this).addClass('active');
	});

	//ação do botão limpar busca (#btn-limpar)
	$('#btn-limpar').on('click', function() {
		listarPostsAjax(page);
		$(this).addClass('d-none');
		$('#campo-busca').val('');
		// $('#btn-limpar')

		search = '';
	});

	//ação qndo digitar na busca (#btn-limpar)
	$('#campo-busca').on('keyup', function() {
		search = $(this).val();
		if (search.length >=3 ) {
			listarPostsAjax(page, slug, search);
		}else{
			listarPostsAjax(page, slug);	
		}

		if (search.length < 1 ) {
			$('#btn-limpar').addClass('d-none');
		}else {
			$('#btn-limpar').removeClass('d-none');
		}
		// $('#btn-limpar')
	});
	

	/* detalhe post **/
	var detalhesPostAjax = function(id){
		
		$.ajax({
			url: wp.ajaxurl,
			type: 'GET',
			data: {
				action: 'detalhesPost', 
				id: id
			},
			beforeSend:function(){
				$('.progress').removeClass('d-none');
			}
		})
		.done(function(resposta) {
			$('.progress').addClass('d-none');
			$('#detalhes-post').html(resposta);
			$('#detalhes-post').modal('show');
		})
		.fail(function(){
			console.log('Ops, Algo deu errado');
		})
	}

	// ação do botão leia mais (.btn-detalhes)
	$('body').on('click', '.btn-detalhes', function() {
		let id = $(this).closest('.item').data('id');
		detalhesPostAjax(id);
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