<?php
class Main extends CI_Controller
{
    //put your code here
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('ion_auth_acl');
        $this->load->model('TestModel');
        $this->load->model('ProfilM');
        $this->load->model('MainModel');
        $this->load->library('mjqa');
        
    }
    
    
    function uvod()
    {
        //hlavni strana
        $data["title"]      = "GEOAUH";
        $data["main"]       = "hlavnistrana";
        //načtení hodnot z databáze 
        $data["pocetLidi"]  = $this->MainModel->pocetLidi(); //počet zaregistrovaných uživatelů
        $data["pocetMap"]   = $this->MainModel->pocetMap(); //počet map na serveru
        $data["pocetTestu"] = $this->MainModel->pocetTestu(); //počet vytvořených testů
        $this->layout->generate($data);
    }
    
    
    
    
    //zobrazení stránky testů podle jednotlivých kategorií
    function testyPodleKategorie($idK = null)
    {
        //defaultně null, protože by nám uživatel mohl uživatel smazat id kategorie a odeslat nějakou blbost
        $data["title"] = "Testy - Kategorie";
        $data["main"]  = "testyList";
        //   
        $testyKate     = $this->MainModel->testyKat($idK);
        //zkontrolujeme jestli daná kategorie existuje, a když ne, tak se mu zobrazí error
        if ($testyKate != null) {
            
            
            foreach ($testyKate as $value) {
                //pro jednotlivé testy načtu id autora,název testu, název mapy ke které patří a jestli je aktivní
                $data["testy"][] = $this->MainModel->testyKatL($value->Test_idTest);
                
            }
            foreach ($data["testy"] as $value) {
                //načtení profilu autorů jednotlivých testů
                $data["profil"][$value->idTest] = $this->ProfilM->profil($value->users_id);
            }
            
            
        } else {
            //pokud kategorie nemá žádný test tak se odešle proměnná neex a na stránce se zobrazí hláška o tom že kategorie nemá testy
            $data["neex"] = 1;
        }
        $this->layout->generate($data);
        
    }
    
    function testyList()
    {
        //zobrazení všech testů
        $data["title"] = "Testy";
        $data["main"]  = "testyList";
        $data["testy"] = $this->MainModel->testyList();
        //načtení profilu autorů jednotlivých testů
        foreach ($data["testy"] as $value) {
            $data["profil"][$value->idTest] = $this->ProfilM->profil($value->users_id);
        }
        
        
        
        
        
        
        
        $this->layout->generate($data);
    }
    
    
    
    function naucnemapy()
    {
        
        
        //mapy nahrané na web
        $data["title"]     = "Mapy";
        $data["main"]      = "uzivatel/rozcetnikKategoriiMap";
        $data["mapy"]      = $this->MainModel->mapaAkategorie();
        $data["kategorie"] = $this->MainModel->kategorie();
        
        $this->layout->generate($data);
    }
    
    function naucnemapyDleKategorie($idKategorie)
    {
        
        $mapy = $this->MainModel->mapyDleKategoriePrvniCast($idKategorie);
        
        
        foreach ($mapy as $key => $value) {
            $mapy2[] = $value->Mapa_idMapy;
        }
        
        //mapy nahrané na web
        $data["title"] = "Mapy";
        $data["main"]  = "uzivatel/rozcetnikKategoriiMap";
        if (isset($mapy2)) {
            $data["mapy"] = $this->MainModel->mapyDleKategorieDruhaCast($mapy2);
        } else {
            $data["mapy"] = null;
        }
        $data["kategorie"] = $this->MainModel->kategorie();
        
        $this->layout->generate($data);
    }
    
    //odeslání žádosti o přijetí do dané třídy
    
    function statistikaSkol()
    {
        
        //zobrazení škol
        $data["title"] = "Školy";
        $data["main"]  = "statistika/skoly";
        $data["skoly"] = $this->MainModel->vsechnyskoly();
        $this->layout->generate($data);
    }
    function statistikaSkoly($idSkola)
    {
        
        //zkusíme jestli vůbec existuje tato škola, jestli je v databázi
        $query = $this->db->get_where('Skola', array(
            'idSkoly' => $idSkola
        ));
        if ($query->num_rows() > 0) {
            //pokud ano tak načteme data
            $data["tridy"] = $this->MainModel->tridydaneskoly($idSkola);
            $data["testy"]      = $this->TestModel->testyList(); //list jednotlivých testů
            $data["skola"]      = $this->MainModel->skolaLoad($idSkola); //info o škole
            $data["statistika"] = $this->mjqa->statistikaSkoly($idSkola); //výsledky v testech dané školy
            $data["title"]      = "Statistika školy";
            $data["main"]       = "statistika/jednotnaSkola";
            $this->layout->generate($data);
        } else {
              $this->ion_auth->error($this->config->item('error_skola'));
        }
    }
    function statistikaTridy($idTrida)
    {
        
        //zkusíme jestli vůbec existuje tato škola, jestli je v databázi
        $query = $this->db->get_where('Trida', array(
            'idTrida' => $idTrida
        ));
        if ($query->num_rows() > 0) {
            //pokud ano tak načteme data
            
  
            $data["trida"]      = $this->MainModel->trida($idTrida);
             $data["testy"]      = $this->TestModel->testyList(); //list jednotlivých testů
            $data["skola"]      = $this->MainModel->skolatridy($idTrida); //info o škole
            $data["statistika"] = $this->mjqa->statistikaTridy($idTrida); //výsledky v testech dané školy
            $data["title"]      = "Statistika třídy";
            $data["main"]       = "statistika/jednotnaTrida";
            $this->layout->generate($data);
        } else {
             $this->ion_auth->error($this->config->item('error_trida'));
        }
    }
    
    //zavolání testu
    function volaniTestu($id)
    {
        
        //zavoláme test a zkontrolujeme jestli je test aktivní nebo jestli vůbec existuje
        $test = $this->MainModel->test($id);
    
        if ($test["aktivni"] == 1 || $test == null) {
            $this->ion_auth->error($this->config->item('error_test'));
        } else {
            
            //zavolám metodu knihovny a dostanu otázky
            $data["otazky"] = $this->mjqa->zavolatTest($id, null);
            foreach ($data["otazky"] as $a) {
                $otazkyvtestu[]=$a->getA()["idOtazka"];
            }
            
            //uložím si otázky do session
       
            $this->session->set_userdata('otazkyvtestu', $otazkyvtestu);
            $this->session->set_userdata('idTestu', $id);
            
            
            $data["idtestu"] = $id;
            $data["title"]   = "Test";
            $data["main"]    = "testMain";
            $this->layout->generate($data);
        }
    }
    function statistika($id = null)
    {
          $test = $this->MainModel->test($id);
    
        if ($test["aktivni"] == 1 || $test == null) {
            $this->ion_auth->error($this->config->item('error_test'));
        } else {
       
            
            $uT     = $this->TestModel->statistikaOtazkyA($id);
            $celkem = 0;
            if ($uT != null) {
                
                
                foreach ($uT as $val) {
                    $a      = $this->mjqa->pocetProcent($val->idUdelanyTest);
                    $celkem = $celkem + $a["uspesnost"];
                }
                foreach ($uT as $list) {
                    $uD[] = $list->idUdelanyTest;
                }
                $ot = $this->MainModel->otazkyVTestu($id);
                
                foreach ($ot as $value) {
                    $vals  = $this->MainModel->kdejenull($value->Otazka_idOtazka, $uD);
                    $pocet = 0;
                    foreach ($vals as $als) {
                        if ($als->Odpoved_idOdpovedi == null)
                            $pocet++;
                    }
                    
                $data["neudelane"][$value->Otazka_idOtazka] = $pocet;
                }
                $data["celkemA"] = $celkem / count($uT);
                
            }
            
            // $this->mjqa->pocetProcent();
            
            $data["statistika"] = $this->mjqa->statistikaOtazekVTestu($id);
            $data["title"]      = "Statistika";
            $data["main"]       = "statistika/mainTest";
            $this->layout->generate($data);
            
            
      
        }
    }
    function error($error = null) {
        //error stránka na kterou se odkazuje v případě nedostatečných práv
        
        $data["title"] = "Error";
        $data["main"]  = "uzivatel/error_page";
        $data["error"] = $error;
        
        $this->layout->generate($data);
    }
    function testHotovo()
    {
        
        
        
        $data2 = $this->input->post();
        $ota   = $this->input->post('otazky', TRUE);
        
        if ($this->session->userdata('user_id') != null) {
            $id = $this->session->userdata('user_id');
        } else {
            $id = null;
        }
        $idT = $this->session->userdata("idTestu");
        if ($this->session->userdata("otazkyvtestu") != null) {
            foreach ($data2 as $key => $v) {
                if (is_int($key)) {
                    $data[$key] = $v;
                } else {
                    $otazkyVtestu = $v;
                }
            }
            
            
            $otazkyVtestu = $this->session->userdata("otazkyvtestu");
            $this->session->unset_userdata('otazkyvtestu');
            $this->session->unset_userdata('idTestu');
            
            if (!isset($data))                $data = null;
            if (!$this->ion_auth->is_admin()&&!$this->ion_auth->is_ucitel() && $this->session->userdata('user_id') != null) {
                
                $a = $this->ProfilM->myclass($id);
                
                if ($a->nazev != null) {
                    $limit = $this->TestModel->limitProTridu($a->idTrida, $idT);
                    
                    
                }
            } else {
                $limit = null;
                 if ($this->mjqa->kontrolaTestu($otazkyVtestu, $idT)) {
                  $this->mjqa->vyhodnoceni($idT, $data, $id, $otazkyVtestu);
            } else {
                echo $this->ion_auth->error($this->config->item('error_test'));
                ;
            }
            }
            
            if (isset($limit)) {
                
                
                if (count($otazkyVtestu) == $limit->pocetOt) {
                    
                 
                 
                    
                    if ($this->mjqa->kontrolaTestu($otazkyVtestu, $idT)) {
                        $this->mjqa->vyhodnoceni($idT, $data, $id, $otazkyVtestu);
                    } else {
                        echo $this->ion_auth->error($this->config->item('error_test'));
                    }
                }
            }
           
        } else {
            $this->ion_auth->error("Vyplňtě první test!");
        }
        
    }
    function vysledekPresToken($token)
    {
        if (isset($token)) {
            $idTest = substr($token, 32, strlen($token));
      
        if($idTest!=null)
        {
          
            $test=$this->TestModel->getByHashToken($token, $idTest);
            
          if($test!=null)
            {      
          
            $id               = $test->udelanyTest_idudelanyTest;
        $data["vysledek"] = $this->mjqa->vysledekTestu($id);
        
        if (isset($id)) {
       
            $data["ran"]   = 1;
            $data["title"] = "Výsledek testu";
            $data["main"]  = "vysledek";
            
            $this->layout->generate($data);
            
        } else {
            
              $this->ion_auth->error("Takový výsledek neexistuje!");
            
        }
        }
          else{
              $this->ion_auth->error("Takový výsledek neexistuje!");   
          }  
            
        }else{
            $this->ion_auth->error("Takový výsledek neexistuje!");  
        }
        }
    }
    
    /*výsledek testu, má zde přístup daný uživatel, učitel v jehož třídě je žák, 
    uživatel kdo má odkaz a administrator*/
    function vysledekPresID($id)
    {
        $data["vysledek"] = $this->mjqa->vysledekTestu($id);
        
        
        
        
        
        
        
        $majitel = $this->MainModel->vysledkyMaj($id);
        
        
        if ($data["vysledek"] != null && $this->session->userdata('user_id') != null) {
            if ($this->session->userdata('user_id') == $data["vysledek"]["uzivatel"]->id || $this->ion_auth_acl->has_permission('access_admin') || $this->session->userdata('user_id') == $majitel->majitel) {
                
                if ($this->session->userdata('user_id') == $data["vysledek"]["uzivatel"]->id)
                $data["ran"] = 0;
               
                $data["title"] = "Výsledek testu";
                $data["main"]  = "vysledek";
                $this->layout->generate($data);
            }else{
                 $this->ion_auth->error();
            }
        } else {
            
            $this->ion_auth->error();
            
        }
    }
    
    function statistikaMain()
    {
        
        $data["testy"] = $this->MainModel->testyList();
        $data["title"] = "Statistika Testů";
        $data["main"]  = "statistika/main";
        $this->layout->generate($data);
    }
    
   
   
    
    function user_data_submit()
    {
        /*$data = array(
        'username' => $this->input->post('name')
        
        );*/
        
        
        $a = $this->input->post('name');
        
        
        $data = $this->MainModel->test($a);
        //Either you can print value or you can send value to database
        echo json_encode($data);
    }
    
    
    
    function user_page()
    {
        
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        } else {
            $data["title"] = "Your Main Page";
            $data["main"]  = "user_page";
            
            
            $this->layout->generate($data);
        }
    }
    
    function videonavod()
    {
        
        $data["title"] = "Návod";
        $data["main"]  = "videonavod";
        
        
        
        
        
        $this->layout->generate($data);
    }
    function test()
    {
        
        $data["title"] = "Donate";
        $data["main"]  = "novytest";
        
        $data["otazky"] = $this->MainModel->otazkyNacteni();
        $this->layout->generate($data);
    }
    function faq()
    {
        
        $data["title"] = "FAQ";
        $data["main"]  = "uzivatel/faq";
        
        
        $this->layout->generate($data);
    }
    
    
}