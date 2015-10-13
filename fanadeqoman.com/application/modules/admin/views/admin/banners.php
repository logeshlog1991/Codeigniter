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
        <!-- Common Css by Nag -->
        <link href="<?php echo WEB_DIR;?>css/common.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
			
        <script>
			$(document).ready(function(){
				$(document).on("click",".delete-img",function(){
					var imageId = $(this).attr("id").replace('close','');
					var img_db=$("#img_db").val(); 
					if(img_db!='' && imageId!=''){
						var base_url=$("#web_url").val();
						$.ajax({
							 url: base_url+"index/delete_img",
							 type: 'post',
							 data:  {'img_id':imageId,'img_db':img_db,'db_id':$("#db_id").val()},
							 success: function(output) {
								location.reload(); 
							}
						});
					}
				});
			});
		</script>
       <style>
			.delete-img{
				position:absolute;
				top:5px;
				right:20px;
			}
		</style>
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
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo WEB_URL; ?>index/dashboard" title="Home"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>
				<!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active" style="width: 24% !important;font-size:16px;font-family:bold:helica;"><a href="#tab_1" data-toggle="tab">Banners</a></li>
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6" style="width:100% !important;">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                </section><!-- /.content -->
                 <div class="box box-primary">
                           <form class="form-horizontal add_hotel_form" enctype="multipart/form-data" action="<?php echo WEB_URL;?>index/edit_banners/<?php echo $banners[0]->s_no; ?>" id="formid" method="post">
                               <fieldset><br><br/>
								  <input type="hidden" id="web_url" name="web_url" value="<?php echo WEB_URL; ?>">
								  <input type="hidden" id="db_id" name="db_id" value="<?php echo $banners[0]->s_no; ?>">
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput">Banners</label>  
								  <div class="col-xs-12 col-md-4">
										<input type="file" name="image[]" multiple id="images" > 
										<span style="color:red;" id="error_images"></span>
										<?php
											if(isset($banners[0]->banner_name) && $banners[0]->banner_name!=''){
												
											 $arr=unserialize($banners[0]->banner_name);
											 $i=0;$img_db='';
											 foreach($arr as $val){
												 $img_db=$img_db.$val.',';
												 if($val!=''){
										?>						
										
										<div class="col-xs-4">
											<img id="image<?php echo $i; ?>" class="img-responsive thumbnail" src="<?php echo IMG_PATH.$val;?>">
											<a href="javascript:void(0);"><img id="close<?php echo $val; ?>" class="delete-img" src="<?php echo IMG_PATH.'cancel-icon.png';?>"></a>
										</div>
										<?php	
												$i++;
													}
												}
											}
										?>	
										<input type="hidden" id="img_db" name="img_db" value="<?php if(isset($im) && $im!=''){ echo $im; } ?>">
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-xs-12 col-md-3 control-label" for="textinput"></label>  
									<div class="col-xs-12 col-md-4">
										  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Submit'); ?></button>
								    </div>
								</div>
								 </fieldset>
								</form>
						</div><!-- /.box -->
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
        <!-- page script -->
        <!-- validation  script -->
        <script src="<?php echo WEB_DIR;?>js/custom.js" type="text/javascript"></script>
	</body>
</html>

