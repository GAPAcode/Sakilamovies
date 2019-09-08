<nav class="navbar bg-dark navbar-expand-lg">
	<div class="container">
		<a href="/sakila/management" class="navbar-brand text-light">
			SAKILA <small class="font-weight-light">management</small>
		</a>

		<?php if(isset($this->session_username)): ?>
			<ul class="navbar-nav">

				<li class="nav-item">
					<a class="nav-link btn btn-primary ml-1 px-3" href="/sakila/management">
						<i class="fa fa-th"></i> Dashboard
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link btn btn-danger ml-1 px-3" href="/sakila/management?logout=yes">
						<i class="fa fa-sign-out"></i> Logout
					</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link btn btn-secondary ml-1 px-3" href="/sakila/index" title="Go to Sakila Index">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<img class="ml-2 img-fluid profile-pic" src="/uploads/<?php echo $this->session_profile_pic ?>">
				<span class="ml-1 pfl-username my-auto text-light"> <?php echo $this->session_username ?></span>
			</ul>
		<?php endif; ?>
	</div>
</nav>