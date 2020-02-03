<?php

/**
 * Check to see if a string contains any content or not.
 * Leading and trailing whitespace are not considered to be 'content'.
 *
 * @param string $str The string to check.
 * @return True if $str is empty, false otherwise.
 */
function isEmpty($str) {
    return strlen(trim($str)) == 0;
}

/**
 * Check to see if a string looks like an email.
 * Email validation is actually fairly complex, so this is a thin wrapper
 * around a PHP filter function.
 *
 * @param string $str The string to check.
 * @return True if $str looks like a valid email address, false otherwise.
 */
function isEmail($str) {
    // There's a built in PHP tool that has a go at this
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}



function validateCheckout(){

    $isCorrect = true;

    // Validate Personal Details

    // Check the name is filled out
    if (!(isset($_POST['name'])) || (isEmpty($_POST['name']))) {
        $isCorrect = false;
        ?>
        <h2>A name must be provided</h2>
        <?php
    }

    // Check Email is filled out correctly
    $email = $_POST['email'];
    if (!(isset($email)) || (isEmpty($email))) {
        $isCorrect = false;
        ?>
        <h2>An email must be provided</h2>
        <?php
    } else if (!(isEmail($email))) {
        $isCorrect = false;
        ?>
        <h2>The email provided is not a valid email</h2>
        <?php
    }
    if(!$isCorrect){
        ?>
        <input class="checkOut" id="backBtn" type="button" value="Back">
<?php
    }
    return $isCorrect;
}


?>