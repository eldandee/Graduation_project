<?php 
class my404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $data["title"] = "Error404";
        $data["main"] = "uzivatel/error404";
     
        

        $this->layout->generate($data);
     
    } 
} 
?> 