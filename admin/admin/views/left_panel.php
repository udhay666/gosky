<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Admin Console</span></a>
    </div>
    <div class="clearfix"></div>
    <div class="profile">
      <div class="profile_pic">
        <img src="<?php echo base_url();?>public/themetemplate/images/loggeduser.png" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>Admin</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <?php if ($this->session->userdata('admin_logged_in')) { ?>
          <li>
            <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo site_url(); ?>">Dashboard</a></li>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='my_profile')||($this->router->fetch_method()=='change_password'))) echo 'active nav-active';?>">
            <a><i class="fa fa-edit"></i>Manage Profile<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li class="<?php if($this->router->fetch_method()=='my_profile') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/my_profile">My Profile</a></li>
              <li class="<?php if($this->router->fetch_method()=='change_password') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/change_password">Change Password</a></li>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='role')&&($this->router->fetch_method()=='add_admin_user')) echo 'active';?>">
            <a><i class="fa fa-desktop"></i> Role Manager <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li class="<?php if($this->router->fetch_method()=='add_admin_user') echo 'active';?>"><a href="<?php echo site_url(); ?>/role/add_admin_user">Create Sub Admin</a></li>
              <li class="<?php if($this->router->fetch_method()=='admin_user_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/role/admin_user_manager">Sub Admin Users List</a></li>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('Supplier Management')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='supplier')&&($this->router->fetch_method()=='create_sup')||($this->router->fetch_method()=='sup_manager')||($this->router->fetch_method()=='supplier_hotels')) echo 'active';?>">
            <a><i class="fa fa-clone"></i>Supplier Management <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li class="<?php if($this->router->fetch_method()=='create_sup') echo 'active';?>">
                <a href="<?php echo site_url(); ?>/supplier/create_sup">
                  <i class="fa fa-caret-right"></i>  Create Supplier
                </a>
              </li>
              <li class="<?php if($this->router->fetch_method()=='sup_manager') echo 'active';?>">
                <a href="<?php echo site_url(); ?>/supplier/sup_manager">
                  <i class="fa fa-caret-right"></i>  Supplier list
                </a>
              </li>
              <li class="<?php if($this->router->fetch_method()=='supplier_hotels') echo 'active';?>">
                <a href="<?php echo site_url(); ?>/supplier/supplier_hotels">
                  <i class="fa fa-caret-right"></i>  Supplier Hotels
                </a>
              </li>
              <li class="<?php if($this->router->fetch_method()=='businesstype') echo 'active';?>">
                <a href="<?php echo site_url(); ?>/supplier/businesstype">
                  <i class="fa fa-caret-right"></i>  Manage Business Type
                </a>
              </li>
              <li class="<?php if($this->router->fetch_method()=='facilities') echo 'active';?>">
                <a href="<?php echo site_url(); ?>/supplier/facilities">
                  <i class="fa fa-caret-right"></i>Manage Facilities
                </a>
              </li>
              <li class="<?php if($this->router->fetch_method()=='roomtype') echo 'active';?>">
                <a href="<?php echo site_url(); ?>/supplier/roomtype">
                  <i class="fa fa-caret-right"></i>Manage Room Types
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('B2B User Management')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='b2b')&&($this->router->fetch_method()=='agent_manager')||($this->router->fetch_method()=='create_agent')) echo 'active nav-active';?>">
            <a><i class="fa fa-clone"></i>B2B User Management <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Create B2B User')) { ?>
              <li class="<?php if($this->router->fetch_method()=='create_agent') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/create_agent">Create B2B User</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Users List')) { ?>
              <li class="<?php if($this->router->fetch_method()=='agent_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/agent_manager">B2B Users List</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('B2B Markup Manager')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='b2b')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo 'active nav-active';?>">
            <a><i class="fa fa-desktop"></i>B2B Markup Manager <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Hotel Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='hotel_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/hotel_markup_manager">Hotel Markup Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Flight Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='flight_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/flight_markup_manager">Flight Markup Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Bus Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='bus_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/bus_markup_manager">Bus Markup Manager</a></li>
              <?php } ?>
               <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Car Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='car_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/car_markup_manager">Car Markup Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Transfer Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='transfer_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/transfer_markup_manager">Transfer Markup Manager</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('B2B Report Manager')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='b2b')&&($this->router->fetch_method()=='b2b_reports_manager_flights')||($this->router->fetch_method()=='b2b_reports_manager_holiday')||($this->router->fetch_method()=='b2b_reports_manager_hotel')) echo 'active nav-active';?>">
            <a><i class="fa fa-table"></i>B2B Reports Manager <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Hotel')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_hotel') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_hotel">B2B Hotel</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Flights')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_flights') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_flights">B2B Flights</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Holiday')) { ?>
              <!-- <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_holiday') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_holiday">B2B Holiday</a></li> -->
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Holiday')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_bus') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_bus">B2B Bus</a></li>
              <?php } ?>
               <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Car')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_car') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_car">B2B Car</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Transfer')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_transfer') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_transfer">B2B Transfer</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2B Activity')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2b_reports_manager_activity') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2b/b2b_reports_manager_activity">B2B Activity</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('B2C User Management')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='b2c')&&($this->router->fetch_method()=='user_manager')||($this->router->fetch_method()=='create_user')) echo 'active nav-active';?>">
            <a><i class="fa fa-clone"></i>B2C User Management <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Create B2C User')) { ?>
              <li class="<?php if($this->router->fetch_method()=='create_user') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/create_user">Create B2C User</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Users List')) { ?>
              <li class="<?php if($this->router->fetch_method()=='user_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/user_manager">B2C Users List</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('B2C Markup Manager')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='b2c')&&(($this->router->fetch_method()=='hotel_markup_manager')||($this->router->fetch_method()=='flight_markup_manager'))) echo 'active nav-active';?>">
            <a><i class="fa fa-desktop"></i>B2C Markup Manager <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Hotel Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='hotel_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/hotel_markup_manager">Hotel Markup Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Flight Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='flight_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/flight_markup_manager">Flight Markup Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Bus Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='bus_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/bus_markup_manager">Bus Markup Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Car Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='bus_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/car_markup_manager">Car Markup Manager</a></li>
              <?php } ?>
               <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Transfer Markup Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='transfer_markup_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/transfer_markup_manager">Transfer Markup Manager</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('B2C Report Manager')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='b2c')&&($this->router->fetch_method()=='b2c_reports_manager_flights')||($this->router->fetch_method()=='b2c_reports_manager_holiday')||($this->router->fetch_method()=='b2c_reports_manager_hotel')) echo 'active nav-active';?>">
            <a><i class="fa fa-table"></i>B2C Reports Manager<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Hotel')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_hotel') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_hotel">B2C Hotel</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Flights')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_flights') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_flights">B2C Flights</a></li>
              <?php }?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Holiday')) { ?>
              <!-- <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_holiday') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_holiday">B2C Holiday</a></li> -->
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Bus')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_bus') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_bus">B2C BUS</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Cars')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_car') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_car">B2C Cars</a></li>
              <?php } ?>
               <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Transfers')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_transfer') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_transfer">B2C Transfers</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('B2C Activity')) { ?>
              <li class="<?php if($this->router->fetch_method()=='b2c_reports_manager_activity') echo 'active';?>"><a href="<?php echo site_url(); ?>/b2c/b2c_reports_manager_activity">B2C Activity</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('Control Panel')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='currency_manager')||($this->router->fetch_method()=='api_manager')||($this->router->fetch_method()=='promotion_manager')||($this->router->fetch_method()=='hotel_logs')||($this->router->fetch_method()=='api_logs'))||($this->router->fetch_method()=='payment_manager')  )echo 'active nav-active';?>">
            <a><i class="fa fa-sitemap"></i>My Control Panel <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Currency Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='currency_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/currency_manager">Currency Manager</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('API Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='api_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/api_manager">API Manager</a></li>
              <?php } ?>
              <?php //if ($this->admin_auth->is_admin()|| $this->admin_auth->is_submoduleprivileged('Insurance')) { ?>
              <!-- <li class="<?php //if($this->router->fetch_method()=='add_insurance') echo 'active';?>"><a href="<?php //echo site_url(); ?>/home/add_insurance">Insurance API</a></li> -->
              <?php //} ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Promotional Manager')) { ?>
              <li class="<?php if($this->router->fetch_method()=='promotion_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/promotion_manager">Promotional Manager</a></li>
              <?php } ?>
              <?php  //if ($this->admin_auth->is_admin()|| $this->admin_auth->is_submoduleprivileged('Payment Gateway')) { ?>
              <!-- <li class="<?php //if($this->router->fetch_method()=='payment_manager') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/payment_manager"> Payment Gateway Manager</a></li> -->
              <?php //} ?>
              <!-- <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('API Logs')) { ?>
              <li class="<?php if($this->router->fetch_method()=='api_logs') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/api_logs">API Logs</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Hotel Logs')) { ?>
              <li class="<?php if($this->router->fetch_method()=='hotel_logs') echo 'active';?>"><a href="<?php echo site_url(); ?>/home/hotel_logs">Hotel Logs</a></li>
              <?php } ?> -->
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('Holiday Destination')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='holidaypackage')&&(($this->router->fetch_method()=='country')||($this->router->fetch_method()=='state')||($this->router->fetch_method()=='city'))) echo 'active nav-active';?>">
            <a><i class="fa fa-windows"></i>Holiday Destination <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="<?php if(($this->router->fetch_class()=='holidaypackage')&&(($this->router->fetch_method()=='country')||($this->router->fetch_method()=='state')||($this->router->fetch_method()=='city'))) echo 'display: block';?>">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Add Country')) { ?>
              <li class="<?php if($this->router->fetch_method()=='country') echo 'active';?>"><a href="<?php echo site_url(); ?>/holidaypackage/country">Add Country</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Add State')) { ?>
              <li class="<?php if($this->router->fetch_method()=='state') echo 'active';?>"><a href="<?php echo site_url(); ?>/holidaypackage/state">Add State</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Add City')) { ?>
              <li class="<?php if($this->router->fetch_method()=='city') echo 'active';?>"><a href="<?php echo site_url(); ?>/holidaypackage/city">Add City</a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('Holiday Packages')) { ?>
        <li class="nav-parent <?php if(($this->router->fetch_class()=='holiday'||$this->router->fetch_class()=='holidaypackage')&&(($this->router->fetch_method()=='continent')||($this->router->fetch_method()=='holidaypackagethemelist')||($this->router->fetch_method()=='holidaypackagelist')||($this->router->fetch_method()=='packagelist')||($this->router->fetch_method()=='bannner'))) echo 'active nav-active';?>">
          <a><i class="fa fa-windows"></i>Holiday Packages <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu" style="<?php if(($this->router->fetch_class()=='holiday'||$this->router->fetch_class()=='holidaypackage')&&(($this->router->fetch_method()=='continent')||($this->router->fetch_method()=='holidaypackagethemelist')||($this->router->fetch_method()=='holidaypackagelist')||($this->router->fetch_method()=='packagelist')||($this->router->fetch_method()=='bannner'))) echo 'display: block';?>">
            <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Continent & Inspiration Content')) { ?>
            <li class="<?php if($this->router->fetch_method()=='continent') echo 'active';?>">
              <a href="<?php echo site_url(); ?>/holidaypackage/continent">Continent & Inspiration Content</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Category')) { ?>
              <li class="<?php if($this->router->fetch_method()=='holidaypackagethemelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/holidaypackagethemelist">Category</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Add Itinerary')) { ?>
              <li class="<?php if($this->router->fetch_method()=='holidaypackagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/holidaypackagelist">Add Itinerary</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Holiday List')) { ?>
              <li class="<?php if($this->router->fetch_method()=='packagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/packagelist">Holiday List</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Home Banner')) { ?>
              <li class="<?php if($this->router->fetch_method()=='bannner') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/bannner">Home Banner</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <!-- <?php //if ($this->admin_auth->is_admin()||$this->admin_auth->is_privileged('Assign Packages')) { ?>
          <li class="nav-parent <?php //if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='hotofferpackagelist')||($this->router->fetch_method()=='trenddestipackagelist')||($this->router->fetch_method()=='location_destipackagelist')||($this->router->fetch_method()=='offbeatpackagelist')||($this->router->fetch_method()=='dealspackagelist'))) echo 'active nav-active';?>">
            <a><i class="fa fa-windows"></i>Assign Packages <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="<?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='hotofferpackagelist')||($this->router->fetch_method()=='trenddestipackagelist')||($this->router->fetch_method()=='location_destipackagelist')||($this->router->fetch_method()=='offbeatpackagelist')||($this->router->fetch_method()=='dealspackagelist'))) echo 'display: block';?>">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Hot Offers')) { ?>
              <li class="<?php if($this->router->fetch_method()=='hotofferpackagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/hotofferpackagelist">Hot Offers</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Trending Destinations')) { ?>
              <li class="<?php if($this->router->fetch_method()=='trenddestipackagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/trenddestipackagelist">Trending Destinations</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Home Search Destinations')) { ?>
              <li class="<?php if($this->router->fetch_method()=='location_destipackagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/location_destipackagelist">Home Search Destinations</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Offbeat Places')) { ?>
              <li class="<?php if($this->router->fetch_method()=='offbeatpackagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/offbeatpackagelist">Offbeat Places</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Deals')) { ?>
              <li class="<?php if($this->router->fetch_method()=='dealspackagelist') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/dealspackagelist">Deals</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php //} ?> -->
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('Holiday Reports')) { ?>
          <li class="nav-parent <?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='holiday_enquiry')||($this->router->fetch_method()=='holiday_pre_booking_report')||($this->router->fetch_method()=='holiday_booking_report'))) echo 'active nav-active';?>">
            <a><i class="fa fa-windows"></i>Holiday Reports <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="<?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='holiday_enquiry')||($this->router->fetch_method()=='holiday_pre_booking_report')||($this->router->fetch_method()=='holiday_booking_report'))) echo 'display: block';?>">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Holiday Enquiry & Subscriber List')) { ?>
              <li class="<?php if($this->router->fetch_method()=='holiday_enquiry') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/holiday_enquiry">Holiday Enquiry & Subscriber List</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Holiday Pre Booking Report')) { ?>
              <li class="<?php if($this->router->fetch_method()=='holiday_pre_booking_report') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/holiday_pre_booking_report">Holiday Pre Booking Report</a></li>
              <?php } ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Holiday Booking Report')) { ?>
              <li class="<?php if($this->router->fetch_method()=='holiday_booking_report') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/holiday_booking_report">Holiday Booking Report</a></li>
              <?php } ?>
              <!-- <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('Holiday Booking Payment Report')) { ?>
              <li class="<?php if($this->router->fetch_method()=='holiday_booking_payment_report') echo 'active';?>"><a href="<?php echo site_url(); ?>/holiday/holiday_booking_payment_report">Holiday Booking Payment Report</a></li>
              <?php } ?> -->
            </ul>
          </li>
          <?php } ?>
           <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('CMS')) { ?>
          <li class="nav-parent <?php if($this->router->fetch_class()=='cms') echo 'active nav-active';?>">
            <a><i class="fa fa-laptop"></i>Home Offer images<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('About us')) { ?>
              <li class="<?php if($this->router->fetch_method()=='about_us') echo 'active';?>"><a href="<?php echo site_url(); ?>/offers/best_hotel_images">Best Hotels</a></li>
              <?php } ?>
              <?php //  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('About us')) { ?>
              <!--<li class="<?php if($this->router->fetch_method()=='about_us') echo 'active';?>"><a href="<?php echo site_url(); ?>/offers/best_offers_images">Best Offers</a></li>-->
              <?php //} ?>
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('About us')) { ?>
              <li class="<?php if($this->router->fetch_method()=='about_us') echo 'active';?>"><a href="<?php echo site_url(); ?>/offers/holiday_images">Holidays </a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('admin_logged_in')||$this->admin_auth->is_privileged('CMS')) { ?>
          <li class="nav-parent <?php if($this->router->fetch_class()=='cms') echo 'active nav-active';?>">
            <a><i class="fa fa-laptop"></i>CMS<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <?php  if ($this->session->userdata('admin_logged_in')|| $this->admin_auth->is_submoduleprivileged('About us')) { ?>
              <li class="<?php if($this->router->fetch_method()=='about_us') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/about_us">About us</a></li>
              <li class="<?php if($this->router->fetch_method()=='faq') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/faq">FAQ</a></li>
              <li class="<?php if($this->router->fetch_method()=='contact_us') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/contact_us">Contact Us</a></li> 
              <li class="<?php if($this->router->fetch_method()=='support') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/support">Support</a></li>
              <li class="<?php if($this->router->fetch_method()=='price_details') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/price_details">Price Details</a></li>
              <li class="<?php if($this->router->fetch_method()=='privacy') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/privacy_statement">Privacy Policy</a></li>
              <li class="<?php if($this->router->fetch_method()=='terms') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/terms_condition">Terms & Condition</a></li>
              <li class="<?php if($this->router->fetch_method()=='notification') echo 'active';?>"><a href="<?php echo site_url(); ?>/cms/notification">Payment Notification </a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>