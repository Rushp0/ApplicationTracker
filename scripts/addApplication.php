<?php 
    include("connectDB.php");

    $company = $_POST["add-company-name"];
    $status = $_POST["add-status-dropdown"];
    $platform = $_POST["add-application-platform"];
    $date = $_POST["add-submission-date"];

    // get application key for next application
    $getLastApplicationKeyQuery = "SELECT `application key` FROM `applications` ORDER BY `application key` DESC";
    $appKeyResults = $con->query($getLastApplicationKeyQuery);
    $lastApplicationKey = $appKeyResults->fetch_assoc();
    $newApplicationKey = $lastApplicationKey["application key"]+1;

    // update application summary table
    $getCurrentApplicationCounts = "SELECT * FROM `applicationSummary`";
    $applicationCountResults = $con->query($getCurrentApplicationCounts);
    $applicationCountResults = $applicationCountResults->fetch_assoc();

    $updateQuery = "";
    if($status == "Viewed"){
        $updateQuery = "UPDATE `applicationSummary` SET `viewed` = ".((int)$applicationCountResults["viewed"]+1);
    }else if($status == "Denied"){
        $updateQuery = "UPDATE `applicationSummary` SET `denied` = ".((int)$applicationCountResults["denied"]+1);
    }else if($status == "Accepted"){
        $updateQuery = "UPDATE `applicationSummary` SET `accepted` = ".((int)$applicationCountResults["accepted"]+1);
    }else if($status == "Submitted"){
        $updateQuery = "UPDATE `applicationSummary` SET `submitted` = ".((int)$applicationCountResults["submitted"]+1);
    }
    $con->query($updateQuery);

    // add application to applications table
    $addApplicationQuery = "INSERT INTO `applications`(`application key`,`company`, `status`, `platform`, `date`) VALUES (". $newApplicationKey .",'". $company ."','".$status."','".$platform."','".$date."')";
    $con->query($addApplicationQuery);

    // go back to index page
    echo '<script>window.location.href = "../index.html";</script>';

?>