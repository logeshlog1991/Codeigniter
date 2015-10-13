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
                        Room Manager
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
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/room_category"><?php echo $this->lang->line('Room_Category'); ?></a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/roomtype_list"><?php echo $this->lang->line('Room_Type'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/roomcount_list"><?php echo $this->lang->line('Room_Count'); ?> </a></li>
									<li style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/roompolicy_list"><?php echo $this->lang->line('Room_Policy'); ?> </a></li>
									<li class="active" style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"><?php echo $this->lang->line('Room_Facilites'); ?> </a></li>
							 </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
						<div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
									<form name="f2" action="<?php echo WEB_URL;?>hotel/add_roomfacilites" method="post">
										<table style="text-align:right;position:relative;right:-572px;">
											<tr> 
											</tr>
											<tr>
												<td> <h4><?php echo $this->lang->line('Add_Facilites'); ?>&nbsp;&nbsp;</h4></td>
												<td>
													<input type="text" class="form-control" name="add_roomfac_name" id="add_roomfac_name" placeholder="Add Facilites" required>
												</td>
												<td> 
													<div class="box-footer">
														<button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
								</div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('no'); ?></th>
                                                <th><?php echo $this->lang->line('Services'); ?></th>
                                                <th><?php echo $this->lang->line('Status'); ?></th>
                                                <th><?php echo $this->lang->line('Action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
									<?php
									 if($room_fac_list!=''){ 
									for($i=0;$i<count($room_fac_list);$i++) {
									 ?>
                                            <tr>
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $room_fac_list[$i]->facility_name; ?></td>
                                                <td><?php if($room_fac_list[$i]->status==1) { echo 'Active'; } else { echo 'InActive'; } ?></td>
                                                <td><?php if($room_fac_list[$i]->status!=1) { ?><a href="<?php echo WEB_URL;?>hotel/Active_room_fac/<?php echo $room_fac_list[$i]->sup_fac_id;?>"><?php echo $this->lang->line('Active'); ?>&nbsp;&nbsp;/</a><?php }else{ ?><a href="<?php echo WEB_URL;?>hotel/InActive_room_fac/<?php echo $room_fac_list[$i]->sup_fac_id;?>">&nbsp;<?php echo $this->lang->line('InActive'); ?>&nbsp;/&nbsp;&nbsp;</a><?php } ?><a onclick="return confirm('Are you sure want to delete')" href="<?php echo WEB_URL;?>hotel/delete_room_fac/<?php echo $room_fac_list[$i]->sup_fac_id;?>">&nbsp;&nbsp;<?php echo $this->lang->line('Delete'); ?></a></td>
                                            </tr>
                                           <?php } } ?> 
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
