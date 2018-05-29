<div id="page-wrapper">
  <div class="row">
           
<h1>Správa skupin</h1>



  <ol class="breadcrumb">
              <li><a href="/admin/manage"><i class="icon-dashboard"></i> Práva</a></li>
              <li class="#"><i class="icon-file-alt"></i> Správa skupin</li>
              
              
             
              <div style="clear: both;"></div>
            </ol>


<?php

$template = array(
        'table_open'            => '<table class="table table-hover">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Název skupiny', '');
$this->table->set_template($template);

foreach($groups as $group)  {
 $edit ='<a href="/admin/group_permissions/'.$group->id.'">Upravit pravomoce</a>';
    
  
    $this->table->add_row($group->description,$edit);
 

}

echo $this->table->generate();

?>
</div></div></div>