<?php
  if(isset($_POST['logout_button'])) {
    session_destroy();
    echo "Your session has been destroyed! You've been logged out!";
    header("Location: tools/wcd-asset-tool/index.php");
  }
  ?>
