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
				<div class="well pw100 lightbg lgray mb10">
					<h3 class="margin-none">أسئلة وأجوبة</h3>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12  mt10"> 
					<div id="faq" class="mt15r ">
						<ul>
							<?php  echo $res; ?>
							<!--<li>
								<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> أسئلة وأجوبة</a>
								<div class="answer accrodian-data-faq"> <p><i class="icon-share-alt"></i> أبجد هوز هو مجرد دمية النص من التنضيد والطباعة و الصناعة . وكان أبجد هوز نص في هذه الصناعة القياسية دمية من أي وقت مضى منذ 1500s ، عندما مجهول مقعدا الطابعة الطباعة من نوع و سارعت الى تقديم نوع العينة الكتاب.</p>  </div>
							</li>
							<li>
								<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> ما هو أبجد هوز ؟</a>
								<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> أبجد هوز هو مجرد دمية النص من التنضيد والطباعة و الصناعة . وكان أبجد هوز نص في هذه الصناعة القياسية دمية من أي وقت مضى منذ 1500s ، عندما مجهول مقعدا الطابعة الطباعة من نوع و سارعت الى تقديم نوع العينة الكتاب .</p>  </div>
							</li>
							<li>
								<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> ما هو أبجد هوز ؟</a>
								<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> أبجد هوز هو مجرد دمية النص من التنضيد والطباعة و الصناعة . وكان أبجد هوز نص في هذه الصناعة القياسية دمية من أي وقت مضى منذ 1500s ، عندما مجهول مقعدا الطابعة الطباعة من نوع و سارعت الى تقديم نوع العينة الكتاب .</p>  </div>
							</li>
							<li>
								<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> ما هو أبجد هوز ؟</a>
								<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> أبجد هوز هو مجرد دمية النص من التنضيد والطباعة و الصناعة . وكان أبجد هوز نص في هذه الصناعة القياسية دمية من أي وقت مضى منذ 1500s ، عندما مجهول مقعدا الطابعة الطباعة من نوع و سارعت الى تقديم نوع العينة الكتاب .</p>  </div>
							</li>
							<li>
								<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> ما هو أبجد هوز ؟</a>
								<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> أبجد هوز هو مجرد دمية النص من التنضيد والطباعة و الصناعة . وكان أبجد هوز نص في هذه الصناعة القياسية دمية من أي وقت مضى منذ 1500s ، عندما مجهول مقعدا الطابعة الطباعة من نوع و سارعت الى تقديم نوع العينة الكتاب .</p>  </div>
							</li>
							 <li>
								<a class="question accrodian-trigger-faq" >  <i class="icon-question-sign"></i> ما هو أبجد هوز ؟</a>
								<div class="answer accrodian-data-faq">  <p><i class="icon-share-alt"></i> أبجد هوز هو مجرد دمية النص من التنضيد والطباعة و الصناعة . وكان أبجد هوز نص في هذه الصناعة القياسية دمية من أي وقت مضى منذ 1500s ، عندما مجهول مقعدا الطابعة الطباعة من نوع و سارعت الى تقديم نوع العينة الكتاب .</p>  </div>
							</li>
							-->
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
	   td,th{
		    border-right:1px solid #ddd;
	   }
	   .lightbg{ 
		   background-color:#f5f5f5
	   }
      .accrodian-trigger.active:after, .togglehandle.active:after, .accrodian-trigger-faq.active:after {float: left;}
      .accrodian-trigger:after, .togglehandle:after, .accrodian-trigger-faq:after {float: left;}
   </style>
</html>
