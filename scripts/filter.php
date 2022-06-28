<?php 
    include("connectDB.php");

    $filter = $_REQUEST["q"];

    $filterQuery = "SELECT * FROM `applications` WHERE `status`='" . $filter . "'";
    if($filter == "all"){
        $filterQuery = "SELECT * FROM `applications`";
    }
    $results = $con->query($filterQuery);

    echo "
    <tr>
    <th>COMPANY</th>
    <th>STATUS</th>
    <th>PLATFORM</th>
    <th>DATE</th>
    <th></th>
    </tr>
    ";

    while($row = $results->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row["company"] . "</td>";

        // print status with respective class
        if($row["status"] == "Viewed"){
            echo "<td class=\"status viewed\">" . $row["status"] . "</td>";

        }else if($row["status"] == "Denied"){
            echo "<td class=\"status denied\">" . $row["status"] . "</td>";

        }else if($row["status"] == "Submitted"){
            echo "<td class=\"status submitted\">" . $row["status"] . "</td>";

        }else if($row["status"] == "Accepted"){
            echo "<td class=\"status accepted\">" . $row["status"] . "</td>";
        }

        echo "<td>" . $row["platform"] . "</td>";

        // date formatting
        $date = new DateTime($row["date"]);
        echo "<td>" . $date->format("m/d/y") . "</td>";
    
        // edit icon
        echo "<td>
        <span class=\"material-symbols-outlined ".$row["application key"]."\" \" style=\"cursor: pointer;\" onclick=\"edit(".$row["application key"].")\">edit</span>
        </td>";
        
        echo "</tr>";

    }

?>