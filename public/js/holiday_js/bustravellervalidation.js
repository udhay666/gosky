$('#bustravellersubmit').click(function () {
    $validation=true;
    $('#retvalue').val('true');    
    var Num=/^(0|[1-9][0-9]*)$/;
    if($('#user_email').val()=='')
    {
      $('#user_email').addClass('off_placeholder');
      $('#user_email').attr("placeholder", "Enter Email Address");
      $( "#user_email").focus(); 
      $validation=false;
    } 
    else if(!isEmail($('#user_email').val()))
    {
      $('#user_email').val('');
      $('#user_email').addClass('off_placeholder');
      $('#user_email').attr("placeholder", "Enter Valid Email Address");
      $( "#user_email").focus(); 
      $validation=false;
    }
    if($('#user_mobile').val()=='')
    {
      $('#user_mobile').addClass('off_placeholder');
      $('#user_mobile').attr("placeholder", "Enter Mobile No.");
      $( "#user_mobile").focus(); 
      $validation=false;
    } 
    else if(!Num.test($('#user_mobile').val()))
    {
      $('#user_mobile').val('');
      $('#user_mobile').addClass('off_placeholder');
      $('#user_mobile').attr("placeholder", "Should Be Number");
      $( "#user_mobile").focus(); 
      $validation=false;
    }
    else if($('#user_mobile').val().length < 10 || $('#user_mobile').val().length > 10)
    {
      $('#user_mobile').val('');
      $('#user_mobile').addClass('off_placeholder');
      $('#user_mobile').attr("placeholder", "Should be of 10 digits");
      $( "#user_mobile").focus(); 
      $validation=false;
    }
    if($('#user_city').val()=='') {
      $('#user_city').addClass('off_placeholder');
      $('#user_city').attr("placeholder", "Enter Your City Name");
      $( "#user_city").focus(); 
      $validation=false;
    }
    if($('#user_pincode').val()=='') {
      $('#user_pincode').addClass('off_placeholder');
      $('#user_pincode').attr("placeholder", "Enter Your Postal Code");
      $( "#user_pincode").focus(); 
      $validation=false;
    }
    else if(!Num.test($('#user_pincode').val()))
    {
      $('#user_pincode').val('');
      $('#user_pincode').addClass('off_placeholder');
      $('#user_pincode').attr("placeholder", "Should Be Number");
      $( "#user_pincode").focus(); 
      $validation=false;
    }   
    if($('#country').val()==''){
      $('#user_country').html("select your country");
      $('#country').focus(); 
      $validation=false;
    }
    if($('#user_address').val()=='') {
      $('#user_address').addClass('off_placeholder');
      $('#user_address').attr("placeholder", "Enter Your Address");
      $( "#user_address").focus(); 
      $validation=false;
    }
    $(".checkname1:visible").each(function()
    {
      if($(this).find("select[name='Title[]']").val()==''){ 
        $(this).find("select[name='Title[]']").next().html('Select Title');
        $(this).find("select[name='Title[]']").focus();
        $('#retvalue').val('false');  
        }     
      if($(this).find("input[name='fname[]']").val()=='') {
        $(this).find("input[name='fname[]']").addClass('off_placeholder');
        $(this).find("input[name='fname[]']").attr("placeholder", "Enter First Name");
        $(this).find("input[name='fname[]']").focus();    
        $('#retvalue').val('false');        
      }
      else if(!isName($(this).find("input[name='fname[]']").val()))
      {
        $(this).find("input[name='fname[]']").val('')
        $(this).find("input[name='fname[]']").addClass('off_placeholder');
        $(this).find("input[name='fname[]']").attr("placeholder", "Enter Valid Name");
        $(this).find("input[name='fname[]']").focus();
        $('#retvalue').val('false');
      }
       $age=$(this).find("input[name='age[]']").val();
        if($age=='') {
          $(this).find("input[name='age[]']").val('');
        $(this).find("input[name='age[]']").addClass('off_placeholder');
        $(this).find("input[name='age[]']").attr("placeholder", "Enter AGE");
        $(this).find("input[name='age[]']").focus();    
        $('#retvalue').val('false');         
      }  
      else if(!Num.test($age)) {
        $(this).find("input[name='age[]']").val('');
        $(this).find("input[name='age[]']").addClass('off_placeholder');
        $(this).find("input[name='age[]']").attr("placeholder", "Should be Number");
        $(this).find("input[name='age[]']").focus();    
        $('#retvalue').val('false');          
      }         
        
    });
     $(".checkname2:visible").each(function()
    {
            
       if($(this).find("select[name='rTitle[]']").val()==''){ 
        $(this).find("select[name='rTitle[]']").next().html('Select Title');
        $(this).find("select[name='rTitle[]']").focus();
        $('#retvalue').val('false'); 
       }     
      if($(this).find("input[name='rfname[]']").val()=='') {
        $(this).find("input[name='rfname[]']").addClass('off_placeholder');
        $(this).find("input[name='rfname[]']").attr("placeholder", "Enter Name");
        $(this).find("input[name='rfname[]']").focus();    
        $('#retvalue').val('false'); 
       }
      else if(!isName($(this).find("input[name='rfname[]']").val()))
      {
        $(this).find("input[name='rfname[]']").val('')
        $(this).find("input[name='rfname[]']").addClass('off_placeholder');
        $(this).find("input[name='rfname[]']").attr("placeholder", "Enter Valid Name");
        $(this).find("input[name='rfname[]']").focus();
        $('#retvalue').val('false'); 
       }
      $rage=$(this).find("input[name='rage[]']").val();
      if($rage=='') {
        $(this).find("input[name='rage[]']").val('');
        $(this).find("input[name='rage[]']").addClass('off_placeholder');
        $(this).find("input[name='rage[]']").attr("placeholder", "Enter AGE");
        $(this).find("input[name='rage[]']").focus();    
        $('#retvalue').val('false'); 
       }  
      else if(!Num.test($rage)) {
        $(this).find("input[name='rage[]']").val('');
        $(this).find("input[name='rage[]']").addClass('off_placeholder');
        $(this).find("input[name='rage[]']").attr("placeholder", "Should be Number");
        $(this).find("input[name='rage[]']").focus();    
        $('#retvalue').val('false');  
       }         
    });
    if($('#retvalue').val()=='false'){
      $validation=false;
    }
    if(!$('#termsagree').is(':checked')) {
      $('#termsspan').css("color",'red');
      $('#termsspan').html("(This field is mandatory)");
      $('#termsagree').focus();        
      $validation=false;    
    } 
     if($validation==true){
      return true;
    }else{
      return false;
    }
  });
    $(".checktitle").change(function()
    {
      if($(this).val()==''){ 
        $(this).next().html('Select Title');
        return false;
      } 
      else{ $(this).next().html(''); return false;} 
    });   
    $('#country').change(function () {
      if($('#country').val()==''){
        $('#user_country').html("select your country");
        $('#country').focus();    
      }
      else{
        $('#user_country').html("");  
      }
    });
    $('#termsagree').change(function (){    
      if(!$('#termsagree').is(':checked')) {
        $('#termsspan').css("color",'red');;
        $('#termsspan').html("(This field is mandatory)");
      }
      else{
        $('#termsspan').css("color",'black');
        $('#termsspan').html("");
      }         
    });
    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
    function isName(name)
    {
      var regex=/^[a-zA-Z]+$/;
      return regex.test(name);
    }

  $('#bustravellerconfirmsubmit').click(function () {
    $validation=true;
     if(!$('#termsagree').is(':checked')) {
      $('#termsspan').css("color",'red');
      $('#termsspan').html("(This field is mandatory)");
      $('#termsagree').focus();        
      $validation=false;    
    } 
     if($validation==true){
      return true;
    }else{
      return false;
    }
  });

