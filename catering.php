<!DOCTYPE html>
<html lang ="en">
<head>
   <title>Catering Task</title>
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
}

#table > tr, th, td{
    border: 1px solid;
    font-size: 25px; 
}

.leftcol{
    text-align: center;
}

.cells{
    padding: 18px;
    background-color: #edc7eb;
}

.headers{
    background-color: #e09dd2;
}

.title{
    background-color: #d099e0;
}

.odd{
    background-color:#edc7eb;
}

.even{
    background-color:#d1afdb;
}

</style>
</head>
<body>
<h3 class="center">COA123 - Web Programming</h3>
<h2 class="center">Individual Coursework - Wedding Planner</h2>
<h1 class="center">Task 1 - Catering (catering.php)</h1>

<?php

function validate($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = preg_replace("/[^0-9]/", "", $data);
    return $data; 
}

$min = validate($_REQUEST["min"]); 
$max = validate($_REQUEST["max"]);
$c1 = validate($_REQUEST["c1"]);
$c2 = validate($_REQUEST["c2"]);
$c3 = validate($_REQUEST["c3"]);
$c4 = validate($_REQUEST["c4"]);
$c5 = validate($_REQUEST["c5"]);


echo "<table class='table'>
        <tr>
        <th class='title'> Cost per Person → <br> ↓Party Size </th>
        <th class='headers'> $c1 </th>
        <th class='headers'> $c2 </th>
        <th class='headers'> $c3 </th>
        <th class='headers'> $c4 </th>
        <th class='headers'> $c5 </th>
        </tr>";



foreach(range($min,$max,5) as $partysize){
    if($partysize % 2 == 0){
        echo "<tr class='even'>";
        echo "<td class='leftcol headers'> $partysize </td>";
        echo "<td class='cells even'>" .$partysize * $c1. "</td>";
        echo "<td class='cells even'>" .$partysize * $c2. "</td>";
        echo "<td class='cells even'>" .$partysize * $c3. "</td>";
        echo "<td class='cells even'>" .$partysize * $c4. "</td>";
        echo "<td class='cells even'>" .$partysize * $c5. "</td>";
        echo "</tr>";
    }
    else{
        echo "<tr>";
        echo "<td class='leftcol headers'> $partysize </td>";
        echo "<td class='cells odd'>" .$partysize * $c1. "</td>";
        echo "<td class='cells odd'>" .$partysize * $c2. "</td>";
        echo "<td class='cells odd'>" .$partysize * $c3. "</td>";
        echo "<td class='cells odd'>" .$partysize * $c4. "</td>";
        echo "<td class='cells odd'>" .$partysize * $c5. "</td>";
        echo "</tr>";
    }
}

?>
</body>
</html>


