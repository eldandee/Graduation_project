<div id="page-wrapper">
       <div class="col-sm-4">
<h1>Úprava oprávnění</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open();?>

<p>
    <?php echo form_label('Key:', 'perm_key');?> <br />
    <?php echo form_input('perm_key', set_value('perm_key', $permission->perm_key),'class="form-control"'); ?> <br />
    <?php echo form_error('perm_key'); ?>
</p>

<p>
    <?php echo form_label('Name:', 'perm_name');?> <br />
    <?php echo form_input('perm_name', set_value('perm_name', $permission->perm_name),'class="form-control"'); ?> <br />
    <?php echo form_error('perm_name'); ?>
</p>

<p>
<input type="submit" name="submit" class="btn btn-success" value="Odeslat"  />
                  <input type="submit" name="cancel" class="btn btn-danger" value="Zrušit"  />
</p>

<?php echo form_close();?>
</div></div>
