<?php $this->load->view('modal'); ?>
<!-- ========================= FOOTER ========================= -->

<footer class="section-footer">
    <section class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-6">
                    <h4 class="title">Top flight destinations</h4>

                    <ul class="row list-footer">
                                                    <li class="col-sm-4"><a href="#">Flights to Delhi</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Muscat</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Kuala Lumpur</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Cairo</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to London</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Manila</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Riyadh</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Dubai</a></li>
                                                    <li class="col-sm-4"><a href="#">Flights to Makkah</a></li>
                                            </ul>

                </div> <!-- col// -->
                <div class="col-sm-6 col-xs-6">
                    <h4 class="title">Top airlines</h4>
                    <ul class="row list-footer">
                                                    <li class="col-sm-4"><a href="#"> Jazeera Airways</a></li>
                                                    <li class="col-sm-4"><a href="#">Air Arabia</a></li>
                                                    <li class="col-sm-4"><a href="#">Air France</a></li>
                                                    <li class="col-sm-4"><a href="#">Air India</a></li>
                                                    <li class="col-sm-4"><a href="#">Air India Express</a></li>
                                                    <li class="col-sm-4"><a href="#">Biman Bangladesh Airline</a></li>
                                                    <li class="col-sm-4"><a href="#">British Airways</a></li>
                                                    <li class="col-sm-4"><a href="#">easyJet</a></li>
                                                    <li class="col-sm-4"><a href="#">EgyptAir</a></li>
                                                    <li class="col-sm-4"><a href="#">Emirates Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">Etihad Airways</a></li>
                                                    <li class="col-sm-4"><a href="#">Flydubai</a></li>
                                                    <li class="col-sm-4"><a href="#">flynas</a></li>
                                                    <li class="col-sm-4"><a href="#">Gulf Air</a></li>
                                                    <li class="col-sm-4"><a href="#">Indigo</a></li>
                                                    <li class="col-sm-4"><a href="#">Jet Airways</a></li>
                                                    <li class="col-sm-4"><a href="#">Kuwait Airways</a></li>
                                                    <li class="col-sm-4"><a href="#">Middle East Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">Oman Air</a></li>
                                                    <li class="col-sm-4"><a href="#">Pakistan Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">Pegasus</a></li>
                                                    <li class="col-sm-4"><a href="#">Philippine Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">Salam Air</a></li>
                                                    <li class="col-sm-4"><a href="#">Saudi Arabian Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">Singapore Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">SpiceJet</a></li>
                                                    <li class="col-sm-4"><a href="#">SriLankan Airlines</a></li>
                                                    <li class="col-sm-4"><a href="#">Turkish Airlines </a></li>
                                                
                    </ul>
                </div> <!-- col// -->
            </div> <!-- row// -->
            <hr>

            
                <div class="col-sm-6 col-md-5 col-xs-12">
                    <div class="row-sm">
                        <div class="col-md-4 col-xs-12">
                            <h4 class="title-side">Stay connected with social pages</h4>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-6">
                            <p class="social-buttons">
                                <a class="facebook" target="_blank" href="https://www.facebook.com/travelfreebuy" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a class="twitter" target="_blank" href="https://twitter.com/travelfreebuy" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter"></i></a>
                                <a class="instagram" target="_blank" href="https://www.instagram.com/travelfreebuy/" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a class="linkedin" style="background-color: #0e76a8;" target="_blank" href="https://www.linkedin.com/in/al-faraj-travels-8b0951218/" data-toggle="tooltip" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
                            </p>
                        </div> <!-- col// -->
                        
                    </div> <!-- row-sm// -->
                </div> <!-- col// -->
            </div> <!-- row// -->
        </div> <!-- container// -->
    </section>
    <section class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <img src="<?php echo base_url(); ?>assets/images/logo-white.png" class="img-logo-footer">
                    <p><?php echo $footer_content->content; ?></p>
                    
                </div> <!--  col// -->
                <div class="col-sm-2 col-xs-6">
                  
                </div> <!--  col// -->
                <div class="col-sm-2 col-xs-6">
                    <h4 class="title">tripfreebuy.com</h4>
                    <ul class="list-footer">
                        <!-- <li><a href="#">Blog</a></li>                         -->
                        <li><a href="<?php echo base_url(); ?>cms/aboutus">About Us</a></li>                        
                        <li><a href="<?php echo base_url(); ?>cms/contactus">Contact Us</a></li>
                    </ul>
                    <h4 class="title">Terms & Policies</h4>
                    <ul class="list-footer">
                        
                        <li><a href="<?php echo base_url(); ?>cms/price_details">Price Details</a></li>
                        <li><a href="<?php echo base_url(); ?>cms/termsandconditions">Terms & Conditions</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>refundpolicy">Refund Policy</a></li>  -->
                        <li><a href="<?php echo base_url(); ?>cms/privacypolicy">Privacy Policy</a></li>
                    </ul>
                </div> <!--  col// -->
                <div class="col-sm-2 col-xs-6">
                    <h4 class="title">Products</h4>
                    <ul class="list-footer">
                        <li><a href="#">Flights</a></li>
                        <li><a href="#">Hotels </a></li>                        
                        <li><a href="#">Visa</a></li>
                        <li><a href="#">Insurance</a></li>                                                
                                                
                    </ul>
                    <h4 class="title">Support</h4>
                    <ul class="list-footer">
                        <li><a href="#">User Guide</a></li>
                        <li><a href="<?php echo base_url(); ?>cms/faq">FAQ</a></li>
                    </ul>
                </div> <!--  col// -->
                <div class="col-sm-2 col-xs-6">
                    <h4 class="title">Get in touch</h4>
                    <ul class="list-footer">
                        <li><a href="mailto:info@tripfreebuy.com?Subject=Inquire%20Now" target="_top">info@tripfreebuy.com</a></li>
                        <li><span class="b"></span> <br/><a href="tel:12345678" class="ltr">Tripfreebuy</a></li>
                        <li><span class="b">Tel:</span> <br/><a href="tel:0097142699215" class="ltr">+91 992699215</a>
                        <li><span class="b">Whatsapp:</span> <br/><a href="tel:009714631903" class="ltr">+91 9564631903</a>
                        </li>
        <!--<li><span class="b"><img height="55" src=""></span></li>-->
                    </ul>

                </div> <!--  col// -->
            </div><!-- //row -->          
            <hr>
            <div class="row footer-features">
                <div class="col-sm-3 col-sm-offset-1">
                    <span> </span> <img src="">
                </div>  <!--col// -->
                <div class="col-sm-3 tx">
                    <span>100% secured by</span> <img src="<?php echo base_url(); ?>assets/images/misc/secured.png">
                </div> <!-- col// -->
                <div class="col-sm-5 tx">
                    <span>We accept</span> <img src="<?php echo base_url(); ?>assets/images/misc/payments.png">
                </div> <!-- col// -->
            </div> <!-- row// -->
        </div><!-- //container -->
    </section> <!-- footer-bottom // -->
    <section class="footer-copyright">
        <div class="container">
            <div class="row-sm">
                <div class="col-md-5">
                    <div class="copyright">
                        <!--All rights reserved. Copyright © 2017--> 
                        Copyright © 2022 tripfreebuy.com. All Rights Reserved.<br/>                     </div>
                </div>
                <div class="col-md-3 text-center">
                    <div style="background-color: #FFF;width: 130px;color: #999;border-radius: 5px;padding: 2px 5px; font-size: 10px; margin: auto;">
                        Hotel Reviews By <img src="<?php echo base_url(); ?>assets/images/misc/tripadviser.png">
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="text-right"> 
                        Developed by: <a target="_blank" href="https://www.travelpd.com"><span style="color:#EC6F23">Travelpd</span></a> <br/>
                        <!-- Made with <i class="fa fa-heart"></i> in Dubai, the land of tomorrow -->           </div> 
                </div>
            </div>
        </div><!-- //container -->
        <br/><br/>
    </section> <!-- footer-copyright // -->

