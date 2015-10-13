/*
#################################### jQuery UI Slider #######################################
### 											  ###
###  Programmed By: Khadharvalli K, khadharvalli.provab@gmail.com                                        ###
###  Powered By   : Provab Technosoft pvt ltd, Bangalore, India.                          ###
### 											  ###
### ====================================================================================  ###
###  Copy this code to your application and call "setPriceSlider() function in  ready     ###
###  state.                                                                               ###
### 											  ###	
###	::  Necessary hidden calls from integration page ::                               ###
###	Ex: <input type="hidden" id="setMinPrice" value="10" />                           ###
###         <input type="hidden" id="setMaxPrice" value="700" />                          ###
###         <input type="hidden" id="setCurrency" value="MAD" />                          ###
### 											  ###
#############################################################################################
 */

function setPriceSlider()
{
    var setPriceMin=parseFloat($("#setMinPrice").val());
    var setPriceMax=parseFloat($("#setMaxPrice").val());
    var currency=$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{	
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html(currency+' '+ ui.values[ 0 ] + " to "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html(currency+' '+$selector.slider( "values", 0 ) + " To "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

function priceSorting()
{
    $("#priceSlider.ui-slider").bind( "slidestop", function() 
    {	
        filter();
    });
}

function filter()
{	 	
    $minPr=parseFloat($("#minPrice").val());
    $maxPr=parseFloat($("#maxPrice").val());   
    
    $stars=new Array;    
    $(".stars:checked").each(function()
    {
        $starNum=$(this).val();
        $stars.push($starNum); 
    }); 

	$acctype=new Array; 
	$(".acctype:checked").each(function()
    {
		$acctype.push($(this).val()); 
    }); 
    
    $location=new Array; 
	$(".location:checked").each(function()
    {
		$location.push($(this).val()); 
    }); 
	
	$amenityFac=new Array; 
	$(".amenity:checked").each(function()
    {
		$amenityFac.push($(this).val()); 
    }); 
    
    $pricetypes=new Array;    
    $(".prices:checked").each(function()
    {       
        $pricetypes.push($(this).val()); 
    }); 
    
    $room=new Array;    
    $(".room_servces:checked").each(function()
    {       
       $room.push($(this).val()); 
    }); 
    
    $other_amen=new Array;    
    $(".other_servces:checked").each(function()
    {       
       $other_amen.push($(this).val()); 
    }); 
     
  	hotelCount = 0;
    $(".HotelInfoBox").each(function()
    {	   
        //$dataprice=parseFloat($(this).attr("data-price"));        
       
		$datastar=$(this).attr("data-star");
		var starShow=$.inArray($datastar, $stars)>=0?true:false;
		
		$dataloc=$(this).attr("data-location");
		var locShow=$.inArray($dataloc, $location)>=0?true:false;
		
		$dataacmptype=$(this).attr("data-acmptype");
		var typeShow=$.inArray($dataacmptype, $acctype)>=0?true:false;
		
		$amenity=$(this).attr("data-hotelamenity");
		$amenarray = $amenity.split(',');
		
		var amenityShow = false;        
        for(var i=0; i<($amenarray.length); i++)
        {
			if($.inArray($amenarray[i], $amenityFac)>=0) 
            {	
				amenityShow = true;
            }
        }
        
        $roomservices=$(this).attr("data-roomservices");
		$roomserArray = $roomservices.split(',');
		
		var rmamenityShow = false;        
        for(var i=0; i<($roomserArray.length); i++)
        {
			if($.inArray($roomserArray[i], $room)>=0) 
            {	
				rmamenityShow = true;
            }
        }
       
        $other_services=$(this).attr("data-otherfac");
		$otherserArray = $other_services.split(',');
		
		var otheserShow = false;        
        for(var i=0; i<($otherserArray.length); i++)
        {
			if($.inArray($otherserArray[i], $other_amen)>=0) 
            {	
				otheserShow = true;
            }
        }
       
        $datapricetype=$(this).attr("data-pricetype");      
		var priceShow=$.inArray($datapricetype, $pricetypes)>=0?true:false;
		
		if($stars.length === 0)
        {
			starShow = true;
		}
		
		if($acctype.length === 0)
        {
			typeShow = true;
		}
		
		if($location.length === 0)
        {
			locShow = true;
		}
		
		if($amenityFac.length === 0)
        {
			amenityShow = true;
		}
		
		if($room.length === 0)
        {
			rmamenityShow = true;
		}
		
		if($other_amen.length === 0)
        {
			otheserShow = true;
		}
		
		
		if($pricetypes.length === 0)
        {
			priceShow = true;
		}
		
		
		
		if(starShow && typeShow && amenityShow && priceShow && rmamenityShow && otheserShow && locShow)
		{
			hotelCount++;
			$(this).parents(".searchhotel_box").show();
		}
		else
		{
			$(this).parents(".searchhotel_box").hide();			
		} 
		       
				
    });  
    
    $("#hotelCount").text(hotelCount);	         
      
}

