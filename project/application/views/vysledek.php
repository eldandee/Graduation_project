
<div class="col-sm-3"></div>
<?php



    $spravne=0;
    $pocet=0;
   $taby=array('success','danger','warning','primary');   
 
  
 
                foreach($vysledek["ot"] as $a)
                {
                    $pocet++;
   
                   if($a["Spravna"]==1) $spravne++;
                 
                }
        
               
                $uspesnost=(($spravne/($pocet))*100);
            
                   echo ' 
               <div class="col-sm-6">';
                echo '<h2> '.$vysledek["uzivatel"]->nazev.'</h2>';
      if($vysledek["uzivatel"]->first_name!=null)
          { 
              echo '<h2>Uživatel: '.$vysledek["uzivatel"]->first_name.' '.$vysledek["uzivatel"]->last_name.'</h2>'; }else 
         {   echo '<h2>Uživatel: Anonymní</h2>';}
            ;
            echo '<h5>Kdy: '.date("d.m.Y H:i:s", strtotime($vysledek["uzivatel"]->datum)).'</h5>';
            //echo '<input type="hidden" value="'. $vysledek.'" id="idV"/>   ';      
        
       
        if($uspesnost>=87)
        {
              echo '<div class="panel panel-'.$taby["0"].'">';
        }elseif($uspesnost>=60)
        {
            echo '<div class="panel panel-'.$taby["1"].'">';
        }elseif($uspesnost>=40)
       { echo '<div class="panel panel-'.$taby["2"].'">';
        }else{
             echo '<div class="panel panel-'.$taby["3"].'">';
                
        }
             
  echo '<div class="panel-heading">
    <h3 class="panel-title">Vaše úspěšnost je '.round($uspesnost,2).'%</h3>
  </div>
  <div class="panel-body"><b>Vaše odpovědi v testu</b><br>';
  
  foreach($vysledek["ot"] as $a)
               if($a["Spravna"]==0)
               {
                 echo $a["Otazka"].'    <font color="red">'.$a["Odpoved"].'</font><br>' ;  
               }elseif($a["Spravna"]==1)
               {
                     echo $a["Otazka"].'    <font color="green">'.$a["Odpoved"].'</font><br>'  ;  
               }else
               {
                     echo $a["Otazka"].'    <font color="brown">'.$a["Odpoved"].'</font><br>'  ;  
               }
               
  echo '</div>
</div>';

              if(isset($ran)&&$ran==0) 
        {     
               

echo '<h4>Sdílejte váš výsledek</h4>
                  	<img onclick="shareTw()" style="float:left;margin:10px" src="'.$this->config->item('sdileni_twitterlogo').'">
                  	<img onclick="shareFb()" style="float:left;margin:10px" src="'.$this->config->item('sdileni_facebooklogo').'">'; }
                  
                  	?>
                <div class="col-sm-3">
 







                </div>
      
       <script type="text/javascript">
       var id = "<?php echo $this->uri->segment(2, 0); ?>";
       var base_url = "<?php echo $this->config->item('base_url'); ?>";
        
        function shareFb(){
            $.ajax({
                type: "POST",
                url: base_url+"/Sdileni/genShareUrlFb",
                data: {'id':id},
                success:function(data){
                    window.location.replace(data);
                }
              
            });
        }
        
        function shareTw(){
             $.ajax({
                type: "POST",
                url: base_url+"/Sdileni/genShareUrlTw",
                data: {'id':id},
                success:function(data){
                    window.location.replace(data);
                }
              
            });
        }
        
       </script>         
                
       

               