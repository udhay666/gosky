<?php $this->load->view('home/header'); ?>
<div id="wrapper">
  <section id="">
    <div class="modal fade in thankyou-modal" id="thankyou-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
      <div class="modal-dialog" style="max-width: 540px;">
        <div class="modal-content">
          <div class="modal-header">
            <a class="close" href="<?php echo site_url() ?>" style="font-size: 28px;margin-top: -2px;">&times;</a>
            <h3 class="modal-title" id="myModalLabel">Request submitted!</h3>
          </div>
          <div class="modal-body">
            <p><img src="<?php echo base_url() ?>public/images/smile.png" style="width: 60px;vertical-align: middle;"></p>
            <p><span class="green-box"><!-- Request ID:  --><?php echo $request_id ?></span></p>
            <p>Our expert will get in touch with you shortly. You can also get in touch with us on the below contact details.</p>
            <p><a href="<?php echo site_url() ?>"><u class="red" style="text-decoration: underline;">Back to Home</u></a></p>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-sm-5">
                <div class="custom-table">
                  <div>
                    <i class="fa fa-phone icons-circle-red"></i>
                  </div>
                  <div>
                    <small class="red">Call</small><br>
                    <span>022 40743444</span>
                    <small class="grey">(10am - 8pm)</small>
                  </div>
                </div>
              </div>
              <div class="col-sm-7">
                <div class="custom-table">
                  <div>
                    <i class="fa fa-envelope icons-circle-red"></i>
                  </div>
                  <div>
                    <small class="red">Mail to us</small><br>
                    <span>Support@akbarholidays.com</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </section>

<style type="text/css">
  #footerbar{
  background: #1c1d22 url(<?php echo base_url(); ?>public/images/footerbar.png) no-repeat bottom center;
  }
  .filter-section.affix{
  width: 21.5%;
  top: 85px;
  }
</style>
<?php echo $this->load->view('home/footer'); ?>
<script type="text/javascript">
$(window).on('load',function(){
$('#thankyou-modal').modal({backdrop: 'static', keyboard: false});  
$('#thankyou-modal').modal('show');
});
</script>