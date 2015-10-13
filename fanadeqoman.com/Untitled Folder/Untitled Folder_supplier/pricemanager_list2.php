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
                        <?php echo $this->lang->line('Price_Manager'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
                    </ol>
                </section>
				<!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-add" style="text-align:right;position:relative;right:12px;">
									<button class="btn btn-primary" onClick="window.location='<?php echo WEB_URL;?>hotel/add_pricemanager';"><?php echo 'Add Pricemanager'; ?></button>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('no'); ?></th>
                                                <th><?php echo $this->lang->line('Hotel_Name'); ?></th>
                                                <th>Star Rating</th>
                                                <th>Room Category</th>
                                                <th>Room Type</th>
                                                <th>Room Available From</th>
                                                <th>Room Available To</th>
                                                <th>Currency</th>
                                                <th>Selling Price</th>
                                                <th>Base Price</th>
                                                <th>Rack Price</th>
                                                <th>Country Markup(%)</th>
                                                <th>Star Rate Markup(%)</th>
                                                <th>Admin Markup(%)</th>
                                                <th>Callcenter Markup(%)</th>
                                                <th>Payment Gateway(%)</th>
                                                <th>Total Markup(%)</th>
                                                <th>Total Markup Amount</th>
                                                <th><?php echo $this->lang->line('Status'); ?></th>
                                                <th><?php echo $this->lang->line('Action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $i=1;$All_markup=0;
												if(isset($price_manager) && $price_manager!=''){ 
													foreach($price_manager as $price) {
														if($price->sell_price!=''){
											?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $price->hotel_name; ?></td>
                                                <td><?php echo $price->star_name; ?></td>
                                                <td><?php echo $price->hotel_room_type; ?></td>
                                                <td><?php echo $price->capacity_title; ?></td>
                                                <td>
													<?php 
														$arr=explode("-",$price->mindate);
														echo $arr[2].'-'.$arr[1].'-'.$arr[0]; 
													?>
												</td>
                                                <td>
													<?php 
														$arr=explode("-",$price->mdate);
														echo $arr[2].'-'.$arr[1].'-'.$arr[0]; 
													 ?>
												</td>
                                                <td><?php echo '$'; ?></td>
												<td>
													<?php
														  $sell=0;
														  $sell=$this->Hotel_Model->get_sell_price($price->hotel_id);
														  if(isset($sell) &&  $sell=""){
															    echo $sell;
														  }else{
															echo $sell=$price->sell_price;
														  }
														  $All_markup=$sell-$price->rate;
													 ?>
												</td>
												<td><?php echo $price->rate; ?></td>
												<td><?php echo $price->rack_price; ?></td>
												<td><?php echo $price->country_markup; ?></td>
												<td><?php echo $price->star_markup; ?></td>
												<td><?php echo $mark; ?></td>
												<td><?php echo $callcenter_markup; ?></td>
                                                <td><?php echo $gate_markup; ?></td>
                                                <td><?php echo ($All_markup/$price->rate)*100; ?></td>
                                                <td>
													<?php 
														echo $All_markup; 
													?>
												</td>
                                              
                                                <td>
													<?php if($price->status==1) { echo 'Active'; } else { echo 'InActive'; } ?>
												</td>
                                                <td>
													<a href="<?php echo WEB_URL;?>hotel/view_price/<?php echo $price->sup_rate_tactics_id;?>">View</a>&nbsp;&nbsp;/&nbsp;&nbsp;<?php if($price->status!=1){ ?> <a href="<?php echo WEB_URL;?>hotel/Active_price/<?php echo $price->sup_rate_tactics_id;?>"><?php echo $this->lang->line('Active'); ?></a><?php }else{ ?><a href="<?php echo WEB_URL;?>hotel/Inactive_price/<?php echo $price->sup_rate_tactics_id;?>"><?php echo $this->lang->line('InActive'); ?></a><?php } ?>
												</td>
                                            </tr>
											<?php 
													$i++;
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
