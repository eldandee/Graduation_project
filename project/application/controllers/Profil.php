<?php
class Profil extends CI_Controller
{
    //put your code here
    private $userId;
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ProfilM');
        
        $this->load->model('MainModel');
        $this->load->library('mjqa');
        
        if (!$this->ion_auth->logged_in()) {
            redirect('/login');
        }
        $this->userId = $this->session->userdata('user_id');
    }
    function profilMain()
    {
        
        $id            = $this->session->userdata('user_id');
        $data["title"] = "Uživatelský profil";
        
        
        
        $data["profil"] = $this->ProfilM->profil($id);
        
        //zavoláme metodu jen když je uživatel žákem
        
        $data["trida"] = $this->ProfilM->myclass($id);
        
        $data["skola"]    = $this->MainModel->skolaUzivatele($id);
        $data["vysledky"] = $this->ProfilM->vysledekP($id);
        
        $data["main"] = "uzivatel/profil";
        $this->layout->generate($data);
        
        
    }
    function profilVysledky()
    {
        
        
        $data["title"] = "Moje výsledky";
        
        
        $data["vysledky"] = $this->ProfilM->vysledekP($this->userId);
        
        $data["main"] = "uzivatel/moje_vysledky";
        $this->layout->generate($data);
        
        
    }
    function strankovani()
    {
        
        
        $config                = array();
        $config["base_url"]    = base_url() . "/profil/mojevysledky";
        $config["total_rows"]  = $this->ProfilM->pocetVysledku($this->userId);
        $config["per_page"]    = 7;
        $config["uri_segment"] = 3;
        
        
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        
        $this->pagination->initialize($config);
        
        $page               = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["vysledky"]   = $this->ProfilM->fetch_karticky($config["per_page"], $page, $this->userId);
        $data["pagination"] = $this->pagination->create_links();
        
        $data["main"] = "uzivatel/moje_vysledky";
        
        
        $data["title"] = "Moje výsledky";
        
        $this->layout->generate($data);
    }
    function profilTrida()
    {
        if ($this->ion_auth->is_admin()||$this->ion_auth->is_ucitel()) {
           $this->ion_auth->error();
        }else{
        //normální uživatel
        $id            = $this->session->userdata('user_id');
        $data["title"] = "Moje třída";
        
        $data["tridy"]   = $this->MainModel->tridydaneskoly($this->MainModel->skolaUzivatele($id)->Skola_idSkoly);
        $data["zadosti"] = $this->MainModel->mojezadosti($id);
        
        
        
        
        
        //zavoláme metodu jen když je uživatel žákem
        
        $data["trida"] = $this->ProfilM->myclass($id);
        
        
        
        
        $data["main"] = "uzivatel/trida";
        $this->layout->generate($data);
        } 
        
    }
    //metoda není využita, protože by žák mohl měnit třídy jak by chtěl
    function profilJoinTrida($trida)
    {
          if ($this->ion_auth->is_admin()||$this->ion_auth->is_ucitel()) {
           $this->ion_auth->error();
        }else{
            
       
        $id = $this->session->userdata('user_id');
        $this->ProfilM->joinTrida($id, $trida);
        $this->session->set_flashdata('success', 'Úspěšně jste se přidali do třídy!');
        redirect('profil/trida', 'refresh');
        }
    }
    function profilDelete()
    {
        if ($this->ion_auth->is_admin()||$this->ion_auth->is_ucitel()) {
           $this->ion_auth->error();
        
            
            
        } else {
            //normální opustí třídu
            $id = $this->session->userdata('user_id');
            
            //zavoláme metodu jen když je uživatel žákem
            
            $this->ProfilM->deleteTrida($id);
            
            $this->session->set_flashdata('success', 'Úspěšně jste opustili třídu!');
            redirect('profil/trida', 'refresh');
        }
        
        
    }
    function zrusitzadost()
    {
          if ($this->ion_auth->is_admin()||$this->ion_auth->is_ucitel()) {
           $this->ion_auth->error();
          }else{
        $id = $this->session->userdata('user_id');
        $this->ProfilM->zrusitzadost($id);
        $this->session->set_flashdata('success', 'Úspěšně jste zrušili žádost!');
        redirect('profil/trida');
          }
    }
    
    function zadostoprijeti($trida)
    {
        
        
        
       if ($this->ion_auth->is_admin()||$this->ion_auth->is_ucitel()) {
           $this->ion_auth->error();
          }else{
            
            $id = $this->session->userdata('user_id');
            
            //prvni zkontroluju jestli daná třída existuje
            $query = $this->db->get_where('Trida', array(
                'idTrida' => $trida
            ));
            
            
            //potom zkontroluju jestli už nemá žádost o přijetí
            $query2 = $this->db->get_where('Zadosti', array(
                'users_id' => $id
            ));
            
            
            if ($query->num_rows() > 0 && $query2->num_rows() == 0) {
                //když projdou podmínky že třída existuje a žák nemá další žádosti
                // tak se odešlou data do do modelu který danou žádost zapíše
                $this->MainModel->zadostoprijeti($id, $trida);
                
                $this->session->set_flashdata('success', "Úspěšně jste odeslali žádost!");
                redirect('profil/trida');
                
                
            }
            
        }
    
    }
    
    
    
    
    function novaprofilovka()
    {
        $config['upload_path'] = './profilovky/';
        $config['file_name']     = time();
        $config['allowed_types'] = 'jpg|png';
        $id                      = $this->input->post('id');
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            $this->session->set_flashdata('error', $error['error']);
            redirect('profil/main', 'refresh');
        } else {
            $upload_data = $this->upload->data();
            $file        = $upload_data['file_ext'];
            $link        = $this->ProfilM->linkD($id);
            if ($link != null)
                unlink('.' . $link);
            $odkaz = '/profilovky/' . $config['file_name'] . '' . $file . '';
            $this->ProfilM->lovka($id, $odkaz);
            $this->session->set_flashdata('success', 'Úspěšně jste vložili fotku!');
            redirect('profil/main', 'refresh');
            
        }
        
    }
    
}