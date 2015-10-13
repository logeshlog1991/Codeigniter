<?php
	$res='';
	$category_id=$this->uri->segment(3);
	$hotel_id=$this->uri->segment(4);
	$roomtype_id=$this->uri->segment(5);
	$policy_id=$this->uri->segment(6);
	$capacity_id=$this->uri->segment(7);
	$res=$this->uri->segment(8);
?>
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
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_category/<?php echo $category_id; ?>/<?php echo $hotel_id; ?>/<?php echo $roomtype_id; ?>/<?php echo $policy_id; ?>/<?php echo $capacity_id; ?>"><?php echo $this->lang->line('Room_Category'); ?></a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_roomtype/<?php echo $category_id; ?>/<?php echo $hotel_id; ?>/<?php echo $roomtype_id; ?>/<?php echo $policy_id; ?>/<?php echo $capacity_id; ?>"><?php echo $this->lang->line('Room_Type'); ?> </a></li>
									<li class="active" style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_roomcount/<?php echo $category_id; ?>/<?php echo $hotel_id; ?>/<?php echo $roomtype_id; ?>/<?php echo $policy_id; ?>/<?php echo $capacity_id; ?>"><?php echo $this->lang->line('Room_Count'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_roomplicy/<?php echo $category_id; ?>/<?php echo $hotel_id; ?>/<?php echo $roomtype_id; ?>/<?php echo $policy_id; ?>/<?php echo $capacity_id; ?>"><?php echo $this->lang->line('Room_Policy'); ?> </a></li>
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
                               <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>hotel/edit_roomcount_ad/<?php echo $room_count->sup_inv_cate_type_id; ?>" id="formid" method="post" onsubmit="return edit_roomcount_ad()">
                               <fieldset><br/><br/>
								   <?php if(isset($res) && $res!=''){ ?>
										<p style="color:green;margin:0px 0px 0px 278px;">Successfully Updated </p>
								   <?php } ?>
                               <div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Hotel_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="hotel_name" name="hotel_name" placeholder="Hotel Name" class="form-control input-md">
											<?php
												if(isset($hotels) && $hotels!='')
												{
													foreach($hotels as $value)
													{
														if(isset($room_count->hotel_id) && $room_count->hotel_id!='')
														{ 
																if($room_count->hotel_id==$value->sup_hotel_id)
																{
											?>
											<option value="<?php echo $value->sup_hotel_id;?>"><?php echo $value->hotel_name; ?></option>
											<?php 				}
														}
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
										<?php if(isset($room_count->room_type) && $room_count->room_type!=''){ ?>
											<select name="room_type" id="room_type" class="form-control input-md">
												<option value="<?php echo $room_count->room_type; ?>"><?php echo $room_count->hotel_room_type; ?></option>
											</select>
										<?php }else{ ?>
										<p id="roomTypes" style="color:red;">Sorry No Room Category found in this hotel !</p>
										<?php } ?>
										<span style="color:red;" id="error_capacitytype"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Room_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <?php if(isset($room_count->max_person) && $room_count->max_person!=''){ ?>
											<select name="capacity_type" id="capacity_type" class="form-control input-md">
												<option value="<?php echo $room_count->max_person; ?>">
													<?php 
														$type=$this->Hotel_Model->get_roomType($room_count->max_person);
														echo $type->capacity_title;
													?>
												</option>
											</select>
										<?php }else{ ?>
										<p id="roomTypeCapacity" style="color:red;">Sorry No Room Type found in this hotel !</p>
										<?php } ?>
										<span style="color:red;" id="error_room_type"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('No_of_Rooms'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="rooms" name="rooms" placeholder=" No Of Rooms" class="form-control input-md" type="text" value="<?php echo $room_count->no_of_rooms; ?>" >
										<span style="color:red;" id="error_rooms"></span>
								  </div>
								</div>
								<!--<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Check-In</label>  
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
													<option value="<?php echo $display; ?>" <?php if(isset($room_count->arrival_time) && $room_count->arrival_time!=''){ if($room_count->arrival_time==$display){ echo 'selected="Selected"';} } ?>><?php echo $display; ?></option>
												<?php 
													} 
												?>
										</select>
										<span style="color:red;" id="error_arrivaltime"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Check-Out</label>  
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
													<option value="<?php echo $display; ?>" <?php if(isset($room_count->departure_time) && $room_count->departure_time!=''){ if($room_count->departure_time==$display){ echo 'selected="Selected"';} } ?>><?php echo $display; ?></option>
												<?php 
													} 
												?>
										</select>
										<span style="color:red;" id="error_departuretime"></span>
								  </div>
								</div>-->
								<input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL;?>">
								<input id="category_id12" name="category_id12" type="hidden" value="<?php echo $category_id; ?>"> 
								<input id="hotel_id12" name="hotel_id12" type="hidden" value="<?php echo $hotel_id; ?>"> 
								<input id="roomtype_id12" name="roomtype_id12" type="hidden" value="<?php echo $roomtype_id; ?>"> 
								<input id="policy_id12" name="policy_id12" type="hidden" value="<?php echo $policy_id; ?>"> 
								<input id="capacity_id12" name="capacity_id12" type="hidden" value="<?php echo $capacity_id; ?>"> 
								
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
