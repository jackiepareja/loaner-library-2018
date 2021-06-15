<?php
  class Device {

    private $con;
    private $errorArray;

    public function __construct($con) { // constructor is called when class Device is called.
      $this->con = $con;
      $this->errorArray = array(); // access private $errorArray and turns it into an empty array;
    }

    public function createDevice($deviceNm, $image, $deviceSr, $avail, $notes, $cat) {
      $this->validateDeviceNameLen($deviceNm);
      $this->validateImageURL($image);
      $this->validateSerialNo($deviceSr);
      $this->validateAvail($avail);
      $this->validateNotes($notes);
      $this->validateCat($cat);


      if(empty($this->errorArray) == true) {
        return $this->insertDeviceDetails($deviceNm, $image, $deviceSr, $avail, $notes, $cat);
      }
      else {
        return false;
      }
    }

    public function editDevice($deviceNm, $image, $deviceSr, $avail, $notes, $cat) {
      $this->validateDeviceNameLen($deviceNm);
      $this->validateImageURL($image);
      $this->validateSerialNo($deviceSr);
      $this->validateAvail($avail);
      $this->validateNotes($notes);
      $this->validateCat($cat);

      if(empty($this->errorArray) == true) {
        return $this->editDeviceDetails($deviceNm, $image, $deviceSr, $avail, $notes, $cat);
      }
      else {
        return false;
      }

    }

    public function getError($error) {
      // if there isn't an error in the error array, error will return an empty string.
      if(!in_array($error, $this->errorArray)) {
        $error = "";
      }
      return "<span class='errorMessage'>$error</span>";
    }
    //======================================================
    // CREATE/POST persistent data
    //======================================================
    private function insertDeviceDetails($deviceNm, $image, $deviceSr, $avail, $notes, $cat) {
      // $deviceID = $_GET['deviceID'];
      $query = "INSERT INTO devices (name, image, serialNo, availability, notes, category) VALUES('$deviceNm', '$image', '$deviceSr', '$avail', '$notes', '$cat')";
      $result = mysqli_query($this->con, $query);
      return $result;
    }

    // public function editDeviceDetails($deviceNm, $image, $deviceSr, $avail, $notes) {
    //   $deviceID = $_GET['deviceID'];
    //   $editDeviceQuery = "UPDATE devices SET name='$deviceNm', image='$image', serialNo='$deviceSr', availability='$avail', notes='$notes' WHERE id='$deviceID'";
    //   echo $editDeviceQuery;
    //   $editDeviceResult = mysqli_query($this->con, $editDeviceQuery);
    //   return $editDeviceResult;
    // }

    //======================================================
    // VALIDATIONS
    //======================================================
    private function validateDeviceNameLen($deviceNm) {
      if(strlen($deviceNm) > 30 || strlen($deviceNm) < 3){ // if true, the message below is stored into the $errorArray array.
        array_push($this->errorArray, Constants::$deviceNameChar);
        return;
      }
    }

    private function validateImageURL($image) {
      if(!filter_var($image, FILTER_VALIDATE_URL)) {
        array_push($this->errorArray, Constants::$imageURL);
        return;
      }
    }


    private function validateSerialNo($deviceSr){
      if(preg_match('/[^A-Za-z0-9]/', $deviceSr)) {
        array_push($this->errorArray, Constants::$serialAlpha);
        return;
      }
    }

    private function validateNotes($notes){
      if(strlen($notes) > 30 || strlen($notes) < 1){ // if true, the message below is stored into the $errorArray array.
        array_push($this->errorArray, Constants::$notesChar);
        return;
      }
    }

    private function validateAvail($avail){
      if(!ctype_alpha($avail)) {
        array_push($this->errorArray, Constants::$availChar);
        return;
      }
    }

    private function validateCat($cat){
      if(!ctype_alpha($cat)) {
        array_push($this->errorArray, Constants::$catChar);
        return;
      }
    }




  }
 ?>
