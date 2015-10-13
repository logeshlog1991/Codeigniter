<?php
	$combination=$this->session->userdata('hotel_search_data');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>fanadeqoman</title>
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
		<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/common.css">
		<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css">
		
		<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
		<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
		<style>
			.pageinactive { color: #00B0F0;
				background-color: #fff;
				padding: 6px 12px;
				border: 1px solid lightblue;
			}
			.pageinactive:last-child{ color: #000;
				border: medium none;
				padding: 6px 10px;
				border:1px solid lightgray;
				background-color: rgba(221, 221, 221, 1);
			}
			.pageactive {
				color: #fff;
				background-color: #00B0F0;
				padding: 6px 12px;
				border: 1px solid lightblue;
			}
			</style>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
			<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/validation1.js"></script>
			<script>
			$(document).ready(function(){
				$("div p.pagination strong").addClass("pageactive");
				$("div p.pagination a").addClass("pageinactive");
			});
				</script>
		</head>
<body>
<div class="wrapper">
	<?php $this->load->view('header_main'); ?>

		<!-- modify search-->
		<div class="container">
			<form method="post" name="search" id="search" action="<?php echo site_url();?>/hotel/results" onsubmit="return formValidation()">
			<div class="modifybox">
				<div class="row">
					<div class="col-lg-3">
						<div class="mofind"><?php echo $this->lang->line('find_your_hotel'); ?></div>
							<div class="input-group">
								<span class="input-group-addon"><i class=" icon-map-marker"></i></span>
								<input type="text" id="searchid1" name="searchid1"  class="form-control border-right" value="<?php echo $combination['cityname'];?>" placeholder="Region , Town , Hotel Name">
								<input type="hidden" id="searchid" name="searchid"  class="form-control border-right" value="<?php echo $combination['city_id'];?>">
							</div>
							<div id="destination" style="color:red;"></div>
							</div> 
							<div class="col-lg-2 modpad">
								<div class="input-group">
									<span class="input-group-addon"><i class="icon-calendar"></i></span>
									<input type="text" id="datepicker" name="checkin" class="form-control border-right" value="<?php echo $combination['checkin'];?>" placeholder="Check In" >
								</div>
								<div id="checkinDatepicker" style="color:red;"></div>
							</div>
						   <div class="col-lg-2 modpad">
								<div class="input-group">
									<input type="text" id="datepicker1" name="checkout" class="form-control border-left" value="<?php echo $combination['checkout'];?>" placeholder="Check Out" >
									<span class="input-group-addon"><i class="icon-calendar"></i></span>
							   </div>
							   <div id="checkoutDatepicker" style="color:red;"></div>
						   </div>
                           <div class="col-lg-4" >
							<select class="mosearch" style="float:left;margin-top:40px;" id="room" name="room" onchange="RoomChanges()">
									<option>Rooms</option>
									<option value="1" <?php if(isset($combination['rooms'])){ if($combination['rooms']==1){ echo 'selected="selected"';} } ?>>1</option>
									<option value="2" <?php if(isset($combination['rooms'])){ if($combination['rooms']==2){ echo 'selected="selected"';} } ?>>2</option>
									<option value="3" <?php if(isset($combination['rooms'])){ if($combination['rooms']==3){ echo 'selected="selected"';} } ?>>3</option>
								</select>
								<?php $j=1; for($i=0;$i<$combination['rooms'];$i++){ ?>
								<div id="AC" >
									 <select class="mosearch" style="float:right; margin-top:40px; margin-right:18px;" name="child[]" id="child<?php echo $j; ?>" onchange="childFuns(<?php echo $j; ?>)">
										<option>Child</option>
										<option value="1" <?php if($combination['childs'][$i]==1){ echo 'selected="selected"'; } ?> >1</option>
										<option value="2" <?php if($combination['childs'][$i]==2){ echo 'selected="selected"'; } ?> >2</option>
										<option value="3" <?php if($combination['childs'][$i]==3){ echo 'selected="selected"'; } ?>>3</option>
									  </select>
                                        
                                      <select name="adult[]" id="adult" class="mosearch" style="float:right; margin-top:40px;" >
										<option>Guests</option>
										<option value="1" <?php if($combination['adults'][$i]==1){ echo 'selected="selected"'; } ?> >1</option>
										<option value="2" <?php if($combination['adults'][$i]==2){ echo 'selected="selected"'; } ?>>2</option>
										<option value="3" <?php if($combination['adults'][$i]==3){ echo 'selected="selected"'; } ?>>3</option>
									 </select>
									  <div id="child_age<?php echo $j; ?>">
											<?php $l=1;
												if(isset($combination['childs'][$i])){
													for($k=0;$k<$combination['childs'][$i];$k++){
											?>
											<div class="clearfix mt10">
											  <select name="child_age[]" id="child_age" style="margin-right:18px; margin-top:10px;float:right;" class="mosearch" >
												<option>Child Age</option>
												<option value="1" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==1){ echo 'selected="selected"'; } } ?>>1</option>
												<option value="2" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==2){ echo 'selected="selected"'; } } ?>>2</option>
												<option value="3" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==3){ echo 'selected="selected"'; } } ?>>3</option>
												<option value="4" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==4){ echo 'selected="selected"'; } } ?>>4</option>
												<option value="5" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==5){ echo 'selected="selected"'; } } ?>>5</option>
												<option value="6" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==6){ echo 'selected="selected"'; } } ?>>6</option>
												<option value="7" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==7){ echo 'selected="selected"'; } } ?>>7</option>
												<option value="8" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==8){ echo 'selected="selected"'; } } ?>>8</option>
												<option value="9" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==9){ echo 'selected="selected"'; } } ?>>9</option>
												<option value="10" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==10){ echo 'selected="selected"'; } } ?>>10</option>
												<option value="11" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==11){ echo 'selected="selected"'; } } ?>>11</option>
												<option value="12" <?php if(isset($combination['childs_ages'][$i][$k])){ if($combination['childs_ages'][$i][$k]==12){ echo 'selected="selected"'; } } ?>>12</option>
											  </select>
											</div>
											<?php 
													}
												} 
											?>
									  </div>
								<?php $j++; } ?>
                               </div><!-- ac dnd-->
						</div>
                        <div class="col-lg-1 pull-right">
							<div style="float:right; margin-top:38px;margin-bottom:10px;"><input type="submit" class="fobutton" value="Search"></div>
                        </div>
					</div>
           </div>
		</div>
		</form>
		</div>
		<!-- modify search end-->
	<div class="container"> 
		<!-- Main Title-->
			<div class="row mt10">
				<!-- left side-->
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt40column"> 
						<div class="well filtertxt"><?php echo $this->lang->line('filter_by'); ?></div>
						<!--Accomodation Type-->        
						 <div>
							  <h3 class="heading3 togglehandle"><?php echo $this->lang->line('Accomodation_Type'); ?></span></h3>
							  <ul class="nav nav-list categories toggledata">
								 <?php 
										if(isset($acc_type) && $acc_type!=''){ 
											foreach($acc_type as $type){
								 ?> 
									<li><h4 class="font16"><input type="checkbox" name="acctype" class="acctype" onclick="return filter();" value="<?php echo $type->h_no; ?>"><span class="ml15"><?php echo $type->hotel_type; ?></span></h4></li>
								<?php
											}
										}
								 ?>
							  </ul>
						</div>
						<!--Accomodation Type end-->  
						<!--Price Range -->        
						<div>
						  <h3 class="heading3 togglehandle"><span class="maintext"><?php echo $this->lang->line('Price_Range'); ?></span></h3>
						  <ul class="nav nav-list categories toggledata">
							<li><h4 class="font16"><input type="checkbox" name="price" class="prices" value="price1" onclick="return filter();" /><span class="ml15">0&nbsp;-&nbsp;200</span></h4></li>
							<li><h4 class="font16"><input type="checkbox" name="price" class="prices" value="price2" onclick="return filter();" /><span class="ml15">201&nbsp;-&nbsp;500</span></h4> </li>
							<li><h4 class="font16"><input type="checkbox" name="price" class="prices" value="price3" onclick="return filter();" /><span class="ml15">501&nbsp;-&nbsp;750</span></h4> </li>
							<li><h4 class="font16"><input type="checkbox" name="price" class="prices" value="price4" onclick="return filter();" /><span class="ml15">751&nbsp;-&nbsp;1000</span></h4> </li>
							<li><h4 class="font16"><input type="checkbox" name="price" class="prices" value="price5" onclick="return filter();" /><span class="ml15">1000&nbsp;+</span></h4> </li>
						  </ul>
					    </div>
						<!--Price Range end-->  
						<!--Hotel Star Rating -->        
						<div>
						  <h3 class="heading3 togglehandle"><span class="maintext"><?php echo $this->lang->line('star'); ?></span></h3>
						  <ul class="nav nav-list categories toggledata">
							<li><h4 class="font16"><input type="checkbox" name="starrating" class="stars" value="1" onclick="return filter();" /><span class="ml15"><i class="icon-star"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;<i class="icon-star-empty"></i></span></h4></li>
							<li><h4 class="font16"><input type="checkbox" name="starrating" class="stars" value="2" onclick="return filter();" /><span class="ml15"><i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;</span></h4> </li>
							<li><h4 class="font16"><input type="checkbox" name="starrating" class="stars" value="3" onclick="return filter();" /><span class="ml15"><i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star-empty"></i>&nbsp;<i class="icon-star-empty"></i></span></h4> </li>
							<li><h4 class="font16"><input type="checkbox" name="starrating" class="stars" value="4" onclick="return filter();" /><span class="ml15"><i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star-empty"></i></span></h4> </li>
							<li><h4 class="font16"><input type="checkbox" name="starrating" class="stars" value="5" onclick="return filter();" /><span class="ml15"><i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star"></i>&nbsp;<i class="icon-star"></i></span></h4> </li>
						  </ul>
						</div>
						<!--Hotel Star Rating end-->  
						 <!--Location -->        
						<div>
						  <h3 class="heading3 togglehandle"><span class="maintext"><?php echo $this->lang->line('Location'); ?></span></h3>
						  <ul class="nav nav-list categories toggledata">
							 <?php 
								  if(isset($location) && $location!=''){
									  $i=0;
									  foreach($location as $loc)
									  {
										  if($loc->location_name!=''){
							?>
							<li><h4 class="font16"><input type="checkbox" name="location" class="location" onclick="return filter();" value="<?php echo $loc->loc_sno; ?>"><span class="ml15"><?php echo $loc->location_name; ?></span></h4></li>
							<?php
										  }
									  $i++; 
									  }
							      } 
							?>
						 </ul>
						</div>
						<!--Location end-->  
						 <!--Amenities -->        
						<div>
						  <h3 class="heading3 togglehandle"><span class="maintext"><?php echo $this->lang->line('Hotel_Amenities'); ?></span></h3>
						  <ul class="nav nav-list categories toggledata">
							<?php 
								  if(isset($hotel_amen) && $hotel_amen!=''){
									  foreach($hotel_amen as $amenity)
									  {
							?>
							<li><h4 class="font16"><input type="checkbox" name="amenity" class="amenity" onclick="return filter();" value="<?php echo $amenity->amenity_list_id; ?>"><span class="ml15"><?php echo $amenity->amenity_name; ?></span></h4></li>
							<?php
									  }
							      } 
							?>
							</ul>
						</div>
						<!--Amenities end--> 
						<!--Room Facilities -->        
						<div>
						  <h3 class="heading3 togglehandle"><span class="maintext"><?php echo $this->lang->line('Room_Facilities'); ?></span></h3>
						   <ul class="nav nav-list categories toggledata">
							   <?php
									if(isset($room_amen) && $room_amen!=''){
									  foreach($room_amen as $rm_amen)
									  {
								?>
									<li><h4 class="font16"><input type="checkbox" name="room_servces" class="room_servces" onclick="return filter();" value="<?php echo $rm_amen->sup_fac_id; ?>"><span class="ml15"><?php echo $rm_amen->facility_name; ?></span></h4></li>
							<?php
									  }
							      } 
							?>
						   </ul>
						</div>
						<!--Room Facilities end--> 
						<!--Others-->        
						<div>
						  <h3 class="heading3 togglehandle"><span class="maintext"><?php echo $this->lang->line('Others'); ?></span></h3>
						  <ul class="nav nav-list categories toggledata">
							  <?php
									if(isset($other_amen) && $other_amen!=''){
									  foreach($other_amen as $amen_other)
									  {
								?>
								<li><h4 class="font16"><input type="checkbox" name="other_servces" class="other_servces" onclick="return filter();" value="<?php echo $amen_other->others_id; ?>"><span class="ml15"><?php echo $amen_other->others_name; ?></span></h4></li>
							<?php
									  }
							      } 
							?>
						  </ul>
						</div>
						<!--Others end--> 
				</div>
				<!-- left side end-->
				<!-- right side-->
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mt40column">
				<!--Sorting-->
				<div class="sorting well" style="background:#B5EBFF !important">
				  <form class=" form-inline pull-left col-lg-8 col-xs-12">
					<span class=" col-lg-4 col-xs-12 sorttxt"><?php echo $this->lang->line('sort'); ?> </span>
					<div class="col-lg-4 col-xs-12">
						<select class="pull-right"  placeholder="Price" name="price" id="price" >
						  <option value=""><?php echo $this->lang->line('price_range'); ?></option>
						  <option class="HotelSorting" data-order="asc" rel="data-price" title="Sort By Price" href="javascript:void(0);" value="0" <?php if($this->uri->segment(3)==0){ echo "selected=selected"; }?>>Min - Max</option>
						  <option class="HotelSorting" data-order="desc" rel="data-price" title="Sort By Price" href="javascript:void(0);" value="1" <?php if($this->uri->segment(3)==1){ echo "selected=selected"; }?>>Max - Min</option>
						</select>
					</div>
					<div class="col-lg-4 col-xs-12">
						 <select  class="pull-right" placeholder="Rating" name="rate" id="rate" >
						  <option value=""><?php echo $this->lang->line('star_rating'); ?></option>
						  <option class="HotelSorting" data-order="asc" rel="data-star" title="Sort By StarRating" href="javascript:void(0);" value="3" <?php if($this->uri->segment(3)==3){ echo "selected=selected"; }?>>Min - Max</option>
						  <option class="HotelSorting" data-order="desc" rel="data-star" title="Sort By StarRating" href="javascript:void(0);" value="4" <?php if($this->uri->segment(3)==4){ echo "selected=selected"; }?>>Max - Min</option>
						</select>
					</div>
				  </form>
				  <div class=" col-lg-4 col-xs-12  serachresultsc pull-right"><?php echo $this->lang->line('Search_Results'); ?> : <span id="hotelCount"><?php if(isset($room_info[0]) && $room_info[0]!=''){  echo $room_info[1][0]->ffff; } else { echo '0'; }?></span></div>       
				</div>
        
				<!-- list container-->
				<div class="featureprojectcontianer mt40" id="productlist">
					<!-- list view-->
					<div class="list" id="list_result">
						<ul class="mt40 clearfix resultHotels">
						<!--1-->
						 <?php 
								if($room_info!='') {
									for($i=0;$i<count($room_info[0]);$i++) {
										$gate_way=$this->Hotel_Model->payment_gateway();	
										$final_rate1=($gate_way/100)*$room_info[0][$i]->sell_price+$room_info[0][$i]->sell_price;	
										$final_rate=round($final_rate1);   
									if($final_rate >=1 && $final_rate <= 200)
										$price_type = 'price1';
									else if($final_rate >=201 && $final_rate <= 500)
										$price_type = 'price2';
									else if($final_rate >=501 && $final_rate <= 750)
										$price_type = 'price3';
									else if($final_rate >=751 && $final_rate <= 1000)
										$price_type = 'price4';
									else if($final_rate >=1001)
										$price_type = 'price5';
										
									$hotel_loc=unserialize($room_info[0][$i]->hotel_loc);
									$res1='';$val_loc='';
									foreach($hotel_loc as $val){
										$res=$this->Hotel_Model->detail_location($val);
										$val_loc=$val_loc.$val.',';
										$res1=$res1.$res.',';
									}	
						?>
							<div class="searchhotel_box">
								
							  <li class="clearfix HotelInfoBox" data-location="<?php echo rtrim($val_loc,','); ?>" data-acmptype="<?php echo $room_info[0][$i]->hotel_type; ?>" data-star="<?php echo $room_info[0][$i]->star; ?>" data-hotelamenity="<?php if(isset($room_info[0][$i]->hotel_amenity) && $room_info[0][$i]->hotel_amenity!=''){ $val=''; $arr=unserialize($room_info[0][$i]->hotel_amenity);foreach($arr as $value){ $val=$val.$value.',';} $amen=rtrim($val,',');echo $amen; } ?>" data-roomservices="<?php if(isset($room_info[0][$i]->hotel_room_services) && $room_info[0][$i]->hotel_room_services!=''){ $val1=''; $arr1=unserialize($room_info[0][$i]->hotel_room_services);foreach($arr1 as $value1){ $val1=$val1.$value1.',';} $amen1=rtrim($val1,',');echo $amen1; } ?>" data-otherfac="<?php if(isset($room_info[0][$i]->hotel_busines) && $room_info[0][$i]->hotel_busines!=''){ $val1=''; $arr1=unserialize($room_info[0][$i]->hotel_busines);foreach($arr1 as $value1){ $val1=$val1.$value1.',';} $amen1=rtrim($val1,',');echo $amen1; } ?>" data-price="<?php echo $final_rate; ?>" data-pricetype="<?php echo $price_type; ?>">
								<div class="thumbnail">
								  <div class="listclear">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									  <div class="relativediv"><img src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $room_info[0][$i]->main_image?>" alt=" image">
									  </div>
									</div>
									<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
									 <div class="caption"><h3 style="margin-bottom:0px;"><a href=""></a><?php echo $room_info[0][$i]->hotel_name;?></a></h3></div>
									 <div class="clearfix"></div>
									<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="padding-left:0px;">
											<div class="address1">
												<div class="wid100"> 
													<span class="text-center">
														<?php 
															if($room_info[0][$i]->star!='unrated'){ 
																for($j=0;$j<$room_info[0][$i]->star;$j++) { ?>
															<i class="icon-star font12"></i>
														<?php  
																}
															}
														?>
														
													</span>
												</div>
												<div class="mt5">
													<?php echo $room_info[0][$i]->address;?>
												</div>
												<div class="mt5">
													<?php echo $room_info[0][$i]->city_name.','.$room_info[0][$i]->name.'.';?>
												</div>
												<div class="mt5">
													<?php 
															echo '<span style="font-size:small;color:#00B0F0">Loaction:</span> '.rtrim($res1,',').'.';
													?>
												</div>
												<!--<div class="mt5">
													<?php echo '<span style="font-size:small;color:#00B0F0">Nearby Airport:</span> '.$room_info[0][$i]->nearby_airport.'.';?>
												</div>-->
											  </div>                       
									 </div>
										<!-- col-4-->
									   <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="padding-left:0px;">
									   <div class="#mt25 pull-left text-left">
									   <div class="bluetxt">
										   <?php 
												$room_t='';
												echo $room_t=$this->Hotel_Model->get_roomCategory($room_info[0][$i]->category_type);
										   ?>
									   </div>
										   <?php 
												$var4=unserialize($room_info[0][$i]->hotel_room_services); 
												for($k=0;$k<count($var4);$k++) { 
													$z=count($var4)-1;
													if($z!=$k){
										   ?>
													<div class="mt5"><?php echo $this->Hotel_Model->hotel_room_services($var4[$k]).',';?></div>
													<?php 
														}else{ 
													?>
													<div class="mt5"><?php echo $this->Hotel_Model->hotel_room_services($var4[$k]);?></div>
													<?php
														}
													?>
										   <?php
												}
										   ?>
									   </div>
										<div class="clearfix"></div>
									 </div>   
									</div>
									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  pull-right">
										  <div class="  text-right">
										  <div class="roomrate">
											  <?php echo '$'.$final_rate; ?>
										  </div>
										 <div>R.O / Night</div>
										  </div>
										  <div class=" clearfix m5">
											  <form method="post" action="<?php echo WEB_URL; ?>hotel/hotel_details" >
													<input type="hidden" name="hotel_id" value="<?php echo $room_info[0][$i]->sup_hotel_id; ?>" />							  
													<a href="<?php echo WEB_URL; ?>hotel/hotel_details/<?php echo $room_info[0][$i]->sup_hotel_id; ?>/<?php echo $room_info[0][$i]->sup_rate_tactics_id; ?>" class="btn btn-blue wid100  addtocartbutton pull-right"> Book Now </a>
											  </form>
										  </div>
										</div>
										  <!-- tabs-->
										  <div class="row clearfix">
										  <ul id="myTab<?php echo $i; ?>" class="nav nav-tabs noborder" style="margin-top:0px !important" title="<?php echo $i; ?>">
											<li class="col-lg-2 col-xs-5 mb0" title="<?php echo $i;?>">
													<a class="noborder abc" href="javascript:void(0);" onclick="pop_up('photos<?php echo $i;?>')">
														<i class="icon-picture"></i>
														 Photos
													</a> 
											</li>
											<li class="col-lg-3 col-xs-5 mb0" title="<?php echo $i;?>">
													<a class="noborder abc pull-right" href="javascript:void(0);" onclick="pop_up('map<?php echo $i;?>')">
														<i class="icon-map-marker"></i> 
														Location Map
													</a>
											</li>
											<li class="col-lg-3 col-xs-5 mb0" title="<?php echo $i;?>">
													<a class="noborder abc pull-right" href="javascript:void(0);" onclick="pop_up('hotelfacilities<?php echo $i;?>')">
														<i class="icon-smile"></i>
														 Hotel Facilities
													</a> 
											</li>
											<li class="col-lg-4 col-xs-7 mb0" title="<?php echo $i;?>">
														<a class="noborder abc  pull-right" href="javascript:void(0);" onclick="pop_up('viewrates<?php echo $i;?>')">
															<i class="icon-eye-open"></i>
																View All Rooms & Rates
														</a>
										   </li>
										  </ul>
												<div class="tab-content  noborder dispn" id="tab<?php echo $i;?>" style=" border-top:1px dashed lightgray !important">
													<!-- photos-->          
													<div class="tab-pane" id="photos<?php echo $i;?>">
														<div class="pull-right">
															 <a onclick="removeFun('<?php echo $i; ?>')">
																 <i class="icon-remove-sign pull-right font24 gray"></i>
															 </a> 
														</div>
														<div style="padding:30px;">
															<div class="col-lg-3 col-xs-8"><img class="photothumb" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $room_info[0][$i]->image1;?>"></div>
															<div class="col-lg-3 col-xs-8"><img class="photothumb" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $room_info[0][$i]->image2;?>"></div>
															<div class="col-lg-3 col-xs-8"><img class="photothumb" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $room_info[0][$i]->image3;?>"></div>
														</div>
													</div>
													<!-- photos end--> 
													<!-- map-->
													<div class="tab-pane" id="map<?php echo $i;?>">
													   <div class="pull-right"> 
														 <a onclick="removeFun('<?php echo $i; ?>')">
															 <i class="icon-remove-sign pull-right font24 gray"></i>
														</a> 
													   </div>
														 <input type="hidden" name="latitude" id="lat<?php echo $i;?>" class="MapLat" value="<?php if($room_info[0][$i]->latitude!='') { echo $room_info[0][$i]->latitude; }else { echo '20.173866'; } ?>">
														 <input type="hidden" name="longitude" id="long<?php echo $i;?>" class="MapLon" value="<?php if($room_info[0][$i]->longitude!='') { echo $room_info[0][$i]->longitude; }else { echo '56.561647'; } ?>" >
													   <div class="col-lg-offset-2 col-lg-8 grayborder mh250" id="map_canvas<?php echo $i;?>">
														   
													   </div>
													</div>
													<!-- map end--> 
													<!-- hotelfacilities-->
													<div class="tab-pane" id="hotelfacilities<?php echo $i;?>">
														 <div class="pull-right"> 
																<a onclick="removeFun('<?php echo $i; ?>')">
																	<i class="icon-remove-sign pull-right font24 gray"></i>
																</a> 
														 </div>
														 <div style="padding:30px;">
															 <?php 
																$var = unserialize($room_info[0][$i]->hotel_amenity);
																	//$var = $room_info[0][$i]->hotel_amenity;
																for($k=0;$k<count($var);$k++) {?>
																	<div class="col-lg-4 text-left"> 
																		<p>
																			<i class="icon-paper-clip mr10"></i>
																			<?php echo $this->Hotel_Model->hotel_amenity($var[$k]); ?>
																		</p>
																	</div>
															 <?php } ?>
															 
															 <?php 
																	if(isset($room_info[0][$i]->hotel_busines) && $room_info[0][$i]->hotel_busines!=''){
																	$var1 = unserialize($room_info[0][$i]->hotel_busines);
																		for($k=0;$k<count($var1);$k++) {
															 ?>
																	<div class="col-lg-4 text-left"> 
																		<p>
																			<i class="icon-paper-clip mr10"></i>
																			<?php echo $this->Hotel_Model->other_accommodation($var1[$k]); ?>
																		</p>
																	</div>
															<?php 
																		}
																	}
															?>      
														</div>
													</div>
													<!-- hotelfacilities end--> 
									<!-- viewrates-->
									<div class="tab-pane" id="viewrates<?php echo $i;?>">
										<div class="pull-right">
											 <a onclick="removeFun('<?php echo $i; ?>')">
												 <i class="icon-remove-sign pull-right font24 gray"></i>
											 </a>
									    </div>
										<div class="col-sm-12 col-xs-12">
											  <table class="table table-hover grayborder">
													<thead class="graybg">
													  <tr>
														<th>Room Type</th>
														<th>Max Person</th>
														<th>Facilities</th>
														<th>Status</th>
														<th>Rate / Night</th>
													  </tr>
													</thead>
													<tbody>
													  <tr>
														<td>
															<?php 
																echo $room_info[0][$i]->hotel_room_type; 
															?> 
															<?php //echo $room_t?><?php //$room_info[0][$i]->room_type;?><!--0<br><a data-toggle="modal" href="#myModal1"><h6>Room Details</h6></a>--></td>      
														<td>
															<?php 
																echo $room_info[0][$i]->capacity_title; 
															?> 
															<?php
																//$room_type=$this->Hotel_Model->get_room_type($room_info[0][$i]->room_type); 
																//echo $room_type->capacity_title;
																//$max=explode('(',$room_info[0][$i]->room_type); $max_person=explode(',',$max[1]);
																//for($j=0;$j<$max_person[0];$j++) {
															?>
																<!--<i class="icon-male"></i>-->
															<?php
																//}
															?>
														</td>
														<td>
															<?php 
																$var3=unserialize($room_info[0][$i]->hotel_room_services); 
																for($k=0;$k<count($var3);$k++) {
															?>
															<?php 
																	if($k>1){
																		echo '<br>';
																	} 
																	echo $this->Hotel_Model->hotel_room_services($var3[$k]).',';
																}
															?>
														</td>
														<td><?php if($room_info[0][$i]->status==1) { echo 'Available'; } else { echo 'Unavailable';} ?></td>
														<td><i class="icon-dollar"></i>                  
													 <?php  echo $final_rate;?><!--<br><a data-toggle="modal" href="#myModal"><h6>Cancellation Policy</h6></a>--></td>
													  </tr>
													</tbody>
											  </table>
										</div>
										<!-- cancelation policy modal window-->
										<section id="modals">
										 <!-- Modal -->
										  <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
											<div class="modal-dialog">
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												  <h4 class="modal-title">Cancellation Policy</h4>
												</div>
												<div class="modal-body"> <?php echo $room_info[0][$i]->cancel_policy_desc;?> </div>
												<div class="modal-footer">
												 
												</div>
											  </div>
											  <!-- /.modal-content --> 
											</div>
											<!-- /.modal-dialog --> 
										  </div>
										  <!-- /.modal --> 
										  <!-- cancelation policy modal window end- ->
										  <!-- room details modal window-->
										</section>
									   <section id="modals">
										 <!-- Modal -->
										  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog"  aria-hidden="true">
											<div class="modal-dialog">
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												  <h4 class="modal-title">Room Details</h4>
												</div>
												<div class="modal-body"><?php echo $room_info[0][$i]->room_desc; ?> </div>
												<div class="modal-footer">
												</div>
											  </div>
											  <!-- /.modal-content --> 
											</div>
											<!-- /.modal-dialog --> 
										  </div>
										  <!-- /.modal --> 
										</section>
										<!-- room details modal window-->    
									</div>
									<!-- viewrates end-->
								</div>
								<!-- tabs end-->       
							</div>  <!-- 12-->        
						   </div>
						  </div>
						 </li>
						 
						 </div>
						 <script>
							$(function () {
								 // window.location ="http://www.google.com";
										var lat = $("#lat<?php echo $i;?>").val(),
											lng = $("#long<?php echo $i;?>").val(),
											latlng = new google.maps.LatLng(lat, lng),
											image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
										var myMarkerIsDraggable = true;
										var geocoder = new google.maps.Geocoder();
										var mapOptions = {
											 center: new google.maps.LatLng(lat, lng),
											 zoom: 13,
											 mapTypeId: google.maps.MapTypeId.ROADMAP,
											 panControl: true,
											 panControlOptions: {
												 position: google.maps.ControlPosition.TOP_RIGHT
											 },
											 zoomControl: true,
											 zoomControlOptions: {
												 style: google.maps.ZoomControlStyle.LARGE,
												 position: google.maps.ControlPosition.TOP_left
											 }
										 },
										 map = new google.maps.Map(document.getElementById('map_canvas<?php echo $i;?>'), mapOptions),
										 marker = new google.maps.Marker({
											position: latlng,
											map: map,
											icon: image,
											draggable: myMarkerIsDraggable
										 });
								});
						</script>
		
						 <?php 
						 }
							 }else{
						 ?>
						  <!-- No Results Found-->
							<div class="well" align="center"><img style="width:40%" src="<?php echo WEB_DIR;?>public/img/noresult.png"></div>
						 <?php } ?>
					</ul>
				</div>
          <!-- list view end-->
             <!-- Paging-->
             <!-- <div class="mt40 clearfix">
            <ul class="pagination pull-right">
				  <li><a >Prev</a></li>
				  <li class="active"><a >1</a></li><li><a >2</a></li><li><a >3</a></li><li><a >4</a></li><li><a >Next</a></li>
              </ul>            
            </div>-->
            <p class="pagination pull-right"><?php if(isset($pagi)) { echo $pagi; } ?></p>
               <!-- Paging end-->
          </div>
        </div>        
       </div>
      <!-- right side end-->
    </div>
 
	<!-- footer-->
	  <?php $this->load->view('footer'); ?>
	<!-- footer end-->
