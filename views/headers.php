<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title><?php if(isset($title)){ echo $title; } else { echo "PHPFirewall";}?></title>
    
    <link href="<?php echo base_url();?>css/styles.css" rel="stylesheet" type="text/css" />
    <!--[if IE]> <link href="<?php echo base_url();?>css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
    
    <?php //Add any additional css files
    if(isset($css) AND is_array($css)){
        foreach($css as $f){
            echo('<link href="'.base_url().$f.'" rel="stylesheet" type="text/css" />');
        }
    }
    ?>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/plugins.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/files/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/files/functions.js"></script>
    
    <?php //Add any additional JS files.
    if(isset($js) AND is_array($js)){
        foreach($js as $f){
            echo('<script type="text/javascript" src="<?php echo base_url();?>js/files/functions.js"></script>');
        }
    }
    //Add any additional code (js/meta/etc), requiring to be in the head
    if(isset($code) AND is_array($code)){
        foreach($code as $c){
            echo $c;
        }
    }
    
    //Add flash messages JS, if any.
    if($this->session->flashdata('message') !== FALSE){
        echo('<script>
            $(document).ready(function() {
                 $.jGrowl("'.$this->session->flashdata('message').'", { position : "bottom-right" }); 
            });
        </script>');
    }
    ?>
</head>
<body>