<?php 

    include("../connectDB.php");

    $getSubmittedSummaryQuery = "SELECT `submitted` FROM `applicationSummary`";

    $results = $con->query($getSubmittedSummaryQuery);
    $results = $results->fetch_assoc();

    echo "<p>" . $results["submitted"] . "</p>";
    echo "<p>Submitted</p>";
    
?>