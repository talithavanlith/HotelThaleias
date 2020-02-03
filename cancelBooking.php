<?php
session_start();
$scriptList = array('jquery-3.3.1.min.js', 'Cookies.js', 'adminBookings.js');
$admin = true;
$book = false;
include("phpFiles/header.php");

//sets the number and checkIn date of the room to be cancelled
if(!(isset($_SESSION['numberCancel']))){
    $_SESSION['numberCancel'] = $_POST['numberCancel'];
    $_SESSION['dateCancel'] = $_POST['dateCancel'];
}

//function to convert dates to written form
include ("phpFiles/convertDates.php");

?>

<main>
    <section>
        <?php
        $showForm = true;
        $number = $_SESSION['numberCancel'];
        $checkin = $_SESSION['dateCancel'];

        if(isset($_POST['yes'])){
            $showForm = false;

            $bookings = simplexml_load_file('xml/roomBookings.xml');

            //iterate through bookings to find booking to cancel
            foreach ($bookings->booking as $booking) {

                //get info from form
                $bookingNumber = $booking->number;
                $day = $booking->checkin->day;
                $month = $booking->checkin->month;
                $year = $booking->checkin->year;
                $fullDate = $day . " " . $month . " " . $year;

                //convert given date so it is the same format as $fullDate
                $date = convertDate($checkin);
                $date = $date[0] . " " . $date[1] . " " . $date[2];

                //once booking found delete it
                if ($bookingNumber == $number && $date == $fullDate){
                    echo "<h2>Booking for room number $bookingNumber on the date $date is cancelled.</h2>";
                    unset($booking[0]);
                }
            }
            $bookings->saveXML('xml/roomBookings.xml');

            unset($_SESSION['numberCancel']);
            unset($_SESSION['dateCancel']);
        ?>
        <li class="backAdmin"><a href='admin.php'>Back to admin home page</a>
            <?php

        //if no is chosen, unset bookings and return to admin page
        }elseif (isset($_POST['no'])){
            unset($_SESSION['numberCancel']);
            unset($_SESSION['dateCancel']);
            header('Location: admin.php');
        }

        //asks the admin to double check they want to delete this room
        if ($showForm) {
        ?>
        <h2>Are you sure you want to cancel this booking:</h2>
            <p class="cancelText"><b>Room number:</b> <?php echo "$number"?></p>
            <p><b>Check in date:</b> <?php echo "$checkin"?></p>
        <form id="cancelBooking" action="<?php echo $_SERVER['PHP_SELF']; ?>"
              method="POST" novalidate>
            <input name="no" type="submit" class="checkOut" value="no">
            <input name="yes" type="submit" class="checkOut" value="yes">
        </form>
        <?php } ?>
    </section>
</main>

<!-- footer image -->
<figure>
    <img src="./images/pool-footer.jpg" alt="Roof Top Pool" class="poolFooter">
    <!-- image by: Hotel Internazionale Ischia, found on flickr.com,
    license = https://creativecommons.org/licenses/by-sa/2.0/
    (has been edited in photoshop)-->
</figure>
<?php include("phpFiles/footer.php"); ?>
