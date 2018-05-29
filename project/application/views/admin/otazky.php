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
           <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Vyhledat otázku..">
           <style type="text/css">
               #myInput {
   
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 100%; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
}

           </style>
<?php

$template = array(
        'table_open'            => '<table id="myTable" class="table table-hovered">',
);

$this->table->set_heading('Otázka', 'Kategorie');
$this->table->set_template($template);

foreach ($otazky  as $value) {
 
  
      $novyT= '<a href="/editaceotazky/'.$value->idOtazka.'"><button type="button" class="btn btn-primary">Editovat</button></a>';
    $this->table->add_row($value->Otazka,$value->NazevKa,$novyT);
 

}

echo $this->table->generate();

?>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>