<?
$combination=$this->session->userdata('hotel_search_data');
?>
<!doctype html>
<html lang="en">
<head>
   <title>fanadeqoman</title>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
    
	<!--Core Bootstrap CSS-->
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
	<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo WEB_DIR;?>public/css/elastislide.css">
	<script src="<?php echo WEB_DIR;?>public/js/modernizr.custom.17475.js"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('header_main'); ?>
	<!-- topmanu end-->
	<div class="clearfix"></div>
	<!-- header end-->
	<!-- pre booking--->
	<div class="container"> 
		<div class="row mt20">       
			<!-- Account Login-->
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<h2 class="heading2"><?php echo $this->lang->line('review'); ?></h2>
				<!-- Customer Details-->
				<div id="primary_details">
						<div class="checkoutsteptitle" ><?php echo $this->lang->line('Step'); ?> 1: <?php echo $this->lang->line('Customer_Details'); ?><a class="modify pull-right">&nbsp;</a>
						<span class="pull-right font12 lgray"><?php echo $this->lang->line('Provide'); ?> ?</span> </div>
						<div class="checkoutstep">
							<div class="row">
								<form class="form-horizontal form-custom" id="formid" action="<?php echo WEB_URL;?>hotel/payment_Process" method="post">
								  <fieldset>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									 <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('Title'); ?><span class="red">*</span></label>
										<div class="controls">
										  <select >
											<option>Mr.</option>
											<option>Mrs.</option>
											<option>Ms.</option>
										  </select>
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('fname'); ?><span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="fname" name="fname">
										  <span id="error_fname" style="color:red;"></span>
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('lname'); ?><span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="lname" name="lname">
										  <span id="error_lname" style="color:red;"></span>
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('email'); ?><span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="email" name="email">
										  <span id="error_email" style="color:red;"></span>
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('remail'); ?><span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="cemail" name="cemail">
										  <span id="error_cemail" style="color:red;"></span>
										</div>
									  </div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('Country'); ?><span class="red">*</span></label>
										<div class="controls">
											<select id="state" name="country">
												<option value=""><?php echo $this->lang->line('Country'); ?></option>
												<?php foreach($country as $value){ ?>
												<option value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
												<?php } ?>
											</select>
											<span id="error_state" style="color:red;"></span>
										</div>
									  </div>
                                     <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('City'); ?><span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="city" name="city">
										  <span id="error_city" style="color:red;"></span>
										</div>
									  </div>
                                       <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('contact-number'); ?><span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="postel" name="phone">
										  <span id="error_postel" style="color:red;"></span>
										</div>
									  </div>
									 <div class="form-group">
                                      <label class="control-label" ><?php echo $this->lang->line('Address'); ?> 1<span class="red">*</span></label>
										<div class="controls">
										  <input type="text" class=""  value="" id="address1" name="address1">
										  <span id="error_address1" style="color:red;"></span>
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label" ><?php echo $this->lang->line('Address'); ?> 2</label>
										<div class="controls">
										  <input type="text" class=""  value="" id="address2" name="address2">
										  <span id="error_address2" style="color:red;"></span>
										</div>
									  </div>
									</div>
								  </fieldset>
								  <input type="hidden" id="hotel_id" name="hotel_id" value="<?php echo $details['hotel_id']; ?>" />
								  <input type="hidden" id="sup_rate_id" name="sup_rate_id" value="<?php echo $details['sup_rate_id']; ?>" />
								  <input type="hidden" id="hotel_name" name="hotel_name" value="<?php echo $details['hotel_name']; ?>" />
								  <input type="hidden" id="check_in" name="check_in" value="<?php echo $details['check_in']; ?>" />
								  <input type="hidden" id="check_out" name="check_out" value="<?php echo $details['check_out']; ?>" />
								  <input type="hidden" id="room" name="room" value="<?php echo $details['room']; ?>" />
								  <input type="hidden" id="final_cost" name="final_cost" value="<?php $total=$details['room_cost']*$details['nights']; echo $total; ?>" />
								</form>
							</div>
						<a class="btn btn-blue pull-right" onClick="your_Booking()"><?php echo $this->lang->line('Continue'); ?></a> 
					</div>
			</div>
        <!-- Customer Details end-->
          <!--Confirm Booking-->
          <div id="booking">
			<div class="checkoutsteptitle" ><?php echo $this->lang->line('Step'); ?> 2: <?php echo $this->lang->line('Your_Bookings'); ?><a class="modify pull-right">&nbsp;</a>
				<span class="pull-right font12 lgray">Please verify your booking ?</span>
			</div>
			<div class="checkoutstep">
				<div class="cart-info pw100">
					<table class="table table-striped table-bordered">
					  <tr>
						<th><?php echo $this->lang->line('room_type'); ?></th>
						<th class="check_in"><?php echo $this->lang->line('Check-In'); ?></th>
						<th class="check_out"><?php echo $this->lang->line('Check-Out'); ?></th>
						<th class="rooms"><?php echo $this->lang->line('Rooms'); ?></th>
						<th class="rooms"><?php echo $this->lang->line('Nights'); ?></th>
						<th class="persons"><?php echo $this->lang->line('Persons'); ?></th>
						<th class="price"><?php echo $this->lang->line('Price'); ?></th>
					  </tr>
					  <tr>
							<td class="image">
								<a>
									<?php if(isset($details['room_image'])){ ?>
									<img src="<?php echo WEB_DIR;?>public/hotel_img/<?php if(isset($details['room_image'])){ echo $details['room_image'];} ?>" width="50" height="30">
								</a><?php  } ?>
								<br/>
								<?php if(isset($details['room_name'])){ echo $details['room_name'];} ?>
							</td>
							<td class="check_in">
								<?php if(isset($details['check_in'])){ echo $details['check_in']; } ?>
							</td>
							<td class="check_out">
								<?php if(isset($details['check_out'])){ echo $details['check_out']; } ?>
							</td>
							<td class="rooms">
								<input class="text-center"  type="text" size="1" value="<?php if(isset($details['room'])){ echo $details['room']; } ?>" readonly name="rooms">
							</td>
							<td class="nights">
								<input class="text-center"  type="text" size="1" value="<?php if(isset($details['nights'])){ echo $details['nights']; } ?>" readonly name="nights">
							</td>
							<td class="persons">
								<input class="text-center" type="text" size="1" value="<?php if(isset($hotel_book_details['adults_count'])){ $persons=$hotel_book_details['adults_count']+$hotel_book_details['childs_count']; echo $persons; }else{ echo "1";}  ?>" readonly name="persons">
							</td>
							<td class="total"><?php $total=$details['room_cost']*$details['nights']; echo '$'.$total; ?></td>             
						</tr>
					</table>
			</div>
			<div class="pull-right col-lg-3 pr0">
				<table class="table table-striped table-bordered ">
				  <tbody>
					<!--<tr>
					  <td><span class="extra bold">Sub Total :</span></td>
					  <td><span class="bold">$300</span></td>
					</tr>
					<tr>
					  <td><span class="extra bold">Tax (2%):</span></td>
					  <td><span class="bold">$11</span></td>
					</tr>
					<tr>
					  <td><span class="extra bold">Other Fees :</span></td>
					  <td><span class="bold">$21</span></td>
					</tr>-->
					<tr>
					  <td><span class="extra bold totalamout"><?php echo $this->lang->line('Total'); ?> :</span></td>
					  <td><span class="bold totalamout"><?php $total=$details['room_cost']*$details['nights']; echo '$'.$total; ?></span></td>
					</tr>
				  </tbody>
				</table>
            </div>
			<p class="clearfix ml15">
				<input type="checkbox" value="" id="terms" name="terms" class="mr10">
					<span class="ml10">
						<?php echo $this->lang->line('agree'); ?><a ><?php echo $this->lang->line('Privacy_Policy'); ?></a>
					</span>
				<a class="btn btn-blue pull-right" onClick="payment_Process()">Proceed to Payment</a> 
			</p>
         </div>
        </div>
        
        
         <!-- Confirm Booking end-->
         <div id="payment_method">
		 <!-- Payment  Method-->
        <div class="checkoutsteptitle"><?php echo $this->lang->line('Step'); ?> 3: <?php echo $this->lang->line('Payment_Method'); ?><a class="modify pull-right">&nbsp;</a>
			<span class="pull-right font12 lgray"><?php echo $this->lang->line('how'); ?> ?</span> </div>
			<div class="checkoutstep">
			  <p><?php echo $this->lang->line('select'); ?>.</p>
			  <div class="row clearfix">
				<div class="col-lg-6 text-center">
					<label for="cashpay" title="pay by Card">
					<input type="radio" id="card"  checked name="cash" value="" onClick="payment('card')">&nbsp;<strong><?php echo $this->lang->line('Card'); ?></strong></label>
				</div>
				<div class="col-lg-6 text-center">
					<label for="cashpay" title="pay by cash">
					<input type="radio" name="cash" id="cash" value="" onClick="payment('cash')">&nbsp;<strong><?php echo $this->lang->line('Cash'); ?></strong></label>
				</div>
			  </div>
        
            <div id="payment"></div>
            <div id="card_payment" class=" row mt20 clearfix">
				 <div class="col-lg-3 text-center"><i class=" icon-credit-card font96"></i></div><!-- col- left-->
				 <div class="col-lg-9">
				 <div class="col-lg-3 font mt5 mb5"><label><?php echo $this->lang->line('Card_Number'); ?></label><span class="red">*</span></div>
				 <div class="col-lg-9 mt5 mb5"> <input id="" name="" placeholder="CARD NO." value=""  class="pwid69" type="text"></div>
                 <div class="col-lg-3 mt5 mb5"><label><?php echo $this->lang->line('Name_Card'); ?></label><span class="red">*</span></div>
                 <div class="col-lg-9 mt5 mb5"><input id="" value="" placeholder="NAME" class="pwid69" type="text"></div>
				 <div class="col-lg-3 mt5 mb5"><label><?php echo $this->lang->line('Expiry_Date'); ?></label><span class="red">*</span></div>
                 <div class="col-lg-9 mt5 mb5">  
						<select class="" id="">
                                <option value="0">Month</option>
                                <option value="01"> 01</option>
                                <option value="02"> 02</option>
                                <option value="03"> 03</option>
                                <option value="04"> 04</option>
                                <option value="05"> 05</option>
                                <option value="06"> 06</option>
                                <option value="07"> 07</option>
                                <option value="08"> 08</option>
                                <option value="09"> 09</option>
                                <option value="10"> 10</option>
                                <option value="11"> 11</option>
                                <option value="12"> 12</option>
                        </select>
                        <select class="" id="">
                                <option value="0">Year</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                        </select>
                        <input value="" id="" placeholder="CVV NO." class="pwid20" type="password"><img class="cvv" src="<?php echo WEB_DIR;?>public/img/cvv_info.jpg">
               </div>
               <div class="col-lg-12 mt10 text-center"><?php echo $this->lang->line('total_payment'); ?> <b class="font24 ml10"><?php $total=$details['room_cost']*$details['nights']; echo '$'.$total; ?></b></div>
		       </div><!-- col- right-->
            </div><!-- row end-->
			<div id="cash_payment" class=" row mt20 mb20 clearfix" style="display:none;">
					 <div class="col-lg-3 text-center"><img width="80" src="<?php echo WEB_DIR;?>public/img/hand132.png"></div><!-- col- left-->
					 <div class="col-lg-9">
						<div class="col-lg-10 mt10 text-center mb20"><?php echo $this->lang->line('total_payment'); ?> <b class="font24 ml10"><?php $total=$details['room_cost']*$details['nights']; echo '$'.$total; ?></b></div>
						<textarea placeholder=" Write Your Comments" cols="3"></textarea>
					 </div><!-- col- right-->
			 </div><!-- row end-->
			<div class="pull-right clearfix"> <a class="btn btn-blue pull-right" onClick="payment_Allow()"><?php echo $this->lang->line('Pay_Securely'); ?></a></div>
			</div><!-- co step-->
		</div><!-- co title-->
		</div>
     <!-- Sidebar Start-->
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt40column">
        <aside>
			<h2 class="heading2"><span><?php echo $this->lang->line('Popular_Hotels'); ?></span></h2>
			<div class="column">
				<ul id="carousel" class="elastislide-list">
				<?php 
					$i=0;
					$latest_hotels=$this->Hotel_Model->get_popular_hotels();
					 if(isset($latest_hotels) && $latest_hotels!=''){
						 foreach($latest_hotels as $hotel){
							 if($i<=10){
				?>
					<li><a href="<?php echo WEB_URL;?>hotel/hotel_details/<?php echo $hotel->sup_hotel_id;?>/<?php echo $hotel->sup_rate_tactics_id ?>"><img src="<?php echo WEB_DIR;?>public/hotel_img/<?php echo $hotel->main_image; ?>" alt="hotel" /></a></li>
				<?php 
							}
					     } 
					 }
				?>
				</ul>
				<!-- End Elastislide Carousel -->
			</div>
		</aside>
      </div>
      <!-- Sidebar End-->       
    </div>
  </div>
 <!-- pre booking end--->   
    <!-- footer-->
	<?php $this->load->view('footer'); ?>
