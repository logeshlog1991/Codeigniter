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
		 <script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style>


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
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/room_list">Room List</a></li>
									<li class="active" style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"><?php echo 'Add Room'; ?></a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/roomfacility_list"><?php echo $this->lang->line('Room_Facilites'); ?> </a></li>
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
								<div class="box-header" style="height:50px">
									<table style="text-align:right;position:relative;right:-872px;">
										<tr> 
										<td colspan="3" class="btn btn-primary" style="text-align:right;"><a href="<?php echo WEB_URL;?>hotel/room_list"><b>Back</b></a></td>
										</tr>
										
									</table>
								</div><!-- /.box-header -->
                                
                               <!-- form start -->
                               <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>hotel/add_roomMager_ad" id="formid" method="post">
                               <fieldset><br/><br/>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Hotel_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="hotel_name" name="hotel_name" placeholder="Hotel Name" class="form-control input-md">
											<option value=""> -Select Hotel - </option>
											<?php
												if(isset($hotels) && $hotels!='')
												{
													foreach($hotels as $value)
													{
											?>
											<option value="<?php echo $value->sup_hotel_id;?>"><?php echo $value->hotel_name; ?></option>
											<?php 
													}
												}
											?>
										</select>
										<span style="color:red;" id="error_hotelname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Category'); ?></label>  
									
									<div class="col-xs-12 col-md-4">
									    <div class="input-group custom-input-group">
											<input id="room_category" name="room_category" placeholder="Room Category" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_roomcc"></span>
										</div>
										<br/>
										<div class="input-group custom-input-group">
											<input type="text" id="room_categoryA" name="room_categoryA" placeholder="Room Category" class="form-control input-md arabic"><span class="input-group-addon">Arabic</span>
										</div><br/>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Room_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									 <div class="input-group custom-input-group">
										<input type="text" id="room_type" name="room_type" placeholder="Room Type" class="form-control input-md"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_sproom_policies"></span>
								   	  </div><br/>
								   	  <div class="input-group custom-input-group">
										<input type="text" id="room_typeA" name="room_typeA" placeholder="Room Type" class="form-control input-md arabic"><span class="input-group-addon">Arabic</span>
									  </div><br/>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Adult_Capacity'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									   <div class="input-group custom-input-group">
											<input id="adult_capacity" name="adult_capacity" placeholder="Adult Capacity" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_roomac"></span>
										</div>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Child_Capacity'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									    <div class="input-group custom-input-group">
											<input id="child_capacity" name="child_capacity" placeholder="Child Capacity" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_roomcc"></span>
										</div>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('No_of_Rooms'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<div class="input-group custom-input-group">
											<input id="rooms" name="rooms" placeholder=" No Of Rooms" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_hotelcity"></span>
											<span style="color:red;" id="error_rooms"></span>
										</div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Room_Description'); ?></label>  
								  <div class="col-xs-12 col-md-6">
									    <div class="input-group custom-input-group">
											<textarea id="room_desc" name="room_desc" placeholder="Room Description" class="form-control input-md" type="text"></textarea> <span class="input-group-addon">English</span>
											<span style="color:red;" id="error_roomdesc"></span>
										</div><br/>
										 <div class="input-group custom-input-group">
											<textarea id="room_descA" name="room_descA" placeholder="Room Description" class="form-control input-md arabic" type="text"></textarea> <span class="input-group-addon">Arabic</span>
										</div><br/>
								  </div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Services'); ?></label>  
									<div class="col-xs-12 col-md-4">
										<?php 
											if(isset($services) && $services!=''){
												foreach($services as $value){
										?>
										<input type="checkbox" id="service[]" name="service[]" value="<?php echo $value->sup_fac_id;?>">&nbsp;&nbsp;<?php echo $value->facility_name;?><br/>
										<?php 
												}
											}
										?>
										<span style="color:red;" id="error_services"></span>
									</div>
								</div>
							
								
								
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo 'Check-in'; ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="arrival_time" name="arrival_time" class="form-control input-md">
											<option value=""> -Select Time - </option>
												<?php 
													$start = strtotime('12am'); 
													for ($i = 0; $i < (24 * 4); $i++) { 
														$tod = $start + ($i * 15 * 60); 
														$display = date('h:i A', $tod); 
														if (substr($display, 0, 2) == '00') { 
															$display = '12' . substr($display, 2); 
														} 
												?>
													<option value="<?php echo $display; ?>"><?php echo $display; ?></option>
												<?php 
													} 
												?>
										</select>
										<span style="color:red;" id="error_arrivaltime"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo 'Check-out'; ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="departure_time" name="departure_time" class="form-control input-md">
											<option value=""> -Select Time - </option>
												<?php 
													$start = strtotime('12am'); 
													for ($i = 0; $i < (24 * 4); $i++) { 
														$tod = $start + ($i * 15 * 60); 
														$display = date('h:i A', $tod); 
														if (substr($display, 0, 2) == '00') { 
															$display = '12' . substr($display, 2); 
														} 
												?>
													<option value="<?php echo $display; ?>"><?php echo $display; ?></option>
												<?php 
													} 
												?>
										</select>
										<span style="color:red;" id="error_departuretime"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Check-in'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="checkinextra_time" name="checkinextra_time" class="form-control input-md">
											<option value=""> -Select Time - </option>
												<?php 
													$start = strtotime('12am'); 
													for ($i = 0; $i < (24 * 4); $i++) { 
														$tod = $start + ($i * 15 * 60); 
														$display = date('h:i A', $tod); 
														if (substr($display, 0, 2) == '00') { 
															$display = '12' . substr($display, 2); 
														} 
												?>
													<option value="<?php echo $display; ?>"><?php echo $display; ?></option>
												<?php 
													} 
												?>
										</select>
										Cost:<input type="text" id="check_in_extra_cost" name="check_in_extra_cost" size="8" value="" />Per Hour
										<span style="color:red;" id="error_checkinextratime"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Check-out'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="checkoutextra_time" name="checkoutextra_time" class="form-control input-md">
											<option value=""> -Select Time - </option>
												<?php 
													$start = strtotime('12am'); 
													for ($i = 0; $i < (24 * 4); $i++) { 
														$tod = $start + ($i * 15 * 60); 
														$display = date('h:i A', $tod); 
														if (substr($display, 0, 2) == '00') { 
															$display = '12' . substr($display, 2); 
														} 
												?>
													<option value="<?php echo $display; ?>"><?php echo $display; ?></option>
												<?php 
													} 
												?>
										</select>
										Cost:<input type="text" id="check_out_extra_cost" name="check_out_extra_cost" size="8" value="" />Per Hour
										<span style="color:red;" id="error_checkoutextratime"></span>
								  </div>
								</div>
							    <div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo 'Special Room Policies'; ?></label>  
									 <div class="col-xs-12 col-md-6">
											<div class="input-group custom-input-group">
												<textarea id="sproom_policies" name="sproom_policies" placeholder="sproom policies" class="form-control input-md" type="text"></textarea> <span class="input-group-addon">English</span>
												<span style="color:red;" id="error_roomdesc"></span>
											</div><br/>
											 <div class="input-group custom-input-group">
												<textarea id="sproom_policiesA" name="sproom_policiesA" placeholder="Room Description" class="form-control input-md arabic" type="text"></textarea> <span class="input-group-addon">Arabic</span>
											</div><br/>
									  </div>
								</div>
								<input id="web_url" name="web_url" class="form-control input-md" type="hidden" value="<?php echo WEB_URL; ?>"> 
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
<script>
    CKEDITOR.replace( 'room_desc' );
	CKEDITOR.replace( 'sproom_policies' );
    CKEDITOR.replace( 'room_descA' );
    CKEDITOR.replace( 'sproom_policiesA' );
</script>
