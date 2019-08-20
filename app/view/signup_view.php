<div class="container mt-5">
	<div class="card w-50 mx-auto">
		<div class="card-header bg-dark">
			<h3 class="text-light">Sakila Signup</h3>
		</div>
		<div class="card-body">
			<form action="<?php $thispage ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="su_fname"><i class="fa fa-user"></i> Your first name</label>
					<input id="su_fname" class="form-control" type="text" name="su_fname">
				</div>

				<div class="form-group">
					<label for="su_lname"><i class="fa fa-user"></i> Your Last name</label>
					<input id="su_lname" class="form-control" type="text" name="su_lname">
				</div>

				<div class="form-group">
					<label for="su_email"><i class="fa fa-envelope"></i> Your email </label>
					<input id="su_email" class="form-control" type="email" name="su_email">
				</div>

				<div class="form-group">
					<label for="su_user"><i class="fa fa-user-circle"></i> Username </label>
					<input id="su_user" class="form-control" type="text" name="su_user">
				</div>

				<div class="form-group">
					<label for="su_pass"><i class="fa fa-lock"></i> Password </label>
					<input id="su_pass" class="form-control" type="password" name="su_pass">
				</div>

				<div class="form-group">
					<label for="su_pic"><i class="fa fa-smile-o"></i> Profile Picture (optional)</label>
					<input id="su_pic" class="form-control h-100" type="file" name="su_pic">
				</div>

				<input class="btn btn-success w-100" type="submit" name="send" value="Sign Up!">

			</form>
		</div>

		<div class="card-footer">
			<a href="index.php" class="btn btn-secondary">Back to Sakila</a>
		</div>
	</div>
</div>

<footer class="container-fluid mt-5 py-4 text-center text-light bg-info">
        Lorem ipsum dolor, sit amet consectetur
</footer>