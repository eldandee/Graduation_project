 <div class="row">
   
             <div class="col-md-6">
      
     <?php  if($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }elseif($this->session->flashdata('error'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>';  
           
              
          }
           ?>  
   <h1>Moje třídy</h1>


<?php
if(count($tridy)==0) echo '<h3 style="color:red">Nemáte žádnou třídu.</h3>';
else {

    

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Název','Počet lidí ve třídě','');
$this->table->set_template($template);

foreach ($tridy  as $value) {
   
    $nazevAodkaz= '<a class="btn btn-info" href="'.base_url().'zacitrida/'.$value->idTrida.'">Vstoupit</a>';
    $this->table->add_row($value->nazev,$pocetLidi[$value->idTrida]->Pocet,  $nazevAodkaz);
 

}

echo $this->table->generate();
}
?>

<?php if($this->ion_auth_acl->has_permission('nova_trida'))
            {
          echo ' <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Založit novou třídu</button>';
            }
     ?>
     </div>
            <div class="col-md-6">
    

  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"></button>
          <h4 class="modal-title">Nová třída</h4>
        </div>
        <div class="modal-body">
 
          <div class="main-login main-center">
 	
		<?php echo form_open_multipart('MainU/novatrida');?>
		<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název třídy</label>
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" required/>
						

						</div>
						
						
		
   	      
		
		
		
		
		   <?php  if($this->ion_auth_acl->has_permission('access_admin'))
            {
		echo 	'<div class="form-group">
<label for="nazev" class="cols-sm-2 control-label">Škola</label>
	<div class="cols-sm-10">
								<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-book fa" aria-hidden="true"></i></span>
						   <select name="skola" id="skola" class="form-control" required>
						   	 <option disabled selected value> --- Vyberte školu --- </option>';
   foreach($skoly as $value)
        echo '<option value="'.$value->idSkoly.'">'.$value->nazev.'</option>';
 echo '</select>
 </div>
							</div>
						

						</div>
		
	
 
     

                  
          	     ';} 
  ?>



						</div>
        </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
			<button type="submit" class="btn btn-danger">Vytvořit</button></form>
        </div>
  </div>
       
    </div>
    </div>

  
 
</div>  <div class="col-md-6">
       <h1>Žádosti</h1>
  <?php

       
 
if(count($tridy)==0) echo '';
else {

    

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Název','Počet žádostí','');
$this->table->set_template($template);

foreach ($tridy  as $value) {
   
    $nazevAodkaz= '<a class="btn btn-info" href="'.base_url().'zadostitrida/'.$value->idTrida.'">Žádosti</a>';
    $this->table->add_row($value->nazev,  $zadosti[$value->idTrida]->pocet,$nazevAodkaz);
 

}

echo $this->table->generate();
}
  
?>  
    
</div>
</div>