<nav class="navbar navbar-expand-lg bg-dark">
<div class="container">
	<a href="index.php" class="navbar-brand text-light">
		SAKILA <small class="font-weight-light">movies</small>
	</a>


	<ul class="navbar-nav">
	<?php if (isset($_SESSION["user"])): ?>
		<li class="nav-item">
			<a class="nav-link btn btn-secondary px-3" href="index.php">
				<i class="fa fa-home"></i> Index
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link btn btn-danger ml-1 px-3" href="index.php?logout=yes">
				<i class="fa fa-sign-out"></i> Logout
			</a>
		</li>

		<img src="/uploads/<?php echo $_SESSION['profile']?>" class="ml-2 img-fluid profile-pic">
		<p class="text-light ml-2 my-auto pfl-username"> <?php echo $_SESSION["user"]; ?></p>

		<li class="nav-item my-auto">
				<a class="nav-link ml-2 btn btn-light my-auto pt-1 pb-0 px-1" href="#">
					<i class="fa fa-gear settings-icon"></i>
				</a>
		</li>
		
		<?php else: ?>
			<li class="nav-item">
				<a class="nav-link btn btn-secondary px-3" href="index.php">
					<i class="fa fa-home"></i> Index
				</a>
			</li>
			<li class="nav-item">
				<button type="button" class="nav-link text-light btn btn-primary ml-1 px-3" data-toggle="modal" data-target="#login">
					<i class="fa fa-user"></i> Login
				</button>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light btn btn-success ml-1 px-3" href="signup.php">
					<i class="fa fa-sign-in"></i> Sign up
				</a>
			</li>
			
	<?php endif ?>
	</ul>
	
</div>
</nav>
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

			<div class="card-footer bg-dark">
				<button class="btn btn-success w-100">Rent this film for <span class="badge badge-primary"><?php echo $film->film_details->get_precio() ?>$</span></button>
			</div>
		</div>
		<!-- aside/widgets -->
		<div class="col-lg-3">
			
		</div>
	</div>
</div>

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

<footer class="container-fluid mt-5 py-4 text-center text-light bg-info">
        Lorem ipsum dolor, sit amet consectetur
</footer>