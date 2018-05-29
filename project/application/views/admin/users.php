<div id="page-wrapper">
<div class="row">
          
<h1>Správa pravomocí uživatelů</h1>

  <ol class="breadcrumb">
              <li><a href="/admin/manage"><i class="icon-dashboard"></i> Práva</a></li>
              <li class="#"><i class="icon-file-alt"></i> Správa uživatelů</li>
              
              
               
              <div style="clear: both;"></div>
            </ol>


<?php

$template = array(
        'table_open'            => '<table class="table table-hover">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Email', '');
$this->table->set_template($template);

foreach($users as $user)  {
 $edit ='<a href="/admin/manage_user/'.$user->id.'">Upravit pravomoce</a>';
    
  
    $this->table->add_row($user->email,$edit);
 

}

echo $this->table->generate();

?></div></div></div>