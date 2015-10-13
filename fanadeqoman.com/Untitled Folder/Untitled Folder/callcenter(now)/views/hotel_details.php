<?php
$combination=$this->session->userdata('hotel_search_data');
?>
<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>fanadeqoman</title>
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css"></link>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
    <script>
			function RoomChanges(){
				var adult_child='';
				  for(i=1;i<=$('#room').val();i++){
					  if(i==1){
						  adult_child+='<div><select style="float:right; margin-top:40px;margin-bottom:10px;" name="child[]" id="child'+i+'" class="mosearch" onchange="childFuns('+i+')"><option>Children</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><select name="adult[]" id="adult" class="mosearch" style="float:right; margin-top:40px; margin-bottom:10px;"><option>Guests</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><span id="child_age'+i+'"></span></div>';  
					  }
					  if(i>1)
						adult_child+='<div style="float:right;clear:both;"><select style="float:right; margin-bottom:10px;" name="child[]" id="child'+i+'" class="mosearch" onchange="childFuns('+i+')"><option>Children</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><select name="adult[]" id="adult" class="mosearch" style="float:right;margin-bottom:10px;"><option>Guests</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select><span id="child_age'+i+'"></span></div>';  
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
			function check_avilabless(id)
			{ 
				var hotel_id=$('#hotel_id').val();
				var check_in=$('#datepicker').val();
				var check_out=$('#datepicker1').val();
				var rooms=$('#room').val();
				var nights=$('#nights').val();
				var base_url=$('#web_url').val();
				if($('#check_value'+id).val()==id){
					if(hotel_id!=''){
						$.ajax({
							 url: base_url+"hotel/check_availabilty",
							 type: 'post',
							 data:  {'hotel_id':hotel_id,'check_in':check_in,'check_out':check_out,'rooms':rooms},
							 success: function(output) {
								if(output!=1)
								{
									alert('Rooms are not available');
									return false;
								}else{ 
									$("#formid").submit(); 
								}
							}
						});
					}
				}
			}
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
								<div class="mofind"><?php echo $this->lang->line('update_search'); ?></div>
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
											<input type="text" id="datepicker" name="checkin" class="form-control" value="<?php echo $combination['checkin'];?>" placeholder="Check In" >
										</div>
										<div id="checkinDatepicker" style="color:red;"></div>
									</div>
								   <div class="col-lg-2 modpad">
										<div class="input-group">
											<input type="text" id="datepicker1" name="checkout" class="form-control" value="<?php echo $combination['checkout'];?>" placeholder="Check Out" >
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
											   <select name="child_age[]" id="child_age" style="margin-right:18px; margin-top:10px;float:right;" class="mosearch" style="float:right">
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
							<div class="col-lg-1 pull-right"><div style="float:right; margin-top:38px;margin-bottom:10px;" ><input type="submit" class="fobutton" value="Search"></div></div>
						  </div>	
						</div>
					 </div>
				   </div>
				</div>
			</form>
		</div>
		<!-- modify search end-->
		<!-- hotel details-->
		<div class="container">
			<div class="well">
				<h3 class="orangetxt"><b><?php echo $hotel_info->hotel_name;?></b></h3>
					<p>
						<?php 
							for($j=0;$j<$hotel_info->star;$j++) 
							{ 
						?>
						<span class="mr10"><i class="icon-star font16"></i></span>
						<?php
							}  
							if($j<5) {
								for($k=$j;$k<5;$k++){
						?>
						<span class="mr10"><i class="icon-star-empty font16"></i></span>
						<?php	
								} 
							}
						?>
					</p>
					<p class="font16">
						<?php echo $this->Hotel_Model->get_hotelArea($hotel_info->hotel_area).',';?>
					</p>
					<p class="font16">
						<?php echo $this->Hotel_Model->get_hotelCity($hotel_info->city).', '.$this->Hotel_Model->city_country_name($hotel_info->country).'.';?>
				    </p>
			</div>
		</div>
		<!-- hotel details end-->  
		<!-- slider-->
		<div class="container">
		<div class="well well-sm well-blue "><?php echo $this->lang->line('PHOTOS'); ?></div>
		<!-- Slides Container -->
		<div id="slider3_container" style="position: relative; width: 720px;height: 350px; overflow: hidden; margin-bottom:10px;">
			<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 720px; height: 350px;overflow: hidden;">
				<?php 
					$image=unserialize($hotel_info->image);
					foreach($image as $img){
						if($img!=''){
				?>
				<div>
					<img u="image" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $img;?>" />
					<img u="thumb" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $img;?>" />
				</div>
				<?php
						} 
					}
				?>
			</div>
        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort07" style="position: absolute; width: 720px; height: 100px; left: 0px; bottom: 0px; overflow: hidden; ">
            <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>
            <!-- Thumbnail Item Skin Begin -->
            <style>
               .jssort07 .i {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 99px;
                    height: 66px;
                    filter: alpha(opacity=80);
                    opacity: .8;
                }
				.jssort07 .p:hover .i, .jssort07 .pav .i {
                    filter: alpha(opacity=100);
                    opacity: 1;
                }
				.jssort07 .o {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 99px;
                    height: 66px;
                    border: 1px solid #000;
                    transition: border-color .6s;
                    -moz-transition: border-color .6s;
                    -webkit-transition: border-color .6s;
                    -o-transition: border-color .6s;
                }

                * html .jssort07 .o {
                    /* ie quirks mode adjust */
                    width /**/: 99px;
                    height /**/: 66px;
                }

                .jssort07 .pav .o, .jssort07 .p:hover .o {
                    border-color: #fff;
                }

                .jssort07 .pav:hover .o {
                    border-color: #0099FF;
                }

                .jssort07 .p:hover .o {
                    transition: none;
                    -moz-transition: none;
                    -webkit-transition: none;
                    -o-transition: none;
                }
            </style>
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 99px; HEIGHT: 66px; TOP: 0; LEFT: 0;">
                    <thumbnailtemplate class="i" style="position:absolute;"></thumbnailtemplate>
                    <div class="o">
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
            <!-- Arrow Navigator Skin Begin -->
            <style>
					.jssora11l, .jssora11r, .jssora11ldn, .jssora11rdn {
                        position: absolute;
                        cursor: pointer;
                        display: block;
                        background: url(<?php echo WEB_DIR;?>public/img/a11.png) no-repeat;
                        overflow: hidden;
                    }

                    .jssora11l {
                        background-position: -11px -41px;
                    }

                    .jssora11r {
                        background-position: -71px -41px;
                    }

                    .jssora11l:hover {
                        background-position: -131px -41px;
                    }

                    .jssora11r:hover {
                        background-position: -191px -41px;
                    }

                    .jssora11ldn {
                        background-position: -251px -41px;
                    }

                    .jssora11rdn {
                        background-position: -311px -41px;
                    }
            </style>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssora11l" style="width: 37px; height: 37px; top: 123px; left: 8px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora11r" style="width: 37px; height: 37px; top: 123px; right: 8px">
            </span>
            <!-- Arrow Navigator Skin End -->
        </div>
	</div>
	</div>
		<!-- slider area-->
		<!-- property overview-->
		<div class="container">
		   <div class="well well-sm well-blue"><?php echo $this->lang->line('PROPERTY_OVERVIEW'); ?></div>
		   <div class="well"><?php echo $hotel_info->hotel_desc; ?></div>
		</div>
		<!-- property overview end-->
		<!-- property FACILITIES-->
		<div class="container">
			<div class="well well-sm well-blue"><?php echo $this->lang->line('PROPERTY_FACILITIES'); ?></div>
			<div class="well">
				<?php
					$var =unserialize($hotel_info->hotel_amenity);
					for($k=0;$k<count($var);$k++) { 
						echo '<i class="icon-paper-clip mr10"></i>'.$this->Hotel_Model->hotel_amenity($var[$k]).'<br>'; 
					}
					$var1 = unserialize($hotel_info->hotel_busines);
					//$var1 = $hotel_info->hotel_busines;
					for($k=0;$k<count($var1);$k++) { 
						echo '<i class="icon-paper-clip mr10"></i>'.$this->Hotel_Model->other_accommodation($var1[$k]).'<br>'; 
					} 
				?>
			</div>
		</div>
		<!-- property FACILITIES end-->
		<!-- rooms & Rates-->
		<div class="container">
		   <div class="well well-sm well-blue"><?php echo $this->lang->line('ROOMS'); ?> &amp;<?php echo $this->lang->line('RATES'); ?> </div>
		   <?php 
					$res=$this->Hotel_Model->get_category($hotel_info->sup_hotel_id); 
					if($res!='') {
						$A='';
						for($i=0;$i<count($res);$i++) {			
		   ?>
			<div class="well">
				<div class="row info">
                  <div class="col-sm-4">
					  <?php $cate=$this->Hotel_Model->get_catedetails($res[$i]->category_type); ?>
                     <h4><?php echo $cate->hotel_room_type; ?></h4>
                   <!--  <p><a href="#">Room Details</a></p>-->
                  </div>
                  <div class="col-sm-2 mt20">
					<?php 
							
						 $var3=unserialize($cate->hotel_room_services);
						 if($var3!='') {
							  for($k=0;$k<count($var3);$k++) {
								$t=$this->Hotel_Model->hotel_room_services($var3[$k]).', ';
								$A=$A.$t;
							  } 
						 }
						 echo rtrim($A, ",");
					?>
                  </div>
                  <div class="col-sm-4 ">
                     <div class="row">
						 <?php  $rate=$this->Hotel_Model->get_rate($res[$i]->sup_rate_tactics_id);?>
                        <div class="col-sm-4 col-sm-offset-2 mt10">
							<span class="rate">
								<?php 
									$gate_way=$this->Hotel_Model->payment_gateway();	
									$final_rate=($gate_way/100)*$rate+$rate;	
									echo '$'.round($final_rate);
								?>
							</span>
						</div>
                        <div class="col-sm-6 mt20"><span>R.O / night</span></div>
                     </div>
                  </div>
                  <div class="col-sm-2 mt15">
					  <form id="formid" action="<?php echo WEB_URL;?>hotel/pre_booking" method="post">
						  <input type="hidden" id="hotel_name" name="hotel_name" value="<?php echo $hotel_info->hotel_name; ?>" />
						  <input type="hidden" id="hotel_id" name="hotel_id" value="<?php echo $hotel_info->sup_hotel_id; ?>" />
						  <input type="hidden" id="sup_rate_id" name="sup_rate_id" value="<?php echo $res[$i]->sup_rate_tactics_id; ?>" />
						  <input type="hidden" id="room_type" name="room_type" value="<?php echo $cate->sup_hotel_room_type_id; ?>" />
						  <input type="hidden" id="room_cost" name="room_cost" value="<?php echo $final_rate; ?>" />
						  <input type="hidden" id="room_name" name="room_name" value="<?php echo $cate->hotel_room_type; ?>" />
						  <input type="hidden" id="adults" name="adults" value="<?php echo $combination['adults_count']; ?>" />
						  <input type="hidden" id="childs" name="childs" value="<?php echo $combination['childs_count']; ?>" />
						  <input type="hidden" id="nights" name="nights" value="<?php if(isset($combination['nights']) && $combination['nights']!=''){ echo $combination['nights'];}else{ echo '1'; }  ?>" />
						  <input type="hidden" id="check_in" name="check_in" value="<?php if(isset($combination['checkin']) && $combination['checkin']!=''){ echo $combination['checkin']; }else{ echo date("d-m-Y"); } ?>" />
						  <input type="hidden" id="check_out" name="check_out" value="<?php if(isset($combination['checkin']) && $combination['checkin']!=''){ echo $combination['checkout'];}else { echo date("d-m-Y", strtotime("+1 day"));} ?>" />
						  <input type="hidden" id="room" name="room" value="<?php if(isset($combination['rooms']) && $combination['rooms']!=''){ echo $combination['rooms'];}else{ echo '1';} ?>" />
						  <input type="hidden" name="web_url" id="web_url" value="<?php echo WEB_URL; ?>" />
						  <input type="hidden" name="check_value<?php echo $i; ?>" id="check_value<?php echo $i; ?>" value="<?php echo $i; ?>">
						  <input type="button" class="btn btn-blue btn-small wid100 pull-right" value="BOOK NOW" onclick="check_avilabless('<?php echo $i; ?>')" />
					 </form>
                  </div>
               </div></div>
              <?php 
						}
					} 
			  ?> 
   </div>
    <!--  rooms & Rates end-->
    
         <!-- property FACILITIES-->
 <div class="container">
   <div class="well well-sm well-blue"><?php echo $this->lang->line('LOCATION_MAP'); ?></div>
   <input type="hidden" name="latitude" id="lat" class="MapLat" value="<?php if($hotel_info->latitude!='') { echo $hotel_info->latitude; }else { echo '20.173866'; } ?>">
	<input type="hidden" name="longitude" id="long" class="MapLon" value="<?php if($hotel_info->longitude!='') { echo $hotel_info->longitude; }else { echo '56.561647'; } ?>" >
   <div class="well" id="map_canvas" style="height:400px;" >    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d248849.84916296514!2d77.6309395!3d12.9539974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1407913978538" width="100%" height="450" frameborder="0" style="border:0"></iframe>--></div>
   </div>
    <!-- property FACILITIES end-->
    <div class="container">
		   <div class="well well-sm well-blue"><?php echo $this->lang->line('PROPERTY_CONTACT_DETAILS'); ?></div>
			   <div class="well"> 
					<address>
					  <div class="row pad8">
						 <div class="col-sm-2"><b><?php echo $this->lang->line('Address'); ?></b></div>
						 <div class="col-sm-10">
						 <div><?php echo $this->Hotel_Model->get_hotelArea($hotel_info->hotel_area).',';?></div>
						 <div><?php echo $this->Hotel_Model->get_hotelCity($hotel_info->city).',';?></div>
						 <div><?php echo $this->Hotel_Model->city_country_name($hotel_info->country).'.';?></div>
						 </div>
					  </div>
					  <div class="row pad8">
						 <div class="col-sm-2"><b><?php echo $this->lang->line('Telephone'); ?></b></div>
						 <div class="col-sm-10"><?php echo $hotel_info->contact_person_phone;?></div>
					  </div>
					   <div class="row pad8">
						 <div class="col-sm-2"><b><?php echo $this->lang->line('email'); ?></b></div>
						 <div class="col-sm-10"><?php echo $hotel_info->contact_person_email;?></div>
					  </div>
					  <div class="row pad8">
						 <div class="col-sm-2"><b><?php echo $this->lang->line('Fax'); ?></b></div>
						 <div class="col-sm-10"><?php echo $hotel_info->rfax;?></div>
					  </div>
				   </address>
				 </div>
		   </div>
			<!-- property FACILITIES end-->
			<!-- SIMILER PROPERTIES FOUND-->
		<div class="container">
			<div class="well well-sm well-blue"><?php echo $this->lang->line('SIMILER_PROPERTIES_FOUND'); ?></div>
				<div class="row">
					<?php 
						$hotels=$this->Hotel_Model->similar_hotel($hotel_info->city);
						if($hotels!='') {
							 for($i=0;$i<count($hotels);$i++) {
					?>
						<a href="<?php echo WEB_URL;?>hotel/hotel_details/<?php echo $hotels[$i]->sup_hotel_id;?>/<?php echo $hotels[$i]->sup_rate_tactics_id; ?>"><div class="col-lg-3"><div class="well pad8">
						<img src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $hotels[$i]->main_image; ?>" class="img-responsive" >
						<h5 class=" hotelhead " > <?php echo $hotels[$i]->hotel_name; ?></h5>
						<h6 class=" hoteladdr"><?php echo $this->Hotel_Model->get_hotelArea($hotel_info->hotel_area);?></h6><h6 class=" hoteladdr"><?php echo $this->Hotel_Model->get_hotelCity($hotel_info->city).', '.$this->Hotel_Model->city_country_name($hotels[$i]->country).'.'; ?></h6>
						<h6>
							<span class="pad5" style="position:relative; top:5px;">
								<?php 
									for($j=0;$j<$hotels[$i]->star;$j++) { 
								?>
								<i class="icon-star"></i>
								<?php
									} 
									if($j<5){
										for($k=$j;$k<5;$k++) {
								?>
								<i class="icon-star-empty"></i>
								<?php	
										} 
									}
								 ?>
							</span>
							<span class="hotelrate">
								<?php 
									$gate_way=$this->Hotel_Model->payment_gateway();	
									$final_rate1=($gate_way/100)*$hotels[$i]->sell_price+$hotels[$i]->sell_price;	
									$final_rate=round($final_rate1);   
									echo '$'.$final_rate; 
								?>
							</span>
							<span class="durationinfo">R.O/night</span>
						</h6>
					</div>
				</div>
			</a><!-- col-3-->
		<?php
				}
			} 	
		?>
		</div>
   </div>
    <!-- SIMILER PROPERTIES FOUND end-->
    <?php $this->load->view('footer'); ?>
    </div><!-- wrapper-->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<script>
		$(function(){
			$( "#searchid1" ).autocomplete({
					source: "<?php echo WEB_URL; ?>hotel/search_data",
					minLength: 1, // how many character when typing to display auto complete
					select: function (event, ui) {
							stateid = (ui.item.id);
							$("#searchid").val(stateid);
                        }
				});
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
    </script>
    <script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
	<script>
	$(function () {
		 // window.location ="http://www.google.com";
				var lat = $("#lat").val(),
					lng = $("#long").val(),
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
				 map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
				 marker = new google.maps.Marker({
					position: latlng,
					map: map,
					icon: image,
					draggable: myMarkerIsDraggable
				 });
		});
	</script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.core.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.utils.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.slider.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $Loop: 2,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 6,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 204,                          //[Optional] The offset position to park thumbnail,

                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 6                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                }
            };
			var jssor_slider1 = new $JssorSlider$("slider3_container", options);
			//responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(parentWidth, 1140));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
			ScaleSlider();
			if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }
		});
    </script>
</body>
</html>


    

