<?php
    include("../includes/config.php");
    include("partials/header.php");
    include("partials/navigation.php");
    $getLoansQuery = "SELECT * FROM `loans1`";
    $loans = mysqli_query($con, $getLoansQuery);
?>

<section class="viewUsers">
	<?php
		include("partials/table-header-admin-loans.php");
		include("partials/tab-navigation.php");
	?>
						<tr class="text-center font_13">
              <?php
                if($loans->num_rows > 0) {
                  while($row = $loans->fetch_assoc()) {
                    $loanID = $row['id'];
                    $loanDevice = $row['deviceName'];
                    $loanUser = $row['userName'];
                    $loanCheckout = $row['checkout'];
                    $loanCheckin = $row['checkin'];
               ?>
							<td>
								<?php echo $loanID ?>
							</td>
							<td>
								<?php echo $loanDevice ?>
							</td>
              <td>
								<?php echo $loanUser ?>
							</td>
              <td>
								<?php echo $loanCheckout ?>
							</td>
              <td>
								<?php echo $loanCheckin ?>
							</td>
						</tr>
            <?php
                    }
                  } else {
                      echo "0 results";
              }
            ?>
					</tbody>

			</table>
		</div>
	</section>

  <?php include("partials/footer.php"); ?>
