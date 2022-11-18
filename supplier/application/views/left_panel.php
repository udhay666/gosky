<!--  CONTROLS Content -->
<div id="controls">
  <!--SIDEBAR Content -->
  <aside id="sidebar">
    <div id="sidebar-wrap">
      <div class="panel-group slim-scroll" role="tablist">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            <h4 class="panel-title" style="color: #fff"><br>Welcome <span style="color: #4caf50"> <?php echo $supplier_info->supplier_no ?></span></h4>
            <h4 class="panel-title"><a data-toggle="collapse" href="#sidebarNav">Navigation <i class="fa fa-angle-up"></i></a></h4>
          </div>
          <?php 
          $mod_auth = explode(',', $supplier_info->module_permission);
          $allMod = false; $hMod = false; $tMod = false; $vMod = false;
          if(!empty($mod_auth)){
            foreach ($mod_auth as $mod) {
              if($mod == '1'){
                $allMod = $hMod =true;
              } else if($mod == '2'){
                $allMod = $vMod =true;
              } else if($mod == '3'){
                $allMod = $tMod =true;
              } else {
                $hMod = false; $tMod = false; $vMod = false;
                $allMod = false;
              }
            }
          }
          ?>
          <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
            <div class="panel-body">
              <!--  NAVIGATION Content -->
              <ul id="navigation">
                <li class="<?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='index'))) echo 'active open';?>">
                  <a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                  <?php if($hMod == true){ ?>
                  <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Hotels</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='hotel')&&(($this->router->fetch_method()=='add_hotel')||($this->router->fetch_method()=='edit_hotel')||($this->router->fetch_method()=='quick_add')||($this->router->fetch_method()=='edit_step2'))) echo 'active';?>"><a href="<?php echo site_url(); ?>hotel/add_hotel"><i class="fa fa-angle-right"></i> Add Hotel</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='hotel')&&(($this->router->fetch_method()=='hotel_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>hotel/hotel_list"><i class="fa fa-angle-right"></i> Hotel List</a></li>
                  </ul>
                </li>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Contract</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='contract')&&(($this->router->fetch_method()=='new_contract'))) echo 'active';?>"><a href="<?php echo site_url(); ?>contract/new_contract"><i class="fa fa-angle-right"></i>Add New Contract</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='contract')&&(($this->router->fetch_method()=='contract_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>contract/contract_list"><i class="fa fa-angle-right"></i>Contract List</a></li>
                  </ul>
                </li>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Rooms</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='add_room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/add_room"><i class="fa fa-angle-right"></i> Add Room</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='room_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/room_list"><i class="fa fa-angle-right"></i> Room List</a></li>
                    <!-- <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='room_image_gallery'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/room_image_gallery"><i class="fa fa-angle-right"></i> Room Image Gallery</a></li> -->
                  </ul>
                </li>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Manage Room Rates</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='add')||($this->router->fetch_method()=='add_room_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/add"><i class="fa fa-angle-right"></i> Add Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='view_room_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/view_room_rates"><i class="fa fa-angle-right"></i> View Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomrates')&&(($this->router->fetch_method()=='edit_rates_room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomrates/edit_rates_room"><i class="fa fa-angle-right"></i>Edit Room Rates</a></li>
                  </ul>
                </li>
               <!--  <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Special Offer Room Rates</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='specialoffer')&&(($this->router->fetch_method()=='add')||($this->router->fetch_method()=='add_room_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>specialoffer/add"><i class="fa fa-angle-right"></i>Add Special Offer Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='specialoffer')&&(($this->router->fetch_method()=='view_room_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>specialoffer/view_room_rates"><i class="fa fa-angle-right"></i>View Special Offer Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='specialoffer')&&(($this->router->fetch_method()=='edit_rates_room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>specialoffer/edit_rates_room"><i class="fa fa-angle-right"></i>Edit Special Offer Room Rates</a></li>
                  </ul>
                </li> 
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Room Supplements Rates</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='supplements')&&(($this->router->fetch_method()=='add')||($this->router->fetch_method()=='add_room_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>supplements/add"><i class="fa fa-angle-right"></i>Add Supplements Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='supplements')&&(($this->router->fetch_method()=='view_room_rates'))) echo 'active';?>"><a href="<?php echo site_url(); ?>supplements/view_room_rates"><i class="fa fa-angle-right"></i>View Supplements Room Rates</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='supplements')&&(($this->router->fetch_method()=='edit_rates_room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>supplements/edit_rates_room"><i class="fa fa-angle-right"></i>Edit Supplements Room Rates</a></li>
                  </ul>
                </li>-->
                <!-- Room Allotment  Start -->
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Manage Room Allotment</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='roomsallotment')&&(($this->router->fetch_method()=='assign')||($this->router->fetch_method()=='assign_rooms_allotment'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomsallotment/assign"><i class="fa fa-angle-right"></i>Assign Room Allotment</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='roomsallotment')&&(($this->router->fetch_method()=='view_room_allotment')||($this->router->fetch_method()=='room_rate_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>roomsallotment/view_room_allotment"><i class="fa fa-angle-right"></i> View Room Allotment</a></li>
                    <!--   <li class="<?php if(($this->router->fetch_class()=='roomsallotment')&&(($this->router->fetch_method()=='view_specialoffer_room_rates'))||($this->router->fetch_method()=='view_cal_room_rates')) echo 'active';?>"><a href="<?php echo site_url(); ?>roomsallotment/view_specialoffer_room_rates"><i class="fa fa-angle-right"></i> View Special offer Room Allotment</a></li> -->
                  </ul>
                </li>
                <!-- Room Allotment End -->
                
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Manage Meal Plan</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='meal_plan')&&(($this->router->fetch_method()=='mealplan')||($this->router->fetch_method()=='view_meal_plan_info')||($this->router->fetch_method()=='view_meal_plan_desc'))) echo 'active';?>"><a href="<?php echo site_url(); ?>meal_plan/mealplan"><i class="fa fa-angle-right"></i>Manage Meal Plan</a></li>
                  </ul>
                </li>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Property Type</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='property_type')&&(($this->router->fetch_method()=='propertytype')||($this->router->fetch_method()=='view_property_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>property_type/propertytype"><i class="fa fa-angle-right"></i>Manage Property Type</a></li>
                  </ul>
                </li>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Facilities Type</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='facility_type')&&(($this->router->fetch_method()=='facilitytype')||($this->router->fetch_method()=='view_facility_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>facility_type/facilitytype"><i class="fa fa-angle-right"></i>Manage Facilities Type</a></li>
                  </ul>
                </li>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Room Type</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='room_type')&&(($this->router->fetch_method()=='roomtype')||($this->router->fetch_method()=='view_room_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room_type/roomtype"><i class="fa fa-angle-right"></i>Manage Room Type</a></li>
                  </ul>
                </li>
              <?php } ?>
              <?php //if($tMod == true){ ?>
               <!--  <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Tours</span></a>
                  <ul>
                    <li class="<?php if((($this->router->fetch_class()=='holiday')||($this->router->fetch_class()=='manage_age'))&&(($this->router->fetch_method()=='add_holiday')||($this->router->fetch_method()=='edit_holiday')||($this->router->fetch_method()=='quick_add')||($this->router->fetch_method()=='edit_step2')||($this->router->fetch_method()=='travellers_age')||($this->router->fetch_method()=='edit_age')||($this->router->fetch_method()=='edit_type')||($this->router->fetch_method()=='edit_step2'))) echo 'active';?>"><a href="<?php echo site_url(); ?>holiday/add_holiday"><i class="fa fa-angle-right"></i> Add Tours</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='holiday')&&(($this->router->fetch_method()=='holiday_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>holiday/holiday_list"><i class="fa fa-angle-right"></i>Tours List</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='manage_age')&&(($this->router->fetch_method()=='travellers_age')||($this->router->fetch_method()=='edit_age'))) echo 'active';?>"><a href="<?php echo site_url(); ?>manage_age/travellers_age"><i class="fa fa-angle-right"></i>Manage Travellers Age</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='manage_age')&&(($this->router->fetch_method()=='travellers_type')||($this->router->fetch_method()=='edit_type'))) echo 'active';?>"><a href="<?php echo site_url(); ?>manage_age/travellers_type"><i class="fa fa-angle-right"></i>Manage Trip Type</a></li>
                  </ul>
                </li> -->
              <?php //} ?>
                <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Manage Booking</span></a>
                  <ul>
                    <?php if($hMod == true){ ?>
                    <li class="<?php if(($this->router->fetch_class()=='managebooking')&&(($this->router->fetch_method()=='hotel_booking'))) echo 'active';?>"><a href="<?php echo site_url(); ?>managebooking/hotel_booking"><i class="fa fa-angle-right"></i>Hotel Booking</a></li><?php } ?>
                    <?php if($tMod == true){ ?>
                    <li class="<?php if(($this->router->fetch_class()=='managebooking')&&(($this->router->fetch_method()=='excursion_booking'))) echo 'active';?>"><a href="<?php echo site_url(); ?>managebooking/excursion_booking"><i class="fa fa-angle-right"></i>Tour Booking</a></li>
                  <?php } ?>
                  </ul>
                </li>
                 <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Activity </span></a>
                  <ul>
                    <?php if($hMod == true){ ?>
                    <!-- <li class="<?php if(($this->router->fetch_class()=='managebooking')&&(($this->router->fetch_method()=='hotel_booking'))) echo 'active';?>"><a href="<?php echo site_url(); ?>holiday/holidaypackagelist"><i class="fa fa-angle-right"></i>Add Itinerary</a></li> -->
                    <li><a href="<?php echo site_url();?>home/add_Itinerary" role="button" tabindex="0"><i class="fa fa-user"></i>Add Activity</a></li>
                    <li><a href="<?php echo site_url();?>home/activity_list" role="button" tabindex="0"><i class="fa fa-user"></i>Activity list</a></li>
                    <?php } ?>
                    
                  </ul>
                </li>
                
                <!-- <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Excursions</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='excursions')&&(($this->router->fetch_method()=='categories'))) echo 'active';?>"><a href="<?php echo site_url(); ?>excursions/categories"><i class="fa fa-angle-right"></i>Categories</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='excursions')&&(($this->router->fetch_method()=='add_excursion'))) echo 'active';?>"><a href="<?php echo site_url(); ?>excursions/add_excursion"><i class="fa fa-angle-right"></i>Add Excursions</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='excursions')&&(($this->router->fetch_method()=='excursion_list')||($this->router->fetch_method()=='edit_excursion'))) echo 'active';?>"><a href="<?php echo site_url(); ?>excursions/excursion_list"><i class="fa fa-angle-right"></i>Excursions List</a></li>
                  </ul>
                </li> -->
                <!-- <li>
                  <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Manage Holidays</span></a>
                  <ul>
                    <li class="<?php if(($this->router->fetch_class()=='manage_age')&&(($this->router->fetch_method()=='travellers_age')||($this->router->fetch_method()=='edit_age'))) echo 'active';?>"><a href="<?php echo site_url(); ?>manage_age/travellers_age"><i class="fa fa-angle-right"></i>Manage Travellers Age</a></li>
                    <li class="<?php if(($this->router->fetch_class()=='manage_age')&&(($this->router->fetch_method()=='travellers_type')||($this->router->fetch_method()=='edit_type'))) echo 'active';?>"><a href="<?php echo site_url(); ?>manage_age/travellers_type"><i class="fa fa-angle-right"></i>Manage Trip Type</a></li>
                  </ul>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
</div>