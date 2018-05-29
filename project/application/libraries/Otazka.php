<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//MM questions and answers library
class Otazka
  {
    protected $Otazka;
    protected $Odpovedi;
    public function __construct($ot = array(), $odp = array())
      {
        $this->Otazka   = $ot;
        $this->Odpovedi = $odp;
      }
      
    //To sem zkoušel jak funguje volání v knihovně ;)
    public function getA()
      {
        return $this->Otazka;
      }
      
    public function getB()
      {
        return $this->Odpovedi;
      }
      
   
   
  }