<?php
require 'connectdb.inc.php';
//add condition for officer in officer search
session_start();
$select = $_POST['field'];
$str="";
foreach($select as $option){
    $str = $str.$option."&";
}
if(strcmp($_SESSION['role'],"admin") == 0){
    header("Location: ".$baseurl."admin.php?sortby=".$str);
    exit();
}
else{
    header("Location: ".$baseurl."officer.php?sortby=".$str);
    exit();
}