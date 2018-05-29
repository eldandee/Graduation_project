
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/main">GEOAUH</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
         <?php if($this->session->userdata('username')==null){
       echo ' <li><a href="/registrace">Registrace</a></li>';}?>
        
        <li><a href="/videonavod">Návod</a></li>
        <li><a href="/faq">FAQ</a></li>
            <?php if($this->ion_auth_acl->has_permission('access_admin')||$this->ion_auth_acl->has_permission('mapa_nahrani')||$this->ion_auth_acl->has_permission('mapa_nova_kategorie'))
            {
              
        
           echo '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mapy<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/naucnemapy">Mapy</a></li>';
       
            if($this->ion_auth_acl->has_permission('mapa_nahrani')||$this->ion_auth_acl->has_permission('access_admin'))
            {
              echo '<li><a href="/admin/mapy">Nahrát mapy</a></li>';
            }elseif($this->ion_auth_acl->has_permission('mapa_nova_kategorie')){
               echo '<li><a href="/admin/mapy">Nová kategorie mapy</a></li>';
            }
            if($this->ion_auth_acl->has_permission('access_admin'))
            {
                 echo '<li><a href="/admin/neaktivnimapy">Neaktivní mapy</a></li>';
            }
           
         echo ' </ul>
        </li>'  ; }else{
          echo ' <li><a href="/naucnemapy">Mapy</a></li>';
        }
             ?>  

     <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Testy<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/testy">Všechny testy</a></li>
            <?php if($this->ion_auth_acl->has_permission('vytvorit_test')||$this->ion_auth_acl->has_permission('access_admin'))
            {
              
        
            echo '<li><a href="/novytest">Testy - Vytvoření</a></li>';    }
            $k=$this->ion_auth->kategorie();
            if($k!=null)
            {
              echo '<li role="separator" class="divider"></li> <li class="dropdown-header">Kategorie</li>';
              foreach($k as $ka)
              {
              echo '<li><a href="/testy/'.$ka->idKategorie.'">'.$ka->NazevK.'</a></li>';
              }
            }
        
           /* <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>*/
            ?>  
          </ul>
        </li>
     
       <?php
    
      
             if( $this->ion_auth->is_ucitel() )
      {
      
          echo '<li><a href="/profil/mojetridy">Moje třídy</a></li>'  ;
         
      }
       

           else  if($this->ion_auth->get_users_groups()->row()!=null)
       {       if( $this->ion_auth->get_users_groups()->row()->id==2 )
      {
      
          echo '<li><a href="/profil/trida">Moje třída</a></li>'  ;
         
      }
       }
             ?>  
             <li><a href="/statistikaSkol">Školy</a></li>
             
             <?php
                    if($this->ion_auth_acl->has_permission('access_admin'))
            {
              
        
           echo '  <li><a href="/dashboard">Administrace</a></li>'  ; }
             ?>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        
       
        <?php 
           	
            if( $this->ion_auth->is_ucitel() )
      {
         
          echo '<p class="navbar-text"><a href="/profil/mojetridy">Žádosti <span class="badge label-default">'.$this->ion_auth->zadosti($this->session->userdata('user_id')).'</span></a>  </p>';
      }
      if($this->session->userdata('username')!=null){
          	echo '<li><p class="navbar-text"><b><a href="'.base_url().'profil/main"> ';
         	$username = $this->session->userdata( 'username' ); echo $username;
         	echo '</b></a></p></li>';   
     echo '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Účet<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/profil/main">Profil</a></li>
            <li><a href="/profil/mojevysledky">Moje výsledky</a></li>
            <li><a href="/profil/zmenahesla">Změna hesla</a></li>
            <li><a href="/logout">Odhlásit se</a></li>
            
          </ul>
        </li>';
      }
         ?>
         <?php if($this->session->userdata('username')==null){
           
        

       
        
      echo  '<li class="dropdown">
        	 
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Přihlášení</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
						
                     
								 <form class="form" role="form" method="post" action="/loginDone">
										<div class="form-group">
											 	<label for="username" class="cols-sm-2 control-label">Uživatelské jméno</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Uživatelské jméno"/>
								</div>
							</div>
										</div>
										<div class="form-group">
										  <label  for="Heslo">Heslo</label>
											 	<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Heslo"/>
								</div>
                                          
										</div>
										<div class="form-group">
                    <label>
                      <?php echo form_checkbox(remember,1,FALSE);?> Pamatovat heslo 
                   
                    </label>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Přihlašte se</button>
										</div>
										
								 </form>
								  
      </div>
							</div>
								
							<div class="bottom text-center">
								Jste zde nový?<a href="/registrace"><b>Zaregistrujte se</b></a>
							</div>
					 </div>
		
			
			</ul>
        </li> '			 ;
          }?>
       <?php  
       
       if($this->session->userdata('username')!=null){
       
          echo'<p class="navbar-text navbar-right">
        
              <a id="odhlaseni" href="/logout" class="navbar-link"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
          </p>';}?>
          
      </ul>
    </div>
  </div>
