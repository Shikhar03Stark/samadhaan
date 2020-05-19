<?php

require 'connectdb.inc.php';
use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\Exception;
use Parse\ParseObject;
use Parse\ParseUser;

echo "Display PHP is working";

if(false && isset($_SESSION['mainQ'])){
    //print Query here..
    //echo 'Inside If<br> ';
    $mainQ = $_SESSION['mainQ'];
    $mainQ->descending("createdAt");
    $results = $mainQ->find();
    echo "
    <table>
    <tr>
    <th>Status</th>
    <th>Officer Assigned</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Complaint</th>
    <th>Remarks</th>
    <th>House Number</th>
    <th>Colony</th>
    <th>Ward Number/Village</th>
    </tr>
    ";
    foreach($results as $q){
        echo "<tr>";
        echo "<td>".$q->get("status")."</td>";
        echo "<td>".$q->get("officer")."</td>";
        echo "<td>".$q->get("name")."</td>";
        echo "<td>".$q->get("phone")."</td>";
        echo "<td>".$q->get("complaint")."</td>";
        echo "<td>".$q->get("remarks")."</td>";
        echo "<td>".$q->get("house")."</td>";
        echo "<td>".$q->get("colony")."</td>";
        echo "<td>".$q->get("village")."</td>";
        echo "</tr>";
    }
    echo "</table>";
    unset($_SESSION['mainQ']);
}
else{
    //echo 'Inside else';
    $mainQ = new ParseQuery("Complain");
    //$mainQ->descending("createdAt");
    $results = $mainQ->find();
    echo "
    <table>
    <tr>
    <th>Status</th>
    <th>Officer Assigned</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Complaint</th>
    <th>Remarks</th>
    <th>House Number</th>
    <th>Colony</th>
    <th>Ward Number/Village</th>
    </tr>
    ";
    foreach($results as $q){
        echo "<tr>";
        echo "<td>".$q->get("status")."</td>";
        echo "<td>".$q->get("officer")."</td>";
        echo "<td>".$q->get("name")."</td>";
        echo "<td>".$q->get("phone")."</td>";
        echo "<td>".$q->get("complaint")."</td>";
        echo "<td>".$q->get("remarks")."</td>";
        echo "<td>".$q->get("house")."</td>";
        echo "<td>".$q->get("colony")."</td>";
        echo "<td>".$q->get("village")."</td>";
        echo "</tr>";
    }
    echo "</table>";
}