<?php
function moneyFormatIndia($num){
  $explrestunits = "" ;
  if(strlen($num)>3){
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    $expunit = str_split($restunits, 2);
    for($i=0; $i<sizeof($expunit); $i++){
      // creates each of the 2's group and adds a comma to the end
      if($i==0)
      {
        $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
      }else{
        $explrestunits .= $expunit[$i].",";
      }
    }
    $thecash = $explrestunits.$lastthree;
  } else {
    $thecash = $num;
  }
  return $thecash; // writes the final format where $currency is the currency symbol.
}
?>
<div class="contentpanel">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
              <h5 class="subtitle mb5">B2C Holiday Bookings</h5>
              <table class="table noborder">
                <tbody>
                  <tr>
                    <td><h5 class="mb5">Duration</h5></td>
                    <td><h5 class="mb5 pull-right">No. of Booking</h5></td>
                  </tr>
                  <tr>
                    <td><h6 class="mb5">Today</h6></td>
                    
                    <td><h6 class="mb5">
                    <?php if($today!=""){ ?>
                      <span class="label <?php if(count($today)==0){echo "label-danger";}else{ echo "label-success";}?> pull-right"><?php echo count($today);?></span>
                    <?php  } ?>
                    </h6></td>
                  </tr>
                  <tr>
                    <td><h6 class="mb5">Last 7 days</h6></td>
                    <td><h6 class="mb5">
                    <?php if($lastsevendays!=""){ ?>
                      <span class="label <?php if(count($lastsevendays)==0){echo "label-danger";}else{ echo "label-success";}?> pull-right"><?php echo count($lastsevendays);?></span>
                    <?php } ?></h6></td>
                  </tr>
                  <tr>
                    <td><h6 class="mb5">Last 30 days</h6></td>
                    <td><h6 class="mb5">
                    <?php if($lastthirtydays!=""){ ?>
                    <span class="label <?php if(count($lastthirtydays)==0){echo "label-danger";}else{ echo "label-success";}?> pull-right"><?php echo count($lastthirtydays);?></span>
                  <?php } ?>
                  </h6></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8 col-md-8 col-xs-12">
              <label class="col-sm-3 control-label">Select Date Range</label>
              <div class="col-sm-6">
                <input id="daterangepickerval" type="text" class="form-control" placeholder="Select Date Range" autocomplete= "off" data-date-format="YYYY/MM/DD" />
              </div>
              <div class="col-sm-3">
                <input type="button" class="btn btn-info" value="submit" onclick="changedaterangereport();">
              </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xs-12">
              <label class="col-sm-3 control-label">Duration</label>
              <div class="col-sm-9">
                <select id="duration" class="form-control" onchange="changereport();">
                  <optgroup label="Select Duration">
                    <option value="">Select</option>
                    <option value="1" selected>Today</option>
                    <option value="7">7 Days</option>
                    <option value="30">30 Days</option>
                    <option value="90">90 Days</option>
                    <option value="6M">6 months</option>
                    <option value="1y">1 Year</option>
                  </optgroup>
                </select>
              </div>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12" id="bookingsummary">
              <h5 class="subtitle mb5">B2C HOLIDAY BOOKINGS Account Summary</h5>
              <h5 class="mb5">Today Bookings : 
                <?php if($today!="") { ?>
                <span class="label <?php if(count($today)==0){echo "label-danger";}else{ echo "label-success";}?>"><?php echo count($today);?></span>
                    <?php  }?>
              </h5>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12" id="accountsummary_result">
              <span class="sublabel">Total Net Amount <span class="label label-success pull-right"><?php if($accountsummary!="") { echo ' <i class="fa fa-rupee"></i> '.moneyFormatIndia(round($accountsummary->net_total)); } ?></span></span>
              <div class="progress progress-sm" title="<?php if($accountsummary!="") { echo ' ₹ '.moneyFormatIndia(round($accountsummary->net_total)); } ?>">
                <div style="width: <?php  if($accountsummary!="") { if($accountsummary->net_total!="") { echo (100*($accountsummary->net_total))/($accountsummary->net_total); }  } ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>