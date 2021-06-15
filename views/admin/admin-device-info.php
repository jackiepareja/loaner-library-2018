<?php
	include("../../includes/config.php");
	include("../../includes/classes/Device.php");
	include("../partials/a2-header.php");
	include("../partials/a2-navigation.php");

	if(isset($_GET['deviceID'])) {
		$deviceID = $_GET['deviceID'];
	}
	else {
		echo "ID is not set";
	}

	$deviceQuery = "SELECT * FROM `devices` WHERE id='$deviceID'";
	$devicesResult = mysqli_query($con, $deviceQuery);
	$devices = mysqli_fetch_array($devicesResult);

	$loanQuery = "SELECT * FROM `loans1` WHERE deviceName='$deviceID'";
	$loanResult = mysqli_query($con, $loanQuery);
	$loan = mysqli_fetch_array($loanResult);
	$loanerID = $loan['userName']; // userName is the email number

	$userQuery = "SELECT * FROM `users` WHERE id='$loanerID'";
	$userResult = mysqli_query($con, $userQuery);
	$user = mysqli_fetch_array($userResult);




?>

<section class="viewDevice">

		<div class="container box-shadow">
			<a class="btn black_button" href="/tools/wcd-asset-tool/views/admin/admin-view-devices.php">Go Back</a>

			<div class="row">
				<div class="col bold viewDevice_top"><h2 class="text-center"><?php echo $devices['availability'] ?></h2></div>
			</div>
			<div class="row">
					<div class="col m-auto text-center viewDevice_middle">
						<img class="viewDevice_middle-image" src="<?php echo $devices['image'] ?>" alt="" />

					</div>
					<div class="col container">
						<p class="list header_primary">
							<span class="bold">Device Name:</span>
							<?php echo $devices['name'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Serial No:</span>
							<?php echo $devices['serialNo'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Notes:</span>
							<?php echo $devices['notes'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Loaner:</span>
							<?php echo $user['email']?>
						</p>
						<p class="list font_20">
							<span class="bold">Checkout Date:</span>
							<?php echo $loan['checkout'] ?>
						</p>
						<p class="list font_20">
							<span class="bold">Checkin Date:</span>
							<?php echo $loan['checkin']; ?>
						</p>
						<p class="list font_20">
						 <span class="bold">Reason:</span>
						 <?php echo $loan['reason']; ?>
					 </p>
						<p class="edit_buttons">
							<a href="/tools/wcd-asset-tool/views/admin/edit-device.php/<?php echo  "?deviceID=" . $deviceID ?>" class="btn-alt font_22" <?php if($devices['availability'] == "Not Available") {
								?> style="display: none;" <?php } ?> ><i class="fas fa-edit"></i></a>
						</p>




					</div>
			</div>
		</div>
	</section>

<?php include("../partials/footer.php"); ?>
