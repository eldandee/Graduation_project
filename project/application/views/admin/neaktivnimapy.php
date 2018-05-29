 <h1>Mapy</h1>
<?php
if(count($mapy)==0)
{
   echo ' <div class="alert alert-danger" role="alert"><h2>Žádné neaktivní mapy!</h2></div>';   
}else{
    

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Nazev', '');
$this->table->set_template($template);

foreach ($mapy  as $value) {
 
  
      $novyT= '<a href="/aktivaceMapy/'.$value->idMapy.'"><button type="button" class="btn btn-primary">Aktivovat</button></a>';
    $this->table->add_row($value->Nazev,$novyT);
 

}

echo $this->table->generate();
}
?>