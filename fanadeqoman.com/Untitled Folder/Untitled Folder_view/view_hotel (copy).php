<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Console</title>
        <!-- font Awesome -->
        <link href="<?php echo WEB_DIR;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <style type="text/css">


		@media print
		{
		.noprint {display:none;}
		.printTable th{ vertical-align:top; }
		}

		@media screen
		{
		.printTable th{ vertical-align:top; }
		}
		th{ width:500px !important; text-align:right !important; margin-right:15px; padding:10px; margin-bottom:15px;}
		td{ width:500px !important; text-align:left !important; margin-left:15px;margin-bottom:15px;}


</style>
     </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
           <?php $this->load->view('view_header.php'); ?>  
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
                </section><br/>
                <form class="form-horizontal add_hotel_form" action="#" id="formid" method="post" onsubmit="return add_hotel_validation()">
						  <div class="box-header noprint" style="height:50px">
							<div class="form-group" >
							  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
								<div class="col-xs-12 col-md-4" style="margin-left: 22cm;">
									  <a href="javascript:void(0);" onclick="print_Window()" class="btn btn-primary">Print</a>&nbsp;&nbsp;&nbsp;&nbsp; 
									  <a href="<?php echo WEB_URL;?>hotel/hotel_manager" class="btn btn-primary">Back</a>
								</div>
							</div>
						 </div><!-- /.box-header -->
						 <table class="printTable"
							  <tr>
									<th>
										<?php echo $this->lang->line('Markets'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											$m_name='';
											if(isset($hotel_details->market_name) && $hotel_details->market_name!=''){ 
												$array=unserialize($hotel_details->market_name); 
												foreach($array as $value){
													 $market=$this->Hotel_Model->get_market($value);
													 $m_name=$m_name.$market.',';
												}
												echo rtrim($m_name,',');
											}
										?> 
									</td>
							  </tr>
							   <tr>
									<th>
										 <?php echo $this->lang->line('Hotel_Name'); ?>  &nbsp;&nbsp;
									</th>
									<td>
										<?php 
											
											if($_SESSION['lang']=='english'){
												echo $hotel_details->hotel_name; 
											}else{
												echo $hotel_details->hotel_nameA; 
											}
										?>
									</td>
							  </tr>
							   <tr>
									<th>
										  <?php echo $this->lang->line('hotel_type'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_hotelType($hotel_details->hotel_type); ?>
									</td>
							  </tr>
							   <tr>
									<th>
										<?php echo $this->lang->line('star'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->star; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										<?php echo $this->lang->line('Country'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_country($hotel_details->country); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Region'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Region($hotel_details->hotel_region); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('City_Town'); ?>&nbsp;&nbsp;
									</th>
									<td>
										 <?php echo $this->Hotel_Model->get_City($hotel_details->city); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Area'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Area($hotel_details->hotel_area); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Contract_Start'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->start_date; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Contract_End'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->end_date; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('box'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->box; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('code'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->postel; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Phone'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->mobile_number; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Fax'); ?>&nbsp;&nbsp;
									</th>
									<td>
											<?php echo $hotel_details->fax; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Email'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->main_email; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Website'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->website; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										<?php echo $this->lang->line('Website'); ?>
										Contact Person First Name&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->contact_first_name; ?>
									</td>
							  </tr>
							    <tr>
									<th>
										Contact Person Designation&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->designation; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Contact Person Number&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->contact_person_phone; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Contact Person Email&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->contact_person_email; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Reservation Email1&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->remail1; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Reservation Email2&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->remail2; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Reservation Fax&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->rfax; ?>
									</td>
							  </tr>
							    <tr>
									<th>
										Reservation Telephone&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->rphone; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Contract Signed By&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->pname; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Title&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->ptitle; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Hotel Location&nbsp;&nbsp;
									</th>
									<td>
										 <?php 
											$hotel_loc=unserialize($hotel_details->hotel_loc);
											$total_loc='';
											foreach($hotel_loc as $loc){
												$loc1=$this->Hotel_Model->get_Loc($loc);
												$total_loc=$total_loc.$loc1.',';
											}
											echo rtrim($total_loc,',');
										?>
									</td>
							  </tr>
							   <tr>
									<th>
										Hotel Amenity&nbsp;&nbsp;
									</th>
									<td>
										 <?php 
											$hotel_amen=unserialize($hotel_details->hotel_amenity);
											$hotel_amenity='';
											foreach($hotel_amen as $amen){
												$amen1=$this->Hotel_Model->get_Amen($amen);
												$hotel_amenity=$hotel_amenity.$amen1.',';
											}
											echo rtrim($hotel_amenity,',');
										?>
									</td>
							  </tr>
							   <tr>
									<th>
										Business & Function&nbsp;&nbsp;
									</th>
									<td>
										 <?php 
												$hotel_busines=unserialize($hotel_details->hotel_busines);
												$hotel_busi='';
												foreach($hotel_busines as $busi){
													$busi1=$this->Hotel_Model->get_bussines($busi);
													$hotel_busi=$hotel_busi.$busi1.',';
												}
												echo rtrim($hotel_busi,',');
											?>
									</td>
							  </tr>
							  <tr>
									<th>
										Main Hotel Image&nbsp;&nbsp;
									</th>
									<td>
										 <img height="123" width="123" class="img-responsive thumbnail" src="<?php echo IMG_PATH.$hotel_details->main_image;?>">
									</td>
							  </tr>
							   <tr>
									<th>
										Images&nbsp;&nbsp;
									</th>
									<td >
										<?php
											
											$arr=unserialize($hotel_details->image);
											foreach($arr as $val){
												if($val!=''){
										?>	
										<img height="123" width="123" class="img-responsive thumbnail" src="<?php echo IMG_PATH.$val;?>">
										<?php	
												}
											}
										?>		
									</td>
							  </tr>
							   <tr>
									<th>
										Hotel Description&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->hotel_desc; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Hotel Policies&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $hotel_details->hotel_policy; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										Payment Method&nbsp;&nbsp;
									</th>
									<td>
										<?php 
												$payment_method=unserialize($hotel_details->payment_method);
												$hotel_busi='';
												foreach($payment_method as $pay){
													$pay1=$this->Hotel_Model->get_payType($pay);
													$hotel_busi=$hotel_busi.$pay1.',';
												}
												echo rtrim($hotel_busi,',');
											?>
									</td>
							  </tr>
							   <tr>
									<th>
										Accepted payment Cards&nbsp;&nbsp;
									</th>
									<td>
										<?php 
												$accepted_payment=unserialize($hotel_details->accepted_payment);
												$hotel_busi='';
												foreach($accepted_payment as $card){
													$pay1=$this->Hotel_Model->get_payCard($card);
													$hotel_busi=$hotel_busi.$pay1.',';
												}
												echo rtrim($hotel_busi,',');
											?>
									</td>
							  </tr>
							   <tr>
									<th>
										Location Map&nbsp;&nbsp;
									</th>
									<td>
										<div id="map_canvas" style="height: 300px;width:597px;margin: 0.6em;"></div>
									</td>
							  </tr>
						 </table>
						 <div class="form-group noprint">
						  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
							<div class="col-xs-12 col-md-4">
								  <a href="<?php echo WEB_URL;?>hotel/edit_hotel/<?php echo $hotel_details->sup_hotel_id;?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp; 
								  <a href="<?php echo WEB_URL;?>hotel/delete_hotel/<?php echo $hotel_details->sup_hotel_id;?>" class="btn btn-primary">Delete</a>
							</div>
						 </div>
						 </form>
			 </aside><!-- /.right-side -->
			</div><!-- ./wrapper -->
		</body>
</html>
<script>
	function print_Window() {
		window.print();
	}
</script>
<!-- Bootstrap -->
<script src="<?php echo WEB_DIR;?>js/bootstrap.min.js" type="text/javascript"></script>
<!-- Admin App -->
<script src="<?php echo WEB_DIR;?>js/AdminLTE/app.js" type="text/javascript"></script>
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
	  //updateMarkerPosition(latlng);
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
		  //updateMarkerAddress(responses[0].formatted_address);
		} else {
		  //updateMarkerAddress('Cannot determine address at this location.');
		}
	  });
	}
	// Onload handler to fire off the app.
	//google.maps.event.addDomListener(window, 'load', initialize);
	});
	</script>
