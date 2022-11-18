<?php $this->load->view('home/home_template/header'); ?>

<style>
   .mt-5{
      margin-top:125px;
   }
   .ml-5{
      margin-left:50px;
   }
   body{
      background-image: url("../assets/images/bg/cancellation.jpg");
      /* background-repeat: no-repeat; */
   }
   .mx-auto{
      background: white;
   }
   .searchHdr2 {
  background: #203fb3;
  padding: 7px 10px;
  font-weight: 500;
  color: #ffbf00;
  font-size: 18px;
  line-height: 2;
  border-radius: 5px 21px;
  margin-bottom: 10px;
}
.cancelbody{
   margin-bottom: 20px;
}
.tab-view .container{
   margin-top: -35px;
}
</style>
<div class="container cancelbody">
   <div class="row">
      <div class="col-md-12 ml-5">
<section class="section-padding inner-page mt-5">
   <div class="container">
      <?php if (validation_errors() && validation_errors() != "") { ?>
      <div class="row mb-5">
         <div class="col-lg-12 col-md-12">
            <div class="alert alert-danger">
               <button class="close" data-dismiss="alert" type="button">X</button>
               <?php echo validation_errors() ?>
            </div>
         </div>
      </div>
      <?php } ?>
      <div class="row">
         <div class="col-lg-5 col-md-5 mx-auto">
            <div class="itinerary-container box-shadow">
               <div class="searchHdr2">Print / Cancel Ticket</div>
               <div class="white-container">
                  <form class="form-signin" action="<?php echo site_url() ?>home/print_ticket" method="post" data-parsley-validate>
                     <div class="row form-group">
                        <div class="col-sm-12 text-center">
                           <label class="radio-custom checkbox-custom-sm">
                              <input type="radio" name="service_type" value="1" checked required><i></i>
                              <span>Hotel</span>
                           </label>
                           <label class="ml-2 radio-custom checkbox-custom-sm">
                              <input type="radio" name="service_type" value="2" required><i></i>
                              <span>Flight</span>
                           </label>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Booking Id</label>
                           <input type="text" value="<?php if(isset($uniqueRefNo)) echo $uniqueRefNo ?>" class="form-control" name="uniqueRefNo" required>
                           <small class="text-info">Our booking unique reference id</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Email</label>
                           <input type="email" value="<?php if(isset($user_email)) echo $user_email ?>" class="form-control" name="user_email" required>
                           <small class="text-info">Your booking email</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>User Name</label>
                           <input type="text" value="<?php if(isset($user_name)) echo $user_name ?>" class="form-control" name="user_name" required>
                           <small class="text-info">Your User Name</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <label>Mobile No</label>
                           <input type="text" value="<?php if(isset($user_mobile)) echo $user_mobile ?>" class="form-control" name="user_mobile" required>
                           <small class="text-info">Your booking mobile no</small>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-success btn-block">SUBMIT</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
</div>
</div>
<?php $this->load->view('home/home_template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>