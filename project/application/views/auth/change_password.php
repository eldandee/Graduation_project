

 <div class="col-md-6">
<h1>Změna hesla</h1>
<?php if($message!=null) echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
?>

<?php echo form_open("auth/change_password");?>

      <p>
            <label for="old_password">Staré heslo:</label> <br />
            <input type="password" name="old" value="" class="form-control" id="old" required="required"  />
      </p>

      <p>
            <label for="new_password">Nové heslo (nejméně 8 znaků):</label> <br />
            <input type="password" name="new" value="" class="form-control" id="new" pattern="^.{8}.*$" required="required"  />
      </p>

      <p>
            <label for="new_password_confirm">Znovu nové heslo:</label> <br />
            <input type="password" name="new_confirm" value="" class="form-control" id="new_confirm" required="required" pattern="^.{8}.*$"  />
      </p>
    
    
      <input type="hidden" name="user_id" value="1" id="user_id"  />
    
        <p>	<button type="submit" class="btn btn-danger" value="Change">Změnit heslo</button></p>
</p>

<?php echo form_close();?>
</div>