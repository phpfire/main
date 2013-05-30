<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>PHPFirewall - System Login</title>
    
    <link href="<?php echo base_url();?>css/styles.css" rel="stylesheet" type="text/css" />
    <!--[if IE]> <link href="<?php echo base_url();?>css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/plugins.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/files/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/files/functions.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/files/login.js"></script>
</head>
<body>

<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
    	<a href="#" title="" class="logo brand">PHPFirewall</a>        
        <!-- Right top nav -->
        <div class="clear"></div>
    </div>
</div>
<!-- Top line ends -->
<script>
$(function() {
    $(".validate").validate({
    	rules: {
			input_password: "required",
            input_username: "required"		
		}
	});
});
</script>

<!-- Login wrapper begins -->
<div class="loginWrapper">
	<!-- Current user form -->
    <?php echo form_open('login', array('class'=>'validate', 'id' => 'login')); ?>
        <div class="nNote nWarning"><?php if(!strlen(validation_errors())){ ?><p>Authorisation is Required</p><?php } else { echo validation_errors(); } ?></div>
        <input id="input_username" type="text" name="username" placeholder="Your username" class="loginUsername required" />
        <input id="input_password" type="password" name="password" placeholder="Password" class="loginPassword required" />
        
        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>
</div>
<!-- Login wrapper ends -->

</body>
</html>