<?php 

    include("../connectDB.php");

    $getAcceptedSummaryQuery = "SELECT `accepted` FROM `applicationSummary`";

    $results = $con->query($getAcceptedSummaryQuery);
    $results = $results->fetch_assoc();

    echo "<p>" . $results["accepted"] . "</p>";
    echo "<p>Accepted</p>";
    
?>