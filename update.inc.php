<?php
session_start();
$remark = $_POST['remark'];
if(isset($_POST['officer'])){
$officer = $_POST['officer'];
}
if(isset($_POST['action'])){
$status = $_POST['action'];
}
$objectid = $_POST['objectid'];
require 'connectdb.inc.php';

use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\Exception;
use Parse\ParseObject;
use Parse\ParseUser;

$query = new ParseQuery("Complain");
$obj = $query->get($objectid);
try {
if(strcmp($_SESSION['role'],"admin") == 0){

  $rem = $obj->get('remarks');
  if(!empty($remark) && !empty($rem)){
  $rem = $rem." ";
    if(strcmp($_SESSION['role'],"admin") == 0){
        $rem = $rem."Administrator- ".$remark;
    }
    else{
        $rem = $rem."Officer- ".$remark;
    }
  }
  else{
      $rem = "Administrator- ".$remark;
  }
  // The object was retrieved successfully.

  // Update any data you want with the "set" method,
  // providing the attribute name and the new value
  //$obj->set("adhaar", "A string");
  //$obj->set("status", "A string");
 // $obj->set("complaint", "A string");
  $obj->set("officer", $officer);
  //$obj->set("phone", "A string");
  //$obj->set("name", "A string");
  $obj->set("remarks", $rem);
  //$obj->set("colony", "A string");
  //$obj->set("village", "A string");
  //$obj->set("house", "A string");
  //$obj->set("address", "A string");

  // And then save your changes
  $obj->save();
  echo "Update Successful Admin";
}
else{
  $rem = $obj->get('remarks');
  if(!empty($remark)){
  $rem = $rem." ";
    if(strcmp($_SESSION['role'],"admin") == 0){
        $rem = $rem."Administrator- ".$remark;
    }
    else{
        $rem = $rem."Officer- ".$remark;
    }
  }
  else{
      $rem = "Administrator- ".$remark;
  }
  echo $rem.'<br>';
  // The object was retrieved successfully.

  // Update any data you want with the "set" method,
  // providing the attribute name and the new value
  //$obj->set("adhaar", "A string");
  $obj->set("status", $status);
  //echo 'Prob2';
 // $obj->set("complaint", "A string");
  //$obj->set("officer", $officer);
  //$obj->set("phone", "A string");
  //$obj->set("name", "A string");
  $obj->set("remarks", $rem);
  echo 'Prob3';
  //$obj->set("colony", "A string");
  //$obj->set("village", "A string");
  //$obj->set("house", "A string");
  //$obj->set("address", "A string");

  // And then save your changes
  $obj->save();
  echo "Update Successful Officer";
}
} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
  echo $ex->getMessage();
}
if(strcmp($_SESSION['role'],"admin") == 0){
    header("Location: ".$baseurl."admin.php?");
    exit();
}
else{
    header("Location: ".$baseurl."officer.php?");
    exit();
}