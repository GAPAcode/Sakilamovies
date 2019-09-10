<?php 
	$this->get_header();
	$this->get_navbar();
?>
<div class="container">
	<div class="rows">
		<!-- detalles del film -->
		<div class="col-lg-9">
			<div class="card mt-5">
				<div class="card-header bg-light">
					<h3 id="film-title"><?php echo $this->film_details->title ?></h3>
					<strong>Category: </strong> <span class="badge badge-warning"><?php echo $this->film_details->category ?></span>
				</div>
				<div class="card-body bg-light">
					<div class="jumbotron">
						<h4>Description: </h4>
						<p><?php echo $this->film_details->description ?></p>

						<h4>Actors: </h4>
						<p><?php echo $this->film_details->actors ?></p>

						<div>
							<div class="bg-secondary p-1 rounded text-light" style="display: inline-block;">
								<strong>Length: <?php echo $this->film_details->length ?>min</strong>
							</div>
							<div class="bg-warning p-1 rounded" style="display: inline-block;">
								<strong>Rating: <?php echo $this->film_details->rating ?></strong> 
							</div>
						</div>

					</div>
					<div class="bg-info p-3 w-25 rounded">
						<h5 class="text-light">Rent price</h5>
						<div class="bg-dark p-1 w-50 rounded">
							<span id="film-price" class="font-weight-bold text-light"><?php echo $this->film_details->price ?></span>
						</div>
					</div>
				</div>
				<!-- validates if is logged or not -->
				<?php if(isset($_SESSION["user"])): ?>

				<div class="card-footer bg-dark">
					<?php if($this->film_details->has_stock > 0): ?>
						<button id="rent-btn" class="btn btn-success w-100" value="<?php echo $this->film_details->FID ?>">
							Rent this film for <span class="badge badge-primary"><?php echo $this->film_details->price ?>$</span>
						</button>
					<?php else: ?>
						<button id="rent-btn" class="btn btn-success w-100" disabled>
							Sorry, this film is not in stock
						</button>
					<?php endif ?>
				</div>

				<?php else: ?>

				<button type="button" class="btn btn-primary w-100 py-3" data-toggle="modal" data-target="#login">
					<i class="fa fa-user"></i> Login or signup to rent this film!
				</button>

				<?php endif ?>
			</div>
		</div>
		<!-- aside/widgets -->
		<div class="col-lg-3">
			
		</div>
	</div>
</div>

<?php 
	$this->getFooter();
?>