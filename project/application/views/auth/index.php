    
<div id="page-wrapper">
<h1>Správa uživatelů</h1>
<p>Níže je uveden seznam uživatelů.</p>
    <?php if($this->session->flashdata('error'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>';  
           }
          elseif($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?> 




<?php

$template = array(
        'table_open'            => '<table class="table">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Jméno', 'Příjmení','Email','Skupina','Status','');
$this->table->set_template($template);

foreach ($users as $user) {
	$skupina="";
	foreach ($user->groups as $group){
		$skupina.= anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')).'<br />';
	}

    $this->table->add_row(htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8'),htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8'),htmlspecialchars($user->email,ENT_QUOTES,'UTF-8'),$skupina,($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link')),anchor("auth/edit_user/".$user->id, 'Editovat'));
 

}

echo $this->table->generate();

?>
<ol class="breadcrumb">
            
              
             <a href="/auth/create_user"><button class="btn btn-primary" type="button" style="float:right;margin-left:10px;">Vytvořit uživatele</button></a> 
              <a href="/auth/create_group"><button class="btn btn-primary" type="button" style="float:right;">Vytvořit skupinu</button></a>
              <div style="clear: both;"></div>
            </ol>
</div>