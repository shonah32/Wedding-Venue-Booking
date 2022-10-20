<?php

function getFormData(){
    $dateWanted = isset($_GET['dateWanted']) ? $_GET['dateWanted'] : 'Not received';

    $dateWanted2 = isset($_GET['dateWanted2']) ? $_GET['dateWanted2'] : 'Not received';

    $venueName = isset($_GET['venueName']) ? $_GET['venueName'] : 'Not received';

    
    $sql = "SELECT DISTINCT venue_booking.venue_id, venue_booking.booking_date, venue.name
            FROM `venue_booking`
            INNER JOIN `venue` on venue.venue_id = venue_booking.venue_id 
            WHERE  venue.name = '$venueName' AND booking_date BETWEEN '$dateWanted' AND '$dateWanted2';";


    $con = mysqli_connect('sci-mysql','coa123wuser','grt64dkh!@2FD','coa123wdb');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC); 

    return $data; 

} //end of function 

$data = getFormData();

echo json_encode($data); 

?>

