<section class="tab-view sub">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav2 justify-content-center">
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'hotels' || $this->uri->segment(3) == '') echo 'active text-success' ?>" href="<?php echo site_url() ?>b2c/my_bookings/hotels">HOTELS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'flights') echo 'active text-success' ?>" href="<?php echo site_url() ?>b2c/my_bookings/flights">FLIGHTS</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link <?php //if($this->uri->segment(3) == 'bus') echo 'active text-success' ?>" href="<?php //echo site_url() ?>b2c/my_bookings/bus">BUS</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link <?php //if($this->uri->segment(3) == 'holidays') echo 'active text-success' ?>" href="<?php //echo site_url() ?>b2c/my_bookings/holidays">HOLIDAYS</a>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
</section>