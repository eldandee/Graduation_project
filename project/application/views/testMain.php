
 
<div class="row">
    <div class="col-md-6">
 	<h1>Odpovězte na otázky!</h1>
 	
	<?php 

	echo form_open_multipart('/testHotovo');?>
     
      	
      	<?php 
       
      	echo '<div class="form-group">';
     
      
      	for($i=0;$i<count($otazky);$i++) 
         { 
          
 
   echo '<div class="form-group well">';
     $array=$otazky[$i]->getA();          
  	
     	echo '<h2>'. $array["otazka"].'</h2>';
        $array2=$otazky[$i]->getB();
         
       
                   foreach($array2 as $odp)
          {
           
         
             echo ' <div class="form-check "> <label class="form-check-label"><input type="radio" name="'.$array["idOtazka"].'" value='.$odp->idOdpovedi.'> '.$odp->text.' </label></div>';
              
          }
               
         
          echo '</div>';    
             
         }
   
 ?> 


	<button type="submit" id="necum" class="btn btn-primary btn-lg btn-block login-button" >Odeslat</button></form>
</div>
</div>
</div>

 
   