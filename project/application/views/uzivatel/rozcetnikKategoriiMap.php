
<section id="about">

    
  
    <div class="container">
      <?php

if($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?>      
  <div class="btn-group">
  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Výběr kategorie</a>
  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
  <ul class="dropdown-menu">
   <?php
   if($kategorie==null)
   {
      echo  '<li><a href="#">Žádné kategorie</a></li>';
   }else{
              foreach($kategorie as $ka)
              {
              echo '<li><a href="/naucnemapy/'.$ka->idKategorie.'">'.$ka->NazevK.'</a></li>';
              }
   }
   
   ?>
  </ul>
</div>



<?php
if($mapy!=null)
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

//$this->table->set_heading('Nazev', 'Kategorie');
$this->table->set_template($template);
foreach ($mapy as $value) {
    
    $nazevAodkaz= '<h1>'.$value->Nazev.'</h1><br><h3>Kategorie</h3>'.$value->NazevKa.'
   <br> <br> <a href="'.base_url().'mapy/'.$value->idMapy.'" class="btn btn-primary btn-lg">Zobrazit</a>
   '
    ;
    
     if($this->ion_auth_acl->has_permission('access_admin'))
            {
                $nazevAodkaz.='<a href="/deaktivaceMapy/'.$value->idMapy.'" class="btn btn-warning btn-lg">Deaktivovat</a>';
            }
              
    $this->table->add_row($nazevAodkaz);

}

echo $this->table->generate();
}else{
      echo ' <div class="alert alert-danger" role="alert"><h2>Žádné mapy dané kategorie!</h2></div>';
}
?>

</div>
<style type="text/css">
   table {
     border-collapse: separate;
    border-spacing: 0 1em;
}


</style>
</section>
