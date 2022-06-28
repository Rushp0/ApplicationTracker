<?php 

    include("../connectDB.php");

    $getViewedSummaryQuery = "SELECT `viewed` FROM `applicationSummary`";

    $results = $con->query($getViewedSummaryQuery);
    $results = $results->fetch_assoc();

    echo "<p>" . $results["viewed"] . "</p>";
    echo "<p>Viewed</p>";
    
?>