 <div class="col-md-6">
<div id="page-wrapper">
<h1>Vytvoření uživatele</h1>
<p>Prosím, zadejte informace o uživateli.</p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user");?>

      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>
      
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

     
      	<div class="form-group">
      <label for="nazev" class="cols-sm-2 control-label">Škola</label>

									
						   <select name="skola" id="skola" class="form-control" required>
						   	 <option disabled selected value> --- Vyberte školu --- </option>
   <?php foreach($skoly as $value)
        echo '<option value="'.$value->idSkoly.'">'.$value->nazev.'</option>';
 ?> </select>
 </div>
      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

     

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>


      <p>	<button type="submit" class="btn btn-danger">Vytvořit uživatele</button></p>

<?php echo form_close();?>
</div></div>
