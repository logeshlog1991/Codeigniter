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
									<li class="active" style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_roomtype/<?php echo $category_id; ?>/<?php echo $hotel_id; ?>/<?php echo $roomtype_id; ?>/<?php echo $policy_id; ?>/<?php echo $capacity_id; ?>"><?php echo $this->lang->line('Room_Type'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/edit_roomcount/<?php echo $category_id; ?>/<?php echo $hotel_id; ?>/<?php echo $roomtype_id; ?>/<?php echo $policy_id; ?>/<?php echo $capacity_id; ?>"><?php echo $this->lang->line('Room_Count'); ?> </a></li>
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
                               <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>hotel/editroomtype_ad/<?php echo $roomtype->capacity_id;?>" id="formid" method="post" onsubmit="return roomtype_ad()">
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
														if($roomtype->hotel_id==$value->sup_hotel_id){
											?>
											<option value="<?php echo $value->sup_hotel_id;?>" <?php if(isset($roomtype->hotel_id) && $roomtype->hotel_id!=''){ if($roomtype->hotel_id==$value->sup_hotel_id){ echo 'selected="selected"'; }}  ?> ><?php echo $value->hotel_name; ?></option>
											<?php 
														}
													}
												}
											?>
										</select>
										<span style="color:red;" id="error_hotelname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo 'Room Category'; ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="category_id" name="category_id" placeholder="Hotel Name" class="form-control input-md">
											<?php
												if(isset($room_cate) && $room_cate!='')
												{
													foreach($room_cate as $val)
													{
											?>
											<option value="<?php echo $val->sup_hotel_room_type_id;?>" <?php if(isset($roomtype->sup_hotel_room_type_id) && $roomtype->sup_hotel_room_type_id!=''){ if($roomtype->sup_hotel_room_type_id==$val->sup_hotel_room_type_id){ echo 'selected="selected"'; }}  ?> ><?php echo $val->hotel_room_type; ?></option>
											<?php 
													}
												}
											?>
										</select>
										<span style="color:red;" id="error_roomtype"></span>
								  </div>
								</div>
								<div class="form-group">
									  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Room_Type'); ?></label>  
									  <div class="col-xs-12 col-md-4">
										   <div class="input-group custom-input-group">
												<input id="room_type" name="room_type" placeholder=" Room Type" class="form-control input-md" type="text" value="<?php if(isset($roomtype->capacity_title) && $roomtype->capacity_title!=''){ echo $roomtype->capacity_title; }  ?>" ><span class="input-group-addon">English</span>
												<span style="color:red;" id="error_roomtype"></span>
										   </div><br/>
											<div class="input-group custom-input-group">
												<input id="room_typeA" name="room_typeA" placeholder=" Room Type" class="form-control input-md" type="text" value="<?php if(isset($roomtype->capacity_titleA) && $roomtype->capacity_titleA!=''){ echo $roomtype->capacity_titleA; }  ?>"><span class="input-group-addon">Arabic</span>
											</div><br/>
									  </div>
									</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Adult_Capacity'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									    <div class="input-group custom-input-group">
											<input id="adult_capacity" name="adult_capacity" placeholder="Adult Capacity" class="form-control input-md" type="text" value="<?php if(isset($roomtype->capacity) && $roomtype->capacity!=''){ echo $roomtype->capacity; } ?>"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_roomac"></span>
										</div>
								 </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Child_Capacity'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="child_capacity" name="child_capacity" placeholder="Child Capacity" class="form-control input-md" type="text" value="<?php if(isset($roomtype->child_capacity) && $roomtype->child_capacity!=''){ echo $roomtype->child_capacity; } ?>"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_roomcc"></span>
									  </div>
								  </div>
								</div>
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