<!-- footer end-->
</div><!-- wrapper-->
	<script src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
	<script src="<?php echo WEB_DIR;?>public/js/jquery.elastislide.js"></script>
	<script src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
    
    	<script>
		function payment(id)
		{
			if(id=='cash'){
				$('#cash_payment').show();
				$('#card_payment').hide();
			}else if(id=='card'){
				$('#card_payment').show();
				$('#cash_payment').hide();
			}
		}
		
		$( '#carousel' ).elastislide({
			orientation : 'vertical'
		});
	</script>
    
    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			 $('#booking').hide();
			 $('#payment_method').hide();
		 }); 
		
		function your_Booking()
		{
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
			var numbers = /^[0-9]+$/;  
			var letters = /^[A-Za-z _]+$/; 
			
			
			var flag=true;			var flag1=true; 		var flag2=true;
			var flag3=true;			var flag4=true;			var flag5=true;
			var flag6=true;	 		var flag7=true;			var flag8=true;	
			
			var fname=$('#fname').val();			var lname=$('#lname').val();
			var email=$('#email').val();			var cemail=$('#cemail').val();
			var address1=$('#address1').val();		var address2=$('#address2').val();
			var city=$('#city').val();				var postel=$('#postel').val();
			var state=$('#state').val();
			
			if(fname==''){
				$('#fname').css('border-color', 'red');
				$('#error_fname').html('Required');
				flag=false;
			}else if(!fname.match(letters)){
				$('#fname').css('border-color', 'red');
				$('#error_fname').html('Characters Only');
				flag=false;
			}else{
				$('#error_fname').html('');
				$('#fname').css('border-color', '');
				flag=true;
			}
			
			if(lname==''){
				$('#lname').css('border-color', 'red');
				$('#error_lname').html('Required');
				flag1=false;
			}else if(!lname.match(letters)){
				$('#lname').css('border-color', 'red');
				$('#error_lname').html('Characters Only');
				flag1=false;
			}else{
				$('#error_lname').html('');
				$('#lname').css('border-color', '');
				flag1=true;
			}
			
			if(email==''){
				$('#email').css('border-color', 'red');
				$('#error_email').html('Required');
				flag2=false;
			}else if(!email.match(mailformat)){
				$('#email').css('border-color', 'red');
				$('#error_email').html('Not Volid Email');
				flag2=false;
			}else{
				$('#email').css('border-color', '');
				$('#error_email').html('');
				flag2=true;
			}
			
			if(cemail==''){
				$('#cemail').css('border-color', 'red');
				$('#error_cemail').html('Required');
				flag3=false;
			}else if(cemail!=email){
				$('#cemail').css('border-color', 'red');
				$('#error_cemail').html('Required Same Email');
				flag3=false;
			}else if(!email.match(mailformat)){
				$('#cemail').css('border-color', 'red');
				$('#error_cemail').html('Not Volid Email');
				flag3=false;
			}else{
				$('#cemail').css('border-color', '');
				$('#error_cemail').html('');
				flag3=true;
			}
			
			if(address1==''){
				$('#address1').css('border-color', 'red');
				$('#error_address1').html('Required');
				flag4=false;
			}else{
				$('#address1').css('border-color', '');
				$('#error_address1').html('');
				flag4=true;
			}
			if(address2==''){
				$('#address2').css('border-color', 'red');
				$('#error_address2').html('Required');
				flag5=false;
			}else{
				$('#address2').css('border-color', '');
				$('#error_address2').html('');
				flag5=true;
			}
			
			if(city==''){
				$('#city').css('border-color', 'red');
				$('#error_city').html('Required');
				flag6=false;
			}else{
				$('#city').css('border-color', '');
				$('#error_city').html('');
				flag6=true;
			}
			
			
			if(postel==''){
				$('#postel').css('border-color', 'red');
				$('#error_postel').html('Required');
				flag7=false;
			}else if(!postel.match(numbers)){
				$('#postel').css('border-color', 'red');
				$('#error_postel').html('Numeric Only');
				flag7=false;
			}else{
				$('#postel').css('border-color', '');
				$('#error_postel').html('');
				flag7=true;
			}
			
			if(state==''){
				$('#state').css('border-color', 'red');
				$('#error_state').html('Required');
				flag8=false;
			}else{
				$('#state').css('border-color', '');
				$('#error_state').html('');
				flag8=true;
			}
			if(flag==false || flag1==false || flag2==false || flag3==false || flag4==false || flag5==false || flag6==false || flag7==false || flag8==false){
				 $('#booking').hide();
				 $('#payment_method').hide();
				 return false;
			}else{
				$('#booking').show();
			}
		}
		function payment_Process()
		{
			if($("#terms").is(':checked'))
			{
				$('#payment_method').show();
			}else{
				alert('Please select Terms and Conditions');
				return false;
			}
		}
		function payment_Allow()
		{
			$("#formid").submit();
		}
	</script>

</body>
</html>
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/bootstrap.min.js"></script>
	
