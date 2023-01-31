<!DOCTYPE html>
<html lang ="en">
<head>
   <title>>Count Task</title>
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
<h1 class="center">Task 3 - Count (count.php)</h1>

<?php

$month = $_REQUEST["month"]; 

if (strlen($month) == 1) {
    $month = 0 . $month;
}

if($month > 12 OR $month <= 0){
    exit("<center> Please enter a number between 1 and 12. </center>"); 
}


$sql = "SELECT name, COUNT(name) FROM `venue`, `venue_booking` WHERE `venue`.venue_id = `venue_booking`.venue_id AND booking_date LIKE '____-$month-__' GROUP BY name ORDER BY COUNT(name) DESC";


$con = mysqli_connect('sci-mysql','coa123wuser','grt64dkh!@2FD','coa123wdb');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$result = mysqli_query($con, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);


echo "<table class='table'>
        <tr>
        <th> Name </th>
        <th class='headers'> Number of <br> Bookings </th>
        </tr>";


foreach($data as $i => $venue){
    echo "<tr>";
    foreach($venue as $col => $value){
        
        echo "<td> $value </td>";

    }
    echo "</tr>";
}

?>

</body>
</html>
