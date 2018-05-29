<div class="col-sm-3 col-push-5"></div>
<div class="col-sm-6 col-push-5">

    <h1>Statistika jednolitvých otázek v testu</h1>
    <p>Aktuální otázky v testu</p>
    <?php

 if(isset($statistika))
 { $celkem=0;
 $celkemS=0;
 $pocetOt=0;
 $celkemM=0;

   foreach($statistika as $key => $element){
  $template = array(
        'table_open'            => '<table class="table table-bordered">',
);

$this->table->set_heading('Odpoved', 'Pocet');
$this->table->set_template($template);
$spravne=0;
$pocet=0;

    foreach($element as $subkey => $subelement){

     $var=$subelement['otaz'];
      $pocet=$pocet+$subelement['spravne'];

        if($subelement['textaspravne']->spravna==1)
        {
         $spravne=$spravne+$subelement['spravne'];
         $this->table->add_row('<b style="color:green">'.$subelement['textaspravne']->text.'</b>',$subelement['spravne']);
        }else{
           $this->table->add_row($subelement['textaspravne']->text,$subelement['spravne']);
        }

    }
  $this->table->add_row("Nezodpovězeno",$neudelane[$key]);
echo '<h3>'.$var.'</h3>';
$celkemS=$celkemS+$spravne;

echo  '<h4>Zahrnutí odpovědí</h4>';
if($pocet!=0)
{
 $celkem=$celkem+(($spravne/($pocet))*100); 
 $celkemM=$celkemM+ ((($spravne/($pocet))*100)*$spravne);
}
if($pocet!=0)  $pocetOt++;

 echo $this->table->generate();
   } 

 echo '</div><div class="col-sm-3 col-pull-5">';

      if($celkemA!=null)         echo' <h1>Celková úspěšnost '.round(($celkemA),2).'%</h1><p>(Do celkové úspěšnosti se počítají i otázky, které byly z testu odebrány.)</p>'; 

  echo '</div>';  

}else{
 echo "<h1>Žádné data pro statistiku</h1>";
}

?>
        <style>
            table {
                border: 1px solid black;
                table-layout: fixed;
                width: 200px;
            }
            
            th,
            td {
                border: 1px solid black;
                width: 100px;
            }
        </style>