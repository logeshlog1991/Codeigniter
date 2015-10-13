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
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="#javascript:void(0);"><?php echo $this->lang->line('Markup_Management'); ?></a></li>
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> 
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
									<li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>index/markup_manager"><?php echo $this->lang->line('Admin_Markup'); ?> </a></li>
									<li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>index/country_markup"><?php echo $this->lang->line('Country_Markup'); ?> </a></li>
									<li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>index/call_center_markup"><?php echo $this->lang->line('Call_Center_Markup'); ?></a></li>
									<li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);">Markup as per Hotel Rating</a></li>
						      </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                 </section><!-- /.content -->
                 <div class="box box-primary">
								<div class="box-header" style="text-align:right;position:relative;right:12px;">
									<a class="btn btn-primary" href="<?php echo WEB_URL;?>index/global_settings"><b>Back</b></a>
                                </div>
                                <!-- form start -->
                                <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>index/update_star_markup" id="formid" method="post">
                               <fieldset><br/><br/><br/>
								<!-- Form Name -->
								<?php 
								$result = $this->admin_model->get_starMarkup();
								
								foreach($result as $key=>$val){
									$n[] = $val->star_markup;
								}
									if(isset($id) && $id!=''){
								?>
								<p style="color:green;margin:0px 0px 0px 246px;" id="succ">Successfully Updated</p>
								<?php
									} 
								?>
								<legend class="pd-lr-30-px"><?php echo $this->lang->line('Markup_in'); ?>%</legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Un Rated Hotels </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="unrated" name="unrated[]" placeholder="Un Rated Hotels" class="form-control input-md" type="text" value="<?php echo $mark = ($result[5]->star_name=="unrated")?$result[5]->star_markup:'0'; ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">1* Hotels </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="currency_value" name="unrated[]" placeholder="Currency Value" class="form-control input-md" type="text" value="<?php echo $mark = ($result[0]->star_name=="1")?$result[0]->star_markup:'0'; ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">2* Hotels </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="currency_value" name="unrated[]" placeholder="Currency Value" class="form-control input-md" type="text" value="<?php echo $mark = ($result[1]->star_name=="2")?$result[1]->star_markup:'0'; ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">3* Hotels </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="currency_value" name="unrated[]" placeholder="Currency Value" class="form-control input-md" type="text" value="<?php echo $mark = ($result[2]->star_name=="3")?$result[2]->star_markup:'0'; ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">4* Hotels </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="currency_value" name="unrated[]" placeholder="Currency Value" class="form-control input-md" type="text" value="<?php echo $mark = ($result[3]->star_name=="4")?$result[3]->star_markup:'0'; ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">5* Hotels </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="currency_value" name="unrated[]" placeholder="Currency Value" class="form-control input-md" type="text" value="<?php echo $mark = ($result[4]->star_name=="5")?$result[4]->star_markup:'0'; ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">*Average Markup </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="currency_value" name="currency_value" readonly placeholder="Currency Value" class="form-control input-md" type="text" value="<?php $count = count($n); echo round(array_sum($n)/$count,2); ?>">
										<span style="color:red;" id="error_Value"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
									<div class="col-xs-12 col-md-4">
										  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Submit'); ?> </button>
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
