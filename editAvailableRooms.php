<?php
session_start();
$scriptList = array('jquery-3.3.1.min.js', 'Cookies.js', 'adminBookings.js');
$admin = true;
$book = false;
include("phpFiles/header.php");

?>

<main>
    <section>
        <?php
            $task = '';

            include("phpFiles/validateNewRoom.php");

            // sets the $task to the one chosen by the admin
            // sets the number of the room chosen to the session
            if(isset($_POST['edit'])){
                $_SESSION['number'] = $_POST['numberRemove'];
                $task = 'edit';
            }elseif (isset($_POST['remove'])){
                $_SESSION['number'] = $_POST['numberRemove'];
                $task = 'remove';
            }

            //stores the session in a variable
            if(isset($_SESSION['number'])){
                $number = $_SESSION['number'];
            }else{
                $number = -1;
            }

            if(isset($_POST['yes'])){

                include("phpFiles/removeRoom.php");
                //remove room and corresponding bookings from xml

            }elseif (isset($_POST['no'])){

                header('Location: bookAdmin.php');
                //go back to previous page

            }elseif ($task == 'editDone'){

                include("phpFiles/editRoom.php");
                //get info from form and update the room

            }elseif ($task == 'addDone'){

                include("phpFiles/addRoom.php");
                //get info from form and use it to create a new room

            }





            //if admin wants to remove a room
            if ($task == 'remove') {
        ?>

        <h2>Are you sure you want to remove room number:
            <?php echo "$number"?></h2>
            <?php
                $roomBookings = simplexml_load_file('xml/roomBookings.xml');
                $text = '<p>This room has been booked by these people:</p>';

                //iterate through bookings to find bookings made to the room given
                foreach ($roomBookings->booking as $booking) {
                    $roomNumber = $booking->number;
                    $bookingName = $booking->name;
                    if ($roomNumber == $number){
                        $text .= "<p>$bookingName</p>";
                    }
                }
                if(strlen($text) > 51){
                    echo $text . "<h2 id='sureText'>If you remove this room these bookings will be cancelled.</h2>";
                }
            ?>
        <form id="cancelBooking" action="<?php echo $_SERVER['PHP_SELF']; ?>"
              method="POST" novalidate>
            <input name="no" type="submit" class="checkOut" value="no">
            <input name="yes" type="submit" class="checkOut" value="yes">
        </form>
        <?php




            //if admin wants to edit/add a room
            }elseif ($task == 'edit' || $task == 'add'){

                if($task == 'edit'){
                    //open document and set session to room values
                    $hotelRooms = simplexml_load_file('xml/availableRooms.xml');
                    foreach ($hotelRooms->hotelRoom as $room) {
                        //get room number
                        $roomNumber = $room->number;
                        if ($roomNumber == $number){
                            $_SESSION['type'] = $room->roomType;
                            $_SESSION['description'] = $room->description;
                            $_SESSION['price'] = $room->pricePerNight;
                        }
                    }
                }

                if($task == 'edit'){
                    ?>
                    <h2 class=\"more-margin\">
                        Edit the details you want to change:</h2>
                    <form id="cancelBooking" class="checkoutForm"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>"
                          method="POST" novalidate>
                        <fieldset>
                            <legend>Room <?php echo "$number"?>
                                Details:</legend>
                    <?php

                }elseif ($task == 'add'){
                    ?>
                    <h2 class=\"more-margin\">Enter the details for the new room:</h2>
                    <form id="cancelBooking" class="checkoutForm"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>"
                          method="POST" novalidate>
                        <fieldset>
                            <legend>Room Details:</legend>
                    <?php

                }
        ?>
                <p>
                    <label for="number">Room Number:</label>
                    <input type="text" name="number" id="number"
                        <?php
                        if ($task == 'edit') {
                            $text = $_SESSION['number'];
                            echo "value='$text' readonly";
                        }elseif (isset($_SESSION['type'])){
                            $text = $_SESSION['number'];
                            echo "value='$text'";
                        }?>>
                </p>
                <p>
                    <label for="type">Room Type:</label>
                    <input type="text" name="type" id="type"
                        <?php
                        if (isset($_SESSION['type'])) {
                            $text = $_SESSION['type'];
                            echo "value='$text'";
                        }?>>
                </p>
                <p>
                    <label for="description">Description:</label>
                    <textarea name="description" id="description"><?php
                        if (isset($_SESSION['description'])) {
                            $text = $_SESSION['description'];
                            echo $text;
                        }?></textarea>
                </p>
                <p>
                    <label for="price">Price per Night:</label>
                    <input type="number" name="price" id="price"
                        <?php
                        if (isset($_SESSION['price'])) {
                            $text = $_SESSION['price'];
                            echo "value='$text''";
                        }?>>
                </p>
            </fieldset>
                <?php
                if ($task == 'edit') {
                    echo "<input name=\"update\" type=\"submit\" class=\"checkOut\" value=\"update\">";
                }elseif ($task == 'add'){
                    echo "<input name=\"save\" type=\"submit\" class=\"checkOut\" value=\"Save\">";
                }
                ?>

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
