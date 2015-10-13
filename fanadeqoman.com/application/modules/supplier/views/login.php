<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Supplier Console</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo WEB_DIR;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo WEB_DIR;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo WEB_DIR;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="<?php echo WEB_URL;?>index/login" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email"/>
                         <span style="color:red;font-size:small;"><?php echo form_error('email') ?></span>
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                        <input type="password" name="password" class="form-control" placeholder="Password"/><br>
                        <span style="color:red;font-size:small;"><?php echo form_error('password') ?></span>
                    </div>         
                    
                    <!--<div style="margin-bottom:40px;">
                   <div style="float:left;float: left;margin: 7px 15px 7px 5px;"> <label>Language</label></div><div style="width:35%; float:left"><select class="form-control"><option>English</option><option>Arabic</option></select></div>
                    </div>-->
                     
                    <div class="form-group">
                       <!-- <input type="checkbox" name="remember_me"/> Remember me-->
                    </div>
                     <?php if(isset($fail) && $fail!=''){ ?>
						<div class="form-group" style="color:red;">Email/Password Incorrect</div>
                    <?php } ?>
                </div>
                <div class="footer">                                                               
                    <button type="submit" id="but_login" class="btn bg-olive btn-block">Sign me in</button>  
                </div>
            </form>
		</div>
		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>        
<script>
$(function(){
   $('body').keyup(function(e){
       if (e.keyCode == 13){  
       $("#but_login").click();
      }
 });
 });
</script>
    </body>
</html>
