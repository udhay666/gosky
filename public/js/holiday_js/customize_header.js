
    function submitvalidation()
    {
      $validation=true;
      if($('#email_val_id').val()=='')
      {
       $('#email_val_id').addClass('off_placeholder');
       $('#email_val_id').attr("placeholder", "Enter Email Address");
       $( "#email_val_id" ).focus(); 
       $validation=false;
     } 
     else if(!isEmail($('#email_val_id').val()))
     {
       $('#email_val_id').val('');
       $('#email_val_id').addClass('off_placeholder');
       $('#email_val_id').attr("placeholder", "Enter Valid Email Address");
       $( "#email_val_id" ).focus(); 
       $validation=false;
     }   
     if($('#password_id').val()=='')
     {
      $('#password_id').addClass('off_placeholder');
      $('#password_id').attr("placeholder", "Enter Password");
      $( "#password_id" ).focus();        
      $validation=false;
    }
    if($('#passconfid').val()=='')
      {  $('#passconfid').addClass('off_placeholder');
    $('#passconfid').attr("placeholder", "Enter Confirm Password");
    $( "#passconfid" ).focus();        
    $validation=false;
    }
    if($('#passconfid').val()!=$('#password_id').val())
    {
      $('#passconfid').val('');
      $('#passconfid').addClass('off_placeholder');
      $('#passconfid').attr("placeholder", "Password not match");
      $("#passconfid" ).focus();        
      $validation=false;
    }
    if($('#first_name_id').val()=='')
    {
     $('#first_name_id').addClass('off_placeholder');
     $('#first_name_id').attr("placeholder", "Enter First Name");
     $( "#first_name_id" ).focus();        
     $validation=false;
    }
    if($('#last_name_id').val()=='')
    {
     $('#last_name_id').addClass('off_placeholder');
     $('#last_name_id').attr("placeholder", "Enter Last Name");
     $( "#last_name_id" ).focus(); 
     $validation=false;
    }
    if($('#mobile_no_id').val()=='')
    {
      $('#mobile_no_id').addClass('off_placeholder');
      $('#mobile_no_id').attr("placeholder", "Enter Mobile No.");
      $( "#mobile_no_id" ).focus(); 
      $validation=false;
    } 
    else if(!$.isNumeric($('#mobile_no_id').val()))
    {
      $('#mobile_no_id').val('');
      $('#mobile_no_id').addClass('off_placeholder');
      $('#mobile_no_id').attr("placeholder", "Should Be Number");
      $( "#mobile_no_id" ).focus(); 
      $validation=false;
    }
    else if($('#mobile_no_id').val().length < 10)
    {
      $('#mobile_no_id').val('');
      $('#mobile_no_id').addClass('off_placeholder');
      $('#mobile_no_id').attr("placeholder", "Should be of 10 digits");
      $( "#mobile_no_id" ).focus(); 
      $validation=false;
    }
    if($validation==false)
    {
      return false;
    }
    }
    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }  
    $('#forgotpassword,#registeruser,#loginuser').on('click', function(){ 
      $(this).parents().find('.modal').modal('hide');
    });

