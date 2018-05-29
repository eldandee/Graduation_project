<div id="page-wrapper">
<div class="row">
             


        
   <h1>Úprava třídy</h1>
  

       <ol class="breadcrumb">
              <li><a href="/admin/skoly"><i class="icon-dashboard"></i> Školy</a></li>
              <li> <a href="/admin/skola/<?php echo $skola->Skola_idSkola;?>"><i class="icon-file-alt"></i> Informace o škole</a></li>
                <li class="active"><i class="icon-file-alt"></i> Úprava třídy</li>
               <b style="float:right;"><?php echo $skola->nazev;?></b>
              <div style="clear: both;"></div>
            </ol>
            <div class="col-md-6">
    <?php echo form_open_multipart('/zmena');?>
		<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název třídy</label>
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" value='<?php echo $info->nazev;?>' required/>
						

						</div>
						
						<div class="form-group">
							<label for="majitel" class="cols-sm-2 control-label">Majitel</label><br>
						<select class="form-control" name="majitel" id="majitel" required >
   <?php   

   foreach($ucitel as $row)
  {
       $majitel = $row->first_name.' '.$row->last_name; 
       if($row->id==$info->majitel){
        echo '<option selected value="'.$row->id.'">'.$majitel.'</option>';
   }else{
        echo '<option value="'.$row->id.'">'.$majitel.'</option>';} 
   }
    

      
 ?> </select>
                  
          	 

					</div>
						

			
						
						
		
   	      
		
		
		
		
		
		
	


                  
          	 



						</div>
        </div>
     
    
        
			<button type="submit" class="btn btn-danger">Odeslat</button></form>
 
      </div>
       
    </div>
   			</div> 
    
    
    
    
    
    
    
    
   