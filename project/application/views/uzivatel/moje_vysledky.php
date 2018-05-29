<div class="col-md-5" > 
    
    
    <?php
 
if($vysledky!=false)
{
$template = array(
        'table_open'            => '<table class="table table-hovered" >',
       
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading( 'Test','Datum','');
$this->table->set_template($template);


foreach ($vysledky as $value) {

     $cas=date("j. n. Y H:i:s", strtotime($value->datum));
    $odkaz = '<a href="/vysledek/'.$value->idudelanyTest.'" class="btn btn-info">Výsledek</a>';
 
   
  
$this->table->add_row($value->nazev,$cas,$odkaz);


}

echo $this->table->generate();

}else{
echo '<h2 style="color:red"><b>Žádné výsledky.</b></h2>';
}
?>

 <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $pagination; ?>
        </div>
    </div>       
        
        
</div>