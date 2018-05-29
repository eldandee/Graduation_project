<?php
class UploadModel extends CI_Model
{ 
    private $icko;
    function uploadFile($nazev, $odkaz)
    {
       $data = array(
          'Nazev' => $nazev,  
          'Odkaz' => $odkaz,
      
        );
      
        

        
          $this->db->insert('Mapa', $data);   
           $this->icko = $this->db->insert_id();
        }
        
        function novaotazka($otazka)
    {
       $data = array(
          'Otazka' => $otazka,  

      
        );
      
        

        
          $this->db->insert('Otazka', $data);   
           $this->icko = $this->db->insert_id();
        }
        function novaodpoved($odpoved,$spravna)
    {
       $data = array(
          
           'Otazka_idOtazka' => $this->icko,  
            'spravna' => $spravna,  
            'text' => $odpoved,  

      
        );
      
        

        
          $this->db->insert('Odpoved', $data);   
           
        }
         function uploadKatOtazky($kategorie)
       {
    
    if($this->icko>0)
        {
          
 
           
             $dataN = array(
          'Otazka_idOtazka' => $this->icko,  
          'Kategorie_idKategorie' => (int)$kategorie,
         
        );
         $this->db->insert('Otazka_has_Kategorie', $dataN);
        }
    }
       function uploadKat($kategorie)
       {
    
    if($this->icko>0)
        {
          
 
           
             $dataN = array(
          'Mapa_idMapy' => $this->icko,  
          'Kategorie_idKategorie' => (int)$kategorie,
         
        );
         $this->db->insert('Mapa_has_Kategorie', $dataN);
        }
    }
      function NovyTest($nazev,$user)
    {
       $data = array(
          'nazev' => $nazev,  
          'users_id' => $user,  

      
        );
      
        

        
          $this->db->insert('Test', $data);   
           $this->icko = $this->db->insert_id();
        }
        function MapaIntoTest($map)
       {
    
    if($this->icko>0)
        {
          
 
           
             $dataN = array(
          'Mapa_idMapy' => (int)$map,  
          'Test_idTest' => $this->icko,
         
        );
         $this->db->insert('Mapa_has_Test', $dataN);
        }
    }
    function OtazkaIntoTest($otazka,$idTestu)
    {     if($idTestu!=null)
      {
                  $dataN = array(
          'Otazka_idOtazka' => (int)$otazka,  
          'Test_idTest' => $idTestu,
         
        );
         $this->db->insert('Otazka_has_Test', $dataN);
             
          }else{
       {
    
         if($this->icko>0)
        {
          
 
           
             $dataN = array(
          'Otazka_idOtazka' => (int)$otazka,  
          'Test_idTest' => $this->icko,
         
        );
         $this->db->insert('Otazka_has_Test', $dataN);
        }
    }
     }
    }
}

