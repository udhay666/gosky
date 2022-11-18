<?php
if(!session_id()) {
    session_start();
}
include_once 'Google_Client.php';
include_once 'contrib/Google_Oauth2Service.php';
$clientId = '435999080390-rceotipuf57kus5g27km7naukn2e7tlv.apps.googleusercontent.com'; 
$clientSecret = 'Olw78nYQREb-hGallc6h5vrJ'; 
$redirectURL = 'https://www.tpdtechnosoft.com/TPD_Projects/glidtrip/glogin/login'; 
$gClient = new Google_Client();
$gClient->setApplicationName('GlideTrip');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);
$google_oauthV2 = new Google_Oauth2Service($gClient);
$authUrl = $gClient->createAuthUrl();
?>
