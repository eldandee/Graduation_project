<div class="col-md-6">
	<?php echo form_open_multipart('Admin/editaceotazkyhotovo');?>
		<div class="form-group">
							<label for="otazka" class="cols-sm-2 control-label">Otázka</label>
							
							
									<input type="text" class="form-control" name="<?php echo $otazka->idOtazka?>" id="otazka" value='<?php echo $otazka->Otazka?>' required/>
						

						</div>
								<hr>
								

<?php 
foreach($odpovedi as $value)
{
    if($value->spravna==1) {echo '<div class="form-group ">	<label for="nazev" class="cols-sm-2 control-label">Správná odpověď</label><input type="text" class="form-control" name="'.$value->idOdpovedi.'" id="otazka" value="'.$value->text.'" required/></div>    ';
}else{
    echo '<div class="form-group ">	<label for="nazev" class="cols-sm-2 control-label">Špatná odpověď</label><input type="text" class="form-control" name="'.$value->idOdpovedi.'" id="otazka" value="'.$value->text.'" required/></div>    ';
}
}
?>
	


	<div class="form-group ">						
<input type="submit" name="submit" class="btn btn-success" value="Odeslat"  />
<?php echo form_close();?>
<a href="/vsechnyotazky"><button type="button" class="btn btn-primary btn-md">Zrušit</button></a>
   </div>           		
	
						

						</div>