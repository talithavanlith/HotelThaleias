<?php

$task ='';

$numberUpdate = $_POST['number'];

//open available rooms
$hotelRooms = simplexml_load_file('xml/availableRooms.xml');

//loop through to find required room
foreach ($hotelRooms->hotelRoom as $room) {
    $roomNumber = $room->number;
    if ($roomNumber == $numberUpdate){

        //once found update all the values to the new ones
        $room->number = $_POST['number'];
        $room->roomType = $_POST['type'];
        $room->description = $_POST['description'];
        $room->pricePerNight = $_POST['price'];
    }
}
$hotelRooms->saveXML('xml/availableRooms.xml');

$_SESSION = array();
session_destroy();


echo "<h2>Room number $numberUpdate has been updated</h2>";
?>
<li class="backAdmin"><a href='admin.php'>Back to admin home page</a>