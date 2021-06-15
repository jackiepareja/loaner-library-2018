<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

  include("includes/config.php");
  include("includes/classes/Account.php");
  include("includes/classes/Constants.php");
  $account = new Account($con);
  include("views/partials/main-header.php");
  include("includes/handlers/register-handler.php");

  function getInputValue($name) {
    if(isset($_POST[$name])) {
      echo $_POST[$name];
    }
  }

?>

<section class="newUser">
<div class="container">
<div class="row"><a class="btn black_button" href="/tools/wcd-asset-tool">Go Back</a></div>
<div class="row newUser_container form_container">
  <h1 class="text-center pt-4" style="width: 100%; margin: 1rem auto">Create New Account</h1>
  <div id="register" class="form_container-wrapper">


    <form id="register_form" action="register.php" method="POST" style="margin: 1rem auto" class="pb-4">
      <div style="display: none;" class="form-group mb-3">
        <label class="form_label font_15" for="register_avatar">Image URL:</label>
        <?php echo $account->getError(Constants::$imageFiletype); ?>
        <input id="register_avatar" class="form-control" type="text" name="register_avatar" placeholder="image" value="https://png.pngtree.com/svg/20170602/0db185fb9c.png" required/>
      </div>
      <div class="form-group mb-3">
        <label class="form_label font_15" for="register_name">Full Name:</label>
        <?php echo $account->getError(Constants::$nameCharacters); ?>
        <input id="register_name" class="form-control" type="text" name="register_name" placeholder="Enter name" value="<?php getInputValue('register_name') ?>" required/>
      </div>
      <div class="form-group mb-3">
        <label class="form_label font_15" for="register_email">Email:</label>
        <?php echo $account->getError(Constants::$emailInvalid); ?>
        <?php echo $account->getError(Constants::$emailTaken); ?>
        <input id="register_email" class="form-control" type="email" name="register_email" placeholder="Enter email" value="<?php getInputValue('register_email') ?>" required/>
      </div>
      <div class="form-group mb-3">
        <label class="form_label font_15" for="register_password">Password:</label>
        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
        <?php echo $account->getError(Constants::$passwordCharacters); ?>
        <input id="register_password" class="form-control" type="password" name="register_password" placeholder="Enter password" value="<?php getInputValue('register_password') ?>" required/>
      </div>



      <button type="submit" name="register_button" class="btn btn-lg black_button btn-block m-auto">Sign Up</button>
    </form>

  </div>

</div>
</div>
</section>

<?php
include("views/partials/footer.php");
?>
