	var flag=true;var flag2=true;var flag4=true;var flag6=true;var flag8=true;var flag10=true;
	var flag1=true;var flag3=true;var flag5=true;var flag7=true;var flag9=true;var flag11=true;
	function formValidation(){
		
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		var numbers = /^[0-9]+$/;  
		if($("#first_name").val()==''){
			$('#first_name').css('border-color', 'red');
			$("#error_first_name").html('');
			flag=false;
		}else{
			$('#first_name').css('border-color', 'green');
			$("#error_first_name").html('');
			flag=true;
		}
		if($("#last_name").val()==''){
			$('#last_name').css('border-color', 'red');
			$("#error_last_name").html('');
			flag1=false;
		}else{
			$('#last_name').css('border-color', 'green');
			$("#error_last_name").html('');
			flag1=true;
		}
		
		if($("#email").val()==''){
			$('#email').css('border-color', 'red');
			$("#error_email").html('');
			flag2=false;
		}else if(!$("#email").val().match(mailformat)){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Email Not Valid');
			$("#email").val('');
			flag2=false;
		}else{
			$("#error_email").html('');
			$('#email').css('border-color', 'green');
			flag2=true;
		}
		
		if($("#contact").val()==''){
			$('#contact').css('border-color', 'red');
			$("#error_contact").html('');
			flag3=false;
		}else if(!$("#contact").val().match(numbers)){
			$('#contact').css('border-color', 'red');
			$("#error_contact").html('Numbers Only');
			$("#contact").val('');
			flag3=false;
		}else{
			$('#contact').css('border-color', 'green');
			$("#error_contact").html('');
			flag3=true;
		}
		
		if($("#password").val()==''){
			$('#password').css('border-color', 'red');
			$("#error_password").html('');
			flag4=false;
		}else{
			$('#password').css('border-color', 'green');
			$("#error_password").html('');
			flag4=true;
		}
		
			if($("#conf_password").val()==''){
			$('#conf_password').css('border-color', 'red');
			$("#error_conf_password").html('');
			flag5=false;
		}else if($("#conf_password").val()!=$("#password").val()){
			$('#conf_password').css('border-color', 'red');
			$("#error_conf_password").html('Enter Same Password');
			flag5=false;
		}else{
			$('#conf_password').css('border-color', 'green');
			$("#error_conf_password").html('');
			flag5=true;
		}
		
			if($("#address").val()==''){
			$('#address').css('border-color', 'red');
			$("#error_address").html('');
			flag6=false;
		}else{
			$('#address').css('border-color', 'green');
			$("#error_address").html('');
			flag6=true;
		}
		
			if($("#address").val()==''){
			$('#address').css('border-color', 'red');
			$("#error_address").html('');
			flag7=false;
		}else{
			$('#address').css('border-color', 'green');
			$("#error_address").html('');
			flag7=true;
		}
		
		if($("#city").val()==''){
			$('#city').css('border-color', 'red');
			$("#error_city").html('');
			flag8=false;
		}else{
			$('#city').css('border-color', 'green');
			$("#error_city").html('');
			flag8=true;
		}
		
			if($("#state").val()==''){
			$('#state').css('border-color', 'red');
			$("#error_state").html('');
			flag9=false;
		}else{
			$('#state').css('border-color', 'green');
			$("#error_state").html('');
			flag9=true;
		}
		
		if($("#country").val()==''){
			$('#country').css('border-color', 'red');
			$("#error_country").html('');
			flag10=false;
		}else{
			$('#country').css('border-color', 'green');
			$("#error_country").html('');
			flag10=true;
		}
		
			if($("#postcode").val()==''){
			$('#postcode').css('border-color', 'red');
			$("#error_postcode").html('');
			flag11=false;
		}else if(!$("#postcode").val().match(numbers)){
			$('#postcode').css('border-color', 'red');
			$("#error_postcode").html('Numbers Only');
			$("#postcode").val('');
			flag11=false;
		}else{
			$('#postcode').css('border-color', 'green');
			$("#error_postcode").html('');
			flag11=true;
		}
		
		if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false || flag9==false || flag11==false ){
			return false;
		} 		
			if($("#isAgeSelected").prop('checked') == true) {
				return true;
			} else {
				alert("Please agree Privacy Policy");
				return false;
			}		
	} 

	function check_user(){
		
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
		if($("#email").val()!=''){
				if($("#email").val().match(mailformat)){
					var base_url=$("#web_url").val();
					$("#error_email").html('');
					$.ajax({
						 url: base_url+"hotel_user/check_user",
						 type: 'post',
						 data:  {'email':$("#email").val()},
						 success: function(output) {
							 if(output==1){
								$("#error_email").html('User Already Exits by this mail-id');
								$("#email").val('');
							 }else{
								$("#error_email").html('');
							 }
						}
					});
				}else{
					$("#error_email").html('');
				}
		}
	}
	
	  function validation_num() { 
		  	if($("#contact").val()!=''){
				var numbers = /^[0-9]+$/;  
				if($("#contact").val().match(numbers)){
					$("#error_contact").html('');		
				}else{
					$("#error_contact").html('Numbers Only');
				}
	}
	
} 
	
		  function validation_num1() { 
		       	if($("#postcode").val()!=''){
				var numbers = /^[0-9]+$/;  
				if($("#postcode").val().match(numbers)){
					$("#error_postcode").html('');		
				}else{
					$("#error_postcode").html('Numbers Only');
				}
		}
	} 
