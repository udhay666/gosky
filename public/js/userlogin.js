function googleLogin(url, title, w, h) {
  var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
  var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
  width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
  height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
  var left = ((width / 2) - (w / 2)) + dualScreenLeft;
  var top = ((height / 2) - (h / 2)) + dualScreenTop;
  var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
  if (window.focus) {
    newWindow.focus();
  }
}

function facebookLogin() {
  FB.login(function(response) {
    statusChangeCallback(response);  
  }, {
    scope: 'email,user_photos', 
    return_scopes: true
  });   
}

window.fbAsyncInit = function() {
    FB.init({   
      appId       :'856801588088011',
      cookie     : true, 
      xfbml      : true,  
      version    : 'v3.0' 
     });
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response) {
  if (response.authResponse) {
    FB.api('/me?fields=id,name,email,first_name,middle_name,last_name,gender', function(response) {
      var $name = response.name ;
      var $email = response.email;
      var $first_name = response.first_name;
      var $middle_name = response.middle_name;
      var $last_name = response.last_name;
      var $gender = response.gender;
      // var $picture = JSON.stringify(response.picture);
      $.post(siteUrl+'fblogin/login', { 
        name: ""+$name , email: ""+$email, first_name: ""+$first_name, middle_name: ""+$middle_name, last_name: ""+$last_name, gender: ""+$gender
      },
      function(data){ 
        // var $currentUrl = location.href;
        window.location.href=siteUrl;        
      }, 'json');
    });   
  } 
}
 
$('#userlogin_id').click( function(){
  $email=$('#sign_user_email').val();
  $pass=$('#sign_user_password').val();
  if($('#sign_user_email').val()=='') {
    $('#sign_user_email').attr("placeholder", "Enter Your Email Address");
  } else if(!isEmail($('#sign_user_email').val())) {
    $('#sign_user_email').val('');
    $('#sign_user_email').attr("placeholder", "Enter Valid Email Address");
  } if($('#sign_user_password').val()=='') {
    $('#sign_user_password').attr("placeholder", "Enter Password");
  }
  $.ajax({
    url: siteUrl + 'b2c/checklogin',
    data: '&email='+$email+'&pass='+$pass,
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      $('#email_userlogin').html('');
      $('#pass_userlogin').html('');
      // $('.logininpval').html(data.results);
      $('#sign_user_email').val('');
      if(data.stat == 'success') {
        $('#modalLoginIntinerary').modal('hide');
        location.reload();

        /*var loginBox = $('#login-box');
        loginBox.find('input[name="user_email"]').val(data.user_email);
        loginBox.find('input[name="user_mobile"]').val(data.user_mobile);
        loginBox.find('input[name="user_city"]').val(data.user_city);
        loginBox.find('input[name="user_pincode"]').val(data.user_pincode);
        loginBox.find('textarea[name="address"]').html(data.address);
        $('#itinerary-login').hide();
        $('#modalLoginIntinerary').modal('hide');*/
        // window.location.href=siteUrl;
      } else {
        $('#email_userlogin').html('Either Email Addressor Password is Incorrect');
        $('#sign_user_email').attr("placeholder", "Enter The Email Address");
        $('#sign_user_password').val('');
        $('#sign_user_password').attr("placeholder", "Password");
      }
    }
  });
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$('#sendOtp').click( function(){
  var _form = $('.form-sendotp');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2c/sendOtp',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      _form.find('.show-message').html(data.meassage);
      if(data.status == 'success') {
        $('#modalOTPUser').modal('hide');
        $('#modalOTPUserLogin').modal('show');
        $('#otp_user').val(data.otp_user);
        _form.find('.show-message').html('');
        _form.find('input[name="otp_number"]').val('');
        // location.reload();
      } else {
      }
    }
  });
});

$('#submitUserOtp').click( function(){
  var _form = $('.form-otpsignin');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2c/otpLogin',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      _form.find('.show-message').html(data.meassage);
      if(data.status == 'success') {
        _form.find('.show-message').html('');
        _form.find('input[name="otp_number"]').val('');
        location.reload();
      } else {
      }
    }
  });
});

$('#forgot_password').click( function(){
  // alert('abcd');
  var _form = $('.forgot_password');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2c/forgot_password',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      messagehtml.html(data.message);
      if(data.status == 'success') {
        // alert('abcd');
       // $('#modalForgotpassword').modal('hide');
        $('#modalForgotpassword').hide();
        $('#modalOTPUserforgotPassword').modal('show');
        $('#otp_user2').val(data.otp_user);
        // location.reload();
      } else {

      }
    }
  });
});

$('#validate_otp').click( function(){
  var _form = $('.form-changepwd');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2c/change_otp_password',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      _form.find('.show-message').html(data.message);
      if(data.status == 'success') {
        // $('#modalOTPUserforgotPassword').modal('hide');
        $('#modalOTPUserforgotPassword').hide();
        $('#modalChangePassword').modal('show');
        $('#otp_user3').val(data.otp_user);
      } else {
      }
    }
  });
});

$('#update_password').click( function(){
  var _form = $('.form-updateped');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2c/restore_password',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      _form.find('.show-message').html(data.message);
      if(data.status == 'success') {
        $('#modalChangePassword').hide();
        $('#login').modal('show');
        // $('#otp_user3').val(data.otp_user);
      } else {
      }
    }
  });
});



// Agent part

$('#b2bsendOtp').click( function(){
  var _form = $('.form-b2botp');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
   // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2b/b2bsendotp',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      messagehtml.html(data.message);
      if(data.status == 'success') {
         $('#modalOTPb2b').modal('hide');
         $('#modalOTPAgentLogin').modal('show');
         $('#otp_b2b1').val(data.otp_b2b);
      } else {
      }
    }
  });
});

$('#validotp').click( function(){
  var _form = $('.form-b2bsignin');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
   // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2b/b2botpLogin',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      messagehtml.html(data.message);
      if(data.status == 'success') {
          $('#modalOTPAgentLogin').modal('hide');
         // $('#otp_b2b').val(data.otp_b2b);
         location.reload();
      } else {
      }
    }
  });
});

$('#forgot_password_agent').click( function(){
  // alert('abcd');
  var _form = $('.forgot_pas');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2b/forgot_password',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
       messagehtml.html(data.message);
      if(data.status == 'success') {
        $('#signupPage').hide();
        $('#modalOTPAgentforgotPassword').show();
        $('#otp_user').val(data.otp_b2b);
        // _form.find('.show-message').html(data.message);
      } else {
        // _form.find('.show-message').html(data.message);
      }
    }
  });
});

$('#validate_otp1').click( function(){
  // alert('ssd');
  var _form = $('.form-b2bchangepwd');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2b/change_otp_password',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      _form.find('.show-message').html(data.message);
      if(data.status == 'success') {
        $('#modalOTPAgentforgotPassword').hide();
        $('#modalChangePassword').show();
         $('#otp_b2b3').val(data.otp_user);
      } else {
      }
    }
  });
});

$('#update_password1').click( function(){
  var _form = $('.form-updateped1');
  var messagehtml = _form.find('.show-message');
  $('.show-message').html('');
  // console.log(_form);
  $.ajax({
    url: siteUrl + 'b2b/restore_password',
    data: _form.serialize(),
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      _form.find('.show-message').html(data.message);
      if(data.status == 'success') {
        $('#modalChangePassword').hide();
        $('#loginPage').modal('show');
        // $('#otp_user3').val(data.otp_user);
      } else {
      }
    }
  });
});