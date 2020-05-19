<?php
session_start();
require 'connectdb.inc.php';
use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\Exception;
use Parse\ParseObject;
use Parse\ParseUser;

$baseurl = "http://localhost/samadhaan/";
if(isset($_SESSION['username']) && isset($_SESSION['role']) && strcmp($_SESSION['role'],"admin")){
    echo "<head>
    <link rel='stylesheet' type='text/css' href='style.css'>
            <title>Samadhaan</title>
    </head>
    <div class = 'header'>
            Logged in as ".$_SESSION['role']." (".$_SESSION['username'].")"."
            <form action='logout.inc.php' method='POST' style='float:right; margin-right:200px;'>
    <input type='submit' name='logout' value='Logout'><br>
    </form>
</div>";

    echo "
    <form action='search.inc.php' method='POST' style='float:right;'>
    <input type='text' name='query' placeholder='Search ...' maxlength='30' size='30'><input type='submit' name='search' value='Search'><br>
    </form>
    ";

    echo "
    <form action='sort.inc.php' method='POST' style='float:left;'>
    <input type='submit' name='sort' value='Sort By'>
    <select name = 'field[]' value = 'Select'>
        <option value='createdAt' selected>Latest</option>
        <option value='status' >Status</option>
        <option value='name' >Name</option>
        <option value='updateAt' >Latest Updated</option>
    </select>
    </form>
    ";
    
    
//searching

if(isset($_GET['query'])){
    if(strcmp($_SESSION['role'],"admin") == 0){
        //echo "get is there...<br>";
        $query = $_GET['query'];
        $officer = $_SESSION['username'];
    }
    else{
        $query = $_GET['query'];
        $officer = $_SESSION['username'];
    }
}else{
    $query = "";
    $officer = $_SESSION['username'];
}

$nameQ = new ParseQuery("Complain");
$nameQ->equalTo("name", $query);

$complainQ = new ParseQuery("Complain");
$complainQ->equalTo("complain", $query);

$villageQ = new ParseQuery("Complain");
$villageQ->equalTo("village", $query);

$phoneQ = new ParseQuery("Complain");
$phoneQ->equalTo("phone", $query);

$statusQ = new ParseQuery("Complain");
$statusQ->equalTo("status", $query);

$officerQ = new ParseQuery("Complain");
$officerQ->equalTo("officer", $officer);

$colonyQ = new ParseQuery("Complain");
$colonyQ->equalTo("colony", $query);

$mainQ = ParseQuery::orQueries([$nameQ,$complainQ,$villageQ,$phoneQ,$statusQ,$colonyQ]);

$mainQ = ParseQuery::andQueries([$mainQ,$officerQ]);

//echo "Display PHP is working";

if(isset($_GET['query'])){
    //print Query here..
    //echo 'Inside If<br> ';
    //$mainQ = $_SESSION['mainQ'];
    $mainQ->descending("createdAt");
    $results = $mainQ->find();
    echo "
    <table>
    <tr>
    <th>Status</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Complaint</th>
    <th>Remarks</th>
    <th>House Number</th>
    <th>Colony</th>
    <th>Ward Number/Village</th>
    <th>Feedback</th>
    <th>Action</th>
    </tr>
    ";
    foreach($results as $q){
        echo "<tr>";
        echo "<td>".$q->get("status")."</td>";
        echo "<td>".$q->get("name")."</td>";
        echo "<td>".$q->get("phone")."</td>";
        echo "<td>".$q->get("complaint")."</td>";
        echo "<td>".$q->get("remarks")."</td>";
        echo "<td>".$q->get("house")."</td>";
        echo "<td>".$q->get("colony")."</td>";
        echo "<td>".$q->get("village")."</td>";
        echo "<form action = 'update.inc.php' method='POST'>";
        echo "<td><input type='text' name='remark' size='20' maxlength='20'></td>";
        echo "<td><select name = 'action'>
            <option value='Completed' selected>Completed</option>
            <option value='Pending'>Pending</option>
        </select>
        <input type='text' name='objectid' value='".$q->getObjectID()."' hidden>
        <input type='submit' name='submit' value='GO'>
        </form>
        </td>
        ";
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
    unset($_GET['query']);

}
elseif(isset($_GET['sortby'])){
    $sortby = $_GET['sortby'];
    $mainQ = new ParseQuery("Complain");
    $mainQ->descending($sortby);
    if(strcmp($_SESSION['role'],"officer") == 0)
        $mainQ->equalTo("officer", $officer);
    $results = $mainQ->find();
    echo "
    <table>
    <tr>
    <th>Status</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Complaint</th>
    <th>Remarks</th>
    <th>House Number</th>
    <th>Colony</th>
    <th>Ward Number/Village</th>
    <th>Feedback</th>
    <th>Action</th>
    </tr>
    ";
    foreach($results as $q){
        echo "<tr>";
        echo "<td>".$q->get("status")."</td>";
        echo "<td>".$q->get("name")."</td>";
        echo "<td>".$q->get("phone")."</td>";
        echo "<td>".$q->get("complaint")."</td>";
        echo "<td>".$q->get("remarks")."</td>";
        echo "<td>".$q->get("house")."</td>";
        echo "<td>".$q->get("colony")."</td>";
        echo "<td>".$q->get("village")."</td>";
        echo "<form action = 'update.inc.php' method='POST' >";
        echo "<td><input type='text' name='remark' size='20' maxlength='20'></td>";
        echo "<td><select name = 'action'>
            <option value='Completed' selected>Completed</option>
            <option value='Pending'>Pending</option>
        </select>
        <input type='text' name='objectid' value='".$q->getObjectID()."' hidden>
        <input type='submit' name='submit' value='GO'>
        </form>
        </td>
        ";
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
}
else{
    //echo 'Inside else';
    $mainQ = new ParseQuery("Complain");
    $mainQ->descending("createdAt");
    if(strcmp($_SESSION['role'],"officer") == 0)
        $mainQ->equalTo("officer", $officer);
    $results = $mainQ->find();
    echo "
    <table>
    <tr>
    <th>Status</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Complaint</th>
    <th>Remarks</th>
    <th>House Number</th>
    <th>Colony</th>
    <th>Ward Number/Village</th>
    <th>Feedback</th>
    <th>Action</th>
    </tr>
    ";
    foreach($results as $q){
        echo "<tr>";
        echo "<td>".$q->get("status")."</td>";
        echo "<td>".$q->get("name")."</td>";
        echo "<td>".$q->get("phone")."</td>";
        echo "<td>".$q->get("complaint")."</td>";
        echo "<td>".$q->get("remarks")."</td>";
        echo "<td>".$q->get("house")."</td>";
        echo "<td>".$q->get("colony")."</td>";
        echo "<td>".$q->get("village")."</td>";
        echo "<form action = 'update.inc.php' method='POST'>";
        echo "<td><input type='text' name='remark' size='20' maxlength='20'></td>";
        echo "<td><select name = 'action'>
            <option name='Completed' selected>Completed</option>
            <option name='Pending'>Pending</option>
        </select>
        <input type='text' name='objectid' value='".$q->getObjectID()."' hidden>
        <input type='submit' name='submit' value='GO'>
        </form>
        </td>
        ";
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
}
    
}
else{
    header("Location: ".$baseurl."index.html");
    exit();
}