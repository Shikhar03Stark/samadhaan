<?php

$baseurl = "http://localhost/samadhaan/";

if(!isset($_REQUEST['login'])){
    header("Location:".$baseurl."index.html");
    exit();
}
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
        <title>Samadhaan</title>
</head>
<div class = "header">
            Login as Officer/Admin
</div>
<div class='container' style="width:100%; padding-top:20%;text-align:center;">
    <form action="login.inc.php" method="POST">
    Username: &nbsp; <input type="text" name="username" placeholder="Enter Username" style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
    Password: &nbsp; <input type="password" name ="password" placeholder="" style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
    <input type="submit" name="submit" value="Login">
    </form>
</div>