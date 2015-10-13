<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Supplier Console</title>
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
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="#tab_1" data-toggle="tab">Hotel Details</a></li>
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
											<td colspan="3" style="text-align:right;"><a href="<?php echo WEB_URL;?>hotel/hotel_manager"><b>Back</b></a></td>
											</tr>
										</table>
									</div><!-- /.box-header -->
                              <!-- form start -->
                               <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>hotel/edit_hotel_ad/<?php echo $hotel_details->sup_hotel_id;?>" id="formid" method="post" onsubmit="return add_hotel_validation()">
                               <fieldset>

								<!-- Form Name -->
								<legend class="pd-lr-30-px">General Information</legend>

								<!-- Multiple Checkboxes -->
								<div class="form-group">
								  <label class="col-md-3 control-label" for="checkboxes">Markets</label>
								  <div class="col-md-4">									  
									<?php
										$market_list=$this->Hotel_Model->fetch_markets();
										if(isset($market_list) && $market_list!=''){
											foreach($market_list as $market){
									?>
								    <div class="checkbox">
									  <label for="checkboxes-0">
										<input type="checkbox" name="market_name[]" id="market_name[]" value="<?php echo $market->market_id; ?>" <?php if(isset($hotel_details->market_name) && $hotel_details->market_name!=''){ $array=unserialize($hotel_details->market_name); foreach($array as $value){ if($market->market_id==$value){ echo 'checked="checked"'; } } } ?>/>
									    <?php echo $market->market_name; ?>
									  </label>
									</div>
									<?php	
											}
										}
									?>
								  </div>
								</div>
								<legend class="pd-lr-30-px">Add New Hotel</legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Name</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="hotel_name" name="hotel_name" placeholder="Hotel Name" class="form-control input-md" type="text" onblur="Hotel_Exits()" value="<?php if(isset($hotel_details->hotel_name)){ echo $hotel_details->hotel_name; }?>">
										<span style="color:red;" id="error_hotelname"></span>
								  </div>
								  <input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL; ?>">
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">City</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="city_name" name="city_name" placeholder="City" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->city_country_name)){ echo $hotel_details->city_country_name; }?>">
										<span style="color:red;" id="error_cityname"></span>
								  </div>
								</div>
								<legend class="pd-lr-30-px">Main Contact Information</legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">First Name</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="first_name" name="first_name" placeholder="First Name" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->main_first_name)){ echo $hotel_details->main_first_name; }?>">
										<span style="color:red;" id="error_fname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Last Name</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="last_name" name="last_name" placeholder="Last Name" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->main_last_name)){ echo $hotel_details->main_last_name; }?>">
										<span style="color:red;" id="error_lname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Email</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="email" name="email" placeholder="Email" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->main_email)){ echo $hotel_details->main_email; }?>">
										<span style="color:red;" id="error_email"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Phone</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="mobile_number" name="mobile_number" placeholder="Phone" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->res_phone)){ echo $hotel_details->res_phone; }?>">
										<span style="color:red;" id="error_mobilenumber"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Fax</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="fax" name="fax" placeholder="Fax" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->res_fax)){ echo $hotel_details->res_fax; }?>">
										<span style="color:red;" id="error_fax"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> Hotel Address</label>  
								  <div class="col-xs-12 col-md-4">
										<textarea id="hotel_address" name="hotel_address" placeholder="Hotel Address" class="form-control input-md" type="text"><?php if(isset($hotel_details->address)){ echo $hotel_details->address; }?></textarea>
										<span style="color:red;" id="error_adddress"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> Hotel Description</label>  
								  <div class="col-xs-12 col-md-4">
										<textarea id="hotel_description" name="hotel_description" placeholder="Hotel Description" class="form-control input-md" type="text"><?php if(isset($hotel_details->descrip)){ echo $hotel_details->descrip; }?></textarea>
										<span style="color:red;" id="error_desc"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> Nearby Airport</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="nearby_airport" name="nearby_airport" placeholder=" Nearby Airport" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->nearby_airport)){ echo $hotel_details->nearby_airport; }?>">
										<span style="color:red;" id="error_na"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Latitude</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="latitude" name="latitude" placeholder="Latitude" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->latitude)){ echo $hotel_details->latitude; }?>">
										<span style="color:red;" id="error_lt"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Longitude</label>  
								  <div class="col-xs-12 col-md-4">
										<input id="longitude" name="longitude" placeholder="Longitude" class="form-control input-md" type="text" value="<?php if(isset($hotel_details->longitude)){ echo $hotel_details->longitude; }?>">
										<span style="color:red;" id="error_lg"></span>
								 </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
									<div class="col-xs-12 col-md-4">
										  <button type="submit" class="btn btn-primary">Submit</button>
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
