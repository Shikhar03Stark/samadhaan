<?php

$baseurl = "http://localhost/samadhaan/";

if(!isset($_POST['submit'])){
    header("Location:".$baseurl."index.html");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

require 'connectdb.inc.php';
use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\Exception;
use Parse\ParseObject;
use Parse\ParseUser;

try {
    $user = ParseUser::logIn($username, $password);
    // Do stuff after successful login.
    session_start();
    if(strcmp($username,"deepak_mangla") == 0){
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "admin";
        header("Location: ".$baseurl."admin.php");
    }
    else{
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "officer";
        header("Location: ".$baseurl."officer.php");
    }
  } catch (ParseException $error) {
    // The login failed. Check error to see why.
    header("Location: ".$baseurl."login.php?err=wrong");
    exit();
  }
