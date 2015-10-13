<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>fanadeqoman</title>
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyle.css">
	<link href="<?php echo WEB_DIR;?>public/css/common.css" rel="stylesheet" media="screen" id="color">
	<!-- Font Icon -->
	<link href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="wrapper">
				<?php $this->load->view('header_main'); ?>
				<div class="clearfix"></div>
				<div class="container">
					<div class="row mt10">    
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<!--Map-->
							<div class="well">
							   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d248849.84916296514!2d77.6309395!3d12.9539974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1407913978538" width="100%" height="390" frameborder="0" style="border:0"></iframe>
							</div>
						</div>
						<!--Contact Address-->                  
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<aside>
								<div class="sidewidt">
								  <h2 class="heading2"><span> <i class="icon-envelope"></i> <?php echo $this->lang->line('conatactinfo'); ?></span></h2>
								  <p> <?php echo $this->lang->line('desc'); ?></p>
								  <div class="contactlinks">
									  <i class="icon-phone"></i> <strong><?php echo $this->lang->line('phone'); ?></strong>: 080 - 42342342<br>
									  <i class="icon-phone"></i> <strong><?php echo $this->lang->line('fax'); ?></strong>: 080 - 423424355<br>
									  <i class="icon-envelope"></i> <strong><?php echo $this->lang->line('email'); ?></strong>: support@fanadeqoman.com<br>
									  <i class="icon-globe"></i> <strong><?php echo $this->lang->line('web'); ?></strong>: www.fanadeqoman.com<br>
								  </div>
								 </div>
							</aside>
						  </div>
							<!--Contact Form-->
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<form class="form-horizontal contactform"  method="post">
								  <fieldset>
									  <span id="success" style="color:#00B0F0;"></span>
									<div class="control-group">
									  <label for="name" class="control-label"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
									  <div class="controls">
										<input type="text"  class="required pwid60" id="name12" value="" name="name12">
										<input type="hidden"  class="required pwid60" id="web_url" value="<?php echo WEB_URL;?>" name="web_url">
									  </div>
									</div>
									<div class="control-group">
									  <label for="email" class="control-label"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
									  <div class="controls">
										<input type="email"  class="required  pwid60" id="email12" value="" name="email12" >
										<span style="color:red;" id="error_for_email12"></span>
									  </div>
									</div>
									<div class="control-group">
									  <label for="contact" class="control-label"><?php echo $this->lang->line('Contact'); ?> <span class="required">*</span></label>
									  <div class="controls">
										<input type="text"  id="contact12" value="" class="pwid60" name="contact12" >
										<span style="color:red;" id="error_for_contact12"></span>
									  </div>
									</div>
									<div class="control-group">
									  <label for="message" class="control-label"><?php echo $this->lang->line('Message'); ?></label>
									  <div class="controls">
										<textarea  class="required pwid60"  id="message" name="messagee"></textarea>
									  </div>
									</div>
									<div class="form-actions">
									  <input class="btn btn-blue" type="button" value="Submit" id="submit_id12" onclick="return dovalidation()">
									  <input class="btn" type="reset" value="Reset">
									</div>
								  </fieldset>
								</form>
							  </div>     
						</div><!-- row mt10 end-->
					</div><!-- container-->
			<div class="clearfix"></div>
			<!-- footer-->
			 <?php $this->load->view('footer'); ?>
			<!-- footer end-->
		 </div><!-- end of wrapper-->
	</body>
   <style>
	    td,th{ border-right:1px solid #ddd;}
		.lightbg{ background-color:#f5f5f5}
   </style>
   <script>
function dovalidation() {
			flag1=true; flag2=true; flag3=true;
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
			var numbers = /^[0-9]+$/;  
				if($("#name12").val()==''){
					$('#name12').css('border-color', 'red');
					flag1=false;
				}else{
					$('#name12').css('border-color', '#00B0F0');
					flag1=true;
				}
				
				if($("#email12").val()==''){
					$('#email12').css('border-color', 'red');
					flag2=false;
				}else if(!$("#email12").val().match(mailformat)){
					$('#email12').css('border-color', 'red');
					$("#error_for_email12").html('Email Not Valid');
					$("#email12").val('');
					flag2=false;
				}else{
					$("#error_for_email12").html('');
					$('#email12').css('border-color', '#00B0F0');
					flag2=true;
				}
					
				if($("#contact12").val()==''){
					$('#contact12').css('border-color', 'red');
					flag3=false;
				}else if(!$("#contact12").val().match(numbers)){
					$('#contact12').css('border-color', 'red');
					$("#error_for_contact12").html('Number Not Valid');
					$("#contact12").val('');
					flag3=false;
				}else{
					$("#error_for_contact12").html('');
					$('#contact12').css('border-color', '#00B0F0');
					flag3=true;
				}
				
				if(flag1==false ||flag2==false || flag3==false) {
					return false;
				}
				var name12=$('#name12').val();
				var email12=$('#email12').val();
				var contact12=$('#contact12').val();
				var message=$('#message').val();
				var base_url=$('#web_url').val();
				if($("#email12").val()!='' && $("#contact12").val()!=''){ 
					$.ajax({
							type: "POST",
							url: base_url+"hotel_user/contact",
							data: { 'name':name12,'email':email12,'contact':contact12,'message':message}
						})
						.done(function( msg ){ 
							if(msg==1){
								alert('Your message is succesfullty sent. We will get back you soon');		
								window.location.href = base_url+"hotel/contact_us";
							}
						});
				}
	
}
</script>
</html>
	<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
