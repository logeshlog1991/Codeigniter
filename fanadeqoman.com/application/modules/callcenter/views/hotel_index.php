<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>fanadeqoman</title>
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/common.css">
		<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css">
		<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
		<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
		<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/validation.js"></script>
	</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('header_main'); ?>
        <!-- topmanu end-->
		<div class="container"><!--3-->
		<form method="POST" name="search" id="search" action="<?php echo site_url();?>/hotel/results" onsubmit="return formValidation()">
			<!-- find u r hotel-->
			<div class="col-lg-6 col-xs-12 mb20" style="background-color:#00b0f0; border-radius:3px;">
				<h3 class="foheading"><?php echo $this->lang->line('find_hotel'); ?></h3>
				<div class="dotborder"></div>
				<div class="col-lg-3 col-xs-12 dest mt10"><span class="destlabel"><?php echo $this->lang->line('Destination'); ?></span></div>
				<div class=" col-lg-9 col-xs-12 mt10">
					<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							<input type="text" class="form-control border-right" placeholder="City" name="searchid1" id="searchid1" value="">
							<input type="hidden" class="form-control border-right" placeholder="City" name="searchid" id="searchid" value="">
					</div>
					<div id="destination" style="color:red;"></div>
				</div>
				<div class="col-lg-4 col-lg-offset-3 clear col-xs-12 mt10 ">
					<div class="checkin"><?php echo $this->lang->line('Check-In'); ?></div>
					<div class="input-group">
						 <input type="text" id="datepicker" name="checkin" class="form-control border-left" value="" placeholder="DD-MM-YY" >
                     <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                    <div id="checkinDatepicker" style="color:red;"></div>
				</div>
				<div class="col-lg-4 col-xs-12 mt10 pull-right">
					<div class="checkin"><?php echo $this->lang->line('Check-Out'); ?></div>
					<div class="input-group">
						<input type="text" id="datepicker1" name="checkout" class="form-control border-left" value="" placeholder="DD-MM-YY" >
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
					 <div id="checkoutDatepicker" style="color:red;"></div>
				</div>
				<div class=" col-lg-offset-3 col-lg-3 col-xs-12 mt10">
					<div class="checkin"><?php echo $this->lang->line('Rooms'); ?></div>
					<select class=" col-lg-12 col-xs-8" id="room" name="room" data-width="108px" onchange="RoomChange()">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div>
				<div id="AC">
					<div class="col-lg-3 col-xs-12 mt10">
						<div class="checkin"><?php echo $this->lang->line('Guests'); ?></div>
						<select class=" col-lg-12 col-xs-8" name="adult[]" id="adult" data-width="108px">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
					<div class="col-lg-3 col-xs-12 mt10">
						<div class="checkin"><?php echo $this->lang->line('Children'); ?></div>
						  <select class=" col-lg-12 col-xs-8" name="child[]" id="child" data-width="108px" onchange="childFun1()">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						  </select>
					</div>
					<div id="child_age1">
					</div>
				</div>	
				<!-- 2-->
					<div class=" col-lg-offset-5 col-lg-7 col-xs-12 mt10 mb20 pull-right ">
						<span>
							<input type="submit" class="fobutton pull-right" value="<?php echo $this->lang->line('Search'); ?>">
						</span>
				</div>
				</div><!-- col-6-->
			</form>
				<!-- find u r hotel end-->
				<!-- right banner slider-->
				<div class="col-lg-6 col-xs-12 mobc">
				<div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 365px; overflow: hidden; ">

				<!-- Slides Container -->
				<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 365px; overflow: hidden;">
					<?php
						if(isset($banners->banner_name) && $banners->banner_name!=''){
							$arr=unserialize ($banners->banner_name);
							foreach($arr as $val)
							{
					?>
					<div>
						<img u="image" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $val; ?>" />
					</div>
					<?php 
							}
						}else{
					?>
					<div>
						<img u="image" src="<?php echo WEB_DIR;?>public/img/hotel4.jpg" />
					</div>
					<div>
						<img u="image" src="<?php echo WEB_DIR;?>public/img/hotel3.jpg" />
					</div>
					<?php 
						} 
					?>
			   </div>
			   <!-- Bullet Navigator Skin Begin -->
			   <!-- bullet navigator container -->
				<div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 6px;">
					<!-- bullet navigator item prototype -->
					<div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
				</div>
				<!-- Bullet Navigator Skin End -->
				<!-- Arrow Navigator Skin Begin -->
				<!-- Arrow Left -->
				<span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 160px; left: 0px;">
				</span>
				<!-- Arrow Right -->
				<span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 160px; right: 0px">
				</span>
	
			</div>
		</div>
		<!-- right banner slider end-->
		</div><!-- end of 3-->
		<!-- latest Hotel Rates-->
		<div class="container">
			<h3 class="foheading1"> <?php echo $this->lang->line('Latest_Hotel_Rates'); ?></h3>
			<div class="row">
				<?php $latest_hotels=$this->Hotel_Model->get_latest_hotels();
				        if(isset($latest_hotels) && $latest_hotels!='')  {
							for($i=0;$i<count($latest_hotels);$i++) {
							?>
				<a href="<?php echo WEB_URL;?>hotel/hotel_details/<?php echo $latest_hotels[$i]->sup_hotel_id;?>/<?php echo $latest_hotels[$i]->sup_rate_tactics_id ?>"><div class="col-lg-3">
					<div class="well pad8 hotel-block">
						<img style="height:160px !important;width:250px !important;" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $latest_hotels[$i]->main_image; ?>"  >
						<h5 class="text-center hotelhead" ><?php echo $latest_hotels[$i]->hotel_name; ?></h5>
						<h6 class="text-center hoteladdr">
							<?php
								echo $this->Hotel_Model->get_Area($latest_hotels[$i]->hotel_area).', '.$this->Hotel_Model->get_City($latest_hotels[$i]->city).', '.$latest_hotels[$i]->country_name; 
							?>
						</h6>
						<h6>
							<span class="pad5"><?php for($j=0;$j<$latest_hotels[$i]->star;$j++) { ?>
							<i class="icon-star"></i>
							<?php }  if($j<5) {
							for($k=$j;$k<5;$k++) { ?>
							<i class="icon-star-empty"></i>
							<?php	} }?></span>
							<span class="hotelrate">
								<?php 
										$rate=$this->Hotel_Model->get_rate($latest_hotels[$i]->sup_rate_tactics_id);
										$callcenter_markup=$this->Hotel_Model->get_callcenterMarkup($this->session->userdata('user_id'));
										$final_rate=($callcenter_markup/100)*$rate+$rate;	
										echo '$'.round($final_rate);
								 ?>
							</span>
							<span class="durationinfo">R.O/night</span>
						</h6>
					</div>
				</div></a><!-- col-3-->
				<?php } 			
						} ?>
		</div><!-- firstrow-->
		<div class="row">
			<?php $latest_hotels=$this->Hotel_Model->get_latest_hotels($value=4);
				        if(isset($latest_hotels) && $latest_hotels!='')  {
							for($i=0;$i<count($latest_hotels);$i++) {							
							 ?>
			<a href="<?php echo WEB_URL;?>hotel/hotel_details/<?php echo $latest_hotels[$i]->sup_hotel_id;?>/<?php echo $latest_hotels[$i]->sup_rate_tactics_id ?>"><div class="col-lg-3">
				<div class="well pad8">
					<img style="height:160px !important;width:250px !important;" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $latest_hotels[$i]->main_image; ?>">
					<h5 class="text-center hotelhead" ><?php echo $latest_hotels[$i]->hotel_name; ?></h5>
					<h6 class="text-center hoteladdr"><?php echo $latest_hotels[$i]->address.', '.$latest_hotels[$i]->city.', '.$latest_hotels[$i]->city_country_name; ?></h6>
					<h6>
						<span class="pad5"><?php for($j=0;$j<$latest_hotels[$i]->star;$j++) { ?>
							<i class="icon-star"></i>
							<?php }  if($j<5) {
							for($k=$j;$k<5;$k++) { ?>
							<i class="icon-star-empty"></i>
							<?php	} }?></span>
						<span class="hotelrate">
							<?php 
								$rate=$this->Hotel_Model->get_rate($latest_hotels[$i]->sup_rate_tactics_id);
								$callcenter_markup=$this->Hotel_Model->get_callcenterMarkup($this->session->userdata('user_id'));
								$final_rate=($callcenter_markup/100)*$rate+$rate;	
								echo '$'.round($final_rate);
								
							?>
						</span>
						<span class="durationinfo">R.O/night</span>
					</h6>
				</div>
			</div></a><!-- col-3-->
		<?php  }
					} ?>
		</div><!-- second row-->
	</div>
			<!-- latest Hotel Rates end-->
			<!-- popular destinations-->
			<div class="container">
			<h3 class="foheading1"><?php echo $this->lang->line('Popular_Destinations_in_Oman'); ?></h3>
            <div class="mobc">
			<div id="slider1_container"  style="position: relative; top: 0px; left: 0px; width: 1140px;
					height: 480px; background: #191919; overflow: hidden;">
					<!-- Slides Container -->
					<div u="slides" style="cursor: move; position: absolute; left: 300px; top: 0px; width: 840px; height: 480px; overflow: hidden;">
						<?php
							if(isset($popular_banners->banner_name) && $popular_banners->banner_name!=''){
								$arr=unserialize ($popular_banners->banner_name);
								foreach($arr as $val)
								{
									if($val!="")
									{
						?>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $val; ?>" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $val; ?>" />
							<div class="destname">Dhofar</div>
						</div>
						<?php 
									}
								}
							}else{
						?>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd6.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd6.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd7.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd6.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd1.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd1.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd9.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd9.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd5.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd5.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd4.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd4.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd6.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd6.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd9.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd9.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd2.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd2.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd1.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd1.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd3.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd3.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd7.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd7.jpg" />
							<div class="destname">DHOFAR</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd8.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd8.jpg" />
							<div class="destname">MUSCAT</div>
						</div>
						<div>
							<img u="image" src="<?php echo WEB_DIR;?>public/img/pd4.jpg" />
							<img u="thumb" src="<?php echo WEB_DIR;?>public/img/pd4.jpg" />
							<div class="destname">Dhofar</div>
						</div>
						<?php
							}
						?>
					</div>
					<!-- Arrow Navigator Skin Begin -->
					<!-- Arrow Left -->
					<span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 250px !important; left: 310px;">
					</span>
					<!-- Arrow Right -->
					<span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 250px !important; right: 8px">
					</span>
					<!-- Arrow Navigator Skin End -->
					<!-- Thumbnail Navigator Skin 02 Begin -->
					<div u="thumbnavigator" class="jssort02" style="position: absolute; width: 300px; height: 480px; left:0px; bottom: 0px;">
						<!-- Thumbnail Item Skin Begin -->
						<div u="slides" style="cursor: move;">
							<div u="prototype" class="p" style="position: absolute; width: 120px; height: 80px; top: 0; left: 0;">
								<div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
								<div class=c>
								</div>
							</div>
						</div>
						<!-- Thumbnail Item Skin End -->
					</div>
				</div>
                </div><!-- mobc-->
			</div>
			<!-- popular destinations end-->
			<div class="clearfix"></div>
			<!-- footer-->
			<?php $this->load->view('footer'); ?>
			<!-- footer end-->
	</div><!-- end of wrapper-->
