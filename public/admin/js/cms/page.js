var summerConfig = {
  toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
};
var accordionTemplate = "";
accordionTemplate += " <div class=\"row well well-sm\">";
accordionTemplate += "   <button type='button' class='btn btn-sm btn-danger pull-right btnRemove'><i class='fa fa-trash'></i></button>";
accordionTemplate += "        <div class=\"col-md-12\">";
accordionTemplate += "          <div class=\"form-group\">";
accordionTemplate += "            <label for=\"title\" class=\"form-label\">Header Title<\/label>";
accordionTemplate += "            <span class=\"required\" aria-required=\"true\"> * <\/span>";
accordionTemplate += "            <input type=\"text\" name=\"content[title][]\"  class=\"form-control title\">";
accordionTemplate += "            <span class=\"error\"><\/span>";
accordionTemplate += "          <\/div>";
accordionTemplate += "          <div class=\"form-group\">";
accordionTemplate += "            <label for=\"description\" class=\"form-label\">Description<\/label>";
accordionTemplate += "            <span class=\"required\" aria-required=\"true\"> * <\/span>";
accordionTemplate += "            <textarea class=\"form-control description\" name=\"content[description][]\" rows=\"5\"><\/textarea>";
accordionTemplate += "            <span class=\"error\"><\/span>";
accordionTemplate += "          <\/div>";
accordionTemplate += "        <\/div>";
accordionTemplate += "      <\/div>";

var iconStackTemplate = "";
iconStackTemplate += "<div class=\"row well well-sm\">";
iconStackTemplate += "   <button type='button' class='btn btn-sm btn-danger pull-right btnRemove'><i class='fa fa-trash'></i></button>";
iconStackTemplate += "    <div class=\"col-md-12\">";
iconStackTemplate += "      <div class=\"form-group\">";
iconStackTemplate += "        <label for=\"title\" class=\"form-label\">Header Title<\/label>";
iconStackTemplate += "        <span class=\"required\" aria-required=\"true\"> * <\/span>";
iconStackTemplate += "        <input type=\"text\" name=\"content[title][]\"  class=\"form-control title\">";
iconStackTemplate += "        <span class=\"error\"><\/span>";
iconStackTemplate += "      <\/div>";
iconStackTemplate += "      <div class=\"form-group\">";
iconStackTemplate += "        <label for=\"title\" class=\"form-label\">Icon (Max height: 100 Max Width: 150)<\/label>";
iconStackTemplate += "        <span class=\"required\" aria-required=\"true\"> * <\/span>";
iconStackTemplate += "        <input type=\"file\" name=\"content[file][]\"  class=\"form-control file\">";
iconStackTemplate += "        <span class=\"error\"><\/span>";
iconStackTemplate += "      <\/div>";
iconStackTemplate += "      <div class=\"form-group\">";
iconStackTemplate += "        <label for=\"description\" class=\"form-label\">Description<\/label>";
iconStackTemplate += "        <span class=\"required\" aria-required=\"true\"> * <\/span>";
iconStackTemplate += "        <textarea class=\"form-control description\" name=\"content[description][]\" rows=\"5\"><\/textarea>";
iconStackTemplate += "        <span class=\"error\"><\/span>";
iconStackTemplate += "      <\/div>";
iconStackTemplate += "    <\/div>";
iconStackTemplate += "  <\/div>";

$("#publish").bootstrapSwitch({
  onSwitchChange: function(e, state) {
    var switchState = state ? 'Published' : 'Draft';
    $.ajax({
      url: $(this).data('action') + '/' + $(this).data('id'),
      success: function() {
        toastr.success('Page ' + switchState + ' Successfully', 'Success');
      }
    });
  }
});

