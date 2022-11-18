<?php $this->load->view('home/home_template/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css">
<div id="controls-polyline" style="display: none"></div>  
<div id="gmap-list" style="height:300px;width: 100%"></div>
<div class="vc_empty_space" style="height:50px">
  <span class="vc_empty_space_inner"></span>
</div>
<section class="section-padding inner-page">
  <div class="container">
    <?php if(!empty($message)) { ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-block alert-warning">
          <a href="#" data-dismiss="alert" class="close">×</a>
          <h5 class="mb-0 text-center text-danger"><?php echo $message; ?></h5>
        </div>
      </div>
    </div>
    <?php } ?>
     
    <div class="row">
      <div class="col-lg-5 col-md-5 mx-auto">
        <h2>CONTACT US</h2><br/>
        <p><span class="fa fa-map-marker" aria-hidden="true"></span>&nbsp;<b style="color: #1b378a ">OUR ADDRESS</b></p>
        <p>SARVtoday Private Limited (SPL),</p>
        <p>Akole, Maharashtra 422601</p>
        <p class="title2"><span class="fas fa-phone-alt"></span>&nbsp;<b style="color: #1b378a ">CALL US</b> : 077090 30673</p>
        <p> <span class="fas fa-envelope"></span>&nbsp;<b style="color: #1b378a ">EMAIL</b> : SPL@SARVtoday.com</p>
     </div>
      <div class="col-lg-7 col-md-7 mx-auto" style="margin-top: -33px;">
        <form action="<?php echo site_url();?>cms/equire_now" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
          <div class="itinerary-container box-shadow">
            <div class="searchHdr2" style="text-align: center;font-size: 26px;background: #dae0e2;padding: 17px 10px;">ENQUIRE NOW </div>
            <div class="white-container">
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Name:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Enter name" name="username" required value="<?php// if( isset($agent_email)) echo $agent_email; ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Email Address:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" placeholder="Enter Email Address" name="useremail" required value="<?php// if( isset($agent_email)) echo $agent_email; ?>" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                  <label>Mobile Number:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="usermobile" required  placeholder="Mobile Number" class="form-control" >
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>Message:<span class="red">*</span></label>
                </div>
                <div class="col-md-6">
                  <textarea name="usermessage" rows="2" cols="45" required class="form-control" placeholder="Enter your message here" ></textarea> 
                </div>
              </div><br/>
               <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-secondary"><i class="mdi mdi-send"></i> Send</button>
                  <a href="<?php echo site_url() ?>" title="Click here to go back" class="btn btn-danger"><i class="mdi mdi-undo"></i> Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('home/home_template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<script src="<?php echo base_url(); ?>public/vendor/maplace/maplace.min.js"></script>
<script type="text/javascript">
var LocsD = [
  {
    lat: '19.543482',
    lon: '74.000652',
    title: 'SARVtoday Private Limited (SPL)',
    html: '<div style="max-width:200px;min-height:20px;"><b>'+'SARVtoday Private Limited (SPL), SARVtoday, Akole, Maharashtra 422601'+'</div>',
    icon:'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld='+'|f75c50|000000',
    stopover: true,
    // zoom: 1
  },
];

displayMap(LocsD);

function displayMap(LocsD) {
    new Maplace({
      map_div:'#gmap-list',
      controls_on_map: false,
      locations: LocsD,
      controls_div: '#controls-polyline',
      controls_type: 'list',
      view_all_text: 'Start',
      map_options: {
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
      },
      type: 'polyline'
    }).Load(); 
}
</script>
