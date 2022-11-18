<?php

require('config.php');

session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
// echo 12345;exit;
// print_r($_SESSION);
// print_r($_POST);exit;
$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
             $payid = $_POST['razorpay_payment_id'];
    if($_SESSION['service_type'] == 2){    
        $searchId = isset($_SESSION['searchId']) ? $_SESSION['searchId'] :0;
        $callBackId = isset($_SESSION['callBackId']) ? $_SESSION['callBackId'] :0;
        $segmentkey = isset($_SESSION['segmentkey']) ? $_SESSION['segmentkey'] :0 ;
        $searchId1 = isset($_SESSION['searchId1']) ? $_SESSION['searchId1'] :0;
        $segmentkey1 = isset($_SESSION['segmentkey1']) ? $_SESSION['segmentkey1'] :0 ;
        $orderid =   $_SESSION['razorpay_order_id'];
        $service_type = $_SESSION['service_type'];
        $query = array(
            'searchId' =>  $searchId, 
            'callBackId' => $callBackId,
            'segmentkey' => $segmentkey,
            'searchId1' => $searchId1,
            'segmentkey1' => $segmentkey1,
            'orderid' => $orderid,
            'service_type' => $service_type,
            );

        $query = http_build_query($query);
        // header("Location:http://tpdtechnosoft.com/TPD_Projects/sarvtoday/flights/payment_process?$query");
        header("Location:http://localhost/travelfreebuy.com/flights/payment_process?$query");
    } elseif($_SESSION['service_type'] == 5){
        $searchId = isset($_SESSION['searchId']) ? $_SESSION['searchId'] :0;
        $sessionId = isset($_SESSION['sessionId']) ? $_SESSION['sessionId'] :0;
        $callBackId = isset($_SESSION['callBackId']) ? $_SESSION['callBackId'] : 0;
        $traceId = isset($_SESSION['traceId']) ? $_SESSION['traceId'] :0;
        $routeId = isset($_SESSION['routeId']) ? $_SESSION['routeId'] :0 ;    
        $orderid = $_SESSION['razorpay_order_id'];
        $service_type = $_SESSION['service_type'];
        $query = array(
            'searchId' =>  $searchId, 
            'callBackId' => $callBackId,
            'sessionId' => $sessionId,
            'traceId' => $traceId,
            'routeId' => $routeId,
            'orderid' => $orderid,
            'service_type' => $service_type,
            );

        $query = http_build_query($query);
        header("Location:http://localhost/travelfreebuy.com/bus/bus_book?$query");
    }elseif($_SESSION['service_type'] == 1){
        $searchId = isset($_SESSION['searchId']) ? $_SESSION['searchId'] :0;
        $sessionId = isset($_SESSION['sessionId']) ? $_SESSION['sessionId'] :0;
        $callBackId = isset($_SESSION['callBackId']) ? $_SESSION['callBackId'] : 0;
        $hotelCode = isset($_SESSION['hotelCode']) ? $_SESSION['hotelCode'] : 0;  
        $orderid = $_SESSION['razorpay_order_id'];
        $service_type = $_SESSION['service_type'];
        $query = array(
            'searchId' =>  $searchId, 
            'callBackId' => $callBackId,
            'sessionId' => $sessionId,
            'hotelCode' => $hotelCode,
            'orderid' => $orderid,
            'service_type' => $service_type,
            );

        $query = http_build_query($query);
        header("Location:http://localhost/travelfreebuy.com/hotels/reservation?$query");
    }elseif($_SESSION['service_type'] == 8){
        $pay_amount = isset($_SESSION['pay_amount']) ? $_SESSION['pay_amount'] :0;
        $total_amount = isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] :0;
        $remarks = isset($_SESSION['remarks']) ? $_SESSION['remarks'] : 0;         
        $orderid = $_SESSION['razorpay_order_id'];
        $service_type = $_SESSION['service_type'];
        $query = array(
            'pay_amount' =>  $pay_amount, 
            'total_amount' => $total_amount,
            'remarks' => $remarks,
            'orderid' => $orderid,
            'service_type' => $service_type,
            );

        $query = http_build_query($query);
        header("Location:http://localhost/travelfreebuy.com/b2b/payment_process?$query");
    }      
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
              $payid = $error;
}

