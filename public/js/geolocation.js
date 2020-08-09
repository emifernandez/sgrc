var latitud = parseFloat(document.getElementById("latitud").value);
var longitud =  parseFloat(document.getElementById("longitud").value);
var map;
var marker;
const UBICACION_DEFAULT = {
    latitud: -25.291708,
    longitud: -57.626066,
};

if(isNaN(latitud) || isNaN(longitud) ) {
    latitud = UBICACION_DEFAULT.latitud;
    longitud = UBICACION_DEFAULT.longitud;
}
var ubicacion = {lat: latitud, lng: longitud};
function initMap(position, status) {
  // getLocation();
  if(status) {
    ubicacion = {lat: position.coords.latitude, lng: position.coords.longitude};
  }
  map = new google.maps.Map(document.getElementById('map'), {
    center: ubicacion,
    zoom: 15
  });
  marker = new google.maps.Marker({position: ubicacion, map: map});
  map.addListener('click', function(e) {
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
  document.getElementById("latitud").value = latLng.toJSON().lat;
  document.getElementById("longitud").value = latLng.toJSON().lng;
  map.panTo(latLng);
}


var x = document.getElementById("demo");

function updateLocation(position) {
    this.latitud.value = position.coords.latitude;
    this.longitud.value = position.coords.longitude;
    initMap(position, true);
}

var apiGeolocationSuccess = function(position) {
    // alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
    updateLocation(position);
};

var tryAPIGeolocation = function() {
	jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDRWr3XaN1XMeSTSlxKALELBeYu-ObXhxY", function(success) {
		apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
  })
  .fail(function(err) {
    initMap(ubicacion, false);
    alert('No se pudo obtener la ubicación');
  });
};

var browserGeolocationSuccess = function(position) {
  //  alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
  updateLocation(position);

};

var browserGeolocationFail = function(error) {
  switch (error.code) {
    case error.TIMEOUT:
      alert("Browser geolocation error !\n\nTimeout.");
      break;
    case error.PERMISSION_DENIED:
      if(error.message.indexOf("Only secure origins are allowed") == 0) {
        tryAPIGeolocation();
      }
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Browser geolocation error !\n\nPosition unavailable.");
      break;
  }
};

var getLocation = function() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
    	browserGeolocationSuccess,
      browserGeolocationFail,
      {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
  }
};
