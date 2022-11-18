<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.css">
<link rel='stylesheet' href='<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.print.min.css' media='print' />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/daterangepicker.css">
<script type="text/javascript">
  var siteUrl='<?php echo site_url();?>';
</script>
<style type="text/css">
 #external-events > li.active,
 #external-events > li.active,
 #external-events > li.active {
  background-color: #01c0c8 !important;
  /*color: #fff !important;*/
}
</style>
<section id="content">
  <div class="page page-forms-wizard">
    <div class="row">
      <div class="col-md-12">
        <section class="boxs">
          <div class="boxs-header dvd dvd-btm">
             <h1 class="custom-font"><strong>Rate </strong>Calendar</h1> 
            <ul class="controls">
              <li> <a role="button" tabindex="0" class="boxs-toggle"> <span class="minimize"><i class="fa fa-angle-down"></i></span> <span class="expand"><i class="fa fa-angle-up"></i></span> </a> </li>
              <li class="remove"><a role="button" tabindex="0" class="boxs-close"><i class="fa fa-times"></i></a></li>
            </ul>
          </div>       
              <div class="boxs-body">
                <form>
                <div class="row border_row"> 
                <div class="form-group col-md-6">
                <label class="strong">Please Select a priod for view Excursion Rate : </label>
                 <div class="row" style="margin-left:1px;"> 
                <div class="form-group col-md-6">
                <input type="text" class="form-control selectdate" id="from_date" name="from_date" placeholder="Select From Date" required="required">
                </div>
                 <div class="form-group col-md-6">
                 <input type="text" class="form-control selectdate" id="to_date" name="to_date" placeholder="Select To Date" required="required">
               </div>
              </div>
              </div> 
              <div class="form-group col-md-3" style="padding-top: 23px;">               
                 <input  class="btn btn-success" type="button" id="show_calender"  value="Show Calendar" />            
                </div>
                </div>
            </form>
            </div>
          <div class="pagecontent">
            <div class="page page-full page-calendar">
                 <div class="tbox tbox-sm">            
                  <div class="tcol w-lg bg-tr-white lt b-r">     
             
               
                 <ul  id="external-events" style="list-style: none;" >
                  <?php if(!empty($rate_types)){
                   for($i=0;$i<count($rate_types);$i++){ 
                    if($i==0)
                     {
                     $classactive='active';
                     }
                     else
                     {
                      $classactive='';
                    }
                  ?>
                  <li class="<?php echo $classactive; ?> col-md-3 p-10 mb-5  event-control b-l b-3x b-greensea br-5" data-excursion-id="<?php echo $rate_types[$i]->excursions_rate_types_id; ?>" data-hotel-code="<?php echo $rate_types[$i]->excursions_code; ?>">
                   <?php echo $rate_types[$i]->rate_types_name; ?>
                 </li>
                 <?php } } ?>       
               </ul>
              
               </div>

            
            </div>
              <div class="tbox tbox-sm">            
                  <div class="tcol w-lg bg-tr-white lt b-r"> 

             <div class="tcol"> 
              <!-- right side header -->
              <div class="p-15">
                <div class="pull-right">      
                 <div>
                  <?php if(!empty($rate_types)){  ?>
              
                  <a class="btn btn-warning btn-sm changecal" data-dur-vlaue="month" id="change-view-listMonth">Month</a>
                   <a class="printBtn btn btn-success btn-sm hidden-print">Print</a>
           
                  <?php } ?>       
                </div>
              </div> 
        <h4 class="custom-font" style="padding-left:10px;color: red;">Excusion : <?php echo $excursion_detail[0]->excursion_name;?></h4>
            
              </div>          
        
         
            <div class="p-15">
              <div id='calendar'></div>
            </div>
            <!-- /right side body --> 
          </div>
          <!-- /right side --> 
        </div>
      </div>
    </div>
    </div>
    </section>
    </div>
    </div>
    </div>
    </section>

<div class="modal fade" id="loadroomratesajax" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 70px;">
  <div class="modal-dialog" style="width: 650px;">
    <div class="modal-content" >
    <div class="modal-body"> 
      <div class="row border_row">
            <div class="col-sm-12">
              <div  style="background-color: white;border-radius: 6px;color: #a01d26;font-size: 20px;font-weight: bold;padding-top:50px;padding-bottom: 50px" align="center">
                <span class="red">Please Wait...</span><br>
                <img align="top" alt="loading.. Please wait.." src="<?php echo base_url();?>public/images/load.gif" >
              </div>
           </div>
       </div>      
      </div>
    </div>
  </div>
</div>
    <!-- sctipts -->
 <script src="<?php echo base_url(); ?>public/js/vendor/parsley/parsley.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/lib/jquery-ui.custom.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>public/js/daterangepicker.js"></script>
