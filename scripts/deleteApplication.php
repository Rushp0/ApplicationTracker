<?php 
    include("connectDB.php");

    $applicationKey = $_REQUEST["q"];

    // Update Application Summary
    // get status of application to be deleted
    $getStatus = "SELECT `status` FROM `applications` WHERE `application key` = " . $applicationKey;
    $statusResults = $con->query($getStatus);
    $statusResults = $statusResults->fetch_assoc();
    $status = strtolower($statusResults["status"]);

    // get current application status count
    $getStatusCountQuery = "SELECT `" . $status . "` FROM `applicationSummary`";
    $statusCountResults = $con->query($getStatusCountQuery);
    $statusCountResults = $statusCountResults->fetch_assoc();
    $statusCount = $statusCountResults[$status];

    // edit application summary
    $decreaseCountQuery = "UPDATE `applicationSummary` SET `" . $status . "` = ". (intval($statusCount)-1);
    $con->query($decreaseCountQuery);

    // Delete application
    $deleteQuery = "DELETE FROM `applications` WHERE `application key` = " . $applicationKey;
    $con->query($deleteQuery);

?>