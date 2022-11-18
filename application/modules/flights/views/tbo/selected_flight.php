<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<?php if (!empty($result)) { ?>
<?php

$operating_airlinecode = explode(',', $result->operating_airlinecode);
$operating_airlinename = explode(',', $result->operating_airlinename);
$operating_flightno = explode(',', $result->operating_flightno);
$operating_airportname_o = explode(',', $result->operating_airportname_o);
$operating_fareclass = $result->operating_fareclass;
$operating_deptime = explode(',', $result->operating_deptime);
$operating_deptime = explode(',', $result->operating_deptime);
$deptime = explode('T', $operating_deptime[0]);
$deptime['1']=substr($deptime['1'], 0, -3);
$operating_arritime = explode(',', $result->operating_arritime);
$arrtime = explode('T', $operating_arritime[0]);
$arrtime['1']=substr($arrtime['1'], 0, -3);
$operating_cityname_o = explode(',', $result->operating_cityname_o);
$operating_cityname_d = explode(',', $result->operating_cityname_d);
$operating_terminal_o = explode(',', $result->operating_terminal_o);
$operating_terminal_d = explode(',', $result->operating_terminal_d);
$nonrefundable = $result->nonrefundable;
$baggageinformation = $result->baggageinformation;
    //$duration = $dura = $result->duration;
    //$duration = explode(",",$duration);
    //$duration = $duration[0] * 60 + $duration[1]; 
$durationd =floor($result->duration / 60).'h:'.($result->duration -   floor($result->duration / 60) * 60).'m';
$duration=  $result->duration;      
$origin = $result->origin;
    //$stops = $result->stops;
$stops = (count($operating_flightno)-1);
$destination = $result->destination;
$search_id = $result->search_id;
$segmentkey = $result->segmentkey;
$basefare = $result->basefare;
$tax = $result->tax+$result->admin_markup+$result->agent_markup+$result->payment_charge;
$total_amount = $result->total_amount;
$currency = $result->currency;
if($result->roundtrip=='1'){
$searchIdn='searchId';
$segmentkeyn='segmentkey';
$url='url';
}else{
$searchIdn='searchId1';
$segmentkeyn='segmentkey1';
$url='url1';
} 

?>
<div class="FlightInfoBox" style="box-shadow: none;">
<input type="hidden" name="<?php echo $searchIdn; ?>" value="<?php echo $search_id; ?>" />
    <input type="hidden" name="<?php echo $segmentkeyn; ?>" value="<?php echo $segmentkey; ?>" />
    <input type="hidden" name="<?php echo $url; ?>" value="<?= base64_encode('tbo/'.$search_id.'/'.$segmentkey) ?>" />
<div class="fd_img_fx">
            <img src="<?php echo base_url() . 'public/AirlineLogo/' .$operating_airlinecode[0]; ?>.gif" alt="flight logo">        <p><?php echo $operating_airlinename[0]; ?></p>
        </div>
        <span class="fd_clr"><?php echo $deptime[1]; ?></span>
        <span class="fd_clr"><?php echo $arrtime[1]; ?></span>
    <div class="fd_time_desc">
        <span class="timer_fx"><i class="material-icons"></i><p><?php echo $durationd; ?></p></span>
        <p class="grey_clr"><?php echo $stops; ?> Stop</p>
    </div>
    <span class="fd_price"> &#8377; <?php echo number_format($total_amount); ?></span>
</div>
<?php } ?>