</footer>
<!-- ========================= FOOTER END // ========================= -->

<!--<p class="alert alert-success" id="success_footer" style="position: fixed; bottom: 0px; display: none; width: 100%;text-align: center; margin-bottom: 0"></p>-->

<div class="notify-box show-success alert-dismiss" id="success_footer" style="display: none;">
    <a href="javascript:;" onclick="$(this).closest('.notify-box').hide();" class="pull-right close">×</a>
    <div class="inner"><p><i class="fa fa-check"></i> <span></span></p></div>
</div>
<div class="notify-box show-error alert-dismiss" id="error_footer" style="display: none;">
    <a href="javascript:;" onclick="$(this).closest('.notify-box').hide();" class="pull-right close">×</a>
    <div class="inner">
        <p><i class="fa fa-exclamation"></i>  <span></span></p>
    </div>
</div>
<!--<p class="alert alert-danger  hide" id="error_footer"> Here i am today </p>-->
<a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

<div class="widget-feedback hidden-xs">
    <a class="hidden-xs btn-widget-feedback rotate-left" data-closetext="Close" data-opentext="Feedback"> <i class="fa fa-envelope"></i> Feedback </a>
    <div class="widget-feedback-body">
        <form role="form" name="feedback-form" id="feedback-form" method="post" action="<?php echo base_url(); ?>Home/send_feedback_mail">
            <p class="alert alert-success feedback-success" role="alert" style="display: none;"></p>            
            <div class="form-group">
                <label class="b text-primary">Your name:</label>
                <input class='form-control' minlength="2" maxlength="30" placeholder="Your name" pattern="[a-zA-Z\s]+" name="name" type='text' required>
            </div>
            <div class="row-sm">
                <div class='form-group col-md-7'>
                    <label class="b text-primary">Email:</label>
                    <input class='form-control' placeholder="Email" name="email" type='email' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                </div>
                <div class='form-group col-md-5'>
                    <label class="b text-primary">Mobile Number:</label>
                    <input class='form-control' placeholder="Mobile no." minlength="13" maxlength="18" pattern="[+0-9 ]+" name="phone" type='text' required>
                </div>
            </div>
            <div class="form-group">
                <label class="b text-primary">We listen:</label>
                <textarea class="form-control" type="textarea" name="message" placeholder="Message" maxlength="500" rows="3" required></textarea>
            </div>     
            <button type="submit" id="submit-feedback" name="submit" class="btn btn btn-warning"><span class="spin-loader hide"><i class="fa fa-spinner fa-spin"></i></span>Submit</button>
        </form> 
    </div>
