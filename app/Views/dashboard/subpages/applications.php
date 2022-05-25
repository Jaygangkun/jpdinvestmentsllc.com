<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-body">
        <div class="row">
          <div class="col-md-5">
            <div class="input-group">
                <input type="text" class="form-control" id="search" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
          </div>

          <div class="col-md-5"></div>
        </div>

        <div class="row mt-4">
          <div class="col-md-12">
            <table id="applicants" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Cell Phone Number</th>
                  <th>Status</th>
                  <th>Action</th>                    
                </tr>
              </thead>
              <tbody>
               
              </tbody>                  
            </table>                
          </div>
        </div>
        
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Add Participant Modal -->
<div class="modal fade" id="modal_add_participant" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="bic_swift_code">BIC/SWIFT Code*</label>
                <div class="input-group">
                    <input type="text" name="bic_swift_code" id="bic_swift_code" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="sort_code">Sort-Code</label>
                <div class="input-group">
                    <input type="text" name="sort_code" id="sort_code" class="form-control" value="">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="short_name">*Short Name</label>
                <div class="input-group">
                    <input type="text" name="short_name" id="short_name" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="participant_name">*Participant Name</label>
                <div class="input-group">
                    <input type="text" name="participant_name" id="participant_name" class="form-control" value="">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="account_number">Account Number</label>
                <div class="input-group">
                    <input type="text" name="account_number" id="account_number" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="status">Status</label>
                <div class="input-group">
                  <select class="form-control" name="status" id="status">
                    <option value="20">Active</option>
                    <option value="21">Suspended</option>
                    <option value="22">Insolvent</option>
                    <option value="23">Liquidated</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="participant_id" id="participant_id">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" id="btn_delete">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btn_save">Save</button>
        <button type="button" class="btn btn-primary" id="btn_update">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Add Participant Modal -->

<!-- Upload CSV Modal -->
<div class="modal fade" id="modal_upload" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="file">
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="participant_id" id="participant_id">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_upload">Upload</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Upload CSV Modal -->

<style>
#applicants_wrapper .row:first-of-type {
  display: none;
}
</style>
<script>
var table_applicants = $('#applicants').DataTable({
  "pagingType": 'full_numbers',
  "paging": true,
  "lengthChange": false,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "responsive": true,
  'ajax': {
    url: base_url + '/apiApplicatnsLoad',
  }
});

$(document).on('click', '.action-view', function() {
  location.href = base_url + '/application-view/' + $(this).attr('application-id');
})

$(document).on('click', '.action-delete', function() {
  if(confirm('Are you sure to delete?')) {
    $.ajax({
      url: base_url + '/delete-application',
      type: 'post',
      dataType: 'json',
      data: {
        application_id: $(this).attr('application-id'),
      },
      success: function(resp) {
        if(resp.success) {
          alert('Deleted Successfully!');
          table_applicants.ajax.reload();
        }
        else {
          alert(resp.message);
        }
      }
    })
  }
})
$(document).on('keyup', '#search', function() {
  table_applicants.search($(this).val()).draw(false);
})


</script>