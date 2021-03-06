

var mapCode = (function(){
    "use strict";
    var map, hotel, apollon, zorbas, spartacos, apollonPU,
        zorbasPU, spartacosPU, church, winery, lookout,
        churchPU, wineryPU, lookoutPU;

    var pub = {};

    /**
     * Sets map view when details about the hotel destination are clicked.
     */
    function centreMap() {
        var markerLocation, markerBounds;

        if (this.textContent === "Spartacos Pizzeria:") {
            markerLocation = [spartacos.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }else if (this.textContent === "Apollon Restaurant:") {
            markerLocation = [apollon.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }else if (this.textContent === "Senor Zorba Cafe Bar:") {
            markerLocation = [zorbas.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }else if (this.textContent === "Epar Lookout:") {
            markerLocation = [lookout.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }else if (this.textContent === "Santo Winery:") {
            markerLocation = [winery.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }else if (this.textContent === "Ekklisia Agia Marina Church:") {
            markerLocation = [church.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }else {
            markerLocation = [hotel.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
    }

    /**
     * Shows food markers when switch is on.
     */
    function showFoodMarkers() {

        spartacos = L.circle([36.386314, 25.430474],
            {
                radius: 30,
                color: "orange",
                fillColor: "orange",
                fillOpacity: 0.5
            }).addTo(map);

        apollon = L.circle( [36.385688, 25.429037],
            { radius: 30,
                color: "orange",
                fillColor: "orange",
                fillOpacity: 0.5 } ).addTo(map);
        zorbas = L.circle( [36.390728, 25.438982],
            { radius: 30,
                color: "orange",
                fillColor: "orange",
                fillOpacity: 0.5 } ).addTo(map);

        spartacosPU = spartacos.bindPopup("<img class=\"popup_img\" " +
            "src=\"images/pizza.jpg\" alt=\"spartacos\" width='175px'><div> " +
            "<p class='popup-text'><b>Spartacos Pizzeria:</b>" +
            " <br>Address: Ormos Athinios 857 00<br> Phone: +30 3929 665367" +
            "</p></div>");
        // image above by ivan Torres
        apollonPU = apollon.bindPopup("<img class=\"popup_img\" " +
            "src=\"images/cocktail.jpg\" alt=\"apollon\" width='170px'><div> " +
            "<p class='popup-text'><b>Apollon Restaurant:</b> " +
            "<br>Address: Ormos Athinios 827 00<br> Phone: +30 2919 091029" +
            "</p></div>");
        // image above by ivan Torres
        zorbasPU = zorbas.bindPopup("<img class=\"popup_img\" " +
            "src=\"images/cafe.jpg\" alt=\"zorbas\" width='160px'><div> " +
            "<p class='popup-text'><b>Senor Zorba Cafe Bar:</b> " +
            "<br>Address: Pirgos Thira 547 00<br> Phone: +30 2314 902910" +
            "</p></div>");
        // image above by ivan Torres

    }

    /**
     * Shows activity markers when switch is on.
     */
    function showActivityMarkers() {

        church = L.circle( [36.380609, 25.429332],
            { radius: 30,
                color: "orange",
                fillColor: "orange",
                fillOpacity: 0.5 } ).addTo(map);
        lookout = L.circle( [36.391384, 25.432733],
            { radius: 30,
                color: "orange",
                fillColor: "orange",
                fillOpacity: 0.25 } ).addTo(map);
        winery = L.circle( [36.387532, 25.436509],
            { radius: 30,
                color: "orange",
                fillColor: "orange",
                fillOpacity: 0.25 } ).addTo(map);

        wineryPU = winery.bindPopup("<img class=\"popup_img\" " +
            "src=\"images/wine.jpg\" alt=\"wine\" width='140px'><div> " +
            "<p class='popup-text'><b>Santo Winery:</b> " +
            "<br>Address: Thira 947 00" +
            "<br> Phone: +30 8371 117282</p></div>");
        // image above by Snapwire

        churchPU = church.bindPopup("<img class=\"popup_img\" " +
            "src=\"images/church.jpg\" alt=\"church\" width='180px'><div> " +
            "<p class='popup-text'><b>Ekklisia Agia Marina Church:</b> " +
            "<br>Address: Megalochori 987 00<br> Phone: +30 9800 108256" +
            "</p></div>");
        // image above by Snapwire
        lookoutPU = lookout.bindPopup("<img class=\"popup_img\" " +
            "src=\"images/lookout.jpg\" alt=\"lookout\" width='170px'><div> " +
            "<p class='popup-text'><b>Epar Lookout:</b> " +
            "<br>Address: Ormou Athiniou 537 00" +
            "<br> Phone: +30 7284 111920</p></div>");
        // image above by Snapwire

    }

    /**
     * Sets up map view and calls other functions when user interacts with page.
     */
    pub.setup = function() {

        //sets map view
        map = L.mapCode("map").setView([36.387761, 25.431633], 15);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                maxZoom: 18,
                attribution: "Map data &copy; " +
                    "<a href=\"http://www.openstreetmap.org/copyright\">" +
                    "OpenStreetMap contributors</a> CC-BY-SA"
            }).addTo(map);


        // sets food markers
        showFoodMarkers();

        $("#food").click(function () {

            if($("#food").is(":checked")){
                showFoodMarkers();

            //remove food markers when the switch is unchecked
            }else{
                spartacos.remove();
                apollon.remove();
                zorbas.remove();
                spartacosPU.remove();
                apollonPU.remove();
                zorbasPU.remove();


            }
        });

        // sets activity markers
        showActivityMarkers();

        $("#activity").click(function () {

            if($("#activity").is(":checked")){
                showActivityMarkers();

            //remove activity markers when the switch is unchecked
            }else{
                lookout.remove();
                church.remove();
                winery.remove();
                lookoutPU.remove();
                churchPU.remove();
                wineryPU.remove();

            }
        });

        //sets hotel marker and popup
        hotel = L.marker([36.387761, 25.431633]).addTo(map);

        hotel.bindPopup("<img class=\"popup_img\" src=\"images/hotel.jpg\" " +
            "alt=\"hotel\" width='200px'><div> " +
            "<h2 class='popup-head'>Hotel Thaleoas" +
            "</h2> " +"<p class='popup-text'>Epar.Od. Ormou Athiniou" +
            "<br> No. 750 00 " +
            "<br> Phone: +30 9001 277227</p></div>");
            //above by Andreas Kontokanis

        $(".place").click(centreMap).css("cursor", "pointer");
    };



    return pub;

}());


$(document).ready(mapCode.setup);