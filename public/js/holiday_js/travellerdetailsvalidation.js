$('#travellersubmit').click(function () {
    $validation=true;
    $('#retvalue').val("true"); 
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
     else if(!specialcharval($('#user_city').val()))
    {
      $('#user_city').val('');
      $('#user_city').addClass('off_placeholder');
      $('#user_city').attr("placeholder", "Special Character Not Allowed");
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
    if($('#user_state').val()=='') {
      $('#user_state').addClass('off_placeholder');
      $('#user_state').attr("placeholder", "Enter Your State Name");
      $( "#user_state").focus(); 
      $validation=false;
    }
     else if(!specialcharval($('#user_state').val()))
    {
      $('#user_state').val('');
      $('#user_state').addClass('off_placeholder');
      $('#user_state').attr("placeholder", "Special Character Not Allowed");
      $( "#user_state").focus(); 
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
    $(".checkname:visible").each(function()
    {
      if($(this).find("select[name='title[]']").val()==''){ 
        $(this).find("select[name='title[]']").next().next().html('Select Title');
        $(this).find("select[name='title[]']").focus();
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
       if(!specialcharval($(this).find("input[name='mname[]']").val())&&$(this).find("input[name='mname[]']").val()!='')
      {
        $(this).find("input[name='mname[]']").val('')
        $(this).find("input[name='mname[]']").addClass('off_placeholder');
        $(this).find("input[name='mname[]']").attr("placeholder", "Special Character Not Allowed");
        $(this).find("input[name='mname[]']").focus();
        $('#retvalue').val('false');          
      }
      if($(this).find("input[name='lname[]']").val()=='') {
        $(this).find("input[name='lname[]']").addClass('off_placeholder');
        $(this).find("input[name='lname[]']").attr("placeholder", "Enter Last Name");
        $(this).find("input[name='lname[]']").focus();    
        $('#retvalue').val('false');       
      }
      else if(!isName($(this).find("input[name='lname[]']").val()))
      {
        $(this).find("input[name='lname[]']").val('')
        $(this).find("input[name='lname[]']").addClass('off_placeholder');
        $(this).find("input[name='lname[]']").attr("placeholder", "Enter Valid Name");
        $(this).find("input[name='lname[]']").focus();
        $('#retvalue').val('false');          
      }
      if($(this).find("input[name='dob[]']").val()=='') {
        $(this).find("input[name='dob[]']").addClass('off_placeholder');
        $(this).find("input[name='dob[]']").attr("placeholder", "Enter Your Date of Birth");
        $(this).find("input[name='dob[]']").focus();    
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
    $(".checktitle2").change(function()
    {
      if($(this).val()==''){ 
        $(this).next().next().html('Select Title');
        return false;
      } 
      else{ $(this).next().next().html(''); return false;} 
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

     function specialcharval(str)
    {
     var regex = new RegExp("^[a-zA-Z0-9]+$");
      return regex.test(str);
    }

    $('input[type=text]').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});

       $('textarea').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9_ $&+-/,:.;=?@#()']+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});

$('#applypromo').click(function () {
  $promo_code=$('#promo_code').val();
  $total_cost=$('#original_cost').val();
   if($promo_code==''||$total_cost=='')
    {
      $('#promo_code').addClass('off_placeholder');
      $('#promo_code').attr("Enter Promotional Code");
      $('#discost').html('');
      $('#discostdiv').css("display",'none');
      $('#grandcost').html('');
      $('#grandcostdiv').css("display",'none');
      $( "#promo_code").focus(); 
       return false;
    }

       $.ajax({
                url: siteUrl + 'promotional/get_promotional_offer',
                 data: 'promo_code=' + $promo_code+'&type=6&total_cost=' + $total_cost,
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {    
                $('#promo_alert').html(data.promo_alert);               
                if(data.discost!=0){
                $('#discost').html(data.discost);
                $('#discostdiv').css("display",'block'); 
                 }
                 else
                 {
                   $('#discost').html('');
                   $('#discostdiv').css("display",'none');
                 }
                if(data.grandcost!=0){
                  $('#grandcost').html(data.grandcost); 
                  $('#grandcostdiv').css("display",'block');
                 }
                 else
                 {
                   $('#grandcost').html('');
                   $('#grandcostdiv').css("display",'none');
                 }
              
             }
            }); 

});