$(document).ready(function() {

  $('.btnEditSection').click(function(e) {
    var editButton = $(this);
    var pleaseWait = $('<i class="fa fa-spinner spin">').after().text(' Please wait');
    var editText = editButton.html();
    editButton.html(pleaseWait);
    getForm(editButton, editText);
  });

  $('.btnNewSection').click(function(e) {
    var editButton = $(this);
    getForm(editButton);
  });

  function getForm(_this, editText) {
    var queryStrings = '?action=' + _this.data('action') + '&section_id=' + _this.data('section_id')
      + '&page_id=' + pageId + '&section_alias=' + _this.data('section_alias');
    if (_this.data('section_content_id')) {
      queryStrings += '&section_content_id=' + _this.data('section_content_id');
    }
    $.ajax({
      url: getFormUrl + queryStrings,
      success: function(response) {
        $('#myModal').html(response).modal('show');
        $('.summerNote').summernote(summerConfig);
      }
    }).always(function() {
      if (editText) {
        _this.html(editText)
      }
    });
  }

  function isEmpty(el) {
    return !$.trim(el.html())
  }

  $("#sortable").sortable({
    update: function(event, ui) {
      var sorted = $("#sortable").sortable("toArray");
      $.ajax({
        type: 'POST',
        data: {data: sorted},
        url: orderUrl,
        success: function() {
          toastr.success('Section order changed successfully', 'Success');
        },
        error: function() {
          toastr.error('Can not update section order', 'Fail');
        }
      })
    }
  });

  $('body').not('disabled').on('click', '#btnSave', function(e) {
    if ($(this).hasClass('disabled')) {
      return;
    }
    $el = $('div#content');
    if ($el.length > 0) {
      if (isEmpty($el)) {
        return;
      }
    }
    $el = $('div#icon-stack-content');
    if ($el.length > 0) {
      if (isEmpty($el)) {
        return;
      }
    }
    e.preventDefault();
    var btn = $(this);
    btn.html('<i class="fa fa-spinner fa-spin"></i> Processing ..').addClass('disabled');
    var form = $('#frm');
    var url = form.attr('action');
    var formData = new FormData(form[0]);
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function(response) {
        $(document).load().scrollTop(0);
        location.reload(true);
      },
      error: function(data) {
        var errors = data.responseJSON;
        $('.error').each(function() {
          $(this).html('');
          $(this).parent().removeClass('has-error');
        });
        $.each(errors, function(index, val) {
          $('.portlet-body').collapse('show');
          btn.html('Save').removeClass('disabled');
          values = index.split('.');
          cls = values[1];
          nlCls = values[0];
          ind = values[2];
          nlInd = values[1];
          var element = $('.form-control.' + cls).eq(ind).parent().find('span.error');
          var element1 = $('.form-control.' + nlCls).eq(nlInd).parent().find('span.error');
          element.html('<div class="ui pointing red basic label error-message">' + val + '</div>');
          element.parent().addClass('has-error');
          element1.html('<div class="ui pointing red basic label error-message">' + val + '</div>');
          element1.parent().addClass('has-error');
          $('#error_' + index).html('<div class="ui pointing red basic label error-message">' + val + '</div>');
          $('#error_' + index).parent().addClass('has-error');
        });
      }
    });
  });
//accordion start
  $('body').on('click', '#btnAddAccordion', function() {
    $('#content').append(accordionTemplate);
    var textArea = $(".description").last();
    textArea.summernote(summerConfig);
    $('.error').each(function() {
      $(this).html("");
      $(this).parent().removeClass('has-error');
    })
  });
//end accordian
//start two column number list
  $('body').on('click', '.btn-add-description-list', function(e) {
    var btn = $(this);
    var textArea = $('<textarea class="form-control content" rows="5" name="">');
    var span = $('<span class="error"></span>');
    var removeBtn = "<button style='margin-top: -18px' type='button' class='btn btn-sm btn-danger pull-right btnRemove'><i class='fa fa-trash'></i></button><div class='clearfix'></div>";
    textArea.prop('name', btn.data('textarea_name') + '[]');
    textArea.addClass(btn.data('textarea_name'));
    var textAreaDiv = $('<li><div class="form-group">').html('<span class="required" aria-required="true"> * </span>');
    var descriptionList = btn.closest('div').prev('div').find('.description-list');
    descriptionList.append(textAreaDiv.append(textArea));
    descriptionList.append(textAreaDiv.append(span));
    descriptionList.append(textAreaDiv.append(removeBtn));

    $(".content").summernote(summerConfig);
  });
  /*  //End Tow Column Number List*/

  /*  Icon Stack Start*/
  $('body').on('click', '#btnAddIconStack', function() {
    $('#icon-stack-content').append(iconStackTemplate);
    var textArea = $(".description").last();
    textArea.summernote(summerConfig);
    $('.error').each(function() {
      $(this).html("");
      $(this).parent().removeClass('has-error');
    })
  });
  /*Icon Stack End*/

  $('body').on('change paste keyup', '#title', function() {
    $('#slug').val(convertToSlug($(this).val()));
  });

  $('body').on('click', '.btnRemove', function() {
    var el = this;
    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes',
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $(el).parent().remove();
        }
      });
  });
});
