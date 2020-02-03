<?php
session_start();
$scriptList = array('jquery-3.3.1.min.js', 'Cookies.js', 'chosenRooms.js');
$admin = false;
$book = true;
include("phpFiles/header.php");
?>

    <section>
        <?php

        include ("phpFiles/convertDates.php");

        //add all details to session
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];

        include ("phpFiles/validateFunctions.php");

        //if the validation is passed complete the booking
        if(validateCheckout()){

            ?>
            <h2>The booking was successful!</h2>

            <?php
            $_SESSION = array();
            session_destroy();

            //store the booking details to variables
            $book = json_decode($_COOKIE['Book']);
            $inDates = convertDate($book[0]->checkInDate);
            $outDates = convertDate($book[0]->checkOutDate);
            $roomNumber = $book[0]->number;
            $name = $_POST['name'];

            //open roomBookings file
            $bookings = simplexml_load_file('xml/roomBookings.xml');

            //add new booking to file
            $newBooking = $bookings->addChild('booking');
            $newBooking->addChild('number', $roomNumber);
            $newBooking->addChild('name', $name);
            $checkin = $newBooking->addChild('checkin');
            $checkin->addChild('day', $inDates[0]);
            $checkin->addChild('month', $inDates[1]);
            $checkin->addChild('year', $inDates[2]);
            $checkout = $newBooking->addChild('checkout');
            $checkout->addChild('day', $outDates[0]);
            $checkout->addChild('month', $outDates[1]);
            $checkout->addChild('year', $outDates[2]);

            //save updated file
            $bookings->saveXML('xml/roomBookings.xml');

            // destroy the Book cookie by setting it to a time in the past
            setcookie('Book', '', time()-3600, '/');

            //display finalised booking details
            echo "<p class=\"checkOutText\"><b>You are now booked under the name:</b> $name</p>";
            echo "<p><b>From the</b> $inDates[0] of $inDates[1], $inDates[2] <b>to the</b> $outDates[0] of $outDates[1], $outDates[2]</p>";
            echo "<p><b>In room: </b>$roomNumber</p>";

            unset($_COOKIE['Book']);
        }

        ?>
    </section>
<!-- footer image -->
<figure>
    <img src="./images/pool-footer.jpg" alt="Roof Top Pool" class="poolFooter">
    <!-- image by: Hotel Internazionale Ischia, found on flickr.com, license = https://creativecommons.org/licenses/by-sa/2.0/ (has been edited in photoshop)-->
</figure>
<?php include("phpFiles/footer.php"); ?>