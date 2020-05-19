<?php
require 'connectdb.inc.php';
//add condition for officer in officer search
session_start();
if(strcmp($_SESSION['role'],"admin") == 0){
    header("Location: ".$baseurl."admin.php?query=".$_POST['query']);
    exit();
}
else{
    header("Location: ".$baseurl."officer.php?query=".$_POST['query']);
    exit();
}