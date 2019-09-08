<?php
$management->get_header();
$management->get_navbar();
?>

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
					<a href="/sakila/management/new_film" class="nav-link text-light"> New Film</a>
				</li>
				<li class="nav-item">
					<a href="/sakila/management/film_inventory" class="nav-link text-light"> Film Inventory</a>
				</li>
			</div>
				

		</ul>
	</div>
	<!-- contenido -->
	<div class="col-lg-9 bg-light px-0">
		<?php if (isset($view)):?>
			<?php if ($view == "new_film"): ?>
				<?php
				$langs = $management->get_languages();
				$catgs = $management->get_categories();
				$actors = $management->get_actors();
				include_once __DIR__ . '/views/management_new_film_view.php'; ?>
			<?php endif ?>

			<?php if ($view == "film_inventory"): ?>
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
				include_once __DIR__ . '/views/management_film_inventory_view.php'; 
				?>
			<?php endif ?>
		<?php else: ?>
			<?php
				include_once __DIR__ . '/views/management_dashboard_view.php'; 
			?>
		<?php endif ?>
		
	</div>
</div>

<?php $management->getFooter() ?>