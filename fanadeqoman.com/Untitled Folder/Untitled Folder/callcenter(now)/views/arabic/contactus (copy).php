<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>fanadeqoman</title>
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/bootstrapA.css">
		<link rel="stylesheet" href="<?php echo WEB_DIR;?>public/css/mystyleA.css">
		<link href="<?php echo WEB_DIR;?>public/css/commonA.css" rel="stylesheet" media="screen" id="color">
		<!-- Font Icon -->
		<link href="<?php echo WEB_DIR;?>public/css/font-awesome.min.css" rel="stylesheet" media="screen">
	</head>
<body>
<div class="wrapper">
	<?php $this->load->view('arabic/header_main'); ?>
	<div class="clearfix"></div>
	<div class="container">
		<div class="row mt10">    
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<!--Map-->
				<div class="well">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d248849.84916296514!2d77.6309395!3d12.9539974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1407913978538" width="100%" height="365" frameborder="0" style="border:0"></iframe>
				</div>
			</div>
			<!--Contact Address-->                  
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<aside>
				  <div class="sidewidt">
					<h2 class="heading2"><span> <i class="icon-envelope"></i> Contact Info</span></h2>
					<p> some description here</p>
					  <div class="contactlinks">
						  <i class="icon-phone"></i> <strong>Phone</strong>: 080 - 42342342<br>
						  <i class="icon-phone"></i> <strong>Fax</strong>: 080 - 423424355<br>
						  <i class="icon-envelope"></i> <strong>Email</strong>: support@fanadeqoman.com<br>
						  <i class="icon-globe"></i> <strong>Web</strong>: www.fanadeqoman.com<br>
					  </div>
				  </div>
				</aside>
		   </div>
		   <!--Contact Form-->
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<form class="form-horizontal contactform"  method="post">
				  <fieldset>
					<div class="control-group">
					  <label for="name" class="control-label">Name <span class="required">*</span></label>
					  <div class="controls">
						<input type="text"  class="required pwid60" id="name" value="" name="name">
					  </div>
					</div>
					<div class="control-group">
					  <label for="email" class="control-label">Email <span class="required">*</span></label>
					  <div class="controls">
						<input type="email"  class="required  pwid60" id="email" value="" name="email">
					  </div>
					</div>
					<div class="control-group">
					  <label for="contact" class="control-label">Contact</label>
					  <div class="controls">
						<input type="text"  value="" class="pwid60" name="contact">
					  </div>
					</div>
					<div class="control-group">
					  <label for="message" class="control-label">Message</label>
					  <div class="controls">
						<textarea  class="required pwid60"  id="message" name="messagee"></textarea>
					  </div>
					</div>
					<div class="form-actions">
					  <input class="btn btn-blue" type="submit" value="Submit" id="submit_id">
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
</html>
