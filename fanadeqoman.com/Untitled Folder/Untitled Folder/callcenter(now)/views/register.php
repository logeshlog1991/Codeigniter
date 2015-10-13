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
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_DIR;?>public/js/bootstrap.min.js"></script>
<script src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
</head>
<body>
<div class="wrapper">
	<?php $this->load->view('header_main'); ?>
<div class="clearfix"></div>
<div class="container">
<div class="row mt10">       
      <!-- Account Login-->
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <form class="form-horizontal form-custom" id="form_id" method="post" enctype="multipart/form-data" action="<?php echo WEB_URL;?>hotel_user/add_user" onsubmit="return formValidation()">
        <div class="well heading3 text-center bluetxt bluebg"><?php echo $this->lang->line('Your-Personal-Details'); ?></div>
           <div class="registerbox">
            <fieldset class="bggray">
              <div class="control-group mt15">
                <label class="control-label labelwid"><span class="red">*</span><?php echo $this->lang->line('fname'); ?>:</label>
                <div class="controls">
                  <input type="text" name="first_name" id="first_name" placeholder="Firstname"  class="pwid40">
                  <span style="color:red;" id="error_first_name"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"><span class="red">*</span><?php echo $this->lang->line('lname'); ?>:</label>
                <div class="controls">
                  <input type="text" name="last_name" id="last_name" placeholder="Lastname" class="pwid40">
                   <span style="color:red;" id="error_last_name"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"><span class="red">*</span><?php echo $this->lang->line('email'); ?> :</label>
                <div class="controls">
                  <input type="text" name="email" id="email" placeholder="Email"  class="pwid40" onblur="check_user()">
                   <span style="color:red;" id="error_email"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"><span class="red">*</span> <?php echo $this->lang->line('contact-number'); ?>:</label>
                <div class="controls">
                  <input type="text" name="contact" id="contact" placeholder="+ 91" class="pwid40" onblur="validation_num()">
                   <span style="color:red;" id="error_contact"></span>
                </div>
              </div>
              <div class="control-group">
                <label  class="control-label labelwid"><span class="red">*</span><?php echo $this->lang->line('Password'); ?> :</label>
                <div class="controls">
                  <input type="password"  name="password" id="password" class="pwid40">
                   <span style="color:red;" id="error_password"></span>
                </div>
              </div>
              
              <div class="control-group">
                <label  class="control-label labelwid"><span class="red">*</span><?php echo $this->lang->line('Confirm_Password'); ?>:</label>
                <div class="controls">
                  <input type="password"  name="conf_password" id="conf_password" class="pwid40">
                   <span style="color:red;" id="error_conf_password"></span>
                </div>
              </div>
              
            </fieldset>
          </div>
         </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-horizontal form-custom">
          <div class="well heading3 text-center bluetxt bluebg"><?php echo $this->lang->line('your_address'); ?></div>
          <div class="registerbox">
            <fieldset class="bggray">
              <div class="control-group mt15">
                <label class="control-label labelwid"><span class="red">*</span> <?php echo $this->lang->line('Address'); ?> :</label>
                <div class="controls">
                  <input type="text" name="address" id="address" placeholder="address" class="pwid40">
                   <span style="color:red;" id="error_address"></span>
                </div>
              </div>
             <div class="control-group">
                <label class="control-label labelwid"> <span class="red">*</span><?php echo $this->lang->line('City'); ?>:</label>
                <div class="controls">
                  <input type="text" name="city" id="city" placeholder="City" class="pwid40">
                   <span style="color:red;" id="error_city"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"> <span class="red">*</span><?php echo $this->lang->line('State'); ?>:</label>
                <div class="controls">
					  <input type="text" name="state" id="state" placeholder="State" class="pwid40">
					   <span style="color:red;" id="error_state"></span>
                  <!--<select id="select02" class="span3 pwid40">
                    <option> Select State</option>
                    <option>tamilnadu</option>
                    <option>karnataka</option>
                  </select>-->
                </div>
              </div>
              <div class="control-group">
                <label for="select01" class="control-label labelwid"> <span class="red">*</span><?php echo $this->lang->line('Country'); ?>:</label>
                <div class="controls">				
                  <select name="country" id="country" class="span3 pwid40">
                    <option value="">Select Country</option>
                      <?php if(isset($country) && $country!=''){ 
								foreach($country as $country_val) { ?>
						  <option value="<?php echo $country_val->name;?>"><?php echo $country_val->name; ?></option>
                   <?php } } ?>
                  </select>
                   <span style="color:red;" id="error_country"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"> <span class="red">*</span><?php echo $this->lang->line('Postel'); ?>:</label>
                <div class="controls">
                  <input type="text" name="postcode" id="postcode" placeholder="postal / zip code" class="pwid40" onblur="validation_num1()">
                   <span style="color:red;" id="error_postcode"></span>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label labelwid"><?php echo $this->lang->line('upload_image'); ?> :</label>
                <div class="controls">
				<input type="hidden" value="<?php echo WEB_URL; ?>" id="web_url" name="web_url">
                  <input type="file" name="image" id="image" class="pwid40">
                </div>
              </div>
              
            </fieldset>
          </div>
          </div>
          <div class=" col-lg-offset-4 pull-left"> 
              <input type="checkbox" id="isAgeSelected" value="option2" >
            
            <span><?php echo $this->lang->line('agree'); ?> <a><?php echo $this->lang->line('Privacy_Policy'); ?></a> </span></div>
          <div class="pull-left">
           &nbsp;
            <input type="Submit" class="btn btn-blue" value="<?php echo $this->lang->line('Register'); ?>">
             </form>
          </div>
       
        <div class="clearfix"></div>
      </div>
      <!-- Sidebar Start-->
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt40column">
        <aside>
        </aside>
      </div>
      <!-- Sidebar End-->       
    </div>
</div><!-- register end-->
<div class="clearfix"></div>
<!-- footer-->
 <?php $this->load->view('footer'); ?>
<!-- footer end-->
</div><!-- end of wrapper-->
</body>
<!-- script goes down-->
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jquery.js"></script>
<!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
<!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.utils.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/jssor.slider.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/validation_form.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR;?>public/js/custom.js"></script>
</html>
