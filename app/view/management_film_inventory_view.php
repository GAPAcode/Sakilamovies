<div>
	<ul class="nav bg-info p-1">
		<li class="nav-item">
			<a class="nav-link btn btn-secondary" href="<?php echo $thispage ?>?view=film_inventory">Back to full view</a>
		</li>

		<?php if (isset($err)): ?>
			<li class="nav-item">
				<div class="alert alert-danger p-2 my-auto px-4">
					<strong>No results of <?php echo $_POST["s_stock"] ?></strong>
				</div>
			</li>
		<?php endif ?>

		<li class="nav-item ml-auto">
			<button type="button" class="nav-link text-dark btn btn-warning mr-1 px-3" data-toggle="modal" data-target="#addInventory">
				<i class="fa fa-film"></i> Add Inventory
			</button>
		</li>
		
		<li class="nav-item">
			<form class="form-inline" action="<?php echo $thispage . '?view=film_inventory' ?>" method="post">
				<input id="s_search" class="form-control mr-1" type="text" name="s_stock" placeholder="Search Film in Stock">
				<input type="submit" class="btn btn-warning" value="Search">
			</form>
		</li>
	</ul>
</div>
<div class="row">

	<div id="store1" class="col-lg-6">
		<h3 class="display-4 text-center">Store 1</h3>
		<table class="table table-bordered">
			<thead class="thead-dark text-center">
				<th>id</th>
				<th class="text-left">Film Name</th>
				<th>Stock</th>
			</thead>
			<tbody>
				<?php foreach ($inventory as $item): ?>
					<?php if ($item->store_id == 1): ?>
						<tr>
							<th class="text-center"><?php echo $item->film_id; ?></th>
							<th><?php echo $item->title; ?></th>
							<th class="text-center"><?php echo $item->quantity; ?></th>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div id="store2" class="col-lg-6">
		<h3 class="display-4 text-center">Store 2</h3>
		<table class="table table-bordered">
			<thead class="thead-dark text-center">
				<th>id</th>
				<th class="text-left">Film Name</th>
				<th>Stock</th>
			</thead>
			<tbody>
				<?php foreach ($inventory as $item): ?>
					<?php if ($item->store_id == 2): ?>
						<tr>
							<th class="text-center"><?php echo $item->film_id; ?></th>
							<th><?php echo $item->title; ?></th>
							<th class="text-center"><?php echo $item->quantity; ?></th>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="addInventory">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add Inventory</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form action="<?php $thispage ?>" method="post" >
					<div class="form-group">
						<label for="f_stores"><i class="fa fa-store"></i>Select Store</label>
						<select class="form-control" id="f_stores" name="ai_store">
							<option value="1">
								Store 1
							</option>
							<option value="2">
								Store 2
							</option>
						</select>
					</div>

					<div class="form-group">
						<label for="f_films"><i class="fa fa-store"></i>Select Film</label>
						<select class="form-control" id="f_films" name="ai_film">
							<?php foreach ($films as $film): ?>
								<option value="<?php echo $film->film_id ?>">
									<?php echo $film->title ?>
								</option>
							<?php endforeach ?>
						</select>
					</div>

					<div class="form-group">
						<label for="f_quantity">Quantity</label>
						<input class="form-control" type="number" name="ai_quantity" min="1">
					</div>

					<button type="submit" class="btn btn-success mt-3 w-100" name="add_inv"><i class="fa fa-plus"></i> Add </button>
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>