</div> <!-- widget-feedback // -->
<div class="widget-contact hidden-xs">
    <a class="btn-widget-contact rotate-left"> <i class="fa fa-phone"></i> Contact us</a>
    <div class="widget-contact-body">

        <p>
            <a class="" href="tel:80027327" dir="auto" class="ltr">TRIPFREEBUY</a> <span class="pull-left">  </span> <br/>
            <a href="tel:0097142699215" dir="auto" class="ltr">+ 91 92699215</a> <span class="pull-left">International:  </span><br/>           
            <a href="tel:00971564631903" dir="auto" class="ltr">+ 91 9564631903</a> <span class="pull-left">Whatsapp:  </span><br/> 
            <a href="mailto:info@tripfreebuy.com?Subject=Inquire%20Now" target="_top">info@tripfreebuy.com</a> <br/>
        </p>
        <p>Our team is available <strong>24/7</strong></p>

    </div>
</div> <!-- widget-contact // -->
<div id="overlay" style="display: none"></div>

<!--Javascripts Loading-->
    
    

    

   
<!--Google Recaptcha-->
<script src='https://www.google.com/recaptcha/api.js' defer></script>

<!--Javascripts Loading-->
<!-- bootstrap -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- bootstrap form select style -->
<script src="<?php echo base_url(); ?>assets/plugins/bs-select/js/bootstrap-select.min.js" defer></script>
<!-- jquery ui -->
<script src="<?php echo base_url(); ?>assets/plugins/jqueryui/jquery-ui.min.js"></script>
<!-- timepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/jquery.timepicker.min.js" defer></script>
<!--jquery cookie-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.cookie.min.js" defer></script>
<script src="<?php echo base_url(); ?>assets/js/libs/validator.min.js" defer></script>
<!--custom scripts-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/compiled/scriptf1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/compiled/scriptf2.js"></script>

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!--<script src="https://use.fontawesome.com/1d48bb9cdb.js"></script>-->
<!--Style Loading without content block-->
<noscript id="deferred-styles">

</noscript>
<script>
    
    flatpickr("#holiday-depart", {
        minDate: "today"
    });

flatpickr("#modifyholiday-depart", {
        minDate: "today"
    });
</script>

<script type="text/javascript">
      $(document).ready(function () {

          $("input[name='fromCity']").autocomplete({
              delay: 0,
              source: function(request,response){
                //fetch data
                $.ajax({
                    url: '<?= base_url() ?>home/airportList',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      search: request.term
                    },
                    success: function (data) {
                      response(data);
                    }
                  });
              },
              select: function(event, ui){
                  $("input[name='fromCity']").val(ui.item.label);
                  // $('#userid').val(ui.item.value);

                  return false;
              },
          });
      });
    </script>

