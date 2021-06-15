<?php
	include("../../includes/config.php");
	include("../../includes/classes/Device.php");
	include("../../includes/classes/Constants.php");
	//$con = mysqli_connect("10.8.40.43", "assetMgmt", "assetPassword", "wcd_asset_management");
	$device = new Device($con);
	include("../../includes/handlers/device-handler.php");
	include("../partials/a2-header.php");
	include("../partials/a2-navigation.php");

	if(isset($_GET['deviceID'])) {
		$deviceID = $_GET['deviceID'];
		//echo $deviceID;
	}
	else {
		echo "ID is not set";
	}



	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}

	if(isset($_POST['editDevice_button'])) {
		$deviceName = $_POST['device_name'];
		$deviceImage = $_POST['device_image'];
		$deviceSerial = $_POST['device_serial'];
		$deviceAvail = $_POST['device_availability'];
		$deviceNotes = $_POST['device_notes'];
		$deviceCat = $_POST['device_category'];
		$deviceID = $_GET['deviceID'];

		$editDeviceQuery = "UPDATE devices SET name='$deviceName', image='$deviceImage', serialNo='$deviceSerial', availability='$deviceAvail', notes='$deviceNotes', category='$deviceCat' WHERE id='$deviceID'";
		$editDeviceResult = mysqli_query($con, $editDeviceQuery);

		header("Location: /tools/wcd-asset-tool/views/admin/admin-view-devices.php");

	}

	$query = "SELECT * FROM `devices`";
  $result = mysqli_query($con, $query);
  
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $deviceID = $row['id'];
      $deviceImage = $row['image'];
      $deviceName = $row ['name'];
      $deviceNotes = $row ['notes'];
      $deviceAvailability = $row ['availability'];
      $deviceSerial = $row ['serialNo'];
      $deviceCat = $row ['category'];

    }
  }


?>
<section class="editDevice">
	<div class="container">
	<div class="row"><a class="btn black_button" href="/tools/wcd-asset-tool/views/admin/admin-view-devices.php">Go Back</a></div>
	<div class="row newDevice_container">
		<h1 class="text-center pt-4" style="width: 100%; margin: 1rem auto">Edit Device</h1>

		<div style="width: 30%; margin: auto;">
			<form action="/tools/wcd-asset-tool/views/admin/edit-device.php/<?php echo  "?deviceID=" . $deviceID ?>" method="POST" style="margin: 1rem auto" class="pb-4">
				<div class="form-group">
					<label class="font_15" for="device_name">Name:</label>
					<input id="device_name" class="form-control" type="text" name="device_name" placeholder="<?php echo $deviceName ?>" value="<?php echo $deviceName ?>"  required/>
				</div>
				<div class="form-group">
					<label class="font_15" for="device_image">Image URL:</label>
					<?php echo $device->getError(Constants::$imageFiletype); ?>
					<input id="device_image" class="form-control"  type="text" name="device_image" placeholder="<?php echo $deviceImage ?>" value="<?php echo $deviceImage ?>"  required/>
					
				</div>
				<div class="form-group">
					<label class="font_15" for="device_serial">Serial No:</label>
					<input id="device_serial" class="form-control"  type="text" name="device_serial" placeholder="<?php echo $deviceSerial ?>" value="<?php echo $deviceSerial ?>" required/>
				</div>
				<div class="form-group">
					<label class="font_15" for="device_notes">Notes:</label>
    				<textarea id="device_notes" class="form-control" name="device_notes" rows="3" placeholder="<?php echo $deviceNotes ?>" value="<?php echo $deviceNotes ?>"></textarea>
  				</div>
				<div class="form-group mb-5">
					<label class="font_15" for="device_availability">Availability:</label>
					<select id="device_availability" class="form-control" name="device_availability" placeholder="<?php echo $deviceAvailability ?>" value="<?php echo $deviceAvailability ?>">
						<option>Available</option>
						<option>Not Available</option>
					</select>
				</div>
				<div class="form-group mb-5">
					<label class="font_15" for="device_category">Category:</label>
					<select id="device_category" class="form-control" name="device_category" value="<?php echo $deviceCat ?>">
						<option>ios</option>
						<option>android</option>
						<option>ipad</option>
						<option>tablet</option>
						<option>macbook</option>
						<option>pc</option>
						<option>all</option>
					</select>
				</div>
				<button type="submit" name="editDevice_button" class="btn btn-lg black_button btn-block m-auto">Submit!</button>
			</form>

		</div>

	</div>
</div>
</section>

<?php include("../partials/footer.php"); ?>
