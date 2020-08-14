window.Vue = require('vue');

Vue.component('vue-pagination', require('./components/Paginate.vue'));

$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
  }
});

var myMixins = {
  methods: {
    /*
     * Get the background color
     * parameter status
     */
    getBackgroundColour: function(status) {
      switch (status) {
        case "new":
          return 'yellow-bg';
        case "approved":
          return 'green-bg';
        case "declined":
          return 'red-bg';
        case "revision-for-review-filler":
          return 'brown-bg';
        case "revision-for-review-finder":
          return 'brown-bg';
        default:
          return 'red-bg';
      }
    },
    /*
     * Get the movement status
     * parameter status, role
     */
    getMovementStatus(status, role) {
      switch (status) {
        case "new":
          return role === "finder" ? 'Sent' : "New Movement Request";
        case "approved":
          return "Approved";
        case "declined":
          return "Declined";
        case "revision-for-review-filler":
          return role === "finder" ? "Revision for review (Received)" : "Revision for review (Sent)";
        case "revision-for-review-finder":
          return (role === "filler") ? "Revision for review (Received)" : "Revision for review (Sent)";
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
      return 'QT#000' + quoteId;
    },

    getTotalNumberOfPalletsOnMovement: function(movements) {
      let sum = 0;
      movements.forEach(function(movement) {
        sum += movement.no_palates_to_move;
      });
      return sum;
    }
  }
};

var app = new Vue({
  el: '#filter-div',
  data: {
    status: '',
    quotation: '',
    customer: '',
    url: url,
  },
  methods: {
    /*
     * Filters the data
     */
    filterData() {
      var self = this;
      status = self.status;
      quotation = self.quotation;
      customer = self.customer;
      url = self.url + "?status=" + status + "&quotation=" + quotation + "&customer=" + customer;
      app1.getPresentData(1, 0);
      app2.getPastData(1, 1);
    },
    /*
     * Resets the form.
     */
    resetFilterForm() {
      var self = this;
      self.status = '';
      self.quotation = '';
      self.customer = '';
    }
  }
});

/**
 * For present data.
 */
var app1 = new Vue({
    el: '#current',
    mixins: [myMixins],
    data: {
      movements: [],
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
      loading: false,
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
            self.movements = response.data;
            self.pagination = response;
            self.role = response.role;
            self.loading = false;
          })
          .fail(function(response) {
            alert('Something went wrong!! Please reload.');
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
  mixins: [myMixins],
  data: {
    movements: [],
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
    getPastData(page, past, status = null) {
      var self = this;
      $.ajax({
        url: url,
        data: {
          page: page,
          past: past
        }
      })
        .done(function(response) {
          self.movements = response.data;
          self.pagination = response;
          self.role = response.role;
          self.loading = false;
        })
        .fail(function(response) {
          alert('Something went wrong!! Please reload.');
        });
    }
  }
});
