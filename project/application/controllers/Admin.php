<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin.php
 *
 * @package     CI-ACL
 * @author      Steve Goodwin
 * @copyright   2015 Plumps Creative Limited
 */
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if( ! $this->ion_auth->logged_in() )
            redirect('/login');

          if( ! $this->ion_auth_acl->has_permission('access_admin') )
          {    redirect('/error');}
             $this->load->model('MainModel');
             $this->load->model('TestModel');
    }

    public function index()
    {
        redirect('/admin/manage');
    }

    public function manage()
    {
        $data["title"] = "Povolení";
        $data["main"] = "admin/manage";
        $data["admin"] = "dashboard";
         $data["page"] = "prava"; 
        $this->layout->generate($data);
       
       
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
    public function novatrida()
    {
        
         $skola=$this->session->userdata('skola');
        
         $this->form_validation->set_rules('nazev', 'nazev', 'required|trim|callback_overeni');
        $this->form_validation->set_rules('majitel', 'majitel', 'required|trim|callback_overeni');
      
        
         if( $this->form_validation->run() === FALSE )
        {
              $this->session->set_flashdata('error',"Vytvoření se nezdařilo!");
              redirect('admin/skola/'.$skola);
             }else{
              $nazev = $this->input->post('nazev', TRUE);          
              $majitel = $this->input->post('majitel', TRUE);
              $tridy= $this->MainModel->tridydaneskoly($skola);
              $vysledek=$this->MainModel->tridanaskolekontrola($skola,$nazev);
               if ($vysledek>0) {
               
                      $this->session->set_flashdata('error',"Vytvoření se nezdařilo!");
               redirect('admin/skola/'.$skola);  
                } else {
                 
                     
                  $this->MainModel->novatrida($nazev,$majitel,$skola); 
                 $this->session->set_flashdata('success',"Úspěšně jste vytvořili třídu!");
                redirect('admin/skola/'.$skola);
                
                    
                }
             
       
    }
    //$this->session->unset_userdata('skola');
    }
    function editaceotazek()
    {
     
        
        $data["title"] = "Všechny otázky";
        $data["main"] = "admin/otazky";
        $data["otazky"] =   $this->MainModel->otazkyakategorie();
     
        $this->layout->generate($data);
        
        
    }
    function editaceotazky($idOtazky)
    {
     
        
        $data["title"] = "Editace otázky";
        $data["main"] = "admin/editaceotazky";
        $data["otazka"] =   $this->TestModel->OtazkaV($idOtazky);
        $data["odpovedi"] =$this->MainModel->odpovedi($idOtazky);
        $this->session->set_userdata('otazkaedit',$data["otazka"]);
        $this->session->set_userdata('odpovediedit',$data["odpovedi"]);
        $this->layout->generate($data);
        
        
    }
    function editaceotazkyhotovo()
    {
     
      $otazka=$this->session->userdata('otazkaedit');
 
      $odpovedi=$this->session->userdata('odpovediedit');  
      
      $this->form_validation->set_rules($otazka->idOtazka, 'otazka', 'required|trim'); 
      
      foreach($odpovedi as $value)
      {
          $this->form_validation->set_rules($value->idOdpovedi, 'odpovedi', 'required|trim'); 
      }
      
       if( $this->form_validation->run() === FALSE )
        {
            
          $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
          redirect('/vsechnyotazky'); 
        }else{
              foreach($odpovedi as $value)
      {
        $this->MainModel->editodpovedi($value->idOdpovedi,$this->input->post($value->idOdpovedi, TRUE));
      }
        $this->MainModel->editotazky($otazka->idOtazka,$this->input->post($otazka->idOtazka, TRUE));
       
       $this->session->set_flashdata('success', $this->config->item('error_edit_success'));
       redirect('/vsechnyotazky');
        }
       
    
    }
 
 
     function vytvoreniskoly()
    {
     
        
          $this->form_validation->set_rules('nazev', 'nazev', 'required|trim|is_unique[Skola.nazev]|callback_overeni');
    
        
           if( $this->form_validation->run() === FALSE )
        {
              $this->session->set_flashdata('error',"Vytvoření se nezdařilo!");
              redirect('admin/skoly');
        }else{
        
        
            $nazev = $this->input->post('nazev', TRUE);
            $this->MainModel->novaskola($nazev);
            $this->session->set_flashdata('success', "Úspěšně jste vytvořili školu!");
            redirect('admin/skoly');
        }
        
        
    }
    
    function editskola($idSkola)
    {
     
          $data["title"] = "Úpráva školy";
            $data["page"]  = "skoly";
            $data["skola"] = $this->MainModel->skolaLoad($idSkola);
            $data["admin"]  = "dashboard";
                $data["main"]   = "admin/editaceskoly";
                $this->layout->generate($data);

        
        
    }
    function editskolahotovo($idSkola)
    {
     
          $this->form_validation->set_rules('nazev', 'Název', 'trim|required');
              
                 if ($this->form_validation->run() == false) {
               
                  $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
                          redirect('/admin/skoly');
                 }else{
                    $nazev=$this->input->post('nazev', TRUE);
                    //nemůže se jmenovat jako žádná jiná ale nemůžu použit is unique protože by to našlu samu starou kategorii
                    $skoly=$this->MainModel->skolyLoad();
                    
                    foreach($skoly as $value)
                    {
                        $vsechnySkoly[$value->idSkoly]=$value->nazev;
                        
                        
                    }
                   //pro kontrolu tedy musím smazat editovanou kategorii a ověřit jestli není název ostatních takový
                    unset($vsechnySkoly[$idSkola]);
                    if(array_search($nazev,$vsechnySkoly)==false)
                    {
                        $this->MainModel->editskoly($idSkola,$nazev);
                        $this->session->set_flashdata('success', $this->config->item('error_edit_success'));
                          redirect('/admin/skoly');
                        
                    }else{
                          $this->session->set_flashdata('error', $this->config->item('error_edit_failure'));
                          redirect('/admin/skoly');
                    }

        
        
    }
    }
      function upravatridy($id)
    {
            $data["title"] = "Uprava tridy";
            $data["page"]  = "skoly";
            $data["skola"] = $this->MainModel->skolatridy($id);
            $data["info"]  = $this->MainModel->trida($id);
            
            if ($data["skola"] == null && $data["info"] == null) {
                
                $this->ion_auth->error($this->config->item('error_trida'));
               
            } else {
                $this->session->set_userdata('trida',$id);
                $ucitele        = $this->MainModel->nacteniucitelu($data["skola"]->idSkoly);
                $data["ucitel"] = $this->MainModel->info($ucitele);
                $data["admin"]  = "dashboard";
                $data["main"]   = "admin/upravatridy";
                $this->layout->generate($data);
            }
        
        
    }
     function deaktivaceMapy($id)
    {
         if($this->MainModel->mapyDleKategorieDruhaCast($id)!=null)
         {
            $this->MainModel->mapaAktivaceADeaktivace($id,1);
                $this->session->set_flashdata('success',"Úspěšně jste deaktivovali mapu!");
                redirect('/naucnemapy');
            
         }else{
             $this->ion_auth->error();
         }
            
        
        
    }
    function neaktivnimapy()
    {
          $data["title"] = "Neaktivní mapy";
        $data["mapy"]=$this->MainModel->mapyNeaktivni();
        $data["main"]   = "admin/neaktivnimapy";
        $this->layout->generate($data);
        
    }
    
     function aktivaceMapy($id)
    {
         if($this->MainModel->mapaNacteni($id)!=null)
         {
           $this->MainModel->mapaAktivaceADeaktivace($id,0);
                $this->session->set_flashdata('success',"Úspěšně jste aktivovali mapu!");
                redirect('/naucnemapy');
            
         }else{
             $this->ion_auth->error();
         }
            
        
        
    }
    
     function smazanitridy($id)
    {
            $data["title"] = "Smazani tridy";
            $data["page"]  = "skoly";
         
            $data["info"]  = $this->MainModel->trida($id);
            
            if ($data["info"] == null) {
                
                $this->ion_auth->error($this->config->item('error_trida'));
               
            } else {
                $data["admin"]  = "dashboard";
                $data["main"]   = "admin/smazanitridy";
                $this->layout->generate($data);
            }
        
        
    }
     function smazanitridyHotovo($id)
    {
         
      $this->form_validation->set_rules('confirm', 'Confirm', 'required');
      
          $skola = $this->MainModel->skolatridy($id); 
        if ($this->form_validation->run() == FALSE) {
       
          
       
            if ($skola == null) {
                
                $this->ion_auth->error($this->config->item('error_trida'));
               
            }else{
                $this->session->set_flashdata('error',"Smazani se nezdařilo!");
                redirect('admin/skola/'.$skola->idSkoly);  
            }
            
        } else {
          if($this->MainModel->trida($id)!=null&&($this->input->post('confirm')=='yes'))
          {
             $this->MainModel->smazanitridy($id);
             $this->session->set_flashdata('success',"Smazani bylo úspěšné");
             redirect('admin/skola/'.$skola->idSkoly);  
          }else{
            redirect('admin/skola/'.$skola->idSkoly);     
          }
        }
        
        
    }
    
    
    
    
    public function permissions()
    {
        $data['permissions']    =   $this->ion_auth_acl->permissions('full');
        $data["title"] = "Povolení";
        $data["main"] = "admin/permissions";
        $data["page"] = "prava"; 
        $data["admin"] = "dashboard";
        $this->layout->generate($data);
      

     
    }


    public function skola($idskoly=null)
    {
        //když by uživatel nahoře v adrese smazal id skoly tak aby to neházelo chybu
        $data["title"] = "Informace o škole";
        $data["main"] = "admin/skola";
        $data["tridy"] = $this->MainModel->tridydaneskoly($idskoly);
         $data["ucitelee"] = $this->MainModel->nacteniucitelu($idskoly); 
         $ucitele= $this->MainModel->nacteniucitelu($idskoly); 
         
      
        
     
        if($ucitele!=null)
        {
            foreach ($ucitele as $key =>$value) {
               $data["ucitele"][] = $this->MainModel->info($value);
        }
           $this->session->set_userdata('skola',$idskoly);
        }else{
            $data["ucitele"]=null;
        }
     
        $data["admin"] = "dashboard";
         $data["page"] = "skoly"; 
       
        $this->layout->generate($data);
       
       
    }

  function zmenatridyDone(){

        
 

    $idTridy=$this->session->userdata('trida');
        $this->form_validation->set_rules('nazev', 'nazev', 'required|trim|callback_overeni');
        $this->form_validation->set_rules('majitel', 'majitel', 'required|trim|callback_overeni');
          $skola=$this->MainModel->skolatridy($idTridy);
        
         if( $this->form_validation->run() === FALSE )
        {
              $this->session->set_flashdata('error',"Úprava třídy se nezdařila!");
              redirect('admin/skola/'.$skola->idSkoly);
        }else{
            
             $nazev = $this->input->post('nazev', TRUE);          
             $majitel = $this->input->post('majitel', TRUE); 
                 
             $ucitele = $this->MainModel->nacteniucitelu($skola->idSkoly); 
             $maj[]=$majitel;
             $naz[]=$nazev;
             $result = array_intersect($maj, $ucitele);
             
             //zkontrolujeme jestli uživatel nepřepsal value ze selectu
             $vysledek=$this->MainModel->tridanaskolekontrola2($skola->idSkoly,$nazev,$idTridy);
          
             if(!count($result)==0&&$vysledek==null)
             {
                 
                
             $this->MainModel->zmenatridy($idTridy,$nazev,$majitel);
               $this->session->set_flashdata('success',"Úspěšně jste změnili třídu!");
              
             }else{
                    $this->session->set_flashdata('error',"Třída nebyla změněna!");
              
             }
            redirect('admin/skola/'.$skola->idSkoly);  
            

     
        }
           
        $this->session->unset_userdata('trida');
       
    }

    public function add_permission()
    {
        if( $this->input->post() && $this->input->post('cancel') )
            redirect('/admin/permissions', 'refresh');

        $this->form_validation->set_rules('perm_key', 'key', 'required|trim');
        $this->form_validation->set_rules('perm_name', 'name', 'required|trim');

        $this->form_validation->set_message('required', 'Please enter a %s');

        if( $this->form_validation->run() === FALSE )
        {
            $data['message'] = ($this->ion_auth_acl->errors() ? $this->ion_auth_acl->errors() : $this->session->flashdata('message'));

   
            
             
        $data["title"] = "Přidat povolení";
        $data["main"] = "admin/add_permission";
         $data["admin"] = "dashboard";
         $data["page"] = "prava"; 

        $this->layout->generate($data);
        }
        else
        {
            $new_permission_id = $this->ion_auth_acl->create_permission(strtolower($this->input->post('perm_key')), $this->input->post('perm_name'));
            if($new_permission_id)
            {
                // check to see if we are creating the permission
                // redirect them back to the admin page
                $this->session->set_flashdata('success','Uspěšně jste vytvořili nové oprávnění!');
                redirect("/admin/permissions");
            }
        }
    }

    public function update_permission()
    {
        if( $this->input->post() && $this->input->post('cancel') )
            redirect('admin/permissions', 'refresh');

        $permission_id  =   $this->uri->segment(3);

        if( ! $permission_id )
        {
            $this->session->set_flashdata('message', "No permission ID passed");
            redirect("admin/permissions");
        }

        $permission =   $this->ion_auth_acl->permission($permission_id);

        if( $permission==null){
        $this->ion_auth->error($this->config->item('error_pravo'));
        }else{
        $this->form_validation->set_rules('perm_key', 'key', 'required|trim');
        $this->form_validation->set_rules('perm_name', 'name', 'required|trim');

        $this->form_validation->set_message('required', 'Please enter a %s');

        if( $this->form_validation->run() === FALSE )
        {
            $data['message']    = ($this->ion_auth_acl->errors() ? $this->ion_auth_acl->errors() : $this->session->flashdata('message'));
            $data['permission'] = $permission;
              $data["title"] = "Úprava oprávnění";
          $data["main"] = "admin/edit_permission";
         $data["admin"] = "dashboard";
         $data["page"] = "prava"; 

        $this->layout->generate($data);
         
        }
        else
        {
            $additional_data    =   array(
                'perm_name' =>  $this->input->post('perm_name')
            );

            $update_permission = $this->ion_auth_acl->update_permission($permission_id, $this->input->post('perm_key'), $additional_data);
            if($update_permission)
            {
                // check to see if we are creating the permission
                // redirect them back to the admin page
                $this->session->set_flashdata('success', $this->config->item('error_edit_success'));
                redirect("/admin/permissions");
            }
        }
        }
    }

    public function delete_permission()
    {
        if( $this->input->post() && $this->input->post('cancel') )
            redirect('/admin/permissions', 'refresh');

        $permission_id  =   $this->uri->segment(3);

        if( ! $permission_id )
        {
            $this->session->set_flashdata('message', "No permission ID passed");
            redirect("admin/permissions");
        }

        if( $this->input->post() && $this->input->post('delete') )
        {
            if( $this->ion_auth_acl->remove_permission($permission_id) )
            {
                $this->session->set_flashdata('error', 'Uspěšně smazáno oprávnění!');
                redirect("admin/permissions");
            }
            else
            {
                echo $this->ion_auth_acl->messages();
            }
        }
        else
        {
             $data["admin"] = "dashboard";
         $data["page"] = "prava"; 
        $data['message'] = ($this->ion_auth_acl->errors() ? $this->ion_auth_acl->errors() : $this->session->flashdata('message'));
        $data["title"] = "Smazat oprávnění";
        $data["main"] = "/admin/delete_permission";
        $this->layout->generate($data);
           
        }
    }
    function skoly()
    {
      
        $data["title"] = "Školy";
        $data["main"]  = "admin/skoly";
        $data["admin"] = "dashboard";
        if ($this->session->userdata('skola') != null)
            $this->session->unset_userdata('skola');
        
        $data["page"]  = "skoly";
        $data["skoly"] = $this->MainModel->vsechnyskoly();
        
        
        $this->layout->generate($data);
        
        
    }
   
    public function groups()
    {
         $data["admin"] = "dashboard";
         $data["page"] = "prava"; 
        $data['groups'] = $this->ion_auth->groups()->result();
        $data["title"] = "Skupiny";
        $data["main"] = "/admin/groups";
        

        $this->layout->generate($data);
    
    }

    public function group_permissions()
    {
        if( $this->input->post() && $this->input->post('cancel') )
            redirect('/admin/groups', 'refresh');

        $group_id  =   $this->uri->segment(3);

        if( ! $group_id )
        {
            $this->session->set_flashdata('message', "No group ID passed");
            redirect("admin/groups");
        }

        if( $this->input->post() && $this->input->post('save') )
        {
            foreach($this->input->post() as $k => $v)
            {
                if( substr($k, 0, 5) == 'perm_' )
                {
                    $permission_id  =   str_replace("perm_","",$k);

                    if( $v == "X" )
                        $this->ion_auth_acl->remove_permission_from_group($group_id, $permission_id);
                    else
                        $this->ion_auth_acl->add_permission_to_group($group_id, $permission_id, $v);
                }
            }

            redirect('/admin/groups', 'refresh');
        }
       $data["admin"] = "dashboard";
         $data["page"] = "prava"; 
        $data['permissions']            =   $this->ion_auth_acl->permissions('full', 'perm_key');
        $data['group_permissions']      =   $this->ion_auth_acl->get_group_permissions($group_id);
      
          $data["title"] = "Skupiny oprávnění";
        $data["main"] = "/admin/group_permissions";
        

        $this->layout->generate($data);
        
    }

    public function users()
    {
         $data["admin"] = "dashboard";
         $data["page"] = "prava"; 
        $data['users']  =   $this->ion_auth->users()->result();
         $data["title"] = "Uživatelé";
        $data["main"] = "/admin/users";
        

        $this->layout->generate($data);
       
    }

    public function manage_user()
    {
        $user_id  =   $this->uri->segment(3);

        if( ! $user_id )
        {
            $this->session->set_flashdata('message', "No user ID passed");
            redirect("admin/users");
        }
         $data["admin"] = "dashboard";
         $data["page"] = "prava"; 

        $data['user']               =   $this->ion_auth->user($user_id)->row();
        
          if(  $data['user'] ==null){
            $this->ion_auth->error($this->config->item('error_uzivatel'));
        }else{
        $data['user_groups']        =   $this->ion_auth->get_users_groups($user_id)->result();
        $data['user_acl']           =   $this->ion_auth_acl->build_acl($user_id);
        $data["title"] = "Upravit uživatele";
        $data["main"] = "/admin/manage_user";
        

        $this->layout->generate($data);
       
    }
        
    }
   

    public function user_permissions()
    {
        $user_id  =   $this->uri->segment(3);

        if( ! $user_id )
        {
            $this->session->set_flashdata('message', "No user ID passed");
            redirect("admin/users");
        }

        if( $this->input->post() && $this->input->post('cancel') )
            redirect("/admin/manage_user/{$user_id}");


        if( $this->input->post() && $this->input->post('save') )
        {
            foreach($this->input->post() as $k => $v)
            {
                if( substr($k, 0, 5) == 'perm_' )
                {
                    $permission_id  =   str_replace("perm_","",$k);

                    if( $v == "X" )
                        $this->ion_auth_acl->remove_permission_from_user($user_id, $permission_id);
                    else
                        $this->ion_auth_acl->add_permission_to_user($user_id, $permission_id, $v);
                }
            }

            redirect("/admin/manage_user/{$user_id}");
        }

        $user_groups    =   $this->ion_auth_acl->get_user_groups($user_id);
         $data["admin"] = "dashboard";
         $data["page"] = "prava"; 
        $data['user_id']                =   $user_id;
        $data['permissions']            =   $this->ion_auth_acl->permissions('full', 'perm_key');
        $data['group_permissions']      =   $this->ion_auth_acl->get_group_permissions($user_groups);
        $data['users_permissions']      =   $this->ion_auth_acl->build_acl($user_id);
        $data["title"] = "Správa uživatele";
        $data["main"] = "/admin/user_permissions";
        

        $this->layout->generate($data);
      
    }

}