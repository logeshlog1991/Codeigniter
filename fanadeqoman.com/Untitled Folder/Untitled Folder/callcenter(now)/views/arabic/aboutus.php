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
			<div class="well pw100 text-center lightbg lgray mb10"><h3 class="margin-none">تحت الإنشا</h3></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="min-height:340px;">         
					<!-- Under Construction-->
					<div class="container centeralign">
					  <h2 class="font24"> ن حاليا تحت الإنشاء </h2>
					 <p >" و كانت شعبية في 1960s مع اطلاق ورقة تحتوي على مقاطع Letraset أبجد هوز ، ومؤخرا مع برنامج النشر المكتبي مثل ألدوس PageMaker . "
" أبجد هوز هو مجرد دمية النص من الطباعة والصناعة. </p>
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
