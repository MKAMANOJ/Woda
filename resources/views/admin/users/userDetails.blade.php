<div class="modal fade out" tabindex="-1" role="dialog" id="mdl-user-details">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">User Details</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th>Client No</th>
            <td id="client_no"></td>
          </tr>
          <tr>
            <th>Contact Person Name</th>
            <td id="name"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td id="email"></td>
          </tr>
          <tr>
            <th>Phone</th>
            <td id="phone"></td>
          </tr>
          <tr>
            <th>Mobile</th>
            <td id="mobile"></td>
          </tr>
          @if(userHasRole('admin'))
            <tr>
              <th>Actions</th>
              <td>
                <a id="userEdit" href="#"
                   class="btn btn-sm blue btn-outline filter-submit margin-bottom">
                  <i class="fa fa-edit"></i> Edit </a>
                <a id="userLogin" href="#" type="button" target="_blank" class="btn btn-sm blue btn-outline filter-submit margin-bottom"><i
                      class="fa fa-sign-in"></i> Login
                </a>
              </td>
            </tr>
          @endif
        </table>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function() {
    $('body').on('click', '.user_details', function() {
      let userId = $(this).data('userid');
      $.ajax({
        url: "/administrator/clients/getClientById/" + userId,
        dataType: "json",
        success: function(response) {
          $('#client_no').html(response.user_details.id_record);
          $('#name').html(response.name);
          $('#email').html(response.email);
          $('#phone').html(response.user_details.phone_number);
          $('#mobile').html(response.user_details.mobile_number);
          $('#userEdit').attr('href', '/administrator/clients/' + response.user_details.id + '/edit');
          $('#userLogin').attr('href', '/administrator/users/' + response.user_details.user_id + '/impersonate');
          $('#mdl-user-details').modal('show');
        }
      });
    });
  })
</script>
