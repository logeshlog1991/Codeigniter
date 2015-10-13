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
                 <div class="box-header noprint" style="height:50px">
					<table style="text-align:right;position:relative;right:-572px;">
						<tr> 
							<td colspan="3" style="text-align:right;">
								<a href="javascript:void(0);" onclick="print_Window()" class="btn btn-primary"><?php echo $this->lang->line('Print'); ?></a>&nbsp;&nbsp;&nbsp;&nbsp; 
								<a class="btn btn-primary"  href="<?php echo WEB_URL;?>hotel/price_manager"><b><?php echo $this->lang->line('Back'); ?></b></a>
							</td>
						</tr>
					</table>
				 </div><!-- /.box-header -->
				 <table class="printTable" style="margin:0px 0px 0px 190px;">
							  <tr>
									<th>
										 <?php echo $this->lang->line('Hotel_Name'); ?>  &nbsp;&nbsp;
									</th>
									<td>
										<?php
												if(isset($hotels) && $hotels!='')
												{
													$hotel_area='';
													$city='';
													$hotel_region='';
													$country='';
													foreach($hotels as $value)
													{
														if($rat_tac_details->hotel_id == $value->sup_hotel_id) 
														{
															$hotel_area=$value->hotel_area;
															$city=$value->city;
															$hotel_region=$value->hotel_region;
															$country=$value->country;
															
															if($_SESSION['lang']=='english')
															{
																echo $value->hotel_name;
															}else{
																echo $value->hotel_nameA;
															}
														}
													}
												}
											?>
									</td>
							  </tr>
							   <tr>
									<th>
										  <?php echo $this->lang->line('Country'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_country($country); ?>
									</td>
							  </tr>
							   <tr>
									<th>
										  <?php echo $this->lang->line('Region'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Region($hotel_region); ?>
									</td>
							  </tr>
							   <tr>
									<th>
										  <?php echo $this->lang->line('City_Town'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_City($city); ?>
									</td>
							  </tr>
							   <tr>
									<th>
										  <?php echo $this->lang->line('Area'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php echo $this->Hotel_Model->get_Area($hotel_area); ?>
									</td>
							  </tr>
							   <tr>
									<th>
										  <?php echo $this->lang->line('Board_Type'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php 
											if(isset($Board_Type) && $Board_Type!=''){
												foreach($Board_Type as $type){
													if($rat_tac_details->InclBoardTypeDesc == $type->board_name) 
													{ 
														if($_SESSION['lang']=='english')
														{
															echo $type->board_name;
														}else{
															echo $type->board_nameA;
														}
													}
												}
											}
										?>
									</td>
							  </tr>
							   <tr>
									<th>
										<?php echo $this->lang->line('Room_Category'); ?> &nbsp;&nbsp;
									</th>
									<td>
										<?php 
											$get_category=$this->Hotel_Model->get_category($rat_tac_details->room_cate); 
											if($_SESSION['lang']=='english')
											{
												echo $get_category->hotel_room_type;
											}else{
												echo $get_category->hotel_room_typeA;
											}
										?> 
									</td>
							  </tr>
							   <tr>
									<th>
										<?php echo $this->lang->line('Room_Type'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											$get_type1=$this->Hotel_Model->get_category($rat_tac_details->main_capacity_type); 
											if($_SESSION['lang']=='english')
											{
												echo $get_type1->capacity_title;
											}else{
												echo $get_type1->capacity_titleA;
											}
										?> 
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Room_Image'); ?>&nbsp;&nbsp;
									</th>
									<td></br>
										<?php 
											if(isset($rat_tac_details->main_image) && $rat_tac_details->main_image!= '') 
											{
										?>
											<img src="<?php echo $img_path.$rat_tac_details->main_image; ?>" height=60 width=120 /> 
										<?php
											}
										?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Image1'); ?>&nbsp;&nbsp;
									</th>
									<td></br>
										<?php 
											if(isset($rat_tac_details->image1) && $rat_tac_details->image1!= '') 
											{ 
										?>
											<img src="<?php echo $img_path.$rat_tac_details->image1; ?>" height=60 width=120 /> 
										<?php 
											}
										?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Image2'); ?>&nbsp;&nbsp;
									</th>
									<td></br>
										<?php 
											if(isset($rat_tac_details->image2) && $rat_tac_details->image2!= '') 
											{
										?>
												<img src="<?php echo $img_path.$rat_tac_details->image2; ?>" height=60 width=120 /> 
										<?php 
											}
										 ?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Image3'); ?>&nbsp;&nbsp;
									</th>
									<td></br>
										<?php 
											if(isset($rat_tac_details->image3) && $rat_tac_details->image3!= '') 
											{
										?>
											<img src="<?php echo $img_path.$rat_tac_details->image3; ?>" height=60 width=120 /> 
										<?php
											}
										 ?>
										 </br></br>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Child_Policy'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											if(isset($rat_tac_details->child_policy) && $rat_tac_details->child_policy!=''){
												if($_SESSION['lang']=='english')
												{
													echo $rat_tac_details->child_policy; 
												}else{
													echo $rat_tac_details->child_policyA; 
												}
											} 
										?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Cancellation_Policy'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<?php 
											if(isset($rat_tac_details->cancel_policy_desc) && $rat_tac_details->cancel_policy_desc!='')
											{ 
												if($_SESSION['lang']=='english')
												{
													echo $rat_tac_details->cancel_policy_desc; 
												}else{
													echo $rat_tac_details->cancel_policy_descA; 
												}
											} 
										?>
									</td>
							  </tr>
							  <tr>
									<th>
										<?php echo $this->lang->line('Room_Available_Dates'); ?>&nbsp;&nbsp;
									</th>
									<td>
										<b><?php echo $this->lang->line('From'); ?></b> 
										<?php 
											if(isset($rat_tac_details->Mindate))
											{
												 $aFrom = explode("-", $rat_tac_details->Mindate);
												 $aFDate=$aFrom[2].'-'.$aFrom[1].'-'.$aFrom[0]; 
												 echo $aFDate;
											}
										?>&nbsp;&nbsp;
										<b><?php echo $this->lang->line('To'); ?></b>
										<?php
											 if(isset($rat_tac_details->Maxdate))
											 {
												 $aFrom = explode("-", $rat_tac_details->Maxdate);
												 $aFDate=$aFrom[2].'-'.$aFrom[1].'-'.$aFrom[0];
												 echo $aFDate; 
											 }
										 ?>
									</td>
							  </tr>
						  </table>
						  <br/>
						  <table id="monthDates" border="1" style="margin:0px 0px 0px 190px;">
							  <tr bgcolor="#E6E6FA">
									<th>
										<?php echo $this->lang->line('Dates'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('base_price'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('rack_price'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('sell_price'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('Extra_Bed_Price'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('Total_Rooms'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('Booked_Rooms'); ?>&nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('Available_Rooms'); ?> &nbsp;&nbsp;
									</th>
									<th>
										<?php echo $this->lang->line('Child_Price'); ?>&nbsp;&nbsp;
									</th>
								</tr>
						</table>
						<br/><br/><br/>
						<div class="noprint" style="margin:0px 0px 0px 390px;">
							<table>
								  <tr>
										<a href="<?php echo WEB_URL;?>hotel/edit_pricemanager/<?php echo $rat_tac_details->sup_rate_tactics_id;?>" class="btn btn-primary"><?php echo $this->lang->line('Edit'); ?></a>&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="<?php echo WEB_URL;?>hotel/delete_pricemanager/<?php echo $rat_tac_details->sup_rate_tactics_id;?>" class="btn btn-primary"><?php echo $this->lang->line('Delete'); ?></a>
								  </tr>
							</table>
						</div>
						<br/><br/><br/><br/>
			 </aside><!-- /.right-side -->
			</div><!-- ./wrapper -->
		</body>
</html>
<!-- Bootstrap -->
<script src="<?php echo WEB_DIR;?>js/bootstrap.min.js" type="text/javascript"></script>
<!-- Admin App -->
<script src="<?php echo WEB_DIR;?>js/AdminLTE/app.js" type="text/javascript"></script>

<script>
	function print_Window() {
		window.print();
	}
</script>

<script>
	$(document).ready(function(){	
			$.post( "<?php print WEB_URL ?>hotel/getAvailDates", {rate_id:"<?php echo $rat_tac_details->sup_rate_tactics_id;?>"},
			  function(data) {
				if(data != ''){
					for(var i=0; i<data.avail_dates.length; i++){
						var booked=parseInt(data.avail_dates[i].num_mainrooms)-parseInt(data.avail_dates[i].available_rooms);
						$("#monthDates").append('<tr><td>'+data.avail_dates[i].day+'-'+data.avail_dates[i].month+'-'+data.avail_dates[i].year+' '+data.avail_dates[i].week_day+'</td><td>'+data.avail_dates[i].rate+'</td><td>'+data.avail_dates[i].rack_price+'</td><td>'+data.avail_dates[i].sell_price+'</td><td>'+data.avail_dates[i].extra_bed_price+'</td><td>'+data.avail_dates[i].num_mainrooms+'</td><td>'+booked+'</td><td>'+data.avail_dates[i].available_rooms+'</td><td>'+data.avail_dates[i].child_charge+'</td></tr>');
					}
				} 
			  }
			);
	});
</script>
