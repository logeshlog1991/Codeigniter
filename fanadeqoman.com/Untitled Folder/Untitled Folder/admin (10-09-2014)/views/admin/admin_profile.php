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
									<li class="active" style="width: 16% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"><?php echo $this->lang->line('Admin_Details'); ?></a></li>
									<li style="width: 26% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>index/change_password"><?php echo $this->lang->line('Change_Password'); ?> </a></li>
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
                                <!-- form start -->
                                <form class="form-horizontal add_hotel_form" enctype="multipart/form-data" action="<?php echo WEB_URL;?>index/update_profile" id="formid" method="post">
                               <fieldset><br/><br/><br/>
								<?php 
									if(isset($id) && $id!=''){
								?>
								<p style="color:green;margin:0px 0px 0px 272px;"><?php echo $this->lang->line('success'); ?></p>
								<?php
									} 
								?>
								<!-- Form Name -->
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('First_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="First_Name" name="First_Name" placeholder="First Name" class="form-control input-md" type="text" value="<?php if(isset($admin_profile->firstname)){ echo $admin_profile->firstname;}?>">
										<span style="color:red;" id="error_hotelname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Last_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="Last_Name" name="Last_Name" placeholder="Last Name" class="form-control input-md" type="text" value="<?php if(isset($admin_profile->lastname)){ echo $admin_profile->lastname;}?>"><span style="color:red;" id="error_hotelcity"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Email'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="Email" name="Email" placeholder="Email" class="form-control input-md" type="text" value="<?php if(isset($admin_profile->email)){ echo $admin_profile->email;}?>">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Address'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<textarea  id="Address" name="Address" style="min-height:70px; width:257px; font-size:12px;"><?php if(isset($admin_profile->address)){ echo $admin_profile->address; } ?></textarea>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Contact_No'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="Contact_No" name="Contact_No" placeholder="Contact No" class="form-control input-md" type="text" value="<?php if(isset($admin_profile->contact_no)){ echo $admin_profile->contact_no;}?>">
								  </div>
								</div>
								
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Bank_Country'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="bank_country" name="bank_country" class="form-control input-md">
											<option value="">-Select Country-</option>
											<?php
												 for($iii=0;$iii<count($country);$iii++){
											?>
													<option  value="<?php  echo $country[$iii]->country_id;  ?>"  <?php if(isset($admin_profile->city_id) && $country[$iii]->country_id == $admin_profile->city_id){ echo "selected='selected'"; } ?>><?php  echo $country[$iii]->name;  ?></option>
											<?php }	?>
										</select>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Postal'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="postal" name="postal" placeholder="Postal/ Zip code" class="form-control input-md" type="text" value="<?php if(isset($admin_profile->postal_code)){ echo $admin_profile->postal_code;}?>">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Profile_Pic'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									
										<input id="img" name="img" type="file">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
								  <div class="col-xs-12 col-md-4">
										<?php if(isset($admin_profile->profile_pic) && $admin_profile->profile_pic!=''){ ?> 
											<img height="172" width="172" src="<?php echo IMG_PATH;?><?php if(isset($admin_profile->profile_pic)){ echo $admin_profile->profile_pic;}?>" class="img-circle" alt="User Image" />
										<? } ?>
								  </div>
								</div>
								<input type="hidden" name="profile_pic" id="profile_pic" value="<?php if(isset($admin_profile->profile_pic)){ echo $admin_profile->profile_pic;}?>">
								<input type="hidden" name="user_id" id="user_id" value="<?php if(isset($admin_profile->user_id)){ echo $admin_profile->user_id;}?>">
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
									<div class="col-xs-12 col-md-4">
										  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Update'); ?></button>
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
