	 <div class="col-sm-4">
	<?php echo form_open_multipart('/editacekategoriehotovo/'.$kategorie->idKategorie);?>
		<div class="form-group">
							<label for="otazka" class="cols-sm-2 control-label">Kategorie</label>
						
						
									<input type="text" class="form-control" name="kategorie" id="otazka" value="<?php echo $kategorie->NazevK ?>" required/>
						

						</div>
						
						
						<div class="form-group ">						
<input type="submit" name="submit" class="btn btn-success" value="Odeslat"  />
<?php echo form_close();?>
<a href="/admin/mapy"><button type="button" class="btn btn-primary btn-md">Zrušit</button></a>
   </div>      </div> 