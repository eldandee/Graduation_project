<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
class MainU extends CI_Controller
{
    //put your code here
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('MainModel', 'MM');
        $this->load->model('TestModel');
        $this->load->model('UploadModel', 'UM');
        $this->load->model('UcitelModel', 'UCM');
        $this->load->model('MainModel');
        $this->load->model('ProfilM');
        $this->load->library('mjqa');
        if (!$this->ion_auth->is_admin() && !$this->ion_auth->is_ucitel())
           redirect('/error');
    }
    
    function newtest()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('vytvorit_test')) {
            $this->ion_auth->error();
        } else {
            $data["title"]            = "Testy";
            $data["main"]             = "otazkyAtesty";
            $data["kategorie"]        = $this->MainModel->kategorie();
            $data["kategorieProMapy"] = $this->MainModel->mapaAkategorie();
            
            
            
            $this->layout->generate($data);
        }
    }
    
    function newtest2()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('vytvorit_test')) {
            $this->ion_auth->error();
        } else {
            $data["title"]            = "Testy";
            $data["main"]             = "otazkyAtesty1";
            $data["kategorie"]        = $this->MainModel->kategorie();
            $data["kategorieProMapy"] = $this->MainModel->mapaAkategorie();
            
            
            
            $this->layout->generate($data);
        }
    }
    
    function mojetridy()
    {
        
        $data["title"] = "Moje třídy";
        $data["main"]  = "ucitel/tridy_main";
        $data["skoly"] = $this->MainModel->skolyLoad();
        $id            = $this->session->userdata('user_id');
        $data["tridy"] = $this->MainModel->mojetridy($id);
        
        foreach ($data["tridy"] as $val) {
            $data["zadosti"][$val->idTrida]   = $this->MainModel->pocetZadosti($val->idTrida);
            $data["pocetLidi"][$val->idTrida] = $this->MainModel->pocetLidiInClass($val->idTrida);
        }
        
        
        $this->layout->generate($data);
    }
    
    
    function zacitrida($idTridy)
    {
        
        
        
        $id            = $this->session->userdata('user_id');
        $data["trida"] = $this->MainModel->trida($idTridy);
        
        $data["testy"] = $this->MainModel->testyOtazky();
        $data["title"] = "Žádosti o přijetí do třídy";
        $data["main"]  = "ucitel/tridy_zaci";
       
        if( $data["trida"]!=null)
        {
        if ($id == $data["trida"]->majitel) {
            foreach ($data["testy"] as $val) {
                
                $data["limity"][$val->idTest] = $this->MainModel->limitProTridu($idTridy, $val->idTest);
            }
          
             $this->session->set_userdata('trida',$idTridy);
              
            $data["zaci"] = $this->MainModel->uzInClass($idTridy);
            
            $this->layout->generate($data);
        } else {
            $this->ion_auth->error();
        }
    }else{
              $this->ion_auth->error($this->config->item('error_trida'));
        }
    }
    function zadostitrida($idTridy)
    {
        $id            = $this->session->userdata('user_id');
        $data["trida"] = $this->MainModel->trida($idTridy);
        $data["title"] = "Žádosti o přijetí do třídy";
        $data["main"]  = "ucitel/tridy_zadosti";
        if( $data["trida"]!=null)
        {
        if ($id == $data["trida"]->majitel) {
            
            
            
            $data["zadosti"] = $this->MainModel->zadostiDoTridy($idTridy);
            
            $this->layout->generate($data);
        } else {
            $this->ion_auth->error();
        }
        
        }else{
              $this->ion_auth->error($this->config->item('error_trida'));
        }
    }
    
    function zadostiDone()
    {
        $id       = $this->session->userdata('user_id');
        $a        = $_POST;
        $uzivatel = $this->MainModel->zadost($a["zadost"]);
        $majitel  = $this->MainModel->trida($a["trida"]);
        if($uzivatel!=null)
        {
        if ($id == $majitel->majitel&&$uzivatel->Trida_idTrida) {
            
         
            
         $this->MainModel->zadostDone1($a["zadost"]);
          $this->MainModel->zadostDone2($uzivatel->users_id, $uzivatel->Trida_idTrida);
         $this->session->set_flashdata('success', "Úspěšně jste přidali žáka!");
          redirect('zadostitrida/' . $a["trida"]);
        }  else{
             $this->ion_auth->error();
        } 
        } else {
            
            $this->ion_auth->error();
        }
    }
    
  
    function vysledkyTridyTest($idTestu)
    {
     
        $id   = $this->session->userdata('user_id');
        $idTridy=$this->session->userdata('trida');
        $majitel = $this->MainModel->trida(  $idTridy);
      
        $test = $this->MainModel->test($idTestu);
    
        if ($test["aktivni"] == 1 || $test == null) {
            $this->ion_auth->error($this->config->item('error_test'));
        } else {
    
        if ($majitel != null&&$idTridy!=null) {
            if ($id == $majitel->majitel) {
                
                
                $zaci = $this->MainModel->uzInClass($idTridy);
                  
                foreach ($zaci as $value) {
                    
                    if ($value->id != null) {
                
                        $a = $this->MainModel->vysledkyZakaT($value->id, $idTestu);
                        
                        if ($a != null) {
                            
                            $zaci1[$value->id] = $this->MainModel->vysledkyZakaT($value->id,$idTestu);
                            //počítání procent žáka v testu
                         
                            foreach ($zaci1[$value->id] as $a) {
                                $zaci2[$value->id][$a->idudelanyTest] = $this->mjqa->pocetProcent($a->idudelanyTest);
                                
                            }
                            
                            // var_dump($zaci2[$value->id]);
                        }
                        
                        
                    }
                }
                
                
                $data["title"] = "Třídy";
                $data["main"]  = "ucitel/tridy_vysledky";
                if (isset($a)) {
                    
                    
                    if ($a != null) {
                        $data["znamkovani"] = $this->MainModel->znamkovani($idTestu,   $idTridy);
                        $data["vys"]        = $zaci1;
                        
                        $data["proc"] = $zaci2;
                        
                    }
                } else {
                    $data["vys"] = null;
                }
                $this->layout->generate($data);
                
                
            }
        }else{
            $this->ion_auth->error($this->config->item('error_trida'));
        }
        }
        
    }
    function znamkovani($idTest)
    {
       
         $idTrida   = $this->session->userdata('trida');
        $majitel = $this->MainModel->trida( $idTrida  );
        //zkontroluju jestli je uživatel majitel třídy
        if ($majitel != null&&$this->MainModel->test($idTest)!=null) {
            if ($this->session->userdata('user_id') == $majitel->majitel) {

                
                $znamkovani = $this->MainModel->znamkovani($idTest, $idTrida );
                
                $data["znamkovani"] = $znamkovani;
              
                $data["title"]      = "Nastavení známkování";
                $data["main"]       = "ucitel/tridy_znamkovani";
                
                $this->layout->generate($data);
                
                
            
        }
        
    }else{
           $this->ion_auth->error($this->config->item('error_hlavni'));
    }
    }
    function znamkovaniDone($idTest)
    {
        
     
      
         $idTrida   = $this->session->userdata('trida');
        
        $majitel = $this->MainModel->trida( $idTrida  );
        //zkontroluju jestli je uživatel majitel třídy
        if ($majitel != null&&$this->MainModel->test($idTest)!=null) {
          
            if ($this->session->userdata('user_id') == $majitel->majitel) {
               
                $znamky[1] = $this->input->post('1', TRUE);
                $znamky[2] = $this->input->post('2', TRUE);
                $znamky[3] = $this->input->post('3', TRUE);
                $znamky[4] = $this->input->post('4', TRUE);
             
                if ($znamky[1] != null && $znamky[2] != null && $znamky[3] != null && $znamky[4] != null) {
                    
                    //dostanu všechny známky a zkontroluju jestli vyhovují     
                    if ($znamky[1] > $znamky[2] && $znamky[1] > $znamky[3] && $znamky[1] > $znamky[4]) {
                        if ($znamky[2] > $znamky[3] && $znamky[2] > $znamky[4]) {
                            if ($znamky[3] > $znamky[4]) {
                                for ($i = 1; $i < 5; $i++) {
                               
                                    $this->MainModel->znamkovaniD($idTest, $idTrida , $i, $znamky[$i]);
                                    //zapsání nastavení známek konstruktor(idTest,idTrida,znamka,procenta)
                                 
                                    
                                }
                                   $this->session->set_flashdata('success', "Úspěšně jste přidali vlastní známkování!");
                                redirect('zacitrida/'.$idTrida);
                            }
                        }
                    }
                }
            }
        }
         $this->session->set_flashdata('error', "Nastala chyba!");
                                redirect('zacitrida/'.$idTrida);
    }
    
    function zmenaLimitu($id)
    {
        
        $trida = $this->input->post('trida', TRUE);
        $limit = $this->input->post('limit', TRUE);
        $max   = $this->input->post('max', TRUE);
        
        if (is_numeric($limit)) {
            if ($max > $limit && $limit > 0) {
              $this->session->set_flashdata('success', $this->config->item('error_edit_success'));
                $this->MainModel->limit($id, $limit, $trida);
                redirect('zacitrida/' . $trida);
            } elseif ($max == $limit && $limit > 0) {
               $this->session->set_flashdata('success', $this->config->item('error_edit_success'));
                $this->MainModel->limitDestroy($id, $trida);
                redirect('zacitrida/' . $trida);
            }elseif ($max < $limit)
        {
            $this->session->set_flashdata('error', "Nelze nastavit větší limit než má test otázek!");
            redirect('zacitrida/'.$trida);
        }else{
            $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
                          redirect('zacitrida/'.$trida);
        }
        
        //redirect('zacitrida/' . $trida);
    }else{
       $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
         redirect('zacitrida/'.$trida);
    }
    }
    
    function tridy()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin')) {
            $this->ion_auth->error();
        } else {
            $data["title"] = "Třídy";
            $data["main"]  = "admin/tridy";
            $data["tridy"] = $this->MainModel->vypsanetridy();
            $data["skoly"] = $this->MainModel->vsechnyskoly();
            
            
            $this->layout->generate($data);
            
        }
    }
    
    function novatrida()
    {
        
        
        
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('nova_trida')) {
            $this->ion_auth->error();
        } else {
          $this->form_validation->set_rules('nazev', 'nazev', 'required|trim|callback_overeni');
         if( $this->form_validation->run() === FALSE )
        {
           
              $this->session->set_flashdata('error',"Vytvoření se nezdařilo!");
              if ($this->ion_auth_acl->has_permission('access_admin')) {
                redirect('tridy');
                } else {
                 redirect('/profil/mojetridy');
                }
             }else{
            
            $nazev   = $this->input->post('nazev', TRUE);
            $majitel = $this->session->userdata('user_id');
           
            if ($this->ion_auth_acl->has_permission('access_admin')) {
                $skola = $this->input->post('skola', TRUE);
            } else {
                $skola = $this->MainModel->skolaUzivatele($majitel)->Skola_idSkoly;
            }
            
            $vysledek=$this->MainModel->tridanaskolekontrola($skola,$nazev);
               if ($vysledek>0) {
               
                    $this->session->set_flashdata('error', "Taková třída již existuje :(");
                } else {
                 
                     
                    $this->MainModel->novatrida($nazev, $majitel, $skola);
                    $this->session->set_flashdata('success', "Úspěšně jste vytvořili třídu!");
                
                    
                }
                
                  if ($this->ion_auth_acl->has_permission('access_admin')) {
                  redirect('tridy');
                } else {
                 redirect('/profil/mojetridy');
                }
             }
    
        }
    }
    
    
    function mapyakategorie()
    {
        
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('mapa_nahrani') && !$this->ion_auth_acl->has_permission('mapa_nova_kategorie'))
            {$this->ion_auth->error();}else{
                
         
        $data["title"] = "Nahrání mapy";
        $data["main"]  = "admin/nahranimapy";
        
        $data["kategorie"] = $this->MainModel->kategorie();
        
        
        $this->layout->generate($data);
            }
    }
    
     function editacekategorie($idKategorie)
    {
        
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('mapa_nahrani') && !$this->ion_auth_acl->has_permission('mapa_nova_kategorie'))
         {   $this->ion_auth->error();
             
         }else{
             
        
        $data["title"] = "Editace kategorie";
        $data["main"]  = "admin/editacekategorie";
        $data["kategorie"] = $this->MainModel->kategorieEdit($idKategorie);
        $this->layout->generate($data);
         }
    }
    
    function editacekategoriehotovo($idKat)
    {
        
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('mapa_nahrani') && !$this->ion_auth_acl->has_permission('mapa_nova_kategorie'))
           { $this->ion_auth->error();}else{
               
        
            
              $this->form_validation->set_rules('kategorie', 'Název', 'trim|required');
              
                 if ($this->form_validation->run() == false) {
                 $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
                          redirect('/admin/mapy');
                
                 }else{
                    $nazev=$this->input->post('kategorie', TRUE);
                    //nemůže se jmenovat jako žádná jiná ale nemůžu použit is unique protože by to našlu samu starou kategorii
                    $kategorie=$this->MainModel->kategorie();
                    
                    foreach($kategorie as $value)
                    {
                        $vsechnyKategorie[$value->idKategorie]=$value->NazevK;
                        
                        
                    }
                   //pro kontrolu tedy musím smazat editovanou kategorii a ověřit jestli není název ostatních takový
                    unset($vsechnyKategorie[$idKat]);
                    if(array_search($nazev,$vsechnyKategorie)==false)
                    {
                        $this->MainModel->editkategorie($idKat,$nazev);
                        $this->session->set_flashdata('success', $this->config->item('error_edit_success'));
                          redirect('/admin/mapy');
                        
                    }else{
                          $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
                          redirect('/admin/mapy');
                    }
                    
                    
                    
                 }
           }
      
    }
    function testVytvoreni($idMapy)
    {
        
        $mapa=$this->MainModel->mapaNacteni($idMapy);
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('vytvorit_test')) {
            $this->ion_auth->error();
        } else {
            
            if($mapa['Aktivni']==0)
            {
                
           
            $kM = $this->MainModel->kategorieMapy($idMapy);
            foreach ($kM as $value) {
                $kategorieMapy[] = $value->Kategorie_idKategorie;
            }
            
            
            
            $this->session->set_userdata('mapa', $idMapy);
            $this->session->set_userdata('user', $this->session->userdata('user_id'));
            $data["user"]  = $this->ion_auth->user()->row();
            $data["title"] = "Nový test";
            $data["main"]  = "admin/novytest";
            
            if (isset($kategorieMapy)) {
                $data["otazky"] = $this->MainModel->otazkyNacteni2($kategorieMapy);
                if (count($data["otazky"]) == 0) {
                    
                    $this->ion_auth->error("Ke kategoriím daného testu nejsou žádné otázky");
                } else {
                    
                    
                    $data["kat"] = $this->MainModel->kategorieMap($kategorieMapy);
                    $this->layout->generate($data);
                }
                
                
                
            } else {
                $this->ion_auth->error("Ke kategoriím daného testu nejsou žádné otázky");
            }
            }else{
                 $this->ion_auth->error("Neaktivní mapa!");
            }
        }
    }
    function vytvoreniskoly()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin'))
          {  $this->ion_auth->error();} else {
              
         
        $nazev = $this->input->post('nazev', TRUE);
        
        $query = $this->db->get_where('Skola', array(
            'nazev' => $nazev
        ));
        
        
        
        
        
        
        
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', "Taková škola již existuje :(");
            
            
            redirect('skoly');
        } else {
            $this->MainModel->novaskola($nazev);
            $this->session->set_flashdata('success', "Úspěšně jste vytvořili školu!");
            redirect('skoly');
        }
        
          } 
    }
    
    
    
    
    function do_upload()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('mapa_nahrani')) {
            $this->ion_auth->error();
        } else {
            
            
            $nazev = $this->input->post('nazev', TRUE);
            
            $config['upload_path']   = './mapy/';
            $config['allowed_types'] = 'kml';
            $nazevBezMezer           = str_replace(' ', '', $nazev);
            
            $config['file_name'] = time() . random_string('alnum', 5);
          
            $odkaz = $config['file_name'] . '.kml';
            
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('userfile')) {
                $error = array(
                    'error' => $this->upload->display_errors()
                );
                $this->session->set_flashdata('error', $error['error']);
                
                redirect('/admin/mapy');
            } else {
                
                $this->UM->uploadFile($nazev, $odkaz);
                foreach ($this->input->post('kategorie') as $kategorie) {
                    
                    $this->UM->uploadKat($kategorie);
                    
                }
                
                
                $this->session->set_flashdata('success', "Úspěšně jste vložili mapu!");
                redirect('/admin/mapy');
                
            }
        }
    }
    
    function novakategorie()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('mapa_nova_kategorie')) {
          $this->ion_auth->error();
        } else {
            
             $this->form_validation->set_rules('nazevK', 'Název', 'trim|required|is_unique[Kategorie.NazevK]');
        if ($this->form_validation->run() == false) {
                  $this->session->set_flashdata('error', "Taková kategorie již existuje!");
                redirect('/admin/mapy');
        }else{
            
  
            $this->load->model('UcitelModel');
            $nazev = $this->input->post('nazevK', TRUE);
            $query = $this->db->get_where('Kategorie', array(
                'NazevK' => $nazev
            ));
            
            if ($query->num_rows() > 0) {
          
            } else {
                
                $this->UCM->novakategorie($nazev);
                foreach ($this->input->post('kategorie') as $kategorie) {
                    
                    $this->UM->uploadKat($kategorie);
                    
                }
                $this->session->set_flashdata('success', "Úspěšně jste vložili novou kategorii!");
                redirect('/admin/mapy');
            }
        }
        }
    }
    function novytest()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('vytvorit_test')) {
                     $this->ion_auth->error();
        } else {
            
            $nazev  = $this->input->post('nazev', TRUE);
            $otazky = $this->input->post('to', TRUE);
            
            $query      = $this->db->get_where('Test', array(
                'nazev' => $nazev
            ));
            $session_id = $this->session->userdata('user');
            $map        = $this->session->userdata('mapa');
            
            
            if ($this->session->userdata('mapa') != null && $nazev != null) {
                
                
                if ($query->num_rows() > 0) {
                    $this->session->set_flashdata('error1', "Takový test již existuje!");
                    redirect('novytest');
                } else {
                    $this->UM->NovyTest($nazev, $session_id);
                    $this->UM->MapaIntoTest($map);
                    foreach ($otazky as $key => $val) {
                        $this->UM->OtazkaIntoTest($val, null);
                    }
                    $this->session->set_flashdata('success', "Úspěšně jste vložili nový test!");
                    redirect('novytest');
                    
                }
            } else {
                $this->ion_auth->error("Žádné data pro vytvoření testu!");
            }
            
            $this->session->unset_userdata('user');
            $this->session->unset_userdata('mapa');
        }
    }
    //úprava testu formulář
    function upravaTestuDone()
    {
        $nazev  = $this->input->post('nazev', TRUE);
        $otazky = $this->input->post('to', TRUE);
        $test   = $this->session->userdata('test');
        $query  = $this->db->get_where('Test', array(
            'idTest' => $test
        ));
        
        
        $this->form_validation->set_rules('nazev', 'Název', 'trim|required');
        if ($this->form_validation->run() == TRUE && $query->num_rows() > 0) {
            
            
            $this->MainModel->testName($test, $nazev);
            $this->MainModel->otTestDel($test);
            foreach ($otazky as $key => $val) {
                
                $this->UM->OtazkaIntoTest($val, $test);
            }
            
            
            $this->session->set_flashdata('success',$this->config->item('error_test_edit'));
            $this->MainModel->smazaniLimitu($test);
            redirect('testy');
        } else {
             $this->session->set_flashdata('error', $this->config->item('error_hlavni'));
         redirect('testy');
        }
        
    }
    function novaotazka()
    {
        if (!$this->ion_auth_acl->has_permission('access_admin') && !$this->ion_auth_acl->has_permission('test_nova_otazka')) {
                     $this->ion_auth->error();
        } else {
            $pocet = 0;
            
            
            
            $otazka = $this->input->post('otazka', TRUE);
            $pocet  = $this->input->post('pocet', TRUE);
            $query  = $this->db->get_where('Otazka', array(
                'Otazka' => $otazka
            ));
            
            
            
            
            
            
            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('error', "Taková otázka již existuje :(");
                redirect('novytest');
            } else {
                $spravna = $this->input->post('odpoved1', TRUE);
                $this->UM->novaotazka($otazka);
                $this->UM->novaodpoved($spravna, 1);
                
                
                for ($i = 2; $i <= $pocet; $i++) {
                    
                    $odpoved[$i] = $this->input->post('odpoved' . $i, TRUE);
                    $this->UM->novaodpoved($odpoved[$i], 0);
                    
                }
                
                
                
                foreach ($this->input->post('kategorie') as $kategorie) {
                    
                    $this->UM->uploadKatOtazky($kategorie);
                    
                }
                
                //  $this->MM->novaotazka($nazev);   
                $this->session->set_flashdata('success', "Úspěšně jste vložili novou otázku!");
                redirect('novytest');
            }
            
        }
    }
    
    
    
    function vyhodit($id)
    {
        
        $trida=$this->ProfilM->myclass($id);
        if($trida->majitel==$this->session->userdata('user_id'))
       {
         $this->ProfilM->deleteTrida($id);
        $this->session->set_flashdata('success', 'Úspěšně jste vyhodili žáka ze třídy!');
        redirect('/zacitrida/'.$trida->idTrida);
    }else {
       $this->ion_auth->error();
    }
       
        
        
    }
    
    
    
    function tabulkaT($id)
    {
        
        
        //zavoláme metodu jen když je uživatel žákem
        
        $this->ProfilM->deleteTrida($id);
        
        $this->session->set_flashdata('success', 'Úspěšně jste opustili třídu!');
        redirect('profil/trida');
        
        
    }
    function success()
    {
        
        
        $data["title"] = "Upload";
        $data["main"]  = "upload_success";
        
        
        $this->layout->generate($data);
    }
    
    function delTest($id)
    {
        $query = $this->db->get_where('Test', array(
            'idTest' => $id
        ));
        
        
        $data["test"] = $this->MainModel->test($id);
        if ($query->num_rows() > 0) {
            
            if ($this->session->userdata('user_id') == $data["test"]["users_id"] || $this->ion_auth_acl->has_permission('access_admin')) {
                
                  $this->session->set_flashdata('success', $this->config->item('error_test_delete'));
                $this->MainModel->testDel($id);
                redirect('/testy');
            } else {
                         $this->ion_auth->error();
            }
        }
        
        
    }
    //editace testu, každý test může být editovat jen učitelem co ho vytvořil nebo administrátorem  
    function editTest($id)
    {
        
        
        $kategorieMapy = $this->MainModel->kategorieTestu($id);
        $data["title"] = "Editace testu";
        $data["test"]  = $this->MainModel->test($id);
        if ($this->session->userdata('user_id') == $data["test"]["users_id"] || $this->ion_auth_acl->has_permission('access_admin')) {
            foreach ($kategorieMapy as $value) {
                $kategorie[] = $value->Kategorie_idKategorie;
            }
            if (isset($kategorie))
                $otaz = $this->MainModel->otazkyNacteni2($kategorie);
            
            $otazkyvtestu  = $this->TestModel->nacteniOtazek($id);
         
            
            
            
            foreach ($otazkyvtestu as $val) {
                $poleA[$val->idOtazka] = $val->Otazka;
            }
            
            foreach ($otaz as $val) {
                $poleB[$val->idOtazka] = $val->Otazka;
            }
            
            $result            = array_diff($poleB, $poleA);
            $data['user']      = $this->ion_auth->user()->row();
            $data["OtazkyNVT"] = $result;
            $this->session->set_userdata('test', $id);
            $data["OtazkyVT"] = $otazkyvtestu;
            
            $data["main"] = "admin/upravatestu";
            $data["kat"]  = $this->MainModel->kategorieMap($kategorie);
            $this->layout->generate($data);
            //  $this->layout->generate($data);
        } else {
                     $this->ion_auth->error();
        }
    }
     public function overeni($str)
        {
                if (!preg_match('/^[a-zA-Z0-9 .,\-]+$/i',$str))
                {
                      
                  
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
}