<?php
session_start();
$scriptList = array('jquery-3.3.1.min.js');
$admin = true;
$book = false;
include("phpFiles/header.php");

?>
<!-- End of nav -->

<section class="adminPage">
    <!--button to edit bookings -->
    <li class="adminButton" id="firstAdmin"><a href='adminEditBookings.php'>
            Edit Bookings</a>
    <!--button to edit available rooms -->
    <li class="adminButton"><a href='bookAdmin.php'>Edit Available Rooms</a>


</section>

<!-- footer image -->
<figure>
    <img src="./images/pool-footer.jpg" alt="Roof Top Pool" class="poolFooter">
    <!-- image by: Hotel Internazionale Ischia, found on flickr.com, license =
    https://creativecommons.org/licenses/by-sa/2.0/
    (has been edited in photoshop)-->
</figure>
<?php include("phpFiles/footer.php"); ?>