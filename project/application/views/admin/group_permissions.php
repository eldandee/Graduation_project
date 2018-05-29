<div id="page-wrapper">
<h1>Správa oprávnění skupiny</h1>



       <ol class="breadcrumb">
              <li><a href="/admin/manage"><i class="icon-dashboard"></i> Práva</a></li>
              <li><a href="/admin/groups"><i class="icon-file-alt"></i> Správa skupin</a></li>
              <li class="active"><i class="icon-file-alt"></i> Správa oprávnění skupiny</li>
             
              
               
              <div style="clear: both;"></div>
            </ol>
   


<?php echo form_open(); ?>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>Oprávnění</th>
            <th>Povoleno</th>
            <th>Zakázáno</th>
            <th>Ignorovat</th>
        </tr>
    </thead>
    <tbody>
    <?php if($permissions) : ?>
        <?php foreach($permissions as $k => $v) : ?>
        <tr>
            <td><?php echo $v['name']; ?></td>
            <td><?php echo form_radio("perm_{$v['id']}", '1', set_radio("perm_{$v['id']}", '1', ( array_key_exists($v['key'], $group_permissions) && $group_permissions[$v['key']]['value'] === TRUE ) ? TRUE : FALSE)); ?></td>
            <td><?php echo form_radio("perm_{$v['id']}", '0', set_radio("perm_{$v['id']}", '0', ( array_key_exists($v['key'], $group_permissions) && $group_permissions[$v['key']]['value'] != TRUE ) ? TRUE : FALSE)); ?></td>
            <td><?php echo form_radio("perm_{$v['id']}", 'X', set_radio("perm_{$v['id']}", 'X', ( ! array_key_exists($v['key'], $group_permissions) ) ? TRUE : FALSE)); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">There are currently no permissions to manage, please add some permissions</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<p>
   <input type="submit" name="save" class="btn btn-success" value="Uložit"  />
                  <input type="submit" name="cancel" class="btn btn-danger" value="Zrušit"  />
</p>

<?php echo form_close(); ?>
</div>