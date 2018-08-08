jQuery(function($){
	var page = 1;
	var slug = $('.list-group-item.active').data('slug');
	var search = '';
	var rlp = null;

	var listarPostsAjax = function(page, slug, search){
		rlp = $.ajax({
			url: wp.ajaxurl,
			type: 'POST',
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
					rlp = null;
				}
			}
		})
		.done(function(resposta) {
			$('.progress').addClass('d-none');

			$('#lista-posts').html('');
			let success = resposta.success;
			let pages = resposta.data.pages
			let posts = resposta.data.posts

			if (success) {			

				$.each(posts, function(i, post) {
					$('#lista-posts').append(
						`
						<div class="item" data-id="${post.ID}">
							<div class="card">
								<div class="card-body">
									<h4>${post.titulo}</h4>
									${post.resumo}
								</div>
								<div class="card-footer text-right">
									<button type="button" class="btn btn-sm btn-primary btn-detalhes">Leia mais</button>
									<button type="button" class="btn btn-sm btn-info btn-curtir" data-tipo="like"><span class="text">Gostei</span> <span class="badge badge-light">${post.likes? post.likes : "0"}</span></button>
								</div>
							</div>
						</div>
						`
					);
				});

				if (pages > 0) {
					$('#lista-posts').append(
						`
						<section class="paginacao">
							<nav aria-label="Page navigation example">
								<ul class="pagination"></ul>
							</nav>
						</section>
						`
					);
					for (var i = 1; i <= pages; i++) {
						$('.pagination').append(
							`<li class="page-item ${ page == i ? 'active' : '' }"><span class="page-link">${i}</a></li> 
							`
						);
					}
				}

			}else{
				$('#lista-posts').html(`
					<div class="alert alert-danger text-center"> 
						${resposta.data.msg}
					</div>`);
			}

			visitanteLikes();
		})
		.fail(function(){
			console.log('Ops, Algo deu errado na requisição!!!');
		})
	}
	
	listarPostsAjax(page);

	//ação do botão da categoria (list-group-item)
	$('.list-group-item').on('click', function() {
		slug = $(this).data('slug');
		listarPostsAjax(1, slug, search);
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
			type: 'POST',
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

			let success = resposta.success

			if (success) {
				$('#detalhes-post').html(`
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">${resposta.data.titulo}</h5>
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								${resposta.data.conteudo}
							</div>
							<div class="modal-footer"></div>
						</div>
					</div>
				`);
			}else{
				$('#detalhes-post').html(`
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Ops... Algo deu errado!</h5>
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								${resposta.data.msg}
							</div>
							<div class="modal-footer"></div>
						</div>
					</div>
				`);
			}

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
	var curtirPostToggleAjax = function(id, tipo){
		$.ajax({
			url: wp.ajaxurl,
			type: 'POST',
			data: {
				action: 'curtirPostToggle',
				id: id,
				tipo: tipo
			},
			beforeSend:function(){
				$('.progress').removeClass('d-none');
			}
		})
		.done(function(resposta) {
			$('.progress').addClass('d-none');
			if (tipo == 'like') {
				$('[data-id=' + id + '] .btn-curtir').data('tipo', 'deslike')
				$('[data-id=' + id + '] .btn-curtir').removeClass('btn-info').addClass('btn-success')
			}else{
				$('[data-id=' + id + '] .btn-curtir').data('tipo', 'like')
				$('[data-id=' + id + '] .btn-curtir').removeClass('btn-success').addClass('btn-info')
			}
			
			$('[data-id=' + id + '] .btn-curtir .badge').html(resposta);

		})
		
	}
	
	// ação do botão curtir (.btn-curtir)
	$('body').on('click', '.btn-curtir', function() {
		let id = $(this).closest('.item').data('id');
		let tipo = $(this).data('tipo');
		curtirPostToggleAjax(id, tipo);

		let salvos = localStorage.getItem('likes');
		if (!salvos) {
			localStorage.setItem('likes', id.toString());
		}else{
			salvos = salvos.split(',');
			let item = $.inArray(id.toString(), salvos); //se não existir retorna numero -1
			if ( item == -1 ) {
				salvos.push(id.toString());
			}else{
				salvos.splice(item, 1);
			}

			localStorage.setItem('likes', salvos);
			
		}
	});

	var visitanteLikes = function(){
		let salvos = localStorage.getItem('likes');
		if (salvos) {
			salvos = salvos.split(',');
			salvos.forEach( function(id){
				$('[data-id=' + id + '] .btn-curtir').removeClass('btn-info').addClass('btn-success');
				$('[data-id=' + id + '] .btn-curtir').attr('data-tipo', 'deslike');
			});
		}
	}


})