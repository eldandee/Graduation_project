<div id="page-wrapper">
    
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
       
   <h1>Školy</h1>
   
 <ol class="breadcrumb">
           
              
                <button type="button" class="btn btn-primary"  style="float:right;" data-toggle="modal"  data-target="#myModal2">Nová škola</button>
                
              <div style="clear: both;"></div>
            </ol>
               <?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Nazev','');
$this->table->set_template($template);


foreach ($skoly  as $value) {
    $tridy='  <a href="/admin/skola/'.$value->idSkoly.'"><button type="button" class="btn btn-primary">Informace</button></a>';
     $edit='  <a href="/admin/editskola/'.$value->idSkoly.'"><button type="button" class="btn btn-danger">Editace</button></a>';
    $this->table->add_row($value->nazev,$tridy.' '.$edit);
 

}

echo $this->table->generate();

?>

        </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nová škola</h4>
        </div>
        <div class="modal-body">
 
          <div class="main-login main-center">
 	
		<?php echo form_open_multipart('Admin/vytvoreniskoly');?>
		<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název školy</label>
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" required/>
						

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
  


