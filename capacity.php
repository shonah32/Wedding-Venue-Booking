<!DOCTYPE html>
<html lang ="en">
<head>
   <title>>Capacity Task</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
 
<style>
body {
	font-family: "Apple Chancery", Times, serif;
	background-color: #D6D6D6;
}
.center {
	text-align:center;
}
body,td,th {
	color: #06F; 
}
.larger {
	font-size:larger;
	
}
table {
	margin-left:auto;
	margin-right:auto;
    font-size: 20px;
}
td{
    padding: 30px;
    border: 1px solid;
    margin: 20px;
    text-align: center;
}
</style>
</head>
<body>
<h3 class="center">COA123 - Web Programming</h3>
<h2 class="center">Individual Coursework - Wedding Planner</h2>

<h1 class="center">Task 2 - Capacity (capacity.php)</h1>

<?php

function validate($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = preg_replace("/[^0-9]/", "", $data);
    if(ctype_digit($data)){
        return $data;
    }
    else{
        exit("<center> Sorry, please try again and enter only numbers. </center>"); 
    }
} 


$min = validate($_REQUEST["minCapacity"]); 
$max = validate($_REQUEST["maxCapacity"]);


$sql = "SELECT name, weekend_price, weekday_price FROM `venue` WHERE capacity >= $min AND capacity <= $max";

$con = mysqli_connect('sci-mysql','coa123wuser','grt64dkh!@2FD','coa123wdb');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$result = mysqli_query($con, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC); 


if($data == NULL){
    echo "<center> Sorry, there are no results to show. </center>";
}

else{
    echo "<table class='table'>
    <tr>
    <th> Name </th>
    <th class='headers'> Weekend <br> Price </th>
    <th class='headers'> Weekday <br> Price </th>
    </tr>";


    foreach($data as $i => $venue){
    echo "<tr>";
    foreach($venue as $col => $value){
        
        echo "<td> $value </td>";

    }
    echo "</tr>";
    }

}

?> 

</body>
</html>
