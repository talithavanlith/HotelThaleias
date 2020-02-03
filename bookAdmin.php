<?php
session_start();
$scriptList = array('jquery-3.3.1.min.js', 'adminBookings.js',
    'room-options-admin.js', 'Cookies.js', 'chosenRooms.js');
$admin = true;
$book = false;
include("phpFiles/header.php");

?>
<!-- Start of navigation -->
<section>

    <!-- shows all room types available -->
    <h2 class="availableRooms">All Available Rooms:</h2>

</section>

<!-- footer image -->
<figure>
    <img src="./images/pool-footer.jpg" alt="Roof Top Pool" class="poolFooter">
    <!-- image by: Hotel Internazionale Ischia, found on flickr.com,
    license = https://creativecommons.org/licenses/by-sa/2.0/
    (has been edited in photoshop)-->
</figure>
<?php include("phpFiles/footer.php"); ?>