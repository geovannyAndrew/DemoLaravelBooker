
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('gasparesganga-jquery-loading-overlay');
require('jquery-validation');

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
        this.addSubmitAction();
    },

    addSubmitAction: function(){
        let buttonForm = $('#button-submit');
        let global = this;
        buttonForm.click(function(){
            global.validateForm();
            //global.validateZipCodeFromForm();
        });
    },

    validateForm: function(){
        let form = $('#form_create_grill');
        let validator = form.validate();
        if(validator.form()){
            this.validateZipCodeFromForm();
        }
    },

    validateZipCodeFromForm(){
        let zipCode = $('#zipcode').val();
        console.log(zipCode);
        this.getCoordinatesFromZipCode(zipCode);
    },

    getCoordinatesFromZipCode: function(zipCode){
        let geocoder = new google.maps.Geocoder();
        let latitudeField = $('#latitude');
        let longitudeField = $('#longitude');
        let form = $('#form_create_grill');
        $.LoadingOverlay('show');
        geocoder.geocode( { 'address': 'zipcode '+zipCode}, function(results, status) {
            $.LoadingOverlay('hide');
            if (status == google.maps.GeocoderStatus.OK) {
              //Got result, center the map and put it out there
              latitudeField.val(results[0].geometry.location.lat());
              longitudeField.val(results[0].geometry.location.lng());
              form.submit();
            } else {
              alert("Please try a valid zipcode: " + status);
            }
        });
    }
}


const grillsNearScope = {
    init:function(){
        this.checkIfUrlContainsLocation();
        this.setButtonUpdateLocation();
    },

    checkIfUrlContainsLocation: function(){
        let url = window.location.href;
        console.log(url);
        if(url.indexOf('?location=') == -1){
            this.tryGeolocateUser();
        }
    },

    setButtonUpdateLocation: function(){
        let buttonLocation = $('#button_update_location');
        let global = this;
        buttonLocation.click(function(){
            global.tryGeolocateUser();
        });
    },

    tryGeolocateUser: function(){
        if(location.protocol == 'https:' || location.host.indexOf('localhost')>-1){
            if(navigator.geolocation){
                $.LoadingOverlay('show');
                navigator.geolocation.getCurrentPosition(this.getUserPosition);
            }
            else{
                console.log("Geolocation is not supprted in this browser");
            }
        }
        
        
    },

    getUserPosition: function(position){
        $.LoadingOverlay('hide');
        let url = location.protocol + '//' + location.host + location.pathname;
        url = url+'?location='+position.coords.latitude+','+position.coords.longitude;
        window.location.href = url;
    }
}

$(document).ready(function() {

    if($('body').hasClass('bb-create-grill')){
        registerGrillScope.init();
    }
    else if($('body').hasClass('bb-grills-near')){
        grillsNearScope.init();
    }
});
