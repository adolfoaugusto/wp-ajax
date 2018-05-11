<?php get_header(); ?>
<div class="container">
	<!-- topo -->
	<section class="topo">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>WordPress Developer</h1>
				<h4>Ajax sem segredos</h4>
			</div>
		</div>
	</section>
	<div class="row">
		<div class="col-md-9">

			<!-- busca rápida -->
			<section class="busca-rapida">
				<button type="button" id="btn-limpar" class="btn btn-danger btn-sm d-none">Limpar</button>
				<div class="input-group">
					<div class="input-group-addon">Buscar</div>
					<input type="text" id="campo-busca" class="form-control form-control-lg" placeholder="O que você procura?">
				</div>
			</section>
			<!-- fim busca rápida -->

			<!-- ajax load -->
			<div class="ajax-info" id="loading">
				<div class="progress d-none">
					<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:100%;"></div>
				</div>
			</div>
			<!-- fim ajax load -->

			<!-- lista posts -->
			<section class="lista-posts" id="lista-posts">

			</section>
			<!-- fim lista posts -->

		</div>
		<div class="col-md-3">

			<!-- categorias -->
			<?php get_template_part( '_parts/categorias' ); ?>
			<!-- fim categorias -->

		</div>
	</div>
</div>

<!-- modal -->
<div class="modal fade" id="detalhes-post">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Título do post</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint distinctio facere aliquid consequatur quidem excepturi neque harum. Sit dolorum itaque commodi, vero officiis, ab. Omnis cum dolorum optio, porro aliquid!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit id, fugiat, ab, laudantium esse eius ipsum consequuntur atque veniam totam, quos sit? Ducimus vero dignissimos fuga consequatur quibusdam similique esse!</p>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>