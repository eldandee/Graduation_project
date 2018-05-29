<div id="page-wrapper">
<h1>Správa oprávnění</h1>

<?php 

if($this->session->flashdata('success'))
           { echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>';  
           } elseif($this->session->flashdata('error'))
          {
            echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>'; 
          }
           ?> 
           
          
          <ol class="breadcrumb">
              <li><a href="/admin/manage"><i class="icon-dashboard"></i> Práva</a></li>
              <li class="active"><i class="icon-file-alt"></i> Správa oprávnění</li>
              
              
                <a href="/admin/add_permission"><button class="btn btn-primary" type="button" style="float:right;">Přidat oprávnění</button></a>
              <div style="clear: both;"></div>
            </ol>

<?php

$template = array(
        'table_open'            => '<table class="table table-hover">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Klíč', 'Název','');
$this->table->set_template($template);

foreach($permissions as $permission)  {
 $edit ='  <a href="/admin/update_permission/'.$permission["id"].'">Upravit</a>';
       $delete = '     <a href="/admin/delete_permission/'.$permission["id"].'">Smazat</a>';
  
    $this->table->add_row($permission['key'],$permission['name'],$edit.' '.$delete);
 

}

echo $this->table->generate();

?>
</div>
  