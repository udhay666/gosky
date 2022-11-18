<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);


//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
// echo '<pre/>123';print_r($_POST);exit;
    if($_POST['service_type'] == 2){
        // echo 1;exit;
        $_SESSION['searchId'] = $_POST['searchId'];
        $_SESSION['callBackId'] = $_POST['callBackId'];
        $_SESSION['segmentkey'] = $_POST['segmentkey'];
        $_SESSION['searchId1'] = $_POST['searchId1'];
        $_SESSION['segmentkey1'] = $_POST['segmentkey1'];
        $_SESSION['email'] = $_POST['user_email'];
        $_SESSION['amount'] = $_POST['total_cost'];        
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
    } elseif($_POST['service_type'] == 5){
      
        $_SESSION['sessionId'] = $_POST['sessionId'];
        $_SESSION['callBackId'] = $_POST['callBackId'];
        $_SESSION['searchId'] = $_POST['searchId'];
        $_SESSION['searchId1'] = $_POST['searchId1'];
        $_SESSION['segmentkey1'] = $_POST['segmentkey1'];
        $_SESSION['traceId'] = $_POST['traceId'];
        $_SESSION['routeId'] = $_POST['routeId'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['amount'] = $_POST['seat_price'];
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

    } elseif($_POST['service_type'] == 3){
      
        $_SESSION['sessionId'] = $_POST['sessionId'];
        $_SESSION['callBackId'] = $_POST['callBackId'];
        $_SESSION['searchId'] = $_POST['searchId'];
        $_SESSION['UniqueRefNo'] = $_POST['UniqueRefNo'];        
        $_SESSION['traceId'] = $_POST['traceId'];
        $_SESSION['routeId'] = $_POST['routeId'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone']; 
        $_SESSION['amount'] = $_POST['amount'];       
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

    }elseif($_POST['service_type'] == 1){
      
        $_SESSION['sessionId'] = $_POST['sessionId'];
        $_SESSION['callBackId'] = $_POST['callBackId'];
        $_SESSION['searchId'] = $_POST['searchId']; 
        $_SESSION['hotelCode'] = $_POST['hotelCode']; 
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone']; 
        $_SESSION['amount'] = $_POST['amount'];       
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

    }elseif($_POST['service_type'] == 4){
      
        $_SESSION['sessionId'] = $_POST['sessionId'];
        $_SESSION['callBackId'] = $_POST['callBackId'];
        $_SESSION['searchId'] = $_POST['searchId'];         
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone']; 
        $_SESSION['amount'] = $_POST['amount'];       
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

    }elseif($_POST['service_type'] == 7){
      
        
        $_SESSION['callBackId'] = $_POST['callBackId'];
        $_SESSION['searchId'] = $_POST['searchId'];         
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone']; 
        $_SESSION['amount'] = $_POST['amount']; 
        $_SESSION['UniqueRefNo'] = $_POST['UniqueRefNo'];       
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

    }elseif($_POST['service_type'] == 8){
      
        
        $_SESSION['pay_amount'] = $_POST['pay_amount'];
        $_SESSION['total_amount'] = $_POST['total_amount'];         
        $_SESSION['remarks'] = $_POST['remarks'];              
        $_SESSION['service_type'] = $_POST['service_type'];
        $amount = $_SESSION['total_amount'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

    }
    
/*$cost = $_SESSION['amount'];
print $cost;
$returnValue = round($cost, 0);
print $returnValue;exit;*/


$orderData = [
    'receipt'         => 3456,
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);
//print_r($razorpayOrder);exit;
$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
   // "name"              => "DJ Tiesto",
    //"description"       => "Tron Legacy",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => "Daft Punk",
    "email"             => $email,
    "contact"           => $phone,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
require("checkout/{$checkout}.php");
?>

<!-- <body onload="call()">
<form method="POST" name="payment_sub" action="https://api.razorpay.com/v1/checkout/embedded">
<input type="hidden" name=key_id value="rzp_test_eXaooHf3fGska3">
<input type="hidden" name="order_id" value="<?php echo $razorpayOrderId ; ?>">
<input type="hidden" name="amount" value="<?php echo $amount; ?> in paisa">
<input type="hidden" name="name" value="HDFC VAS">
<input type="hidden" name="description" value="Testin Hdfc">
<input type="hidden" name="prefill[email]"
value="<?php echo $email;?>">
<input type="hidden" name="prefill[contact]" value="<?php echo $phone ?>">
<input type="hidden" name="notes[transaction_id]" value="transaction_1234">
<input type="hidden" name="callback_url" value="http://tpdtechnosoft.com/TPD_Projects/satvtoday/razorpay/verify.php">
<button style="display: none;">Submit</button>
</form>
<script type="text/javascript">
    function call() {
       document.payment_sub.submit();
    }
</script>
Custom loader for results
<div class="loader" style="display:block;"><span>Payment in Progress ...</span></div>
</body>
</html> -->
