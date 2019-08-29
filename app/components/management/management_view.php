<nav class="navbar bg-dark navbar-expand-lg">
	<div class="container">
		<a href="management.php" class="navbar-brand text-light">
			SAKILA <small class="font-weight-light">management</small>
		</a>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link btn btn-secondary px-3" href="index">
					<i class="fa fa-home"></i> Sakila Index
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link btn btn-primary ml-1 px-3" href="management">
					<i class="fa fa-th"></i> Dashboard
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link btn btn-danger ml-1 px-3" href="index?logout=yes">
					<i class="fa fa-sign-out"></i> Logout
				</a>
			</li>
			<img class="ml-2 img-fluid profile-pic" src="/uploads/<?php echo $_SESSION["user_manager_pic"] ?>">
			<span class="ml-1 pfl-username my-auto text-light"> <?php echo $_SESSION["user_manager"] ?></span>
		</ul>
	</div>
</nav>

<div class="row w-100">
	<!-- Menu de acciones -->
	<div class="col-lg-3 pr-0">

		<ul id="accordion" class="nav flex-column bg-dark">
			<div class="pl-3 pt-2 bg-info"> 
				<h5 class="text-light"><i class="fa fa-th-list"></i> Menu</h5>
			</div>
			<li class="nav-item">
				<a class="nav-link text-light font-weight-bold" data-toggle="collapse" data-parent="#accordion" href="#film_management">
					Film Management
				</a>
			</li>

			<div id="film_management" class="collapse ml-2">
				<li class="nav-item">
					<a href="management?view=new_film" class="nav-link text-light"> New Film</a>
				</li>
				<li class="nav-item">
					<a href="management?view=film_inventory" class="nav-link text-light"> Film Inventory</a>
				</li>
			</div>
				

		</ul>
	</div>
	<!-- contenido -->
	<div class="col-lg-9 bg-light px-0">
		<?php if (isset($_GET["view"])): ?>
			<?php if ($_GET["view"] == "new_film"): ?>
				<?php 
				$langs = $management->get_languages();
				$catgs = $management->get_categories();
				$actors = $management->get_actors();
				include_once 'app/view/management_new_film_view.php'; ?>
			<?php endif ?>

			<?php if ($_GET["view"] == "film_inventory"): ?>
				<?php
				if (isset($_POST["s_stock"])) {
					$inventory = $management->get_inventory_by_title($_POST["s_stock"]);
					if ($inventory == "no founds") {
						$err = $inventory;
						$inventory = $management->get_inventory();
					}
				}else{
					$inventory = $management->get_inventory();
				}
				$films = $management->get_short_film_list();
				include_once 'app/view/management_film_inventory_view.php'; 
				?>
			<?php endif ?>
		<?php else: ?>
			<div class="jumbotron">
				<h1>Hey, welcome again <?php echo $_SESSION["user_manager"] ?></h1>
			</div>
		<?php endif ?>
		
	</div>
</div>