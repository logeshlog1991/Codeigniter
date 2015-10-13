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
									<li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"><?php echo $this->lang->line('edit_sup'); ?></a></li>
									<li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>supplier/supplier_list"><?php echo $this->lang->line('Supplier_list'); ?></a></li>
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
                                <form class="form-horizontal add_supplier_form" enctype="multipart/form-data" action="<?php echo WEB_URL;?>supplier/edit_supplier_ad/<?php echo $result->supplier_id; ?>" id="formid" method="post" onsubmit="return add_supplier()">
                               <fieldset><br/>
                               <legend class="pd-lr-30-px"><?php echo $this->lang->line('Hotel_Information'); ?></legend>
                               <div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Hotel'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="hotel" name="hotel" class="form-control input-md">
											<?php 
												if(isset($hotels) && $hotels!=''){ 
													foreach($hotels as $value){
											?>
												<option value="<?php echo $value->sup_hotel_id; ?>" <?php if(isset($result->hotel_id) && $result->hotel_id==$value->sup_hotel_id){ echo 'selected="selected"'; } ?> ><?php echo $value->hotel_name;?></option>
											<?php 
													}	 
												}
											?>
										</select>
										<span style="color:red;" id="error_hotel"></span>
								  </div>
								</div>
                               <legend class="pd-lr-30-px"><?php echo $this->lang->line('Login_Information'); ?></legend>
								<span id="error" style="color:red;margin:0px 0px 0px 275px;"></span>
								<!-- Form Name -->
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Email'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									   <div class="input-group custom-input-group">
											<input id="email" name="email" placeholder="Email ID" class="form-control input-md" type="text" value="<?php if(isset($result->email_id)){ echo $result->email_id; } ?>" onblur="check_Supplier1()"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_email"></span>
										</div><br/>
										 <div class="input-group custom-input-group">
											<input id="emailA" name="emailA" placeholder="Email ID" class="form-control input-md" type="text" value="<?php if(isset($resultA->email_id)){ echo $resultA->email_id; } ?>"><span class="input-group-addon">Arabic</span>
										</div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Password'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="password" name="password" placeholder="Password" class="form-control input-md" type="password" value="<?php if(isset($result->password)){ echo $result->password; } ?>"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_password"></span>
									  </div><br/>
									  <div class="input-group custom-input-group">
										<input id="passwordA" name="passwordA" placeholder="Password" class="form-control input-md" type="password" value="<?php if(isset($resultA->password)){ echo $resultA->password; } ?>"><span class="input-group-addon">Arabic</span>
										<span style="color:red;" id="error_password"></span>
									  </div>
								  </div>
								</div>
								<!--<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Confirm_Password'); ?>  </label>  
								  <div class="col-xs-12 col-md-4">
										<input id="cpassword" name="cpassword" placeholder="Confirm Password " class="form-control input-md" type="password" value="<?php if(isset($result->password)){ echo $result->password; } ?>">
										<span style="color:red;" id="c_password"></span>
								  </div>
								</div>-->
								<legend class="pd-lr-30-px"><?php echo $this->lang->line('Supplier_Profile'); ?></legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Supplier_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="supplier_name" name="supplier_name" placeholder="Supplier Namee" class="form-control input-md" type="text" value="<?php if(isset($result->name)){ echo $result->name; } ?>"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_suppliername"></span>
									  </div><br/>
									  <div class="input-group custom-input-group">
										<input id="supplier_nameA" name="supplier_nameA" placeholder="Supplier Namee" class="form-control input-md" type="text" value="<?php if(isset($resultA->name)){ echo $resultA->name; } ?>"><span class="input-group-addon">Arabic</span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Company_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="company_name" name="company_name" placeholder="Company Name" class="form-control input-md" type="text" value="<?php if(isset($result->company_name)){ echo $result->company_name; } ?>"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_companyname"></span>
									  </div></br>
									  <div class="input-group custom-input-group">
										<input id="company_nameA" name="company_nameA" placeholder="Company Name" class="form-control input-md" type="text" value="<?php if(isset($resultA->company_name)){ echo $resultA->company_name; } ?>"><span class="input-group-addon">Arabic</span>
									  </div>
								  </div>
								</div>
								 <div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Mobile_Number'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="mobile_number" name="mobile_number" placeholder="Mobile Number" class="form-control input-md" type="text" value="<?php if(isset($result->mobile)){ echo $result->mobile; } ?>">
										<span style="color:red;" id="error_mobilenumber"></span>
								  </div>
								</div>
								<legend class="pd-lr-30-px"><?php echo $this->lang->line('Contact_Information'); ?></legend> 
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Office_Phone_Number'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="office_phone_number" name="office_phone_number" placeholder="Office Phone Number" class="form-control input-md" type="text" value="<?php if(isset($result->office_phone)){ echo $result->office_phone; } ?>">
										<span style="color:red;" id="error_off_ph_num"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Adddress'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="adddress" name="adddress" placeholder="Adddress" class="form-control input-md" type="text" value="<?php if(isset($result->address)){ echo $result->address; } ?>"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_adddress"></span>
									  </div><br/>
									  <div class="input-group custom-input-group">
										<input id="adddressA" name="adddressA" placeholder="Adddress" class="form-control input-md" type="text" value="<?php if(isset($resultA->address)){ echo $resultA->address; } ?>"><span class="input-group-addon">Arabic</span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('City'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="city" name="city" placeholder="City" class="form-control input-md" type="text" value="<?php if(isset($result->city)){ echo $result->city; } ?>"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_city"></span>
									  </div><br/>
									  <div class="input-group custom-input-group">
										<input id="cityA" name="cityA" placeholder="City" class="form-control input-md" type="text" value="<?php if(isset($resultA->city)){ echo $resultA->city; } ?>"><span class="input-group-addon">Arabic</span>
									  </div>
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
												<option value="<?php echo $value->country_id; ?>" <?php if(isset($result->country) && $result->country==$value->country_id){ echo 'selected="selected"'; } ?> ><?php echo $value->name;?></option>
											<?php 
													}	 
												}
											?>
										</select>
										<span style="color:red;" id="error_country"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Postal'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="postal" name="postal" placeholder="Postal/ Zip code" class="form-control input-md" type="text" value="<?php if(isset($result->postal_code)){ echo $result->postal_code; } ?>">
										<span style="color:red;" id="error_postal"></span>
								  </div>
								</div>
								<legend class="pd-lr-30-px"><?php echo $this->lang->line('Document_Information'); ?></legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Currency_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="paymnet_currency" name="paymnet_currency" class="form-control input-md">
											<option value="">-Select Currency-</option>
											<?php 
												if(isset($currency) && $currency!=''){ 
													foreach($currency as $value){
											?>
												<option value="<?php echo $value->cur_id; ?>" <?php if(isset($result->currency_type) && $result->currency_type==$value->cur_id){ echo 'selected="selected"'; } ?> ><?php echo $value->currency;?></option>
											<?php 
													}	 
												}
											?>
										</select>
										<span style="color:red;" id="error_currency"></span>
								  </div>
								</div>
								<input type="hidden" value="<?php echo WEB_URL; ?>" id="web_url" name="web_url">
								<input type="hidden" value="<?php if(isset($result->email_id)){ echo $result->email_id; } ?>" id="main_email" name="main_email">
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
<script>
/*
	function supplier_details()
	{
		var base_url='<?php echo WEB_URL;?>';var full_name='';var full_nameA='';
		if($("#hotel").val()!=''){
			$.ajax({
				 url: base_url+"supplier/editsupplier_details",
				 type: 'post',
				 data:  {'hotel':$("#hotel").val()},
				 success: function(output) {
					var myArrayobj = jQuery.parseJSON('[' + output + ']');
					$.each(myArrayobj, function(i, field){
						$.each(field, function(j, field1){
							if(j=='email_id'){
								$('#email').val(field1);
							}
							if(j=='password'){
								$('#password').val(field1);
							}
							if(j=='name'){
								$('#supplier_name').val(field1);
							}
							if(j=='company_name'){
								$('#company_name').val(field1);
							}
							if(j=='mobile'){
								$('#mobile_number').val(field1);
							}
							if(j=='office_phone'){
								$('#office_phone_number').val(field1);
							}
							if(j=='address'){
								$('#adddress').val(field1);
							}
							if(j=='city'){
								$('#city').val(field1);
							}
							if(j=='country'){
								$("#country").val(field1);
							}
							if(j=='currency_type'){
								$("#paymnet_currency").val(field1);
							}
						});
					});
				 }
			});
			$.ajax({
				 url: base_url+"supplier/editsupplier_detailsA",
				 type: 'post',
				 data:  {'hotel':$("#hotel").val()},
				 success: function(output) {
					var myArrayobj = jQuery.parseJSON('[' + output + ']');
					$.each(myArrayobj, function(i, field){
						$.each(field, function(j, field1){
							if(j=='email_id'){
								$('#emailA').val(field1);
							}
							if(j=='password'){
								$('#passwordA').val(field1);
							}
							if(j=='name'){
								$('#supplier_nameA').val(field1);
							}
							if(j=='company_name'){
								$('#company_nameA').val(field1);
							}
							if(j=='mobile'){
								$('#mobile_numberA').val(field1);
							}
							if(j=='office_phone'){
								$('#office_phone_numberA').val(field1);
							}
							if(j=='address'){
								$('#adddressA').val(field1);
							}
							if(j=='city'){
								$('#cityA').val(field1);
							}
							if(j=='country'){
								$("#countryA").val(field1);
							}
							if(j=='currency_type'){
								$("#paymnet_currencyA").val(field1);
							}
						});
					});
				 }
			});		
		}
	}
*/
</script>
