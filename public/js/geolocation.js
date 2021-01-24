/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/geolocation.js":
/*!*************************************!*\
  !*** ./resources/js/geolocation.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var latitud = document.getElementById("latitud");
var longitud = document.getElementById("longitud");
var map;
var marker;
var ubicacion = {
  lat: -25.289613859761218,
  lng: -57.61422266394146
};

function initMap(position, status) {
  //getLocation();
  if (status) {
    ubicacion = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };
  }

  if (latitud && longitud) {
    ubicacion = {
      lat: Number(latitud.value),
      lng: Number(longitud.value)
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

/***/ }),

/***/ 1:
/*!*******************************************!*\
  !*** multi ./resources/js/geolocation.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/emilcefernandez/Documents/Tutorial/Carolina/sgrc/resources/js/geolocation.js */"./resources/js/geolocation.js");


/***/ })

/******/ });