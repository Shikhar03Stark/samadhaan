<?php

$baseurl = "http://localhost/samadhaan/";

if(!isset($_REQUEST['fileComplaint'])){
    header("Location:".$baseurl."index.html");
    exit();
}
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
        <title>Samadhaan</title>
</head>
<div class = "header">
            File a Complaint
        </div>
<div class='container'>
    <form action = 'fileComplain.inc.php' method='POST'>
        <input type='text' maxlength = '30' size = '30' placeholder = 'Enter First Name*' name = 'fname' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
        <input type='text' maxlength = '30' size = '30' placeholder = 'Enter Last Name*' name = 'lname' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
        <br>
        <input type='text' maxlength = '30' size = '30' placeholder = 'Enter House Number*' name = 'hnum' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
        <input type='text' maxlength = '30' size = '30' placeholder = 'Enter Colony Name' name = 'colony' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
        <input type='text' maxlength = '40' size = '40' placeholder = 'Enter Ward Number/Village Name*' name = 'ward' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
        <br>
        <input type='text' maxlength = '30' size = '30' placeholder = 'Enter Phone Number*' name = 'phone' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;'><br>
        <br>
        <textarea name='complain' row='10' col='20' style='padding:10px; margin:5px; color:blueviolet; font-size:32px;' placeholder='Complaint...'></textarea><br>
        <input type='submit' name="submit" value="File a Complaint"><br>
    </form>
</div>
