<body id="yatri" class="appWrapper">
<!-- Application Content -->
<div id="wrap" class="animsition"> 
  <!-- HEADER Content -->
  <section id="header">
    <header class="clearfix"> 
      <!-- Branding -->
      <div class="branding"> <a class="brand" href="<?php echo site_url() ?>"><span>BiZZHOLIDAYS</span></a> <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a> </div>
      <!-- Branding end --> 
      <!-- Left-side navigation -->
      <ul class="nav-left pull-left list-unstyled list-inline">
        <li class="sidebar-collapse"><a role="button" tabindex="0" class="collapse-sidebar"><i class="fa fa-outdent"></i></a></li> 
      </ul>
      <!-- Left-side navigation end -->     
    
      
      <!-- Right-side navigation -->
      <ul class="nav-right pull-right list-inline">
        <li class="dropdown nav-profile"> <a href class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url(); ?>public/images/profile-photo.jpg" alt="" class=" size-30x30"> <span><?php echo $supplier_info->first_name.' '. $supplier_info->last_name ?> <i class="fa fa-angle-down"></i></span> </a>
          <ul class="dropdown-menu animated littleFadeInDown " role="menu">
            <li><a href="<?php echo site_url();?>home/my_profile" role="button" tabindex="0"><i class="fa fa-user"></i>My Profile</a></li>
            <li><a href="<?php echo site_url();?>home/change_password" role="button" tabindex="0"><i class="fa fa-cog"></i>Change Password</a></li>         
            <li><a href="<?php echo site_url();?>login/supplier_logout" role="button" tabindex="0"><i class="fa fa-sign-out"></i>Logout</a></li>
          </ul>
        </li>      
      </ul>
      <!-- Right-side navigation end --> 
    </header>
  </section>
  <!--/ HEADER Content  --> 