






<div id="page-wrapper">
<h1>Smazání třídy</h1>
<p>Jste si jisti že chcete třídu <?php echo $info->nazev;?> smazat?</p>

<?php echo form_open("smazatTridaHotovo/".$info->idTrida);?>

  <p>
  Ano
    <input type="radio" name="confirm" value="yes" checked="checked" />
   Ne
    <input type="radio" name="confirm" value="no" />
  </p>


  <p> <input type="submit" name="delete" class="btn btn-danger" value="Smazat"  /></p>

<?php echo form_close();?>
</div>
