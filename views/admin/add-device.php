<?php
	include("../../includes/config.php");
	include("../../includes/classes/Device.php");
	include("../../includes/classes/Constants.php");
	$device = new Device($con);
	include("../../includes/handlers/device-handler.php");
	include("../partials/a-header.php");
	include("../partials/a1-navigation.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}


?>

<section class="newDevice">
	<div class="container">
	<div class="row"><a class="btn black_button" href="admin-view-devices.php">Go Back</a></div>
	<div class="row newDevice_container form_container">
		<h1 class="text-center pt-4" style="width: 100%; margin: 1rem auto">Create New Device</h1>


		<div class="form_container-wrapper">
			<form action="add-device.php" method="POST" style="margin: 1rem auto" class="pb-4">
				<div class="form-group">
					<?php echo $device->getError(Constants::$deviceNameChar); ?>
					<input id="device_name" class="form-control" type="text" name="device_name" placeholder="Device name" value="<?php getInputValue('device_name') ?>" />
				</div>
				<div class="form-group">
					<?php echo $device->getError(Constants::$imageURL) ?>
					<input id="device_image" class="form-control"  type="text" name="device_image" placeholder="Device image url" value="<?php getInputValue('device_image') ?>" />
				</div>
				<div class="form-group">
					<?php echo $device->getError(Constants::$serialAlpha); ?>
					<input id="deviceSerial" class="form-control"  type="text" name="deviceSerial" placeholder="Device serial no" value="<?php getInputValue('device_serial') ?>" />
				</div>
				<div class="form-group">
					<?php echo $device->getError(Constants::$notesChar) ?>
    				<textarea id="device_notes" class="form-control" name="device_notes" rows="3" placeholder="Device notes" value="<?php getInputValue('device_notes') ?>"></textarea>
  			</div>
				<div class="form-group mb-5">
					<?php echo $device->getError(Constants::$availChar) ?>
					<select id="device_availability" class="form-control" name="device_availability" value="<?php getInputValue('device_availability') ?>">
						<option selected disabled>Choose Availability</option>
						<option>Available</option>
						<option>Not Available</option>
					</select>
				</div>
				<div class="form-group mb-5">
					<?php echo $device->getError(Constants::$catChar) ?>
					<select id="device_category" class="form-control" name="device_category" value="<?php getInputValue('device_category') ?>">
						<option selected disabled>Choose Category</option>
						<option>ios</option>
						<option>android</option>
						<option>ipad</option>
						<option>tablet</option>
						<option>macbook</option>
						<option>pc</option>
						<option>all</option>
						<!-- <option>Mobile</option>
						<option>Tablet</option>
						<option>Desktop</option> -->
					</select>
				</div>
				<button type="submit" name="createDevice_button" class="btn btn-lg black_button btn-block m-auto">Submit!</button>
			</form>

		</div>

	</div>
</div>
</section>

<?php include("../partials/footer.php"); ?>
