<h1>Testy</h1>
        
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
if(!isset($neex))
{
$template = array(
       'table_open'            => '<table class="table table-hover">',
        
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',

        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',



        'row_start'             => '<tr style="margin-top:30px; background-color:#e8f5e9 ">',
        'row_end'               => '</tr>',

        'row_alt_start'         => '<tr style="margin-top:30px; background-color:#e8f5e9 ">',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td style="margin:bottom 30px; background-color:#e8f5e9 ">',
        'cell_alt_end'          => '</td>',

          'cell_start'            => '<td style="margin-bottom:30px; background-color:#e8f5e9 ">',
        'cell_end'              => '</td>',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);


$this->table->set_template($template);
foreach ($testy as $value) {

if($value->Aktivni==0)
{
    $mapa='Mapa: <a href="/mapy/'.$value->idMapy.'">'.$value->Nazev.' </a>';
}else{
    $mapa='Mapa '.$value->Nazev.' již není aktivní!';
}
if($value->aktivni==0)
{
    

  if($profil[$value->idTest]->odkaz==null)
                     {
                         
                    
                  $fotka= ' <img alt="User Pic" class="img-circle img-responsive" src="'.$this->config->item('default_fotografie').'" id="profile-image1"> ';
                     } 
                     else{
                       
                      $fotka=  ' <img  alt="User Pic" src="'.$profil[$value->idTest]->odkaz.'" id="profile-image1" class="img-circle img-responsive"> ';
                     }
                     
                          if($this->session->userdata("user_id")==$value->users_id||$this->ion_auth_acl->has_permission('access_admin'))
  {
     
  
    $test=' <div style="float: left;margin-top:20px;"><h2>'.$value->nazev.'<br>'.$mapa.'</h2>
     <a href="'.base_url().'testovani/'.$value->idTest.'" class="btn btn-primary btn-lg">Spustit</a>
     <a href="'.base_url().'statistika/'.$value->idTest.'" class="btn btn-info btn-lg">Statistika</a>
      <a href="'.base_url().'testy/edit/'.$value->idTest.'" class="btn btn-danger btn-lg">Editovat</a>
       <a href="'.base_url().'testy/smazat/'.$value->idTest.'" class="btn btn-warning btn-lg">Smazat</a>

    </div>
<div class="item" style="float: right;">

'.$fotka.'
<div style="color:#999;" >Autor: '.$profil[$value->idTest]->first_name.' '.$profil[$value->idTest]->last_name. '</div>
';

}
else{
  $test=' <div style="float: left;margin-top:20px;"><h2>'.$value->nazev.'<br> '.$mapa.'</h2>
     <a href="'.base_url().'testovani/'.$value->idTest.'" class="btn btn-primary btn-lg">Spustit</a>
     <a href="'.base_url().'statistika/'.$value->idTest.'" class="btn btn-info btn-lg">Statistika</a>
    
    </div>
<div class="item" style="float: right;">

'.$fotka.'
<div style="color:#999;" >Autor: '.$profil[$value->idTest]->first_name.' '.$profil[$value->idTest]->last_name. '</div>
';  
}
    $nazevAodkaz= '<div><a href="'.base_url().'testovani/'.$value->idTest.'">'.$value->nazev.'</a></div>';
    $this->table->add_row($test);
}
}

echo $this->table->generate();
}else{
     echo ' <div class="alert alert-danger" role="alert"><h2>Žádné testy dané kategorie!</h2></div>';
}
?>
<style type="text/css">
 table {
     border-collapse: separate;
    border-spacing: 0 1em;
}

div.item {
    vertical-align: top;
    display: inline-block;
    text-align: center;
    width: 120px;
}

.caption {
    display: block;
}

.alignleft {
	float: left;
}
.alignright {
	float: right;
}
#profile-image1 {
    cursor: pointer;
  
     width: 100px;
    height: 100px;
	border:2px solid #03b1ce ;}
		.tital{ font-size:16px; font-weight:500;}
	 .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}	
</style>