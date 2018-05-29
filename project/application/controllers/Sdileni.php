<?php
class Sdileni extends CI_Controller
{
    
    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('ion_auth_acl');
        $this->load->model('TestModel');
        $this->load->library('mjqa');
        if($this->session->userdata("user_id")==null)      redirect('/error');

    }
      //generování tokenu pro sdílení do databáze, nejdřív zkonrolujeme jestli je to uživatel kdo vyplnil test :)
    function genShareUrlFb(){
         $idTest = $this->input->post('id');
        if($this->TestModel->uzivatelT($idTest)->id == $this->session->userdata("user_id")){
            $token = random_string('alnum', 32).$idTest;
            $this->TestModel->addHashToken($idTest, $token);
            $shareUrl = $this->config->base_url()."vysledek/".$token;
            echo(share_url('facebook',array('url'=>$shareUrl, 'text'=>'test')));
        }
    }
    
    function genShareUrlTw(){
         $idTest = $this->input->post('id');
         $user = $this->TestModel->uzivatelT($idTest);
        if($user->id == $this->session->userdata("user_id")){
            $token = random_string('alnum', 32).$idTest;
            $this->TestModel->addHashToken($idTest, $token);
            $shareUrl = $this->config->base_url()."vysledek/".$token;
            if($this->session->userdata("user_id")==null) 
            {$jmeno ="Anonym";
            }else{
               $jmeno = $user->first_name.' '.$user->last_name; 
            }
            echo(share_url('twitter', array('url'=>$shareUrl, 'text'=>$jmeno.' ', 'via'=>'GEOAUH')));
        }
    }
   
  
}