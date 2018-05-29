 <h1>Výsledky</h1>
 <ul class="breadcrumb">
      <li><a href="/profil/mojetridy">Moje třídy</a></li>
  <li><a href="/zacitrida/<?php echo $this->session->userdata('trida');?>">Správa třídy</a></li>
    <li class="active">Výsledky</li>

 
</ul>

<?php
if(isset($vys))
{

    


$template = array(
        'table_open'            => '<table class="table table-hovered">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Jméno', 'Datum','V %','Známka','');
$this->table->set_template($template);

foreach ($vys  as $value => $k) {
if($k[0]->id!=null)
{

foreach($k as $a)
{
  

    $znamka=0;
    if(count($znamkovani)==0)
    {
     
        if(round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=90) {
           
         $znamka=1;
        }
        elseif (round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=70) {
      $znamka=2;
        } elseif (round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=50) {
      $znamka=3;
        } elseif (round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=30) {
      $znamka=4;
        }else{
            $znamka=5;
        }
    }else{
    
       if(round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=$znamkovani[0]->Procenta) 
       {
           $znamka1=1;
       }
        elseif (round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=$znamkovani[1]->Procenta) {
      $znamka=2;
        } elseif (round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=$znamkovani[2]->Procenta) {
      $znamka=3;
        } elseif (round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2)>=$znamkovani[3]->Procenta) {
      $znamka=4;
        }else{
            $znamka=5;
        } 
    }
    
    $od= '<a class="btn btn-info" href="'.base_url().'vysledek/'.$a->idudelanyTest.'">Výsledek</a>';
    $this->table->add_row($a->first_name.' '.$a->last_name,date("d.m.Y H:i:s", strtotime($a->datum)),round($proc[$a->id][$a->idudelanyTest]["uspesnost"],2),$znamka,$od);
}
   // $this->table->add_row($k[$value]->first_name);$proc[$a->id]
 




}
    

    


}
    echo $this->table->generate();
}else{
    echo '<h1 style="color:red">Žádné výsledky :/</h1>';
}
?>