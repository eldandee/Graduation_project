<div class="container">
		  <div class="row">
		      <div class="col-sm-4">
<h1>Nastavení známkování testu</h1>



	<?php 
	 $last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
	echo 
	
	form_open_multipart('MainU/znamkovaniDone/'.$record_num);?>


						
					
						 	<div class="form-group">
								<label for="1" class="cols-sm-2 control-label">1 do %</label>
							
							
						 <?php if(count($znamkovani)==0)
						 {
						     echo	  '<input class="form-control" type="number" name="1" value="90" min="0" max="100" required/>';
						     }
						     else{
						        echo	  '<input class="form-control" type="number" name="1" value="'.$znamkovani[0]->Procenta.'" min="0" max="100" required/>';
						     }
						 
						 ?>
						

						</div>
			
						 	<div class="form-group">
								<label for="2" class="cols-sm-2 control-label">2 do %</label>
							
							
								 <?php if(count($znamkovani)==0)
						 {
						     echo	  '<input class="form-control" type="number" name="2" value="70" min="0" max="100" required/>';
						     }
						     else{
						          echo	  '<input class="form-control" type="number" name="2" value="'.$znamkovani[1]->Procenta.'" min="0" max="100" required/>';
						     }
						 
						 ?>
						

						</div>
						<div class="form-group">
								<label for="3" class="cols-sm-2 control-label">3 do %</label>
							
							
							 	 <?php if(count($znamkovani)==0)
						 {
						     echo	  '<input class="form-control" type="number" name="3" value="50" min="0" max="100" required/>';
						     }
						     else{
						          echo	  '<input class="form-control" type="number" name="3" value="'.$znamkovani[2]->Procenta.'" min="0" max="100" required/>';
						     }
						 
						 ?>
						

						</div>	
						<div class="form-group">
								<label for="4" class="cols-sm-2 control-label">4 do %</label>
							
							
							 	 <?php if(count($znamkovani)==0)
						 {
						     echo	  '<input class="form-control" type="number" name="4" value="30" min="0" max="100" required/>';
						     }
						     else{
						          echo	  '<input class="form-control" type="number" name="4" value="'.$znamkovani[3]->Procenta.'" min="0" max="100" required/>';
						     }
						 
						 ?>
						

						</div>	
						<div class="form-group">
							
						
						

<div class="form-group ">
<input type="submit" name="submit" class="btn btn-success" value="Odeslat"  />
<?php echo form_close();?>
<a href="/zacitrida/<?php echo $this->session->userdata('trida');?>"><button type="button" class="btn btn-primary btn-md">Zrušit</button>   </a>           
</div>

	
					


   </div>

			</div>		
		
		
		</div>