// echo $html;
// print_r($_POST);exit;
// 
// if($_SESSION['service_type'] == 2){    
//     $searchId = isset($_SESSION['searchId']) ? $_SESSION['searchId'] :0;
//     $callBackId = isset($_SESSION['callBackId']) ? $_SESSION['callBackId'] :0;
//     $segmentkey = isset($_SESSION['segmentkey']) ? $_SESSION['segmentkey'] :0 ;
//     $searchId1 = isset($_SESSION['searchId1']) ? $_SESSION['searchId1'] :0;
//     $segmentkey1 = isset($_SESSION['segmentkey1']) ? $_SESSION['segmentkey1'] :0 ;
//     $orderid =   $_SESSION['razorpay_order_id'];
//     $service_type = $_SESSION['service_type'];
//     $page  = "http://tpdtechnosoft.com/TPD_Projects/Etrippo/flights/payment_process";
// } elseif($_SESSION['service_type'] == 5){
//     $searchId = isset($_SESSION['searchId']) ? $_SESSION['searchId'] :0;
//     $sessionId = isset($_SESSION['sessionId']) ? $_SESSION['sessionId'] :0;
//     $callBackId = isset($_SESSION['callBackId']) ? $_SESSION['callBackId'] : 0;
//     $traceId = isset($_SESSION['traceId']) ? $_SESSION['traceId'] :0;
//     $routeId = isset($_SESSION['routeId']) ? $_SESSION['routeId'] :0 ;    
//     $orderid = $_SESSION['razorpay_order_id'];
//     $service_type = $_SESSION['service_type'];
//     $page  = "http://tpdtechnosoft.com/TPD_Projects/Etrippo/bus/bus_book";
// }elseif($_SESSION['service_type'] == 1){
//     $searchId = isset($_SESSION['searchId']) ? $_SESSION['searchId'] :0;
//     $sessionId = isset($_SESSION['sessionId']) ? $_SESSION['sessionId'] :0;
//     $callBackId = isset($_SESSION['callBackId']) ? $_SESSION['callBackId'] : 0;
//     $hotelCode = isset($_SESSION['hotelCode']) ? $_SESSION['hotelCode'] : 0;  
//     $orderid = $_SESSION['razorpay_order_id'];
//     $service_type = $_SESSION['service_type'];
//     $page  = "http://tpdtechnosoft.com/TPD_Projects/Etrippo/hotels/reservation";
// }
?>
<!-- <body onload="call_pay()">
<form method="POST" name="payment_verfiy" action="<?php echo $page?>">
<input type="hidden" name="payid" value="<?php echo $payid?>">
<input type="hidden" name="searchId" value="<?php echo $searchId?>">
<input type="hidden" name="callBackId" value="<?php echo $callBackId?>">
<input type="hidden" name="segmentkey" value="<?php echo $segmentkey?>">
<input type="hidden" name="searchId1" value="<?php echo $searchId1?>">
<input type="hidden" name="segmentkey1" value="<?php echo $segmentkey1?>">
<input type="hidden" name="orderid" value="<?php echo $orderid?>">
<input type="hidden" name="UniqueRefNo" value="<?php echo $UniqueRefNo?>">
<input type="hidden" name="sessionId" value="<?php echo $sessionId?>">
<input type="hidden" name="hotelCode" value="<?php echo $hotelCode?>">
<input type="hidden" name="traceId" value="<?php echo $traceId?>">
<input type="hidden" name="routeId" value="<?php echo $routeId?>">
<input type="hidden" name="orderid" value="<?php echo $orderid?>">
<input type="hidden" name="email" value="<?php echo $email?>">
<input type="hidden" name="phone" value="<?php echo $phone?>">
<input type="hidden" name="amount" value="<?php echo $amount?>">


<button style="display: none;">Submit</button>
</form>
<script type="text/javascript">
    function call_pay(){
       document.payment_verfiy.submit();
    }
</script>
Custom loader for results
<div class="loader" style="display:block;"><span>Payment in Progress ...</span></div>
</body>
</html>
 -->