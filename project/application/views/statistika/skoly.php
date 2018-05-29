  
        <div class="row">
          
      
       
   <h1>Statistika výsledků škol</h1>
   <ul class="breadcrumb">
  <li class="active">Všechny školy</li>
</ul>

   <?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Název školy', '');
$this->table->set_template($template);

foreach ($skoly  as $value) {
 
 $odkaz= '<a href="'.base_url().'statistikaSkol/'.$value->idSkoly.'"><button type="button" class="btn btn-primary">Statistika</button></a>';
 $this->table->add_row($value->nazev,$odkaz);
 

}

echo $this->table->generate();

?>

</div>