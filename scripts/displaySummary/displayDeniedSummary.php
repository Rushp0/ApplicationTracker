<?php 

    include("../connectDB.php");

    $getDeniedSummaryQuery = "SELECT `denied` FROM `applicationSummary`";

    $results = $con->query($getDeniedSummaryQuery);
    $results = $results->fetch_assoc();

    echo "<p>" . $results["denied"] . "</p>";
    echo "<p>Denied</p>";
    
?>