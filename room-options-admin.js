var room_options = (function(){
    "use strict";

    var pub = {};

    /**
     * Displays all the available rooms on teh admin page.
     * Rooms have delete and edit buttons.
     */
    function parseRooms(data, target) {

        var text ="";
        var i, info, number, roomType, description, pricePerNight;

        info = $(data).find("hotelRoom");

        for(i=0; i < $(info).length; i+=1){
            number = $(info[i]).find("number")[0].textContent;
            roomType = $(info[i]).find("roomType")[0].textContent;
            description = $(info[i]).find("description")[0].textContent;
            pricePerNight = $(info[i]).find("pricePerNight")[0].textContent;

            text += "<div class=\"roomBooked\"><h3>Room Number: <span>"
                + number + "</span></h3> <p>"+ roomType + "</p><p>"
                + description + "</p><p>Price per night: &emsp;&emsp;NZD$" +
                "<span>" + pricePerNight +"</span></p> "+
                "<form method='post' action=\"editAvailableRooms.php\">" +
                "<input type=\"text\" name=\"numberRemove\" class=\"numberCancel\" " +
                "value='" + number +"'>" +
                "<input type=\"submit\" class=\"editRoomList\" name='edit' value=\"Edit\">" +
                "<input type=\"submit\" class=\"editRoomList\" name='remove' value=\"Remove\">" +
                "</form></div>";

        }

        $(target).after("<input id=\"addRoom\" class=\"adminButton\" type=\"submit\" value=\"Add a new Room\"> " +
            "<section class=\"bookedAdmin\">" + text+ "</section>");

        $("#addRoom").click(function(){
            window.location.href='editAvailableRooms.php';
        })

    }

    /**
     * Opens availableRooms file and calls parseRooms.
     */
    function showRooms() {
        var target, xmlSource;
        target = $(".availableRooms");
        $(target).show();
        xmlSource = "./xml/availableRooms.xml";

        $.ajax({
            type: "GET",
            url: xmlSource,
            cache: false,
            success: function(data) {
                parseRooms(data, target);
            },
            error: function() {
                $(target).html("<p>There was an error loading the details</p>");
            }
        });
    }

    pub.setup = function() {
        showRooms();
    };

    return pub;

}());

$(document).ready(room_options.setup);