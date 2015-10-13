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
        
        <script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
      
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		<!-- table css-->
		<style>
			.CSSTableGenerator {
			 margin:0px;padding:0px;
			 width:100%;
			 border:1px solid #46BBFF;
			 
			 -moz-border-radius-bottomleft:0px;
			 -webkit-border-bottom-left-radius:0px;
			 border-bottom-left-radius:0px;
			 
			 -moz-border-radius-bottomright:0px;
			 -webkit-border-bottom-right-radius:0px;
			 border-bottom-right-radius:0px;
			 
			 -moz-border-radius-topright:0px;
			 -webkit-border-top-right-radius:0px;
			 border-top-right-radius:0px;
			 
			 -moz-border-radius-topleft:0px;
			 -webkit-border-top-left-radius:0px;
			 border-top-left-radius:0px;
			}.CSSTableGenerator table{
				border-collapse: collapse;
					border-spacing: 0;
			 width:100%;
			 height:100%;
			 margin:0px;padding:0px;
			}.CSSTableGenerator tr:last-child td:last-child {
			 -moz-border-radius-bottomright:0px;
			 -webkit-border-bottom-right-radius:0px;
			 border-bottom-right-radius:0px;
			}
			.CSSTableGenerator table tr:first-child td:first-child {
			 -moz-border-radius-topleft:0px;
			 -webkit-border-top-left-radius:0px;
			 border-top-left-radius:0px;
			}
			.CSSTableGenerator table tr:first-child td:last-child {
			 -moz-border-radius-topright:0px;
			 -webkit-border-top-right-radius:0px;
			 border-top-right-radius:0px;
			}.CSSTableGenerator tr:last-child td:first-child{
			 -moz-border-radius-bottomleft:0px;
			 -webkit-border-bottom-left-radius:0px;
			 border-bottom-left-radius:0px;
			}.CSSTableGenerator tr:hover td{
			 
			}
			.CSSTableGenerator tr:nth-child(odd){ background-color:#e5e5e5; }
			.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
			 vertical-align:middle;
			 
			 
			 border:1px solid #46BBFF;
			 border-width:0px 1px 1px 0px;
			 text-align:left;
			 padding:10px;
			 font-size:12px;
			 font-family:Arial;
			 font-weight:normal;
			 color:#000000;
			}.CSSTableGenerator tr:last-child td{
			 border-width:0px 1px 0px 0px;
			}.CSSTableGenerator tr td:last-child{
			 border-width:0px 0px 1px 0px;
			}.CSSTableGenerator tr:last-child td:last-child{
			 border-width:0px 0px 0px 0px;
			}
			.CSSTableGenerator tr:first-child td{
			 background:#3C8DBC;
			 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#848484"); background: -o-linear-gradient(top,#cccccc,848484);
			 border:0px solid #46BBFF;
			 text-align:left;
			 border-width:0px 0px 1px 1px;
			 font-size:12px;
			 font-family:Arial;
			 font-weight:bold;
			 color:#fff;
			}

			.CSSTableGenerator tr:first-child td:first-child{
			 border-width:0px 0px 1px 0px;
			}
			.CSSTableGenerator tr:first-child td:last-child{
			 border-width:0px 0px 1px 1px;
			}
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
                                    <li style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="<?php echo WEB_URL;?>hotel/boardtype_manager"><?php echo 'Board Type Manager'; ?></a></li>
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
						<table style="text-align:right;position:relative;right:-672px;">
							<tr> 
							<td colspan="3" class="btn btn-primary" ><a href="<?php echo WEB_URL;?>hotel/price_manager"><b>Back</b></a></td>
							</tr>
							
						</table>
					</div><!-- /.box-header -->
                    <!-- form start -->
                     <form name="form1" id="form1" class="form-horizontal add_hotel_form" enctype="multipart/form-data" action="<?php echo WEB_URL;?>hotel/add_pricemanager_ad" method="post">
                               <fieldset>
									<!-- Form Name -->
									<div class="form-group">
									  <div class="col-xs-12 col-md-4"></div>
									</div>
									<div class="form-group">
									 <div class="col-xs-12 col-md-4">
										  <input type="hidden" name="market_id[]" value="0">
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
											<option value="<?php echo $value->sup_hotel_id;?>"><?php echo $value->hotel_name; ?></option>
											<?php 
													}
												}
											?>
										</select>
										<span style="color:red;" id="error_hotelname"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Board_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<select id="board_type" name="board_type" placeholder="Board Type" class="form-control input-md">
											<?php 
												if(isset($Board_Type) && $Board_Type!=''){
													foreach($Board_Type as $type){
											?>
											<option value="<?php echo $type->board_name; ?>"><?php echo $type->board_name; ?></option>
											<?php 
													}
												}
											?>
										</select>
										<span style="color:red;" id="error_boardtype"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Category'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<p id="roomTypes" style="color:red;">Sorry No Room Category found in this hotel !</p>
										<span style="color:red;" id="error_capacitytype"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"> <?php echo $this->lang->line('Room_Type'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<p id="roomTypeCapacity" style="color:red;">Sorry No Room Type found in this hotel !</p>
										<span style="color:red;" id="error_room_type"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Room_Image'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="mainimage" id="mainimage" > 
										<span style="color:red;" id="error_mainimage"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Image1'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image1" id="image1" > 
										<span style="color:red;" id="error_image1"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Image2'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image2" id="image2" > 
										<span style="color:red;" id="error_image2"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Image3'); ?></label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image3" id="image3" > 
										<span style="color:red;" id="error_image3"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Child_Policy'); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<textarea name="child_policy" placeholder="Child Policy" id="child_policy" class="form-control input-md" > </textarea><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_childpolicy"></span>
									  </div><br/>
									   <div class="input-group custom-input-group">
										<textarea name="child_policyA" placeholder="Child Policy" id="child_policyA" class="form-control input-md" > </textarea><span class="input-group-addon">Arabic</span>
									   </div>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line('Cancellation_Policy'); ?></label>  
								  <div>
										<?php echo $this->lang->line('Nights'); ?><input type="text" id="nights" name="nights" size="8" value="" />	
										<?php echo $this->lang->line('Charge'); ?><input type="text" id="charge" name="charge" size="8" value="" />% 
										<?php echo $this->lang->line('or'); ?> <input type="text" id="currency" name="currency" size="8" value="" />&nbsp;
										<?php echo $this->lang->line('Per_Night_Charge'); ?>&nbsp;&nbsp;<?php echo $this->lang->line('From'); ?><input type="text" id="datepicker12" name="cancel_policy_from" size="8" value="" />&nbsp;&nbsp;
										<?php echo $this->lang->line('To'); ?><input type="text" id="datepicker13" name="cancel_policy_to" size="8" value="" />
										<span style="color:red;" id="error_childpolicy"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"><?php echo $this->lang->line(''); ?></label>  
								  <div class="col-xs-12 col-md-4">
									  <div class="input-group custom-input-group">
										<textarea name="cancel_desc" placeholder="Cancellation Description" id="cancel_desc" class="form-control input-md" > </textarea><span class="input-group-addon">English</span>
										<span style="color:red;" id="error_canceldesc"></span>
									   </div><br/>
									   <div class="input-group custom-input-group">
										 <textarea name="cancel_descA" placeholder="Cancellation Description" id="cancel_descA" class="form-control input-md" > </textarea><span class="input-group-addon">Arabic</span>
									   </div>
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
															if($("#hotel_name").val()!=''){
																var base_url=$("#web_url").val();
																$.ajax({
																	 url: base_url+"hotel/markup_all",
																	 type: 'post',
																	 async: false,
																	 data:  {'price':$('#price').val(),'hotel_id':$("#hotel_name").val()},
																	 success: function(output) {
																			$price = $('#price').val();
																			$sell_price =output;
																			$rack_price = $('#rack_price1').val();
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
																			if($sell_price!=''){
																				$('input[name="sell_price[]"]').each(function(){
																				 $('input[name="sell_price[]"]').val($rack_price);
																				});
																			}
																			if($rack_price!=''){
																				$('input[name="rack_price[]"]').each(function(){
																				 $('input[name="rack_price[]"]').val($sell_price);
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
																});
															}else{ 
																alert("Please Select The hotel");return false;
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
																	$("#filter").show();
																	$("#save").show();
																	$(".html_value").remove();
																	//$("#monthDates").html('');
																	for(var i=0; i<data.dates.length; i++){
																		var day = data.dates[i].toString().split(" "); 
																	//	$("#monthDates").append('<table width="100%" border="1" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="text-align:left;position:relative;left:6px;"><tbody><tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding:9px;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3"><input name="sell_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3"><input name="rack_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding:10px;" id="tdtd3"><input name="adult[]" id="adult[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3">	<input name="child[]" id="child[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; padding:10px;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td></tr></tbody></table>');
																		$("#monthDates").append('<tr class="html_value" ><td>'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td><input name="price[]" type="text" size="5"/></td><td><input name="sell_price[]" type="text" size="5"/></td><td><input name="rack_price[]" type="text" size="5"/></td><td><input name="extra_bed_price[]" type="text" size="5"/></td><td><input name="avail[]" type="text" class="input-field" size="5"/></td><td><input name="adult[]" id="adult[]" type="text" size="5"/></td><td><input name="child[]" id="child[]" type="text" size="5"/></td><td><input name="child_price[]" type="text" size="5"/></td><td><input name="infant[]" type="text" size="5"/></td><td> &nbsp; </td></tr>');
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
													<td style="width:120px;"><input name="sd[]" id="datepicker4"   type="text"  style="background-repeat:no-repeat;background-position:right center;width:120px; height:30px;" value=""/></td>
													<td >&nbsp;</td>
													<td  style="width:120px;"><span id="out"><input name="ed[]" id="datepicker5"  type="text" style="background-repeat:no-repeat;background-position:right center;width:120px; height:30px;" value=""/></span></td>
													<td colspan="3" id="day">
															<input name="day" class="dayy" type="checkbox" value="Mon" style="margin-right:5px;"/><?php echo $this->lang->line('Mon'); ?>&nbsp; 
															<input name="day" class="dayy" type="checkbox" value="Tue" style="margin-right:5px;"/><?php echo $this->lang->line('Tue'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Wed" style="margin-right:5px;"/><?php echo $this->lang->line('Wed'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Thu" style="margin-right:5px;"/><?php echo $this->lang->line('Thu'); ?><br />
															<input name="day" class="dayy" type="checkbox" value="Fri" style="margin-right:5px;"/><?php echo $this->lang->line('Fri'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Sat" style="margin:5px 6px;"/><?php echo $this->lang->line('Sat'); ?> &nbsp;
															<input name="day" class="dayy" type="checkbox" value="Sun" style="margin-right:5px;"/><?php echo $this->lang->line('Sun'); ?>
													</td>
													<td colspan="2"><input style="margin:0px 120px 0px 0px;" type="button" value="submit" onclick="getDates();"/></td>
												</tr>
										</table>
										<br/>
										<div class="CSSTableGenerator" style="coloir:#fff; width:100%; background:#f8f8f8; display:none;" id="filter" >
										<table id="monthDates">
											<tr>
												<td><?php echo $this->lang->line('Smart_Update'); ?></td>
												<td>
													<input name="price" id="price" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10">
												</td>
												<td>
													<input name="rack_price" id="rack_price1" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												</td>
												 <td>
													 <input name="sell_price" id="sell_price1" readonly type="text" style="height:28px; margin-top:3px; background:#E0E0D1;" size="10"/>
												 </td>
												 <td>
													 <input name="extra_bed_price" id="extra_bed_price" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												 </td>
												 <td>
													 <input name="avail" id="avail" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												 </td>
												 <td>
													 <input name="adult" id="adult" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												 </td>
												 <td>
													 <input name="child" id="child" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												 </td>
												 <td>
													 <input name="child_price" id="child_price" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												 </td>
												 <td>
													 <input name="infant" id="infant" type="text" style="height:28px; margin-top:3px; background:#F2F2F2;" size="10"/>
												 </td>
												 <td>
													 <input type="button" value="Update" style="margin-top:3px;" onclick="check_new();"/>
												 </td>
											</tr>
											
											<tr>
												 <td>
													<?php echo $this->lang->line('Dates'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('base_price'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('rack_price'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('sell_price'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('Extra_Bed_Charge'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('Available_Rooms'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('Adults'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('Childs'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('Child_Charge'); ?>
												 </td>
												 <td>
													<?php echo $this->lang->line('Infants'); ?>
												 </td>
												 <td> &nbsp; </td>
											</tr>
										</table>
										</div>
										<br/>
										<div  style="display:none;" id="save" >
											<input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL;?>">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td align="center"><input style="font-weight:bold;font-size:16px;" name="submit" class="btn btn-primary" type="submit"  value="SAVE"></td>
												</tr>
											</table> 
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
			CKEDITOR.replace( 'child_policy' );
			CKEDITOR.replace( 'child_policyA' );
			CKEDITOR.replace( 'cancel_desc' );
			CKEDITOR.replace( 'cancel_descA' );
		</script>
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
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
						var date = $(this).datepicker('getDate');
						if (date) {
							  date.setDate(date.getDate() + 1);
						}
						$( "#datepicker5" ).datepicker( "option", "minDate", date);
				  }
				});
				$( "#datepicker5" ).datepicker({
				  minDate:0,
				  changeMonth: true,
				  numberOfMonths: 1,
				  dateFormat: 'dd-mm-yy',
				  onClose: function( selectedDate ) {
					$( "#datepicke4" ).datepicker( "option", "maxDate", selectedDate );
				  }
				});
			  });
		</script>
    </body>
</html>

