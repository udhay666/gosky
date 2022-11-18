<section class="tab-view">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="nav justify-content-center">
             
                <li class="nav-item">
                  <a class="nav-link <?php if($this->router->class != 'coporate' || $this->router->method == 'dashboard'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporate/dashboard">Book Tickets</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'my_bookings'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporate/my_bookings">My Bookings</a>
               </li>               
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'my_profile' || $this->router->method == 'change_password'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporate/my_profile">My Profile</a>
               </li>
               <!-- <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'markup_management'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporate/markup_management">Markup Manager</a>
               </li> -->
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'user_management'){ echo 'active text-success'; } ?>" 
                     href="<?php echo site_url() ?>corporate/add_users">Users</a>
               </li>
               <!--<li class="nav-item">-->
               <!--   <a class="nav-link <?php //if($this->router->method == 'user_management'){ echo 'active text-success'; } ?>" -->
               <!--      href="<?php //echo site_url() ?>corporate/manage_users">Manage Users</a>-->
               <!--</li>-->
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'deposit_management'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporate/deposit_management">Deposit Manager</a>
               </li>
               <li class="nav-item">
                  <span class="text-warning d-block" style="padding: 8px 25px;"><i class="mdi mdi-currency-inr"></i><?php $agent_no = $this->session->agent_no;  $this->load->model('corporate/corporate_Model'); echo number_format($this->corporate_Model->get_agent_available_wallet_balance($agent_no));  ?></span>
               </li>
               <li class="nav-item">
                  <a class="nav-link <?php if($this->router->method == 'logout'){ echo 'active text-success'; } ?>" href="<?php echo site_url() ?>corporate/logout">Logout</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</section>
