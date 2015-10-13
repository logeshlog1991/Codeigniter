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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
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
                    <h1>
                      <?php echo $this->lang->line('Room_Manager'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i>  <?php echo $this->lang->line('Home'); ?></a></li>
                    </ol>
                </section>
					
                    
                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
									<li class="active" style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);">Room List</a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);" onclick="return room_category()"><?php echo $this->lang->line('Room_Category'); ?></a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/add_roomtype"><?php echo $this->lang->line('Room_Type'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);" onclick="return roomcount_list()"><?php echo $this->lang->line('Room_Count'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);" onclick="return roompolicy_list()"><?php echo $this->lang->line('Room_Policy'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/roomfacility_list"><?php echo $this->lang->line('Room_Facilites'); ?> </a></li>
							 </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-add" style="text-align:right;position:relative;right:12px;">
									<button class="btn btn-primary" onClick="window.location='<?php echo WEB_URL;?>hotel/add_category';"><?php echo $this->lang->line('Add_Cotegory'); ?></button>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('no'); ?></th>
                                                <th><?php echo $this->lang->line('Hotel_Name'); ?></th>
                                                <th>Star Rating</th>
                                                <th><?php echo $this->lang->line('Room_Category'); ?></th>
                                                <th>Room Type</th>
                                                <th><?php echo $this->lang->line('Services'); ?></th>
                                                <th>Adult</th>
                                                <th>Child</th>
                                                <th>No of Rooms</th>
                                                <th>Check-In</th>
                                                <th>Check-Out</th>
                                                <th>Status</th>
												<th><?php echo $this->lang->line('Action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $i=1;
												if(isset($room_list) && $room_list!=''){ 
													foreach($room_list as $list) {
														$arr=unserialize($list->hotel_room_services);
														
											?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $list->hotel_name; ?></td>
                                                <td><?php echo $this->Hotel_Model->get_Star($list->star); ?></td>
                                                <td><?php echo $list->hotel_room_type; ?></td>
                                                <td><?php echo $list->capacity_title; ?></td>
                                                <td>
													<?php 
														if(count($arr)>0){
															$data='';
															foreach($arr as $value1){ 
																$res=$this->Hotel_Model->category($value1);
																$data.=$res.",";
															}
															echo rtrim($data,','); 
														}
													?>
												</td>
												 <td><?php echo $list->capacity; ?></td>
												 <td><?php echo $list->child_capacity; ?></td>
												 <td><?php echo $list->no_of_rooms; ?></td>
												 <td><?php echo $list->arrivaltime_from; ?></td>
												 <td><?php echo $list->departtime_before; ?></td>
												 <td><?php if($list->main_status==1){ echo 'Active'; }else{ echo 'InActive'; } ?></td>
                                                 <td>
													 <?php if($list->main_status==1){ ?> 
														<a href="<?php echo WEB_URL;?>hotel/Inactive_roomManager/<?php echo $list->sup_hotel_room_type_id;?>/<?php echo $list->hotel_id;?>/<?php echo $list->sup_inv_cate_type_id;?>/<?php echo $list->sup_apart_houserules_id;?>/<?php echo $list->capacity_id;?>">Inactive</a>
													<?php }else{ ?>
														<a href="<?php echo WEB_URL;?>hotel/Active_roomManager/<?php echo $list->sup_hotel_room_type_id;?>/<?php echo $list->hotel_id;?>/<?php echo $list->sup_inv_cate_type_id;?>/<?php echo $list->sup_apart_houserules_id;?>/<?php echo $list->capacity_id;?>">Active</a>
														<?php } ?>&nbsp;&nbsp;/&nbsp;&nbsp;
														<a href="<?php echo WEB_URL;?>hotel/View_roomManager/<?php echo $list->sup_hotel_room_type_id;?>/<?php echo $list->hotel_id;?>/<?php echo $list->sup_inv_cate_type_id;?>/<?php echo $list->sup_apart_houserules_id;?>/<?php echo $list->capacity_id;?>">View</a>
												</td>
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
            });
        </script>

    </body>
</html>
	<script>
		function room_category()
		{
			alert("Please Select Add Category");
		}
		function roomtype_list()
		{
			alert("Please Select Add Category");
		}
		function roomcount_list()
		{
			alert("Please Select Add Category");
		}
		function roompolicy_list()
		{
			alert("Please Select Add Category");
		}
	</script>
