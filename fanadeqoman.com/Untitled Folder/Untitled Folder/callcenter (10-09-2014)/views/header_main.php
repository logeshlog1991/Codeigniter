<?php //echo $_COOKIE["user_name"];exit; ?>
<div class="container">
		<div class="row " style=" margin:0;background:url(<?php echo WEB_DIR;?>public/img/headerbg1.jpg) repeat-x;height:35px;">
			<div class="col-lg-5"><h5>For Hotel Booking in Oman</h5></div>
			<div class="col-lg-5">
				<div style="float:right;position:relative; top:10px;">Credit Balance :<b>	<?php $user_id=$this->session->userdata('user_id'); $credit=$this->Account_model->balance($user_id); 
				if($credit!='') { $_SESSION['balance']=$credit->credit; echo $credit->credit.'$'; } else { echo '0$'; }?></b></div>
				<div class="pull-right">
				 <div class="register">
					 
					<?php if($this->session->userdata('callcenter_logged_in')!=''){ ?>
					<div style="float:right">
					 <nav class="subnav">
						  <div class="menurelative">
							<ul class="nav-pills mainmenucontain ">
							<li><a class="useridty"><i class="icon-user mr10"></i><?php echo $this->session->userdata('username'); ?></a>
								<div>
								  <ul>
								<!--	<li><a href="<?php echo WEB_URL;?>hotel_user/my_profile"><i class="icon-file-text mr10"></i>My Profile</a> </li>-->
									<li><a href="<?php echo WEB_URL;?>hotel_user/my_booking"><i class="icon-briefcase mr10"></i>My Bookings</a> </li>
									<li><a href="<?php echo WEB_URL;?>index/logout"><i class="icon-signout mr10"></i>Sign out</a> </li>
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
			<div class="col-lg-2">	<div class="currency pull-left"><select id="select_lan" name="select_lan" onchange="select_Language()">
							<option value="english" <?php if(!empty($_SESSION['lang'])){ if($_SESSION['lang']=='english'){ echo 'selected=selected;';} } ?>>English</option>
							<option value="arabic" <?php if(!empty($_SESSION['lang'])){ if($_SESSION['lang']=='arabic'){ echo 'selected=selected;';} } ?>>Arabic</option>
						</select></div>
				<div class="language pull-right"><span class="mr">Arabic</span>
					<span class="mr"><img  src="<?php echo WEB_DIR;?>public/img/icon/globe.PNG"></span></div>
				
			</div>
			</div>
		</div><!-- row end-->    
	</div><!-- end of container-->
    <div class="container">
		<div class="col-lg-4 mt10 mb20 img-responsive"><a href="<?php echo site_url();?>/hotel"><img src="<?php echo WEB_DIR;?>public/img/logo1.png"></a></div>
		<div class="col-lg-8 mt30 mb20"><span class="pull-right contact">24545262</span> <span class="pull-right mt5"><i class="icon-phone-sign font24 dgray"></i></span></div>
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
									<button type="button" id="close_button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
          <!-- register modal window end-->
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

</script>
