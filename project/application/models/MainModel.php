<?php
class MainModel extends CI_Model
{
    function kategorie()
    {
       $this->db->select('idKategorie,NazevK');  
       $this->db->from('Kategorie');
        $this->db->where('Aktivni', '1');

        $query = $this->db->get();
        $kategorie = $query->result();
        return $kategorie;
    }
    
    
    //pro editaci
    function kategorieEdit($idK)
    {
       $this->db->select('idKategorie,NazevK');  
       $this->db->from('Kategorie');
        $this->db->where('Aktivni', '1');
        $this->db->where('idKategorie', $idK);
        $query = $this->db->get();
        $kategorie = $query->row();
        return $kategorie;
    }
    
    //kontrola pro edit pokud je v db jen jednou tak půjde editace
    function kategorieEditPocet($kategorie)
    {
       $this->db->select('COUNT(idKategorie) pocet');  
       $this->db->from('Kategorie');
        $this->db->where('Aktivni', '1');
        $this->db->where('NazevK', $kategorie);
        $query = $this->db->get();
        $kategorie = $query->row();
        return $kategorie;
    }
    function skolyLoad()
    {
        
        //načtení škol pro registraci, tzn. žák si musí při registraci vybrat školu
       $this->db->select('idSkoly,nazev');  
       $this->db->from('Skola');
      

        $query = $this->db->get();
        $skoly = $query->result();
        return $skoly;
    }
    //jen daná školy
    function skolaLoad($idSkola)
    {
        
        //načtení škol pro registraci, tzn. žák si musí při registraci vybrat školu
       $this->db->select('idSkoly,nazev');  
       $this->db->from('Skola');
      $this->db->where('idSkoly', $idSkola);

        $query = $this->db->get();
        $skoly = $query->row();
        return $skoly;
    }
    //načtení školy uživatele
    function skolaUzivatele($idUzivatel)
    {
        
        //načtení škol pro registraci, tzn. žák si musí při registraci vybrat školu
       $this->db->select('*');  
       $this->db->from('ZakSkola a');
        $this->db->join('Skola b', 'b.idSkoly=a.Skola_idSkoly', 'left');
      $this->db->where('users_id', $idUzivatel);
        $query = $this->db->get();
        $skoly = $query->row();
      
        return $skoly;
    }
    function zadosti($id)
    {
       $this->db->select('*');  
       $this->db->from('Zadosti o');
     
        $this->db->where('o.Trida_idTrida', $id);

        $query = $this->db->get();
        $zadosti = $query->result();

        return $zadosti;
    }
    function zadostDone1($id)
    {
      $this->db->where('idZadosti', $id);
      $this->db->delete('Zadosti');
    }
  
     function limitDestroy($idTest,$idTrida)
    {
      $this->db->where('Trida_idTrida', $idTrida);
       $this->db->where('Test_idTest', $idTest);
      $this->db->delete('PocetOtProDanouTridu');
    }
    //při změně testu se všechny smažou
     function smazaniLimitu($idTest,$idTrida)
    {
    
       $this->db->where('Test_idTest', $idTest);
      $this->db->delete('PocetOtProDanouTridu');
    }
    //smazani otaztek k testu
     function otTestDel($id)
    {
      $this->db->where('Test_idTest', $id);
      $this->db->delete('Otazka_has_Test');
    }
    function zadostDone2($id,$trida)
    {
       $data = array(
          'users_id' => $id,  
         
           'Trida_idTrida' => $trida,
      
        );
      
        

        
          $this->db->insert('Users_has_Trida', $data);   
          
    }
    
