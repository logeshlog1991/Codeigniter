<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Console</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo WEB_DIR;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo WEB_DIR;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo WEB_DIR;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo WEB_DIR;?>css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo WEB_DIR;?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo WEB_DIR;?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo WEB_DIR;?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo WEB_DIR;?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo WEB_DIR;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
           <?php $this->load->view('header'); ?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                      <?php $this->load->view('sidebar'); ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                
                <section class="content-header">
                    <h1>
                        <?php echo $this->lang->line('dashboard'); ?>
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
               
                <section class="content">
					 <div class="row">
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>index/profile" title="Profile">
								<img height="62" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>profile.jpeg" alt=""><center><?php echo $this->lang->line('Profile'); ?></center>
							</a>
						</div>	
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>hotel/hotel_manager" title="Hotel Manager">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>hotel.jpeg" alt=""><center><?php echo $this->lang->line('Hotel_Manager'); ?></center>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>hotel/room_category" title="Room Manager">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>room_manager.png" alt=""><center><?php echo $this->lang->line('Room_Manager'); ?></center>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>hotel/amenity_list" title="Amenity">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>amenity.png" alt=""><center><?php echo $this->lang->line('Amenity_list'); ?></center>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>hotel/price_manager" title="Price Manager">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>price_tag.png" alt=""><center><?php echo $this->lang->line('Price_Manager'); ?></center>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>index/global_settings" title="Control Panel">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>Control-Panel-icon.png" alt=""><center><?php echo $this->lang->line('Control_Panel'); ?></center>
							</a>
						</div>	
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>hotel/booking_details" title="Booking Manager">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>Manager-icon.png" alt=""><center><?php echo $this->lang->line('Booking_Manager'); ?></center>
							</a>
						</div>	
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>supplier/supplier_list" title="Suppliers">
								<img height="42" width="130" class="img-responsive" src="<?php echo IMG_PATH; ?>Supplier.jpg" alt=""><center><?php echo $this->lang->line('Suppliers'); ?></center>
							</a>
						</div>	
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>users/users_list" title="Users">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>User-icon.png" alt=""><center><?php echo $this->lang->line('Users'); ?></center>
							</a>
						</div>			
						<div class="col-lg-2 col-md-4 col-xs-6 thumb">
							<a class="thumbnail" href="<?php echo WEB_URL;?>index/callcenter_agentlist" title="Call Center">
								<img height="42" width="92" class="img-responsive" src="<?php echo IMG_PATH; ?>callcenter-icon.png" alt=""><center><?php echo $this->lang->line('Call_Center'); ?></center>
							</a>
						</div>			
					</div><!-- ./col -->
				</section>
			</aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo WEB_DIR;?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo WEB_DIR;?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo WEB_DIR;?>js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo WEB_DIR;?>js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo WEB_DIR;?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo WEB_DIR;?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo WEB_DIR;?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo WEB_DIR;?>js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo WEB_DIR;?>js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo WEB_DIR;?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo WEB_DIR;?>js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/dashboard.js" type="text/javascript"></script>     
        
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>
