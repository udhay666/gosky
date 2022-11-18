function assignholipackage(t,linkStrId)
{
	var strarr=linkStrId.split('*');
	$('#holiCityName').val(t.innerHTML);
	$('#linktype').val(strarr[0]);
	$('#destiId').val(strarr[1]);	
	$("#distdropdown").css("display", "none");
	$("#distdropdownsearch").css("display", "none");
	$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').toggleClass('active');
}
function holitablist(t){
	var str=$(t).attr("data-link-type");
	$strarr=str.split('*');
	$('#themesearchnew').val('');
	$('#packagesearchnew').val('');
	$('#holiCityName').val($(t).attr("data-value"));
	$('#linktype').val($strarr[0]);
	$('#destiId').val($strarr[1]);
	$('#alllinktype').val($strarr[2]);		
	$("#distdropdown").css("display", "none");
	$("#distdropdownsearch").css("display", "none");
	$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').toggleClass('active');
}


function holitabpacklist(t){ 
	var str=$(t).attr("data-link-type");
	$strarr=str.split('*');
	$('#themesearchnew').val('');
	$('#packagesearchnew').val($(t).attr("data-value")); 
	$('#holiCityName').val($(t).attr("data-value"));
	$('#linktype').val($strarr[0]);
	$('#destiId').val($strarr[1]);
	$('#alllinktype').val($strarr[2]);			
	$("#distdropdown").css("display", "none");
	$("#distdropdownsearch").css("display", "none");
	$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').toggleClass('active');
}

function holitabthemelist(t){ 
	var str=$(t).attr("data-link-type");
	$strarr=str.split('*');
	$('#holiCityName').val($(t).attr("data-value"));
	$('#themesearchnew').val($strarr[0]);
	$('#linktype').val($strarr[1]);
	$('#destiId').val($strarr[2]);
	$('#alllinktype').val($strarr[3]);			
	$("#distdropdown").css("display", "none");
	$("#distdropdownsearch").css("display", "none");
	$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').toggleClass('active');
}


