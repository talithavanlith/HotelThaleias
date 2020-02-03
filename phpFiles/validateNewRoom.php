<?php

function isDigits($str) {
    $pattern='/^[0-9]+$/';
    return preg_match($pattern, $str);
}

function isEmpty($str) {
    return strlen(trim($str)) == 0;
}

function validateCheckout(){

    $isCorrect = true;

    // Validate Personal Details

    // Check the number is filled out and is digits
    if (!(isset($_POST['number'])) || (isEmpty($_POST['number']))) {
        $isCorrect = false;
        ?>
        <h2>A room number must be provided</h2>
        <?php
    }elseif (!isDigits($_POST['number'])){
        $isCorrect = false;
        ?>
        <h2>The room number must consist of only digits</h2>
        <?php
    }

    // Check type is filled out
    if (!(isset($_POST['type'])) || (isEmpty($_POST['type']))) {
        $isCorrect = false;
        ?>
        <h2>A room type must be provided</h2>
        <?php
    }

    // Check description is filled out
    if (!(isset($_POST['description'])) || (isEmpty($_POST['description']))){
        $isCorrect = false;
        ?>
        <h2>A description must be provided</h2>
        <?php
    }

    // Check the price is filled out and is digits
    if (!(isset($_POST['price'])) || (isEmpty($_POST['price']))) {
        $isCorrect = false;
        ?>
        <h2>A price per night must be provided and have only digits
            and/or a decimal point</h2>
        <?php
    }

    return $isCorrect;
}

if((isset($_POST['update']))){
    if(!validateCheckout()){
        $task = 'edit';
        $_SESSION['number'] = $_POST['number'];
    }else{
        $task = 'editDone';
    }

}elseif ((isset($_POST['save']))){
    if (!validateCheckout()){
        $task = 'add';
        $_SESSION['number'] = $_POST['number'];
        $_SESSION['type'] = $_POST['type'];
        $_SESSION['description'] = $_POST['description'];
        $_SESSION['price'] = $_POST['price'];
    }else{
        $task = 'addDone';
    }

}else{
    $task = 'add';
}