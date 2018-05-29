<?php

class Sign extends CI_Controller {
   function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
         $this->load->model('MainModel');
    }
    
    
    
    function registerUser() {
        $data["main"] = "registrUser";
        $data["skoly"]=$this->MainModel->skolyLoad();
        $data["title"] = "Registrace";
        $this->layout->generate($data);
        
    }
 function login()
   {if($this->session->userdata('username')!=null )
            redirect('/profil/main');
            $data["main"] = "uzivatel/login";
        $data["title"] = "Login";
        $this->layout->generate($data);  
   }
   function loginDone()
   {
         
       $this->data['page_title'] = 'Login';
  if($this->input->post())
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('remember','Remember me','integer');
 
    if($this->form_validation->run()===TRUE)
    {
      $remember = (bool) $this->input->post('remember');
      $this->load->library('ion_auth');
      if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
      {
        redirect('profil/main', 'refresh');
      }
      else
      {
        $this->session->set_flashdata('message',"Nesprávné uživatelské jméno nebo heslo");
        redirect('login', 'refresh');
      }
    }
  }
  $this->load->helper('form');
   redirect('login');
   }

 function registerUserFinish() {
        $this->form_validation->set_rules('firstname', 'Křestní jméno','trim|required');
        $this->form_validation->set_rules('lastname', 'Příjmení','trim|required');
        $this->form_validation->set_rules('username','Uživatelské jméno','trim|required|is_unique['.$this->config->item('tables', 'ion_auth')['users'].'.'.$this->config->item('identity', 'ion_auth').']');
        $this->form_validation->set_rules('email','Email','trim|valid_email|required');
        $this->form_validation->set_rules('password','Heslo','trim|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|required');
        $this->form_validation->set_rules('confirm','Ověření hesla','trim|matches[password]|required');

 
         if (!$this->form_validation->run())
        {
        
          
          $this->session->set_flashdata('error', validation_errors());
          redirect('/registrace');
         
   
          
         
        }
        else
        {
            
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
	   $skola = $this->input->post('skola');
		$confirm = $this->input->post('confirm');
		
		$additional_data = array(
								'first_name' => $firstname,
								'last_name' => $lastname,
								);
		$group = array('2');
        $query = $this->db->get_where('Skola', array('idSkoly' => $skola)); 
         if ($query->num_rows() > 0) {
           
        $id=$this->ion_auth->register($username, $password, $email, $additional_data, $group);
		$this->MainModel->doskoly($skola,$id);
		$this->session->set_flashdata('registrace','Gratulujeme k úspěšnému zaregistrování!');
		redirect('/login');
           }
	
        }
    } 
      
   
function logout()
{ $this->load->library('ion_auth');
  $this->ion_auth->logout();
  redirect('login', 'refresh');
}
}