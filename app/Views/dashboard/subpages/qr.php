<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="url">URL</label>
              <input type="text" class="form-control" id="url" placeholder="Enter Redirect URL" value="<?php echo base_url('/apply')?>">
            </div>
            <button class="btn btn-primary" id="btn_gen">Generate</button>
          </div>
          <div class="col-lg-6">
            <div id="qr_img_wrap" class="text-center">
              <?php
              if($qr_code_img != '') {
                ?>
                <img class="" src="<?php echo $qr_code_img?>">
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<script>

$(document).on('click', '#btn_gen', function() {

  $.ajax({
    url: base_url + '/generate-qr',
    type: 'post',
    dataType: 'json',
    data: {
      url: $('#url').val(),
    },
    success: function(resp) {
      if(resp.success) {
        $('#qr_img_wrap').html(resp.qr_img);
      }
      else {
        alert(resp.message);
      }
    }
  })
})



</script>