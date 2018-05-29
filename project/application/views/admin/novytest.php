<script src='<?php echo base_url('resources/js/multiselect.min.js');?>' type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#search').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Hledat..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Hledat..." />',
        }
    });
});

  function selectAll() 
   
    {
        selectBox = document.getElementById("search_to");
        document.getElementById("pocet").value = selectBox.options.length;
        

        for (var i = 0; i < selectBox.options.length; i++) 
        { 
             selectBox.options[i].selected = true; 
        } 

    }
</script>
<div class="row">
    
      <div class="col-xs-5">

      	<h1>Vytvoření nového testu</h1>
</div>

						</div>
<div class="row">
    
      <div class="col-xs-5">

      	<?php echo form_open_multipart('MainU/novytest');?>
		<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název testu:</label>
							
							
									<input type="text" class="form-control" name="nazev" id="nazev" required/>
						
</div>

						</div>
						<div class="col-xs-2">
      
    </div>
						 <div class="col-xs-5">
  
      <h3>Otázky z kategorie: <?php
      foreach($kat as $row)
        echo $row->NazevKa;
 ?> </h3>
						
</div>
						</div>
					
<div class="row">
    
    <div class="col-xs-5">
        
        <select name="from[]" id="search" class="form-control" size="8"multiple="multiple" >
            <?php   foreach($otazky as $row)
        echo '<option value="'.$row->idOtazka.'">'.$row->Otazka.'</option>';
 ?> 
        </select>

    </div>
    
    <div class="col-xs-2">
        <button type="button" id="search_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
        <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <button type="button" id="search_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
       
    </div>
    
    <div class="col-xs-5">
        <select name="to[]" id="search_to" class="form-control" size="8" multiple="multiple" required>
            
        </select>
        <br>
        <?php   
        echo '<h4>Autor: '.$user->first_name.' <b style="color:red">'.$user->username.'</b> '.$user->last_name.'</h4>';
 ?> 
        <div class="form-group ">
            <input type="hidden" id="pocet" name="pocet" value="0">
        
							<button type="submit" id="necum" class="btn btn-primary btn-lg btn-block login-button" onclick="selectAll();" >Vytvořit test</button></form>
					 <div class="help-block with-errors"></div>
						</div>
    </div>
</div>


