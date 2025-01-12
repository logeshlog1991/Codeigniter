<?php //echo $_COOKIE["user_name"];exit; ?>
<div class="container">
		<div class="row " style=" margin:0;background:url(<?php echo WEB_DIR;?>public/img/headerbg1.jpg) repeat-x;height:35px;">
			<div class="col-lg-4"><h5><?php echo $this->lang->line('Home'); ?></h5></div>
			<div class="col-lg-5">
				<div class="pull-left">
				 <div class="register">
					<?php if(!isset($_SESSION['email'])){ ?>
					<div style="float:right">
						<a data-toggle="modal" href="#myModal">
							<span class="mr">
								<?php echo $this->lang->line('sign_in'); ?>
							</span>
						</a>
						<span class="mr"><i class="icon-signin"></i></span>
					</div>
					<div style="float:right"> 
						<a href="<?php echo site_url();?>/hotel_user/registration">
							<span class="mr">
								<?php echo $this->lang->line('Register'); ?>
							</span>
						</a>
						<span class="mr">
							<i class="icon-pencil"></i>
						</span>
					</div>
					<?php } ?>
					<?php if(isset($_SESSION['email']) && $_SESSION['email']!=''){ ?>
					<div style="float:right">
					 <nav class="subnav">
						  <div class="menurelative">
							<ul class="nav-pills mainmenucontain ">
							<li><a class="useridty"><i class="icon-user mr10"></i><?php echo $_SESSION['username']; ?></a>
								<div>
								  <ul>
								<!--	<li><a href="<?php echo WEB_URL;?>hotel_user/my_profile"><i class="icon-file-text mr10"></i>My Profile</a> </li>-->
									<li><a href="<?php echo WEB_URL;?>hotel_user/my_booking"><i class="icon-briefcase mr10"></i><?php echo $this->lang->line('My_Bookings'); ?></a> </li>
									<li><a href="<?php echo WEB_URL;?>hotel_user/sign_out"><i class="icon-signout mr10"></i><?php echo $this->lang->line('Sign_out'); ?></a> </li>
								  </ul>
								</div>
							  </li>
							</ul>
						  </div>
						</nav>
					 </div>
					 <?php } ?>
				</div>
			  </div>
			</div>
			<div class="col-lg-3">	
			    <div class="currency pull-left">
					
						<select id="select_lan" name="select_lan" onchange="select_Language()">
							<option value="english" <?php if(!empty($_SESSION['langH'])){ if($_SESSION['langH']=='english'){ echo 'selected=selected;';} } ?>>English</option>
							<option value="arabic" <?php if(!empty($_SESSION['langH'])){ if($_SESSION['langH']=='arabic'){ echo 'selected=selected;';} } ?>>Arabic</option>
						</select>
				</div>
			</div>
		</div><!-- row end-->    
	</div><!-- end of container-->
    <div class="container">
		<div class="col-lg-4 mt10 mb20 img-responsive"><a href="<?php echo site_url();?>/hotel"><img src="<?php echo WEB_DIR;?>public/img/logo1.png"></a></div>
		<div class="col-lg-8 mt30 mb20"><span class="pull-left contact">24545262</span> <span class="pull-left mt5"><i class="icon-phone-sign font24 dgray"></i></span></div>
	</div>
	<div class="clearfix"></div>
 <!-- register modal window-->
                 <section id="modals">
                 <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog">
                            <!-- signin -->
                            <div class="modal-content" style="top:150px;" id="sign_in">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">SignIn to Fanadeqoman</h4>
								</div>
								<div class="modal-body"> 
									<form class="form-horizontal form-custom" id="login_form">
										<fieldset class="bggray">
											<span style="color:#00B0F0;" id="error_log"></span>
											<div class="control-group mt15">
												<label class="control-label labelwid"><span class="red">*</span> Email :</label>
												<div class="controls">
													<input type="text" name="log_email" id="log_email" placeholder="email" value="" class="pwid40" onblur="login_validation()">
													<span style="color:red;" id="error_log_email"></span>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label labelwid"><span class="red">*</span> Password :</label>
												<div class="controls">
													<input type="password" name="log_pass" id="log_pass" placeholder="password" class="pwid40" value="" >
													<input type="hidden" name="web_url" id="web_url" value="<?php echo WEB_URL; ?>" />
												</div>
											</div>
											<!--<div class="control-group col-lg-offset-4">
												<label class="control-label labelwid"><input type="checkbox" value="1" <?php  //if(isset($_COOKIE["check"]) && $_COOKIE["check"]!=''){ echo 'checked="checked'; } ?> id="remember" name="remember" > Remember Me</label>
											</div>-->
											<div class="control-group  col-lg-offset-5 clear">
												<input type="button" class="btn btn-blue mt10 " onclick="return check_login()" value="Submit"><a class="ml15" href="#" onclick="toggle1()">Forget Password ?</a>
											</div>
										</fieldset>
									</form>
								</div>
								<div class="modal-footer"></div>
                            </div>
                            <!-- signin end-->
                            <!-- forget password-->
                            <div class="modal-content dispn" style="top:150px;" id="forget_pass">
								<div class="modal-header">
									<button type="button" id="close_button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_div()">&times;</button>
									<h4 class="modal-title">Forget Password</h4>
								</div>
								<div class="modal-body"> 
									<form class="form-horizontal form-custom" method="post" action="<?php echo WEB_URL;?>hotel_user/forgetpass" >                      
										<fieldset class="bggray">
											<span style="color:#00B0F0;" id="msg"></span>
											<div class="control-group mt15">
												<label class="control-label labelwid"><span class="red">*</span> Email :</label>
												<div class="controls">
													<input type="text" name="for_email" id="for_email" placeholder="email" class="pwid40">
													<span style="color:red;" id="error_for_email"></span>
												</div>
											</div>
											<div class="control-group  col-lg-offset-5 clear">
												<input type="button" onclick="return send_password()" class="btn btn-blue mt10 " value="Send It">
											</div>
											<div class="text-center">( please check your email for new password )</div>
										</fieldset>
									</form>
							   </div>
							   <div class="modal-footer">
                            </div>
                           </div>
                            <!-- forget pwd end-->
                     </div>
                    <!-- /.modal-dialog --> 
                  </div>
                  <!-- /.modal --> 
          <!-- register modal window end- -->
		<script>
					function select_Language()
			{
				$.ajax({
					 url: "<?php echo WEB_URL;?>"+"hotel/change_language",
					 type: 'post',
					 data:  {'lang':$("#select_lan").val()},
					 success: function(output) {
						 if(output==1){
							location.reload();
						 }
					}
				});
		   }
	  
			function close_div() {
				$('#sign_in').show();
				$('#forget_pass').hide();	
			}
 
			function toggle1() {
				$('#forget_pass').show();
					$('#sign_in').hide();
				
			}
	
			function login_validation() {
				var flag1=true;
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
					if($("#log_email").val()==''){
					$('#log_email').css('border-color', 'red');
					$("#error_log_email").html('');
					flag1=false;
				}else if(!$("#log_email").val().match(mailformat)){
					$('#log_email').css('border-color', 'red');
					$("#error_log_email").html('Email Not Valid');
					flag1=false;
				}else{
					$("#error_log_email").html('');
					$('#log_email').css('border-color', '#00B0F0');
					flag1=true;
				}
				if(flag1==false ) {
					return false;
				}	
			
			}
	
			function check_login() {
		
				flag3=true; flag4=true;
				if($("#log_email").val()==''){
					$('#log_email').css('border-color', 'red');
					flag3=false;
				}else{
					$('#log_email').css('border-color', '#00B0F0');
					flag3=true;
				}
			
				if($("#log_pass").val()==''){
					$('#log_pass').css('border-color', 'red');
					flag4=false;
				}else{
					$('#log_pass').css('border-color', '#00B0F0');
					flag4=true;
				}
				if(flag3==false ||flag4==false) {
					return false;
				}
				var log_email=$('#log_email').val();
				var log_pass=$('#log_pass').val();
				var base_url=$('#web_url').val();
				var remember=0;
				if($("#remember").is(':checked'))
				{
					remember=1;
				}
				if($("#log_email").val()!='' && $("#log_pass").val()!=''){
					$.ajax({
							type: "POST",
							url: base_url+"hotel_user/userlogin",
							data: { 'log_email':log_email,'log_pass':log_pass,'remember':remember}
						})
						.done(function( msg ){
							if(msg==1){
								window.location.href = base_url+"hotel";
							}else{
								$('#error_log').html('Your credential are wrong Please try again!');
								return false;
							}
						});
				}
			}
	
			function send_password() { 
					flag5=true;
					var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
				if($("#for_email").val()==''){
					$('#for_email').css('border-color', 'red');
					flag5=false;
				}else if(!$("#for_email").val().match(mailformat)){
					$('#for_email').css('border-color', 'red');
					$("#error_for_email").html('Email Not Valid');
					$("#for_email").val('');
					flag5=false;
				}else{
					$("#error_for_email").html('');
					$('#email').css('border-color', '#00B0F0');
					flag5=true;
				}
					
				if(flag5==false ) {
					return false;
				}
				
				var for_email=$('#for_email').val(); 
				var base_url=$('#web_url').val(); 
				if($("#for_email").val()!=''){
						$.ajax({
						type: "POST",
						url: base_url+"hotel_user/forgetpass",
						data: { 'for_email':for_email}
						})
						.done(function( msg ) {
							 
						if(msg==1){
							$('#msg').html('Your new Password is sent to your Mail-id please check');
							return false;
						} else {
								$('#msg').html('Your Email-Id is wrong Please try again!');
								return false;
							}
							 });
					}
			}
	   </script>
