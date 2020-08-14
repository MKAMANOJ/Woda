window.Vue = require('vue');
Vue.component('vue-pagination', require('../../general/components/Pagination.vue'));
$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
  }
});
var generalMethods = {
  data: {
    status: '',
  },
  methods: {
    /*
      * Get the background color
      * parameter string status
      */
    getBackgroundColour: function(status) {
      switch (status) {
        case "new":
          return 'yellow-bg';
        case "approved":
          return 'green-bg';
        case "declined":
          return 'red-bg';
        default:
          return 'red-bg';
      }
    },
    /*
     * Get the quote status
     * parameter string status, string role
     */
    getQuoteStatus(status, role) {
      switch (status) {
        case "new":
          return role === "finder" ? 'Sent' : "New Quotation Request";
        case "approved":
          return "Approved";
        case "declined":
          return "Declined";
        case "expired":
          return "Expired";
        default:
          return "Not Available";
      }
    },
    /**
     * Get formatted quote id.
     * @param quoteId
     * @returns {string}
     */
    getQuoteId(quoteId) {
      return 'QT #000' + quoteId;
    },
    /**
     * Get formatted quote id.
     * @param warehouseId
     * @returns {string}
     */
    getWarehouseId(warehouseId) {
      return 'Warehouse #000' + warehouseId;
    },
    /**
     * Get formatted Finder id.
     * @param finderId
     * @returns {string}
     */
    getFinderId(finderId) {
      return 'Client #000' + finderId;
    }
  }
};
var app = new Vue({
  el: '#filter-div',
  data: {
    status: '',
    quote: '',
    warehouse: '',
    clientId: '',
    url: url,
    scheduleMovement: scheduleMovement
  },
  methods: {
    /*
     * Filters the data
     */
    filterData() {
      var self = this;
      status = self.status;
      quote = self.quote;
      warehouse = self.warehouse;
      clientId = self.clientId;
      url = self.url + "?status=" + status + "&quote=" + quote + "&warehouse=" + warehouse + "&clientId=" + clientId;
      app1.getPresentData(1, 0);
      app2.getPastData(1, 1);
    },
    /*
     * Resets the form.
     */
    resetFilterForm() {
      var self = this;
      self.status = '';
      self.quote = '';
      self.warehouse = '';
    }
  }
});
var app1 = new Vue({
    el: '#current',
    mixins: [generalMethods],
    data: {
      quotes: [],
      counter: 0,
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        past: 0
      },
      offset: 4,
      role: '',
      url: url,
      loading: false,
      new_quote_text: 'Send a New Quote',
      no_quotes: '',
      schedule_movement: 'Schedule Movement',
      view_details: 'View Details',
      edit: 'Edit',
      cancel: 'Cancel'
    },
    mounted() {
      this.loading = true;
      this.getPresentData(this.pagination.current_page, 0);
    },
    methods: {
      /*
     * Get the present data
     * parameter page, past
     */
      getPresentData(page, past) {
        var self = this;
        $.ajax({
          url: url,
          data: {
            page: page,
            past: past
          }
        })
          .done(function(response) {
            self.quotes = response.data;
            self.pagination = response;
            self.role = response.role;
            self.loading = false;
            self.no_quotes = 'No Quotes Available';
          })
          .fail(function(response) {
          });
      }
    }
  })
;
/**
 * For past data.
 */
var app2 = new Vue({
  el: '#past',
  mixins: [generalMethods],
  data: {
    quotes: [],
    counter: 0,
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 50,
      current_page: 1,
      past: 1
    },
    offset: 4,
    role: '',
    loading: false,
  },
  mounted() {
    this.loading = true;
    this.getPastData(this.pagination.current_page, 1);
  },
  methods: {
    /*
     * Get the past data
     * parameter page, past
     */
    getPastData(page, past) {
      var self = this;
      $.ajax({
        url: url,
        data: {
          page: page,
          past: past
        }
      })
        .done(function(response) {
          self.quotes = response.data;
          self.pagination = response;
          self.role = response.role;
          self.loading = false;
        })
        .fail(function(response) {
        });
    }
  }
});
