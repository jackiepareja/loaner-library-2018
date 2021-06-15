<?php

  function sanitizeRegularForm($inputText){
    return $inputText;
  }

  function sanitizeUsernameForm($inputText){
    $inputText = strip_tags($inputText);
    return $inputText;
  }

  function sanitizePasswordForm($inputText){
    $inputText = strip_tags($inputText);
    return $inputText;
  }

  function sanitizeEmailForm($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = strtolower($inputText);
    return $inputText;
  }

  if(isset($_POST['create_userButton'])) {
    $avatar = sanitizeEmailForm($_POST['create_avatar']);
    $name = sanitizeUsernameForm($_POST['create_username']);
    $email = sanitizeRegularForm($_POST['create_useremail']);
    $password = sanitizePasswordForm($_POST['create_userpassword']);

    $wasSuccessful = $account->createUser($avatar, $name, $email, $password);

    if($wasSuccessful == true) {
      header("Location: admin-view-users.php");
    }
  }

  if(isset($_POST['register_button'])) {
    // initialize sanitizeFunctions
    $avatar = sanitizeEmailForm($_POST['register_avatar']);
    $name = sanitizeUsernameForm($_POST['register_name']);
    $email = sanitizeRegularForm($_POST['register_email']);
    $password = sanitizePasswordForm($_POST['register_password']);

    // Insert into database with the register function
    $wasSuccessful = $account->register($avatar, $name, $email, $password);

    if($wasSuccessful == true) {
      $_SESSION['userLoggedIn'] = $email;
      //header("Location: register.php");
    }

    // EMAIL FUNCTION

    $emailTo_admin = "jacpare@gap.com";
    $email_subject = "WCD Asset Tool New Registration Confirmation";

    $email_message = "Thanks for registering your account! Your account details are below:\n\n";

    function clean_string($string) {
      $bad = array("content-type", "bcc:", "to:", "cc:", "href");
      return str_replace($bad, "", $string);
    }

    $email_message .= "Welcome " . clean_string($name) . "!\n";
    $email_message .= "You can sign in with your email, " . clean_string($email) . " and with your password.\n";
    $email_message .= "This email does not contain your password for security purposes.\n";

    $recipients = array($emailTo_admin, $email);
    $sendAll = implode(',', $recipients);

    $email_headers = "WCD Asset Tool\r\n" . "Reply-To: " . $emailTo_admin . "\r\n" . "X-Mailer: PHP/" . phpversion();
    @mail($sendAll, $email_subject, $email_message, $email_headers);


 ?>
   <div class="m-auto success_msg">
     <span class="font_15 m-auto success_msg-text">Your account was successfully created! <br>
       Please login to access your account. <br>
       <a class="btn black_button mt-3 mb-5" href="/tools/wcd-asset-tool/index.php">Login</a>
     </span>
   </div>

 <?php
   }
 ?>
