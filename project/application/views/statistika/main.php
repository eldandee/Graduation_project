<h1>Statistika</h1>
<h4>Vyberte test, jehož chcete vidět statistiku</h4>
<?php

$template = array(
        'table_open'            => '<table class="table">',
);


//echo heading('Seznam uzivatelu '.$addUser, 1);

$this->table->set_heading('Nazev Testu', 'Mapa');
$this->table->set_template($template);
foreach ($testy as $value) {
    
    $nazevAodkaz= '<a href="'.base_url().'statistika/'.$value->idTest.'">'.$value->nazev.'</a>';
    $this->table->add_row($nazevAodkaz,$value->Nazev);

}

echo $this->table->generate();

?>
<style type="text/css">
    table {
  border-collapse: separate;
  border-spacing: 0 5px;
}

thead th {
  background-color: #006DCC;
  color: white;
}

tbody td {
  background-color: #ffffff;
}

tr td:first-child,
tr th:first-child {
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
}

tr td:last-child,
tr th:last-child {
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}
</style>