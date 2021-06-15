<?php
  // Sanitize device forms
  function sanitizeTags($inputText) {
    $inputText = strip_tags($inputText);
    return $inputText;
  }

  if(isset($_POST['createDevice_button'])) {
    $deviceName = sanitizeTags($_POST['device_name']);
    $deviceImage = sanitizeTags($_POST['device_image']);
    $deviceSerial = sanitizeTags($_POST['deviceSerial']);
    $deviceAvail = sanitizeTags($_POST['device_availability']);
    $deviceNotes = sanitizeTags($_POST['device_notes']);
    $deviceCat = sanitizeTags($_POST['device_category']);

    $wasSuccessful = $device->createDevice($deviceName, $deviceImage, $deviceSerial, $deviceAvail, $deviceNotes, $deviceCat);


    if($wasSuccessful == true){
      header("Location: admin-view-devices.php");
      echo "submission successful";
    } else {
      echo "submission fail";
    }
  }




 ?>
