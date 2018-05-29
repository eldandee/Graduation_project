<div class="row">
  
  <div class="col-lg-4 col-lg-offset-4">

    <h1>Přihlášení</h1>
  
      <?php 
   
      if($this->session->flashdata('message'))
          {
            echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('message');
           

  echo '</div>'; 
          }elseif($this->session->flashdata('registrace'))
            {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('registrace');
           

  echo '</div>'; 
          }
       ?>
    
 
    <?php $attributes = array(
				        'class'  => 'form-horizontal',
				        'method' => 'post',
				      
				        );
			        echo form_open('loginDone', $attributes);
				    ?>
      <div class="form-group">
        <?php echo form_label('Přihlašovací jméno','username');?>
        <?php echo form_error('username');?>
        <?php echo form_input('username','','class="form-control"');?>
      </div>
      <div class="form-group">
        <?php echo form_label('Heslo','password');?>
        
        <?php echo form_error('password');?>
        <?php echo form_password('password','','class="form-control"');?>
      </div>
   
      <?php echo form_submit('submit', 'Přihlásit se', 'class="btn btn-primary btn-lg btn-block"');?>
    <?php echo form_close();?>
  </div>
</div>