</body>
	<!-- script goes down-->
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.core.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.utils.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.slider.js"></script>
	
	<script>
	jQuery(document).ready(function ($) {
			var _SlideshowTransitions = [{ $Duration: 1200, $Opacity: 2 }];
			var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };
           var jssor_slider1 = new $JssorSlider$("slider2_container", options);
           //responsive code begin
           function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(parentWidth, 554));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();
			if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }
			//responsive code end
        });
    </script>
    <script>
	
     jQuery(document).ready(function ($) {
            var _SlideshowTransitions = [
            //Zoom- in
            {$Duration: 1200, $Zoom: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad }, $Opacity: 2 },
            //Zoom+ out
            {$Duration: 1000, $Zoom: 11, $SlideOut: true, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
            //Rotate Zoom- in
            {$Duration: 1200, $Zoom: 1, $Rotate: true, $During: { $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
            //Rotate Zoom+ out
            {$Duration: 1000, $Zoom: 11, $Rotate: true, $SlideOut: true, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

            //Zoom HDouble- in
            {$Duration: 1200, $Cols: 2, $Zoom: 1, $FlyDirection: 1, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.5, $Opacity: 2 },
            //Zoom HDouble+ out
            {$Duration: 1200, $Cols: 2, $Zoom: 11, $SlideOut: true, $FlyDirection: 1, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 4, $Opacity: 2 },

            //Rotate Zoom- in L
            {$Duration: 1200, $Zoom: 1, $Rotate: true, $During: { $Left: [0.2, 0.8], $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $ScaleHorizontal: 0.6, $Opacity: 2, $Round: { $Rotate: 0.5} },
            //Rotate Zoom+ out R
            {$Duration: 1000, $Zoom: 11, $Rotate: true, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $ScaleHorizontal: 4, $Opacity: 2, $Round: { $Rotate: 0.8} },
            //Rotate Zoom- in R
            {$Duration: 1200, $Zoom: 1, $Rotate: true, $During: { $Left: [0.2, 0.8], $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $ScaleHorizontal: 0.6, $Opacity: 2, $Round: { $Rotate: 0.5} },
            //Rotate Zoom+ out L
            {$Duration: 1000, $Zoom: 11, $Rotate: true, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $ScaleHorizontal: 4, $Opacity: 2, $Round: { $Rotate: 0.8} },

            //Rotate HDouble- in
            {$Duration: 1200, $Cols: 2, $Zoom: 1, $Rotate: true, $FlyDirection: 5, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.3, $Opacity: 2, $Round: { $Rotate: 0.7} },
            //Rotate HDouble- out
            {$Duration: 1000, $Cols: 2, $Zoom: 1, $Rotate: true, $SlideOut: true, $FlyDirection: 5, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Top: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.3, $Opacity: 2, $Round: { $Rotate: 0.7} },
            //Rotate VFork in
            {$Duration: 1200, $Rows: 2, $Zoom: 11, $Rotate: true, $FlyDirection: 6, $Assembly: 2049, $ChessMode: { $Row: 28 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 4, $ScaleVertical: 2, $Opacity: 2, $Round: { $Rotate: 0.7} },
            //Rotate HFork in
            {$Duration: 1200, $Cols: 2, $Zoom: 11, $Rotate: true, $FlyDirection: 5, $Assembly: 2049, $ChessMode: { $Column: 19 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 1, $ScaleVertical: 2, $Opacity: 2, $Round: { $Rotate: 0.8} }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 600,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 0,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $Lanes: 2,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 14,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 12,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 6,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 156,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 2                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                }
				
				
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 1140), 300));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }
			//if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
            $(function() {
				$( "#searchid1" ).autocomplete({
					source: "<?php echo WEB_URL; ?>hotel/search_data",
					minLength: 1, // how many character when typing to display auto complete
					select: function (event, ui) {
							stateid = (ui.item.id);
							$("#searchid").val(stateid);
					}
				});
			});
            $.noConflict();	
				$(function(){
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
							$( "#datepicker1" ).datepicker('setDate',date);
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
		});
    </script>
 </html>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
	