     function smazanitridy($idTrida)
    {
    
      $this->db->where('Trida_idTrida', $idTrida);
      $this->db->delete('PocetOtProDanouTridu');
      
      $this->db->where('Trida_idTrida', $idTrida);
      $this->db->delete('ZnamkyKtestum');
      
      $this->db->where('Trida_idTrida', $idTrida);
      $this->db->delete('Users_has_Trida');
      
      $this->db->where('Trida_idTrida', $idTrida);
      $this->db->delete('Zadosti');
      
      $this->db->where('idTrida', $idTrida);
      $this->db->delete('Trida');
      
   
    }
    function  doskoly($idSkola,$idU)
    {
       $data = array(
          'users_id' => $idU,  
         
           'Skola_idSkoly' => $idSkola,
      
        );
      
        

        
          $this->db->insert('ZakSkola', $data);   
          
    }
    function zadostiDoTridy($id)
    {
        $this->db->select('*');  
        $this->db->from('Zadosti o');
        $this->db->join('users b', 'b.id=o.users_id', 'left');
        $this->db->where('o.Trida_idTrida', $id);
        $this->db->order_by('o.datum','asc'); 
        $query = $this->db->get();
        $zad = $query->result();

        return $zad;
    }
     function otazkyVTestu($id)
    {
     
        $this->db->select('Otazka_idOtazka');  
        $this->db->from('Otazka_has_Test');
     
       
    
      
       
      
        $this->db->where('Test_idTest', $id);
    
        
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    function pocetZadosti($id)
    {
       $this->db->select('COUNT(Trida_idTrida)pocet');  
       $this->db->from('Zadosti o');
      
        $this->db->where('o.Trida_idTrida', $id);

        $query = $this->db->get();
        $zad= $query->row();

        return $zad;
    }
      function zadostoprijeti($id,$trida)
      {   date_default_timezone_set('Europe/Berlin');
         $data = array(
          'users_id' => $id,  
          'datum' => date("Y-m-d H:i:s"),
           'Trida_idTrida' => $trida,
      
        );
      
        

        
          $this->db->insert('Zadosti', $data);   
          
          
      }
    function vsechnyskoly()
    {
       $this->db->select('*');  
       $this->db->from('Skola');
   

        $query = $this->db->get();
        $skola= $query->result();
        return $skola;
    }
    function zadost($id)
    {
       $this->db->select('*');  
       $this->db->from('Zadosti');
     
        $this->db->where('idZadosti', $id);

        $query = $this->db->get();
        $zadost = $query->row();

        return $zadost;
    }
    
     function novatrida($nazev, $id,$skola)
    {
       $data = array(
          'nazev' => $nazev,  
          'majitel' => $id,
          'Skola_idSkola' =>$skola
      
        );
      
        

        
          $this->db->insert('Trida', $data);   
          
        }
        
        function novaskola($nazev)
    {
       $data = array(
          'nazev' => $nazev,  
     
      
        );
      
        

        
          $this->db->insert('Skola', $data);   
          
        }
        
         function zmenatridy($idTrida,$nazev,$id)
    {
       $data = array(
          'nazev' => $nazev,  
          'majitel' => $id,
      
        );
      
        

          $this->db->where('idTrida', $idTrida);
          $this->db->update('Trida', $data);   
          
        }
           function testName($idTest,$nazev)
    {
       $data = array(
          'nazev' => $nazev,  
         
      
        );
      
        

          $this->db->where('idTest', $idTest);
          $this->db->update('Test', $data);   
          
        }
        
        //"smazání" testu, testu se dá aktivní na 1 takže se stané neaktivním, admin ho bude moci obnovit
         function testDel($idTest)
    {
       $data = array(
          'aktivni' => 1,  
         
      
        );
      
        

          $this->db->where('idTest', $idTest);
          $this->db->update('Test', $data);   
          
        }
        
            function mapaAktivaceADeaktivace($idMapa,$ak)
    {
       $data = array(
          'aktivni' => $ak,  
         
      
        );
      
        

          $this->db->where('idMapy', $idMapa);
          $this->db->update('Mapa', $data);   
          
        }
    function mapaNacteni($id)
    {
       $this->db->select('idMapy,Nazev,Odkaz,Aktivni');  
       $this->db->from('Mapa');
        $this->db->where('idMapy', $id);
   
        $query = $this->db->get();
        $mapa = $query->row_array();
        return $mapa;
    }
    //neaktivni mapy
    function mapyNeaktivni()
    {
       $this->db->select('idMapy,Nazev,Odkaz,Aktivni');  
       $this->db->from('Mapa');
        $this->db->where('Aktivni', 1);
   
        $query = $this->db->get();
        $mapa = $query->result();
        return $mapa;
    }
    function otazkyNacteni()
    {
        $this->db->select('*');  
        $this->db->from('Otazka');
        
   
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    
     function znamkovani($idTest,$idTrida)
    {
        $this->db->select('*');  
        $this->db->from('ZnamkyKtestum');
        $this->db->where('Test_idTest', $idTest);
        $this->db->where('Trida_idTrida', $idTrida);
        
        
        $this->db->order_by('Znamka','asc'); 
        $query = $this->db->get();
        $zn= $query->result();
        return $zn;
    }
      function znamkovaniD($idTest,$idTrida,$znamka,$procenta)
    {
       $this->db->where('Trida_idTrida',$idTrida);
       $this->db->where('Test_idTest',$idTest);
       $this->db->where('Znamka',(String) $znamka);
       $q = $this->db->get('ZnamkyKtestum');
        
      
        $data = array(
          'Trida_idTrida' => $idTrida,  
          'Test_idTest' => $idTest,  
          'Znamka' => $znamka,
          'Procenta' => $procenta
      
        );
        if ( $q->num_rows() > 0 ) 
      {
      $this->db->where('Trida_idTrida',$idTrida);
       $this->db->where('Test_idTest',$idTest);
       $this->db->where('Znamka',$znamka);
   
       
     $this->db->update('ZnamkyKtestum',$data);
    echo "d";
      } else {
          echo '<br>';
  var_dump($data);
 $this->db->insert('ZnamkyKtestum',$data);
   }
    }
    function otazkyNacteni2($id)
    {

        $this->db->select('c.idKategorie,idOtazka,Otazka,c.NazevK');  
        $this->db->from('Otazka o');
        $this->db->join('Otazka_has_Kategorie b', 'b.Otazka_idOtazka=o.idOtazka', 'left');
        $this->db->join('Kategorie c', 'c.idKategorie=b.Kategorie_idKategorie', 'left');
        
        $this->db->where_in('idKategorie', $id);
        $this->db->group_by('Otazka');
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
      function kdejenull($idOtazky,$udelaneTesty)
    {
  
        $this->db->select('Odpoved_idOdpovedi');  
        $this->db->from('OdpovedTest');
     
        
        $this->db->where_in('udelanyTest_idudelanyTest', $udelaneTesty);
        $this->db->where('Otazka_idOtazka',$idOtazky);
      
        //$this->db->group_by('Otazka_idOtazka');
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    
    //pro odetaci
    function odpovedi($otazky)
    {

        $this->db->select('*');  
        $this->db->from('Odpoved');
        $this->db->where('Otazka_idOtazka', $otazky);
        $query = $this->db->get();
        $otazky= $query->result();
        return $otazky;
    }
    function vypsanetridy()
    {
       $this->db->select('o.majitel,b.id,o.idTrida,.o.nazev,b.first_name,b.last_name');  
        $this->db->from('Trida o');
        $this->db->join('users b', 'b.id=o.majitel', 'left');
      
       
       

        $query = $this->db->get();
        $tr= $query->result();
        return $tr;
        
      
    }
    //tridy jen na jeho škole
      function tridydaneskoly($idSkola)
    {

     
          $this->db->select('o.majitel,b.id,o.idTrida,.o.nazev,b.first_name,b.last_name');  
        $this->db->from('Trida o');
        $this->db->join('users b', 'b.id=o.majitel', 'left');
          $this->db->where('Skola_idSkola', $idSkola);
       
       

        $query = $this->db->get();
        $info= $query->result();
        return $info;
    }
    //skola podle tridy
      function skolatridy($idtrida)
    {

     
        $this->db->select('*');  
        $this->db->from('Trida o');
         $this->db->join('Skola b', 'b.idSkoly=o.Skola_idSkola', 'left');
         $this->db->where('idTrida', $idtrida);
       
       

        $query = $this->db->get();
        $skola= $query->row();
        return $skola;
    }
    
     function editodpovedi($idOdp, $text)
     {
       $data = array(
          'text' => $text,  
        
      
        ); 
           $this->db->where('idOdpovedi',$idOdp);
        $this->db->update('Odpoved',$data);  
     }
     function editskoly($idSkoly, $nazev)
     {
       $data = array(
          'nazev' => $nazev,  
        
      
        ); 
           $this->db->where('idSkoly',$idSkoly);
        $this->db->update('Skola',$data);  
     }
     function editotazky($idOt,$nazev)
     {
          $data = array(
          'Otazka' => $nazev,  
       
      
        );
         $this->db->where('idOtazka',$idOt);
         $this->db->update('Otazka',$data); 
     }
     function editkategorie($idK, $nazev)
     {
       $data = array(
          'NazevK' => $nazev,  
        
      
        ); 
        $this->db->where('idKategorie',$idK);
        $this->db->update('Kategorie',$data);  
     }
    function uzInClass($id)
    {

        $this->db->select('*');  
        $this->db->from('Trida o');
        $this->db->join('Users_has_Trida a', 'a.Trida_idTrida=o.idTrida', 'left');
         $this->db->join('users c', 'c.id=a.users_id', 'left');
       
           $this->db->where('idTrida', $id);
       
       

        $query = $this->db->get();
        $info= $query->result();
        return $info;
    }
    function vysledkyZakaT($id,$idT)
    {
        $this->db->select('*');  
        $this->db->from('udelanyTest b');
         $this->db->join('users a', 'a.id=b.users_id', 'left');
       
        $this->db->where('b.users_id', $id);
        $this->db->where('b.Test_idTest', $idT); 
        
        $this->db->group_by('b.idudelanyTest');
        $query = $this->db->get();
        $vys= $query->result();
       
        return $vys;
    }
    function nacteniucitelu($skola)
    {
        $id = array('1', '3');
        /*uzivatelske skupiny
        admin můze být taky ucitelem
       skupina 1 - administratori
       skupina 3 - ucitele*/
        $this->db->select('b.id,b.first_name,b.last_name');  
        $this->db->from('users_groups o');
        $this->db->join('users b', 'b.id=o.user_id', 'left');
        $this->db->where_in('o.group_id', $id);
        $query = $this->db->get();
        $uc= $query->result();
        
        
        foreach($uc as $a)
        {
            $uciteleA[]=$a->id;
        }
        //takže máme všechny učitele teď už jen musíme vybrat učitele z dané školy
        $this->db->select('*');  
        $this->db->from('ZakSkola o');
        $this->db->where('Skola_idSkoly', $skola);
        
        $query = $this->db->get();
        $uc2= $query->result();
      
         foreach($uc2 as $b)
        {
            $uciteleB[]=$b->users_id;
        }
        if(isset($uciteleB))
        {$result = array_intersect($uciteleA, $uciteleB);
        }else{
            $result =null;
        }
     
        
     
      
        return $result;
    }
    function info($arr)
    {
    $this->db->select('*');  
    $this->db->from('users');
       $this->db->where_in('id', $arr);
     $query = $this->db->get();
        $uc3= $query->result();
        
     
      
        return $uc3;   
    }
     function nacteniucitelu2($idSkola)
    {
      
        $this->db->select('*');  
        $this->db->from('ZakSkola o');
        $this->db->join('users b', 'b.id=o.user_id', 'left');
        $this->db->where_in('o.group_id', $id);
       
        
        $query = $this->db->get();
        $uc= $query->result();
        
        //takže máme všechny učitele teď už jen musíme vybrat učitele z dané školy
        
        
        return $uc;
    }
     function mojezadosti($id)
    {
       $this->db->select('*');  
       $this->db->from('Zadosti o');
        $this->db->join('Trida b', 'b.idTrida=o.Trida_idTrida', 'left');
        $this->db->where('o.users_id', $id);

        $query = $this->db->get();
        $zadosti = $query->row();

        return $zadosti;
    }
    function mojetridy($id)
    {
       
        $this->db->select('*');  
        $this->db->from('Trida o');
        $this->db->join('Zadosti b', 'b.Trida_idTrida=o.idTrida', 'left');
        $this->db->where('majitel',$id);
       
    
        $query = $this->db->get();
        $tridy= $query->result();
      
        return $tridy;
    }
  
     function trida($id)
    {

        $this->db->select('o.majitel,o.idTrida,.o.nazev,b.first_name,b.last_name');  
        $this->db->from('Trida o');
        $this->db->join('users b', 'b.id=o.majitel', 'left');
         $this->db->where('o.idTrida',$id);
       
       

        $query = $this->db->get();
        $trida= $query->row();
        return $trida;
    }
    
    function tridanaskolekontrola($idSkoly,$nazevTridy)
    {

        $this->db->select('*');  
        $this->db->from('Trida');
        $this->db->where('Skola_idSkola',$idSkoly);
        $this->db->where('nazev',$nazevTridy);
       

        $query = $this->db->get();
        $trida= $query->row();
        return $trida;
    }
    function tridanaskolekontrola2($idSkoly,$nazevTridy,$trida)
    {

        $this->db->select('*');  
        $this->db->from('Trida');
        $this->db->where('Skola_idSkola',$idSkoly);
        $this->db->where('nazev',$nazevTridy);
        $this->db->where('idTrida!=',$trida);

        $query = $this->db->get();
        $trida= $query->row();
        return $trida;
    }
    
    function kategorieMap($neco)
    {

        $this->db->select('c.idKategorie,idOtazka,Otazka,GROUP_CONCAT(DISTINCT c.NazevK SEPARATOR ",") as NazevKa');  
        $this->db->from('Otazka o');
        $this->db->join('Otazka_has_Kategorie b', 'b.Otazka_idOtazka=o.idOtazka', 'left');
        $this->db->join('Kategorie c', 'c.idKategorie=b.Kategorie_idKategorie', 'left');
       
        $this->db->where_in('idKategorie', $neco);
     
        $query = $this->db->get();
        $kategorie= $query->result();
        return $kategorie;
    }
    
    function otazkyakategorie()
    {

        $this->db->select('c.idKategorie,idOtazka,Otazka,GROUP_CONCAT(DISTINCT c.NazevK SEPARATOR ",") as NazevKa');  
        $this->db->from('Otazka o');
        $this->db->join('Otazka_has_Kategorie b', 'b.Otazka_idOtazka=o.idOtazka', 'left');
        $this->db->join('Kategorie c', 'c.idKategorie=b.Kategorie_idKategorie', 'left');
        $this->db->group_by('idOtazka'); 
     
     
        $query = $this->db->get();
        $kategorie= $query->result();
        return $kategorie;
    }
    function mapaAkategorie()
    {
      
            $this->db->select('idMapy,Nazev,Odkaz,GROUP_CONCAT(c.NazevK SEPARATOR ",") as NazevKa,GROUP_CONCAT(c.idKategorie SEPARATOR "&") as NazevKaa');
            $this->db->from('Mapa m'); 
            $this->db->join('Mapa_has_Kategorie b', 'b.Mapa_idMapy=m.idMapy', 'left');
            $this->db->join('Kategorie c', 'c.idKategorie=b.Kategorie_idKategorie', 'left');
            $this->db->where('c.Aktivni','1');
            $this->db->where('m.Aktivni','0');
            $this->db->order_by('m.Nazev','asc'); 
            $this->db->group_by('Nazev'); 
            $query = $this->db->get(); 
           $kategorie = $query->result();
           return $kategorie;
    }
    function mapyDleKategorieDruhaCast($mapy)
    {
      
            $this->db->select('idMapy,Nazev,Odkaz,GROUP_CONCAT(c.NazevK SEPARATOR ",") as NazevKa,GROUP_CONCAT(c.idKategorie SEPARATOR "&") as NazevKaa');
            $this->db->from('Mapa m'); 
            $this->db->join('Mapa_has_Kategorie b', 'b.Mapa_idMapy=m.idMapy', 'left');
            $this->db->join('Kategorie c', 'c.idKategorie=b.Kategorie_idKategorie', 'left');
            $this->db->where('c.Aktivni','1');
            $this->db->where('m.Aktivni','0');
            $this->db->where_in('idMapy',$mapy);
            $this->db->order_by('m.Nazev','asc'); 
            $this->db->group_by('Nazev'); 
            $query = $this->db->get(); 
           $kategorie = $query->result();
           return $kategorie;
    }
    //mapa dané kategorie
    function mapyDleKategoriePrvniCast($idKategorie)
    {
      
            $this->db->select('*');
            $this->db->from('Mapa_has_Kategorie'); 
           
            $this->db->where('Kategorie_idKategorie',$idKategorie);
       
      
            $query = $this->db->get(); 
           $kategorie = $query->result();
           return $kategorie;
    }
    
    //kategorie dane mapy
    function kategorieMapy($idMapy)
    {
      
            $this->db->select('*');
            $this->db->from('Mapa_has_Kategorie'); 
           
            $this->db->where('Mapa_idMapy',$idMapy);
       
      
            $query = $this->db->get(); 
           $kategorie = $query->result();
           return $kategorie;
    }
     function testyList()
    {

        $this->db->select('o.users_id,o.idTest,o.nazev,c.Nazev,o.aktivni,c.idMapy,c.Aktivni');  
        $this->db->from('Test o');
        $this->db->join('Mapa_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Mapa c', 'c.idMapy=b.Mapa_idMapy', 'left');
        
      
        $this->db->group_by('o.nazev');
        
        $query = $this->db->get();
        $test= $query->result();
        return $test;
    }
    
     function testyKatL($idT)
    {
        //test podle id

        $this->db->select('o.users_id,o.idTest,o.nazev,c.Nazev,o.aktivni,c.idMapy,c.Aktivni');  
        $this->db->from('Test o');
        $this->db->join('Mapa_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Mapa c', 'c.idMapy=b.Mapa_idMapy', 'left');
        
        $this->db->where('o.idTest',$idT);
       
        $this->db->group_by('o.nazev');
        
        $query = $this->db->get();
        $test= $query->row();
        return $test;
    }
    //testy podle kategorie
     function testyKat($idK)
    {

        $this->db->select('b.Test_idTest,o.Mapa_idMapy');  
        $this->db->from('Mapa_has_Kategorie o');
        $this->db->join('Mapa_has_Test b', 'b.Mapa_idMapy=o.Mapa_idMapy', 'right');
        $this->db->where('o.Kategorie_idKategorie',$idK);
        
      
      
        
        $query = $this->db->get();
        $test= $query->result();
        return $test;
    }
      function testyOtazky()
    {
        //pro nastaveni limitu
        $this->db->select('o.idTest,o.nazev,COUNT(c.idOtazka)pocet');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Otazka c', 'c.idOtazka=b.Otazka_idOtazka', 'left');
        $this->db->where('o.Aktivni',0);
      
        $this->db->group_by('o.nazev');
        
        $query = $this->db->get();
        $limit= $query->result();
        return $limit;
    }
   
          function limitProTridu($idTrida,$idTest)
    {
 
        $this->db->select('o.pocetOt');  
        $this->db->from('PocetOtProDanouTridu o');
        $this->db->where('o.Trida_idTrida',$idTrida);
        $this->db->where('o.Test_idTest',$idTest);
       
      
      
        
        $query = $this->db->get();
        $limit= $query->row();
        return $limit;
    }
    //statistika
      function testyStatistika()
    {

        $this->db->select('idTest,nazev,COUNT(Otazka_idOtazka) ota,c.first_name,c.last_name');  
        $this->db->from('Test o');
        $this->db->join('Otazka_has_Test b', 'b.Test_idTest=o.idTest', 'left');
         $this->db->join('users c', 'c.id=o.users_id', 'left');
    
        
   
        $this->db->group_by('nazev');
        $this->db->order_by('nazev');
        $query = $this->db->get();
        $test= $query->result();
        return $test;
    }
    
     //kategorie daného testu
      function kategorieTestu($idTest)
    {

     

        $this->db->select('c.Kategorie_idKategorie');  
        $this->db->from('Test o');
        $this->db->join('Mapa_has_Test b', 'b.Test_idTest=o.idTest', 'left');
        $this->db->join('Mapa_has_Kategorie c', 'c.Mapa_idMapy=b.Mapa_idMapy', 'left');
        $this->db->where('o.idTest',$idTest);
        
      
      
        
        $query = $this->db->get();
        $kat= $query->result();
        return $kat;
    
    }
    function test($id)
    {

        $this->db->select('*');  
        $this->db->from('Test o');
        $this->db->where('idTest', $id);
        $query = $this->db->get();
        $test= $query->row_array();
        return $test;
    }
    
    //uvodní počty
    function pocetLidi()
    {
       $this->db->select('COUNT(id) as Pocet');  
       $this->db->from('users');
     

        $query = $this->db->get();
        $lidi = $query->row();
        return $lidi;
    }
    function pocetLidiInClass($trida)
    {
       $this->db->select('COUNT(users_id) as Pocet');  
       $this->db->from('Users_has_Trida');
       $this->db->where('Trida_idTrida',$trida);

        $query = $this->db->get();
        $pocetLidi = $query->row();
        return $pocetLidi;
    }
    function pocetTestu()
    {
       $this->db->select('COUNT(idTest) as Pocet');  
       $this->db->from('Test');
     

        $query = $this->db->get();
        $test = $query->row();
        return $test;
    }
    function pocetMap()
    {
       $this->db->select('COUNT(idMapy) as Pocet');  
       $this->db->from('Mapa');
     

        $query = $this->db->get();
        $mapy = $query->row();
        return $mapy;
    }
   
   
   //vysledek do majitele
    function vysledkyMaj($id)
    {
     
        $this->db->select('d.majitel');  
        $this->db->from('udelanyTest b');
        $this->db->join('Users_has_Trida c', 'c.users_id=b.users_id', 'left');
         $this->db->join('Trida d', 'd.idTrida=c.Trida_idTrida', 'left');
      
      
      
        $this->db->where('b.idudelanyTest', $id);
   

        $query = $this->db->get();
        $vys= $query->row();
        return $vys;
    }
    
    //limit
     function limit($id,$limit,$trida)
    {
        $this->db->where('Trida_idTrida',$trida);
        $this->db->where('Test_idTest',$id);
        $q = $this->db->get('PocetOtProDanouTridu');
        
        
        $data = array(
          'Trida_idTrida' => $trida,  
          'Test_idTest' => $id,  
          'pocetOt' => $limit
     
      
        );
        if ( $q->num_rows() > 0 ) 
      {
      $this->db->where('Trida_idTrida',$trida);
      $this->db->where('Test_idTest',$id);
      $this->db->update('PocetOtProDanouTridu',$data);
      } else {
    
      $this->db->insert('PocetOtProDanouTridu',$data);
   }
    }
}
