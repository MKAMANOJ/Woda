var alertToggleDefaultSettings = {
  title: "Are you sure?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  cancelButtonText: "No",
  closeOnConfirm: true,
  closeOnCancel: true
};
/**
 * Method to generate sweet alert for delete case
 *
 * @param _this this instance
 */
function swalDeletePopup(_this) {
  swal({
      title: _this.data('title') ? _this.data('title') : "Are you sure ?",
      text: _this.data('text') ? _this.data('text') : "You will not be able to recover this",
      type: _this.data('type') ? _this.data('type') : "warning",
      showCancelButton: true,
      confirmButtonClass: _this.data('confirm_button_class') ? _this.data('confirm_button_class') : "btn-danger",
      confirmButtonText: _this.data('confirm_button_text') ? _this.data('confirm_button_text') : "Yes, delete it!",
      closeOnConfirm: false
    },
    function() {
      let form;
      if (form = _this.data('form')) {
        let formAction = $(_this).data('action');
        let element = $('#' + form);
        if (formAction) {
          element.attr('action', formAction);
        }
        element.submit();
      }
      _this.closest('form').submit();
    });
}

var dataTable = null;
var jqueryDataTable = function() {
  var initDataTable = function() {
    var table = $('.data-table');
    dataTable = table.dataTable({
      "language": {
        "aria": {
          "sortAscending": ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        },
        "emptyTable": "No data available in table",
        "info": "Showing _START_ to _END_ of _TOTAL_ records",
        "infoEmpty": "No records found",
        "infoFiltered": "(filtered1 from _MAX_ total records)",
        "lengthMenu": "Show _MENU_",
        "search": "Search:",
        "zeroRecords": "No matching records found",
      },
      "bStateSave": true,
      "lengthMenu": [
        [10, 20, 50, -1],
        [10, 20, 50, "All"]
      ],
      "pageLength": 10,
    });
  };

  return {
    init: function() {
      if (!jQuery().dataTable) {
        return;
      }
      initDataTable();
    }
  };
}();

function sweetAlertDelete() {
  $(document).on('click', '.mt-sweetalert', function(e) {
    e.preventDefault();
    swalDeletePopup($(this));
  });
}

function dataExport() {
  $(document).on('click', 'button.btn-export', function(e) {
    e.preventDefault();
    let form;
    if (form = $(this).data('form')) {
      let formAction = $(this).data('action');
      $('#' + form).attr('action', formAction);
      $('#' + form).submit();
    }
  });
}

jQuery(document).ready(function() {
  jqueryDataTable.init();
  sweetAlertDelete();
  dataExport();
});

// Restrict numeric number to accept only numeric characters
var numericFields = $('form').find('.numeric').attr('oninput', "this.value=this.value.replace(/[^0-9]/g,'')");
//Slug Generator
function convertToSlug(value) {
  value = value.replace(/^\s+|\s+$/g, ''); // trim
  value = value.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
  var to = "aaaaaeeeeeiiiiooooouuuunc------";
  for (var i = 0, l = from.length; i < l; i++) {
    value = value.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  value = value.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return value;
}

$(document).ready(function() {
    $('.alert').not('.alert-important').delay(3000).fadeOut(1000);
});

