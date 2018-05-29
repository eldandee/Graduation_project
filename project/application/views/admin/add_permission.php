<div id="page-wrapper">

	
		      <div class="col-sm-4">
<h1>Přidat oprávnění</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open();?>


						
					
						 	<div class="form-group">
								<label for="perm_key" class="cols-sm-2 control-label">Klíč</label>
							
							
								  <input class="form-control" type="text" name="perm_key" value=""  />
						
	  <?php echo form_error('perm_key'); ?>
						</div>
			
						 	<div class="form-group">
								<label for="perm_name" class="cols-sm-2 control-label">Název</label>
							
							
							 <input class="form-control" type="text" name="perm_name" value=""  />
						
 <?php echo form_error('perm_name'); ?>
						</div>				
						

<div class="form-group ">
<input type="submit" name="submit" class="btn btn-success" value="Odeslat"  />
                  <input type="submit" name="cancel" class="btn btn-danger" value="Zrušit"  />
</div>

	
					

<?php echo form_close();?>
  	
		
		
		</div>
		</div>