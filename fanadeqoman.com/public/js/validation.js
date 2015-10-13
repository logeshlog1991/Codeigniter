$.noConflict();
function RoomChange(){
	var adult_child='';
      for(i=1;i<=$('#room').val();i++){
        if(i==1){
			adult_child+='<div class="col-lg-3 col-xs-12 mt10"><div class="checkin">Guests</div><select name="adult[]" id="child" style=" width:108px; border-radius:3px;" class="style-select  top10"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div><div class="col-lg-3 col-xs-12 mt10"><div class="checkin">Children</div><select name="child[]" id="child'+i+'" class="style-select  top10" style=" width:108px; border-radius:3px;" onchange="childFun('+i+')"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div><span id="child_age'+i+'"></span><br/>';
        }else {
			adult_child+='<div class="col-lg-3 col-xs-12 mt10 pull-right clear"><div class="checkin">Children</div><select name="child[]" id="child'+i+'" class="style-select top10" style=" width:108px;" onchange="childFun('+i+')"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div><div class="col-lg-offset-6 col-lg-3 col-xs-12 mt10 pull-right"><div class="checkin">Guests</div><select name="adult[]" id="child" class="style-select top10" style=" width:108px;"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div><span id="child_age'+i+'"></span><br/>';  
		}
      }
    $('#AC').html(adult_child);
}

function childFun(id){
	 var child_age='';
	 for(i=1;i<=$('#child'+id).val();i++){
		child_age+='<div class=" col-lg-3 col-xs-12 mt10  pull-right " style=" clear:left; padding-bottom:10px; border-bottom:1px dashed lightblue;"><div class="checkin">Child Age</div><select class="style-select top10" style=" width:108px;" name="child_age[]" id="child_age"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div><br/>';
	 }     
	 $('#child_age'+id).html(child_age);     
}

function childFun1(){
	 var child_age='';
	 for(i=1;i<=$('#child').val();i++){
		child_age+='<div class="col-lg-3 mt10 pull-right" style="padding-bottom:10px; border-bottom:1px dashed lightblue;"><div class="checkin">Child Age</div><select class="style-select  top10"  style=" width:108px;" name="child_age[]" id="child_age"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div><br/>';
	 }     
	 $('#child_age1').html(child_age);     
}


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
function RoomChangeA(){
	var adult_child='';
      for(i=1;i<=$('#room').val();i++){
        if(i==1){
			adult_child+='<div class="col-lg-3 col-xs-6 pull-left mt10"><div class="checkin1">Children</div><select class="col-lg-12 col-xs-8" data-width="108px" name="child[]" id="child'+i+'"><option>1</option><option>2</option><option>3</option></select></div><div class="col-lg-3 col-xs-6 pull-left mt10"><div class="checkin1">Guests</div><select class="col-lg-12 col-xs-8" data-width="108px" name="adult[]" id="adult"><option>1</option><option>2</option><option>3</option></select></div><div id="child_age'+i+'"></div>';
        }else {
			adult_child+='<div class="col-lg-3 col-xs-6 pull-left mt10"><div class="checkin1">Children</div><select class="col-lg-12 col-xs-8" data-width="108px" name="child[]" id="child'+i+'" onchange="childFunA('+i+')" ><option>1</option><option>2</option><option>3</option></select></div><div class="col-lg-3 col-xs-6 pull-left mt10"><div class="checkin1">Guests</div><select class="col-lg-12 col-xs-8" data-width="108px" name="adult[]" id="adult"><option>1</option><option>2</option><option>3</option></select></div><div id="child_age'+i+'"></div>';  
		}
      }
    $('#AC').html(adult_child);
}

function childFunA(id){
	 var child_age='';
	 for(i=1;i<=$('#child'+id).val();i++){
		child_age+='<div class=" col-lg-3 col-xs-12 mt10  pull-right " style=" clear:left; padding-bottom:10px; border-bottom:1px dashed lightblue;"><div class="checkin">Child Age</div><select class="style-select top10" style=" width:108px;" name="child_age[]" id="child_age"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div><br/>';
	 }     
	 $('#child_age'+id).html(child_age);     
}

function childFun1A(){
	 var child_age='';
	 for(i=1;i<=$('#child').val();i++){
		child_age+='<div class="col-lg-3 mt10 pull-right" style="padding-bottom:10px; border-bottom:1px dashed lightblue;"><div class="checkin">Child Age</div><select class="style-select  top10"  style=" width:108px;" name="child_age[]" id="child_age"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div><br/>';
	 }     
	 $('#child_age1').html(child_age);     
}
	 
