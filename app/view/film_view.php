<?php 
	echo $film->get_navbar(
		$film->get_session_username(),
		$film->get_session_profile_pic()
	);
?>
<div class="container">
	<div class="rows">
		<!-- detalles del film -->
		<div class="col-lg-9">
			<div class="card-header bg-light">
				<h3><?php echo $film->film_details->get_titulo() ?></h3>
				<strong>Category: </strong> <span class="badge badge-warning"><?php echo $film->film_details->get_categoria() ?></span>
			</div>
			<div class="card-body bg-light">
				<div class="jumbotron">
					<h4>Description: </h4>
					<p><?php echo $film->film_details->get_descripcion() ?></p>

					<h4>Actors: </h4>
					<p><?php echo $film->film_details->get_actores() ?></p>

					<div>
						<div class="bg-secondary p-1 rounded text-light" style="display: inline-block;">
							<strong>Length: <?php echo $film->film_details->get_duracion() ?>min</strong>
						</div>
						<div class="bg-warning p-1 rounded" style="display: inline-block;">
							<strong>Rating: <?php echo $film->film_details->get_clasificacion() ?></strong> 
						</div>
					</div>

				</div>
				<div class="bg-info p-3 w-25 rounded">
					<h5 class="text-light">Rent price</h5>
					<div class="bg-dark p-1 w-50 rounded">
						<span class="font-weight-bold text-light"><?php echo $film->film_details->get_precio() ?>$</span>
					</div>
				</div>
			</div>
			<!-- validates if is logged or not -->
			<?php if(isset($_SESSION["user"])): ?>

			<div class="card-footer bg-dark">
				<button class="btn btn-success w-100">Rent this film for <span class="badge badge-primary"><?php echo $film->film_details->get_precio() ?>$</span></button>
			</div>

			<?php else: ?>

			<button type="button" class="btn btn-primary w-100 py-3" data-toggle="modal" data-target="#login">
				<i class="fa fa-user"></i> Login or signup to rent this film!
			</button>

			<?php endif ?>
		</div>
		<!-- aside/widgets -->
		<div class="col-lg-3">
			
		</div>
	</div>
</div>


<footer class="container-fluid mt-5 py-4 text-center text-light bg-info">
	Lorem ipsum dolor, sit amet consectetur
</footer>

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
				<form action="index.php" method="post"  >
					<div class="form-group">
						<label for="l_user"><i class="fa fa-user"></i> Username</label>
						<input id="l_user" type="text" name="l_user" class="form-control" autocomplete="username">
					</div>

					<div class="form-group">
						<label for="l_pass"><i class="fa fa-lock"></i> Password</label>
						<input id="l_pass" type="password" name="l_pass" class="form-control" autocomplete="current-password">
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
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

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