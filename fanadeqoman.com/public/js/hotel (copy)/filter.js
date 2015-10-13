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
    
    /*$locations=new Array;    
    $(".locations:checked").each(function()
    {
        $locationName=$(this).val();
        $locations.push($locationName); 
    }); 

    $facilities=new Array;    
    $(".Facility:checked").each(function()
    {
        $facilityId=$(this).val();
        $facilities.push($facilityId); 
    });*/   
  	
    hotelCount = 0;
    $(".HotelInfoBox").each(function()
    {	   
        //$dataprice=parseFloat($(this).attr("data-price"));        
       
		$datastar=$(this).attr("data-star");
		var starShow=$.inArray($datastar, $stars)>=0?true:false;
		
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
        
        $datapricetype=$(this).attr("data-pricetype");      
		var priceShow=$.inArray($datapricetype, $pricetypes)>=0?true:false;
		
		/*$datalocation=$(this).attr("data-location");
		var locationShow=$.inArray($datalocation, $locations)>=0?true:false;

		$datafacility = $(this).attr("data-facilityId");
		$facarray = $datafacility.split(',');
		
        $facShow = false;        
        for(var i=0; i<($facarray.length); i++)
        {
            if($.inArray($facarray[i], $facilities)>=0) 
            {				
                $facShow = true;
            }
        }*/
        
        if($stars.length === 0)
        {
			starShow = true;
		}
		
		if($acctype.length === 0)
        {
			typeShow = true;
		}
		
		if($amenityFac.length === 0)
        {
			amenityShow = true;
		}
		
		if($pricetypes.length === 0)
        {
			priceShow = true;
		}
		
		/*if($locations.length === 0)
        {
			locationShow = true;
		}
		
		if($facilities.length === 0)
        {
			$facShow = true;
		}*/
		
                      
		if(starShow && typeShow && amenityShow && priceShow)
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

