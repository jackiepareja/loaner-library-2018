<?php
	include("../../includes/config.php");
	include("../../includes/classes/Device.php");
	$device = new Device($con);
	include("../partials/u-header.php");
	include("../partials/u1-navigation.php");

	// session_destroy(); LOGOUT
	$defaultDevice = "iOS";
	$displayAllQuery = "SELECT * FROM devices WHERE category='$defaultDevice'";
	$displayFilterResults = mysqli_query($con, $displayAllQuery);

	$searchedDevice = "ios";
	if(isset($_POST['searchButton'])) {
		$searchedDevice = $_POST['filter_options'];

		if($searchedDevice != "all"){
			$displayFilterQuery = "SELECT * FROM devices WHERE category='$searchedDevice'";
		  $displayFilterResults = mysqli_query($con, $displayFilterQuery);
		} else {
			$displayAllQuery = "SELECT * FROM devices";
			$displayFilterResults = mysqli_query($con, $displayAllQuery);
		}
	}
?>
<section class="userDashboard">

		<div class="container wrapper box-shadow mt-5">
			<div class="row wrapper_sub--header">
				<h3 class="header_primary"><?php echo strtoupper($searchedDevice) ?> ASSETS</h3>
				<div class="ml-auto">
					<form method="POST" action"" class="filter">
						<select class="font_15 filter_options" name="filter_options" required>
							<option value="" disabled selected>Filter Devices</option>
							<option value="ios">iOS</option>
							<option value="android">Android</option>
							<option value="ipad">iPad</option>
							<option value="tablet">Tablet</option>
							<option value="macbook">Macbook</option>
							<option value="pc">PC</option>
							<option value="all">All</option>
						</select>
						<button type="submit" class="font_15 filter_options-button" name="searchButton"><i class="fas fa-search"></i></button>
					</form>
				</div>
				<hr>
			</div>

			<div class="row d-flex align-items-start flex-wrap text-center wrapper_view--assets">
				<?php if ($displayFilterResults->num_rows > 0) {
					while($row = $displayFilterResults->fetch_assoc()) {
						$deviceImage = $row['image'];
						$deviceName = $row['name'];
						$deviceAvailability = $row['availability'];
						$deviceId = $row['id'];
				?>
					<div class="col-md-3 col-sm-6 column_grid_container">
						<div class="card">
							<img class="card-img-top" src="<?php echo $deviceImage ?>" alt="">
							<div class="card-body">
								<h4 class="card-title">
									<?php echo $deviceName ?>
								</h4>
								<p class="card-text">
									<?php echo $deviceAvailability ?>
								</p>
								<a class="btn btn-block black_button m-auto" href="user-device-info.php/<?php echo "?deviceID=" . $deviceId ?>">More Info</a>
							</div>
						</div>
					</div>
					<?php
									}
								} else {
										echo "0 results";
						}
					?>
			</div>



		</div>
	</section>
<?php include("../partials/footer.php"); ?>
