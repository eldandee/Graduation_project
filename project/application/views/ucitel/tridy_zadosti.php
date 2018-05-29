       <div class="row">
             <div class="col-md-6">
      <?php if($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?>
       
   <h1>Žádosti do <?php echo $trida->nazev ?></h1>
    <ul class="breadcrumb">
  <li><a href="/profil/mojetridy">Moje třídy</a></li>
    <li class="active">Žádosti o přijetí do třídy</li>

 
</ul>
   
   <?php
if(count($zadosti)==0) 
{
    echo ' <div class="alert alert-danger" role="alert"><h2>Žádné žádostí o přijetí :/</h2></div>';
}else{
$template = array(
        'table_open'            => '<table class="table table-hovered">',
);




$this->table->set_heading('Jméno', 'Datum žádosti','');
$this->table->set_template($template);

foreach ($zadosti  as $value) {
    $attributes = array(
				        'class'  => 'form-horizontal',
				        'name'	 => 'myForm',
				        'method' => 'post'
				        );
    


    $test = form_open('MainU/zadostiDone', $attributes).'<input name="zadost" type="hidden" value="'.$value->idZadosti.'" /><input name="trida" type="hidden" value="'.$trida->idTrida.'" /><button type="submit" class="btn btn-primary">

Přijmout</button></form>
'; 
  
    $this->table->add_row($value->first_name. ' '.$value->last_name,date("d.m.Y H:i:s", strtotime($value->datum)) ,$test);
 

}

echo $this->table->generate();
}
?>
   
   </div>
     <div class="col-md-6">
      
       
  
   
   </div>
   </div>