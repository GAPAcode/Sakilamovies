<!-- pie de pagina -->
<footer class="container-fluid mt-5 text-light bg-info">
	<div class="row">

		<div class="col-md-4 py-4 bg-dark">
			<a href="/sakila/index" class="navbar-brand text-light">
				SAKILA <small class="font-weight-light">movies</small>
			</a>
			<p>
				<small>All rights reserved, Copyrights 2019 &COPY;</small>
			</p>
		</div>
		<div class="col-md-4 py-4">
			<ul class="social-media">
				<h5>Social</h5>
				<li><i class="fa fa-facebook"></i> <span>Facebook</span> </li>
				<li><i class="fa fa-twitter"></i> <span>Twitter</span> </li>
				<li><i class="fa fa-github"></i> <span>Github</span> </li>
			</ul>
		</div>
		<div class="col-md-4 py-4">
			<ul class="social-media">
				<h5>Contact us</h5>
				<li><i class="fa fa-envelope"></i> <span> contact&commat;sakila.com</span> </li>
				<li><i class="fa fa-phone"></i> <span>+1 555 8322 3213</span> </li>
				<li><i class="fa fa-building-o"></i> <span>47 MySakila Drive, Alberta, Canada</span> </li>
			</ul>
		</div>
	
	</div>
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
				<form action="/sakila/" method="post" id="login-form" >
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
				<a class="text-light btn btn-success ml-1 px-3" href="/sakila/signup">
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