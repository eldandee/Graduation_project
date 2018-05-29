<div id="page-wrapper">
	 <div class="col-sm-4">
	<?php echo form_open_multipart('/admin/editskolahotovo/'.$skola->idSkoly);?>
		<div class="form-group">
							<label for="nazev" class="cols-sm-2 control-label">Název školy</label>
						
						
									<input type="text" class="form-control" name="nazev" id="nazev" value="<?php echo $skola->nazev ?>" required/>
						

						</div>
						
						
						<div class="form-group ">						
<input type="submit" name="submit" class="btn btn-success" value="Odeslat"  />
<?php echo form_close();?>
<a href="/admin/skoly"><button type="button" class="btn btn-danger btn-md">Zrušit</button></a>
   </div>      </div>  </div> 