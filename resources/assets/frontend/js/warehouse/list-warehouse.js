window.Vue = require('vue');
window.axios = require('axios');

Vue.component('vue-pagination', require('../../../../assets/general/components/Pagination.vue'));
Vue.component('vue-google-autocomplete', require('../../../../assets/general/components/VueGoogleAutoComplete.vue'));

$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
  }
});

const app = new Vue({
  el: '#quote-warehouse',
  data: {
    address: '',
    pallet_quantity: palletQuantity,
    distance: 5,
    warehouseData: '',
    is_search: false,
    sort_by: '1',
    checked_warehouse_type: [],
    checked_additional_offer: [],
    checked_accreditation: [],
    warehouses: [],
    counter: 0,
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
  },
  mounted() {
    var self = this;
    if (ourLocation !== '[]') {
      const inputAddress = JSON.parse(ourLocation);
      self.address = inputAddress;
      self.is_search = true;
      $('#map').val(inputAddress.locality).change();
    }
    this.getWarehouses(this.pagination.current_page);
  },
  methods: {
    /**
     * Fetch the warehouses
     * @param {number} page Page number for pagination.
     */
    getWarehouses(page) {
      var self = this;
      axios.get(warehouseUrl, {
        params: {
          page: page,
          warehouse: self.checked_warehouse_type.join(','),
          additional_offers: self.checked_additional_offer.join(','),
          accreditation: self.checked_accreditation.join(','),
          location: self.address,
          pallet_quantity: self.pallet_quantity,
          distance: self.distance,
          searching: self.is_search,
          sort_by: self.sort_by
        }
      }).then(function(response) {
        self.warehouseData = response.data.html;
        self.pagination = response.data.data;
      });
    },
    getWarehousesAfterClick() {
      this.getWarehouses(1);
    },
    /**
     * When the location found
     * @param {Object} addressData Data of the found location
     * @param {Object} placeResultData PlaceResult object
     * @param {String} id Input container ID
     */
    getAddressData(addressData, placeResultData, id) {
      this.address = addressData;
    },
    searchWarehouses() {
      this.is_search = true;
      this.getWarehouses(1);
    }
  }
});
