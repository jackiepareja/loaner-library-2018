<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  include("includes/config.php");
  include("includes/classes/Account.php");
  include("includes/classes/Constants.php");
  $account = new Account($con);
  include("includes/handlers/login-handler.php");
  include("views/partials/main-header.php");

  function getInputValue($name) {
    if(isset($_POST[$name])) {
      echo $_POST[$name];
    }
  }

  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
  }
  else {
    // header("Location: index.php");
  }
?>


<div class="container">
	<section id="landing">

		<form class="landing_form" action="index.php" method="POST">
			<h2 class="landing_form--welcome font_30">Welcome</h2>
			<div class="form-group">

				<label class="form_label" for="login_email">Email address</label>
        <?php echo $account->getError(Constants::$loginFailed); ?>
				<input id="login_email" type="email" name="login_email" class="form-control" placeholder="Enter email" value="<?php getInputValue('login_email') ?>" required>
			</div>
			<div class="form-group">
				<label class="form_label" for="login_password">Password</label>
				<input id="login_password" type="password" name="login_password" class="form-control" placeholder="Password" required>
			</div>
			<div class="button_container">
				<button type="submit" name="login_button" class="btn black_button button_container-login">Login</button>

			</div>
      <div class="signup_container">
        <a class="signup_container-signup font_15" href="register.php">Sign Up</a>

        <a class="signup_container-forgot font_15" href="support_ticket.php">Help</a>
      </div>

		</form>

	</section>
</div>

<?php
  include("views/partials/footer.php");
?>
