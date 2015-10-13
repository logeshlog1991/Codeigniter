		<link href="<?php echo WEB_DIR;?>css/morris/morris.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo WEB_DIR;?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
        
         <link href="<?php echo WEB_DIR;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      
        <link href="<?php echo WEB_DIR;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
       
        <link href="<?php echo WEB_DIR;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo WEB_DIR;?>css/common.css" rel="stylesheet" type="text/css" />
        
            <a href="<?php echo WEB_URL;?>index/dashboard" class="logo">
               <img src="<?php echo WEB_DIR;?>img/logo.png"/ style="margin-left:-10px; margin-top:-4px">
            </a>
           
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
              
                <div class="navbar-right">
					  <select id="select_lan" name="select_lan" onchange="select_Language()">
							<option value="english" <?php if(!empty($_SESSION['lang'])){ if($_SESSION['lang']=='english'){ echo 'selected=selected;';} } ?>>English</option>
							<option value="arabic" <?php if(!empty($_SESSION['lang'])){ if($_SESSION['lang']=='arabic'){ echo 'selected=selected;';} } ?>>Arabic</option>
						</select>
                    <ul class="nav navbar-nav">
                       <li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
									<?php 
										$res=$this->admin_model->get_profilepic();
										if(isset($res->profile_pic) && $res->profile_pic!=''){
									?>
									<img src="<?php echo IMG_PATH;?><?php echo $res->profile_pic; ?>" class="img-circle" alt="User Image" />
									<?php	
										}else{
									?>
                                    <img src="<?php echo IMG_PATH;?>/avatar3.png" class="img-circle" alt="User Image" />
                                    <?php } ?><br/>
                                    <?php if(isset($res->firstname) && $res->firstname!=''){ echo $res->firstname; } ?>
								</li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo WEB_URL;?>index/profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo WEB_URL;?>index/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                 </div>
            </nav>
		<script>
			function select_Language()
			{
				$.ajax({
						 url: "<?php echo WEB_URL;?>"+"index/change_language",
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
   
