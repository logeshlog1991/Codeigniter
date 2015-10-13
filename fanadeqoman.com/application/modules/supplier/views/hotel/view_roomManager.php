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


</style>
     </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
           <?php $this->load->view('view_header'); ?>  
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
								<div class="col-xs-12 col-md-4" style="margin-left: 14cm;">
									  <a href="javascript:void(0);" onclick="print_Window()" class="btn btn-primary">Print</a>&nbsp;&nbsp;&nbsp;&nbsp; 
									  <a href="<?php echo WEB_URL;?>hotel/room_list" class="btn btn-primary">Back</a>
								</div>
							</div>
						 </div><!-- /.box-header -->
						 <table class="printTable" style="margin:0px 0px 0px 190px;">
							  <tr>
									<th>
										 <?php echo $this->lang->line('Hotel_Name'); ?>  
									</th>
									<td>
										<?php echo $hotel_details->hotel_name; ?>
									</td>
							  </tr>
							   <tr>
									<th>
										<!--Star Rating-->
										Star Rating&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Star($hotel_details->star); ?>
									</td>
							  </tr>
							   <tr>
									<th>
										<!--Country-->
										Country&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_country($hotel_details->country); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<!--Region-->
										Region&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Region($hotel_details->hotel_region); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<!--City/Town-->
										City/Town&nbsp;&nbsp;
									</th>
									<td>
										 <?php echo $this->Hotel_Model->get_City($hotel_details->city); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<!--Area-->
										Area&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Area($hotel_details->hotel_area); ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Room Category&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											echo $room_details->hotel_room_type; 
										?> 
									</td>
							  </tr>
							  <tr>
									<th>
										Room Type&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											echo $room_details->capacity_title; 
										?> 
									</td>
							  </tr>
							  <tr>
									<th>
										Adult Capacity&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											echo $room_details->capacity; 
										?> 
									</td>
							  </tr>
							  <tr>
									<th>
										Child Capacity&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											echo $room_details->child_capacity; 
										?> 
									</td>
							  </tr>
							   <tr>
									<th>
										No Of Rooms&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											echo $room_details->no_of_rooms;
										?>
									</td>
							  </tr>
							  <tr>
									<th>
										Room Description&nbsp;&nbsp;
									</th>
									<td>
										<?php echo $room_details->room_desc; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Room Services&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											
											$hotel_loc=unserialize($room_details->hotel_room_services);
											$total_loc='';
											foreach($hotel_loc as $loc){
												$loc1=$this->Hotel_Model->category($loc);
												$total_loc=$total_loc.$loc1.',';
											}
											echo rtrim($total_loc,',');
										?>
									</td>
							  </tr>
							 <tr>
									<th>
										Room Check-In Time&nbsp;&nbsp;
									</th>
									<td>
										<?php echo  $room_details->arrivaltime_from; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Room Check-Out Time&nbsp;&nbsp;
									</th>
									<td>
										<?php echo  $room_details->departtime_before; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Check-in with Extra cost (Before)&nbsp;&nbsp;
									</th>
									<td>
										<?php echo  $room_details->checkin_extracost1;echo '&nbsp'; echo 'Per Hour'; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Check-Out with Extra cost (After)&nbsp;&nbsp;
									</th>
									<td>
										<?php echo  $room_details->checkout_extracost1;echo '&nbsp'; echo 'Per Hour'; ?>
									</td>
							  </tr>
							  <tr>
									<th>
										Special Policies&nbsp;&nbsp;
									</th>
									<td>
										<?php echo  $room_details->sp_policies; ?>
									</td>
							  </tr>
						 </table><br/>
						</form>
						<br/>
						<div class="noprint" style="margin:0px 0px 0px 310px;">
							<table>
								  <tr>
										<a href="<?php echo WEB_URL;?>hotel/edit_roomManager/<?php echo $room_details->room_id; ?>/<?php echo $room_details->hotel_id; ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="<?php echo WEB_URL;?>hotel/delete_roomManager/<?php echo $room_details->room_id; ?>/<?php echo $room_details->hotel_id; ?>" class="btn btn-primary">Delete</a>
								  </tr>
							</table>
						</div>
						<br/><br/><br/><br/>
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
