<?php
    
    function getFormData(){
        
        $dateWanted = isset($_GET['dateWanted']) ? $_GET['dateWanted'] : 'Not received';

        $dateWanted2 = isset($_GET['dateWanted2']) ? $_GET['dateWanted2'] : 'Not received';
        
        $partySize = isset($_GET["rangeInput"]) ? $_GET["rangeInput"] : "Not received"; 
        
        $cateringGrade = isset($_GET["cateringGrade"]) ? $_GET["cateringGrade"] : "Not received"; 
        
        $date1 = date_create($dateWanted);
        $date2 = date_create($dateWanted2);
        
        $rangeTotal = date_diff($date1, $date2) -> format("%d"); 
        $rangeTotal = (string)(int)($rangeTotal+1); 

        $sql = "SELECT venue.name, venue.venue_id, venue.capacity, IF(venue.licensed, 'Yes', 'No') AS licensed, venue.weekend_price, venue.weekday_price, catering.cost, COUNT(venue_booking.booking_date) AS prev_booked, IF(days_available, days_available , IF(days_available = 0, 0, $rangeTotal)) 
        FROM `venue` 
        LEFT JOIN `venue_booking` ON venue.venue_id = venue_booking.venue_id
        LEFT JOIN `catering` ON venue.venue_id = catering.venue_id
        LEFT JOIN(
            SELECT ($rangeTotal-COUNT(booking_date)) AS days_available, venue_id
            FROM venue_booking 
            WHERE booking_date BETWEEN '$dateWanted' AND '$dateWanted2'
            GROUP BY venue_id) available ON available.venue_id = catering.venue_id
        WHERE capacity >= $partySize AND catering.grade = $cateringGrade AND IF(days_available, days_available , IF(days_available = 0, 0, $rangeTotal)) > 0
        GROUP BY name, venue_id, capacity, licensed, catering.cost, venue.venue_id;"; 


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

