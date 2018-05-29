<div id="page-wrapper">
<h1>Smazat oprávnění</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open();?>

<p>
  <input type="submit" name="delete" class="btn btn-success" value="Smazat"  />
                  <input type="submit" name="cancel" class="btn btn-danger" value="Zrušit"  />
</p>

<?php echo form_close();?>
</div>
