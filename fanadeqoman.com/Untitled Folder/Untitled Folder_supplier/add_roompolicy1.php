<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Supplier Console</title>
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
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="#tab_1" data-toggle="tab"> <?php echo $this->lang->line('Room_Manager'); ?></a></li>
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
										<td colspan="3" class="btn btn-primary" style="text-align:right;"><a href="<?php echo WEB_URL;?>hotel/roompolicy_list"><b>Back</b></a></td>
										</tr>
										
									</table>
								</div><!-- /.box-header -->
                         <!-- form start -->
                         <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>hotel/roompolicy_ad" id="formid" method="post" onsubmit="return roompolicy_ad()">
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
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Arrival'); ?></label>  
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
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Departure'); ?></label>  
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
										Cost:<input type="text" id="check_in_extra_cost" name="check_in_extra_cost" size="8" value="" />
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
										Cost:<input type="text" id="check_out_extra_cost" name="check_out_extra_cost" size="8" value="" />
										<span style="color:red;" id="error_checkoutextratime"></span>
								  </div>
								</div>
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
