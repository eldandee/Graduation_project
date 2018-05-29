<?php
class TestModel extends CI_Model
{
    protected $idTestu;
    function nacteniOtazek($id)
    {
        if($this->session->userdata("user_id")!=null)
   { $trida=$this->myclass($this->session->userdata("user_id"));
    
      $limit=$this->limitProTridu($trida->idTrida,$id);
   }
        $this->db->select('c.idOtazka,c.Otazka');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Otazka c', 'c.idOtazka=b.Otazka_idOtazka', 'left');
       
       
        if(isset($limit->pocetOt))  $this->db->limit($limit->pocetOt);
      
       
      
        $this->db->where('idTest', $id);
        $this->db->group_by('Otazka');
        $this->db->order_by('rand()');
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
     function nacteniOtazekStat($id)
    {
     
        $this->db->select('c.idOtazka,c.Otazka');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Otazka c', 'c.idOtazka=b.Otazka_idOtazka', 'left');
       
       
    
      
       
      
        $this->db->where('idTest', $id);
        $this->db->group_by('Otazka');
        
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    
    
     function myclass($idUzivatele)
    {
      
            $this->db->select('c.nazev,c.idTrida');
            $this->db->from('users m'); 
            $this->db->join('Users_has_Trida b', 'b.users_id=m.id', 'left');
            $this->db->join('Trida c', 'c.idTrida=b.Trida_idTrida', 'left');
            $this->db->where('m.id',$idUzivatele);
       
         
             $query = $this->db->get();
        $profil = $query->row();
        return $profil;
    }
    function otazkyVyhodnoceni($id)
    {

        $this->db->select('Otazka_idOtazka,Odpoved_idOdpovedi');  
        $this->db->from('OdpovedTest o');
        $this->db->where('udelanyTest_idudelanyTest', $id);
        $this->db->order_by('Otazka_idOtazka');
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    
    function kontrolaTest($idOT,$idTE)
    {

        $this->db->select('*');  
        $this->db->from('Otazka_has_Test');
        $this->db->where('Otazka_idOtazka', $idOT);
        $this->db->where('Test_idTest', $idTE);
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
      function limitProTridu($idTrida,$idTest)
    {
 
        $this->db->select('o.pocetOt');  
        $this->db->from('PocetOtProDanouTridu o');
        $this->db->where('o.Trida_idTrida',$idTrida);
        $this->db->where('o.Test_idTest',$idTest);
       
      
      
        
        $query = $this->db->get();
        $otazky= $query->row();
        return $otazky;
    }
    function pocetOtazek($neco)
    {
        //kontrola počtu nezodpovězených
        $this->db->select('COUNT(c.Otazka) ot');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Otazka c', 'c.idOtazka=b.Otazka_idOtazka', 'left');
        
        $this->db->where('idTest', $neco);
     
      
        $query = $this->db->get();
        $otazky=$query->row();
        return $otazky->ot;
    }
    
    function odpovedi($otazky)
    {

        $this->db->select('idOdpovedi,Otazka_idOtazka,spravna,text');  
        $this->db->from('Odpoved');
         $this->db->where('Otazka_idOtazka', $otazky);
         $this->db->order_by('rand()');
        $query = $this->db->get();
        $odp= $query->result();
        return $odp;
    }
     function uzivatelT($id)
    {
         $this->db->select('b.id,b.first_name,b.last_name,datum,c.nazev');  
        $this->db->from('udelanyTest o');
        $this->db->join('users b', 'b.id=o.users_id', 'left');
         $this->db->join('Test c', 'c.idTest=o.Test_idTest', 'left');
        
        $this->db->where('idudelanyTest', $id);
     
        $query = $this->db->get();
        $uz= $query->row();
        return $uz;
    }
    function odpoved($odp)
    {

        $this->db->select('spravna');  
        $this->db->from('Odpoved');
         $this->db->where('idOdpovedi', $odp);
       
        $query = $this->db->get();
        $odpoved = $query->row();
        return  $odpoved;
    }
    function OdpovedV($odp)
    {

        $this->db->select('text,spravna');  
        $this->db->from('Odpoved');
         $this->db->where('idOdpovedi', $odp);
       
        $query = $this->db->get();
        $odp = $query->row();
        return $odp;
    }
    function OtazkaV($ot)
    {

        $this->db->select('*');  
        $this->db->from('Otazka');
        $this->db->where('idOtazka', $ot);
       
        $query = $this->db->get();
        $otazky = $query->row();
        return $otazky;
    }
    function novyzaznam($idTestu,$idUzivatele)
    {
               date_default_timezone_set('Europe/Berlin');  
          
             $dataN = array(
          'datum' => date("Y-m-d H:i:s"), 
          'Test_idTest' => $idTestu,
          'users_id' => $idUzivatele,
         
        );
    $this->db->insert('udelanyTest', $dataN);
        
     $this->idTestu=$this->db->insert_id();
    
        return $this->idTestu;
    }
    function odpovediTestu($otazka,$odpoved)
    {
         $dataN = array(
          'udelanyTest_idudelanyTest' => $this->idTestu,  
          'Otazka_idOtazka' => $otazka,
          'Odpoved_idOdpovedi' => $odpoved,
         
        );
          $this->db->insert('OdpovedTest', $dataN);
    }
    
      //statistiky testu
      //nazev a počet otázek přiřazených k testu
    function testyStatistika()
    {

        $this->db->select('idTest,nazev,COUNT(Otazka_idOtazka) ota, b.Otazka_idOtazka');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
         
    
        
   
        $this->db->group_by('nazev');
        $this->db->order_by('nazev');
        $query = $this->db->get();
        $test= $query->result();
        return $test;
    }
    

    function statistikaOtazky($id)
    {

        $this->db->select('b.Otazka_idOtazka,COUNT(b.Odpoved_idOdpovedi) pocet');  
        $this->db->from('udelanyTest o');
        $this->db->join('OdpovedTest b', 'b.udelanyTest_idudelanyTest=o.idudelanyTest', 'left');
       
        $this->db->where('Test_idTest', $id);
        $this->db->order_by('b.Otazka_idOtazka');
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    function statistikaOtazkyA($id)
    {

        $this->db->select('idUdelanyTest');  
        $this->db->from('udelanyTest');
       
       
        $this->db->where('Test_idTest', $id);
       
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
     function statistikaOtazkyB($id,$zaci)
    {

        $this->db->select('idUdelanyTest');  
        $this->db->from('udelanyTest');
       
         $this->db->where_in('users_id', $zaci);
        $this->db->where('Test_idTest', $id);
       
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    function nacteniOtazek2($neco)
    {

        $this->db->select('c.idOtazka,c.Otazka');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Otazka c', 'c.idOtazka=b.Otazka_idOtazka', 'left');
        
        $this->db->where('idTest', $neco);
        $this->db->group_by('Otazka');
          $this->db->order_by('rand()');
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
 
 

 
   function testovo($id)
    {
        
        $this->db->select('Otazka_idOtazka,Odpoved_idOdpovedi');  
        $this->db->from('OdpovedTest');
        $this->db->where_in('udelanyTest_idudelanyTest', $id);
        
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    function odpovediStatistika($idU,$neco)
    {
        
        $this->db->select('COUNT(Odpoved_idOdpovedi) otaz');  
        $this->db->from('OdpovedTest');
        $this->db->where_in('udelanyTest_idudelanyTest', $idU);
        $this->db->where('Odpoved_idOdpovedi', $neco);
        $query = $this->db->get();
        $odpovedi= $query->row();
       
      
        return $odpovedi->otaz;
    }
    
    function addHashToken($idTest, $token){
        $this->db->set('udelanyTest_idudelanyTest', $idTest);
        $this->db->set('tokenHash', sha1($token));
        $this->db->insert('SdileniHash');
    }
    
    function getByHashToken($token, $idTest){
        $this->db->select();
        $this->db->from('SdileniHash');
        $this->db->where('tokenHash', sha1($token));
        $this->db->where('udelanyTest_idudelanyTest', $idTest);
        $query = $this->db->get();
        return $query->row();
    }
    
     function skolaZaci($idSkoly)
    {

        $this->db->select('a.users_id');  
        $this->db->from('ZakSkola a');
        $this->db->join('users_groups b', 'b.user_id=a.users_id', 'left');
        $this->db->where('a.Skola_idSkoly', $idSkoly);
        $this->db->where('b.group_id', 2);
        $query = $this->db->get();
        $odp = $query->result();
        return $odp;
    }
     function testyList()
    {

        $this->db->select('*');  
        $this->db->from('Test');
          $this->db->where('aktivni', 0);
        
      
     
        
        $query = $this->db->get();
        $test= $query->result();
        return $test;
    }
}