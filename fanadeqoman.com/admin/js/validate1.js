 //******allotments********//
 $(document).ready(function(){
           $("#formsubmit").click(function(){  //alert("hi");
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
             if(isNaN($("#allocation_rooms").val()) || $("#allocation_rooms").val()==''){
                $("#allocation_rooms").css('border-color','red','color:','red');
         if($("#allocation_rooms").val()==''){ $("#allocation_rooms").attr('placeholder','required'); } else {  $("#allocation_rooms").val('');
                $("#allocation_rooms").attr('placeholder','only number'); }
                return false;
        }else{
            $("#allocation_rooms").css('border-color','black','color:','black');
        }
        
           if(isNaN($("#allocation_release_days").val()) || $("#allocation_release_days").val()==''){
                $("#allocation_release_days").css('border-color','red','color:','red');
                if($("#allocation_release_days").val()==''){ $("#allocation_release_days").attr('placeholder','required'); } else {  $("#allocation_release_days").val('');
                $("#allocation_release_days").attr('placeholder','only number'); }
                return false;
        }else{
            $("#allocation_release_days").css('border-color','black','color:','black');
        }

          if($("#datepicker").val()==''){
                $("#datepicker").css('border-color','red','color:','red');
                 $("#datepicker").attr('placeholder','required');
                return false;
        }else{
           $("#datepicker").css('border-color','black','color:','black');
        }
        
         if($("#datepicker1").val()==''){
                $("#datepicker1").css('border-color','red','color:','red');
                 $("#datepicker1").attr('placeholder','required');
                return false;
        }else{
           $("#datepicker1").css('border-color','black','color:','black');
        }
            $("#formid").submit();
			   
  });
});		  

 //******catagory type********//
  function validatefields() { //alert("hi");
	  
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			   if($("#room_type").val()==''){
                $("#room_type").css('border-color','red','color:','red');
                 $("#room_type").attr('placeholder','required');
                return false;
        }else{
           $("#room_type").css('border-color','black','color:','black');
        }
        
          if(isNaN($("#max_person").val()) || $("#max_person").val()==''){
                $("#max_person").css('border-color','red','color:','red');
         if($("#max_person").val()==''){ $("#max_person").attr('placeholder','required'); } else {  $("#max_person").val('');
                $("#max_person").attr('placeholder','only number'); }
                return false;
        }else{
            $("#max_person").css('border-color','black','color:','black');
        }
        
           if(isNaN($("#adults").val()) || $("#adults").val()==''){
                $("#adults").css('border-color','red','color:','red');
       if($("#adults").val()==''){ $("#adults").attr('placeholder','required'); } else {  $("#adults").val('');
                $("#adults").attr('placeholder','only number'); }
                return false;
        }else{
            $("#adults").css('border-color','black','color:','black');
        }

            if(isNaN($("#childs").val()) || $("#childs").val()==''){
                $("#childs").css('border-color','red','color:','red');
                if($("#childs").val()==''){ $("#childs").attr('placeholder','required'); } else {  $("#childs").val('');
                $("#childs").attr('placeholder','only number'); }
                return false;
        }else{
            $("#childs").css('border-color','black','color:','black');
        }
        
          if(isNaN($("#infants").val()) || $("#infants").val()==''){
                $("#infants").css('border-color','red','color:','red');
                if($("#infants").val()==''){ $("#infants").attr('placeholder','required'); } else {  $("#infants").val('');
                $("#infants").attr('placeholder','only number'); }
                return false;
        }else{
            $("#infants").css('border-color','black','color:','black');
        }
        
          if(isNaN($("#extra_bed").val()) || $("#extra_bed").val()==''){
                $("#extra_bed").css('border-color','red','color:','red');
                if($("#extra_bed").val()==''){ $("#extra_bed").attr('placeholder','required'); } else {  $("#extra_bed").val('');
                $("#extra_bed").attr('placeholder','only number'); }
                return false;
        }else{
            $("#extra_bed").css('border-color','black','color:','black');
        }
            $("#form_add").submit();

 }