<!--  Page Specific Scripts --> 
<script type="text/javascript">
$('#loadroomratesajax').modal({backdrop: 'static', keyboard: false});
$(window).load(function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();  
  var curr_date = d.getFullYear()+ '-'+(month<10 ? '0' : '')+ month+'-'+(day<10 ? '0' : '')+day;
jsonObj=[];
  $('#calendar').fullCalendar({
      header: {
          left: 'prev',
          center: 'title',
          right: 'next'
      },    
      defaultDate: curr_date,
      navLinks: true,
      editable: false,
      droppable: false,
      defaultView:'month',    
      eventLimit: true, 
      events: jsonObj,
      eventRender: function( event, element, view ) {
        var title = element.find('.fc-title, .fc-list-item-title');          
        title.html(title.text());
        },
      allDayText: 'Excursion Rate Details'
 
  });
$('#calendar').fullCalendar('option', 'aspectRatio', .5);
loadroomrates();
$('.fc-button').click(function(){
  loadroomrates();
});

   $('.changecal').click(function(){
          $dur_val=$(this).attr('data-dur-vlaue');  
          if($dur_val=='today'){
            $('#calendar').fullCalendar($dur_val);  
          }
          else
          {
            $('#calendar').fullCalendar( 'changeView',$dur_val);
            // safari fix
            $('#content .main').fadeOut(0, function() {
              setTimeout( function() {
                $('#content .main').css({'display':'table'});
              }, 0);
            });
          }
          loadroomrates();
        });


    function loadroomrates($t='')
    {
      $("input[name='from_date']").val('');
      $("input[name='to_date']").val('');       
       
         if($t=='')
         { 
          $t = $("#external-events").find('li.active');
        }
        else
        {
         $("#external-events li").removeClass('active');
         $t.addClass('active');
       }
       $excursions_rate_types_id=$t.attr('data-excursion-id');
       $excursions_code=$t.attr('data-hotel-code');
       if($t==''){
         var g=new Date();
         $getmonth = g.getMonth()+1;
       }  else {     
        var gt=$("#calendar").fullCalendar('getDate');      
        var g=new Date(gt.format())
        $getmonth = g.getMonth()+1;      
       }  
       $getyear = g.getFullYear();
       $.ajax({
        url: siteUrl + 'excursions/get_available_rates',
        data: 'excursions_rate_types_id='+$excursions_rate_types_id+'&excursions_code='+$excursions_code+'&month='+$getmonth+'&year='+$getyear,
        dataType: 'json',
        type: 'POST',
        beforeSend: function(){
          $('#loadroomratesajax').modal('show'); 
         },
        success: function(data)
        {
          var res=data.result; 
          var res1=data.result1;          
           jsonObj1 = []; 
           var len=res.length;    
          for ($i=0;$i<len;$i++) {  
          item = {}
          item["title"] = ""+res[$i];     
          item["start"] = ""+res1[$i];
          // item["className"] = 'b-l b-2x b-greensea';
          jsonObj1.push(item);
          } 
          // console.log(jsonObj1);
        $('#calendar').fullCalendar('month'); 
        $('#calendar').fullCalendar("removeEvents");        
        $('#calendar').fullCalendar('addEventSource', jsonObj1);      
        $('#calendar').fullCalendar('refetchEvents');
        $('#loadroomratesajax').modal('hide');        
        }             
      });
      }
      $("#external-events li").click(function(){
        $t=$(this);
        loadroomrates($t);   
      });
});
</script>
<script type="text/javascript"> 
$(function() {  
  $('.selectdate').daterangepicker({  
    autoUpdateInput: false,
    showDropdowns: true,  
    daysOfWeek: [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
     monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],  
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

  $('.selectdate').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="from_date"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="to_date"]').val(picker.endDate.format('DD-MM-YYYY'));
  });

  $('.selectdate').on('cancel.daterangepicker', function(ev, picker) {
       $('input[name="from_date"]').val('');
      $('input[name="to_date"]').val('');
  });
});
</script> 
<script type="text/javascript">
$('#show_calender').on('click', function()
{
       $t = $("#external-events").find('li.active');      
       $excursions_rate_types_id=$t.attr('data-excursion-id');
       $excursions_code=$t.attr('data-hotel-code');
       $from_date=$("input[name='from_date']").val();
       $to_date=$("input[name='to_date']").val();       
       

 var form = $('form'); 
 form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      }
      else
      {
        $.ajax({
                    url: siteUrl + 'excursions/get_excursion_rate_monthcalender',
                    data: 'excursions_rate_types_id='+$excursions_rate_types_id+'&excursions_code='+$excursions_code+'&from_date='+$from_date+'&to_date='+$to_date,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function(){
                          $('#loadroomratesajax').modal('show'); 
                     },                 
                    success: function(data)
                    {               
                      var res=data.result; 
                      var res1=data.result1;          
                       jsonObj1 = []; 
                       var len=res.length;    
                      for ($i=0;$i<len;$i++) {  
                      item = {}
                      item["title"] = ""+res[$i];     
                      item["start"] = ""+res1[$i];
                      // item["className"] = 'b-l b-2x b-greensea';
                      jsonObj1.push(item);
                      }                      
                      $('#calendar').fullCalendar('gotoDate', data.startdate);
                      $('#calendar').fullCalendar('month');
                      $('#calendar').fullCalendar("removeEvents");        
                      $('#calendar').fullCalendar('addEventSource', jsonObj1);      
                      $('#calendar').fullCalendar('refetchEvents');  
                      $('#loadroomratesajax').modal('hide'); 
                     
                    } 
               });  
      }
 
     
});
</script>
<!--/ Page Specific Scripts -->

<script type="text/javascript">
  $('.printBtn').on('click', function (){
    window.print();
  });
</script>
<!--/ Page Specific Scripts -->
<style type="text/css">
  @media print {
  .visible-print  { display: inherit !important; }
  .hidden-print   { display: none !important; }
}
/*.fc-title{ 
  font-size: 10px;
}*/
.fc-day-grid-event .fc-content {
    white-space: pre-line;
    overflow: hidden;
}
</style>