<?php 
    include("connectDB.php");
    $searchText = $_GET["q"];
    
    // get company names
    $getCompanyNameQuery = "SELECT * FROM `applications`";
    if($searchText == ""){
        $getCompanyNameQuery = "SELECT * FROM applications ORDER BY `date` DESC";
    }
    $companyNames = $con->query($getCompanyNameQuery);

    $applicationKeys = array();

    while($row = $companyNames->fetch_assoc()){
        $company = $row["company"];
        if(strtolower($searchText) == strtolower(substr($company, 0, strlen($searchText)))){
            array_push($applicationKeys, $row["application key"]);
        }
    }

    echo "<tr>
    <th>COMPANY</th>
    <th>STATUS</th>
    <th>PLATFORM</th>
    <th>DATE</th>
    <th></th>
    </tr>";

    $searchResultsQuery = "";
    foreach($applicationKeys as $key){
        $searchResultsQuery = "SELECT * FROM `applications` WHERE `application key`=" . $key;
        $searchResults = $con->query($searchResultsQuery);
        $searchResults = $searchResults->fetch_assoc();
        echo "<tr>";
        echo "<td>" . $searchResults["company"] . "</td>";
        if($searchResults["status"] == "Viewed"){
            echo "<td class=\"viewed status\">" . $searchResults["status"] . "</td>";
        }else if($searchResults["status"] == "Denied"){
            echo "<td class=\"denied status\">" . $searchResults["status"] . "</td>";
        }else if($searchResults["status"] == "Submitted"){
            echo "<td class=\"submitted status\">" . $searchResults["status"] . "</td>";
        }else if($searchResults["status"] == "Accepted"){
            echo "<td class=\"accepted status\">" . $searchResults["status"] . "</td>";
        }
        echo "<td>" . $searchResults["platform"] . "</td>";
        $date = new DateTime($searchResults["date"]);
        echo "<td>" . $date->format("m/d/y") . "</td>";
        echo "<td>
        <span class=\"material-symbols-outlined\" style=\"cursor: pointer;\" onclick=\"edit(".$searchResults["application key"].")\">edit</span>
        </td>";
        echo "</tr>";
    }

?>