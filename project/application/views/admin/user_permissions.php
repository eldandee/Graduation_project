<div id="page-wrapper">
<h1>Správa práv uživatele</h1>


   <ol class="breadcrumb">
              <li><a href="/admin/manage"><i class="icon-dashboard"></i> Práva</a></li>
              <li><a href="/admin/users"><i class="icon-file-alt"></i> Správa uživatelů</a></li>
              <li class="/admin/manage_user"><a href="/admin/manage_user/<?php echo $user_id;?>"><i class="icon-file-alt"></i>Spravovat uživatele </a></li>
               <li class="active"><i class="icon-file-alt"></i> Správa práv uživatele</li>
             
              
               
              <div style="clear: both;"></div>
            </ol>
<?php echo form_open(); ?>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>Oprávnění</th>
            <th>Povoleno</th>
            <th>Zakázáno</th>
            <th>Zděděno ze skupiny</th>
        </tr>
    </thead>
    <tbody>
    <?php if($permissions) : ?>
        <?php foreach($permissions as $k => $v) : ?>
        <tr>
            <td><?php echo $v['name']; ?></td>
            <td><?php echo form_radio("perm_{$v['id']}", '1', set_radio("perm_{$v['id']}", '1', $this->ion_auth_acl->is_allowed($v['key'], $users_permissions))); ?></td>
            <td><?php echo form_radio("perm_{$v['id']}", '0', set_radio("perm_{$v['id']}", '0', $this->ion_auth_acl->is_denied($v['key'], $users_permissions))) ?></td>
            <td><?php echo form_radio("perm_{$v['id']}", 'X', set_radio("perm_{$v['id']}", 'X', ( $this->ion_auth_acl->is_inherited($v['key'], $users_permissions) || ! array_key_exists($v['key'], $users_permissions)) ? TRUE : FALSE)); ?> (Zděděno <?php echo ($this->ion_auth_acl->is_inherited($v['key'], $group_permissions, 'value')) ? "Povoleno" : "Zakázáno"; ?>)</td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Nejsou zde oprávnění, nelze nic zobrazit</td>
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