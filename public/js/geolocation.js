var latitud = document.getElementById("latitud");
var longitud = document.getElementById("longitud");
var map;
var marker;
var ubicacion = {
    lat: -25.289613859761218,
    lng: -57.61422266394146
};

function initMap(position, status) {
    // getLocation();
    if (status) {
        ubicacion = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };
    }

    map = new google.maps.Map(document.getElementById('map'), {
        center: ubicacion,
        zoom: 15
    });
    marker = new google.maps.Marker({
        position: ubicacion,
        map: map
    });
    map.addListener('click', function (e) {
        placeMarkerAndPanTo(e.latLng, map);
    });
}

function placeMarkerAndPanTo(latLng, map) {
    marker.setMap(null);
    marker = new google.maps.Marker({
        position: latLng,
        map: map
    });
    this.latitud.value = latLng.toJSON().lat;
    this.longitud.value = latLng.toJSON().lng;
    map.panTo(latLng);
}

var x = document.getElementById("demo");

function updateLocation(position) {
    this.latitud.value = position.coords.latitude;
    this.longitud.value = position.coords.longitude;
    initMap(position, true);
}

var apiGeolocationSuccess = function apiGeolocationSuccess(position) {
    // alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
    updateLocation(position);
};

var tryAPIGeolocation = function tryAPIGeolocation() {
    jQuery.post("https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDRWr3XaN1XMeSTSlxKALELBeYu-ObXhxY", function (success) {
        apiGeolocationSuccess({
            coords: {
                latitude: success.location.lat,
                longitude: success.location.lng
            }
        });
    }).fail(function (err) {
        initMap(ubicacion, false);
        alert('No se pudo obtener la ubicación');
    });
};

var browserGeolocationSuccess = function browserGeolocationSuccess(position) {
    //  alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
    updateLocation(position);
};

var browserGeolocationFail = function browserGeolocationFail(error) {
    switch (error.code) {
        case error.TIMEOUT:
            alert("Browser geolocation error !\n\nTimeout.");
            break;

        case error.PERMISSION_DENIED:
            if (error.message.indexOf("Only secure origins are allowed") == 0) {
                tryAPIGeolocation();
            }

            break;

        case error.POSITION_UNAVAILABLE:
            alert("Browser geolocation error !\n\nPosition unavailable.");
            break;
    }
};

var getLocation = function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(browserGeolocationSuccess, browserGeolocationFail, {
            maximumAge: 50000,
            timeout: 20000,
            enableHighAccuracy: true
        });
    }
};
