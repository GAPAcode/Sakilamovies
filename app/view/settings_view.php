<nav class="navbar navbar-expand-lg bg-dark">
	<div class="container">
		<a href="index" class="navbar-brand text-light">SAKILA <small class="font-weight-light">movies</small></a>


		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link btn btn-secondary px-3" href="index">
					<i class="fa fa-home"></i> Index
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link btn btn-danger ml-1 px-3" href="index?logout=yes">
					<i class="fa fa-sign-out"></i> Logout
				</a>
			</li>

			<img src="/uploads/<?php echo $_SESSION['profile']?>" class="ml-2 img-fluid profile-pic">
			<p class="text-light ml-2 my-auto pfl-username"> <?php echo $_SESSION["user"]; ?></p>			
		</ul>
		
	</div>
</nav>

<div class="container">

	<div class="card w-75 mx-auto">
		
		<div class="card-header">
			<h1><i class="fa fa-gear mr-1"></i>Settings</h1>	
		</div>

		<div class="card-body">
			<form id="settings" class="w-100" action="/sakila/settings" method="POST" enctype="multipart/form-data">
				<h3>General</h3>
				<hr>
				
				<div class="form-group">
					<input type="hidden" name="st_hidPic" value="<?php echo $user_data->profile_pic?>" >
					<label>Change profile picture</label>
					<input class="form-control h-100" type="file" name="st_pic">
				</div>

				<div class="form-group">
					<label>Change Username</label>
					<input class="form-control" type="text" name="st_user" value="<?php echo $user_data->username ?>">
				</div>

				<div class="form-group">
					<label>Change email</label>
					<input class="form-control" type="email" name="st_mail" value="<?php echo $user_data->email ?>">
				</div>
				 
				<h3>Address</h3>
				<hr>

				<div class="form-group" id="pais">
					<label>Country </label>
					<!-- <input class="form-control" type="text" name="st_country" value="<?php echo $user_data->country ?>"> -->
					<select class="form-control" name="st_country" id="country-list">
						<?php foreach($countries as $country): ?>
							<option value="<?php echo $country->country_id ?>" <?php echo ($country->country_id == $user_data->country_id)?"selected":""?>>
								<?php echo $country->country ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group" id="city">
					<label>City </label>
					<select class="form-control" name="st_city" id="select_city">
						<?php foreach ($cities as $city):?>
							<option value=" <?php echo $city->city_id ?> " <?php echo ($city->city_id == $user_data->city_id)?"selected":""?>> 
							<?php echo $city->city ?> 
							</option>
						<?php endforeach?>
					</select>
				</div>
				
				<div class="form-group">
					<label>District </label>
					<input class="form-control" type="text" name="st_district" value="<?php echo $user_data->district ?>">
				</div>

				<div class="form-group">
					<label>Street / Address </label>
					<input class="form-control" type="text" name="st_address" value="<?php echo $user_data->address ?>">
				</div>




				<div class="form-group w-50 mx-auto">
					
					<input class="btn btn-success w-100" type="submit" name="save" value="Save Changes">
				</div>
			</form>
		</div>

		<div class="card-footer">
			
		</div>
	</div>
</div>