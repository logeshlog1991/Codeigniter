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
                        <?php echo $this->lang->line('Call_Center_Agents_List'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>
				 <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
									<li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"><?php echo $this->lang->line('Edit_CallCenter_Agents'); ?></a></li>
							    </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
						<!-- Main content -->
						<section class="content">
							<div class="row">
								<div class="col-xs-12">
									<div class="box">
										<div class="box-header">
											<div class="box-header" style="text-align:right;position:relative;right:12px;"><br/>
												<a class="btn btn-primary" href="<?php echo WEB_URL;?>index/callcenter_agentlist"><b>BACK</b></a>
											</div>
											<h3 class="box-title"></h3></div>
											<div class="box-add" style="text-align:right;position:relative;right:12px;"></div><!-- /.box-header -->
										<div class="box-body table-responsive">
											<form enctype="multipart/form-data" class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>index/editcallcenter_agents_ad/<?php echo $agent->callcenter_agent_id; ?>" id="formid" method="post" onsubmit="return editcall_agents()">
											  <!-- Form Name -->
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Email'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="email" name="email" placeholder="Email" class="form-control input-md" type="text" value="<?php if(isset($agent->email_id) && $agent->email_id!=''){ echo $agent->email_id; } ?>">
														<span style="color:red;" id="error_email"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Password'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="password" name="password" placeholder="Password" class="form-control input-md" type="password" value="<?php if(isset($agent->password) && $agent->password!=''){ echo $agent->password; } ?>">
														<span style="color:red;" id="error_password"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('name'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="name" name="name" placeholder="Name" class="form-control input-md" type="text" value="<?php if(isset($agent->name) && $agent->name!=''){ echo $agent->name; } ?>">
														<span style="color:red;" id="error_name"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Company_Name'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="company_name" name="company_name" placeholder="Company Name" class="form-control input-md" type="text" value="<?php if(isset($agent->company_name) && $agent->company_name!=''){ echo $agent->company_name; } ?>">
														<span style="color:red;" id="error_compname"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Contact_Number'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="contact_number" name="contact_number" placeholder="Contact Number" class="form-control input-md" type="text" value="<?php if(isset($agent->mobile) && $agent->mobile!=''){ echo $agent->mobile; } ?>">
														<span style="color:red;" id="error_number"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Paymnet_Currency'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<select id="paymnet_currency" name="paymnet_currency" class="form-control input-md">
															<option value="">-Select Currency-</option>
															<?php 
																if(isset($currency) && $currency!=''){ 
																	foreach($currency as $value){
															?>
																<option value="<?php echo $value->value; ?>" <?php if(isset($agent->currency_type) && $agent->currency_type == $value->value){ echo "selected='selected'"; } ?> ><?php echo $value->currency;?></option>
															<?php 
																	}	 
																}
															?>
														</select>
														<span style="color:red;" id="error_pc"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Address'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="address" name="address" placeholder="Address" class="form-control input-md" type="text" value="<?php if(isset($agent->address) && $agent->address!=''){ echo $agent->address; } ?>">
														<span style="color:red;" id="error_address"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Country'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<select id="country" name="country" class="form-control input-md">
														<option value="">-Select Country-</option>
														<?php
															if(isset($country) && $country!=''){
																foreach($country as $value){
														?>
														<option value="<?php echo $value->country_id;?>" <?php if(isset($agent->country) && $agent->country == $value->country_id){ echo "selected='selected'"; } ?> ><?php echo $value->name; ?></option>
														<?php
																}
															} 
														?>
														</select>
														<span style="color:red;" id="error_country"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('City'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="city" name="city" placeholder="City" class="form-control input-md" type="text" value="<?php if(isset($agent->city) && $agent->city!=''){ echo $agent->city; } ?>">
														<span style="color:red;" id="error_city"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Bank'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="bank_state" name="bank_state" placeholder="Bank State/ Province" class="form-control input-md" type="text" value="<?php if(isset($agent->state) && $agent->state!=''){ echo $agent->state; } ?>">
														<span style="color:red;" id="error_bs"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Postal'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input id="postal" name="postal" placeholder="Postal/ Zip code" class="form-control input-md" type="text" value="<?php if(isset($agent->postal_code) && $agent->postal_code!=''){ echo $agent->postal_code; } ?>">
														<span style="color:red;" id="error_postal"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Agent_Logo'); ?></label>  
												  <div class="col-xs-12 col-md-4">
														<input type="file" name="file" id="file">
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
												  <div class="col-xs-12 col-md-4">
														<?php if(isset($agent->callcenter_agent_logo) && $agent->callcenter_agent_logo!=''){ ?> 
															<img height="172" width="172" src="<?php echo IMG_PATH;?><?php if(isset($agent->callcenter_agent_logo)){ echo $agent->callcenter_agent_logo;}?>" class="img-circle" alt="User Image" />
														<? } ?>
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
        <script src="<?php echo WEB_DIR;?>js/custom.js" type="text/javascript"></script>
        <!-- page script -->
    </body>
</html>
