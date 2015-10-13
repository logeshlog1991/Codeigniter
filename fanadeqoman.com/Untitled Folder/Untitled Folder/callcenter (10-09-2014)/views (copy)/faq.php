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
				<div class="col-lg-4 mt10 mb20 img-responsive"><a href="<?php echo WEB_URL;?>hotel"><img src="<?php echo WEB_DIR;?>public/img/logo1.png"></a></div>
				<div class="col-lg-8 mt30 mb20"><span class="pull-right contact">24545262</span> <span class="pull-right mt5"><img src="<?php echo WEB_DIR;?>public/img/icon/phone.png"></span>
			</div>
			</div>
			<div class="clearfix"></div>
			<div class="container">
				<div class="row mt10">    
					<div class="well pw100 lightbg lgray mb10"><h3 class="margin-none">Frequently Asked Questions</h3></div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt10"> 
							<div id="faq" class="mt15r ">
								<ul>
									<li>
									<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> What is lorem Ipsum ?</a>
									<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>  </div>
									</li>
									<li>
									<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> What is lorem Ipsum ?</a>
									<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>  </div>
									</li>
									<li>
									<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> What is lorem Ipsum ?</a>
									<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>  </div>
									</li>
									<li>
									<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> What is lorem Ipsum ?</a>
									<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>  </div>
									</li>
									<li>
									<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> What is lorem Ipsum ?</a>
									<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>  </div>
									</li>
									 <li>
									<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> What is lorem Ipsum ?</a>
									<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>  </div>
									</li>
								</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div><!-- row mt10 end-->
			</div><!-- container-->
			<div class="clearfix"></div>
			<!-- footer-->
			<?php $this->load->view('footer'); ?>
			<!-- footer end-->
		</div><!-- end of wrapper-->
		<script src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
		<script>	
			$(document).ready(function(){
				var $acdata1 = $('.accrodian-data-faq'),
					$acclick1 = $('.accrodian-trigger-faq');
				$acdata1.hide();
				$acclick1.first().addClass('active').next().show();	
				$acclick1.on('click', function(e) {
					if( $(this).next().is(':hidden') ) {
						$acclick1.removeClass('active').next().slideUp(300);
						$(this).toggleClass('active').next().slideDown(300);
					}
					e.preventDefault();
				});
			});
		</script>
	</body>
	<style>
		td,th{ border-right:1px solid #ddd;}
		.lightbg{ background-color:#f5f5f5}
   </style>
</html>
