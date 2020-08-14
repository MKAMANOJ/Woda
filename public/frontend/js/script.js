var alertToggleDefaultSettings = {
  title: "Are you sure?",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes",
  cancelButtonText: "Cancel",
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
      text: _this.data('text') ? _this.data('text') : "",
      type: _this.data('type') ? _this.data('type') : "warning",
      showCancelButton: true,
      confirmButtonClass: _this.data('confirm_button_class') ? _this.data('confirm_button_class') : "btn-danger",
      confirmButtonText: _this.data('confirm_button_text') ? _this.data('confirm_button_text') : "Yes!",
      closeOnConfirm: false,
    },
    function() {
      const isLink = !!_this.is('a');
      if (isLink) {
        window.location.href = $(_this).attr('href');
      } else {
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
      }
    }
  );
}

function sweetAlertDelete() {
  $(document).on('click', '.mt-sweetalert', function(e) {
    e.preventDefault();
    swalDeletePopup($(this));
  });
}

$(document).ready(function() {
  sweetAlertDelete();
});
