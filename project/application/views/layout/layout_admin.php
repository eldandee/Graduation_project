<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Miroslav_Janska">
  
     <title><?php echo $title ?></title>

  
  <link rel="icon" href="<?php echo $this->config->item('default_administrace_icon') ?>">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <!-- Add custom CSS here -->
    <link href="<?php echo HTTP_CSS_PATH; ?>arkadmin.css" rel="stylesheet">
    
  
      <!-- JavaScript -->
    <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
        <script src='<?php echo base_url('resources/bootstrap/js/bootstrap.min.js');?>' type="text/javascript"></script>
    

<link href=<?php echo base_url('resources/bootstrap/css/bootstrap-multiselect.css');?> rel="stylesheet" type="text/css"/>
<script src='<?php echo base_url('resources/bootstrap/js/bootstrap-multiselect.js');?>' type="text/javascript"></script>
<script src='<?php echo base_url('resources/js/fileinput.min.js');?>' type="text/javascript"></script>
<link href=<?php echo base_url('resources/css/fileinput.min.css');?> rel="stylesheet" type="text/css"/>
<link href=<?php echo base_url('resources/font/font-awesome/css/font-awesome.css');?> rel="stylesheet" type="text/css"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
    <!--  

Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>dashboard">Administrace</a>
        </div>
 <?php 
// Define a default Page

  $pg = isset($page) && $page != '' ?  $page :'dash'  ;
  
?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li <?php echo  $pg =='dashboard' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>dashboard"> Dashboard</a></li>
<li <?php echo  $pg =='prava' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/manage">Práva</a></li>              
            <li <?php echo  $pg =='uzivatele' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/uzivatele"> Uživatelé</a></li>
            <li <?php echo  $pg =='skoly' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/skoly"> Školy</a></li>
            
        
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/profil/main"><i class="fa fa-user"></i> Zpět na stránku</a></li>
               
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      
                <?php
            echo $content;
                ?>
                
      

</div><!-- /#wrapper -->
    <script src="<?php echo HTTP_JS_PATH; ?>tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>tablesorter/tables.js"></script>

  </body>
</html>