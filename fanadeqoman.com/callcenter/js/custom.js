	var flag=true;var flag2=true;var flag4=true;var flag6=true;var flag8=true;var flag10=true;var flag12=true;
	var flag1=true;var flag3=true;var flag5=true;var flag7=true;var flag9=true;var flag11=true;var flag13=true;
	function add_hotel_validation(){
		//if(!$("#acc_name").is(':checked')){
		//	alert();
		//}
		//return false;
		if ($('input[name=acc_name]:checked').length<=0 ) { 
			$("#error_acc_name").html('Required');
			flag13=false;         
		}else{
			$("#error_acc_name").html('');
			flag13=true;
		}
		var flag=true;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		var numbers = /^[0-9]+$/;  
		if($("#hotel_name").val()==''){
			$('#hotel_name').css('border-color', 'red');
			$("#error_hotelname").html('Required');
			flag=false;
		}else{
			$('#hotel_name').css('border-color', '');
			$("#error_hotelname").html('');
			flag=true;
		}
		if($("#city_name").val()==''){
			$('#city_name').css('border-color', 'red');
			$("#error_cityname").html('Required');
			flag1=false;
		}else{
			$('#city_name').css('border-color', '');
			$("#error_cityname").html('');
			flag1=true;
		}
		if($("#first_name").val()==''){
			$('#first_name').css('border-color', 'red');
			$("#error_fname").html('Required');
			flag2=false;
		}else{
			$('#first_name').css('border-color', '');
			$("#error_fname").html('');
			flag2=true;
		}
		if($("#last_name").val()==''){
			$('#last_name').css('border-color', 'red');
			$("#error_lname").html('Required');
			flag3=false;
		}else{
			$('#last_name').css('border-color', '');
			$("#error_lname").html('');
			flag3=true;
		}
		if($("#email").val()==''){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Required');
			flag4=false;
		}else if(!$("#email").val().match(mailformat)){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Email Not Valid');
			flag4=false;
		}else{
			$("#error_email").html('');
			$('#email').css('border-color', '');
			flag4=true;
		}
		if($("#mobile_number").val()==''){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Required');
			flag5=false;
		}else if(!$("#mobile_number").val().match(numbers)){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Numbers Only');
			flag5=false;
		}else{
			$('#mobile_number').css('border-color', '');
			$("#error_mobilenumber").html('');
			flag5=true;
		}
		if($("#fax").val()==''){
			$('#fax').css('border-color', 'red');
			$("#error_fax").html('Required');
			flag6=false;
		}else{
			$('#fax').css('border-color', '');
			$("#error_fax").html('');
			flag6=true;
		}
		
		if($("#hotel_address").val()==''){
			$('#hotel_address').css('border-color', 'red');
			$("#error_adddress").html('Required');
			flag7=false;
		}else{
			$('#hotel_address').css('border-color', '');
			$("#error_adddress").html('');
			flag7=true;
		}
		
		if($("#hotel_description").val()==''){
			$('#hotel_description').css('border-color', 'red');
			$("#error_desc").html('Required');
			flag8=false;
		}else{
			$('#hotel_description').css('border-color', '');
			$("#error_desc").html('');
			flag8=true;
		}
		
		if($("#nearby_airport").val()==''){
			$('#nearby_airport').css('border-color', 'red');
			$("#error_na").html('Required');
			flag9=false;
		}else{
			$('#nearby_airport').css('border-color', '');
			$("#error_na").html('');
			flag9=true;
		}
		if($("#latitude").val()==''){
			$('#latitude').css('border-color', 'red');
			$("#error_lt").html('Required');
			flag11=false;
		}else{
			$('#latitude').css('border-color', '');
			$("#error_lt").html('');
			flag11=true;
		}
		if($("#longitude").val()==''){
			$('#longitude').css('border-color', 'red');
			$("#error_lg").html('Required');
			flag12=false;
		}else{
			$('#longitude').css('border-color', '');
			$("#error_lg").html('');
			flag12=true;
		}
		if(flag13==false || flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false || flag9==false || flag11==false || flag12==false){
			return false;
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
	function roomcategory_ad()
	{
		var flag=true;var flag1=true;var flag2=true;
		
		if($("#hotel_name").val()==''){
			$('#hotel_name').css('border-color', 'red');
			$("#error_hotelname").html('Required');
			flag=false;
		}else{
			$('#hotel_name').css('border-color', '');
			$("#error_hotelname").html('');
			flag=true;
		}
		if($("#room_category").val()==''){
			$('#room_category').css('border-color', 'red');
			$("#error_category").html('Required');
			flag1=false;
		}else{
			$('#room_category').css('border-color', '');
			$("#error_category").html('');
			flag1=true;
		}
		if($("#room_desc").val()==''){
			$('#room_desc').css('border-color', 'red');
			$("#error_roomdesc").html('Required');
			flag2=false;
		}else{
			$('#room_desc').css('border-color', '');
			$("#error_roomdesc").html('');
			flag2=true;
		}
		if(flag==false || flag1==false || flag2==false)
		{
			return false;
		}
	}
	function roomtype_ad()
	{
		var flag=true;var flag1=true;var flag2=true;var flag3=true;
		
		if($("#hotel_name").val()==''){
			$('#hotel_name').css('border-color', 'red');
			$("#error_hotelname").html('Required');
			flag=false;
		}else{
			$('#hotel_name').css('border-color', '');
			$("#error_hotelname").html('');
			flag=true;
		}
		if($("#room_type").val()==''){
			$('#room_type').css('border-color', 'red');
			$("#error_roomtype").html('Required');
			flag1=false;
		}else{
			$('#room_type').css('border-color', '');
			$("#error_roomtype").html('');
			flag1=true;
		}
		if($("#adult_capacity").val()==''){
			$('#adult_capacity').css('border-color', 'red');
			$("#error_roomac").html('Required');
			flag2=false;
		}else{
			$('#adult_capacity').css('border-color', '');
			$("#error_roomac").html('');
			flag2=true;
		}
		if($("#child_capacity").val()==''){
			$('#child_capacity').css('border-color', 'red');
			$("#error_roomcc").html('Required');
			flag3=false;
		}else{
			$('#child_capacity').css('border-color', '');
			$("#error_roomcc").html('');
			flag3=true;
		}
		if(flag==false || flag1==false || flag2==false || flag3==false)
		{
			return false;
		}
	}
	function getRoomType()
	{
		var base_url=$("#web_url").val();
		var hotel_id = $('#hotel_name').val();
		$.get(base_url+"hotel/getRoomType/"+hotel_id, 
		function(data){
			if(data != ''){
				var roomTypelist='';
				var roomTypeCapacitylist='';
				if(data.roomTypes.length!=0){
					roomTypelist += '<select name="room_type" id="room_type" class="form-control input-md">';
					for(var i=0;i<data.roomTypes.length;i++) {
					roomTypelist += '<option value="'+data.roomTypes[i].hotel_room_type+'">'+data.roomTypes[i].hotel_room_type+'</option>'
					}
					roomTypelist += '</select>'
					$('#roomTypes').html(roomTypelist);
				}else{
					$('#roomTypes').html('<select name="room_type" id="room_type" class="form-control input-md"><option value="">No Data</option></select>');
				}
				if(data.roomTypesCapacity.length!=0){
					roomTypeCapacitylist += '<select name="capacity_type" id="capacity_type" class="form-control input-md">';
					for(var i=0;i<data.roomTypesCapacity.length;i++) {
					roomTypeCapacitylist += '<option value="'+data.roomTypesCapacity[i].capacity_title+'('+data.roomTypesCapacity[i].capacity+','+data.roomTypesCapacity[i].child_capacity+')">'+data.roomTypesCapacity[i].capacity_title+'('+data.roomTypesCapacity[i].capacity+','+data.roomTypesCapacity[i].child_capacity+')</option>'
					}
					roomTypeCapacitylist += '</select>'
					$('#roomTypeCapacity').html(roomTypeCapacitylist);
				}else{
					$('#roomTypeCapacity').html('<select name="capacity_type" id="capacity_type" class="form-control input-md"><option value="">No Data</option></select>');
				}
			}else{
				$('#roomTypes').html('<select name="room_type" id="room_type" class="form-control input-md"><option value="">No Data</option></select>');
				$('#roomTypeCapacity').html('<select name="capacity_type" id="capacity_type" class="form-control input-md"><option value="">No Data</option></select>');
			}
		});
	}
	function roomcount_ad()
	{
		var numbers = /^[0-9]+$/;  
		
		var flag=true;var flag1=true;var flag2=true;var flag3=true;
		
		var hotel_name = $('#hotel_name').val();
		var rooms = $('#rooms').val();
		var room_type = $('#room_type').val();
		var capacity_type = $('#capacity_type').val();
		
		if(hotel_name==""){
			$("#error_hotelname").html('Required');
			flag=false;
		}else{
			$("#error_hotelname").html('');
			flag=true;
		}
		if(rooms==""){
			$("#error_rooms").html('Required');
			flag1=false;
		}else if(!rooms.match(numbers)){
			$("#error_rooms").html('Numeric Only');
			flag1=false;
		}else{
			$("#error_rooms").html('');
			flag1=true;
		}
		
		if(room_type==""){
			$("#error_room_type").html('Required');
			flag2=false;
		}else{
			$("#error_room_type").html('');
			flag2=true;
		}
		if(capacity_type==""){
			$("#error_capacitytype").html('Required');
			flag3=false;
		}else{
			$("#error_capacitytype").html('');
			flag3=true;
		}
		if(flag==false || flag1==false || flag2==false || flag3==false)
		{
			return false;
		}
	}
	function edit_roomcount_ad()
	{
		var numbers = /^[0-9]+$/;  
		var flag=true;
		var rooms = $('#rooms').val();
		
		if(rooms==""){
			$("#error_rooms").html('Required');
			flag=false;
		}else if(!rooms.match(numbers)){
			$("#error_rooms").html('Numeric Only');
			flag=false;
		}else{
			$("#error_rooms").html('');
			flag=true;
		}
		if(flag==false){
			return false;
		}
	}
	function roompolicy_ad()
	{
		var numbers = /^[0-9]+$/;  
		var flag=true;var flag1=true;var flag2=true;var flag3=true;var flag4=true;
		
		var hotel_name = $('#hotel_name').val();
		var arrival_time = $('#arrival_time').val();
		var departure_time = $('#departure_time').val();
		var checkinextra_time = $('#checkinextra_time').val();
		var check_in_extra_cost = $('#check_in_extra_cost').val();
		var checkoutextra_time = $('#checkoutextra_time').val();
		var check_out_extra_cost = $('#check_out_extra_cost').val();
		
		if(hotel_name==""){
			$("#error_hotelname").html('Required');
			flag=false;
		}else{
			$("#error_hotelname").html('');
			flag=true;
		}
		
		if(arrival_time==""){
			$("#error_arrivaltime").html('Required');
			flag1=false;
		}else{
			$("#error_arrivaltime").html('');
			flag1=true;
		}
		
		if(departure_time==""){
			$("#error_departuretime").html('Required');
			flag2=false;
		}else{
			$("#error_departuretime").html('');
			flag2=true;
		}
		if(checkinextra_time=="" || check_in_extra_cost==''){
			$("#error_checkinextratime").html('Required');
			flag3=false;
		}else if(!check_in_extra_cost.match(numbers)){
			$("#error_checkinextratime").html('Numeric Only');
			flag3=false;
		}else{
			$("#error_checkinextratime").html('');
			flag3=true;
		}
		if(checkoutextra_time=="" || check_out_extra_cost==''){
			$("#error_checkoutextratime").html('Required');
			flag4=false;
		}else if(!check_in_extra_cost.match(numbers)){
			$("#error_checkoutextratime").html('Numeric Only');
			flag4=false;
		}else{
			$("#error_checkoutextratime").html('');
			flag4=true;
		}
		if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false)
		{
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
		var flag=true;var flag1=true;var flag2=true;var flag3=true;var flag4=true;var flag5=true;
		var flag6=true;var flag7=true;var flag8=true;var flag9=true;var flag10=true;var flag11=true;var flag12=true;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		var numbers = /^[0-9]+$/;  
		 
		if($("#hotel").val()==''){
			$('#hotel').css('border-color', 'red');
			$("#error_hotel").html('Required');
			flag=false;
		}else{
			$('#hotel').css('border-color', '');
			$("#error_hotel").html('');
			flag=true;
		}
		if($("#email").val()==''){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Required');
			flag1=false;
		}else if(!$("#email").val().match(mailformat)){
			$('#email').css('border-color', 'red');
			$("#error_email").html('Email Not Valid');
			flag1=false;
		}else{
			$("#error_email").html('');
			$('#email').css('border-color', '');
			flag1=true;
		}
		
		if($("#password").val()==''){
			$('#password').css('border-color', 'red');
			$("#error_password").html('Required');
			flag2=false;
		}else{
			$('#password').css('border-color', '');
			$("#error_password").html('');
			flag2=true;
		}
		
		if($("#cpassword").val()==''){
			$('#cpassword').css('border-color', 'red');
			$("#c_password").html('Required');
			flag3=false;
		}else if($("#cpassword").val()!=$("#password").val()){
			$('#cpassword').css('border-color', 'red');
			$("#c_password").html('Enter Same Password');
			flag3=false;
		}else{
			$('#cpassword').css('border-color', '');
			$("#c_password").html('');
			flag3=true;
		}
		
		if($("#supplier_name").val()==''){
			$('#supplier_name').css('border-color', 'red');
			$("#error_suppliername").html('Required');
			flag4=false;
		}else{
			$('#supplier_name').css('border-color', '');
			$("#error_suppliername").html('');
			flag4=true;
		}
		
		if($("#company_name").val()==''){
			$('#company_name').css('border-color', 'red');
			$("#error_companyname").html('Required');
			flag5=false;
		}else{
			$('#company_name').css('border-color', '');
			$("#error_companyname").html('');
			flag5=true;
		}
		
		if($("#mobile_number").val()==''){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Required');
			flag6=false;
		}else if(!$("#mobile_number").val().match(numbers)){
			$('#mobile_number').css('border-color', 'red');
			$("#error_mobilenumber").html('Numbers Only');
			flag6=false;
		}else{
			$('#mobile_number').css('border-color', '');
			$("#error_mobilenumber").html('');
			flag6=true;
		}
		
		if($("#office_phone_number").val()==''){
			$('#office_phone_number').css('border-color', 'red');
			$("#error_off_ph_num").html('Required');
			flag7=false;
		}else if(!$("#office_phone_number").val().match(numbers)){
			$('#office_phone_number').css('border-color', 'red');
			$("#error_off_ph_num").html('Numbers Only');
			flag7=false;
		}else{
			$('#office_phone_number').css('border-color', '');
			$("#error_off_ph_num").html('');
			flag7=true;
		}
		
		if($("#adddress").val()==''){
			$('#adddress').css('border-color', 'red');
			$("#error_adddress").html('Required');
			flag8=false;
		}else{
			$('#adddress').css('border-color', '');
			$("#error_adddress").html('');
			flag8=true;
		}
		
		if($("#city").val()==''){
			$('#city').css('border-color', 'red');
			$("#error_city").html('Required');
			flag9=false;
		}else{
			$('#city').css('border-color', '');
			$("#error_city").html('');
			flag9=true;
		}
		
		if($("#country").val()==''){
			$('#country').css('border-color', 'red');
			$("#error_country").html('Required');
			flag10=false;
		}else{
			$('#country').css('border-color', '');
			$("#error_country").html('');
			flag10=true;
		}
		
		if($("#postal").val()==''){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Required');
			flag11=false;
		}else if(!$("#postal").val().match(numbers)){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Numbers Only');
			flag11=false;
		}else{
			$('#postal').css('border-color', '');
			$("#error_postal").html('');
			flag11=true;
		}
		
		if($("#paymnet_currency").val()==''){
			$('#paymnet_currency').css('border-color', 'red');
			$("#error_currency").html('Required');
			flag12=false;
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
			flag12=true;
		}
		if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false || flag9==false || flag10==false || flag11==false || flag12==false){
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
		var flag=true;var flag1=true;var flag2=true;var flag3=true;var flag4=true;var flag5=true;
		var flag6=true;var flag7=true;var flag8=true;var flag9=true;var flag10=true;var flag11=true;
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
			flag1=false;
		}else{
			$('#password').css('border-color', '');
			$("#error_password").html('');
			flag1=true;
		}
		
		if($("#name").val()==''){
			$('#name').css('border-color', 'red');
			$("#error_name").html('Required');
			flag2=false;
		}else{
			$('#name').css('border-color', '');
			$("#error_name").html('');
			flag2=true;
		}
		
		if($("#company_name").val()==''){
			$('#company_name').css('border-color', 'red');
			$("#error_compname").html('Required');
			flag3=false;
		}else{
			$('#company_name').css('border-color', '');
			$("#error_compname").html('');
			flag3=true;
		}
		
		if($("#contact_number").val()==''){
			$('#contact_number').css('border-color', 'red');
			$("#error_number").html('Required');
			flag4=false;
		}else if(!$("#contact_number").val().match(numbers)){
			$('#contact_number').css('border-color', 'red');
			$("#error_number").html('Numbers Only');
			flag4=false;
		}else{
			$('#contact_number').css('border-color', '');
			$("#error_number").html('');
			flag4=true;
		}
		
		if($("#paymnet_currency").val()==''){
			$('#paymnet_currency').css('border-color', 'red');
			$("#error_pc").html('Required');
			flag5=false;
		}else{
			$('#paymnet_currency').css('border-color', '');
			$("#error_pc").html('');
			flag5=true;
		}
		
		if($("#address").val()==''){
			$('#address').css('border-color', 'red');
			$("#error_address").html('Required');
			flag6=false;
		}else{
			$('#address').css('border-color', '');
			$("#error_address").html('');
			flag6=true;
		}
		
		if($("#country").val()==''){
			$('#country').css('border-color', 'red');
			$("#error_country").html('Required');
			flag7=false;
		}else{
			$('#country').css('border-color', '');
			$("#error_country").html('');
			flag7=true;
		}
		
		if($("#city").val()==''){
			$('#city').css('border-color', 'red');
			$("#error_city").html('Required');
			flag8=false;
		}else{
			$('#city').css('border-color', '');
			$("#error_city").html('');
			flag8=true;
		}
		
		if($("#bank_state").val()==''){
			$('#bank_state').css('border-color', 'red');
			$("#error_bs").html('Required');
			flag9=false;
		}else{
			$('#bank_state').css('border-color', '');
			$("#error_bs").html('');
			flag9=true;
		}
		
		if($("#postal").val()==''){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Required');
			flag10=false;
		}else{
			$('#postal').css('border-color', '');
			$("#error_postal").html('');
			flag10=true;
		}
		
		if($("#file").val()==''){
			$('#file').css('border-color', 'red');
			$("#error_logo").html('Required');
			flag11=false;
		}else{
			$('#file').css('border-color', '');
			$("#error_logo").html('');
			flag11=true;
		}
		if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false || flag9==false || flag10==false || flag11==false)
		{
			return false;
		}
		
	}
	function editcall_agents()
	{
		var flag=true;var flag1=true;var flag2=true;var flag3=true;var flag4=true;var flag5=true;
		var flag6=true;var flag7=true;var flag8=true;var flag9=true;var flag10=true;var flag11=true;
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
			flag1=false;
		}else{
			$('#password').css('border-color', '');
			$("#error_password").html('');
			flag1=true;
		}
		
		if($("#name").val()==''){
			$('#name').css('border-color', 'red');
			$("#error_name").html('Required');
			flag2=false;
		}else{
			$('#name').css('border-color', '');
			$("#error_name").html('');
			flag2=true;
		}
		
		if($("#company_name").val()==''){
			$('#company_name').css('border-color', 'red');
			$("#error_compname").html('Required');
			flag3=false;
		}else{
			$('#company_name').css('border-color', '');
			$("#error_compname").html('');
			flag3=true;
		}
		
		if($("#contact_number").val()==''){
			$('#contact_number').css('border-color', 'red');
			$("#error_number").html('Required');
			flag4=false;
		}else if(!$("#contact_number").val().match(numbers)){
			$('#contact_number').css('border-color', 'red');
			$("#error_number").html('Numbers Only');
			flag4=false;
		}else{
			$('#contact_number').css('border-color', '');
			$("#error_number").html('');
			flag4=true;
		}
		
		if($("#paymnet_currency").val()==''){
			$('#paymnet_currency').css('border-color', 'red');
			$("#error_pc").html('Required');
			flag5=false;
		}else{
			$('#paymnet_currency').css('border-color', '');
			$("#error_pc").html('');
			flag5=true;
		}
		
		if($("#address").val()==''){
			$('#address').css('border-color', 'red');
			$("#error_address").html('Required');
			flag6=false;
		}else{
			$('#address').css('border-color', '');
			$("#error_address").html('');
			flag6=true;
		}
		
		if($("#country").val()==''){
			$('#country').css('border-color', 'red');
			$("#error_country").html('Required');
			flag7=false;
		}else{
			$('#country').css('border-color', '');
			$("#error_country").html('');
			flag7=true;
		}
		
		if($("#city").val()==''){
			$('#city').css('border-color', 'red');
			$("#error_city").html('Required');
			flag8=false;
		}else{
			$('#city').css('border-color', '');
			$("#error_city").html('');
			flag8=true;
		}
		
		if($("#bank_state").val()==''){
			$('#bank_state').css('border-color', 'red');
			$("#error_bs").html('Required');
			flag9=false;
		}else{
			$('#bank_state').css('border-color', '');
			$("#error_bs").html('');
			flag9=true;
		}
		
		if($("#postal").val()==''){
			$('#postal').css('border-color', 'red');
			$("#error_postal").html('Required');
			flag10=false;
		}else{
			$('#postal').css('border-color', '');
			$("#error_postal").html('');
			flag10=true;
		}
		if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false || flag9==false || flag10==false || flag11==false)
		{
			return false;
		}
		
	}
