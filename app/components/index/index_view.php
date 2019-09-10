<!-- Barra de navegacion -->
<?php
	$this->get_header();
	$this->get_navbar();
?>
<!-- Barra de navegacion -->

<div class="container">
	<!-- Slider (actualmente estatico o default de bootstrap) -->
	<div id="demo" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ul class="carousel-indicators">
			<li data-target="#demo" data-slide-to="0" class="active"></li>
			<li data-target="#demo" data-slide-to="1"></li>
			<li data-target="#demo" data-slide-to="2"></li>
		</ul>
		<!-- The slideshow -->
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="http://localhost/uploads/test1024x300.jpg" class="img-fluid w-100" alt="Los Angeles">
				<div class="carousel-caption">
					<h3>Articulo 1</h3>
					<p>Lorem ipsum dolor sit amet, consectetur.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="http://localhost/uploads/test1024x300.jpg" class="img-fluid w-100" alt="Chicago">
				<div class="carousel-caption">
					<h3>Articulo 2</h3>
					<p>Lorem consectetur adipisicing elit, sed do eiusmod.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="http://localhost/uploads/test1024x300.jpg" class="img-fluid w-100" alt="New York">
				<div class="carousel-caption">
					<h3>Articulo 3</h3>
					<p>Lorem ipsum dolor mollit anim id est laborum.</p>
				</div>
			</div>
		</div>
		<!-- Left and right controls -->
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>
	<!-- Slider (actualmente estatico o default de bootstrap) -->

	<!-- SubMenu de páginas -->
	<ul id="sup_nav" class="nav bg-info font-weight-light">
		<li class="ml-auto nav-item">
			<a class="nav-link text-light my-1" href="/sakila/index">
				Index
			</a>
		</li>
		<li>
			<form id="film_search" class="form-inline p-1" action="/sakila/" method="get">
				<input id="s_input" class="form-control mr-1" type="text" placeholder="Search">
				<input type="submit" class="btn btn-warning font-weight-bold" value="Search">
			</form>
		</li>
	</ul>
	<!-- SubMenu de páginas -->

	<!-- paginacion -->
	<?php $this->get_paginacion() ?>
	<!-- paginacion -->
	

	<div class="row mb-5">

		<!-- sidenav de categorias -->
		<div class="col-lg-3">
			<ul id="accordion" class="nav justify-content-center bg-info font-weight-light flex-column">
				<li class="nav-item">
					<a class="nav-link text-light font-weight-bold" data-toggle="collapse" data-parent="#accordion" href="#cat1">
						Categories
					</a>
					<div id="cat1" class="collapse">
						<?php foreach ($this->categorias as $categoria): ?>
						<a class="dropdown-item text-light" href="<?php echo '/sakila/category/' . $categoria->get_nombre() ?>">
							<?php echo $categoria->get_nombre(); ?>
						</a>
						<?php endforeach ?>
					</div>
				</li>
			</ul>
		</div>
		<!-- sidenav de categorias -->

		<!-- Peliculas -->
		<div id="films_column" class="col-lg-9">
			<?php $this->get_results_header(); ?>
			<div class="row">

				<?php foreach($this->film_list as $film):?>
					<div class="film col-lg-4 px-2">
						<div class="card border-0 my-1">
							<div class="card-header bg-dark text-light">
								<h6><i class="fa fa-film mr-2"></i><?php echo ($film->title) ?></h6>
							</div>
							<div class="card-body p-0 bg-dark">
								<img src="http://localhost/uploads/test250x250.png" class="img-fluid w-100">
								<div class="container badges">
									<span class="mx-0 badge badge-primary">
										<?php echo ($film->category) ?>
									</span>
									<span class="mx-0 badge badge-warning">
										Length: <?php echo ($film->length) ?>min
									</span>
								</div>
								
							</div>
							<div class="card-footer p-0 bg-dark rounded-bottom">
								<?php if($film->has_stock > 0): ?>
								<a href="/sakila/film/<?php echo( $film->FID ); ?>/" class="film-btn btn btn-primary w-100">
								<?php echo ( $film->price )?>$
							</a>
							<?php else: ?>
									<div class="label-out-stock"> Film out stock </div>
									<button class="film-btn btn btn-secondary w-100" disabled>
										Sorry this film is out of Stock	
									</button>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
		</div>
		<!-- Peliculas -->
	</div>

	<!-- paginacion -->
	<?php $this->get_paginacion() ?>
	<!-- paginacion -->
</div>

<?php 
	$this->getFooter();
?>