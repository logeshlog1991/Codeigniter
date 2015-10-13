<?php
		//~ $i=1;$All_markup=0;
		//~ if(isset($price_manager) && $price_manager!=''){ 
		//~ foreach($price_manager as $price) {
		//~ if($price->sell_price!=''){
//~ 
		//~ echo '<pre>';
		//~ print_r($price);
		//~ }
		//~ }
		//~ }die;		
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
									<button class="btn btn-primary" onClick="window.location='<?php echo WEB_URL;?>hotel/add_pricemanager';"><?php echo $this->lang->line('Add_Pricemanager'); ?></button>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('no'); ?></th>
                                                <th><?php echo $this->lang->line('Hotel_Name'); ?></th>
                                                <th><?php echo $this->lang->line('star'); ?> </th>
                                                <th><?php echo $this->lang->line('Room_Category'); ?></th>
                                                <th><?php echo $this->lang->line('Room_Type'); ?></th>
                                                <th><?php echo $this->lang->line('Room_Available_From'); ?></th>
                                                <th><?php echo $this->lang->line('Room_Available_To'); ?></th>
                                                <th><?php echo $this->lang->line('Currency'); ?></th>
                                                <th><?php echo $this->lang->line('Selling_Price'); ?></th>
                                                <th><?php echo $this->lang->line('base_price'); ?></th>
                                                <th><?php echo $this->lang->line('rack_price'); ?></th>
                                                <th><?php echo $this->lang->line('Country_Markup'); ?>(%)</th>
                                                <th><?php echo $this->lang->line('Star_Rate_Markup'); ?>(%)</th>
                                                <th><?php echo $this->lang->line('Admin_Markup'); ?>(%)</th>
                                                <th><?php echo $this->lang->line('Call_Center_Markup'); ?>(%)</th>
                                                <th><?php echo $this->lang->line('Payment_Gateway'); ?>(%)</th>
                                                <th><?php echo $this->lang->line('Total_Markup'); ?>(%)</th>
                                                <th><?php echo $this->lang->line('Total_Markup_Amount'); ?></th>
                                                <th><?php echo $this->lang->line('Status'); ?></th>
                                                <th><?php echo $this->lang->line('Action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $i=1;$All_markup=0;
												if(isset($price_manager) && $price_manager!=''){ 
													foreach($price_manager as $price) {
														//~ echo '<pre>';
														//~ print_r($price);die;
														if($price->sell_price!=''){
											?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
													<?php
														if($_SESSION['langA']=='english')
														{
															echo $price->hotel_name; 
														}else{
															echo $price->hotel_nameA; 
														}
													?>
												</td>
                                                <td><?php echo $price->star_name; ?></td>
                                                <td>
													
													<?php 
														$get_category=$this->Hotel_Model->get_category($price->room_cate); 
														if($_SESSION['langA']=='english')
														{
															echo $get_category->hotel_room_type;
														}else{
															echo $get_category->hotel_room_typeA;
														}
													?> 
												</td>
                                                <td>
													<?php 
														$get_type1=$this->Hotel_Model->get_category($price->main_capacity_type); 
														if($_SESSION['langA']=='english')
														{
															echo $get_type1->capacity_title;
														}else{
															echo $get_type1->capacity_titleA;	
														}
													?> 
												</td>
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
													<?php if($price->main_status==1) { echo $this->lang->line('Active'); } else { echo $this->lang->line('InActive'); } ?>
												</td>
                                                <td>
													<a href="<?php echo WEB_URL;?>hotel/view_price/<?php echo $price->sup_rate_tactics_id;?>"><?php echo $this->lang->line('View'); ?></a>&nbsp;&nbsp;/&nbsp;&nbsp;<?php if($price->main_status!=1){ ?> <a href="<?php echo WEB_URL;?>hotel/Active_price/<?php echo $price->sup_rate_tactics_id;?>"><?php echo $this->lang->line('Active'); ?></a><?php }else{ ?><a href="<?php echo WEB_URL;?>hotel/Inactive_price/<?php echo $price->sup_rate_tactics_id;?>"><?php echo $this->lang->line('InActive'); ?></a><?php } ?>
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
