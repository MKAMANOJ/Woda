window.Vue = require('vue');
var $ = require("jquery");

var vue = new Vue({
  el: '#app',
  data: {
    sameAsAboveCheckBox: oldSameAsAbove
  },
  methods: {
    sameAsAbove(event) {
      if (event.target.checked) {
        $('#postal_address_line1').val($('#address_line1').val());
        $('#postal_address_line2').val($('#address_line2').val());
        $('#postal_state_id').val($('#state_id :selected').val());
        $('#postal_post_code').val($('#post_code').val());
      }
    },
    defaultImage: function(defaultImage, uploadedImage, event) {
      var img = $('<img>');
      if (event.target.checked) {
        $('#listing-image').html(img.attr('src', defaultImage));
      }
      else {
        $('#listing-image').html(img.attr('src', uploadedImage));
      }
    }
  }
});

$('.number_only').each(function(i, obj) {
  var field = ($(obj).attr('oninput', "this.value=this.value.replace(/[^0-9.]/g,'')"));
});

// For phone number validation
$(document).on('keydown', '.phoneNumber', function(event) {
  if (event.shiftKey == true) {
    event.preventDefault();
  }
  if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) ||
    event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 107 || event.keyCode == 187) {
  } else {
    event.preventDefault();
  }
  if ($(this).val().indexOf('+') !== -1 && (event.keyCode == 107 || event.keyCode == 187))
    event.preventDefault();
});

$('.error-message').each(function() {
  $(this).closest('div').addClass('has-error');
});

$('body').on('keydown', '.form-control', function() {
  $(this).closest('div').removeClass('has-error');
  $(this).next('span').text('');
});

$('#change-password-modal').on('shown.bs.modal', function(e) {
  var password = $('#password');
  var password_confirmation = $('#password_confirmation');
  password.val('');
  password.next('span').empty();
  password_confirmation.val('');
  password_confirmation.next('span').empty();
});
$('#form-change-password').on('submit', function(e) {
  e.preventDefault();
  $('.error-message').remove();
  var form = $(this);
  $.ajax({
    url: form.attr('action'),
    type: 'POST',
    dataType: 'json',
    data: form.serialize(),
  })
    .done(function(data) {
      $('#change-password-message').html($('<div>').addClass('alert alert-success').text(data.message));
      setTimeout(function() {
        location.reload();
      }, 1000);
    })
    .fail(function(response) {
      if (response.status === 422) {
        var errors = JSON.parse(response.responseText);
        $.each(errors, function(index, val) {
          $('#' + index).next().html('<div class="ui pointing red basic label error-message">' + val + '</div>');
        });
      }
      else {
        $('#change-password-message').html($('<div>').addClass('alert alert-danger').text(response.message))
      }
    })
});
$('#updateBtn').on('click', function(e) {
  $('#updateBtn').attr("disabled", true);
  $('#app').submit();
});
