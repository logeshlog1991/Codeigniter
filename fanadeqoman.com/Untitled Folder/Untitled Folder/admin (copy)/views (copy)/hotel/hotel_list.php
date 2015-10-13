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
                        <?php echo $this->lang->line('Hotel_lists'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
                    </ol>
                </section>
					
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $this->lang->line('Hotel_lists'); ?></h3></div>
                                    <div class="box-add" style="text-align:right;position:relative;right:12px;">
                            <button class="btn btn-primary" onClick="window.location='<?php echo WEB_URL;?>hotel/hotel_registration';"><?php echo $this->lang->line('Add_Hotel'); ?></button>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('no'); ?></th>
                                                <th><?php echo $this->lang->line('Hotel_Name'); ?></th>
                                                <th>Star Rating</th>
                                                <th>Hotel Type</th>
                                                <th>Region</th>
                                                <th>City/Town</th>
                                                <th>Area</th>
                                                <th>Contract Start</th>
                                                <th>Contract End</th>
                                                <th>Contract Remaining Days</th>
                                                <th><?php echo $this->lang->line('Contact_Name'); ?></th>
                                                <th><?php echo $this->lang->line('Contact_Email'); ?></th>
                                                <th><?php echo $this->lang->line('Status'); ?></th>
                                                <th><?php echo $this->lang->line('Action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												$i=1;
												if(isset($result) && $result!=''){ 
													foreach($result as $hotel) {
											 ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $hotel->hotel_name; ?></td>
                                                <td>
													<?php
													echo  $this->Hotel_Model->get_Star($hotel->star);
													?>
												</td>
                                                <td>
													<?php
													echo  $this->Hotel_Model->get_Type($hotel->hotel_type);
													?>
												</td>
                                                <td>
													<?php
													echo  $this->Hotel_Model->get_Region($hotel->hotel_region);
													?>
												</td>
                                                <td>
													<?php
													echo  $this->Hotel_Model->get_City($hotel->city);
													?>
												</td>
                                                <td>
													<?php
													echo  $this->Hotel_Model->get_Area($hotel->hotel_area);
													?>
												</td>
                                                <td>
													<?php
													echo $hotel->start_date;
													?>	
												</td>
                                                <td>
													<?php
													echo $hotel->end_date;
													?>
												</td>
                                                <td>
													<?php
														 $now = strtotime(date("d-m-Y")); // or your date as well
														 $your_date = strtotime($hotel->end_date);
														 $datediff =$your_date - $now;
														 if(floor($datediff/(60*60*24))<1){
															 echo 'Expired';
														 }else{
															 echo floor($datediff/(60*60*24));
														 }
													?>
											    </td>
                                                <td>
													<?php
													echo $hotel->contact_first_name.' '.$hotel->contact_last_name;
													?>
												</td>
                                                <td>
													<?php
													echo $hotel->contact_person_email;
													?>
												</td>
                                                <td><?php if($hotel->status==1) { echo 'Active'; } else { echo 'InActive'; } ?></td>
                                                <td>
													<a href="<?php echo WEB_URL;?>hotel/view_hotel/<?php echo $hotel->sup_hotel_id;?>">View</a>&nbsp;&nbsp;/&nbsp;&nbsp;<?php if($hotel->status!=1){ ?> <a href="<?php echo WEB_URL;?>hotel/Active_hotel/<?php echo $hotel->sup_hotel_id;?>"><?php echo $this->lang->line('Active'); ?></a><?php }else{ ?><a href="<?php echo WEB_URL;?>hotel/Inactive_hotel/<?php echo $hotel->sup_hotel_id;?>"><?php echo $this->lang->line('InActive'); ?></a><?php } ?>
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
