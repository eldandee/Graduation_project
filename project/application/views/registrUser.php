<div class="container">
		  <div class="row" style="margin: auto; min-width:60%;max-width: 75%;">
   
 
 
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Registrace</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
				    <?php $attributes = array(
				        'class'  => 'form-horizontal',
				        'name'	 => 'myForm',
				        'method' => 'post'
				        );
			        echo form_open('registraceConfirm', $attributes);
				    ?>
				
  
  
 <?php if(validation_errors())
 echo '  <div class="alert alert-danger" role="alert">';
 echo validation_errors(); 
  echo '</div>';
  ?>
   <?php if($this->session->flashdata('error'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>';  
           }
           ?>

				   
						
						<div class="form-group">
							<label for="firstname" class="cols-sm-2 control-label">Jméno</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Jméno" required/>
								</div>
							</div>
						</div>
 <div class="help-block with-errors"></div>
						<div class="form-group">
							<label for="lastname" class="cols-sm-2 control-label">Příjmení</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Příjmení" required/>
								</div>
							</div>
						</div>
 <div class="help-block with-errors"></div>
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="E-mail" data-error="Bruh, that email address is invalid" required>
    <div class="help-block with-errors"></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Uživatelské jméno</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Uživatelské jméno" required/>
								</div>
							</div>
						</div>
								<div class="form-group">
<label for="nazev" class="cols-sm-2 control-label">Škola</label>
	<div class="cols-sm-10">
								<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-book fa" aria-hidden="true"></i></span>
						   <select name="skola" id="skola" class="form-control" required>
						   	 <option disabled selected value> --- Vyberte školu --- </option>
   <?php foreach($skoly as $value)
        echo '<option value="'.$value->idSkoly.'">'.$value->nazev.'</option>';
 ?> </select>
 </div>
							</div>
						

						</div>
		
 <div class="help-block with-errors"></div>
						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Heslo</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Heslo" required/>
								</div>
							</div>
						</div>
 <div class="help-block with-errors"></div>
						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Heslo znovu</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Znovu heslo" required/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Zaregistrovat</button>
					 <div class="help-block with-errors"></div>
						</div>
						<div class="login-register">
				         </div>
					</form>
				</div>
				   </div>

				
				
		
		</div>

	
	