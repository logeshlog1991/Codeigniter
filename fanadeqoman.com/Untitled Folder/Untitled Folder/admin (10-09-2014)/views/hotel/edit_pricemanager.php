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
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('Price_Manager'); ?></a></li>
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
							<td colspan="3" class="btn btn-primary" style="text-align:right;"><a href="<?php echo WEB_URL;?>hotel/price_manager"><b>Back</b></a></td>
							</tr>
							
						</table>
					</div><!-- /.box-header -->
                    <!-- form start -->
                     <form name="form1" id="form1" class="form-horizontal add_hotel_form" enctype="multipart/form-data" action="<?php echo WEB_URL;?>hotel/edit_pricemanager_ad/<?php echo $rat_tac_details->sup_rate_tactics_id;?>" method="post">
                               <fieldset>
									<!-- Form Name -->
									<div class="form-group">
									  <div class="col-xs-12 col-md-4"></div>
									</div>
									<div class="form-group">
									  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Markets'); ?>:</label>  
									  <div class="col-xs-12 col-md-4">
											<select name="market_id[]" id='market_id' style="width:200px;" multiple="multiple" >
											<option value="">Select</option>
											<?php
											$market = $this->Hotel_Model->get_market_available();
											if(isset($market[0]->market_id))
												{
												for($i=0;$i<count($market);$i++){
												?>
												  <option value="<?php echo $market[$i]->market_id; ?>" <?php if(isset($rat_tac_details->market_id) && $rat_tac_details->market_id!=''){ if($rat_tac_details->market_id == $market[$i]->market_id) { echo "selected='selected'"; } } ?> ><?php echo $market[$i]->market_name; ?></option>
												<?php	
												}
												}
												?>          
										</select>
									  </div>
									</div>
									<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Hotel_Name'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="hotel_name" name="hotel_name" placeholder="Hotel Name" class="form-control input-md" onchange="getRoomType()">
											<option value=""> -Select Hotel - </option>
											<?php
												if(isset($hotels) && $hotels!='')
												{
													foreach($hotels as $value)
													{
											?>
											<option value="<?php echo $value->sup_hotel_id;?>" <?php if(isset($rat_tac_details->hotel_id) && $rat_tac_details->hotel_id!=''){ if($rat_tac_details->hotel_id == $value->sup_hotel_id) { echo "selected='selected'"; } } ?> ><?php echo $value->hotel_name; ?></option>
											<?php 
													}
												}
											?>
										</select>
										<span style="color:red;" id="error_hotelname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Board_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="board_type" name="board_type" placeholder="Board Type" class="form-control input-md">
											<option value="Without Break Fast" <?php if(isset($rat_tac_details->InclBoardTypeDesc) && $rat_tac_details->InclBoardTypeDesc!=''){ if($rat_tac_details->InclBoardTypeDesc == 'Without Break Fast') { echo "selected='selected'"; } } ?> >Without Break Fast</option>
											<option value="Bed and Break Fast" <?php if(isset($rat_tac_details->InclBoardTypeDesc) && $rat_tac_details->InclBoardTypeDesc!=''){ if($rat_tac_details->InclBoardTypeDesc == 'Bed and Break Fast') { echo "selected='selected'"; } } ?>>Bed and Break Fast</option>
											<option value="Buffet Break Fast" <?php if(isset($rat_tac_details->InclBoardTypeDesc) && $rat_tac_details->InclBoardTypeDesc!=''){ if($rat_tac_details->InclBoardTypeDesc == 'Buffet Break Fast') { echo "selected='selected'"; } } ?>>Buffet Break Fast</option>
										</select>
										<span style="color:red;" id="error_boardtype"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Category'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="roomTypes" name="room_type" placeholder="Room Category" readonly class="form-control input-md" type="text" value="<?php if(isset($rat_tac_details->category_type) && $rat_tac_details->category_type!=''){ echo $rat_tac_details->category_type; } ?>">
										<span style="color:red;" id="error_capacitytype"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input id="roomTypeCapacity" name="capacity_type" placeholder="Room Type" readonly class="form-control input-md" type="text" value="<?php if(isset($rat_tac_details->room_type) && $rat_tac_details->room_type!=''){ echo $rat_tac_details->room_type; } ?>" >
										<span style="color:red;" id="error_room_type"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Image'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="mainimage" id="mainimage" > 
										<?php if(isset($rat_tac_details->main_image) && $rat_tac_details->main_image!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->main_image; ?>" height=150 width=250/> 
										<?php } ?>
										<span style="color:red;" id="error_mainimage"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Image1'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image1" id="image1" > 
										<?php if(isset($rat_tac_details->image1) && $rat_tac_details->image1!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->image1; ?>" height=150 width=250/> 
										<?php } ?>
										<span style="color:red;" id="error_image1"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Image2'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image2" id="image2" > 
										<?php if(isset($rat_tac_details->image2) && $rat_tac_details->image2!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->image2; ?>" height=150 width=250/> 
										<?php } ?>
										<span style="color:red;" id="error_image2"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Image3'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image3" id="image3" > 
										<?php if(isset($rat_tac_details->image3) && $rat_tac_details->image3!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->image3; ?>" height=150 width=250/> 
										<?php } ?>
										<span style="color:red;" id="error_image3"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Child_Policy'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<textarea name="child_policy" placeholder="Child Policy" id="child_policy" class="form-control input-md" ><?php if(isset($rat_tac_details->child_policy) && $rat_tac_details->child_policy!=''){ echo $rat_tac_details->child_policy; } ?></textarea>
										<span style="color:red;" id="error_childpolicy"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Cancellation_Policy'); ?></label>  
								  <div>
										<?php echo $this->lang->line('Nights'); ?><input type="text" id="nights" name="nights" size="8" value="<?php if(isset($rat_tac_details->cancel_policy_nights) && $rat_tac_details->cancel_policy_nights!=''){ echo $rat_tac_details->cancel_policy_nights; } ?>" />	
										<?php echo $this->lang->line('Charge'); ?><input type="text" id="charge" name="charge" size="8" value="<?php if(isset($rat_tac_details->cancel_policy_percent) && $rat_tac_details->cancel_policy_percent!=''){ echo $rat_tac_details->cancel_policy_percent; } ?>" />% 
										<?php echo $this->lang->line('or'); ?> <input type="text" id="currency" name="currency" size="8" value="<?php if(isset($rat_tac_details->cancel_policy_charge) && $rat_tac_details->cancel_policy_charge!=''){ echo $rat_tac_details->cancel_policy_charge; } ?>" />&nbsp;
										<?php echo $this->lang->line('Per_Night_Charge'); ?>&nbsp;&nbsp;<?php echo $this->lang->line('From'); ?><input type="text" id="datepicker12" name="cancel_policy_from" size="8" value="<?php if(isset($rat_tac_details->cancel_policy_from) && $rat_tac_details->cancel_policy_from!=''){ echo $rat_tac_details->cancel_policy_from; } ?>" />&nbsp;&nbsp;
										<?php echo $this->lang->line('To'); ?><input type="text" id="datepicker13" name="cancel_policy_to" size="8" value="<?php if(isset($rat_tac_details->cancel_policy_to) && $rat_tac_details->cancel_policy_to!=''){ echo $rat_tac_details->cancel_policy_to; } ?>" />
										<span style="color:red;" id="error_childpolicy"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Cancellation_Description'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<textarea name="cancel_desc" placeholder="Cancellation Description" id="cancel_desc" class="form-control input-md" ><?php if(isset($rat_tac_details->cancel_policy_desc) && $rat_tac_details->cancel_policy_desc!=''){ echo $rat_tac_details->cancel_policy_desc; } ?> </textarea>
										<span style="color:red;" id="error_canceldesc"></span>
								  </div>
								</div>
									<div class="form-group">
											<table style="text-align:left;position:relative;left:52px;"  width="100%">
												<tr>
													<td width="50"><!--Select Category and Plan Type--></td>
													<td width="30"></td>
													<td width="140"><?php echo $this->lang->line('From'); ?>:</td>
													<td width="30"></td>
													<td width="140	"><?php echo $this->lang->line('To'); ?>:</td>
													<td width="232"><strong><?php echo $this->lang->line('Day'); ?></strong> <!--<span style="float:right;"><input name="all_day" id="all_day" type="checkbox" value="" onclick="return check_all();" /> <strong>Check All</strong></span>--></td>
													<td colspan="2" style="border-bottom:solid 0px #666">
												</tr>
												<tr>
													<td style="width:250px;"> <b><?php echo $this->lang->line('Room_Available_Dates'); ?>:</b></td>
													<td >&nbsp;</td>
														<script>
														function check_all()
														{ 
															if($('#all_day').prop('checked')==true)
															{
																$('.dayy').prop('checked',true);
															}else{
																$('.dayy').prop('checked',false);
															} 
														 }
														function check_new(){
															$price = $('#price').val();
															$extra_bed_price = $('#extra_bed_price').val();
															$avail = $('#avail').val();
															$adult = $('#adult').val();
															$child = $('#child').val();
															$child_price = $('#child_price').val();
															$infant = $('#infant').val();
															$sup_charge = $('#sup_charge').val();
															if($avail!=''){
																$('input[name="avail[]"]').each(function(){
																 $('input[name="avail[]"]').val($avail);
																});
															}
															if($price!=''){
																$('input[name="price[]"]').each(function(){
																 $('input[name="price[]"]').val($price);
																});
															}
															if($extra_bed_price!=''){
																$('input[name="extra_bed_price[]"]').each(function(){
																 $('input[name="extra_bed_price[]"]').val($extra_bed_price);
																});
															}
															if($adult!=''){
																$('input[name="adult[]"]').each(function(){
																 $('input[name="adult[]"]').val($adult);
																});
															}
															if($child!=''){
																$('input[name="child[]"]').each(function(){
																 $('input[name="child[]"]').val($child);
																});
															}
															if($child_price!=''){
																$('input[name="child_price[]"]').each(function(){
																 $('input[name="child_price[]"]').val($child_price);
																});
															}
															if($infant!=''){
																$('input[name="infant[]"]').each(function(){
																 $('input[name="infant[]"]').val($infant);
																});
															}
															if($sup_charge!=''){
																$('input[name="sup_charge[]"]').each(function(){
																 $('input[name="sup_charge[]"]').val($sup_charge);
																});
															}
														}

														function getDates(){
															var sd=[];
															var ed=[];
															
															$('input[id^="datepicker4"]').each(function() {
																 sd.push($(this).val()); 
															});

															$('input[id^="datepicker5"]').each(function() {
																ed.push($(this).val());
															});
															
															if(sd == ''){
																alert("Please select from date");
																return false;
															}
															if(ed == ''){
																alert("Please select end date");
																return false;
															}
															var sd1 = new Array();
															var ed1 = new Array();
															
															for(var p=0; p <sd.length; p++)
															{
																	sd1[p]=sd[p];
															}
															for(var q=0; q < ed.length; q++)
															{
																ed1[q]=ed[q];
															}
															if(sd1 == '')
															{
																sd1 = sd;
															}
															if(ed1 == '')
															{
																ed1 = ed;
															}
															
															
															var selectedDays = new Array();
															var j=0;
															for(var i=0; i < document.form1.day.length; i++){
																if(document.form1.day[i].checked == true){
																	selectedDays[j]=document.form1.day[i].value;
																	j++;			
																}
															}
															
															if(selectedDays == ''){ selectedDays = 'All'; }
															$.post( "<?php print WEB_URL ?>hotel/getDates", {mmsd:sd1, mmed:ed1, selectedDays:selectedDays},
															  function(data) { 
																if(data != ''){
																	$("#filtering").show();
																	$("#monthDates").html('');
																	for(var i=0; i<data.dates.length; i++){
																		var day = data.dates[i].toString().split(" "); 
/*
																		$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%;font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="adult[]" id="adult[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" id="child[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:9%;" id="tdtd3">&nbsp;</td></tr>');
*/
																		
																		$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td style="border-right:solid 1px #deab6f; text-align:left; width:10%; font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input name="dates[]"  value="'+day[0]+'" type="hidden"><input name="weekday[]" value="'+day[0]+'" type="hidden"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" class="input-field" style="height:20px;width:85px;background:#F2F2F2;" value="" type="text"></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="extra_bed_price[]" class="input-field" style="height:20px;width:80px;background:#F2F2F2;" value="" type="text"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" class="input-field" style="height:20px;width:80px;background:#F2F2F2;" value="" type="text"></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="adult[]" id="adult[]" class="input-field" style="height:20px;width:80px;background:#F2F2F2;" value="" type="text"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" id="child[]" class="input-field" style="height:20px;width:80px;background:#F2F2F2;" value="" type="text"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" class="input-field" style=" height:20px;width:80px;background:#F2F2F2;" value="" type="text"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" class="input-field" style=" height:20px;width:80px;background:#F2F2F2;" value="" type="text"></td> <td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td></tr>');
																	}
																} 
															  }
															);
														}
													</script>
													<?php
														$current_dte = date("d-m-Y",strtotime("+7 days"));
														$next_dte = date("d-m-Y",strtotime("+8 days"));
													?>
													<td style="width:120px;"><input name="sd[]" id="datepicker4"   type="text"  style="background-repeat:no-repeat;background-position:right center;width:120px; height:30px;" value="<?php if(isset($rat_tac_details->room_avail_date_from)){ $aFrom = explode("-", $rat_tac_details->room_avail_date_from);$aFDate=$aFrom[2].'-'.$aFrom[1].'-'.$aFrom[0]; echo $aFDate; }?>"/></td>
													<td >&nbsp;</td>
													<td  style="width:120px;"><span id="out"><input name="ed[]" id="datepicker5"  type="text" style="background-repeat:no-repeat;background-position:right center;width:120px; height:30px;" value="<?php if(isset($rat_tac_details->room_avail_date_to)){ $aFrom = explode("-", $rat_tac_details->room_avail_date_to);$aFDate=$aFrom[2].'-'.$aFrom[1].'-'.$aFrom[0]; echo $aFDate; }?>"/></span></td>
													<td colspan="3" id="day">
															<input name="day" class="dayy" type="checkbox" value="Mon" style="margin-right:5px;"/><?php echo $this->lang->line('Mon'); ?> &nbsp; 
															<input name="day" class="dayy" type="checkbox" value="Tue" style="margin-right:5px;"/><?php echo $this->lang->line('Tue'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Wed" style="margin-right:5px;"/><?php echo $this->lang->line('Wed'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Thu" style="margin-right:5px;"/><?php echo $this->lang->line('Thu'); ?><br />
															<input name="day" class="dayy" type="checkbox" value="Fri" style="margin-right:5px;"/><?php echo $this->lang->line('Fri'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Sat" style="margin:5px 6px;"/><?php echo $this->lang->line('Sat'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Sun" style="margin-right:5px;"/><?php echo $this->lang->line('Sun'); ?>
													</td>
													<td colspan="2"><input name="" type="button"  value="submit" onclick="getDates();"/></td>
												</tr>
										</table>
										 <div id="filtering" style="coloir:#fff; width:100%; background:#f8f8f8; display:none;">
											<table width="100%" border="1" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="text-align:left;position:relative;left:6px;">
												<tr style="background:#243419"  height="45">
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-top:3px; color:#fff; padding-left:0px;"><?php echo $this->lang->line('Smart_Update'); ?></td>
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="price" id="price" type="text" class="input-field"  style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/></td>
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="extra_bed_price" id="extra_bed_price" type="text" class="input-field"  style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/></td>
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="avail" id="avail" type="text" class="input-field"  style="height:28px; margin-top:2px; background:#F2F2F2;" size="10"/></td>
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="adult" id="adult" type="text" class="input-field"  style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/></td>
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="child" id="child" type="text" class="input-field"  style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/></td>
													 <td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="child_price" id="child_price" type="text" class="input-field"  style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/></td>
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input name="infant" id="infant" type="text" class="input-field"  style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/></td>
												
													<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;"><input type="button" value="Update" style="margin-top:3px;" onclick="check_new();"/></td>
												</tr>
												<tr height="30" style="font-size:12px;">
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Dates'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Per_Night_Charge'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Extra_Bed_Charge'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Available_Rooms'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Adults'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Childs'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Child_Charge'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;"><?php echo $this->lang->line('Infants'); ?></td>
													<td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td>
												</tr>
													<tr><td colspan="9"><table width="100%" id="monthDates"></table></td></tr>
											</table>
											<table  width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="background:#fff; margin-top:0px;">
													
													<tr>
														<td height="30" style="color:red;">Once you finish all settings please click the "Save" button to save.</td>
													</tr>
													<input type="hidden" name="cnt" value=""/>
													<input type="hidden" name="from" id="from" value=""/>
													<input type="hidden" name="to" id="to" value=""/>
													<input type="hidden" name="room_id" id="room_id" value=""/>
													<input type="hidden" name="capacity" id="capacity" value=""/>
													<input type="hidden" name="on_req_checked" id="on_req_checked"/>
													<input type="hidden" name="on_arr_checked" id="on_arr_checked"/>
													<input type="hidden" name="on_blk_checked" id="on_blk_checked"/>
											</table>
												<div style="clear:both; height:1px;"></div>
												<input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL;?>">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td align="center"><input style="font-weight:bold;font-size:16px;" name="submit" class="btn btn-primary" type="submit"  value="SAVE"></td>
												</tr>
												<tr>
													<td height="20" colspan="2">&nbsp;</td>
												</tr>
											</table> 
										  </div>
										<div class="form-group">
											<label class="col-xs-12 col-md-3 control-label" for="textinput"></label>    
											<div class="col-xs-12 col-md-4"></div>
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
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		<script>
			  $(function() {
				$("#datepicker12").datepicker({
					minDate: 0,
					onSelect: function(selected) {
					  $("#datepicker13").datepicker("option","minDate", selected)
					}
				});
				$("#datepicker13").datepicker({
					 minDate: 0,
					numberOfMonths:1,
					onSelect: function(selected) {
					   $("#datepicker12").datepicker("option","maxDate", selected)
					}
				}); 
	    
				$( "#datepicker" ).datepicker({
				  defaultDate: "+1w",
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicker1" ).datepicker( "option", "minDate", selectedDate );
				  }
				});
				$( "#datepicker1" ).datepicker({
				  defaultDate: "+1w",
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
				  }
				});
			  });
			  
			  $(function() {
				$( "#datepicker2" ).datepicker({
					minDate:0,
				  defaultDate: "+1w",
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicker3" ).datepicker( "option", "minDate", selectedDate );
				  }
				});
				$( "#datepicker3" ).datepicker({
					minDate:0,
				  defaultDate: "+1w",
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicke2" ).datepicker( "option", "maxDate", selectedDate );
				  }
				});
			  });
			  
			  $(function() {
				$( "#datepicker4" ).datepicker({
				  minDate:0,
				  defaultDate: "+1w",
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicker5" ).datepicker( "option", "minDate", selectedDate );
				  }
				});
				$( "#datepicker5" ).datepicker({
				  minDate:0,
				  defaultDate: "+1w",
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicke4" ).datepicker( "option", "maxDate", selectedDate );
				  }
				});
			  });
			$(document).ready(function(){	
					$.post( "<?php print WEB_URL ?>hotel/getAvailDates", {rate_id:"<?php echo $rat_tac_details->sup_rate_tactics_id;?>"},
					  function(data) {
						if(data != ''){
							$("#filtering").show();
							$("#monthDates").html('');
							for(var i=0; i<data.avail_dates.length; i++){
								$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%; font-size:11.5px;" id="tdtd">'+data.avail_dates[i].day+'-'+data.avail_dates[i].month+'-'+data.avail_dates[i].year+' '+data.avail_dates[i].week_day+'<input type="hidden" name="dates[]" value="'+data.avail_dates[i].date+'"><input type="hidden" name="weekday[]" value="'+data.avail_dates[i].week_day+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;width:85px;background:#F2F2F2;" value="'+data.avail_dates[i].rate+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].extra_bed_price+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].available_rooms+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;"  value="'+data.avail_dates[i].adult+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].child+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style=" height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].child_charge+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style=" height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].infant+'"/></td> <td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td></tr>');
							}
						} 
					  }
					);
			});
		</script>
    </body>
</html>

