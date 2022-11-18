<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php $this->load->view('home/home_template/header'); ?>

<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script>
function coderHakan() {
  var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
  sayfa.document.open("text/html");
  sayfa.document.write(document.getElementById('printArea').innerHTML);
  //sayfa.document.close();
  sayfa.print();
  //sayfa.close();
}
</script>
<script type = "text/javascript" >
function changeHashOnLoad() {
    window.location.href += "#";
    setTimeout("changeHashAgain()", "50");
}

function changeHashAgain() {
    window.location.href += "1";
}

var storedHash = window.location.hash;
window.setInterval(function () {
    if (window.location.hash != storedHash) {
        window.location.hash = storedHash;
    }
}, 50);
</script>
<style>
  .mt-5{
    margin-top:10px;
  }
  .printArea{
    margin-top:115px;
  }
  .voucher_logo{
    margin-bottom:10px;
  }
  .content_header{
    margin-left:-15px;
  }
</style>
 <?php 
          $websitename='Travelfreebuy';
          $companyname='Travelfreebuy';
          ?>
          <div id="printArea">
	<div class="container bg-light">
		<div class="col-md-12">
				<div class="d-flex pb-3" style="border-bottom: solid; border-color:red;">
					<div class="voucher_logo">
						<img src="<?php echo base_url('assets/images/logo.png');?>" width=200>
						<span class="ml-5">-TICKET Confirmed</span>
					</div>
					<div style="margin-left:500px">
						<span>Booking Id: <?php echo $booking_info->uniqueRefNo; ?></span>
					</div>
				</div>

				<div class="d-flex">
					<div>
						<span>NAGPUR TO MUMBAI</span>
					</div>
					<div>
						<!--<img src="assets/images/group.jpg">-->
					</div>
				</div>

            <table class="bordertable ml-3" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    <thead>
                      <tr >
                        <th><img src="<?php echo base_url('assets2/images/pdf/indigo.png');?>"><br>
                            <span>IndiGo</span><br>
                            <span class="text-muted">6E-404</span><br>
						<span class="text-muted">ECONOMY</span>
                            </th>
                        <th><span class="text-muted">Nagpur</span><br>
						<h6>NAG 20:40</h6>
						<strong>SAT, 06 JUL '19</strong><br>
						<span>Dr.Babasaheb Ambedkar International Airport</span>
						</th>
                        <th>	<i class="fas fa-fighter-jet fa-2x" style="color:gray"></i><br>
						<span>1h 40m</span>
						</th>
                        <th><span class="text-muted">Mumbai</span><br>
						<h6>BOM 22:20</h6>
						<strong>SAT, 06 JUL '19</strong><br>
						<span>chatrapathi shivaji International Airport Terminal 1</span></th>
                      </tr>
                    </thead>
                  </table>
            
            
                <table class="bordertable mt-5 ml-3" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    <thead style=" border-bottom: solid 1px; border-color:red;">
                      <tr>
                        <th><p>PASSANGER NAME</p></th>
                        <th><p>PNR</p></th>
                        <th><p>E-TICKET NO.</p></th>
                        <th><p>SEAT</p></th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php for ($k = 0; $k < count($passenger_info); $k++) { ?>   
                    <td><p><?php echo $k+1; ?>. <?php echo strtoupper($passenger_info[$k]->title).' '.strtoupper($passenger_info[$k]->first_name) . ' ' . strtoupper($passenger_info[$k]->last_name); ?></p></td>
                    <?php } ?>
                    <td><span class="text-muted"><?php echo $booking_info->pnr; ?></span></td>
                    <td><span class="text-muted">CGZ3GZ</span></td>
                    </tbody>
                  </table>
        
				<!-- <div class="col-md-12">
					<img src="<?php echo base_url('assets2/images/pdf/tcpdf.png');?>" width=100%>
				</div> -->


<div class="col-md-12 mt-3 content_header" style="margin-top:10px; border-bottom: solid 1px; border-color:red;">
    <strong>BAGGAGE INFOMATION</strong>
</div>

<div class="col-md-12">
    <table class="bordertable ml-5" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    <thead>
                      <tr>
                        <th><p>Type</p></th>
                        <th><p>Sector</p></th>
                        <th><p>Check-in Baggage</p></th>
                        <th><p>Cabin Baggage</p></th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th><p>Adult</p></th>
                        <th><p>NAG-BOM</p></th>
                        <th><p>15 KG</p></th>
                        <th><p>7 KG</p></th>
                      </tr>
                      <tr>
                        <th><p>Adult</p></th>
                        <th><p>NAG-BOM</p></th>
                        <th><p>15 KG</p></th>
                        <th><p>7 KG</p></th>
                      </tr>
                    </tbody>
                  </table>
</div>



<div class="col-md-12 p-2 mt-5" style="background-color:rgb(211,211,211)">
	<span class="ml-5">Tips for a hassle-free travel experience</span>
