<style>
.space{
   display:flex;

}
.nav > li > a:focus, .nav > li > a:hover {
   text-decoration: none;
   background-color: #f0b018;
}

.nav-item{
   /* width:130px; */
   padding: 0px 12px;
}
.cent{
   margin-left: 81px;
}

@media only screen and (max-width: 412px) {
   .cent{
      margin-left: -8px;
     
}
.space{
   flex-direction: column;

}

}
</style>
<section class="tab-view">
   <div class="container" style="margin-top:-25px;">
      <div class="row">
         <div class="col-lg-12 cent">
             <?php //$this->load->model('b2b/B2b_Model');
            // $data = $this->B2b_Model->notification();?>
            <ul class="nav justify-content-center space">
               <?php //print_r($this->session->all_userdata()); ?>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->class != 'b2b' || $this->router->method == 'dashboard'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>b2b/dashboard">Book Tickets</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'my_bookings'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>b2b/my_bookings">My Bookings</a>
               </li>               
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'my_profile' || $this->router->method == 'change_password'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>b2b/my_profile">Add Users</a>
               </li>
               <!-- <li class="nav-item"> -->
               <!-- <div class="dropdown">
                   <a class="dropbtn nav-link <?php if($this->router->method == 'create_b2b2b_user'){ echo 'active text-success'; } ?>" style="color:white; padding-bottom:20px;">B2b2b Users</a>
                  <div class="dropdown-content" style="z-index:10000">
                     <a class="text-dark" href="<?php echo site_url() ?>b2b/create_b2b2b_user">Create b2b2b User</a>
                    <a href="#">Create b2b2b user</a>-->
                     <!-- <a href="<?php echo base_url(); ?>b2b/manage_users">B2b2b User List</a>
                     <a href="<?php echo base_url(); ?>b2b/b2b2b_markup_management">B2b2b Markup Management</a> -->
                  <!-- </div> -->
                <!-- </div> -->
                <!-- </li> -->
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'markup_management'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>b2b/markup_management">Markup Manager</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'deposit_management'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>b2b/deposit_management">Deposit Manager</a>
               </li>
             
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'logout'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>b2b/logout">Logout</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href=""><span class="d-none d-lg-inline-block"><i class="fas fa-user"></i></span> welcome <?php echo $this->session->agency_name;?></a>
               </li>
                 <li class="nav-item" style="margin-top: 8px;">
                  <span class="text-warning d-block" style="color:#f0b018; ">Available Balance: <i class="fa fa-inr" aria-hidden="true"></i><?php $this->load->model('b2b/b2b_Model'); echo number_format($this->b2b_Model->get_agent_available_balance());  ?></span>
               </li>
            </ul>
                
         </div>
      </div>
   </div>
</section>
