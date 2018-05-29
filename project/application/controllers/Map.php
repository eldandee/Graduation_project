<?php




	


class Map extends CI_Controller {

function __construct() {
        parent::__construct();
     $this->load->library('ion_auth');
     	$this->load->library('googlemaps');
     	$this->load->model('MainModel');
    }

public function mapy($id)
	{
             $data['mapa'] =$this->MainModel->mapaNacteni($id);
      
	$config['kmlLayerURL'] =base_url().'/mapy/'.$data['mapa']['Odkaz'];
  
	$this->googlemaps->initialize($config);
	$data['map'] = $this->googlemaps->create_map();

	   $data["main"] = "mapy";
        $data["title"] = "Mapa";
        $this->layout->generate($data);
     
	
}
}
