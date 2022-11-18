function statusChangeCallback(response) {
     if (response.authResponse) {
    FB.api('/me?fields=id,name,email,first_name,middle_name,last_name,gender,picture', function(response) {
               $name=response.name ;
               $email=response.email;
               $first_name=response.first_name;
               $middle_name=response.middle_name;
               $last_name=response.last_name;
               $gender=response.gender;
               $picture=JSON.stringify(response.picture);
               $.post(siteUrl+'Fblogin/login',
               { 
               name: ""+$name , email: ""+$email, first_name: ""+$first_name, middle_name: ""+$middle_name, last_name: ""+$last_name, gender: ""+$gender, picture: ""+$picture

              },
               function(data){                               
                        window.location =siteUrl;                       
                    }, 'json');

    });   
    } else {
     alert('User cancelled login or did not fully authorize.');
    }
    }
function checkLoginState()
{
FB.login(function(response) {
statusChangeCallback(response);  
}, {
    scope: 'email,user_photos', 
    return_scopes: true
});   
}
 window.fbAsyncInit = function() {
  FB.init({
    appId      : '214079779048644',
    cookie     : true, 
    xfbml      : true,  
    version    : 'v2.8' 
  });
  };
   (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function hidemodalLogin()
  {
    $('#modalLogin').modal('hide');
  }