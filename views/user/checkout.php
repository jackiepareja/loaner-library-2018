<?php
	include("../../includes/config.php");
	include("../../includes/classes/Device.php");
	$device = new Device($con);
	include("../../includes/handlers/device-handler.php");
	include("../partials/u2-header.php");
	include("../partials/u2-navigation.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}

	if(isset($_GET['deviceID'])) {
		$deviceID = $_GET['deviceID'];
	}
	else {
		echo "ID is not set";
	}

	$selectUserLoggedInQuery = "SELECT * FROM users WHERE email='$userLoggedIn'";
	$userLoggedResult = mysqli_query($con, $selectUserLoggedInQuery);
	$users = mysqli_fetch_array($userLoggedResult);
	$userID = $users['id'];

	if(isset($_POST['checkout_button'])) {
		$checkout = $_POST['checkout_date'];
		$checkin = $_POST['checkin_date'];
		$reason = $_POST['reason'];


		$updateLoanTableQuery = "INSERT INTO loans1 (deviceName, userName, checkout, checkin, reason) VALUES ('$deviceID', '$userID', '$checkout', '$checkin', '$reason')";
		$updateLoanResult = mysqli_query($con, $updateLoanTableQuery);
		$notAvailable = "Not Available";

		$updateDeviceAvailQuery = "UPDATE devices SET availability='$notAvailable' WHERE id='$deviceID'";
		$updateDeviceResult = mysqli_query($con, $updateDeviceAvailQuery);

		header("Location: /tools/wcd-asset-tool/views/user/user-device-info.php/?deviceID=$deviceID"  );

		// reminder email for returning a device
		// email confirmation that you checked out a device and to return it on this date.
		// $name = $users['name'];
		// $email_to = $userLoggedIn;
		// $email_subject = "WCD Device Checkout Confirmation";
		//
		// function died($error) {
		// 	echo "There are errors in the checkout form that you submitted <br>";
		// 	echo $error . "<br>";
		// 	die();
		// }
		//
		// if(!isset($_POST['checkout_date']) ||
		// 	 !isset($_POST['checkin_date'])) {
		// 		 died("There are errors in the form you submitted");
		// 	 }
		//
		// // $checkout = $_POST["checkout_date"];
		// // $checkin = $_POST["checkin_date"];
		//
		// $error_message = "";
		//
		// $email_message = "Device Details Below:\n\n";
		//
		// function clean_string($string) {
		// 	$bad = array("content-type", "bcc:", "to:", "cc:", "href");
		// 	return str_replace($bad,"",$string);
		// }
		//
		// $email_message .= "This is your confirmation email that you've successfully checked out a device on " . clean_string($checkout) . "\n\n";
		// $email_message .= "Your return date is confirmed for " . clean_string($checkin) . " \n\n";
		//
		// $email_headers = "No-reply Mail.\r\n" . " Please contact your administrator for support. " . ""
	}



?>

<section class="newUser">
	<div class="container">
	<div class="row"><a class="btn black_button" href="/tools/wcd-asset-tool/views/user/user-view-devices.php">Go Back</a></div>
	<div class="row newUser_container form_container">
		<h1 class="text-center pt-4" style="width: 100%; margin: 1rem auto">Checkout Device</h1>


		<div class="form_container-wrapper">
			<form action="/tools/wcd-asset-tool/views/user/checkout.php/<?php echo  "?deviceID=" . $deviceID ?>" method="POST" style="margin: 1rem auto" class="pb-4">
			<div class="form-group mb_5">
				<label for="checkout_date" class="font_15">Loan Start Date:</label>
				<input id="checkout_date" class="form-control" type="date" name="checkout_date" required />
			</div>
			<div class="form-group">
				<label for="checkin_date" class="font_15">Loan Return Date:</label>
				<input id="checkin_date" class="form-control" type="date" name="checkin_date" required />
			</div>
			<div class="form-group">
				<label for="reason" class="font_15">Reason:</label>
				<textarea id="reason" class="form-control" name="reason" rows="8" cols="80" placeholder="Type your reason here..." required></textarea>
			</div>



			<button id="checkout_button" type="submit" name="checkout_button" class="btn btn-lg black_button btn-block m-auto">Submit!</button>
		</form>

		</div>

	</div>
</div>
</section>
<?php include("../partials/footer.php"); ?>
<script src="../../../public/js/app.js?v=2"></script>
