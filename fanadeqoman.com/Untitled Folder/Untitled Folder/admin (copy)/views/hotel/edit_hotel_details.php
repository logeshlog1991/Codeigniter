<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Console</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo WEB_DIR;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo WEB_DIR;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo WEB_DIR;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo WEB_DIR;?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo WEB_DIR;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Common Css by Nag -->
        <link href="<?php echo WEB_DIR;?>css/common.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
					<script>
					 $(function () {
						 // window.location ="http://www.google.com";
							 var lat = '<?php echo $hotel_details->latitude; ?>',
								 lng = '<?php echo $hotel_details->longitude; ?>',
								 latlng = new google.maps.LatLng(lat, lng),
								 image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
							var myMarkerIsDraggable = true;
							var geocoder = new google.maps.Geocoder();
							 //zoomControl: true,
							 //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,

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

							 var input = document.getElementById('event_venue');
							 var autocomplete = new google.maps.places.Autocomplete(input, {
								 types: ["geocode"]
							 });

							 autocomplete.bindTo('bounds', map);
							 var infowindow = new google.maps.InfoWindow();
							 google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
							 infowindow.close();
							 var place = autocomplete.getPlace();
							 if (place.geometry.viewport) {
								 map.fitBounds(place.geometry.viewport);
							 } else {
								 map.setCenter(place.geometry.location);
								 map.setZoom(17);
							 }
							 moveMarker1(place.name, place.geometry.location);
							 $('.MapLat').val(place.geometry.location.lat());
							 $('.MapLon').val(place.geometry.location.lng());
							 //alert(12);
						 });
						 google.maps.event.addListener(map, 'click', function (event) {
							 $('.MapLat').val(event.latLng.lat());
							 $('.MapLon').val(event.latLng.lng());
							// alert(event.latLng.place.name)
						 });
						 $("#event_venue").focusin(function () {
							 $(document).keypress(function (e) {
								 if (e.which == 13) {
									 return false;
									 infowindow.close();
									 var firstResult = $(".pac-container .pac-item:first").text();
									 var geocoder = new google.maps.Geocoder();
									 geocoder.geocode({
										 "address": firstResult
									 }, function (results, status) {
										 if (status == google.maps.GeocoderStatus.OK) {
											 var lat = results[0].geometry.location.lat(),
												 lng = results[0].geometry.location.lng(),
												 placeName = results[0].address_components[0].long_name,
												 latlng = new google.maps.LatLng(lat, lng);

											 moveMarker1(placeName, latlng);
											 $("input").val(firstResult);
										   //  alert(firstResult)
										 }
									 });
								 }
							 });
						});
					  updateMarkerPosition(latlng);
					  geocodePosition1(latlng);
					  
					  // Add dragging event listeners.
					  google.maps.event.addListener(marker, 'dragstart', function() {
					   // updateMarkerAddress('Dragging...');
					  });
					  google.maps.event.addListener(marker, 'drag', function() {
					   // updateMarkerStatus('Dragging...');
						updateMarkerPosition(marker.getPosition());
					  });
					  google.maps.event.addListener(marker, 'dragend', function() {
					   //updateMarkerStatus('Drag ended');
						geocodePosition1(marker.getPosition());
					  });
					function moveMarker1(placeName, latlng) {
						 marker.setIcon(image);
						 marker.setPosition(latlng);
						 infowindow.setContent(placeName);
						 //infowindow.open(map, marker);
					}
					function geocodePosition1(pos) {
					//alert(pos);
					  geocoder.geocode({
						latLng: pos
					  }, function(responses) {
						if (responses && responses.length > 0) {
						  updateMarkerAddress(responses[0].formatted_address);
						} else {
						  updateMarkerAddress('Cannot determine address at this location.');
						}
					  });
					}
					function updateMarkerPosition(latLng) {
						document.getElementById('lat').value=  latLng.lat();
						document.getElementById('long').value =  latLng.lng();
					}
					function updateMarkerAddress(str) {
					  //document.getElementById('address').innerHTML = str;
					  document.getElementById('event_venue').value = str;
					}
				// Onload handler to fire off the app.
				//google.maps.event.addDomListener(window, 'load', initialize);
			});
			
			$(document).ready(function(){
				$(document).on("click",".delete-img",function(){
					var imageId = $(this).attr("id").replace('close','');
					var img_db=$("#img_db").val(); 
					if(img_db!='' && imageId!=''){
						var base_url=$("#web_url").val();
						$.ajax({
							 url: base_url+"hotel/delete_img",
							 type: 'post',
							 data:  {'img_id':imageId,'img_db':img_db,'hotel_id':$("#hotel_type").val()},
							 success: function(output) {
								location.reload(); 
							}
						});
					}
				});
			});
			
		</script>
		<style>
			.delete-img{
				position:absolute;
				top:5px;
				right:20px;
			}
		</style>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
           <?php $this->load->view('header'); ?>  
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                   <?php $this->load->view('sidebar'); ?>
                </section>
                <!-- /.sidebar -->
            </aside>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard" title="Home"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>
				<!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                      <li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_hotel/<?php echo $hotel_details->sup_hotel_id; ?>">Edit Hotel</a></li>
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="#tab_1" data-toggle="tab">Edit Hotel Details</a></li>
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                </section><!-- /.content -->
                 <div class="box box-primary">
                               <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-572px;">
											<tr> 
											<td colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td> <h4>Add Location&nbsp;&nbsp;</h4></td>
												<td>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="add_location_name" id="add_location_name" placeholder="Add Location" required onblur="check_location()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="add_location_nameA" id="add_location_nameA" placeholder="Add Location" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_loc"></span>
												</td>
												<td> 
													<div class="box-footer">
														<button type="button" onclick="add_location()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                
                                 <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-482px;">
											<tr> 
											<td colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td> <h4>Add Business & Function&nbsp;&nbsp;</h4></td>
												<td>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="add_bussines_name" id="add_bussines_name" placeholder="Add business" required onblur="check_bussines()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="add_bussines_nameA" id="add_bussines_nameA" placeholder="Add business" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_bussines"></span>
												</td>
												<td> 
													<div class="box-footer">
														<button type="button" onclick="add_Business()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                
                                 <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-509px;">
											<tr> 
											<td colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td> <h4>Add Payment Method&nbsp;&nbsp;</h4></td>
												<td>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="add_Payment_name" id="add_Payment_name" placeholder="Add Payment Type" required onblur="check_PaymentType()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="add_Payment_nameA" id="add_Payment_nameA" placeholder="Add Payment Type" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_Payment"></span>
												</td>
												<td> 
													<div class="box-footer">
														<button type="button" onclick="return add_payType()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                 <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-452px;">
											<tr> 
											<td colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td> <h4>Add Accepted payment cards&nbsp;&nbsp;</h4></td>
												<td>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="cards" id="cards" placeholder="Add payment card" required onblur="check_cards()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group">
														<input type="text" class="form-control" name="cardsA" id="cardsA" placeholder="Add payment card" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_cards"></span>
												</td>
												<td> 
													<div class="box-footer">
														<button type="button" onclick="add_cards()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                               <form class="form-horizontal add_hotel_form" enctype="multipart/form-data" action="<?php echo WEB_URL;?>hotel/edit_hotelDetails_ad/<?php echo $hotel_details->sup_hotel_id;?>" id="formid" method="post" onsubmit="return hotel_details1()">
                               <fieldset>
								  <input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL; ?>">
								<!-- Form Name -->
								<legend class="pd-lr-30-px">Hotel Information</legend>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Hotels List</label>  
									<div class="col-xs-12 col-md-4">
										<select name="hotel_type" id="hotel_type" class="form-control input-md">
										<?php
											$hotel_list=$this->Hotel_Model->getting_all_hotels();
											if(isset($hotel_list) && $hotel_list!=''){
												foreach($hotel_list as $hotel){
													if($hotel_details->sup_hotel_id==$hotel->sup_hotel_id){
										?>
											<option value="<?php echo $hotel->sup_hotel_id; ?>"><?php echo $hotel->hotel_name; ?></option>
										<?php
													}
												}
											}
										?>
										</select>
										<span id="error_hotel" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Location</label>  
									<div class="col-xs-12 col-md-4">
										<?php
											$hotel_loc=$this->Hotel_Model->hotel_locations();
											if(isset($hotel_loc) && $hotel_loc!=''){
												foreach($hotel_loc as $loc){
										?>
										<div class="checkbox">
										  <label for="checkboxes-0">
											<input type="checkbox" name="hotel_loc[]" id="hotel_loc" value="<?php echo $loc->loc_sno; ?>"  <?php if(isset($hotel_details->hotel_loc) && $hotel_details->hotel_loc!=''){ $arr=unserialize($hotel_details->hotel_loc); foreach($arr as $val){ if($loc->loc_sno==$val){ echo 'checked="checked"';} } } ?>/>
											<?php echo $loc->location_name; ?>
										  </label>
										</div>
										<?php
												}
											}
										?>
										</select>
										<span id="error_hotel_loc" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Amenity</label>  
									<div class="col-xs-12 col-md-4">
										<?php
											$hotel_amen=$this->Hotel_Model->get_global_amenities();
											if(isset($hotel_amen) && $hotel_amen!=''){
												foreach($hotel_amen as $amen){
										?>
										<div class="checkbox">
										  <label for="checkboxes-0">
											<input type="checkbox" name="hotel_amen[]" id="hotel_amen" value="<?php echo $amen->amenity_list_id; ?>" <?php if(isset($hotel_details->hotel_amenity) && $hotel_details->hotel_amenity!=''){ $arr=unserialize($hotel_details->hotel_amenity); foreach($arr as $val){ if($amen->amenity_list_id==$val){ echo 'checked="checked"';} } } ?>/>
											<?php echo $amen->amenity_name; ?>
										  </label>
										</div>
										<?php
												}
											}
										?>
										</select>
										<span id="error_hotel_amen" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Business & Function</label>  
									<div class="col-xs-12 col-md-4">
										<?php
											$Business=$this->Hotel_Model->fetch_other_accommodation();
											if(isset($Business) && $Business!=''){
												foreach($Business as $buss){
										?>
											<div class="checkbox">
											  <label for="checkboxes-0">
												<input type="checkbox" name="hotel_busines[]" id="hotel_busines" value="<?php echo $buss->others_id; ?>" <?php if(isset($hotel_details->hotel_busines) && $hotel_details->hotel_busines!=''){ $arr=unserialize($hotel_details->hotel_busines); foreach($arr as $val){ if($buss->others_id==$val){ echo 'checked="checked"';} } } ?>/>
												<?php echo $buss->others_name; ?>
											  </label>
											</div>
										<?php
												}
											}
										?>
										</select>
										<span id="error_hotel_busines" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Main Image</label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="main_image" id="main_image" > 
										<span style="color:red;" id="error_main_image"></span>
										<div class="col-xs-6">
											<img class="img-responsive thumbnail" src="<?php echo IMG_PATH.$hotel_details->main_image;?>">
										</div>
										<input type="hidden" name="main_image1" id="main_image1" value="<?php echo $hotel_details->main_image;?>"> 
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Images</label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image[]" multiple id="images" > 
										<span style="color:red;" id="error_images"></span>
										
										
										<?php
											
											$arr=unserialize($hotel_details->image);
											$i=0;$img_db='';
											foreach($arr as $val){
												$img_db=$img_db.$val.',';
												if($val!=''){
										?>						
										
										<div class="col-xs-4">
											<img id="image<?php echo $i; ?>" class="img-responsive thumbnail" src="<?php echo IMG_PATH.$val;?>">
											<a href="javascript:void(0);"><img id="close<?php echo $val; ?>" class="delete-img" src="<?php echo IMG_PATH.'cancel-icon.png';?>"></a>
										</div>
										<?php	
												$i++;
												}
											}
										?>	
										<input type="hidden" id="img_db" name="img_db" value="<?php echo rtrim($img_db,','); ?>">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Description</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<textarea name="hotel_desc" placeholder="Hotel Description" id="hotel_desc" class="form-control input-md" ><?php echo $hotel_details->hotel_desc; ?> </textarea><span class="input-group-addon">English</span>
										</div><br/>
									   <div class="input-group custom-input-group">
										 <textarea name="hotel_descA" placeholder="Cancellation Description" id="hotel_descA" class="form-control input-md" > <?php echo $hotel_details->hotel_descA; ?></textarea><span class="input-group-addon">Arabic</span>
									   </div>
									</div>
								  <span style="color:red;" id="error_hoteldesc"></span>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Policies</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<textarea name="hotel_policy" placeholder="Hotel Policy" id="hotel_policy" class="form-control input-md" > <?php echo $hotel_details->hotel_policy; ?></textarea><span class="input-group-addon">English</span>
										</div><br/>
									   <div class="input-group custom-input-group">
										 <textarea name="hotel_policyA" placeholder="Hotel Policy" id="hotel_policyA" class="form-control input-md" ><?php echo $hotel_details->hotel_policyA; ?> </textarea><span class="input-group-addon">Arabic</span>
									   </div>
									   <span style="color:red;" id="error_polcydesc"></span>
								  </div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Payment Method</label>  
									<div class="col-xs-12 col-md-4">
										<?php
											$payment_type=$this->Hotel_Model->get_paymentType();
											if(isset($payment_type) && $payment_type!=''){
												foreach($payment_type as $type){
										?>
											<div class="checkbox">
											  <label for="checkboxes-0">
												<input type="checkbox" name="payment_method[]" id="payment_method" value="<?php echo $type->p_no; ?>" <?php if(isset($hotel_details->payment_method) && $hotel_details->payment_method!=''){ $arr=unserialize($hotel_details->payment_method); foreach($arr as $val){ if($type->p_no==$val){ echo 'checked="checked"';} } } ?>/>
												<?php echo $type->payment_type; ?>
											  </label>
											</div>
										<?php
												}
											}
										?>
										</select>
										<span id="error_payment_method" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Accepted payment cards</label>  
									<div class="col-xs-12 col-md-4">
										<?php
											$card_type=$this->Hotel_Model->get_cardType();
											if(isset($card_type) && $card_type!=''){
												foreach($card_type as $card){
										?>
											<div class="checkbox">
											  <label for="checkboxes-0">
												<input type="checkbox" name="accepted_payment[]" id="accepted_payment" value="<?php echo $card->c_no; ?>" <?php if(isset($hotel_details->accepted_payment) && $hotel_details->accepted_payment!=''){ $arr=unserialize($hotel_details->accepted_payment); foreach($arr as $val){ if($card->c_no==$val){ echo 'checked="checked"';} } } ?>/>
												<?php echo $card->card_name; ?>
											  </label>
											</div>
										<?php
												}
											}
										?>
										</select>
										<span id="error_accepted_payment" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Location Map</label>  
									<div class="col-xs-12 col-md-4">
									<div class="control-group">
										<label class="control-label">Drag pointer for Hotel Location</label>
										<div class="controls">
											<div id="map_canvas" style="height: 300px;width:597px;margin: 0.6em;">
											</div>
										</div>
									</div>
									<input type="text" name="latitude" id="lat" class="MapLat"  value="<?php echo $hotel_details->latitude; ?>" placeholder="Latitude" style="width: 161px;">
									<input type="text" name="longitude" id="long" class="MapLon"  value="<?php echo $hotel_details->longitude; ?>" placeholder="Longitude" style="width: 161px;">
								</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
									<div class="col-xs-12 col-md-4">
										  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Submit'); ?></button>
								    </div>
								</div>
								 </fieldset>
								</form>
						</div><!-- /.box -->
			</aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
	<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo WEB_DIR;?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo WEB_DIR;?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo WEB_DIR;?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- Admin App -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Admin for demo purposes -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <!-- validation  script -->
        <script src="<?php echo WEB_DIR;?>js/custom.js" type="text/javascript"></script>
	</body>
	
</html>
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
 $(function() {
		$( "#datepicker" ).datepicker({
			minDate:0,
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'dd-mm-yy',
			onClose: function( selectedDate ) {
				var date = $(this).datepicker('getDate');
				if (date) {
					  date.setDate(date.getDate() + 1);
				}
				$( "#datepicker1" ).datepicker( "option", "minDate", date);
			}
		});
		$( "#datepicker1" ).datepicker({
		  //minDate:0,
		  changeMonth: true,
		  numberOfMonths: 1,
		  dateFormat: 'dd-mm-yy',
		  onClose: function( selectedDate ) { 
			  $("#datepicker").datepicker("option","maxDate",selectedDate);
		  }
		});
 });
</script>

