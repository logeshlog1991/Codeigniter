<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>fanadeqoman</title>
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
		<link href="<?php echo WEB_DIR;?>public/css/common.css" rel="stylesheet" media="screen" id="color">
		<!-- Font Icon -->
		<link href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<div class=" topbar container">
				<?php $this->load->view('header_main'); ?>
			</div><!-- end of container-->
		</div>
		<div class="clearfix"></div>
		<div class="container">
		  <div class="row mt10">    
			<div class="col-sm-12 col-xs-12" style="min-height:395px;">
				<div class="well lightbg lgray text-center"><h3 class="margin-none">Your Booking Summary</h3></div>
					<div class="clearfix">
					  <table class="table table-hover grayborder">
						<thead class="graybg">
						  <tr>
							<th>Sl No</th>
							<th>Booking ID</th>
							<th>Booking Date</th>
						   <!-- <th>Persons</th>-->
							<th>Check In</th>
							<th>Check Out</th>
							<th>Amount</th>
							<th>Currency</th>
							<th>Status</th>
							<th>Cancel Booking</th>
							<th>Voucher</th>                       
						  </tr>
						</thead>
						<tbody>
							<?php if(isset($result) && $result!='') {
								for($i=0;$i<count($result);$i++) {
								?>
						  <tr>
							<td><?php echo $i+1 ?></td>
							<td><?php echo $result[$i]->booking_id; ?></td>
							<td><?php echo $result[$i]->created_date; ?></td>
						  <!--  <td><?php echo '2'; ?></td>-->
							<td><?php echo $result[$i]->customer_checkin; ?></td>
							<td><?php echo $result[$i]->customer_checkout; ?></td>
							<td><?php echo $result[$i]->customer_finalcost; ?></td>
							<td>$</td>
							<td><?php  if($result[$i]->status==1) { echo 'Confirmed'; } else { echo 'Cancelled'; } ?></td>
							<td><?php if($result[$i]->status==1) { ?><a href="<?php echo WEB_URL; ?>hotel_user/cancel_booking/<?php echo $result[$i]->booking_id;?>">Cancel</a> <?php } else { echo 'Cancelled'; } ?></td>
							<td><a href="javascript:void(0);" onclick="JavaScript:newPopup('<?php echo WEB_URL; ?>hotel/voucher/<?php echo $result[$i]->hotel_id;?>/<?php echo $result[$i]->booking_id;?>');">Voucher</a></td>
						  </tr>
						  <?php } } ?>
						</tbody>
					  </table>
				   </div>   
				 </div>
			</div><!-- row mt10 end-->
		</div><!-- container-->
		<div class="clearfix"></div>
		<?php $this->load->view('footer'); ?>
	</div><!-- end of wrapper-->
	</body>
	<style>
	   td,th{ border-right:1px solid #ddd;}
      .lightbg{ background-color:#f5f5f5}
	</style>
	<script>
		function newPopup(url) { 
			popupWindow = window.open(
			url,'popUpWindow','height=500,width=1100,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}
	</script>
</html>
	
