	var error_rquired='<span class="error_rquired" style="color:red">Required</span>';
	var letter_rquired='<span class="letter_rquired" style="color:red">Numbers Only</span>';
	var characters_rquired='<span class="characters_rquired" style="color:red">Characters Only</span>';
	var email_rquired='<span class="email_rquired" style="color:red">Not Volid Email</span>';
	var Cemail_rquired='<span class="Cemail_rquired" style="color:red">Not Same Email</span>';
	var emptyInput=[];
	var flag=true;var flag1=true;var flag2=true;var flag3=true;var flag4=true;var flag5=true;
	var flag6=true;var flag7=true;var flag8=true;var flag9=true;var flag11=true;var flag12=true;
	var flag13=true;var flag14=true;var flag15=true;var flag16=true;var flag17=true;var flag18=true;
	var flag19=true;var flag20=true;
	
	function add_hotel_validation(){
		var allInputText=$(".add_hotel_form").find("[type=text]");
		$.each(allInputText,function(i,e){
				$(this).parent().find(".error_rquired").remove();
				$(this).parent().find(".letter_rquired").remove();
				$(this).parent().find(".characters_rquired").remove();
				$(this).parent().find(".email_rquired").remove();
				$(this).parent().find(".Cemail_rquired").remove();
			if($(this).val()!=""){
				$(this).removeClass("border-red");
				
				if($(this).attr("id")=="hotel_name"){
					allLetter_hotel_name($(this).val(),$(this));
				}else if($(this).attr("id")=="city_name"){
					allnumeric_city_name($(this).val(),$(this));
				}else if($(this).attr("id")=="first_name"){
					allnumeric_first_name($(this).val(),$(this));
				}else if($(this).attr("id")=="last_name"){
					allnumeric_last_name($(this).val(),$(this));
				}else if($(this).attr("id")=="email_address"){
					allnumeric_email_address($(this).val(),$(this));
				}else if($(this).attr("id")=="Rfirst_name"){
					allnumeric_Rfirst_name($(this).val(),$(this));
				}else if($(this).attr("id")=="Rlast_name"){
					allnumeric_Rlast_name($(this).val(),$(this));
				}else if($(this).attr("id")=="Rmobile_no"){
					allnumeric_Rmobile_no($(this).val(),$(this));
				}else if($(this).attr("id")=="Remail"){
					allnumeric_Remail($(this).val(),$(this));
				}else if($(this).attr("id")=="Rcemail"){
					allnumeric_Rcemail($(this).val(),$(this));
				}else if($(this).attr("id")=="Mfirst_name"){
					allnumeric_Mfirst_name($(this).val(),$(this));
				}else if($(this).attr("id")=="Mlast_name"){
					allnumeric_Mlast_name($(this).val(),$(this));
				}else if($(this).attr("id")=="Mmobile_no"){
					allnumeric_Mmobile_no($(this).val(),$(this));
				}else if($(this).attr("id")=="Memail"){
					allnumeric_Memail($(this).val(),$(this));
				}else if($(this).attr("id")=="Mcemail"){
					allnumeric_Mcemail($(this).val(),$(this));
				}else if($(this).attr("id")=="Afirst_name"){
					allnumeric_Afirst_name($(this).val(),$(this));
				}else if($(this).attr("id")=="Alast_name"){
					allnumeric_Alast_name($(this).val(),$(this));
				}else if($(this).attr("id")=="Amobile_no"){
					allnumeric_Amobile_no($(this).val(),$(this));
				}else if($(this).attr("id")=="Aemail"){
					allnumeric_Aemail($(this).val(),$(this));
				}else if($(this).attr("id")=="Acemail"){
					allnumeric_Acemail($(this).val(),$(this));
				}
			}else{
				$(this).addClass("border-red");
				emptyInput.push($(this));
				$(this).parent().append(error_rquired);
				flag=false;
			}
		});
		$(emptyInput[0]).focus();
		if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false || flag9==false || flag11==false || flag12==false || flag13==false || flag14==false || flag15==false || flag16==false || flag17==false || flag18==false || flag19==false || flag20==false){
			return false;
		}
	}
	function allLetter_hotel_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag=false;
		}  
	}
	function allnumeric_city_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag1=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag1=false;
		}  
	}
	function allnumeric_first_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag2=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag2=false;
		}  
	}
	function allnumeric_last_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag3=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag3=false;
		}  
	}
	function allnumeric_email_address(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			$(element).parent().find(".email_rquired").remove();
			flag4=true;   
		}else{  
			$(element).parent().append(email_rquired);
			flag4=false;
		}  
	}
	function allnumeric_Rfirst_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag5=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag5=false;
		}  
	}
	function allnumeric_Rlast_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag6=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag6=false;
		}  
	}
	function allnumeric_Rmobile_no(value,element)  
	{   
		var numbers = /^[0-9]+$/;  
		if(value.match(numbers))  
		{  
		    $(element).parent().find(".letter_rquired").remove();
			flag7=true;   
		}else{  
		    $(element).parent().append(letter_rquired);
			flag7=false;
		}  
	}
	function allnumeric_Remail(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			$(element).parent().find(".email_rquired").remove();
			flag8=true;   
		}else{  
			$(element).parent().append(email_rquired);
			flag8=false;
		}  
	}
	function allnumeric_Rcemail(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			if($("#Remail").val()==value){
				$(element).parent().find(".email_rquired").remove();
				flag9=true;   
			}else{
				 $(element).parent().append(Cemail_rquired);
				 flag9=false;
			}
		}else{  
			$(element).parent().append(email_rquired);
			flag9=false;
		}  
	}
	function allnumeric_Mfirst_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag11=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag11=false;
		}  
	}
	function allnumeric_Mlast_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag12=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag12=false;
		}  
	}  
	function allnumeric_Mmobile_no(value,element)  
	{   
		var numbers = /^[0-9]+$/;  
		if(value.match(numbers))  
		{  
		    $(element).parent().find(".letter_rquired").remove();
			flag13=true;   
		}else{  
		    $(element).parent().append(letter_rquired);
			flag13=false;
		}  
	} 
	function allnumeric_Memail(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			$(element).parent().find(".email_rquired").remove();
			flag14=true;   
		}else{  
			$(element).parent().append(email_rquired);
			flag14=false;
		}  
	}
	function allnumeric_Mcemail(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			if($("#Memail").val()==value){
				$(element).parent().find(".email_rquired").remove();
				flag15=true;   
			}else{
				 $(element).parent().append(Cemail_rquired);
				 flag15=false;
			}
		}else{  
			$(element).parent().append(email_rquired);
			flag=false;
		}  
	}
	
	
	
	function allnumeric_Afirst_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag16=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag16=false;
		}  
	}
	function allnumeric_Alast_name(value,element)  
	{   
		var letters = /^[A-Za-z _]+$/;  
		if(value.match(letters))  
		{  
			$(element).parent().find(".characters_rquired").remove();
			flag17=true;  
		}else{  
			 $(element).parent().append(characters_rquired);
			flag17=false;
		}  
	}  
	function allnumeric_Amobile_no(value,element)  
	{   
		var numbers = /^[0-9]+$/;  
		if(value.match(numbers))  
		{  
		    $(element).parent().find(".letter_rquired").remove();
			flag18=true;   
		}else{  
		    $(element).parent().append(letter_rquired);
			flag18=false;
		}  
	} 
	function allnumeric_Aemail(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			$(element).parent().find(".email_rquired").remove();
			flag19=true;   
		}else{  
			$(element).parent().append(email_rquired);
			flag19=false;
		}  
	}
	function allnumeric_Acemail(value,element)  
	{   
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(value.match(mailformat))  
		{  
			if($("#Memail").val()==value){
				$(element).parent().find(".email_rquired").remove();
				flag20=true;   
			}else{
				 $(element).parent().append(Cemail_rquired);
				 flag20=false;
			}
		}else{  
			$(element).parent().append(email_rquired);
			flag20=false;
		}  
	}
	function Hotel_Exits(){
		var letters = /^[A-Za-z _]+$/; 
		var hotel_name=$("#hotel_name").val(); 
		if(hotel_name!=''){
			if(hotel_name.match(letters)){
				var base_url=$("#web_url").val();
				var spans = $('#error_hotelname');
				spans.text(''); 
				$.ajax({
					 url: base_url+"hotel/hotel_check",
					 type: 'post',
					 data:  {'hotel_name':$("#hotel_name").val()},
					 success: function(output) {
						 if(output==1){
							$("#error_hotelname").append('<span style="color:red;" id="error_hotelname">Hotel Already Exits</span>');return false;
						 }else{
							$("#error_hotelname").append('<span style="color:green;" id="error_hotelname">Valid Hotel</span>');
						 }
					}
				});
			}else{
				$("#error_hotelname").remove();
			}
		}
	}
	 function Hotel_Edit_Exits(){
		var letters = /^[A-Za-z _]+$/; 
		var hotel_name=$("#hotel_name").val(); 
		if(hotel_name!=''){
			if(hotel_name.match(letters)){
				var base_url=$("#web_url").val();
				var spans = $('#error_hotelname');
				spans.text(''); 
				$.ajax({
					 url: base_url+"hotel/hotel_check_edit",
					 type: 'post',
					 data:  {'hotel_name':$("#hotel_name").val(),"hotel_id":$("#hotel_id").val()},
					 success: function(output) {
						 if(output==1){
							$("#error_hotelname").append('<span style="color:red;" id="error_hotelname">Hotel Already Exits</span>');return false;
						 }else{
							$("#error_hotelname").append('<span style="color:green;" id="error_hotelname">Valid Hotel</span>');
						 }
					}
				});
			}else{
				$("#error_hotelname").remove();
			}
		}
	}
	function check_pass(){
		if($("#currentpass").val()!=''){
			$("#error_hotelname1").html('');
			var base_url=$("#WEB_URL").val();
			$("#error_hotelnames").remove();
			$.ajax({
					 url: base_url+"index/check_pass",
					 type: 'post',
					 data:  {"currentpass":$("#currentpass").val()},
					 success: function(output) {
						 if(output=='sucess'){
							$("#error_hotelname").append('<span style="color:green;" id="error_hotelnames">Valid Password</span>');
						 }else{
							$("#error_hotelname").append('<span style="color:red;" id="error_hotelnames">In Valid Password</span>');return false;
						 }
					}
				});
		}
    }
	function checkValidation(){
		var base_url=$("#WEB_URL").val();
		$("#cpass2").remove();
		$("#update1").remove();
		var currentpass=$("#currentpass").val();
		var npass=$("#npass").val();
		var cpass=$("#cpass").val();
		var flag=true;
		
		if(currentpass==''){
			$("#error_hotelname1").html('Required');
			flag=false;	
		}else{
			$("#error_hotelname1").html('');
			flag=true;
		}
		
		if(npass==''){
			$("#error_npass").html('Required');
			flag=false;	
		}else{
			$("#error_npass").html('');
			flag=true;
		}
		
		if(cpass==''){
			$("#cpass1").html('Required');
			flag=false;	
		}else{
			$("#cpass1").html('');
			flag=true;
		}
		if(flag==true){
			if($("#npass").val()==$("#cpass").val()){
				if($('#error_hotelnames').text()!="Valid Password"){
					return false;
				}
				alert("Password Updated,Please Relogin");
				/*else{
					$.ajax({
						 url: base_url+"index/change_password_ad",
						 type: 'post',
						 data:  {"npass":$("#npass").val()},
						 success: function(output) {
							 if(output=='sucess'){
								$("#update").append('<span style="color:green;" id="update1">Password Successfully Updated</span>');
							 }
						}
					});
				}
				*/
			}else{
				$("#cpass1").append('<span style="color:red;" id="cpass2">In Valid Confirmation Password</span>');return false;
			}
		}else{
			return false;
		}
	}
	function photo(){
		if($('#file').val()==''){
			$('#error_photo').html('Required');
			return false;
		}else{
			$('#error_photo').html('');
		}
	}
	$(document).ready(function(){ 
		$('#imagechecked').click(function(){
		});
	});
	function detail_location(){
		if($('#Location').val()=='' && $('#Airport').val()=='' && $('#Nearby').val()=='' && $('#Transport').val()==''){
			$('#error').html('Please Select At Least One feild');
			$('#succ').hide();
			return false;
		}else{
			$('#error').html('');
		}
	}
	function general_settings(){
		if($('#From_inpossible').val()=='' && $('#To_inpossible').val()=='' && $('#From_outpossible').val()=='' && $('#To_outpossible').val()=='' && $('#check-inguest').val()=='' && $('#check-outguest').val()=='' && $('#Tax').val()=='' && $('#Service_Charge').val()==''){
			$('#error').html('Please Select At Least One feild');
			$('#succ').hide();
			return false;
		}else{
			$('#error').html('');
		}
	}
	function acc_details(){
		if($('#transfer_to').val()=='' && $('#account_number').val()=='' && $('#f_t').val()=='' && $('#bank_name').val()=='' && $('#paymnet_currency').val()=='' && $('#maximum_payment').val()=='' && $('#bank_address1').val()=='' && $('#bank_address2').val()=='' && $('#bank_address2').val()=='' && $('#bank_country').val()=='' && $('#bank_state').val()=='' && $('#bank_city').val()=='' && $('#postal').val()=='' && $('#tax').val()==''){
			$('#error').html('Please Select At Least One feild');
			$('#succ').hide();
			return false;
		}else{
			$('#error').html('');
		}
	}
	function add_room_fac()
	{
		$('#error').html('');
		if($('#Room_Facilities').val()==''){
			$('#error1').html('Required');
			return false;
		}else{
			$('#error1').html('');
		}
	}
	function add_hotel_fac()
	{
		$('#error1').html('');
		if($('#Hotel_Facilities').val()==''){
			$('#error').html('Required');
			return false;
		}else{
			$('#error').html('');
		}
	}
	function sub_form()
	{
		$("#from1").submit();
		//$("#from2").submit();
	}
	
	function add_supplier()
	{
		var flag=true;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		var numbers = /^[0-9]+$/;  
		 
		 
		if($("#email").val()==''){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Required');
			flag=false;
		}else if(!$("#email").val().match(mailformat)){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Email Not Valid');
			flag=false;
		}else{
			$("#error_email").html('');
			$('#email').css('border-color', '');
			flag=true;
		}
		
		if($("#password").val()==''){
			$('#password').css('border-color', 'red');
			$("#error_password").html('Required');
			flag=false;
		}else{
			$('#password').css('border-color', '');
			$("#error_password").html('');
			flag=true;
		}
		
		if($("#cpassword").val()==''){
			$('#cpassword').css('border-color', 'red');
			$("#c_password").html('Required');
			flag=false;
		}else if($("#cpassword").val()!=$("#password").val()){
			$('#cpassword').css('border-color', 'red');
			$("#c_password").html('Enter Same Password');
			flag=false;
		}else{
			$('#cpassword').css('border-color', '');
			$("#c_password").html('');
			flag=true;
		}
		
		if($("#supplier_name").val()==''){
			$('#supplier_name').css('border-color', 'red');
			$("#error_suppliername").html('Required');
			flag=false;
		}else{
			$('#supplier_name').css('border-color', '');
			$("#error_suppliername").html('');
			flag=true;
		}
		
		if($("#company_name").val()==''){
			$('#company_name').css('border-color', 'red');
			$("#error_companyname").html('Required');
			flag=false;
		}else{
			$('#company_name').css('border-color', '');
			$("#error_companyname").html('');
			flag=true;
		}
		
		if($("#mobile_number").val()==''){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Required');
			flag=false;
		}else if(!$("#mobile_number").val().match(numbers)){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Numbers Only');
			flag=false;
		}else{
			$('#mobile_number').css('border-color', '');
			$("#error_mobilenumber").html('');
			flag=true;
		}
		
		if($("#office_phone_number").val()==''){
			$('#office_phone_number').css('border-color', 'red');
			$("#error_off_ph_num").html('Required');
			flag=false;
		}else if(!$("#office_phone_number").val().match(numbers)){
			$('#office_phone_number').css('border-color', 'red');
			$("#error_off_ph_num").html('Numbers Only');
			flag=false;
		}else{
			$('#office_phone_number').css('border-color', '');
			$("#error_off_ph_num").html('');
			flag=true;
		}
		
		if($("#adddress").val()==''){
			$('#adddress').css('border-color', 'red');
			$("#error_adddress").html('Required');
			flag=false;
		}else{
			$('#adddress').css('border-color', '');
			$("#error_adddress").html('');
			flag=true;
		}
		
		if($("#city").val()==''){
			$('#city').css('border-color', 'red');
			$("#error_city").html('Required');
			flag=false;
		}else{
			$('#city').css('border-color', '');
			$("#error_city").html('');
			flag=true;
		}
		
		if($("#country").val()==''){
			$('#country').css('border-color', 'red');
			$("#error_country").html('Required');
			flag=false;
		}else{
			$('#country').css('border-color', '');
			$("#error_country").html('');
			flag=true;
		}
		
		if($("#postal").val()==''){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Required');
			flag=false;
		}else if(!$("#postal").val().match(numbers)){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Numbers Only');
			flag=false;
		}else{
			$('#postal').css('border-color', '');
			$("#error_postal").html('');
			flag=true;
		}
		
		if($("#paymnet_currency").val()==''){
			$('#paymnet_currency').css('border-color', 'red');
			$("#error_currency").html('Required');
			flag=false;
		}else{
			$('#paymnet_currency').css('border-color', '');
			$("#error_currency").html('');
			flag=true;
		}
		
		if($('#file').val()==''){
			$('#error_photo').html('Required');
			flag=false;
		}else{
			$('#error_photo').html('');
			flag=true;
		}
		if(flag==false){
			return false;
		}
	}
	function add_users()
	{
		
		var flag=true;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		var numbers = /^[0-9]+$/;  
		
		if($("#supplier_name").val()==''){
			$('#supplier_name').css('border-color', 'red');
			$("#error_suppliername").html('Required');
			flag=false;
		}else{
			$('#supplier_name').css('border-color', '');
			$("#error_suppliername").html('');
			flag=true;
		}
		if($("#company_name").val()==''){
			$('#company_name').css('border-color', 'red');
			$("#error_companyname").html('Required');
			flag=false;
		}else{
			$('#company_name').css('border-color', '');
			$("#error_companyname").html('');
			flag=true;
		}
		if($("#email").val()==''){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Required');
			flag=false;
		}else if(!$("#email").val().match(mailformat)){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Email Not Valid');
			flag=false;
		}else{
			$("#error_email").html('');
			$('#email').css('border-color', '');
			flag=true;
		}
		if($("#password").val()==''){
			$('#password').css('border-color', 'red');
			$("#error_password").html('Required');
			flag=false;
		}else{
			$('#password').css('border-color', '');
			$("#error_password").html('');
			flag=true;
		}
		
		if($("#cpassword").val()==''){
			$('#cpassword').css('border-color', 'red');
			$("#c_password").html('Required');
			flag=false;
		}else if($("#cpassword").val()!=$("#password").val()){
			$('#cpassword').css('border-color', 'red');
			$("#c_password").html('Enter Same Password');
			flag=false;
		}else{
			$('#cpassword').css('border-color', '');
			$("#c_password").html('');
			flag=true;
		}
		if($("#mobile_number").val()==''){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Required');
			flag=false;
		}else if(!$("#mobile_number").val().match(numbers)){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Numbers Only');
			flag=false;
		}else{
			$('#mobile_number').css('border-color', '');
			$("#error_mobilenumber").html('');
			flag=true;
		}
		if($("#adddress").val()==''){
			$('#adddress').css('border-color', 'red');
			$("#error_adddress").html('Required');
			flag=false;
		}else{
			$('#adddress').css('border-color', '');
			$("#error_adddress").html('');
			flag=true;
		}
		if($("#city").val()==''){
			$('#city').css('border-color', 'red');
			$("#error_city").html('Required');
			flag=false;
		}else{
			$('#city').css('border-color', '');
			$("#error_city").html('');
			flag=true;
		}
		if($("#state").val()==''){
			$('#state').css('border-color', 'red');
			$("#error_state").html('Required');
			flag=false;
		}else{
			$('#state').css('border-color', '');
			$("#error_state").html('');
			flag=true;
		}
		if($("#country").val()==''){
			$('#country').css('border-color', 'red');
			$("#error_country").html('Required');
			flag=false;
		}else{
			$('#country').css('border-color', '');
			$("#error_country").html('');
			flag=true;
		}
		if($("#postal").val()==''){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Required');
			flag=false;
		}else if(!$("#postal").val().match(numbers)){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Numbers Only');
			flag=false;
		}else{
			$('#postal').css('border-color', '');
			$("#error_postal").html('');
			flag=true;
		}
		if($('#file').val()==''){
			$('#error_photo').html('Required');
			flag=false;
		}else{
			$('#error_photo').html('');
			flag=true;
		}
		if(flag==false){
			return false;
		}
	}
	function edit_currency()
	{
		if($('#currency_value').val()==''){
			$("#error_Value").html('Required');
			return false;
		}else{
			$("#error_Value").html('');
		}
	}	
	function update_payment_charge()
	{
		$("#succ").html('');
		if($('#currency_value').val()==''){
			$("#error_Value").html('Required');
			return false;
		}else{
			$("#error_Value").html('');
		}
	}	
	function update_admin_markup()
	{
		$("#succ").html('');
		if($('#currency_value').val()==''){
			$("#error_Value").html('Required');
			return false;
		}else{
			$("#error_Value").html('');
		}
	}	
	function update_country_markup()
	{
		$("#succ").html('');
		var flag=true;
		if($('#currency_value').val()==''){
			$("#error_Value").html('Required');
			flag=false;
		}else{
			$("#error_Value").html('');
		}
		if($('#country').val()==''){
			$("#error_country").html('Required');
			flag=false;
		}else{
			$("#country_name").val($('#country option:selected').text());
			$("#error_country").html('');
		}
		if(flag==false){
			return false;
		}
	
	}
	function update_country()
	{
		$("#succ").html('');
		if($('#country').val()!=''){
			$.ajax({
				 url: $('#WEB_URL').val()+"index/country_markup_value",
				 type: 'post',
				 data:  {"country":$('#country').val()},
				 success: function(output) {
					$('#currency_value').val(output);
				}
			});
		}
	}
	function update_callcenter_markup()
	{
		$("#succ").html('');
		var flag=true;
		if($('#currency_value').val()==''){
			$("#error_Value").html('Required');
			flag=false;
		}else{
			$("#error_Value").html('');
		}
		if($('#country').val()==''){
			$("#error_country").html('Required');
			flag=false;
		}else{
			$("#country_name").val($('#country option:selected').text());
			$("#error_country").html('');
		}
		if(flag==false){
			return false;
		}
	}
	function update_CCagents()
	{
		$("#succ").html('');
		if($('#country').val()!=''){
			$.ajax({
				 url: $('#WEB_URL').val()+"index/CCagents_markup_value",
				 type: 'post',
				 data:  {"country":$('#country').val()},
				 success: function(output) {
					$('#currency_value').val(output);
				}
			});
		}
	}		
	function call_agents()
	{
		var flag=true;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		var numbers = /^[0-9]+$/;  
		
		if($("#email").val()==''){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Required');
			flag=false;
		}else if(!$("#email").val().match(mailformat)){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Email Not Valid');
			flag=false;
		}else{
			$("#error_email").html('');
			$('#email').css('border-color', '');
			flag=true;
		}
		if($("#password").val()==''){
			$('#password').css('border-color', 'red');
			$("#error_password").html('Required');
			flag=false;
		}else{
			$('#password').css('border-color', '');
			$("#error_password").html('');
			flag=true;
		}
		if($("#name").val()==''){
			$('#name').css('border-color', 'red');
			$("#error_name").html('Required');
			flag=false;
		}else{
			$('#name').css('border-color', '');
			$("#error_name").html('');
			flag=true;
		}
		if($("#company_name").val()==''){
			$('#company_name').css('border-color', 'red');
			$("#error_compname").html('Required');
			flag=false;
		}else{
			$('#company_name').css('border-color', '');
			$("#error_compname").html('');
			flag=true;
		}
		if($("#contact_number").val()==''){
			$('#contact_number').css('border-color', 'red');
			$("#error_number").html('Required');
			flag=false;
		}else if(!$("#contact_number").val().match(numbers)){
			$('#contact_number').css('border-color', 'red');
			$("#error_number").html('Numbers Only');
			flag=false;
		}else{
			$('#contact_number').css('border-color', '');
			$("#error_number").html('');
			flag=true;
		}
		return false;
	}
	
