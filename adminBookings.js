var adminBookings = (function(){
    "use strict";

    var pub = {};
    var checkInList = [];
    var checkOutList = [];
    var numberList = [];

    /**
     * Checks if each room is available on the selected dates.
     */
    pub.checkAvailability = function(number, checkIn, checkOut) {
        var i;
        for(i =0; i<numberList.length; i++) {

            if (numberList[i] === number) {

                //if the dates requested are in
                // between the previous booking dates
                if (checkIn >= checkInList[i] && checkIn <= checkOutList[i]){
                    return false;

                //if the previous booked dates are
                    // between the requested dates
                }else if (checkIn <= checkInList[i] &&
                    checkOut >= checkOutList[i]) {
                    return false;

                //if the requested checkOut is between the previous bookings
                }else if (checkOut >= checkInList[i]
                    && checkOut <= checkOutList[i]){
                    return false;

                }

                //if the requested checkIn is between the previous bookings
                }else if (checkIn >= checkInList[i]
                    && checkIn <= checkOutList[i]){
                    return false;

                }
            }

        return true;
    };

    /**
     * Takes the booked rooms and puts them into divs to be displayed.
     * adds each booked room's details to the appropriate lists.
     */
    function parseRooms(data, target) {

        var text ="<section class='bookedAdmin'>";
        var i, info, number, name, checkin, datesIn,
            datesOut, checkout, checkinTXT, checkoutTXT;

        var day, month, year;

        info = $(data).find("booking");

        for(i=0; i < $(info).length; i+=1){

            number = $(info[i]).find("number")[0].textContent;
            name = $(info[i]).find("name")[0].textContent;

            //date one
            datesIn = $(info[i]).find("checkin");

            day = $(datesIn[0]).find("day")[0].textContent;
            month = $(datesIn[0]).find("month")[0].textContent;
            year = $(datesIn[0]).find("year")[0].textContent;

            checkin = new Date(day + " " + month + " " + year);
            checkinTXT = checkin.getDate() + "/" + (checkin.getMonth()
                + 1) + "/" + checkin.getFullYear();

            //date two
            datesOut = $(info[i]).find("checkout");

            day = $(datesOut[0]).find("day")[0].textContent;
            month = $(datesOut[0]).find("month")[0].textContent;
            year = $(datesOut[0]).find("year")[0].textContent;

            checkout = new Date(day + " " + month + " " + year);
            checkoutTXT = checkout.getDate()+ "/"+ (checkout.getMonth()
                + 1) + "/" + checkout.getFullYear();

            checkInList.push(checkin);
            checkOutList.push(checkout);
            numberList.push(number);

            text += "<div class=\"roomBooked\"> " +
                "<h3>Room Number: <span>" + number +"</span></h3>" +
                "<p>Booked by: " + name +"</p>" +
                "<p>Check in date: " + checkinTXT + "</p>" +
                "<p>Check out Date: " + checkoutTXT + "</p>" +
                "<form method='post' action=\"cancelBooking.php\">" +
                "<input type=\"text\" name=\"numberCancel\" " +
                "class=\"numberCancel\" " +
                "id=\"numberCancel\" value='" + number +"'>" +
                "<input type=\"text\" name=\"dateCancel\" " +
                "class=\"numberCancel\" " +
                "id=\"dateCancel\" value='" + checkinTXT +"'>" +
                "<input type=\"submit\" " +
                "class=\"adminCancel\" value=\"Cancel\" /></form></div>";

        }
        $(target).after(text + "</section>");

    }

    /**
     * loads roomBookings files and calls parseRooms.
     */
    function showBookings() {
        var target, xmlSource;
        target = $(".bookings");
        xmlSource = "./xml/roomBookings.xml";

        $.ajax({
            type: "GET",
            url: xmlSource,
            cache: false,
            success: function(data) {
                parseRooms(data, target);
            },
            error: function() {
                $(target).html("<p>There was an error " +
                    "loading the details</p>");
            }
        });
    }

    pub.setup = function() {
        //calls the function to open then display bookings
        showBookings();
    };

    return pub;

}());

$(document).ready(adminBookings.setup);