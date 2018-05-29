
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
    <h1>Informace o škole</h1>
     <ol class="breadcrumb">
              <li><a href="/admin/skoly"><i class="icon-dashboard"></i> Školy</a></li>
              <li class="active"><i class="icon-file-alt"></i> Informace o škole</li>
             
               <?php if($ucitele!=null) echo '<button class="btn btn-primary" type="button" style="float:right;" data-toggle="modal" data-target="#myModal2">Nová třída</button>'; ?>
              <div style="clear: both;"></div>
            </ol>
<?php
if(count($tridy)==0) 
{
    echo ' <div class="alert alert-danger" role="alert"><h2>Na této škole se nenachází žádná třída</h2>';
    if($ucitele==null) echo "<h2>Pro novou třídu je potřeba učitel !</h2>";
    
    echo '</div>'; 
}else{
    

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Název', 'Učitel','');
$this->table->set_template($template);

foreach ($tridy  as $value) {
    
    $majitel = $value->first_name.' '.$value->last_name;
   
  
       $uprava= '<a href="/upravitTrida/'.$value->idTrida.'"><button type="button"  class="btn btn-primary">Upravit</button></a>';
       $smazat= '<a href="/smazatTrida/'.$value->idTrida.'"><button type="button"  class="btn btn-danger">Smazat</button></a>';
   
    $this->table->add_row($value->nazev,$majitel,$uprava.' '.$smazat);
 

}

echo $this->table->generate();
}
?>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nová třída</h4>
        </div>
        <div class="modal-body">
 
          <div class="main-login main-center">
 	
		<?php echo form_open_multipart('Admin/novatrida');?>
		<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název třídy</label>
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" required/>
						

						</div>
						<div class="form-group">
<label for="majitel" class="cols-sm-2 control-label">Učitel</label>
							
							
						   <select name="majitel" id="majitel" class="form-control" >
   <?php
   
   foreach($ucitele as $key=>$value)
   {
       echo '<option value="'.  $value[0]->id.'">'.  $value[0]->first_name.' '.  $value[0]->last_name.'</option>';
   
   }

 
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