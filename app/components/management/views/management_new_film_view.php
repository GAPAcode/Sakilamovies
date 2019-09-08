

<div class="card">
	<div class="card-header bg-dark text-light">
		<h2>Film Management - New film</h2>
	</div>
    <div class="card-body">
    	<form action="/sakila/management/new_film" method="POST">
    		<div class="row">
    			<div class="col-lg-8">
    				
		    		<div class="form-group">
		    			<label for="name">Film name: </label>
		    			<input id="name" class="form-control" type="text" name="f_name">
		    		</div>

		    		<div class="form-group">
		    			<label for="description">Description:</label>
		    			<textarea id="description" class="form-control" name="f_desc"></textarea>
		    		</div>

		    		<div class="form-group">
		    			<label for="year">Release year:</label>
		    			<input id="year" class="form-control" type="number" name="f_year" min="1850" max="3000">
		    		</div>

		    		<div class="form-group">
		    			<label for="lang">Select Language:</label>
		    			<select id="lang" class="form-control" name="f_lang">
		    				<?php foreach ($langs as $lang): ?>
		    					<option value="<?php echo $lang->language_id ?>"> 
		    						<?php echo $lang->name; ?>
		    					</option>
		    				<?php endforeach ?>
		    			</select>
		    		</div>

		    		<div class="form-group">
		    			<label for="lang">Select Category:</label>
		    			<select id="lang" class="form-control" name="f_category">
		    				<?php foreach ($catgs as $category): ?>
		    					<option value="<?php echo $category->get_id() ?>"> 
		    						<?php echo $category->get_nombre(); ?>
		    					</option>
		    				<?php endforeach ?>
		    			</select>
		    		</div>

		    		<div class="form-group">
		    			<label for="rental">Rental rate:</label>
		    			<input id="rental" class="form-control" type="number" name="f_rental">
		    		</div>

		    		<div class="form-group">
		    			<label for="length">Length:</label>
		    			<input id="length" class="form-control" type="number" name="f_length">
		    		</div>

		    		<div class="form-group">
		    			<label for="rating">Rating:</label>
		    			<select id="rating" class="form-control" name="f_rting">
		    				<option value="G">G</option>
		    				<option value="PG">PG</option>
		    				<option value="PG-13">PG-13</option>
		    				<option value="R">R</option>
		    				<option value="NC-17">NC-17</option>
		    			</select>
		    		</div>
    			</div>

	    		<div class="col-lg-4">
	    			<div class="p-2 bg-info rounded-top"><h5 class="text-light">Actors</h5></div>

	    			<div class="form-group">
		    			<select class="form-control" name="f_actors">
		    				<?php foreach ($actors as $actor): ?>
		    					<option value="<?php echo $actor->actor_id ?>"><?php echo ($actor->first_name . " " . $actor->last_name) ?></option>
		    				<?php endforeach ?>
		    			</select>
		    		</div>
	    		</div>

    		<button type="submit" name="newfilm" class="btn btn-primary w-100">New Film</button>
    	</form>
    </div>
</div>