<!DOCTYPE html>
<html>
	<head>
		<title>Cancelltion Voucher</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>fanadeqoman</title>
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
		<link href="<?php echo WEB_DIR;?>public/css/common.css" rel="stylesheet" media="screen" id="color">
		<!-- Font Icon -->
		<link href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="container">
				<?php $this->load->view('header_cancel'); ?>
		</div>
		<div class="clearfix"></div>
		<div class="container">
			<div class="row mt10">       
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<!-- thank u -->
					<div class="well">
						<div class="col-lg-1  col-xs-2 bluebg bdradius3" ><img width="50" src="<?php echo WEB_DIR;?>public/img/Goth Bow.gif"></div>
						<div class="col-lg-11 col-xs-10" >
							<h3 class=" heading3 text-center" style="padding:14px; margin-bottom:0px !important;">Your Booking With <span class="orangetxt"><?php echo  $hotel_info->hotel_name; ?></span> has been cancelled.</h3></div>
						</div><!-- well-->
						<!-- thank u end-->
					<div class="well"><!-- entire voucher-->
					<!--reservation no-->
					<div class="col-lg-12 ">
						<div class="well " style="background-color:#F5F5F5;box-shadow: 0px 2px 5px #878787;">
							<div class="row">
							  <div class="col-lg-6">
								<div class="col-lg-6"><h4><div class=" text-right">Reservation ID :</div></h4></div>
								<div class="col-lg-6"><h4><div class=" text-left"> <?php echo $book_info->booking_id; ?></div></h4></div>
							  </div>
							  <div class="col-lg-6">
								  <div class="col-lg-6"><h4><div class=" text-right">Date of Booking :</div></h4></div>
								  <div class="col-lg-6"><h4><div class=" text-left"><?php echo $book_info->created_date; ?></div></h4></div>
							  </div>
							 </div><!-- well-->
						</div>
					</div>
					<!--reservation no end-->
					<!-- left side-->
					  <div class="col-lg-6 clear">
						<div class="well text-center font18 bluetxt" style="background-color:#f5f5f5">Traveller Details</div>
						<div class="well">
							<div class="col-lg-6 col-xs-7 text-right">
							  <h4>Guest Name :</h4>
							  <h4>Voucher Date :</h4>
							  <h4>Transaction No :</h4>
							  <h4>Check In :</h4>
							  <h4>Check Out :</h4>
							  <h4>Email Id :</h4>
							  <h4>Contact No :</h4>
							  <h4>Payment Summary :</h4>
							</div>
							<div class="col-lg-6 col-xs-5">
							  <h4><?php echo $book_info->customer_fname; ?>.<?php echo $book_info->customer_lname; ?></h4>
							  <h4><?php echo $book_info->created_date; ?></h4>
							  <h4><?php echo $book_info->booking_id; ?></h4>
							  <h4><?php echo $book_info->customer_checkin; ?></h4>
							  <h4><?php echo $book_info->customer_checkout; ?></h4>
							  <h4><?php echo $book_info->customer_email; ?></h4>
							  <h4><?php echo $book_info->customer_phone; ?></h4>
							  <h4 class="orangetxt">$ <?php echo $book_info->customer_finalcost; ?></h4>
							</div>
						</div>
					</div>
					<!-- left side end-->
					<!-- right side-->
				<div class="col-lg-6">
				<!-- hotel details-->
			   <div class="well text-center font18 bluetxt" style="background-color:#f5f5f5">Hotel Details</div>
				<div class="well">
					<div class="row">
						<div class="col-lg-4 col-xs-6 text-right"><h4>Hotel Name :</h4></div>
						<div class="col-lg-8 col-xs-6"><h4><?php echo  $hotel_info->hotel_name; ?></h4></div>
					</div>
					<div class="row">
						<div class="col-lg-4  col-xs-6 text-right"><h4>Address :</h4></div>
						<div class="col-lg-8 col-xs-6 "><h4><?php echo  $hotel_info->address; ?> <br><?php echo  $hotel_info->city_country_name; ?></h4></div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-xs-6  text-right"><h4>Contact :</h4></div>
						<div class="col-lg-8 col-xs-6 "><h4><?php echo  $hotel_info->res_phone; ?></h4></div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-xs-6  text-right"><h4>Fax :</h4></div>
						<div class="col-lg-8 col-xs-6 "><h4><?php echo  $hotel_info->res_fax; ?></h4></div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-xs-6 text-right"><h4>Email :</h4></div>
						<div class="col-lg-8 col-xs-6 "><h4><?php echo  $hotel_info->main_email; ?></h4></div>
					</div>
				</div><!-- well end-->
				<!-- hotel details end-->
			</div><!-- col5-->
			<!-- right side end-->
			<!-- deduction details-->
			
			<div class="col-lg-12 col-xs-12">
				<div class="well  text-center font18 bluetxt" style="background-color:#f5f5f5">Cancellation Details</div>
				<div class="well">
					<?php if($book_info->customer_finalcost==$book_info->markup){ ?>
						<div class="col-lg-offset-4 col-lg-4 well graybg font18 text-center" ><span style="color:#555">Cancellation Charges:&nbsp;</span><b class="orange">$<?php echo  $book_info->markup; ?></b></div>
						<h4 class="text-center clear">No Amount will be refunded for your cancellation.</h4>
						<h5 class="text-center">Thank you for your interaction with <a href="#">Fanadeqoman</a></h5>
					<?php }else{ ?>
						<div class="col-lg-offset-4 col-lg-4 well graybg font18 text-center" ><span style="color:#555">Cancellation Charges:&nbsp;</span><b class="orange">$<?php echo  $book_info->markup; ?></b></div>
						<h4 class="text-center clear">Your Payment will be credited in the next 7 working days.</h4>
						<h5 class="text-center">Thank you for your interaction with <a href="#">Fanadeqoman</a></h5>
					<?php } ?>	
				</div>
			</div>
			<!--- deduction details end-->
			
		    <!-- cancellation policy-->
			<div class="col-lg-12">
				<div class="well  text-center font18 bluetxt" style="background-color:#f5f5f5">Cancellation Policy</div>
				<div class="well">
					Before <?php echo $book_info->customer_checkout; ?> 
				    cancellation charges will be 0%. After <?php echo $book_info->customer_checkout; ?> 
				    cancellation charges will be 100%. In the event of cancelling or modifying this 
				    reservation from 00:01 hours (GMT+02:00) on the <?php echo $book_info->customer_checkin; ?>  and up until check-in,
				     cancellation charges of 100.00 % of of the first night. Once the check-in has been made, 
				     the hotel may invoice the total amount of the stay.
			    </div>
			</div>
			<!-- cancellation policy end-->
			</div>
			<!-- entire voucher end-->
			</div><!-- col-12-->
			<div class="clearfix"></div>
		  </div><!-- row mt10 end-->
		 </div><!-- container-->
		<div class="clearfix"></div>
		<!-- footer-->
		<?php //$this->load->view('footer'); ?>
	<!-- footer end-->
	</div><!-- end of wrapper-->
 </body>
	 <!-- script goes down-->
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.core.js"></script>
    <script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.utils.js"></script>
    <script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.slider.js"></script>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
   <style>h4{ font-size:16px !important;}</style>
</html>
	
