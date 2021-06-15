<?php
  class Account {

    private $con;
    private $errorArray;

    public function __construct($con) {
      $this->con = $con;
      $this->errorArray = array();
    }

    public function login ($em, $pw) {
      $pw = md5($pw);

      $query = "SELECT * FROM users WHERE email = '$em' AND passphrase ='$pw'";
      $result = mysqli_query($this->con, $query);
      if(mysqli_num_rows($result) == 1){
        return true;
      }
      else {
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
      }
    }

    public function register($av, $nm, $em, $pw){
      $this->validateAvatar($av);
      $this->validateName($nm);
      $this->validateEmail($em);
      $this->validatePassword($pw);

      if(empty($this->errorArray) == true) {
        return $this->insertUserDetails($av, $nm, $em, $pw);
      }
      else {
        return false;
      }
    }

    public function createUser($av, $nm, $em, $pw) {
      $this->validateAvatar($av);
      $this->validateName($nm);
      $this->validateEmail($em);
      $this->validatePassword($pw);

      if(empty($this->errorArray) == true) {
        return $this->createInsertUserDetails($av, $nm, $em, $pw);
      }
      else {
        return false;
      }
    }

    public function getError($error) {
      if(!in_array($error, $this->errorArray)) {
        $error = "";
      }
      return "<span class='errorMessage'>$error</span>";
    }

    //======================================================
    // CREATE/POST persistent data
    //======================================================
    private function insertUserDetails($av, $nm, $em, $pw) {
      $encryptedPw = md5($pw);
      $date = date("Y-m-d");
      //$con = mysqli_connect("localhost", "root", "root", "asset_tool");

      $query = "INSERT INTO users (image, name, email, passphrase, signupDate) VALUES('$av', '$nm', '$em', '$encryptedPw', '$date')";
      $result = mysqli_query($this->con, $query);
      return $result;
    }

    private function createInsertUserDetails($av, $nm, $em, $pw) {
      $encryptedPw = md5($pw);
      $date = date("Y-m-d");

      $query = "INSERT INTO users (image, name, email, passphrase, signupDate) VALUES ('$av', '$nm', '$em', '$encryptedPw', '$date')";
      $result = mysqli_query($this->con, $query);
      return $result;
    }


    //======================================================
    // VALIDATIONS
    //======================================================
    private function validateAvatar($av){
      if (($av == "image/gif" || $av == "image/jpeg" || $av == "image/jpg" || $av == "image/png")) {
        array_push($this->errorArray, Constants::$imageFiletype);
        return;
      }
    }

    private function validateName($nm){
      if(strlen($nm) > 25 || strlen($nm) < 5) {
        array_push($this->errorArray, Constants::$nameCharacters);
        return;
      }
    }

    private function validateEmail($em){
      if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
        array_push($this->errorArray, Constants::$emailInvalid);
        return;
      }

      $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$em'");
      if(mysqli_num_rows($checkEmailQuery) != 0) {
        array_push($this->errorArray, Constants::$emailTaken);
        return;
      }
    }

    private function validatePassword($pw){
      if(preg_match('/[^A-Za-z0-9]/', $pw)) {
        array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
        return;
      }

      if(strlen($pw) > 30 || strlen($pw) < 8) {
        array_push($this->errorArray, Constants::$passwordCharacters);
        return;
      }
    }
  }
 ?>
