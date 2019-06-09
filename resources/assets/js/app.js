
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

const registerGrillScope = {

    init: function(){
        this.getCoordinatesFromZipCode('150007');
    },

    getCoordinatesFromZipCode: function(zipCode){
        let geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': 'zipcode '+zipCode}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              //Got result, center the map and put it out there
              console.log(results[0].geometry.location.lat());
              console.log(results[0].geometry.location.lng());
            } else {
              alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
}

$(document).ready(function() {
    registerGrillScope.init();
});
