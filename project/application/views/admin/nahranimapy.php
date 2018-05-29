

 <div class="container">
  

   
       
         <div class="col-md-6">
              <?php if($this->session->flashdata('error'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>';  
           }
          elseif($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?>   
         <h1>Mapy nahrání</h1>
           
        <?php if( $this->ion_auth_acl->has_permission('access_admin')||$this->ion_auth_acl->has_permission('mapa_nahrani'))
 { 
     echo '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Nová mapa</button>';}
?>
<?php if( $this->ion_auth_acl->has_permission('access_admin')||$this->ion_auth_acl->has_permission('mapa_nova_kategorie'))
 { 
     echo ' <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">Nová kategorie</button>';}
?>
   <?php

$template = array(
        'table_open'            => '<table id="myTable" class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Kategorie map', '');
$this->table->set_template($template);

foreach ($kategorie  as $value) {
 
  
      $edit= '<a href="/editacekategorie/'.$value->idKategorie.'"><button type="button" class="btn btn-primary">Editovat</button></a>';
    $this->table->add_row($value->NazevK,$edit);
 

}

echo $this->table->generate();

?>
    </div>
            <div class="col-md-6">
  
        



  <!-- Trigger the modal with a button -->
    
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nová mapa</h4>
        </div>
        <div class="modal-body">
 
          <div class="main-login main-center">
          
		<?php echo form_open_multipart('upload/do_upload');?>
		
      	<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název Mapy</label>
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" />
						

						</div>

						<div class="form-group">
							<label for="kategorie" class="cols-sm-2 control-label">Kategorie</label><br>
						<select name="kategorie[]" id="kategorie" multiple="multiple" required >
   <?php   foreach($kategorie as $row)
        echo '<option value="'.$row->idKategorie.'">'.$row->NazevK.'</option>';
 ?> </select>
                  
          	 



						</div>

 
        <input id="userfile" name="userfile" type="file" multiple class="file-loading" required />
     
<div id="errorBlock" class="help-block"></div>
<script>
$(document).on('ready', function() {
    $("#userfile").fileinput({
        detail:false,
        showUpload:false,
        maxFilePreviewSize: 10240,
         allowedFileExtensions:['kml'],

        initialCaption: "Vyberte Mapu"
    });
});
</script>
    

        


						
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
         <button type="submit" class="btn btn-danger overeniKat">Odeslat</button></form>
          
		
        </div>
      </div>
       
    </div>
    
  </div>
  </div>
  
 <div>
   <br>



  <!-- Trigger the modal with a button -->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nová kategorie</h4>
        </div>
        <div class="modal-body">
 
          <div class="main-login main-center">
          
		<?php echo form_open_multipart('MainU/novakategorie');?>
		
      	<div class="form-group">
							<label for="nazevK" class="cols-sm-2 control-label">Název</label>
							
							
									<input type="text" class="form-control" name="nazevK" id="nazevK" required/>
						

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
  </div>
  
          
            
  
            







<script type="text/javascript">
    $(document).ready(function() {
        $('#kategorie').multiselect({
                                                    enableFiltering: true,
                                                    filterPlaceholder: 'Hledat'
                                                });
    });
</script>
  



