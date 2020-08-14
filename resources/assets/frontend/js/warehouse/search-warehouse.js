require('../../../../assets/admin/js/bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

Vue.component('vue-google-autocomplete', require('../../../../assets/general/components/VueGoogleAutoComplete.vue'));

$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
  }
});

const app = new Vue({
  el: '#search-warehouse',
  data: {
    address: {},
    disableButton: true,
  },
  methods: {
    /**
     * When the location found
     * @param {Object} addressData Data of the found location
     * @param {Object} placeResultData PlaceResult object
     * @param {String} id Input container ID
     */
    getAddressData(addressData, placeResultData, id) {
      var self = this;
      self.address = addressData;
      self.disableButton = false;
      $('#location').val(jQuery.param(addressData));
    },
  }
});
