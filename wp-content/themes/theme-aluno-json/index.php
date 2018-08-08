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
<div class="modal fade" id="detalhes-post"></div>

<?php get_footer(); ?>