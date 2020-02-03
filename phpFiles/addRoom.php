<?php


$task ='';

//open available rooms
$hotelRooms = simplexml_load_file('xml/availableRooms.xml');
$numberAdd = $_POST['number'];

//add new room to the end of the file with new details
$newRoom = $hotelRooms->addChild('hotelRoom');
$newRoom->addChild('number', $numberAdd);
$newRoom->addChild('roomType', $_POST['type']);
$newRoom->addChild('description', $_POST['description']);
$newRoom->addChild('pricePerNight', $_POST['price']);

$hotelRooms->saveXML('xml/availableRooms.xml');

$_SESSION = array();
session_destroy();

echo "<h2>Room number $numberAdd has been added</h2>";
?>
<li class="backAdmin"><a href='admin.php'>Back to admin home page</a>

