<?php
$baseurl = "http://localhost/samadhaan/";
if(!isset($_REQUEST['submit'])){
    //header("Loaction:".$baseurl."index.html");
    exit();
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$hnum = $_POST['hnum'];
$colony = $_POST['colony'];
$ward = $_POST['colony'];
$phone = $_POST['phone'];
$complain = $_POST['complain'];

//form checking to be done...

//connect to db
require 'connectdb.inc.php';
use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\Exception;
use Parse\ParseObject;

try {
  $obj = new ParseObject("Complain");

//$obj->set("adhaar", "A string");
$obj->set("status", "Pending");
$obj->set("complaint", $complain);
$obj->set("officer", "none");
$obj->set("phone", "$phone");
$obj->set("name", $fname." ".$lname);
$obj->set("remarks", "");
$obj->set("colony", $colony);
$obj->set("village", $ward);
$obj->set("house", $hnum);

  $obj->save();
  header("Loaction: ".$baseurl."complaint.php?err=noerr");
  //echo 'New object created with objectId: ' . $obj->getObjectId();
} catch (ParseException $ex) {
    header("Location: ".$baseurl."complaint.php?err=err");
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  //echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}

