function formValidation()
{
	var serachData=$("#searchid").val();
	var checkin=$("#datepicker").val();
	var checkout=$("#datepicker1").val();
	
	var flag=true;var flag1=true;var flag2=true;
	
	if(serachData=="")
	{
		$("#destination").html('required');
		flag=false;
	}else{
		$("#destination").html('');
		flag=true;
	}
	if(checkin=="")
	{
		$("#checkinDatepicker").html('required');
		flag1=false;
	}else{
		$("#checkinDatepicker").html('');
		flag1=true;
	}
	if(checkout=="")
	{
		$("#checkoutDatepicker").html('required');
		flag2=false;
	}else{
		$("#checkoutDatepicker").html('');
		flag2=true;
	}
	if(flag==false || flag1==false || flag2==false){
		return false;
	}
}
