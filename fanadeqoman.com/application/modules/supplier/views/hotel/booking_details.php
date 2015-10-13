<?php $this->load->view('header'); ?>  
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
                        Booking Details
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
									<div class="box-body table-responsive">
									<table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th class="sno"><?php echo $this->lang->line('no'); ?></th>
												<th class="Bookingid"><?php echo $this->lang->line('Booking_ID'); ?></th>
												<th class="Bookingdate"><?php echo $this->lang->line('Booking_Date'); ?></th>
												<th class="CheckIn"><?php echo $this->lang->line('CheckIn'); ?></th>
												<th class="fname"><?php echo $this->lang->line('First_Name'); ?></th>
												<th class="lname"><?php echo $this->lang->line('Last_Name'); ?></th>
												<th class="email"><?php echo $this->lang->line('Email'); ?></th>
												<th class="tel"><?php echo $this->lang->line('TelePhone'); ?></th>
												<th class="city"><?php echo $this->lang->line('City'); ?></th>
												<th class="vocher"><?php echo $this->lang->line('Voucher'); ?></th>
												<th class="hotelname"><?php echo $this->lang->line('Hotel_Name'); ?></th>
												<th class="rooms"><?php echo $this->lang->line('No_of_Rooms'); ?></th>
												<th class="status"><?php echo $this->lang->line('Status'); ?></th>
												<th class="currency"><?php echo $this->lang->line('Currency'); ?> </th>
												<th class="sell"><?php echo $this->lang->line('Selling_Price'); ?></th>
                                             </tr>
                                        </thead>
                                        <tbody>
											<?php $i=1;
												if(isset($booking_info) && $booking_info!='')
												{ 
													foreach($booking_info as $details){
														if(isset($supplier_hotels) && $supplier_hotels!='') {
															foreach($supplier_hotels as $hotel_name){
																if($details->hotel_id==$hotel_name->sup_hotel_id){
											?>
												<tr>
													<th class="sno"><?php echo $i; ?></th>
													<th class="Bookingid"><?php echo $details->booking_id; ?></th>
													<th class="Bookingdate"><?php echo $details->created_date; ?></th>
													<th class="CheckIn"><?php echo $details->customer_checkin; ?></th>
													<th class="fname"><?php echo $details->customer_fname; ?></th>
													<th class="lname"><?php echo $details->customer_lname; ?></th>
													<th class="email"><?php echo $details->customer_email; ?></th>
													<th class="tel"><?php echo $details->customer_phone; ?></th>
													<th class="city"><?php echo $details->customer_city; ?></th>
													
													<th style="background-color:#D3FEFA"   class="admin-table-colo-tab vocher">
														<a href="javascript:void(0);" onclick="JavaScript:newPopup('<?php echo WEB_URL; ?>hotel/voucher/<?php echo $details->hotel_id;?>/<?php echo $details->booking_id;?>');">Voucher</a>
													</th>
													<th class="hotelname"><?php echo $details->hotel_name; ?></th>
													<th class="hotelname"><?php echo $details->coustomer_room; ?></th>
													<th class="hotelname"><?php  if($details->status==1) { echo 'Confirmed'; } else { echo 'Cancelled'; } ?></th>
													<th class="hotelname"><?php echo '$'; ?></th>
													<th class="hotelname"><?php echo $details->customer_finalcost; ?></th>
												</tr>
                                            <?php 
													$i++;
																}
															}
														} 	
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
			div.popover.fade.right.in
			{ 
				top:0px !important;
			}
			.popover.right .arrow
			{
				top:7%;
			}
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
