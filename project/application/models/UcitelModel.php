<?php
class UcitelModel extends CI_Model
{
    function novakategorie($nazev)
    {
       $data = array(
          'NazevK' => $nazev,  
          'Aktivni' => '1', 
   
      
        );
        $this->db->insert('Kategorie', $data);
    }
}
