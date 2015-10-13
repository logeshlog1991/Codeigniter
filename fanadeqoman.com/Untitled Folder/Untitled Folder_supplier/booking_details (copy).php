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
									<div class="box-body table-responsive"><!--<a style="margin:0px 0px 0px 229px;color:green;" href="<?php echo WEB_URL; ?>hotel/download">Download</a>-->&nbsp;&nbsp;
										<!--<button id="popover" type="button" class="btn btn-lg btn-primary" data-toggle="popover" title="Select Tittle" data-content="
										<input type='checkbox' class='bi'>&nbsp;Booking ID&nbsp;&nbsp;<input type='checkbox' class='bd'>&nbsp;Booking Date<br/><input type='checkbox' class='ci'>&nbsp;CheckIn&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' class='fn'>&nbsp;First Name<br/><input type='checkbox' class='ln'>&nbsp;Last Name&nbsp;&nbsp;&nbsp;<input type='checkbox' class='eml'>&nbsp;E-mail<br/><input type='checkbox' class='tl'>&nbsp;TelePhone&nbsp;&nbsp;&nbsp;<input type='checkbox' class='ct'>&nbsp;City<br/><input type='checkbox' class='cl'>&nbsp;Cancellation&nbsp;<input type='checkbox' class='vo'>&nbsp;Voucher<br/><input type='checkbox' class='hm'>&nbsp;Hotel Name&nbsp;&nbsp;<input type='checkbox' class='rm'>&nbsp;No Rooms<br/><input type='checkbox' class='rt'>&nbsp;Room Type&nbsp;&nbsp;&nbsp;<input type='checkbox' class='bs'>&nbsp;Basis <br/><input type='checkbox' class='pp'>&nbsp;Purchase Price&nbsp;&nbsp;<input type='checkbox' class='cr'>&nbsp;Currency <br/><input type='checkbox' class='sel'>&nbsp;Selling Price&nbsp;&nbsp;&nbsp;<input type='checkbox' class='pf'>&nbsp;Profit<br/><input type='checkbox' class='pg'>&nbsp;Payment Gateway<br/><input type='checkbox' class='pa'>&nbsp;Profit After Payment Gateway">Toggle</button>-->
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
                                                <th class="cancel"><?php echo $this->lang->line('Cancellation'); ?> </th>
                                                <th class="vocher"><?php echo $this->lang->line('Voucher'); ?></th>
                                                <th class="invoice"><?php echo $this->lang->line('Invoice'); ?></th>
                                                <th class="hotelname"><?php echo $this->lang->line('Hotel_Name'); ?></th>
                                                <th class="city1"><?php echo $this->lang->line('City'); ?></th>
                                                <th class="rooms"><?php echo $this->lang->line('No_of_Rooms'); ?></th>
                                                <th class="roomtype"><?php echo $this->lang->line('Room_Type'); ?></th>
                                                <th class="basis"><?php echo $this->lang->line('Basis'); ?></th>
                                                <th class="status"><?php echo $this->lang->line('Status'); ?></th>
                                                <th class="purchase"><?php echo $this->lang->line('Purchase_Price'); ?></th>
                                                <th class="currency"><?php echo $this->lang->line('Currency'); ?> </th>
                                                <th class="sell"><?php echo $this->lang->line('Selling_Price'); ?></th>
                                                <th class="profit"><?php echo $this->lang->line('Profit'); ?></th>
                                                <th class="payment"><?php echo $this->lang->line('Payment_Gateway_Charge'); ?></th>
                                                <th class="gateway"><?php echo $this->lang->line('Profit_after_Payment_Gateway_Charges'); ?></th>
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
													<th class="Bookingid"><?php echo $details->prn_no; ?></th>
													<th class="Bookingdate"><?php echo $details->created_date; ?></th>
													<th class="CheckIn"><?php echo $details->check_in; ?></th>
													<th class="fname"><?php echo $details->first_name; ?></th>
													<th class="lname"><?php echo $details->last_name; ?></th>
													<th class="email"><?php echo $details->email; ?></th>
													<th class="tel"><?php echo $details->phone; ?></th>
													<th class="city"><?php echo $details->city; ?></th>
													<th class="cancel">
														<?php
															$today=date("Y-m-d");
															$expire = $details->admin_cancel; //from db
															$today_time = strtotime($today);
															$expire_time = strtotime($expire);
															$cancel_time = strtotime($details->cancellation_till_date);
															if($type=='Failed'){ 
																echo "Failed";
															}else{
																	if($details->status != 'CANCELLED' ){ 
																			if($details->api=='desiya'){ 
																				$url_c='cancel_booking_desiya'; 
																			}else{
																				$url_c='cancel_booking';
																			}
														?>
														<a href="<?php echo WEB_URL; ?>index/<?php echo $url_c; ?>/<?php echo $details->transaction_details_id; ?>">Cancel</a> 
														<?php
																	}else{ 
																		echo 'Cancelled';
																	} 
															}	
														?>
													</th>
													<th style="background-color:#D3FEFA"   class="admin-table-colo-tab vocher">
														<a  href="javascript:void(0);" onclick="JavaScript:newPopup('<?php echo WEB_URL; ?>index/print_voucher/<?php echo $details->hotel_booking_id; ?>');" ><?php if($type!='Failed') echo "Voucher";?></a>
														<a href="<?php echo WEB_URL; ?>index/send_by_mail/<?php echo $details->hotel_booking_id; ?>/vo"><?php if($type!='Failed') echo "Mail";?></a>
													</th>
													<th style="background-color:#D3FEFA"   class="admin-table-colo-tab invoice">
														<a  href="javascript:void(0);" onclick="JavaScript:newPopup('<?php echo WEB_URL; ?>index/print_invoice/<?php echo $details->hotel_booking_id; ?>');" ><?php if($type!='Failed') echo "Invoice";?></a>
														<a href="<?php echo WEB_URL; ?>index/send_by_mail/<?php echo $details->hotel_booking_id; ?>/in"><?php if($type!='Failed') echo "Mail";?></a>
													</th>
													<th class="hotelname"><?php echo $details->hotel_name; ?></th>
													<th class="city1"><?php echo $details->city; ?></th>
														<?php
															$a = explode("-",$details->room_type);
														?>
													<th class="rooms"><?php echo $details->no_of_room; ?></th>
													<th class="roomtype"><?php echo $a[0]; ?></th>
													<th class="basis"><?php echo $a[0]; ?></th>
													<th class="status"><?php echo $details->status; ?></th>
													<th class="purchase"><?php echo round($details->amount-($details->markup+$details->gateway)); ?></th>
													<th class="currency"><?php echo $details->req_currency; ?></th>
													<th class="sell"><?php echo round($details->amount); ?></th>
													<th class="profit"><?php echo round($details->markup); ?></th>
													<th class="payment"><?php echo round($details->gateway); ?></th>
													<th class="gateway"><?php echo round($details->markup+$details->gateway); ?></th>
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

<style>div.popover.fade.right.in{ top:0px !important;}
.popover.right .arrow{ top:7%;}</style>
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

    </body>
</html>
