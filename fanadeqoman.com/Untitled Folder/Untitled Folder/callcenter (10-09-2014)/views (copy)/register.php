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

</head>

<body>

<div class="wrapper">
<div class=" topbar container">
    
            <div class="currency"><span class="mr">USD</span><span class="mr"><img style="width:16px;" src="<?php echo WEB_DIR;?>public/img/icon/dollar.PNG"></span></div>
            <div class="language"><span class="mr">Arabic</span><span class="mr"><img  src="<?php echo WEB_DIR;?>public/img/icon/globe.PNG"></span></div>


</div><!-- end of container-->

<div class="container">

<div class="col-lg-4 mt10 mb20 img-responsive"><a href="<?php echo WEB_URL; ?>hotel"><img src="<?php echo WEB_DIR;?>public/img/logo1.png"></a></div>
<div class="col-lg-8 mt30 mb20"><span class="pull-right contact">24545262</span> <span class="pull-right mt5"><img src="<?php echo WEB_DIR;?>public/img/icon/phone.png"></span>
</div>

</div>
<div class="clearfix"></div>

<div class="container">
<div class="row mt10">       
      <!-- Account Login-->
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <form class="form-horizontal form-custom" id="form_id" method="post" enctype="multipart/form-data" action="<?php echo WEB_URL;?>hotel_user/add_user" onsubmit="return formValidation()">
        <div class="well heading3 text-center bluetxt bluebg">Your Personal Details</div>
           <div class="registerbox">
            <fieldset class="bggray">
              <div class="control-group mt15">
                <label class="control-label labelwid"><span class="red">*</span> First Name:</label>
                <div class="controls">
                  <input type="text" name="first_name" id="first_name" placeholder="Firstname"  class="pwid40">
                  <span style="color:red;" id="error_first_name"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"><span class="red">*</span> Last Name:</label>
                <div class="controls">
                  <input type="text" name="last_name" id="last_name" placeholder="Lastname" class="pwid40">
                   <span style="color:red;" id="error_last_name"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"><span class="red">*</span> Email:</label>
                <div class="controls">
                  <input type="text" name="email" id="email" placeholder="Email"  class="pwid40" onblur="check_user()">
                   <span style="color:red;" id="error_email"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"><span class="red">*</span> Contact Number:</label>
                <div class="controls">
                  <input type="text" name="contact" id="contact" placeholder="+ 91" class="pwid40" onblur="validation_num()">
                   <span style="color:red;" id="error_contact"></span>
                </div>
              </div>
              
              <div class="control-group">
                <label  class="control-label labelwid"><span class="red">*</span> Password:</label>
                <div class="controls">
                  <input type="password"  name="password" id="password" class="pwid40">
                   <span style="color:red;" id="error_password"></span>
                </div>
              </div>
              
              <div class="control-group">
                <label  class="control-label labelwid"><span class="red">*</span>Confirm Password:</label>
                <div class="controls">
                  <input type="password"  name="conf_password" id="conf_password" class="pwid40">
                   <span style="color:red;" id="error_conf_password"></span>
                </div>
              </div>
              
            </fieldset>
          </div>
        
          </div>
          
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-horizontal form-custom">
          
           <div class="well heading3 text-center bluetxt bluebg">Your Address for Communication</div>
         
          <div class="registerbox">
            <fieldset class="bggray">
              
              
              <div class="control-group mt15">
                <label class="control-label labelwid"><span class="red">*</span> Address :</label>
                <div class="controls">
                  <input type="text" name="address" id="address" placeholder="address" class="pwid40">
                   <span style="color:red;" id="error_address"></span>
                </div>
              </div>
             
              <div class="control-group">
                <label class="control-label labelwid"> <span class="red">*</span>City:</label>
                <div class="controls">
                  <input type="text" name="city" id="city" placeholder="City" class="pwid40">
                   <span style="color:red;" id="error_city"></span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label labelwid"> <span class="red">*</span>State:</label>
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
                <label for="select01" class="control-label labelwid"> <span class="red">*</span>Country:</label>
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
                <label class="control-label labelwid"> <span class="red">*</span>Post Code:</label>
                <div class="controls">
                  <input type="text" name="postcode" id="postcode" placeholder="postal / zip code" class="pwid40" onblur="validation_num1()">
                   <span style="color:red;" id="error_postcode"></span>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label labelwid"> Upload Image:</label>
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
            
            <span>I have read and agree to the <a  >Privacy Policy</a> </span></div>
          <div class="pull-left">
           &nbsp;
            <input type="Submit" class="btn btn-blue" value="Register">
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
