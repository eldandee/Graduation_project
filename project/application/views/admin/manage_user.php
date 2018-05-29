<div id="page-wrapper">
    <div class="row">
<h1>Spravovat uživatele <strong><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></strong></h1>


   <ol class="breadcrumb">
              <li><a href="/admin/manage"><i class="icon-dashboard"></i> Práva</a></li>
              <li><a href="/admin/users"><i class="icon-file-alt"></i> Správa uživatelů</a></li>
              <li class="active"><i class="icon-file-alt"></i> Spravovat uživatele</li>
             
              
               
              <div style="clear: both;"></div>
            </ol>
   <div class="row">    

  <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"> Skupiny uživatele</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
               
                    <?php foreach($user_groups as $ug) : ?>
    <li><?php echo $ug->description; ?></li>
    <?php endforeach; ?>
                
              </div>
            </div>
          </div>
<ul>
  
</ul>
 </div>
<div class="row">
  <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"> Práva uživatele</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
               
                  <?php foreach($user_acl as $acl) : ?>
    <li><?php echo $acl['name']; ?> (<?php if($this->ion_auth_acl->has_permission($acl['key'], $user_acl)) : ?>Dovolit<?php else: ?>Odmítnout<?php endif; ?><?php if($acl['inherited']) : ?> <strong>Zděděný</strong><?php endif; ?>)</li>
    <?php endforeach; ?>
                
              </div>
            </div>
          </div>
          
          </div>
        
          <a href="/admin/user_permissions/<?php echo $user->id; ?>">  <button type="button" class="btn btn-default">Upravit uživatelské pravomoce</button></a>


</div></div>