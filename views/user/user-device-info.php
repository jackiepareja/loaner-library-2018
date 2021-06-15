<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
	include("../../includes/config.php");
	include("../../includes/classes/Device.php");
	include("../partials/u2-header.php");
	include("../partials/u2-navigation.php");

	if(isset($_GET['deviceID'])) {
		$deviceID = $_GET["deviceID"];
	}

	$getDeviceQuery = "SELECT * FROM `devices` WHERE id = '$deviceID'";
	$devicesResult = mysqli_query($con, $getDeviceQuery);
	$device = mysqli_fetch_array($devicesResult);

	$loanQuery = "SELECT * FROM loans1 WHERE deviceName='$deviceID'";
	$loanResult = mysqli_query($con, $loanQuery);
	$loan = mysqli_fetch_array($loanResult);
	$loanerID = $loan['userName'];

	$userQuery = "SELECT * FROM users WHERE id='$loanerID'";
	$userResult = mysqli_query($con, $userQuery);
	$user = mysqli_fetch_array($userResult);



	if(isset($_POST['checkin_button'])) {
		$loanID = $loan['id'];

		$deleteLoanQuery = "DELETE FROM loans1 WHERE id='$loanID'";
		$deleteLoanResult = mysqli_query($con, $deleteLoanQuery);

		$Available = "Available";

		$updateDeviceAvailQuery = "UPDATE devices SET availability='$Available' WHERE id='$deviceID'";
		$updateDeviceResult = mysqli_query($con, $updateDeviceAvailQuery);

		header("Refresh:0");
	}

?>



	<section class="viewDevice">

		<div class="container box-shadow">
			<a class="btn black_button" href="/tools/wcd-asset-tool/views/user/user-view-devices.php">Go Back</a>

			<div class="row">
				<div class="col bold viewDevice_top"><h2 class="text-center"><?php echo $device['availability'] ?></h2></div>
			</div>
			<div class="row">
					<div class="col m-auto text-center viewDevice_middle">
						<img class="viewDevice_middle-image" src="<?php echo $device['image'] ?>" alt="" />
					</div>
					<div class="col container">
						<p class="list header_primary">
							<span class="bold">Device Name:</span>
							<?php echo $device['name'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Serial No:</span>
							<?php echo $device['serialNo'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Notes:</span>
							<?php echo $device['notes'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Borrower:</span>
							<?php echo $user['email'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Reason:</span>
							<?php echo $loan['reason'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Borrow Date:</span>
							<?php echo $loan['checkout'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Return Date:</span>
							<?php echo $loan['checkin'] ?>
						</p>
						<p>
							<a id="loan_button" class="btn btn-outline-info font_15" href="/tools/wcd-asset-tool/views/user/checkout.php/<?php echo '?deviceID=' . $device['id'] ?>">Loan Device</a>
							<form class="form_return_button" action="/tools/wcd-asset-tool/views/user/user-device-info.php/<?php echo  "?deviceID=" . $deviceID ?>" method="POST">
								<button id="return_button" class="btn btn-outline-success font_15" name="checkin_button" type="submit" <?php if($device['availability'] != "Available" && $userLoggedIn != $user['email']) {
									?> disabled <?php } ?> >Return Device</button>
							</form>


						</p>

					</div>
			</div>
		</div>
	</section>
	<?php
		if($device['availability'] == 'Available'){
	?>
		<script>
			document.getElementById('return_button').style.display = "none";
		</script>
	<?php
		}
		else {
	?>
		<script>
			document.getElementById('loan_button').style.display = "none";
		</script>
	<?php
		}
	?>

<?php include("../partials/footer.php"); ?>
