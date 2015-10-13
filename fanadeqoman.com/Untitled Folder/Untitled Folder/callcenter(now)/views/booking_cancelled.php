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
			<div class=" topbar container">
				 <div class="currency"><span class="mr">USD</span><span class="mr"><img style="width:16px;" src="<?php echo WEB_DIR;?>public/img/icon/dollar.PNG"></span></div>
				 <div class="language"><span class="mr">Arabic</span><span class="mr"><img  src="<?php echo WEB_DIR;?>public/img/icon/globe.PNG"></span></div>
			</div><!-- end of container-->
			<div class="container">
				<div class="col-lg-4 mt10 mb20 img-responsive"><img src="<?php echo WEB_DIR;?>public/img/logo1.png"></div>
				<div class="col-lg-8 mt30 mb20"><span class="pull-right contact">24545262</span> <span class="pull-right mt5"><img src="<?php echo WEB_DIR;?>public/img/icon/phone.png"></span>
			</div>
			</div>
			<div class="clearfix"></div>
			<div class="container">
				<div class="timedout">
					<div class="well text-center">
						<img src="<?php echo WEB_DIR;?>public/img/sorry.png" width="100">
						<h2 style="text-shadow: 1px 2px 3px black;"><span class="red"><?php echo $this->lang->line('SORRY'); ?> !</span><?php echo $this->lang->line('Inconvenience'); ?></h2>
						<h4><?php echo $this->lang->line('Timed-Out'); ?>.</h4>
						<h4><?php echo $this->lang->line('Roomsa'); ?> . <a href="<?php echo site_url();?>/hotel" class="bluetxt"><b><?php echo $this->lang->line('Click-Here'); ?></b></a></h4>
					</div>
				</div>
			</div><!-- container-->
			<div class="clearfix"></div>
			<!-- footer-->
			<?php $this->load->view('footer'); ?>
			<!-- footer end-->
		</div><!-- end of wrapper-->
		<style>
			.timedout
			{
				background-color: #F1F1F1;
				border: 1px solid lightgray;
				border-radius: 5px;
				padding-top: 5%;
				padding-bottom: 7%;
			}
		</style>
	</body>
</html>
