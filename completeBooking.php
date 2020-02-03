<?php
session_start();
$scriptList = array('jquery-3.3.1.min.js', 'Cookies.js', 'chosenRooms.js');
$admin = false;
$book = true;
include("phpFiles/header.php");
?>

<main>
    <h2 class="booked">Your pending booking:</h2>

    <table id="bookingTable"></table>
    <!-- table inserted here via javaScript, displays all the pending bookings and total price-->

    <p class="checkOutText">Please fill out the form below in order
        to complete your booking:</p>
    <section>
        <!-- form to gather the customer's personal details-->
        <form class="checkoutForm" action="validateCheckout.php"
              method="POST" novalidate>
            <fieldset>
                <legend> Personal Details: </legend>
                <p>
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name"
                        <?php
                        if (isset($_SESSION['name'])) {
                            $text = $_SESSION['name'];
                            echo "value='$text''";
                        }?>>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email"
                        <?php
                        if (isset($_SESSION['email'])) {
                            $text = $_SESSION['email'];
                            echo "value='$text''";
                        }?>>
                </p>
            </fieldset>
            <input class="checkOut" id="delete" type="button"
                   value="Cancel">
            <input class="checkOut" type="submit">
        </form>
    </section>
</main>

<?php include("phpFiles/footer.php"); ?>
