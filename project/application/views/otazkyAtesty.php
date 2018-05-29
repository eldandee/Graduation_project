


  

      
        
        <div class="row">
           
     <?php if($this->session->flashdata('error1'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error1');
           

  echo '</div>';  
           }
          elseif($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?> 
       
   <h1>Vytvoření testu</h1>


<?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Název mapy', 'Kategorie');
$this->table->set_template($template);

foreach ($kategorieProMapy  as $value) {
 
    $nazevAodkaz= '<a href="'.base_url().'mapy/'.$value->idMapy.'">'.$value->Nazev.'</a>';
      $novyT= '<a href="/testVytvoreni/'.$value->idMapy.'"><button type="button" class="btn btn-primary">Nový test</button></a>';
    $this->table->add_row($nazevAodkaz,$value->NazevKa,$novyT);
 

}

echo $this->table->generate();

?>


           
       
      
   
  <br>  



     <h3>Před vytvořením testu vytvořte otázky! (Pokud neexistují)</h3>
  <!-- Trigger the modal with a button -->
<?php  if(  $this->ion_auth_acl->has_permission('access_admin')||$this->ion_auth_acl->has_permission('test_nova_otazka') )
        echo  '<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal2">Nová otázka</button>';
?>
  <?php
                    if($this->ion_auth_acl->has_permission('access_admin'))
            {
              
        
           echo ' <a href="/vsechnyotazky"> <button type="button" class="btn btn-primary btn-lg">Všechny otázky</button></a>'  ; }
             ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nová otázka</h4>
        </div>
        <div class="modal-body">
 
          <div class="main-login main-center">
 	
		<?php echo form_open_multipart('MainU/novaotazka');?>
		<div class="form-group">
							<label for="otazka" class="cols-sm-2 control-label">Otázka</label>
							
							
									<input type="text" class="form-control" name="otazka" id="otazka" required/>
						

						</div>
								<hr>
								<div class="form-group">
<label for="nazev" class="cols-sm-2 control-label">Počet odpovědí</label>
							
							
						   <select name="pocet" id="pocet" class="form-control" onchange="pocetOtazek()" >
   <?php for ($i = 2;$i<7 ; $i++)
        echo '<option value="'.$i.'">'.$i.'</option>';
 ?> </select>
						

						</div>
		
   	      
		
		
		
		
		
		
	

<script>
$(document).ready(function() {
        $('#kategorie').multiselect({
                                                    enableFiltering: true,
                                                    filterPlaceholder: 'Hledat'
                                                });
    });
function pocetOtazek() {
    var pocet = document.getElementById("pocet").value;
    var i;
    var otazky='<div class="form-group"><label for="otazky" class="cols-sm-2 control-label">Správná Odpověd </label><input type="text" class="form-control" name="odpoved1" id="odpoved1" required/>	</div>';
    for(i = 2; i <= pocet; i++)
    {
  
     otazky +='<div class="form-group"><label for="otazky" class="cols-sm-2 control-label">Odpověď '+i+'</label><input type="text" class="form-control" name="odpoved'+i+'" id="odpoved'+i+'"/>	</div>';
}
    
    document.getElementById("tady").innerHTML = otazky;
   
   

}
 
</script>

		 <div id="tady" class="main-login main-center">
		   <div class="form-group"><label for="otazky" class="cols-sm-2 control-label">Správná Odpověd </label><input type="text" class="form-control" name="odpoved1" id="odpoved1" required/>	</div>
		   <div class="form-group"><label for="otazky" class="cols-sm-2 control-label">Odpověď 2</label><input type="text" class="form-control" name="odpoved2" id="odpoved2" required/>	</div>
		   </div>
		      <div class="form-group">
							<label for="kategorie" class="cols-sm-2 control-label">Kategorie</label><br>
						<select name="kategorie[]" id="kategorie" multiple="multiple" required >
   <?php   foreach($kategorie as $row)
        echo '<option value="'.$row->idKategorie.'">'.$row->NazevK.'</option>';
 ?> </select>
                  
          	 



						</div>
        </div>
     
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
			<button type="submit" class="btn btn-danger">Vytvořit</button></form>
        </div>
      </div>
       
    </div>
    
  </div>
  </div>
 

  
           
            
</div>




  



