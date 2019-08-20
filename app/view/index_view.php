<!-- Barra de navegacion -->
<?php 
	echo $index->get_navbar(
			$index->get_session_username(),
			$index->get_session_profile_pic()
);
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
				<img src="../uploads/test1024x300.jpg" class="img-fluid w-100" alt="Los Angeles">
				<div class="carousel-caption">
					<h3>Articulo 1</h3>
					<p>Lorem ipsum dolor sit amet, consectetur.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="../uploads/test1024x300.jpg" class="img-fluid w-100" alt="Chicago">
				<div class="carousel-caption">
					<h3>Articulo 2</h3>
					<p>Lorem consectetur adipisicing elit, sed do eiusmod.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img src="../uploads/test1024x300.jpg" class="img-fluid w-100" alt="New York">
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
			<a class="nav-link text-light my-1" href="index.php">
				Index
			</a>
		</li>
		<li class="nav-item">
			<form id="film_search" class="form-inline p-1" action="<?php $thispage ?>" method="get">
				<input id="s_input" class="form-control mr-1" type="text" name="s" placeholder="Search">
				<input type="submit" class="btn btn-warning font-weight-bold" value="Search">
			</form>
		</li>
	</ul>
	<!-- SubMenu de páginas -->

	<!-- paginacion -->
	<?php $index->get_paginacion() ?>
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
						<?php foreach ($categorias as $categoria): ?>
						<a class="dropdown-item text-light" href="<?php echo $thispage . '?c=' . $categoria->get_nombre() ?>"><?php echo $categoria->get_nombre(); ?></a>
						<?php endforeach ?>
					</div>
				</li>
			</ul>
		</div>
		<!-- sidenav de categorias -->

		<!-- Peliculas -->
		<div class="col-lg-9">
			<?php $index->get_results_header(); ?>
			<div class="row">

				<?php foreach($film_list as $film):?>
					<div class="col-lg-4 px-2">
						<div class="card border-0 my-1">
							<div class="card-header bg-dark text-light">
								<h6><i class="fa fa-film mr-2"></i><?php echo ($film->get_titulo()) ?></h6>
							</div>
							<div class="card-body p-0 bg-dark">
								<img src="../uploads/test250x250.png" class="img-fluid w-100">
								<div class="container badges">
									<span class="mx-0 badge badge-primary">
										<?php echo ($film->get_categoria()) ?>
									</span>
									<span class="mx-0 badge badge-warning">
										Length: <?php echo ($film->get_duracion()) ?>min
									</span>
								</div>
							</div>
							<div class="card-footer p-0 bg-dark rounded-bottom">
								<a href="film.php?fid=<?php echo($film->get_id()); ?>" class="btn btn-primary w-100"><?php echo ($film->get_precio()) ?>$</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
		</div>
		<!-- Peliculas -->
	</div>

	<!-- paginacion -->
	<?php $index->get_paginacion() ?>
	<!-- paginacion -->
</div>


<!-- pie de pagina -->
<footer class="container-fluid mt-5 py-4 text-center text-light bg-info">
	Lorem ipsum dolor, sit amet consectetur
</footer>
<!-- pie de pagina -->

<!-- Modal del login -->
<div class="modal fade" id="login">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Login</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form action="<?php $thispage ?>" method="post" id="login-form" >
					<div class="form-group">
						<label for="l_user"><i class="fa fa-user"></i> Username</label>
						<input id="l_user" type="text" name="l_user" class="form-control" autocomplete="username" required>
					</div>

					<div class="form-group">
						<label for="l_pass"><i class="fa fa-lock"></i> Password</label>
						<input id="l_pass" type="password" name="l_pass" class="form-control" autocomplete="current-password" required>
					</div>

					<div class="form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox" name="l_remember"> Remember me
						</label>
					</div>

					<button type="submit" class="btn btn-success mt-3 w-100" name="login_send"> Send </button>
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<a class="text-light btn btn-success ml-1 px-3" href="signup.php">
					<i class="fa fa-sign-in"></i> Sign up
				</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal del login -->

<!-- Modal de error login -->
<?php if(isset($error)): ?>
<div class="modal fade" id="error">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-danger">ERROR</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-content">
				<div class="modal-body">
					<p> <?php echo $error ?> </p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<!-- Modal de error login -->

<!-- Icono de redireccion -->
<div id="redirect" class="w-100" style="display:none">
	<div class="mx-auto w-25 h-100 bg-light rounded pt-5">
		<div class="w-25 mx-auto">
			<i class="fa fa-refresh fa-spin fa-5x mx-auto"></i>
		</div>
		<p style="display:table" class="mx-auto mt-2"><strong>Espere por favor...</strong></p>
	</div>
</div>
<!-- Icono de redireccion -->