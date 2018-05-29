<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
     
        $this->load->model('TestModel');
        $this->load->model('ProfilM');
        $this->load->model('MainModel');
    }
    
    public function index()
    {
           if (!$this->ion_auth_acl->has_permission('access_admin'))
           {$this->ion_auth->error();}else{
               
       
   
        $data["main"]  = "admin/dashboard/vwDashboard";
        $data["title"] = "Dashboard";
        $data["admin"] = "admin";
        
        $data["page"]       = "dashboard";
        $data["pocetLidi"]  = $this->MainModel->pocetLidi(); //počet zaregistrovaných uživatelů
        $data["pocetMap"]   = $this->MainModel->pocetMap(); //počet map na serveru
        $data["pocetTestu"] = $this->MainModel->pocetTestu(); //počet vytvořených testů
        $this->layout->generate($data);
           } 
      
    }
    
    
    
    
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */