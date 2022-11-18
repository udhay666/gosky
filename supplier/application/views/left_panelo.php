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
            <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
              <div class="panel-body"> 
                <!--  NAVIGATION Content -->
                <ul id="navigation">
                  <li class="<?php if(($this->router->fetch_class()=='home')&&(($this->router->fetch_method()=='index'))) echo 'active open';?>"><a href="<?php echo site_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>             
                  <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Hotels</span></a>
                    <ul>
                      <li class="<?php if(($this->router->fetch_class()=='hotel')&&(($this->router->fetch_method()=='add_hotel')||($this->router->fetch_method()=='edit_hotel')||($this->router->fetch_method()=='quick_add')||($this->router->fetch_method()=='edit_step2'))) echo 'active';?>"><a href="<?php echo site_url(); ?>hotel/add_hotel"><i class="fa fa-angle-right"></i> Add Hotel</a></li>
                      <li class="<?php if(($this->router->fetch_class()=='hotel')&&(($this->router->fetch_method()=='hotel_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>hotel/hotel_list"><i class="fa fa-angle-right"></i> Hotel List</a></li>                    
                    </ul>
                  </li>
                  <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Rooms</span></a>
                    <ul>
                      <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='add_room'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/add_room"><i class="fa fa-angle-right"></i> Add Room</a></li>
                      <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='room_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/room_list"><i class="fa fa-angle-right"></i> Room List</a></li>
                     <!-- <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='room_image_gallery'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/room_image_gallery"><i class="fa fa-angle-right"></i> Room Image Gallery</a></li> -->
                    </ul> 
                  </li>
                  
       <!--   <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Rooms Rate</span></a>
                    <ul>
                      <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='add_room_rate'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/add_room_rate"><i class="fa fa-angle-right"></i> Add Room Rate</a></li>

                       <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='edit_room_rate'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/edit_room_rate"><i class="fa fa-angle-right"></i>Edit Room Rate</a></li>

                      <li class="<?php if(($this->router->fetch_class()=='room')&&(($this->router->fetch_method()=='room_rate_list'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room/room_rate_list"><i class="fa fa-angle-right"></i> Room Rate List</a></li>
                    
                    </ul> 
                  </li> -->


                   <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Property Type</span></a>
                    <ul>
                    <li class="<?php if(($this->router->fetch_class()=='property_type')&&(($this->router->fetch_method()=='propertytype')||($this->router->fetch_method()=='view_property_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>property_type/propertytype"><i class="fa fa-angle-right"></i>Manage Property Type</a></li>               
                    </ul>
                  </li>


                   <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Facilities Type</span></a>
                    <ul>
                        <li class="<?php if(($this->router->fetch_class()=='facility_type')&&(($this->router->fetch_method()=='facilitytype')||($this->router->fetch_method()=='view_facility_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>facility_type/facilitytype"><i class="fa fa-angle-right"></i>Manage Facilities Type</a></li>                
                    </ul>
                  </li>


                   <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Room Type</span></a>
                    <ul>
                     <li class="<?php if(($this->router->fetch_class()=='room_type')&&(($this->router->fetch_method()=='roomtype')||($this->router->fetch_method()=='view_room_type_info'))) echo 'active';?>"><a href="<?php echo site_url(); ?>room_type/roomtype"><i class="fa fa-angle-right"></i>Manage Room Type</a></li>             
                    </ul>
                  </li>

                  <li><a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Excursions</span></a>
                    <ul>
                      <li class="<?php if(($this->router->fetch_class()=='excursions')&&(($this->router->fetch_method()=='add_excursion'))) echo 'active';?>"><a href="<?php echo site_url(); ?>excursions/add_excursion"><i class="fa fa-angle-right"></i>Add Excursions</a></li>
                      <li class="<?php if(($this->router->fetch_class()=='excursions')&&(($this->router->fetch_method()=='excursion_list')||($this->router->fetch_method()=='edit_excursion'))) echo 'active';?>"><a href="<?php echo site_url(); ?>excursions/excursion_list"><i class="fa fa-angle-right"></i>Excursions List</a></li>
                    </ul>
                  </li>
                </ul>
                <!--/ NAVIGATION Content --> 
              </div>
            </div>
          </div>
          <!-- <div class="panel settings panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title"><a data-toggle="collapse" href="#sidebarControls">General Settings <i class="fa fa-angle-up"></i></a></h4>
            </div>
            <div id="sidebarControls" class="panel-collapse collapse in" role="tabpanel">
              <div class="panel-body">
                <div class="form-group">
                  <div class="row">
                    <label class="col-xs-8 control-label">Switch ON</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch orange">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-on" checked="">
                        <label class="onoffswitch-label" for="switch-on"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-xs-8 control-label">Switch OFF</label>
                    <div class="col-xs-4 control-label">
                      <div class="onoffswitch orange">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-off">
                        <label class="onoffswitch-label" for="switch-off"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </aside>
    <!--/ SIDEBAR Content --> 
    
    <!--RIGHTBAR Content -->
    <!-- <aside id="rightbar">
      <div role="tabpanel"> 
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab"><i class="fa fa-users"></i></a></li>
          <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
          <li role="presentation"><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i></a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="users">
            <h6><strong>Online</strong> Users</h6>
            <ul>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/pi-avatar.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Ing. Lucas <strong>Kamarel</strong></span> <small><i class="fa fa-map-marker"></i> Ulaanbaatar, Mongolia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/John-avatar.jpg" alt> </a> <span class="badge bg-lightred unread">3</span>
                  <div class="media-body"> <span class="media-heading">John <strong>Karlsberg</strong></span> <small><i class="fa fa-map-marker"></i> Bratislava, Slovakia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/Jane-avatar.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Jane <strong>Kay</strong></span> <small><i class="fa fa-map-marker"></i> Kosice, Slovakia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/Donia-avatar.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Donia <strong>McCain</strong></span> <small><i class="fa fa-map-marker"></i> Prague, Czech Republic</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="busy">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar1.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Lucius <strong>Cashmere</strong></span> <small><i class="fa fa-map-marker"></i> Wien, Austria</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="busy">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar2.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Jesse <strong>Phoenix</strong></span> <small><i class="fa fa-map-marker"></i> Berlin, Germany</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
            </ul>
            <h6><strong>Offline</strong> Users</h6>
            <ul>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar4.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Dell <strong>MacApple</strong></span> <small><i class="fa fa-map-marker"></i> Paris, France</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar5.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Roger <strong>Flopple</strong></span> <small><i class="fa fa-map-marker"></i> Rome, Italia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar6.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Nico <strong>Vulture</strong></span> <small><i class="fa fa-map-marker"></i> Kyjev, Ukraine</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar7.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Bobby <strong>Socks</strong></span> <small><i class="fa fa-map-marker"></i> Moscow, Russia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar8.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Anna <strong>Opichia</strong></span> <small><i class="fa fa-map-marker"></i> Budapest, Hungary</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="history">
            <h6><strong>Chat</strong> History</h6>
            <ul>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/pi-avatar.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Ing. Lucas <strong>Kamarel</strong></span> <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="busy">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/John-avatar.jpg" alt> </a> <span class="badge bg-lightred unread">3</span>
                  <div class="media-body"> <span class="media-heading">John <strong>Karlsberg</strong></span> <small>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/Jane-avatar.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Jane <strong>Kay</strong></span> <small>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit </small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="friends">
            <h6><strong>Friends</strong> List</h6>
            <ul>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/John-avatar.jpg" alt> </a> <span class="badge bg-lightred unread">3</span>
                  <div class="media-body"> <span class="media-heading">John <strong>Karlsberg</strong></span> <small><i class="fa fa-map-marker"></i> Bratislava, Slovakia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="offline">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar8.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Anna <strong>Opichia</strong></span> <small><i class="fa fa-map-marker"></i> Budapest, Hungary</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="busy">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/random-avatar1.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Lucius <strong>Cashmere</strong></span> <small><i class="fa fa-map-marker"></i> Wien, Austria</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
              <li class="online">
                <div class="media"> <a class="pull-left thumb thumb-sm" role="button" tabindex="0"> <img class="media-object " src="<?php echo base_url(); ?>public/images/pi-avatar.jpg" alt> </a>
                  <div class="media-body"> <span class="media-heading">Ing. Lucas <strong>Kamarel</strong></span> <small><i class="fa fa-map-marker"></i> Ulaanbaatar, Mongolia</small> <span class="badge badge-outline status"></span> </div>
                </div>
              </li>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="settings">
            <h6><strong>Chat</strong> Settings</h6>
            <ul class="settings">
              <li>
                <div class="form-group">
                  <label class="col-xs-8 control-label">Show Offline Users</label>
                  <div class="col-xs-4 control-label">
                    <div class="onoffswitch orange">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-offline" checked="">
                      <label class="onoffswitch-label" for="show-offline"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form-group">
                  <label class="col-xs-8 control-label">Show Fullname</label>
                  <div class="col-xs-4 control-label">
                    <div class="onoffswitch orange">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-fullname">
                      <label class="onoffswitch-label" for="show-fullname"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form-group">
                  <label class="col-xs-8 control-label">History Enable</label>
                  <div class="col-xs-4 control-label">
                    <div class="onoffswitch orange">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-history" checked="">
                      <label class="onoffswitch-label" for="show-history"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form-group">
                  <label class="col-xs-8 control-label">Show Locations</label>
                  <div class="col-xs-4 control-label">
                    <div class="onoffswitch orange">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-location" checked="">
                      <label class="onoffswitch-label" for="show-location"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form-group">
                  <label class="col-xs-8 control-label">Notifications</label>
                  <div class="col-xs-4 control-label">
                    <div class="onoffswitch orange">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-notifications">
                      <label class="onoffswitch-label" for="show-notifications"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form-group">
                  <label class="col-xs-8 control-label">Show Undread Count</label>
                  <div class="col-xs-4 control-label">
                    <div class="onoffswitch orange">
                      <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-unread" checked="">
                      <label class="onoffswitch-label" for="show-unread"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </aside> -->
    <!--/ RIGHTBAR Content --> 
  </div>
  <!--/ CONTROLS Content --> 