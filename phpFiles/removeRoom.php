<?php

    $task = '';

    //remove bookings
    $bookings = simplexml_load_file('xml/roomBookings.xml');

    //iterate through bookings to find bookings made to the room given
    foreach ($bookings->booking as $booking) {
        $roomNumber = $booking->number;
        if ($roomNumber == $number){
            unset($booking[0]);
        }
    }
    $bookings->saveXML('xml/roomBookings.xml');

    //remove room
    $hotelRooms = simplexml_load_file('xml/availableRooms.xml');
    //iterate through rooms to find room to delete
    foreach ($hotelRooms->hotelRoom as $room) {
        $roomNumber = $room->number;
        if ($roomNumber == $number){
            unset($room[0]);
            echo "<h2>Room Number $number is removed</h2>";
        }
    }
    $hotelRooms->saveXML('xml/availableRooms.xml');


$_SESSION = array();
session_destroy();
?>
<li class="backAdmin"><a href='admin.php'>Back to admin home page</a>