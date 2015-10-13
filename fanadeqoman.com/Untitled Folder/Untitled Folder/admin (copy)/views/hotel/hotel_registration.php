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
           <style>.width346{ width:346px;} .tabletd{ min-width:125px;} .box-footer{ border-top:none !important;}</style>
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
                                    <li class="active" style="width: 19% !important;font-size:16px;font-family:bold:helica;"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('Hotel_Reg'); ?></a></li>
                                    <li style="width: 19% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/hotel_details"><?php echo $this->lang->line('Hotel_Details'); ?></a></li>
                                    <li style="width: 19% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/hotel_markets"><?php echo $this->lang->line('Hotel_Mar'); ?></a></li>
                                    <li style="width: 19% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/amenity_list"><?php echo $this->lang->line('Amenity_List'); ?></a></li>
                                    <li style="width: 19% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/star_list"><?php echo 'Stars List'; ?></a></li>
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
                                <div class="box-header" style="height:50px;">
                                    <form name="f2" action="<?php echo WEB_URL;?>hotel/add_markets" method="post">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td class="tabletd" colspan="3" style="text-align:right;"><a href="<?php echo WEB_URL;?>hotel/hotel_manager"><b>Back</b></a></td>
											</tr>
											<tr>
												<td class="tabletd"> <h4><?php echo $this->lang->line('Add_Market'); ?>&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_market_name" id="add_market_name" placeholder="Add Market" required><span class="input-group-addon" >English</span>
													</div><br/>
													<div class="input-group custom-input-group width346">
														<input  type="text" class="form-control" name="add_market_nameA" id="add_market_nameA" placeholder="<?php echo $this->lang->line('Add_Market'); ?>" required><span class="input-group-addon">Arabic</span>
													</div>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                  <div class="box-header" style="height:50px;">
                                    <form name="f2" action="<?php echo WEB_URL;?>hotel/add_country" method="post" onsubmit="return country_Validation()">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td class="tabletd" colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td class="tabletd"> <h4>Add Country&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_country_name" id="add_country_name" placeholder="Add Country" required onblur="check_country()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group width346" >
														<input type="text" class="form-control" name="add_country_nameA" id="add_country_nameA" placeholder="Add Country" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_country"></span>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                
                                <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td class="tabletd" colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td class="tabletd"> <h4>Add Region&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_region_name" id="add_region_name" placeholder="Add Region" required onblur="check_region()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_region_nameA" id="add_region_nameA" placeholder="Add Region" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_resion"></span>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="button" onclick="add_region()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                
                                 <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td  class="tabletd" colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td class="tabletd"> <h4>Add City/Town&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_cityTown_name" id="add_cityTown_name" placeholder="Add city town" required onblur="check_cityTown()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_cityTown_nameA" id="add_cityTown_nameA" placeholder="Add city Town" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_cityTown"></span>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="button" onclick="add_cityTown()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                
                                 <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td class="tabletd" colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td class="tabletd"> <h4>Add Area&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_area_name" id="add_area_name" placeholder="Add Area" required onblur="check_area()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_area_nameA" id="add_area_nameA" placeholder="Add Area" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_area"></span>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="button" onclick="return add_Area()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                 <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td class="tabletd" colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td class="tabletd"> <h4>Add Hotel Type&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_hotelType_name" id="add_hotelType_name" placeholder="Add Hotel Type" required onblur="check_hotelType()"><span class="input-group-addon">English</span>
													</div><br/>
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_hotelType_nameA" id="add_hotelType_nameA" placeholder="Add Hotel Type" required><span class="input-group-addon">Arabic</span>
													</div>
													<span id="error_hotelType"></span>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="button" onclick="add_hotelType()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/><br/>
                                
                                <div class="box-header" style="height:50px;">
                                    <form name="f2" method="post">
										<table style="text-align:right;position:relative;right:-150px;">
											<tr> 
											<td class="tabletd" colspan="3" style="text-align:right;">&nbsp;</td>
											</tr>
											<tr>
												<td class="tabletd"> <h4>Add Star Rating&nbsp;&nbsp;</h4></td>
												<td class="tabletd">
													<div class="input-group custom-input-group width346">
														<input type="text" class="form-control" name="add_starRatings_name" id="add_starRatings_name" placeholder="Add Star Ratings" required onblur="check_starRatings()">
														<span class="input-group-addon"></span>
													</div>
													<span id="error_star" style="color:red;"></span>
												</td>
												<td class="tabletd"> 
													<div class="box-footer">
														<button type="button"  onclick="add_Rating()" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;ADD&nbsp;&nbsp;&nbsp;&nbsp;</button>
													</div>
												</td>
											</tr>
										</table>
									</form>
                                </div><!-- /.box-header --><br/><br/>
                               <form class="form-horizontal add_hotel_form" action="<?php echo WEB_URL;?>hotel/add_hotel_ad" id="formid" method="post">
                               <fieldset>

								<!-- Form Name -->
								<legend class="pd-lr-30-px"><?php echo $this->lang->line('General_Information'); ?></legend>

								<!-- Multiple Checkboxes -->
								<div class="form-group">
								  <label class="col-md-3 control-label" for="checkboxes"><?php echo $this->lang->line('Markets'); ?></label>
								  <div class="col-md-4">									  
									<?php
										$market_list=$this->Hotel_Model->fetch_markets();
										if(isset($market_list) && $market_list!=''){
											foreach($market_list as $market){
									?>
								    <div class="checkbox">
									  <label for="checkboxes-0">
										<input type="checkbox" name="market_name[]" id="market_name[]" value="<?php echo $market->market_id; ?>"/>
									    <?php echo $market->market_name; ?>
									  </label>
									</div>
									<?php	
											}
										}
									?>
								  </div>
								  
								</div><br/><br/><br/>
								<!-- Form Name -->
								<legend class="pd-lr-30-px"><?php echo $this->lang->line('Add_New_Hotel'); ?></legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Hotel_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
											<input id="hotel_name" name="hotel_name" placeholder="Hotel Name" class="form-control input-md" type="text" onblur="Hotel_Exits1()"><span class="input-group-addon">English</span>
											<input id="old_hotel_name" name="old_hotel_name" type="hidden" value="**">
											<span style="color:red;" id="error_hotelname"></span>
									  </div><br/>
									  <div class="input-group custom-input-group">
											<input id="hotel_nameA" name="hotel_nameA" placeholder="<?php echo $this->lang->line('Hotel_Name'); ?>" class="form-control input-md" type="text" onblur="Hotel_Exits()"><span class="input-group-addon">Arabic</span>
									  </div><br/>	
								  </div>
								  <input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL; ?>">
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Hotel Type</label>  
									<div class="col-xs-12 col-md-4">
										<select name="hotel_type" id="hotel_type" class="form-control input-md">
											<option value="">-Select Type-</option>
										<?php
											$type_list=$this->Hotel_Model->getTypeList();
											if(isset($type_list) && $type_list!=''){
												foreach($type_list as $type){
										?>
											<option value="<?php echo $type->h_no; ?>"><?php echo $type->hotel_type; ?></option>
										<?php
												}
											}
										?>
										</select>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('star'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="star" name="star" class="form-control input-md">
											<?php
											$star_list=$this->Hotel_Model->getStarList();
											if(isset($star_list) && $star_list!=''){
												foreach($star_list as $star){
										?>
											<option value="<?php echo $star->s_no; ?>"><?php echo $star->star; ?></option>
										<?php
												}
											}
										?>	
										</select>
								 </div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Country'); ?></label>  
									<div class="col-xs-12 col-md-4">
										<select name="hotel_country" id="hotel_country" class="form-control input-md" onchange="regiobyID(this.value)">
											<option value="">-Select Country-</option>
										<?php
											$country_list=$this->Hotel_Model->country_list();
											if(isset($country_list) && $country_list!=''){
												foreach($country_list as $country){
										?>
											<option value="<?php echo $country->country_id; ?>"><?php echo $country->name; ?></option>
										<?php
												}
											}
										?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Region</label>  
									<div class="col-xs-12 col-md-4" id="region_list">
										Select Country First
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">City/Town</label>  
									<div class="col-xs-12 col-md-4" id="cityTown_list">
										Select Region First
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-md-3 control-label" for="textinput">Area</label>  
									<div class="col-xs-12 col-md-4" id="area_list">
										Select City First
									</div>
								</div>
								
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Contract Period</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="datepicker" name="start_date" placeholder="Start Date" class="form-control input-md" type="text"><span class="input-group-addon">Start Date</span>
										<span style="color:red;" id="error_lname"></span>
									  </div><br/>
									  <div class="input-group custom-input-group">
										<input id="datepicker1" name="end_date" placeholder="End Date" class="form-control input-md" type="text"><span class="input-group-addon">End Date</span>
									  </div><br/>
								  </div>
								</div>
								<legend class="pd-lr-30-px">Address</legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">P.O.BOX</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="box" name="box" placeholder="P.O.BOX" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_box"></span>
									  </div>
								 </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Postel Code</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="postel" name="postel" placeholder="Postel Code" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_pcode"></span>
									  </div>
								 </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Phone'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="mobile_number" name="mobile_number" placeholder="Phone" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_mobilenumber"></span>
								   	  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Fax'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="fax" name="fax" placeholder="Fax" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_fax"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Email'); ?></label>  
									<div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="email" name="email" placeholder="Email" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_email"></span>
									  </div>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Website</label>  
									<div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="Website" name="Website" placeholder="Website" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_Website"></span>
									  </div>
									</div>
								</div>
								<legend class="pd-lr-30-px">Contact Person Information</legend>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('First_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="first_name" name="first_name" placeholder="First Name" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_fname"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Last_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="last_name" name="last_name" placeholder="Last_Name" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_lname"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Designation</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="Designation" name="Designation" placeholder="Designation" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_Designation"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Contact Number</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="CNumber" name="CNumber" placeholder="Contact Number" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_CNumber"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Email</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="person_email" name="person_email" placeholder="Email" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_cperson"></span>
									  </div>
								  </div>
								</div>
								<legend class="pd-lr-30-px">Reservation Information</legend>	
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Email1</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="remail1" name="remail1" placeholder="Email" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_remail1"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Email2</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="remail2" name="remail2" placeholder="Email" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_remail2"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Fax'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="rfax" name="rfax" placeholder="Fax" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_rfax"></span>
									  </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Telephone</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="Telephone" name="Telephone" placeholder="Telephone" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_Telephone"></span>
									  </div>
								  </div>
								</div>
								<legend class="pd-lr-30-px">Contract Signed By</legend>	
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> Name</label>  
									<div class="col-xs-12 col-md-4">
									   <div class="input-group custom-input-group">
											<input id="Name" name="Name" placeholder="Name" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
											<span style="color:red;" id="error_Name"></span>
									   </div>
									</div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Title</label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<input id="title" name="title" placeholder="title" class="form-control input-md" type="text"><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_title"></span>
									  </div>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
 $(function() {
		$( "#datepicker" ).datepicker({
			minDate:0,
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'dd-mm-yy',
			onClose: function( selectedDate ) {
				var date = $(this).datepicker('getDate');
				if (date) {
					  date.setDate(date.getDate() + 1);
				}
				$( "#datepicker1" ).datepicker( "option", "minDate", date);
			}
		});
		$( "#datepicker1" ).datepicker({
		  //minDate:0,
		  changeMonth: true,
		  numberOfMonths: 1,
		  dateFormat: 'dd-mm-yy',
		  onClose: function( selectedDate ) { 
			  $("#datepicker").datepicker("option","maxDate",selectedDate);
		  }
		});
 });
</script>

