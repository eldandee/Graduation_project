<div class="row">
      <ul class="breadcrumb">
  <li><a href="/profil/mojetridy">Moje třídy</a></li>
    <li class="active">Správa třídy</li>

 
</ul>
    <div class="col-md-6">

  <?php if($this->session->flashdata('error'))
           { echo '  <div class="alert alert-danger" role="alert">';
             echo $this->session->flashdata('error');
           

  echo '</div>';  
           }
          elseif($this->session->flashdata('success'))
          {
            echo '  <div class="alert alert-success" role="alert">';
             echo $this->session->flashdata('success');
           

  echo '</div>'; 
          }
           ?> 
        <h1>Žáci ve třídě <?php echo $trida->nazev ?></h1>

        <?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);

//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Jméno','E-mail','');
$this->table->set_template($template);

foreach ($zaci  as $value) {
     if($value->users_id==null)
   {
       echo '<h3 style="color:red">Žádný žák ve třídě! </h3>';
   }else{

   $nazevAodkaz= '<a class="btn btn-danger" href="'.base_url().'vyhodit/'.$value->id.'">Vyhodit</a>';
    $this->table->add_row($value->first_name. ' '.$value->last_name,$value->email,  $nazevAodkaz);

}
}

if($zaci[0]->users_id!=null)
{

echo $this->table->generate();
}

?>
            <?php
echo "<h1>Test</h1>";
$template = array(
        'table_open'            => '<table class="table table-hovered">',
);

//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Test','','');
$this->table->set_template($template);

foreach ($testy  as $value) {

    $nazevAodkaz= '<a class="btn btn-info" href="/vysledkyTridyTest/'.$value->idTest.'">Výsledky</a>';
    $nazevAodkaz1= '<a class="btn btn-info" href="/znamkovani/'.$value->idTest.'">Známkování</a>';
    $this->table->add_row($value->nazev , $nazevAodkaz,$nazevAodkaz1);

}

echo $this->table->generate();

?>

    </div>
    <div class="col-md-6">
        <h2>Nastavení počtu otázek</h2>
        <?php

$template = array(
        'table_open'            => '<table class="table table-hovered">',
);

//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Test','Počet Otázek','Limit','Změnit limit');
$this->table->set_template($template);

foreach ($testy  as $value) {
      $attributes = array(
				        'class'  => 'form-horizontal',
				        'name'	 => 'myForm',
				        'method' => 'post'
				        );
   if($limity[$value->idTest]==null)
   {
        $limit[$value->idTest]=  "Žádný";
   }else{

         $limit[$value->idTest]=  $limity[$value->idTest]->pocetOt;
   }
 $hel=form_open('zmenaLimitu/'.$value->idTest, $attributes).'<div>

    <div>
        <div class="input-group">
        <input type="hidden" name="max" value="'.$value->pocet.'" />
           <input type="number" min="1" max="'.$value->pocet.'"class="form-control" type="text" name="limit" />
           <input name="trida" type="hidden" value="'.$this->uri->segment(2).'" />
           <span class="input-group-addon">Odeslat</span></form>
        </div>
    </div>
</div>';
      $test = form_open('zmenaLimitu/'.$value->idTest, $attributes).'<div>
        <div class="input-group"><input type="hidden" name="max" value="'.$value->pocet.'" />
      <input class="form-control" type="number" name="limit" required><button type="submit" class="btn btn-primary">
Odeslat
</button></form>   </div>
    </div>

'; 

    $this->table->add_row($value->nazev,$value->pocet,$limit[$value->idTest],$hel);

}

echo $this->table->generate();

?>
    </div>
</div>
<script>
    $(document).ready(function() {
        var spanSubmit = $('.input-group-addon');
        spanSubmit.on('click', function() {
            $(this).closest('form').submit();
        });
    });
</script>