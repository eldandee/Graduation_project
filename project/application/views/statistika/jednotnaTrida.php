  <div class="row">

      
       
   <h1><?php  echo $trida->nazev?></h1>
   <ul class="breadcrumb">
  <li><a href="/statistikaSkol">Všechny školy</a></li>
  <li><a href="/statistikaSkol/<?php echo $skola->Skola_idSkola ?>"><?php  echo $skola->nazev ?></a></li>
  <li class="active"><?php echo $trida->nazev?></li>
 
</ul>

 
   <?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Test', 'Průměrný výsledek v procentech');
$this->table->set_template($template);

foreach ($testy  as $value) {
 
if(is_numeric($statistika[$value->idTest]))
{
    
    $procenta=round($statistika[$value->idTest],2);
    
    $progres='  '.$procenta.'%<div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="'.$procenta.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$procenta.'%">
     
    </div> </div>
  ';

}else{
   $progres="Žádné výsledeky";
}
 $this->table->add_row($value->nazev,$progres);
 

}

echo $this->table->generate();

?>

</div>