</div>
<script src="<?php echo WEB_DIR;?>public/js/bootstrap.min.js"></script>
<script  src="<?php echo WEB_DIR;?>public/js/jquery.prettyPhoto.js"></script> 
<script src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
 
<!-- Filtering & Sorting -->
<script src="<?php echo WEB_DIR;?>public/js/hotel/filter.js"></script>
<script src="<?php echo WEB_DIR;?>public/js/hotel/sorting.js"></script>
 
	<script>
		var i=0,j=0,k=0,l=0;
	$(document).ready(function(){
	 $('[id^=myTab]>li').click(function(event){
		  var titel = this.title; 
		  $("#tab"+titel).addClass("disp");
		  $("#tab"+titel).removeClass("dispn");
		  
	  });
	 
	   $(".icon-remove-sign").click(function(){
			$("#tab1").removeClass("disp");
			$("#tab1").addClass("dispn");
	   });
	   		$(function(){
					$( "#searchid1" ).autocomplete({
						source: "<?php echo WEB_URL; ?>hotel/search_data",
						minLength: 1, // how many character when typing to display auto complete
						select: function (event, ui) {
                                    stateid = (ui.item.id);
                                    $("#searchid").val(stateid);
                        }
					});
				$.noConflict();
	   	
					$( "#datepicker" ).datepicker({
						minDate:0,
						changeMonth: true,
						numberOfMonths: 1,
						dateFormat: 'dd-mm-yy',
					  onClose: function( selectedDate ) {
						$( "#datepicker1" ).datepicker( "option", "minDate", selectedDate);
						$( "#datepicker1" ).datepicker('setDate',date);
					  }
					});
					$( "#datepicker1" ).datepicker({
					  minDate:0,
					  changeMonth: true,
					  numberOfMonths: 1,
					  dateFormat: 'dd-mm-yy',
					  onClose: function( selectedDate ) { 
						  $("#datepicker").datepicker("option","maxDate",selectedDate);
					  }
					});
				});
	});

	//Tab Why Us
	$('[id^=myTab] a').click(function (e) { var val = (this).title; 
		e.preventDefault()
  		$(this).tab('show');
	})
	$('[id^=myTab] a').tab('show') // Select first tab
	//Tab Why Us
	$('.myTabclass a').click(function (e) {
		e.preventDefault()
  		$(this).tab('show');
	})
	$('.myTabclass a').tab('show') // Select first tab


	function RoomChanges(){
		var adult_child='';
		  for(i=1;i<=$('#room').val();i++){
			  if(i==1){
				  adult_child+='<div><select style="float:right; margin-top:40px;margin-bottom:10px;" name="child[]" id="child'+i+'" class="mosearch" onchange="childFuns('+i+')"><option>Children</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><select name="adult[]" id="adult" class="mosearch" style="float:right; margin-top:40px; margin-bottom:10px;"><option>Guests</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><span id="child_age'+i+'"></span></div>';  
			  }
			  if(i>1)
				adult_child+='<div style="float:right;clear:both;"><select style="float:right; margin-bottom:10px;" name="child[]" id="child'+i+'" class="mosearch" onchange="childFuns('+i+')"><option>Children</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><select name="adult[]" id="adult" class="mosearch" style="float:right;margin-bottom:10px;"><option>Guests</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><span id="child_age'+i+'"></span></div>';  
		  }
		$('#AC').html(adult_child);
	}
	function childFuns(id){
		var child_age='';
		 for(i=1;i<=$('#child'+id).val();i++){
			child_age+='<div class="mt10" style="float:right;clear:both"><select class="mosearch" style="margin-bottom:10px;" name="child_age[]"  id="child_age"><option>Child Age</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div>';
		 }     
		 $('#child_age'+id).html(child_age);     
	}

	
	
function pop_up(id)
{
	var id1 = id.replace ( /[^\d.]/g, '' );
	if('photos'+id1==id)
	{
		$("#"+id).show();
		$("#map"+id1).hide();
		$("#hotelfacilities"+id1).hide();
		$("#viewrates"+id1).hide();
	}else if('map'+id1==id){
		$("#photos"+id1).hide();
		$("#"+id).show();
		$("#hotelfacilities"+id1).hide();
		$("#viewrates"+id1).hide();
	}else if('hotelfacilities'+id1==id){
		$("#photos"+id1).hide();
		$("#map"+id1).hide();
		$("#"+id).show();
		$("#viewrates"+id1).hide();
	}else{
		$("#photos"+id1).hide();
		$("#map"+id1).hide();
		$("#hotelfacilities"+id1).hide();
		$("#"+id).show();
	}
}
function removeFun(id)
{
	$("#tab"+id).removeClass("disp");
	$("#tab"+id).addClass("dispn");
}

</script>
</body>
</html>

