<?php $this->load->view('header'); ?>  
		<style>
			.book {
				background-color: #C2EBFF;
			}
			.guest {
				background-color: #E08566;
			}
		</style>
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
				 <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                
                 </section><!-- /.content -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $this->lang->line('Booking_Manager'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/B2C_bookingReports"><?php echo $this->lang->line('Booking_Details'); ?></a></li>
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"><?php echo $this->lang->line('Booking_Price'); ?></a></li>
                             </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header"><br/>
									<!--<div class="box-body table-responsive"><a style="margin:0px 0px 0px 229px;color:green;" href="<?php echo WEB_URL; ?>hotel/download_b2c"><?php echo $this->lang->line('Download'); ?></a>&nbsp;&nbsp;-->
									<table id="example1" class="table table-bordered table-striped">
                                        <thead>
											<tr>												
												<th colspan="1">													
												</th>
												<th class="book" colspan="3">
													Booking Source Details
												</th>
												<th class="guest" colspan="3">
													Hotel Details
												</th>
												<th class="book" colspan="8">
													Booking Details
												</th>
												<th class="guest" colspan="11">
													Price Details
												</th>
											</tr>
                                            <tr>
                                                <th class="sno"><?php echo $this->lang->line('no'); ?></th>
                                                
                                                <!-- Booking Source Details-->
                                                <th class="sno">Booking Source</th>
                                                <th class="sno">Agent Name/User/Reg.User</th>
                                                <th class="sno">Agent ID</th>
                                                
                                                 <!-- Hotel Details-->
                                                <th class="hotelname"><?php echo $this->lang->line('Hotel_Name'); ?></th>
                                                <th class="hotelname"><?php echo $this->lang->line('Hotel_Address'); ?></th>
                                                <th class="hotelname">Star Rating</th>
                                                
                                                <!-- Booking Details-->
												<th class="Bookingdate"><?php echo $this->lang->line('Booking_Date'); ?></th>
                                                <th class="Bookingid"><?php echo $this->lang->line('Booking_ID'); ?></th>
                                                <th class="CheckIn"><?php echo $this->lang->line('CheckIn'); ?></th>
                                                <th class="CheckIn"><?php echo $this->lang->line('checkout');?></th>
                                                <th class="CheckIn">NO of Days</th>
                                                <th class="CheckIn">NO of Rooms</th>
                                                <th class="status"><?php echo $this->lang->line('Status'); ?></th>
                                                
                                                 <!-- Price Details-->
                                                <th class="currency"><?php echo $this->lang->line('Currency'); ?> </th>
                                                <th class="sell"><?php echo $this->lang->line('Selling_Price'); ?></th>
                                                <th class="sell"><?php echo $this->lang->line('base_price'); ?></th>
												<th class="cancel"><?php echo $this->lang->line('Admin_Markup'); ?> </th>
												<th class="sell">Star Rating Markup</th>
												<th class="sell"><?php echo $this->lang->line('Country_Markup'); ?></th>
                                                <th class="cancel"><?php echo $this->lang->line('Call_Center_Markup'); ?> </th>
                                                <th class="cancel"><?php echo $this->lang->line('Payment_Gateway'); ?> </th>
                                                <th class="cancel">Total Markup(%)</th>
                                                <th class="cancel">Total Markup Amount </th>
                                                <th class="sell"><?php echo $this->lang->line('reAmount'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $i=1;
												if(isset($booking_info) && $booking_info!='')
												{ 
													foreach($booking_info as $details){
											?>
												<tr>
													<td class="sno"><?php echo $i; ?></td>
													
													<!-- Booking Source Details-->
													<td class="sno"><?php if($details->user_type==1){ echo 'Callcenter';}else{ echo 'B2C'; } ?></td>
													<td class="sno"><?php echo $details->booking_name; ?></td>
													<td class="sno"><?php echo $details->agent_id; ?></td>
													
													<!-- Hotel Details-->
													<td class="hotelname"><?php echo $details->hotel_name; ?></td>
													<td class="hotelname">
														<?php 
															echo $this->Hotel_Model->get_Area($details->hotel_area).','.$this->Hotel_Model->get_City($details->city).','.$this->Hotel_Model->get_Region($details->hotel_region).$this->Hotel_Model->get_country($details->country);
														?>
													</td>
													<td class="hotelname"><?php echo $details->star; ?></td>
													
													<!-- Booking Details--> 
													<td class="Bookingdate"><?php echo $details->created_date; ?></td>
													<td class="Bookingid"><?php echo $details->booking_id; ?></td>
													<td class="CheckIn"><?php echo $details->customer_checkin; ?></td>
													<td class="CheckIn"><?php echo $details->customer_checkout; ?></td>
													<td class="CheckIn"><?php echo $details->no_days; ?></td>
													<td class="CheckIn"><?php echo $details->coustomer_room; ?></td>
													<td class="status"><?php if($details->STA==1) { echo "Confirmed"; } else { echo "<span style=color:red;>Cancelled</span>"; } ?></td>
													
												    <!-- Price Details-->
												    <td class="currency"><?php 	echo 'USD'; ?></td>
												    <td class="purchase"><?php echo $details->customer_finalcost; ?></td>
												    <td class="purchase"><?php echo $details->room_baseprice; ?></td>
												    <td class="purchase"><?php echo $details->markup; ?></td>
												    <td class="purchase"><?php echo $details->star_markup; ?></td>
												    <td class="purchase"><?php echo $details->country_markup; ?></td>
												    <td class="purchase"><?php if(isset($details->callcenter_markup) && $details->callcenter_markup!=''){ echo $details->callcenter_markup; }else{ echo '0';} ?></td>
												    <td class="purchase"><?php if(isset($details->gateway) && $details->gateway!=''){ echo $details->gateway; }else{ echo '0';} ?></td>
												    <td class="purchase"><?php echo $details->country_markup+$details->star_markup+$details->markup+$details->callcenter_markup+$details->gateway; ?></td>
												    <td class="purchase">
														<?php 
															echo ($details->customer_finalcost-$details->room_baseprice); 
														?>
													</td>
												    <td class="purchase"><?php if(isset($details->customer_canceltotal) && $details->customer_canceltotal!=''){ echo $details->customer_canceltotal;}else{ echo '0'; } ?></td>
												</tr>
                                            <?php 
													$i++;
													}
												} 
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

		<style>
			div.popover.fade.right.in{ top:0px !important;}
			.popover.right .arrow{ top:7%;}
		</style>
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
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });      
                $('#popover').popover({
					html: 'true',
					
				});
            });
            
            $(document).on("click",".bi",function(){
					$(".Bookingid").toggle();
			});
			$(document).on("click",".bd",function(){
					$(".Bookingdate").toggle();
			});
			$(document).on("click",".ci",function(){
					$(".CheckIn").toggle();
			});
			$(document).on("click",".fn",function(){
					$(".fname").toggle();
			});
			$(document).on("click",".ln",function(){
					$(".lname").toggle();
			});
			$(document).on("click",".eml",function(){
					$(".email").toggle();
			});
			$(document).on("click",".tl",function(){
					$(".tel").toggle();
			});
			$(document).on("click",".ct",function(){
					$(".city").toggle();
			});
			$(document).on("click",".cl",function(){
					$(".cancel").toggle();
			});
			$(document).on("click",".vo",function(){
					$(".vocher").toggle();
			});
			$(document).on("click",".hm",function(){
					$(".hotelname").toggle();
			});
			$(document).on("click",".rm",function(){
					$(".rooms").toggle();
			});
			$(document).on("click",".rt",function(){
					$(".roomtype").toggle();
			});
			$(document).on("click",".bs",function(){
					$(".basis").toggle();
			});
			$(document).on("click",".pp",function(){
					$(".purchase").toggle();
			});
			$(document).on("click",".cr",function(){
					$(".currency").toggle();
			});
			$(document).on("click",".sel",function(){
					$(".sell").toggle();
			});
			$(document).on("click",".pf",function(){
					$(".profit").toggle();
			});
			$(document).on("click",".pg",function(){
					$(".payment").toggle();
			});
			$(document).on("click",".pa",function(){
					$(".gateway").toggle();
			});
        </script>
<script>
		function newPopup(url) { 
			popupWindow = window.open(
			url,'popUpWindow','height=500,width=1100,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}
	</script>
    </body>
</html>