<?php if($this->session->has_userdata('agent_logged_in')){ ?>
<script>
    $(document).ready(function () {
        console.log('fname');
        $("input[id='fname']").autocomplete({
              delay: 0,
              source: function(request,response){
                //fetch data
                $.ajax({
                    url: '<?= base_url() ?>flights/passenger_data',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      search: request.term
                    },
                    success: function (data) {
                      response(data);
                    }
                  });
              },
              select: function(event, ui){
                  $("input[id='fname']").val(ui.item.label);
                  // $('#userid').val(ui.item.value);

                  return false;
              },
          });
      });
</script>
<?php }?>

<script type="text/javascript">
      $(document).ready(function () {

          $("input[name='toCity']").autocomplete({
              delay: 0,
              source: function(request,response){
                //fetch data
                $.ajax({
                    url: '<?= base_url() ?>home/airportList',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      search: request.term
                    },
                    success: function (data) {
                      response(data);
                    }
                  });
              },
              select: function(event, ui){
                  $("input[name='toCity']").val(ui.item.label);
                  // $('#userid').val(ui.item.value);

                  return false;
              },
          });
      });
    </script>
<!-- oneway and round trip end -->
<script type="text/javascript">
  $(document).ready(function () {

      $('#fromCity1').autocomplete({
          delay: 0,
          source: function(request,response){
            //fetch data
            $.ajax({
                url: '<?= base_url() ?>home/airportList',
                type: 'post',
                dataType: 'json',
                data: {
                  search: request.term
                },
                success: function (data) {
                  response(data);
                }
              });
          },
          select: function(event, ui){
              $('#fromCity1').val(ui.item.label);
              // $('#userid').val(ui.item.value);

              return false;
          },
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {

      $('#toCity1').autocomplete({
          delay: 0,
          source: function(request,response){
            //fetch data
            $.ajax({
                url: '<?= base_url() ?>home/airportList',
                type: 'post',
                dataType: 'json',
                data: {
                  search: request.term
                },
                success: function (data) {
                  response(data);
                }
              });
          },
          select: function(event, ui){
              $('#toCity1,#fromCity2').val(ui.item.label);
              // $('#userid').val(ui.item.value);

              return false;
          },
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {

      $('#fromCity2').autocomplete({
          delay: 0,
          source: function(request,response){
            //fetch data
            $.ajax({
                url: '<?= base_url() ?>home/airportList',
                type: 'post',
                dataType: 'json',
                data: {
                  search: request.term
                },
                success: function (data) {
                  response(data);
                }
              });
          },
          select: function(event, ui){
              $('#fromCity1').val(ui.item.label);
              // $('#userid').val(ui.item.value);

              return false;
          },
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {

      $('#toCity2').autocomplete({
          delay: 0,
          source: function(request,response){
            //fetch data
            $.ajax({
                url: '<?= base_url() ?>home/airportList',
                type: 'post',
                dataType: 'json',
                data: {
                  search: request.term
                },
                success: function (data) {
                  response(data);
                }
              });
          },
          select: function(event, ui){
              $('#toCity2,#fromCity3').val(ui.item.label);
              // $('#userid').val(ui.item.value);

              return false;
          },
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {

      $('#Holiday_from').autocomplete({
          delay: 0,
          source: function(request,response){
            //fetch data
            $.ajax({
                url: '<?= base_url() ?>home/holidayCityList',
                type: 'post',
                dataType: 'json',
                data: {
                  search: request.term
                },
                success: function (data) {
                  response(data);
                }
              });
          },
          select: function(event, ui){
              $('#Holiday_from').val(ui.item.label);
               $('#Holiday').val(ui.item.value);

              return false;
          },
      });
  });
</script>

<script type="text/javascript">
      $(document).ready(function () {

          $("input[name='cityName']").autocomplete({
              delay: 0,
              source: function(request,response){
                //fetch data
                $.ajax({
                    url: '<?= base_url() ?>home/hotelCityList',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      search: request.term
                    },
                    success: function (data) {
                      response(data);
                    }
                  });
              },
              select: function(event, ui){
                  $("input[name='cityName']").val(ui.item.label);
                  $("input[name='cityid']").val(ui.item.id);
                //   $('#userid').val(ui.item.value);

                  return false;
              },
          });
      });
    </script>

<script>
    var loadDeferredStyles = function () {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
            window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    if (raf)
        raf(function () {
            window.setTimeout(loadDeferredStyles, 0);
        });
    else
        window.addEventListener('load', loadDeferredStyles);
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.unveil.js"></script>
<script type="text/javascript">
    $(".lazyload").unveil(100);
</script>


</body>
</html>