<?php
  class Loans {

    private $con;
    private $id;

    public function __construct($con, $id) {
      $this->con = $con;
      $this->id = $id;
    }

    // retrieve the name
    public function getCheckout(){
      //$loanQuery = "SELECT * FROM `loans` WHERE deviceName='$deviceID'";
      $loanQuery = "SELECT * FROM `loans` WHERE deviceName='$this->id'";
      $loanResult = mysqli_query($this->con, $loanQuery);
      $loan = mysqli_fetch_array($loanResult);
      $loanerID = $loan['checkout'];
      return $loanerID;
    }

    public function getCheckin(){
      //$loanQuery = "SELECT * FROM `loans` WHERE deviceName='$deviceID'";
      $loanQuery = "SELECT * FROM `loans` WHERE deviceName='$this->id'";
      $loanResult = mysqli_query($this->con, $loanQuery);
      $loan = mysqli_fetch_array($loanResult);
      $loanerID = $loan['checkin'];
      return $loanerID;
    }
  }
