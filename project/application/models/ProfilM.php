<?php
class ProfilM extends CI_Model
{
     //moje trida
    function myclass($idUzivatele)
    {
      
            $this->db->select('c.majitel,c.nazev,c.idTrida');
            $this->db->from('users m'); 
            $this->db->join('Users_has_Trida b', 'b.users_id=m.id', 'left');
            $this->db->join('Trida c', 'c.idTrida=b.Trida_idTrida', 'left');
            $this->db->where('m.id',$idUzivatele);
       
         
             $query = $this->db->get();
        $profil = $query->row();
        return $profil;
    }
    function pocetVysledku($user) {
        $this->db->from('udelanyTest');
        $this->db->where('users_id',$user);
        return  $this->db->count_all_results();
    }
    public function fetch_karticky($limit, $start,$id) {
        $this->db->limit($limit, $start);
          $this->db->select('a.idudelanyTest,a.datum,b.nazev');  
       $this->db->from('udelanyTest a');
        $this->db->join('Test b', 'b.idTest=a.Test_idTest', 'left');
        $this->db->where('a.users_id', $id);
         $this->db->order_by('a.idudelanyTest','desc'); 
        
        $query = $this->db->get();
        

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
    function profil($id)
    {
        
        
          $this->db->select('c.group_id,a.id,b.odkaz,a.username,a.last_name,a.first_name,a.email,a.created_on');  
       $this->db->from('users a');
        $this->db->join('ProfileImages b', 'b.users_id=a.id', 'left');
          $this->db->join('users_groups c', 'c.user_id=a.id', 'left');
        $this->db->where('a.id', $id);

        $query = $this->db->get();
        $profil = $query->row();
        return $profil;
    }
    function vysledekP($id)
    {
        
        
          $this->db->select('a.idudelanyTest,a.datum,b.nazev');  
       $this->db->from('udelanyTest a');
        $this->db->join('Test b', 'b.idTest=a.Test_idTest', 'left');
        $this->db->where('a.users_id', $id);
         $this->db->order_by('a.idudelanyTest','desc'); 

        $query = $this->db->get();
        $vysledky = $query->result();
        return $vysledky;
    }
    function linkD($id)
    {
        
        
          $this->db->select('odkaz');  
       $this->db->from('ProfileImages');
      
        $this->db->where('users_id', $id);

        $query = $this->db->get();
        $profil = $query->row();
        if($profil!=null){
            
     
        return $profil->odkaz;
        }
    }
    function lovka($id,$odkaz)
    {
         $this->db->where('users_id',$id);
   $q = $this->db->get('ProfileImages');

   if ( $q->num_rows() > 0 ) 
   {
         $data = array(

'odkaz' => $odkaz

);
    $this->db->where('users_id', $id);
$this->db->update('ProfileImages', $data);
   } else {
          $data = array(
'users_id'=>$id,
'odkaz' => $odkaz

);
    $this->db->where('users_id', $id);
$this->db->insert('ProfileImages', $data);
   
   }
     
}

function deleteTrida($id)
{
$this->db->where('users_id', $id);
$this->db->delete('Users_has_Trida');
}
function zrusitzadost($id)
{
$this->db->where('users_id', $id);
$this->db->delete('Zadosti');
}
function joinTrida($id,$trida)
{
$data = array(
'users_id'=>$id,
'Trida_idTrida' => $trida

);

$this->db->insert('Users_has_Trida', $data);
}
}