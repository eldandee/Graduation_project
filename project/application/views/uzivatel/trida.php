
        
        <div class="row">
             <div class="col-md-6">
      
      <?php if($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?>
       
   <h1>Třídy</h1>
   <?php if($trida->nazev==null)
   {

     echo '<h3>Nemáte třídu :/</h3> ';
     if($zadosti!=null) echo 'Žádost o přijetí do třídy: '.$zadosti->nazev. '<br><a class="btn btn-danger" href="/profil/trida/zrusitzadost">Zrušit</a></h3>';
   }else
    { echo ' <h3>Moje třída '.$trida->nazev.' <a class="btn btn-danger" href="'.base_url().'profil/trida/delete">Opustit</a></h3>';}
      ?><hr>
      <h3>Všechny třídy</h3> 
   <?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Nazev', 'Učitel','');
$this->table->set_template($template);

foreach ($tridy  as $value) {
    
    $majitel = $value->first_name.' '.$value->last_name;
   
   if($trida->nazev==null && $zadosti==null) {
       
   $nazevAodkaz= '<a class="btn btn-success" href="/zadostoprijeti/'.$value->idTrida.'">Přidat se</a>';}
   
   else{
       $nazevAodkaz= '<button type="button" class="btn btn-primary onclick="location.href=/zadostoprijeti" disabled>Přidat se</button>';
      
   }
    $this->table->add_row($value->nazev,$majitel,$nazevAodkaz);
 

}

echo $this->table->generate();

?>
<h4>Můžete být jen v jedné třídě najednou! <br> A můžete mít jen jednu žádost o přijetí!</h4>
   </div>
     <div class="col-md-6">
          </div>
           </div>
           
           <script>
     
           </script>