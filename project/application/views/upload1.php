    <!-- Ověří jestli je nějaký checkbox zakliknutý -->



   <section id="about">
    <div class="container">
        <h1>GEOAUH</h1>
        
        <div class="row">
            <div class="col-sm-6">
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
    
<?php if($this->session->flashdata('error1'))
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


  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Nová mapa</button>

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
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" required/>
						

						</div>

						<div id="target" class="form-group">
							<label for="kategorie" class="cols-sm-2 control-label">Kategorie</label><br>
							
                  
                   
					<?php   $i=0;
					foreach($kategorie as $row)		
				    {	
					$i++;
					
					echo '<label class="checkbox-inline"><input class="checkbox" type="checkbox"  value="'.$row->idKategorie.'">'.$row->Nazev.'</label>';
				   if($i%3==0)
                   {
                     echo '<br>';
                   } 
				   }

?>         



						</div>

 
        <input id="userfile"  name="userfile" type="file" multiple class="file-loading"  required/>
     
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
          <button type="submit" class="btn btn-danger overeniKat"  disabled="disabled">Odeslat</button>
          
		
        </div>
      </div>
       
    </div>
    
  </div>
  </div>
  
 <div>
   <br>
       <?php if($this->session->flashdata('error1'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error1');
           

  echo '</div>';  
           }elseif($this->session->flashdata('success1'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success1');
           

  echo '</div>'; 
          }
           ?>



  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Nová Kategorie</button>

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
  
            <div class="col-sm-6">
      
           
            </div>
            
        </div>
        
    </div>
   
</section>
  



