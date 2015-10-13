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
        <!-- DATA TABLES -->
        <link href="<?php echo WEB_DIR;?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo WEB_DIR;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		 <script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
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
                         <?php echo $this->lang->line('email_manager'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>
				 <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
									<li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="javascript:void(0);"> <?php echo $this->lang->line('add_emailPage'); ?></a></li>
							    </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
					
						<!-- Main content -->
						<section class="content">
							<div class="row">
								<div class="col-xs-12">
									<div class="box">
										<div class="box-header">
											<div class="box-header" style="text-align:right;position:relative;right:12px;"><br/>
												<a class="btn btn-primary" href="<?php echo WEB_URL;?>index/emails"><b>BACK</b></a>
											</div>
											<h3 class="box-title"></h3></div>
											<div class="box-add" style="text-align:right;position:relative;right:12px;"></div><!-- /.box-header -->
										<div class="box-body table-responsive">
											<form enctype="multipart/form-data" class="form-horizontal add_hotel_form" id="formid" method="post" action="<?php echo WEB_URL; ?>index/add_emailPage_ad">
											  <!-- Form Name -->
												 <div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput">Page Name</label>  
												  <div class="col-xs-12 col-md-4">
													  <div class="input-group custom-input-group">
														<input type="text" name="page_name" placeholder="page name" id="page_name" class="form-control input-md" ><span class="input-group-addon">English</span>
														<span style="color:red;" id="error_page"></span>
														</div><br/>
													   <div class="input-group custom-input-group">
														 <input type="text" name="page_nameA" placeholder="page name" id="page_nameA" class="form-control input-md" ><span class="input-group-addon">Arabic</span>
													    <span style="color:red;" id="error_pageA"></span>
													   </div>
													</div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput">Page Content(English)</label>  
												  <div class="col-xs-12 col-md-6">
														<textarea id="content" name="editor1" placeholder="Page Content" class="form-control input-md" ></textarea>
														<span style="color:red;" id="error_pageContent"></span>
												  </div>
												</div>
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput">Page Content(Arabic)</label>  
												  <div class="col-xs-12 col-md-6">
														<textarea id="page_contentA" name="editor2" placeholder="Page Content" class="form-control input-md" ></textarea>
														<span style="color:red;" id="error_pageContentA"></span>
												  </div>
												</div>
												<input type="hidden" id="base_url" name="base_url" value="<?php echo WEB_URL;?>">
												<div class="form-group">
												  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
													<div class="col-xs-12 col-md-4">
														<input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('Submit'); ?>" onclick="add_Page()">
													</div>
												</div>
												</fieldset>
											</form>
										</div><!-- /.box-body -->
									</div><!-- /.box -->
								</div>
							</div>
						</section><!-- /.content -->
				</aside><!-- /.right-side -->
			</div><!-- ./wrapper -->
		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo WEB_DIR;?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo WEB_DIR;?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo WEB_DIR;?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- Admin App -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Admin for demo purposes -->
        <script src="<?php echo WEB_DIR;?>js/AdminLTE/demo.js" type="text/javascript"></script>
        <script src="<?php echo WEB_DIR;?>js/custom.js" type="text/javascript"></script>
        <!-- page script -->
    </body>
</html>
<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
</script>