function holidaypackagescrollfun() {
	$limit=25;$upto=0;
	$inval=$('#holiCityName').val(); 
	$activelink=$("ul#holidaytab li.active").find('a').attr("link-type");
	$activelink=$.trim($activelink);
	$("#distdropdown").css("display", "inline"); 
	$("#distdropdownsearch").css("display", "inline");
	if($inval){
		$str = siteUrl+"home/holidayPackage_full_list/"+$activelink+"/"+$limit+"/"+$upto+"/"+$inval;
	}
	else{
		$str = siteUrl+"home/holidayPackage_full_list/"+$activelink+"/"+$limit+"/"+$upto;
	}
	$encstr = encodeURI($str);
	$decstr = decodeURI($encstr);
	$.ajax({
		url: $decstr,
		success: function(result) {
			if($activelink=="Cities") {
				$("#holiCities").append(result);
			}
			else if($activelink=="States") {
				$("#holistates").append(result);
			}
			else if($activelink=="Countries") {
				$("#holicountries").append(result);
			}
			else if($activelink=="Continents") {
				$("#holicontinents").append(result);
			}
			else if($activelink=="Packages") {
				$("#holipackages").append(result);
			}
			else if($activelink=="Theme") {
				$("#holitheme").append(result);
			}
			else if($activelink=="All") {
				$("#all").append(result);
			} 
		}
	});  
}
function holidaypackagefun() 
{
	$limit=25;$upto=0;
	$('#holiCityName').attr("placeholder", "Holidays");
	$("#holiCities").html('');
	$("#holistates").html('');
	$("#holicountries").html('');
	$("#holicontinents").html('');
	$("#holipackages").html('');
	$("#holitheme").html('');
	$("#all").html('');
	$('#destiId').val('');
	var inval=$('#holiCityName').val();	
	var activelink=$("ul#holidaytab li.active").find('a').attr("link-type");
	activelink=$.trim(activelink);
	var str;
	$("#distdropdown").css("display", "inline"); 
	$("#distdropdownsearch").css("display", "inline");
	if(inval){
		str = siteUrl+"home/holidayPackage_full_list/"+activelink+"/"+$limit+"/"+$upto+"/"+inval; }
		else{
			str = siteUrl+"home/holidayPackage_full_list/"+activelink+"/"+$limit+"/"+$upto;
		}
		var encstr = encodeURI(str);
		var decstr = decodeURI(encstr);
		$.ajax({
			url: decstr,
			success: function(result){
				if(activelink=="Cities"){
					$("#holiCities").html(result);
				}
				else if(activelink=="States"){
					$("#holistates").html(result);
				}
				else if(activelink=="Countries")
				{
					$("#holicountries").html(result);
				}
				else if(activelink=="Continents")
				{
					$("#holicontinents").html(result);
				}
				else if(activelink=="Packages")
				{
					$("#holipackages").html(result);
				}
				else if(activelink=="Theme")
				{
					$("#holitheme").html(result);
				}
				else if(activelink=="All")
				{
					$("#all").html(result);
				}
			}
		});  
	}
	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
	$(document).ready(function() {
		$('#modifyholisearch').click( function(){
			$holidays=$('#holiCityName').attr("placeholder");
			if($holidays!='Holidays')
			{
				$('#holiCityName').val($holidays);
			}
			else if($('#holiCityName').val()==''){
				$('#holiCityName').val('Anywhere');
				$('#linktype').val('5');
				$('#destiId').val('any');
				$('#alllinktype').val('');	
			}	
			else if($('#holiCityName').val()!='' && $('#destiId').val()==''){
				$('#holiCityName').val($('#holiCityName').val());
				$('#linktype').val('5');
				$('#alllinktype').val('');	
			}
		});
		$('#travel-contact-button').click( function(){
			var Num=/^(0|[1-9][0-9]*)$/;
			var Name=/^[a-zA-Z ]+$/;
			$name=$('#travel_contact_name').val();
			$email=$('#travel_contact_email').val();
			$mobileno=$('#travel_contact_number').val();
			$comment=$('#travel_contact_comment').val();
			if($('#travel_contact_name').val()=='') {
				$('#travel_contact_name').attr("placeholder", "Enter Your Name");
				$( "#travel_contact_name" ).focus();        
				return false;
			}
			else if(!Name.test($('#travel_contact_name').val())) {
				$('#travel_contact_name').val('');
				$('#travel_contact_name').attr("placeholder", "Enter Valid Name");
				$( "#travel_contact_name" ).focus();        
				return false;
			}
			if($('#travel_contact_email').val()=='')
			{
				$('#travel_contact_email').attr("placeholder", "Enter Your Email Address");
				$( "#travel_contact_email" ).focus(); 
				return false;
			} 
			else if(!isEmail($('#travel_contact_email').val()))
			{
				$('#travel_contact_email').val('');
				$('#travel_contact_email').attr("placeholder", "Enter Your Valid Email Address");
				$( "#travel_contact_email" ).focus(); 
				return false;
			}
			if($('#travel_contact_number').val()=='')
			{			   
				$('#travel_contact_number').attr("placeholder", "Enter Mobile No.");
				$( "#travel_contact_number").focus(); 
				return false;
			} 
			else if(!Num.test($('#travel_contact_number').val()))
			{
				$('#travel_contact_number').val('');			     
				$('#travel_contact_number').attr("placeholder", "Should Be Number");
				$( "#travel_contact_number").focus(); 
				return false;
			}
			else if($('#travel_contact_number').val().length < 10 || $('#travel_contact_number').val().length > 10)
			{
				$('#travel_contact_number').val('');			    
				$('#travel_contact_number').attr("placeholder", "Should be of 10 digits");
				$( "#travel_contact_number").focus(); 
				return false;
			}
			if($('#travel_contact_comment').val()=='') {
				$('#travel_contact_comment').attr("placeholder", "Enter Your Comment");
				$( "#travel_contact_comment" ).focus();        
				return false;
			}
			$holidaycode='';
			$currenturl =location.href;                	
			$val = $currenturl.includes("/holiday/holidaydetails/");				   
			if($val){  
				$holidaycode=$('#holiday_id').val();          	
			}       		 
			$.ajax({
				url: siteUrl + 'holiday/contactus_enquiry',
				data: 'name=' + $name+'&email='+$email+'&mobileno='+$mobileno+'&comment='+$comment+'&holidaycode='+$holidaycode,
				dataType: 'json',
				type: 'POST',
				success: function(data)
				{   
					$('#travel_contact_name').val('');
					$('#travel_contact_email').val('');
					$('#travel_contact_comment').val(''); 
					$('#travel_contact_number').val('');
					$('#travel_contact_name').attr("placeholder", "YOUR NAME");
					$('#travel_contact_email').attr("placeholder", "YOUR EMAIL");
					$('#travel_contact_number').attr("placeholder", "YOUR MOBILE NUMBER");
					$('#travel_contact_comment').attr("placeholder", "YOUR MESSAGE"); 
					// $('#messageSentPopupnew').modal('show');
					window.location.replace(siteUrl+'holiday/thank_you?id='+data.requestID);
					// setTimeout( function()  { $('#messageSentPopupnew').modal('hide'); }, 5000);
				}
			});
		});
		$('#subscribesubmit').click( function(){
			$email=$('#subscribeemail').val();
			if($('#subscribeemail').val()=='')
			{
				$('#subscribeemail').attr("placeholder", "Enter Your Email Address");
				$( "#subscribeemail" ).focus(); 
				return false;
			} 
			else if(!isEmail($('#subscribeemail').val()))
			{
				$('#subscribeemail').val('');
				$('#subscribeemail').attr("placeholder", "Enter Valid Email Address");
				$( "#subscribeemail" ).focus(); 
				return false;
			}
			$.ajax({
				url: siteUrl + 'holiday/subscribe',
				data: '&email='+$email,
				dataType: 'json',
				type: 'POST',
				success: function(data)
				{   
					$('#subscribeemail').val('');
					$('#subscribeemail').attr("placeholder", "Subscribe");
					$(".subscribepopupclass").html(data.results);
					$('#subscribepopup').modal('show');
					setTimeout( function()  {
						$('#subscribepopup').modal('hide'); }, 5000);
				}
			});
		});
		$("#headersearch").autocomplete({
			source: siteUrl+"holiday/holidayheadersearch",
			minLength: 2,
			html: true,
			open: function () {
				$(this).data("uiAutocomplete").menu.element.addClass("customclass");
			}
		});
		$("#searchsubmit").click( function(){
			if($("#headersearch").val()==''){
				return false;
			}
		});
		$("#holiCityName").keyup(function(){
			holidaypackagefun(); 			
		});
		$("#holiCityName").click(function(){
			holidaypackagefun();			
			$(this).parent().find('i').toggleClass('active');
			$('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		});
		$("#mon_dur").click(function(){			
			$('.monthsdurtr').find(".active").css('background-color', '#A01D26');
			$("#distmonthtab").css("display", "inline");
			$("#holidistmonthtab").css("display", "inline");
			$(this).parent().find('i').toggleClass('active');
			$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
		});
		$(".monthsdur").click(function() {	
			$indexVal=$(this).attr("data-monthidex");
			$strVal=$(this).attr("data-monthyear");
			$('#mon_dur').val($strVal);
			$('#holiduration').val($indexVal);
			$('.monthsdurtr').find("td").removeClass('active');
			$('.monthsdurtr').find("td").css('background', '#4c4c4a');
			$(this).addClass('active');
			$(this).css('background-color', '#A01D26');
			$("#distmonthtab").css("display", "none");
			$("#holidistmonthtab").css("display", "none");
			$('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').toggleClass('active');
			$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
		});
		$("#distdropdown").on('click','li',function (){
			$limit=25;
			$upto=0;
			$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
			$("#holiCities").html('');
			$("#holistates").html('');
			$("#holicountries").html('');
			$("#holicontinents").html('');
			$("#holipackages").html('');
			$("#holitheme").html('');
			$("#all").html('');
			$('#destiId').val('');
			$(this).parent().children().removeClass('active');
			$(this).parent().children().css('color', '#3f3f3e');
			$(this).addClass('active');
			$(this).css('color', 'rgba(255,255,255,.7)');
			var inval=$('#holiCityName').val();
			var activelink=$(this).find('a').attr("link-type");
			activelink=$.trim(activelink);
			var str;
			$("#distdropdown").css("display", "inline"); 
			$("#distdropdownsearch").css("display", "inline");
			if(inval){
				str = siteUrl+"home/holidayPackage_full_list/"+activelink+"/"+$limit+"/"+$upto+"/"+inval; }
				else{
					str = siteUrl+"home/holidayPackage_full_list/"+activelink+"/"+$limit+"/"+$upto;
				}
				var encstr = encodeURI(str);
				var decstr = decodeURI(encstr);
				$.ajax({
					url: decstr,
					success: function(result){
						if(activelink=="Cities"){
							$("#holiCities").html(result);
						}
						else if(activelink=="States"){
							$("#holistates").html(result);
						}
						else if(activelink=="Countries")
						{
							$("#holicountries").html(result);
						}
						else if(activelink=="Continents")
						{
							$("#holicontinents").html(result);
						}
						else if(activelink=="Packages")
						{
							$("#holipackages").html(result);
						}
						else if(activelink=="Theme")
						{
							$("#holitheme").html(result);
						}
						else if(activelink=="All")
						{
							$("#all").html(result);
						}
						$('#holiCityName').focus();
					}
				});  
			});
		$('#userlogin_id').click( function(){			
			$email=$('#userlogin_email').val();
			$pass=$('#userlogin_pass').val();
			if($('#userlogin_email').val()=='')
			{
				$('#userlogin_email').attr("placeholder", "Enter Your Email Address");
			} 
			else if(!isEmail($('#userlogin_email').val()))
			{
				$('#userlogin_email').val('');
				$('#userlogin_email').attr("placeholder", "Enter Valid Email Address");
			}
			if($('#userlogin_pass').val()=='')
			{
				$('#userlogin_pass').attr("placeholder", "Enter Password");
			} 
			$.ajax({
				url: siteUrl + 'b2c/checklogin',
				data: '&email='+$email+'&pass='+$pass,
				dataType: 'json',
				type: 'POST',
				success: function(data)
				{   
					$('#email_userlogin').html(data.email);
					$('#pass_userlogin').html(data.pass);
					$('.logininpval').html(data.results);                	
					if(data.stat!='false'){
						$('#userlogin_email').val('');
						$('#userlogin_email').attr("placeholder", "Enter The Email Address");
						$('#userlogin_pass').val('');
						$('#userlogin_pass').attr("placeholder", "Password");
						$('#modalLogin').modal('hide');
						var seg_url = window.location.pathname;
						if(seg_url == '/cars/itinerary'){
							login_open($email);
						}
					}
				}
			});
		});



	$('#travel-contact-button1').click( function(){
			var Num = /^(0|[1-9][0-9]*)$/;
			var Name = /^[a-zA-Z ]+$/;
			$name = $('#travel_contact_name1').val();
			$email = $('#travel_contact_email1').val();
			$mobileno = $('#travel_contact_number1').val();
			// $comment = $('#travel_contact_comment1').val();
			$comment = '';
			$city = $('#travel_contact_city1').val();

			if($('#travel_contact_name1').val()=='') {
				$('#travel_contact_name1').attr("placeholder", "Enter Your Name");
				$( "#travel_contact_name1" ).focus();        
				return false;
			}
			else if(!Name.test($('#travel_contact_name1').val())) {
				$('#travel_contact_name1').val('');
				$('#travel_contact_name1').attr("placeholder", "Enter Valid Name");
				$( "#travel_contact_name1" ).focus();        
				return false;
			}
			if($('#travel_contact_email1').val()=='') {
				$('#travel_contact_email1').attr("placeholder", "Enter Your Email Address");
				$( "#travel_contact_email1" ).focus(); 
				return false;
			} 
			else if(!isEmail($('#travel_contact_email1').val())) {
				$('#travel_contact_email1').val('');
				$('#travel_contact_email1').attr("placeholder", "Enter Your Valid Email Address");
				$( "#travel_contact_email1" ).focus(); 
				return false;
			}
			if($('#travel_contact_number1').val()=='') {			   
				$('#travel_contact_number1').attr("placeholder", "Enter Mobile No.");
				$( "#travel_contact_number1").focus(); 
				return false;
			} 
			else if(!Num.test($('#travel_contact_number1').val())) {
				$('#travel_contact_number1').val('');			     
				$('#travel_contact_number1').attr("placeholder", "Should Be Number");
				$( "#travel_contact_number1").focus(); 
				return false;
			}
			else if($('#travel_contact_number1').val().length < 10 || $('#travel_contact_number1').val().length > 10) {
				$('#travel_contact_number1').val('');			    
				$('#travel_contact_number1').attr("placeholder", "Should be of 10 digits");
				$( "#travel_contact_number1").focus(); 
				return false;
			}
			/*if($('#travel_contact_city1').val()=='') {
				$('#travel_contact_city1').attr("placeholder", "Enter Your City");
				$( "#travel_contact_city1" ).focus();        
				return false;
			}
			if($('#travel_contact_comment1').val()=='') {
				$('#travel_contact_comment1').attr("placeholder", "Enter Your Comment");
				$( "#travel_contact_comment1" ).focus();        
				return false;
			}*/
			$holidaycode = $('#holiday_id1').val();
			$authorize = $('#travel_contact_authorize1:checked').val();
			$agree = $('#travel_contact_agree1:checked').val();

			if($authorize=='' || $authorize==undefined) {
				$('#travel_contact_authorize1_error').html("Please accept authorization");
				$( "#travel_contact_authorize1" ).focus();        
				return false;
			} else{
				$('#travel_contact_authorize1_error').html("");
			}
			if($agree=='' || $agree==undefined) {
				$('#travel_contact_agree1_error').html("Please accept Terms and Conditions");
				$( "#travel_contact_agree1" ).focus();        
				return false;
			} else{
				$('#travel_contact_agree1_error').html("");
			}
			
			
			$.ajax({
				url: siteUrl + 'holiday/contactus_enquiry',
				data: 'name=' + $name+'&email='+$email+'&mobileno='+$mobileno+'&comment='+$comment+'&holidaycode='+$holidaycode+'&city='+$city+'&authorize='+$authorize+'&agree='+$agree,
				dataType: 'json',
				type: 'POST',
				success: function(data) {   
					$('#travel_contact_name1').val('');
					$('#travel_contact_email1').val('');
					$('#travel_contact_comment1').val(''); 
					$('#travel_contact_number1').val('');
					$('#travel_contact_name1').attr("placeholder", "Name");
					$('#travel_contact_email1').attr("placeholder", "Email Address");
					$('#travel_contact_number1').attr("placeholder", "Mobile Number");
					$('#travel_contact_comment1').attr("placeholder", "Let us know more about your requirements (Optional)"); 
					// $('#messageSentPopupnew').modal('show');
					$('#modalResultEnquiry').modal('hide');
					window.location.replace(siteUrl+'holiday/thank_you?id='+data.requestID);
					// $('#requestiddetails').html('<strong>'+data.requestID+'</strong>');
					// setTimeout( function() { $('#messageSentPopupnew').modal('hide'); }, 5000);
				}
			});
		});
	});
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
			$.post(siteUrl+'fblogin/login',
			{ 
				name: ""+$name , email: ""+$email, first_name: ""+$first_name, middle_name: ""+$middle_name, last_name: ""+$last_name, gender: ""+$gender, picture: ""+$picture
			},
			function(data){                              
				$('.logininpval').html(data.results);       
				$('#modalLogin').modal('hide');
				var seg_url = window.location.pathname;
				if(seg_url == '/cars/itinerary'){
					login_open($email);
				}
			}, 'json');
		});   
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
    // appId      : '214079779048644',
    appId       :'252552615152028',
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
    // $('#modalLogin').modal('hide');
}
function PopupCenter(url, title, w, h) {
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
function userlogout_inpval(){				
	$.ajax({
		url: siteUrl + 'b2c/logout',
		data: '',
		dataType: 'json',
		type: 'POST',
		success: function(data) {                 	
			$currenturl =location.href;                	
			$val = $currenturl.includes("/b2c/");				   
			if($val){              	
				window.location.href=siteUrl;
			}
			else {
				$('.logininpval').html(data.results);
			}
			var seg_url = window.location.pathname;
			if(seg_url == '/cars/itinerary'){
				logout_close();
			}
		}
	});
}
function gAjaxlogin()
{
	$.ajax({
		url: siteUrl + 'Glogin/trigerGAjax',
		data: '',
		dataType: 'json',
		type: 'POST',
		success: function(data) {                   
			$('.logininpval').html(data.results);       
			$('#modalLogin').modal('hide');
			var seg_url = window.location.pathname;
			if(seg_url == '/cars/itinerary'){
				login_open(data.email);
			}
		}
	});
}
$(document).mouseup(function (e)
{
	if (!$("#distdropdown").is(e.target)
		&& $("#distdropdown").has(e.target).length === 0)
	{
		$("#distdropdown").hide();        
		$('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
	}
	if (!$("#distdropdownsearch").is(e.target)
		&& $("#distdropdownsearch").has(e.target).length === 0)
	{
		$("#distdropdownsearch").hide();
		$('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
	}
	if (!$("#distmonthtab").is(e.target)
		&& $("#distmonthtab").has(e.target).length === 0)
	{
		$("#distmonthtab").hide();
		$('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
	}
	if (!$("#holidistmonthtab").is(e.target)
		&& $("#holidistmonthtab").has(e.target).length === 0)
	{
		$("#holidistmonthtab").hide();
		$('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		$('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
	}
	if (!$("#hotdistdropdown").is(e.target)
		&& $("#hotdistdropdown").has(e.target).length === 0)
	{
		$("#hotdistdropdown").hide();        
		$('#hotel.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		$('#hotel.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
	}
	if (!$("#hotdistdropdownsearch").is(e.target)
		&& $("#hotdistdropdownsearch").has(e.target).length === 0)
	{
		$("#hotdistdropdownsearch").hide();
		$('#hotel.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
		$('#hotel.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
	}
});
function go_to_mice_enquiry(){
	var Num=/^(0|[1-9][0-9]*)$/;
	var isEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	$user_name=$("#mice_enquiry_user_name");
	$companyname=$("#mice_enquiry_companyname");
	$mobileno=$("#mice_enquiry_mobileno");
	$user_email=$("#mice_enquiry_user_email");   
	$addtionalinfo=$("#mice_enquiry_addtionalinfo");
	if($user_name.val()=='') {
		$user_name.attr("placeholder", "Enter Your Name");
		$user_name.focus();        
		return false;
	}
	if($companyname.val()=='') {
		$companyname.attr("placeholder", "Enter Company Name");
		$companyname.focus();        
		return false;
	}
	if($mobileno.val()=='')
	{        
		$mobileno.attr("placeholder", "Enter Mobile No.");
		$mobileno.focus(); 
		return false;
	} 
	else if(!Num.test($mobileno.val()))
	{
		$mobileno.val('');           
		$mobileno.attr("placeholder", "Should Be Number");
		$mobileno.focus(); 
		return false;
	}
	else if($mobileno.val().length < 10 || $mobileno.val().length > 10)
	{
		$mobileno.val('');          
		$mobileno.attr("placeholder", "Should be of 10 digits");
		$mobileno.focus(); 
		return false;
	}
	if($user_email.val()=='')
	{
		$user_email.attr("placeholder", "Enter Your Email Address");
		$user_email.focus(); 
		return false;
	} 
	else if(!isEmail.test($user_email.val()))
	{
		$user_email.val('');
		$user_email.attr("placeholder", "Enter Your Valid Email Address");
		$user_email.focus(); 
		return false;
	}
	if($addtionalinfo.val()=='') {
		$addtionalinfo.attr("placeholder", "Enter Additional information");
		$addtionalinfo.focus();        
		return false;
	}      
	$.ajax({
		url: siteUrl + 'holiday/mice_enquiry',
		data: 'user_name=' + $user_name.val()+'&companyname='+$companyname.val()+'&mobileno='+$mobileno.val()+'&user_email='+$user_email.val()+'&addtionalinfo='+$addtionalinfo.val(),              
		dataType: 'json',
		type: 'POST',
		success: function(data)
		{ 
			$user_name.val('');
			$companyname.val('');
			$mobileno.val('');
			$user_email.val('');              
			$addtionalinfo.val('');
			$user_name.attr("placeholder", "Enter Name");
			$companyname.attr("placeholder", "Enter Company Name");
			$mobileno.attr("placeholder", "Enter Mobile No");
			$user_email.attr("placeholder", "Enter Email");      
			$addtionalinfo.attr("placeholder", "Enter Additional information");
			$('#messageSentPopup').modal('show');
			setTimeout( function()  {
				$('#messageSentPopup').modal('hide'); }, 5000);
		}
	});
} 
function showtimer(timerdate, idtext ,deals_amount)
{
	var countDownDate = new Date(timerdate).getTime();
// Update the count down every 1 second
var x = setInterval(function() {
    // Get todays date and time
    var now = new Date().getTime();
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Output the result in an element with id="demo"
    $("#dealstimer"+idtext).html(" Time Left : "+ days + "d " + hours + "h "
    	+ minutes + "m " + seconds + "s " +deals_amount);
    // If the count down is over, write some text 
    if (distance < 0) {
    	clearInterval(x);
    	$("#dealstimer"+idtext).html("DEALS EXPIRED");
    }
}, 1000);
}
 
 // 

 function resultEnquiry(t)
 {  
	// alert(9);
   $('#modalResultEnquiry').modal('show');   
   $('#resultenquirypackname').html($(t).attr('data-val'));
   $('#holiday_id1').val($(t).attr('data-code'));
 } 

 function headerEnquiry()
 {  
   $('#modalResultEnquiry').modal('show');   
 } 

