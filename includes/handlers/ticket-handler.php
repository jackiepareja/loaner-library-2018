<?php
if(isset($_POST['support_button'])) {

  $email_to = "jacpare@gap.com";
  $email_subject = "WCD Asset Tool Support Ticket";

  function died($error) {
    echo "There are errors in the form that you submitted <br>";
    echo $error . "<br>";
    die();
  }

  if(!isset($_POST['ticketForm_name']) ||
     !isset($_POST['ticketForm_email']) ||
     !isset($_POST['ticketForm_headline']) ||
     !isset($_POST['ticketForm_message'])) {
       died("There are errors in the form you submitted");
     }

  $name = $_POST["ticketForm_name"];
  $email_from = $_POST["ticketForm_email"];
  $headline = $_POST["ticketForm_headline"];
  $message = $_POST["ticketForm_message"];

  $error_message = "";
  $email_validation = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_validation, $email_from)) {
    $error_message .= "The email you provided is not in the correct format.";
  }

  $email_message = "Support Ticket details below:\n\n";

  function clean_string($string) {
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad,"",$string);
  }

  $email_message .= "Name: " . clean_string($name) . "\n";
  $email_message .= "Email: " . clean_string($email_from) . "\n";
  $email_message .= "Issue: " . clean_string($headline) . "\n";
  $email_message .= "Details: " . clean_string($message) . "\n";

  $email_headers = "From: " . $email_from . "\r\n" . "Reply-To: " . $email_from . "\r\n" . "X-Mailer: PHP/" . phpversion();
  @mail($email_to, $email_subject, $email_message, $email_headers);
?>
<div class="m-auto success_msg">
  <span class="font_20 m-auto success_msg-text">Thank you for sending a support ticket. Someone will be in touch shortly.</span>
</div>
<?php
}
?>
