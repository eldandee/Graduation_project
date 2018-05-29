<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo $title ?></title>

<meta property="og:image" content="https://cdn.pixabay.com/photo/2013/07/12/19/18/world-154527_960_720.png" />
<script src='<?php echo base_url('resources/jquery/jquery.min.js');?>' type="text/javascript"></script>

<script src='<?php echo base_url('resources/bootstrap/js/bootstrap.min.js');?>' type="text/javascript"></script>
<link href=<?php echo base_url('resources/bootstrap/css/test.css');?> rel="stylesheet" type="text/css"/>
<link rel="icon" href="<?php echo $this->config->item('default_icon') ?>">
<link href=<?php echo base_url('resources/bootstrap/css/test1.css');?> rel="stylesheet" type="text/css"/>
<link href=<?php echo base_url('resources/css/fix-nav.css');?> rel="stylesheet" type="text/css"/>
<link href=<?php echo base_url('resources/css/signin.css');?> rel="stylesheet" type="text/css"/>
<link href=<?php echo base_url('resources/bootstrap/css/bootstrap-multiselect.css');?> rel="stylesheet" type="text/css"/>
<script src='<?php echo base_url('resources/bootstrap/js/bootstrap-multiselect.js');?>' type="text/javascript"></script>

<script src='<?php echo base_url('resources/js/fileinput.min.js');?>' type="text/javascript"></script>
<link href=<?php echo base_url('resources/css/fileinput.min.css');?> rel="stylesheet" type="text/css"/>
<link href=<?php echo base_url('resources/bootstrap/css/bootstrap.min.css');?> rel="stylesheet" type="text/css"/>
<link href=<?php echo base_url('resources/font/font-awesome/css/font-awesome.css');?> rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://bootswatch.com/journal/bootstrap.min.css"> 




</head>
<body>
<nav  class="navbar navbar-default navbar-fixed-top">
     
               
        <?php 
        
        
            $this->load->view('layout/menu');
        ?>
               
                  </div>
 </nav>
    <article style="margin-top: 50px">
        <div class="container">
                <?php
            echo $content;
                ?>
                
        </div>
 </article> 
</body>
</html>