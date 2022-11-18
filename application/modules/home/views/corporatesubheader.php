<section class="tab-view">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="nav justify-content-center">
             
              <li class="nav-item">
                  <a class="nav-link <?php if($this->router->class != 'corporatesubadmin' || $this->router->method == 'dashboard'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporatesubadmin/dashboard">Book Tickets</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'my_bookings'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporatesubadmin/my_bookings">My Bookings</a>
               </li>               
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'my_profile' || $this->router->method == 'change_password'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporatesubadmin/my_profile">My Profile</a>
               </li>
              
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'deposit_management'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporatesubadmin/deposit_management">Deposit Manager</a>
               </li>
               <li class="nav-item">
                  <span class="text-warning d-block" style="padding: 8px 25px;">Available Balance: <i class="mdi mdi-currency-inr"></i><?php $this->load->model('corporatesubadmin/Corporatesubadmin_Model'); echo number_format($this->Corporatesubadmin_Model->get_agent_available_balance());  ?></span>
               </li>
               <li class="nav-item">
                  <span class="text-warning d-block" style="padding: 8px 25px;"><!-- <i class="mdi mdi-currency-inr"></i><?php //$this->load->model('corporatesubadmin/corporate_Model'); echo number_format($this->corporate_Model->get_agent_available_balance());  ?> --></span>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'logout'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporatesubadmin/logout">Logout</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</section>
