<?php //echo '<pre>';print_r($supplier_info->first_name);exit; ?><?php echo $this->load->view('header') ?><?php echo $this->load->view('subheader') ?><?php echo $this->load->view('top_panel') ?><?php echo $this->load->view('left_panel') ?><?php //echo $this->load->view('content_panel') ?> <?php echo $this->load->view('subfooter') ?>  <!--  CONTENT -->  <section id="content">    <div class="page page-charts">      <div class="row">        <div class="col-md-12">          <div class="pageheader">            <h2>Admin Dashboard</h2>            <div class="page-bar  br-5">              <ul class="page-breadcrumb">                <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>                             </ul>            </div>          </div>        </div>      </div>        <!-- Hotel Booking -->        <div class="row">        <div class="col-md-12">          <section class="boxs">            <div class="boxs-header dvd dvd-btm">              <h1 class="custom-font"><strong>Monthly Hotel Booking </strong>Chart</h1>              <ul class="controls">                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>                <li class="remove"><a role="button" tabindex="0" class="boxs-close"><i class="fa fa-times"></i></a></li>              </ul>            </div>            <div class="boxs-body">              <div id="hotel-booking-chart" style="height: 250px"></div>            </div>          </section>        </div>            </div>      <!-- Hotel Monthly Sales -->      <div class="row">        <div class="col-md-12">          <section class="boxs">            <div class="boxs-header dvd dvd-btm">              <h1 class="custom-font"><strong>Monthly Sales </strong>Chart</h1>              <ul class="controls">                <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>                <li class="remove"><a role="button" tabindex="0" class="boxs-close"><i class="fa fa-times"></i></a></li>              </ul>            </div>            <div class="boxs-body">              <div id="hotelsales-chart" style="height: 250px"></div>            </div>          </section>        </div>            </div>        </div>  </section></div><!--/ custom javascripts --> <script src="<?php echo base_url(); ?>public/js/vendor/flot/jquery.flot.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/flot-spline/jquery.flot.spline.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/easypiechart/jquery.easypiechart.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/raphael/raphael-min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/morris/morris.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/owl-carousel/owl.carousel.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/datatables/js/jquery.dataTables.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/chosen/chosen.jquery.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/summernote/summernote.min.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/coolclock/coolclock.js"></script> <script src="<?php echo base_url(); ?>public/js/vendor/coolclock/excanvas.js"></script> <!--/ vendor javascripts --> <!-- Custom JavaScripts --> <script src="<?php echo base_url(); ?>public/js/main.js"></script> <!--/ custom javascripts --> <script type="text/javascript" src="<?php echo base_url(); ?>public/js/charts/loader.js"></script> <script type="text/javascript">   $(window).load(function(){      	  // Initialize Sales Chart             var hotelsalesdata = [{                data: [[1,150000],[2,175000],[3,168000],[4,145000],[5,150000],[6,130000],[7,190000],[8,220000],[9,165000],[10,180000],[11,188000],[12,250000]],                label: 'Sales Amount',                points: {                    show: true,                    radius: 6                },                splines: {                    show: true,                    tension: 0.45,                    lineWidth: 5,                    fill: 0                }            }];            var hotelsalesoptions = {                colors: ['#a2d200'],                series: {                    shadowSize: 0                },                xaxis:{                    font: {                        color: '#3d4c5a'                    },                    position: 'bottom',                    ticks: [                        [ 1, 'Jan' ], [ 2, 'Feb' ], [ 3, 'Mar' ], [ 4, 'Apr' ], [ 5, 'May' ], [ 6, 'Jun' ], [ 7, 'Jul' ], [ 8, 'Aug' ], [ 9, 'Sep' ], [ 10, 'Oct' ], [ 11, 'Nov' ], [ 12, 'Dec' ]                    ]                },                yaxis: {                    font: {                        color: '#3d4c5a'                    }                },                grid: {                    hoverable: true,                    clickable: true,                    borderWidth: 0,                    color: '#ccc'                },                tooltip: true,                tooltipOpts: {                    content: '%s: %y',                    defaultTheme: false,                    shifts: {                        x: 0,                        y: 20                    }                }            };            var hotelsalesplot = $.plot($("#hotelsales-chart"), hotelsalesdata, hotelsalesoptions);            $(window).resize(function() {                // redraw the graph in the correctly sized div                hotelsalesplot.resize();                hotelsalesplot.setupGrid();                hotelsalesplot.draw();            });            // * End Hotel Sales Chart             // Initialize Hotel Booking Chart            var hotelbookingdata = [{                data: [[1,300],[2,420],[3,380],[4,290],[5,300],[6,250],[7,400],[8,500],[9,350],[10,420],[11,410],[12,500]],                label: 'Hotel Booking',                                points: {                    show: true,                    radius: 6                },                splines: {                    show: true,                    tension: 0.45,                    lineWidth: 5,                    fill: 0                }            }];            var hotelbookingoptions = {                colors: ['#cd97eb'],                series: {                    shadowSize: 0                },                xaxis:{                    font: {                        color: '#3d4c5a'                    },                    position: 'bottom',                    ticks: [                        [ 1, 'Jan' ], [ 2, 'Feb' ], [ 3, 'Mar' ], [ 4, 'Apr' ], [ 5, 'May' ], [ 6, 'Jun' ], [ 7, 'Jul' ], [ 8, 'Aug' ], [ 9, 'Sep' ], [ 10, 'Oct' ], [ 11, 'Nov' ], [ 12, 'Dec' ]                    ]                },                yaxis: {                    font: {                        color: '#3d4c5a'                    }                },                grid: {                    hoverable: true,                    clickable: true,                    borderWidth: 0,                    color: '#ccc'                },                tooltip: true,                tooltipOpts: {                    content: '%s: %y',                    defaultTheme: false,                    shifts: {                        x: 0,                        y: 20                    }                }            };            var hotelbookingplot = $.plot($("#hotel-booking-chart"), hotelbookingdata, hotelbookingoptions);            $(window).resize(function() {                // redraw the graph in the correctly sized div                hotelbookingplot.resize();                hotelbookingplot.setupGrid();                hotelbookingplot.draw();            });            // End  Hotel Booking Chart        });</script>