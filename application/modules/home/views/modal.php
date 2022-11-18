<?php //defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>public/vendor/bootstrap/css/bootstrap.min.css"> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 12px;
  width: 33%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: black;
  display: none;
  padding: 100px 20px;
  height: 100%;
}

#Home {background-color: white;}
#News {background-color:  white;}
#Contact {background-color:  white;}

</style>
<div id="login-signup" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-sm-3">
      <div class="modal-body">

          <button class="tablink" onclick="openPage('Home', this, 'green')" id="defaultOpen">User Login</button>
          <button class="tablink" onclick="openPage('About', this, 'green')">User Register</button>
          <button class="tablink" onclick="openPage('News', this, 'green')" >Forgot Password</button>

          

              <div id="Home" class="tabcontent">
                 
                          <form class="form-signin"  name="validate_create_account" role="form" action="<?php echo site_url(); ?>b2c/user_login" data-parsley-validate  method="post">
                            <div class="form-group">
                              <label>Email / Mobile <span class="text-danger">*</span></label>
                              <p style="margin-top:-12px;" id="email_userlogin2"></p>
                              <input type="text" class="form-control form-group" name="user_email" data-parsley-trigger="change" id="sign_user_email2" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                              <label>Password <span class="text-danger">*</span></label>
                              <p style="margin-top:-12px;" id="pass_userlogin2"></p>
                              <input type="password" class="form-control" name="user_password" autocomplete="off" id="sign_user_password2" required>
                            </div>
                            <div class="row mb-4">
                              <!-- <div class="col-sm text-right"> <a class="justify-content-end" href="#">Forgot Password ?</a> </div> -->
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                          </form>


                          
                
              </div>

              <div id="News" class="tabcontent">
                

                         <form class="forgot_password_agent" action="<?php echo site_url(); ?>b2c/forgot_password" method="post" method="post">
                              <div class="form-group">
                                <label>Registered Email / Mobile <span class="text-danger">*</span></label>
                                <input type="email" data-parsley-trigger="change" class="form-control form-group" name="email_id" required>
                              </div>
                              <p class="show-message red"></p>
                            <button type="submit" id="forgot_password_agent" class="btn btn-secondary btn-block btn-lg" > RESET PASSWORD</button>
                        </form>

              </div>


              <div id="About" class="tabcontent">
                
                    <form  class="form-signin"  name="validate_create_account" id="signupForm" action="<?php echo site_url(); ?>b2c/user_register" data-parsley-validate  method="post">
                    <div class="form-group">
                      <label>Email <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="user_email" data-parsley-trigger="change" id="acc_user_email" required>
                    </div>
                    <div class="form-group">
                      <label>Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control form-group" name="user_password" id="acc_user_password" required>
                    </div>
                    <div class="form-group">
                      <label>Confirm Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control form-group" name="passconf" id="acc_user_passconf" data-parsley-equalto="#acc_user_password" required>
                    </div>
                    <div class="form-group">
                      <label>First Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-group" name="first_name" id="acc_first_name" required>
                    </div>
                    <div class="form-group">
                    <label>Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-group" name="last_name" id="acc_last_name" required>
                    </div>
                    <div class="form-group">
                      <label>Mobile Number <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="mobile_no" id="acc_mobile_no"  required>
                    </div> 
                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                  </form>
                

                 
          
      </div>
    </div>
  </div>
</div>





<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
