<section id="about">
  
          
   
 <div class="container">
	<div class="row">

      <?php if($this->session->flashdata('error1'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>'; } elseif($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?>
        
       <div class="col-md-7 ">

<div class="panel panel-default">
  <div class="panel-heading">  <h4 >Uživatelský profil</h4></div>
   <div class="panel-body">
       
    <div class="box box-info">
        
            <div class="box-body">
                     <div class="col-sm-6">
                         
                     <div  align="center"> 
                     <?php 
                     
                     if($profil->odkaz==null)
                     {
                         
                    
                    echo ' <img  data-toggle="modal" data-target="#GSCCModal" alt="User Pic" src="'.$this->config->item('default_fotografie').'" id="profile-image1" class="img-circle img-responsive"> ';
                     } 
                     else{
                       
                         echo ' <img data-toggle="modal" data-target="#GSCCModal" alt="User Pic" src="'.$profil->odkaz.'" id="profile-image1" class="img-circle img-responsive"> ';
                     }
                ?>
                <input id="profile-image-upload" class="hidden" type="file">
<div style="color:#999;" >Kliknout zde pro změnu profilového obrázku</div>
                <!--Upload Image Js And Css-->
           
              
   
                
                
                     
                     
                     </div>
              
              <br>
    
              <!-- /input-group -->
            </div>
            <div class="col-sm-6">
            <h4 style="color:#00b1b1;"><?php echo ''.$profil->first_name.' '.$profil->last_name.'' ?> </h4></span>
               <span><p><?php echo $profil->username ?></p></span>          
            </div>
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
    
              
<div class="col-sm-5 col-xs-6 tital " >Křestí jméno:</div><div class="col-sm-7 col-xs-6 "><?php echo $profil->first_name ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Příjmeni:</div><div class="col-sm-7"> <?php echo $profil->last_name ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>


<div class="col-sm-5 col-xs-6 tital " >Uživatelské jméno:</div><div class="col-sm-7"> <?php echo $profil->username ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>
<div class="col-sm-5 col-xs-6 tital " >Email:</div><div class="col-sm-7"> <?php echo $profil->email ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>
<?php 
if($profil->group_id==2&&$trida->nazev!=null)
{

echo '<div class="col-sm-5 col-xs-6 tital " >Třída:</div><div class="col-sm-7">'.$trida->nazev.'</div>
  <div class="clearfix"></div>
<div class="bot-border"></div>';
} 

if($skola!=null)
{
    

echo '<div class="col-sm-5 col-xs-6 tital " >Škola:</div><div class="col-sm-7"> '.$skola->nazev.'</div>
  <div class="clearfix"></div>
<div class="bot-border"></div>';

}
?>
<div class="col-sm-5 col-xs-6 tital " >Datum založení účtu:</div><div class="col-sm-7"><?php  echo date("d.m.Y H:i:s", $profil->created_on); ?></div>

                     


         
          </div>
        

        </div>
       
            
    </div> 
    </div>
</div>  


       <style type="text/css">
 
     .table-fixed thead {
  width: 97%;
}
.table-fixed tbody {
  height: 230px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}
    
                  input.hidden {
    position: absolute;
    left: -9999px;
}

#profile-image1 {
    cursor: pointer;
  
     width: 100px;
    height: 100px;
	border:2px solid #03b1ce ;}
	.tital{ font-size:16px; font-weight:500;}
	 .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}	
       </style>
       
       
       
       
       
       
       
       
   </div>
  
</div>
        
          
            
        </div>
        
    </div>
  

<div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" id="myModalLabel">Nový profilový obrázek</h4>
      </div>
      	<?php echo form_open_multipart('Profil/novaprofilovka');?>
      <div class="modal-body">
          <input name="id" type="hidden" value=<?php echo $profil->id;?>/>
      <input id="userfile" name="userfile" type="file" multiple class="file-loading" required />
     
<div id="errorBlock" class="help-block"></div>
<script>

$(document).on('ready', function() {
    $("#userfile").fileinput({
        detail:false,
        showUpload:false,
        maxFilePreviewSize: 10240,
        allowedFileExtensions:['jpg','png'],

        initialCaption: "Vyberte obrázek"
    });
});
</script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
        <button type="submit" class="btn btn-primary">Uložit</button></form>
      </div>
    </div>
  </div>
</div>
</section>

