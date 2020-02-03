<?php

//converts date to long form e.g. 12 January 2018
function convertDate($date){
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
        'August', 'September', 'October', 'November', 'December'];
    $dates = explode("/", $date);
    $dates[1] = $months[((int)$dates[1])-1];
    return $dates;
}