</div>


            <table class="bordertable" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse:collapse;">
                    <thead>
                      <tr>
                        <th ><img class="ml-5" src="<?php echo base_url('assets2/images/pdf/desktop.png');?>" width="30"><br>
                		<strong>Free mandatory web check-in</strong><br>
                		<span>
                			check-in online for free 48 hr to 60 min before free of 100/- for airport check-in with assistance
                		</span></th>
                        <th><img class="ml-5 mt-2" src="<?php echo base_url('assets2/images/pdf/rollingman.png');?>" width="20"><br>
                		<strong>120min before departure</strong><br>
                		<span>Reach the Airport to allow yourself sufficient time for necessary procedures.</span>
                		</th>
                        <th><i class="fas fa-ticket-alt fa-lg ml-5 mt-2"></i><br>
                		<strong>60 min before departure</strong><br>
                		<span>Drop your bags and proceed for boarding.</span>
                		</th>
                        <th> <i class="fas fa-hotel fa-lg ml-5 mt-2"></i><br>
                		<strong>25 min before departure</strong><br>
                		<span>Boarding gate closes.</span>
                		</th>
                      </tr>
                    </thead>
                  </table>
		
	
			<div class="col-md-12 mt-5 content_header" style="border-bottom: solid 1px; border-color:red;">
			<strong>IMPORTANT INFORMATION</strong>
		</div>
		<div class="justify-content-center">
			<div>
				<ul>
					<li>For any queries or communication with Travelfreebuy regarding this booking please use the 
					Booking ID as a reference.</li>
					<li>Please note that all domastic flights, check-in counters close 60 minutes prior to flight departure</li>
					<li>It is mandatory for the passanger to carry a valid photo ID proof in order to enter the airpport 
					and show at the time of check-in. Permissible ID proofs include - Aadhaar Card, Passport or 
				any other governament recognized ID proof. For infant travellers (0-2 yrs),
			it is mandatory to carry the birth certificate as a proof.</li>
			<li>Kindly carry a coppy of your e-ticket on a tablet/mobile/laptop or printed copy of the ticket to enter the 
			airport and show at the time of check-in.</li>
				</ul>
			</div>
			<div>
				<!--<img src="assets/images/logo.jpg">-->
			</div>
		</div>

		<div class="col-md-12 mt-5 content_header" style="border-bottom: solid 1px; border-color:red;">
			<strong>CANCELLATION & DATE CHANGE CHARGES</strong>
		</div>
		<ul class="mb-5">
			<li>To initiate booking cancellation, please log in to the Travelfreebuy Flights app and visit the ‘My Trips’ section</li>
			<li>Please note that in case of booking cancellation both the airline and Travelfreebuy will charge a cancellation fee</li>
			<li>The airline cancellation 
fee may vary depending on the duration before flight departure. Travelfreebuy will charge a cancellation fee of Rs.300 per passenger, per 
flight/sector.</li>
<li>A booking can be cancelled on Travelfreebuy, up to 5 hours prior to flight departure. If you want to cancel your flight within 3 
hours of its departure time, kindly contact the airline partner directly.</li>
<li>Travelfreebuy will receive any refund claims arising due to cancellation or delay of the flight due to the airline. In the event that the airline 
does not refund the amount to Travelfreebuy, we shall not be held liable.</li>
<li>When a cancellation is made in case of a layover flight or a connecting flight booking, all the flight bookings (for that journey) will be 
cancelled, i.e no partial cancellation will be allowed. Also, flights booked under a single PNR (in case of cancellation), will be cancelled 
together</li>
<li>In case of booking cancellation, the refund (if applicable) will be refunded to your bank account or the original mode of payment within 5 
working days.</li>
<li>If the flight is cancelled or in case of a ‘No Show’, please initiate your refund request via Travelfreebuy.</li>
		</ul>

		<div class="col-md-12 mt-5 content_header" style="border-bottom: solid 1px; border-color:red;">
			<strong>PAYMENT DETAILS</strong>
		</div>
		<table class="table table-borderless mb-5">
  <thead>
    <tr>
      <td scope="col" class="text-muted">Fare Type</td>
      <th scope="col" class="text-success">partially refundable</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row" class="text-muted">Base Fare</td>
      <td>5200</td>
     
    </tr>
    <tr>
      <th scope="row" class="text-muted">Taxes & Fees</th>
      <td>1831</td>
     
    </tr>
    <tr>
      <th scope="row" class="text-muted">Convenience Fee</th>
      <td>450</td>
    </tr>
    <tr style="border-bottom: solid 1px; border-color:gray;">
    	<td><strong>Total Amount</strong></td>
    	<td> <strong>7481</strong></td>
    </tr>
  </tbody>
</table>
<div class="col-md-12" style="border-bottom: solid 1px; border-color:red;"></div>
<div class="justify-content-center">
	<div>
		<b>CUSTOMER SUPPORT</b><br>
		<span>Travelfreebuy Support</span><br>
		<span><a href="">flight@travelfreebuy.com</a></span><br>
		<span>+91 124 6682160</span>
	</div>
	<!-- <div>
		<span>Airline Support</span><br>
		<span>+919910383838</span>
	</div> -->
</div>
		<div class="col-md-12 text-center pb-3">
		   <a class="btn btn-warning" style="margin-bottom:10px;" id="print" onclick="coderHakan();return false;" href="JavaScript:void(0);"><b>Print</b></a>
		</div>
		</div>
	</div>
	</div>
	<?php $this->load->view('home/home_template/footer'); ?>
