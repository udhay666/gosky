<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/header'); ?>

<?php
  
  $this->load->model('home/Home_Model');
  
?>
<header class="header-bottom mycustom-slider">
   <div class="layover-container">
      
   </div>
   <?php $this->load->view('searchform'); ?>
</header>

<?php //$this->load->view('home/footer'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/autocomplete/hotels_city_list.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/autocomplete/airports_lists.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/flight/flightcustom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/flight/multicity.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript">
(function () {
  // store the slider in a local variable
  var $window = $(window),flexslider;
  // tiny helper function to add breakpoints
  function getGridSize() {
    return (window.innerWidth < 600) ? 2 : (window.innerWidth < 900) ? 4 : 6;
  }
  $window.on('load',function () {
    $('.flexslider').flexslider({
      animation: "slide",
      animationLoop: true,
      touch: true,
      controlNav: false,
      keyboard: true,
      move: 0,
      prevText: '<i class="mdi mdi-chevron-left"></i>',
      nextText: '<i class="mdi mdi-chevron-right"></i>',
      slideshow: false,
      itemWidth: 100,
      itemMargin: 10,
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });
  });
  // check grid size on resize event
  /*$window.resize(function () {
      var gridSize = getGridSize();
      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
  });*/
}());
</script>

<script type="text/javascript">
   // Fix top on scroll
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("top-nav");
    var sticky = navbar.offsetTop+550;
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("fixed-top");
      } else {
        navbar.classList.remove("fixed-top");
      }
    }
</script>