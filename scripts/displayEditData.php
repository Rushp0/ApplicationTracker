<?php 
    include("connectDB.php");
    
    $applicationKey = $_REQUEST["q"];

    $getApplicationDataQuery = "SELECT * FROM `applications` WHERE `applicationkey`=" . $applicationKey;
    $results = $con->query($getApplicationDataQuery);
    $results = $results->fetch_assoc();

    echo json_encode($results);
?>