<div class="container" id="login_management">
	<div class="card w-50 mx-auto mt-5">
		<!-- Card Header -->
		<div class="card-header">
			<h4 class="modal-title">Management Login</h4>
		</div>
		<!-- Modal body -->
		<div class="card-body">
			<form action="<?php $thispage ?>" method="post" >
				<div class="form-group">
					<label for="l_user"><i class="fa fa-user"></i> Username</label>
					<input id="l_user" type="text" name="m_user" class="form-control" autocomplete="username">
				</div>

				<div class="form-group">
					<label for="l_pass"><i class="fa fa-lock"></i> Password</label>
					<input id="l_pass" type="password" name="m_pass" class="form-control" autocomplete="current-password">
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" name="m_remember"> Remember me
					</label>
				</div>

				<button type="submit" class="btn btn-success mt-3 w-100" name="m_login_send"> Send </button>
			</form>
		</div>
		<div class="card-footer">
			<a href="index.php" class="btn btn-secondary">Back to Sakila</a>
		</div>
	</div>
</div>