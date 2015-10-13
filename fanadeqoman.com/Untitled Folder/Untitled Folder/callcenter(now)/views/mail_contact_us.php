<html>
<body style="margin: 0; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;
padding: 0;
background-color:#0099CC;


font-size: 15px;
color: #8A8985;">
<div style="overflow: hidden;">
	<div style="width: 960px;height: 30px;margin: 0 auto; padding: 0px 20px;	background-color:#0099CC;width: 670px;margin: 0px auto;">
		
	</div>
	<div style=" margin: 15px auto 0; -webkit-border-top-left-radius: 10px;
-webkit-border-top-right-radius: 10px;
-moz-border-radius-topleft: 10px;
-moz-border-radius-topright: 10px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;overflow: hidden;background: url(<?php echo base_url(); ?>application/views/email/images/img04.jpg) no-repeat center bottom;background-color:#0099CC;border: 5px solid #FFF; width: 670px;">
		<div style="background-color: #FFF;
    border: 10px solid #FFF; text-align:center;"><img src="<?php echo WEB_DIR;?>public/img/logo1.png" alt="" width="220" height="120" />  
  
	</div>
</div>
<div style="overflow: hidden;
background-color:#0099CC;">
	<div style="border-bottom: 1px dashed #E7E2DC;font-size: 43px;letter-spacing: -3px;overflow: hidden;padding: 0 0 5px 50px;text-align: left; width: 630px;margin: 0px auto;background-color:#FFF"><?php echo 'Request Message From Customer'; ?></div>
	<div style="width: 680px;margin: 0px auto;background-color:#FFF">
		<div style="float: left;width: 620px;padding: 0px 40px 0px 0px;">
			<div style="overflow: hidden;padding: 0px 0px 20px 0px;padding-bottom: 20px;text-align: justify;">			
				<div style="padding: 0px 0px 5px 50px;padding-bottom: 20px;text-align: justify;">
					<span><b>Name: </b><?php echo $name; ?></span><br>
					<span><b>Ph.no: </b><?php echo $contact; ?></span><br>
					<span><b>Email-Id: </b><?php echo $email; ?></span><br>	
					<span><b>Message: </b><?php echo $message1; ?></span>		
				</div>
			</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page --> 
</div>
<div style="background: url(<?php echo base_url(); ?>application/views/email/images/img04.png) no-repeat center top;color: #E2B8C6; width: 680px;margin: 0px auto; padding-left:20px; font-size:11px">
	
</div>
<div style="height: 100px;margin: 0 auto;padding: 50px 0px 0px 0px;background: url(<?php echo base_url(); ?>application/views/email/images/img04.png) no-repeat center top;">
	<p style="margin: 0;	padding-top: 10px;
	line-height: normal;
	text-align: center;
	color: #C76485;">© 2012 Untitled Inc. All rights reserved. </p>
</div>
<!-- end #footer -->
</body>
</html>
