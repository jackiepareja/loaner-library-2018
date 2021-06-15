<?php
include("../../includes/config.php");
include("../../includes/classes/Account.php");
$account = new Account($con);
include("../partials/a2-header.php");
include("../partials/a2-navigation.php");

$id = $_GET["userID"];
$query = "SELECT * FROM `users` WHERE id = $id";
$result = mysqli_query($con, $query);

?>
<section class="viewUser">

		<div class="container box-shadow">
			<a class="btn black_button" href="/tools/wcd-asset-tool/views/admin/admin-view-users.php">Go Back</a>

			<div class="row">
				<div class="col bold viewUser_top"><h2 class="text-center">User</h2></div>
			</div>
			<div class="row">
				<?php
					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$userID = $row['id'];
							$userImage = $row['image'];
							$userName = $row['name'];
							$userEmail = $row['email'];
							$userPW = $row['passphrase'];
							$userSignupDate = $row['signupDate'];
				?>
					<div class="col m-auto text-center viewDevice_middle">
						<!-- https://png.pngtree.com/svg/20170602/0db185fb9c.png -->
						<img class="viewDevice_middle-image" src="<?php echo $userImage ?>" alt="" />
					</div>
					<div class="col container">

						<p class="list header_primary">
							<span class="bold">Name:</span>
							<?php  echo $userName ?>
						</p>
						<p class="list header_primary">
							<span class="bold">Email:</span>
							<?php  echo $userEmail ?>
						</p>
						<p class="list font_20">
							<span class="bold">Passphrase:</span>
							<?php  echo $userPW ?>
						</p>
						<p class="list font_20">
							<span class="bold">Created On:</span>
							<?php  echo $userSignupDate ?>
						</p>
						<p class="edit_buttons">
							<a href="/tools/wcd-asset-tool/views/admin/edit-user.php/<?php echo  "?userID=" . $userID ?>" class="btn-alt font_22"><i class="fas fa-edit"></i></a>
						</p>

						<?php
										}
									} else {
											echo "0 results";
							}
						?>



					</div>
			</div>
		</div>

	</section>
<?php include("../partials/footer.php"); ?>
