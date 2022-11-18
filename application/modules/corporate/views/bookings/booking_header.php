<section class="tab-view sub">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'hotels' || $this->uri->segment(3) == '') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/hotels"><span style="color: #203Fb3">HOTELS</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'flights') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/flights"><span style="color: #203Fb3">FLIGHT</span></a>
          </li>
         <!--  <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'holidays') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/holidays">HOLIDAYS</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'bus') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/bus">BUS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'transfer') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/transfer">Transfer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'cabs') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/cabs">CABS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'activity') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/activity">Activity</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(3) == 'insurance') echo 'active text-success' ?>" href="<?php echo site_url() ?>corporate/my_bookings/insurance">INSURANCE</a>
          </li> -->
        </ul>
    </div>
  </div>
</div>
</section>