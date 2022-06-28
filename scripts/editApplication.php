<?php 

    include("connectDB.php");

    $company = $_POST["edit-company-name"];
    $status = $_POST["edit-status-dropdown"];
    $platform = $_POST["edit-application-platform"];
    $date = $_POST["edit-submission-date"];
    $applicationKey = $_POST["application-key"];

    // Get Application Summary
    $applicationSummaryQuery = "SELECT * FROM `applicationSummary`";
    $summaryResults = $con->query($applicationSummaryQuery);
    $summaryResults = $summaryResults->fetch_assoc();

    // get previous status of application before edit
    //SELECT `status` FROM `applications` WHERE `application key` = 7
    $previousStatusQuery = "SELECT `status` FROM `applications` WHERE `application key` =" . intval($applicationKey);
    $previousStatusResults = $con->query($previousStatusQuery);
    $previousStatusResults = $previousStatusResults->fetch_assoc();

    if($previousStatusResults["status"] == $status){ // DO NOT UPDATE APPLICATION SUMMARY
        $updateApplicationSummary = "UPDATE `applications` SET `status`='".$status."',`platform`='".$platform."',`date`='".$date."'" . " WHERE `application key` = ".$applicationKey;
        $con->query($updateApplicationSummary);

    }else{ // UPDATE APPLICATION SUMMARY

        // Decrease previous status count
        $lowerStatus = strtolower($previousStatusResults["status"]);
        $decreaseCountQuery = "UPDATE `applicationSummary` SET `" . $lowerStatus . "` = ". intval($summaryResults[strtolower($previousStatusResults["status"])]-1);
        $con->query($decreaseCountQuery);

        // Increase new status count
        $lowerStatus =  strtolower($status);
        $increaseCountQuery = "UPDATE `applicationSummary` SET `" . $lowerStatus . "` = " . intval($summaryResults[$lowerStatus]+1);
        $con->query($increaseCountQuery);

        // update application
        $updateApplicationSummary = "UPDATE `applications` SET `status`='".$status."',`platform`='".$platform."',`date`='".$date."'"  . " WHERE `application key` = ".$applicationKey;
        $con->query($updateApplicationSummary);
        echo $con->error;
    }

    echo "<script> window.location = \"../index.php\" </script>"

?>