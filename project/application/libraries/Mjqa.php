<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

// MJ questions and answers library

class Mjqa

{
	protected $CI;
	public	function __construct()
	{
		$this->CI = & get_instance();

		// abychom mohli volat i jiné knihovny

		$this->CI->load->helper('url');
		$this->CI->load->model('TestModel');
		$this->CI->load->library('otazka');
		$this->CI->load->model('MainModel');
	}



	public	function zavolatTest($idTest, $stat = null)
	{
		if ($stat == 1) {
			$otazky = $this->CI->TestModel->nacteniOtazekStat($idTest);
		}
		else {
			$otazky = $this->CI->TestModel->nacteniOtazek($idTest);
		}

		foreach($otazky as $value) {
			$var[] = array(
				'idOtazka' => $value->idOtazka,
				'otazka' => $value->Otazka
			);
		}

		if (isset($var)) {
			$pocet = count($var);
			for ($i = 0; $i < $pocet; $i++) {
				$aa[] = $this->CI->TestModel->odpovedi($var[$i]["idOtazka"]);
			}

			for ($i = 0; $i < $pocet; $i++) {
				$objekt[$i] = new Otazka($var[$i], $aa[$i]);
			}

			return $objekt;
		}
	}

	public	function statistikaSkoly($idSkoly)
	{

		// tak první dostanu uzivatele dané skoly

		$zaci = $this->CI->TestModel->skolaZaci($idSkoly);
		if ($zaci != null) {
			foreach($zaci as $value) {
				$zaciS[] = $value->users_id;
			}

			$testy = $this->CI->TestModel->testyList();
			foreach($testy as $value) {
				$udelaneTesty[$value->idTest] = $this->CI->TestModel->statistikaOtazkyB($value->idTest, $zaciS);
				$celkem = 0;
				foreach($udelaneTesty[$value->idTest] as $val) {
					$a = $this->pocetProcent($val->idUdelanyTest);
					$celkem = $celkem + $a["uspesnost"];
				}

				if (count($udelaneTesty[$value->idTest]) != 0) {
					$data["procenta"][$value->idTest] = $celkem / count($udelaneTesty[$value->idTest]);
				}
				else {
					$data["procenta"][$value->idTest] = "zadne";
				}
			}

			return $data["procenta"];
		}
		else {
			return null;
		}
	}
	
	public function statistikaTridy($idTridy)
	{

		// tak první dostanu uzivatele dané skoly

		$zaci = $this->CI->MainModel->uzInClass($idTridy);
		if ($zaci != null) {
			foreach($zaci as $value) {
				$zaciS[] = $value->users_id;
			}

			$testy = $this->CI->TestModel->testyList();
			foreach($testy as $value) {
				$udelaneTesty[$value->idTest] = $this->CI->TestModel->statistikaOtazkyB($value->idTest, $zaciS);
				$celkem = 0;
				foreach($udelaneTesty[$value->idTest] as $val) {
					$a = $this->pocetProcent($val->idUdelanyTest);
					$celkem = $celkem + $a["uspesnost"];
				}

				if (count($udelaneTesty[$value->idTest]) != 0) {
					$data["procenta"][$value->idTest] = $celkem / count($udelaneTesty[$value->idTest]);
				}
				else {
					$data["procenta"][$value->idTest] = "zadne";
				}
			}

			return $data["procenta"];
		}
		else {
			return null;
		}
	}

	public function pocetProcent($id)
	{
		$vys = $this->vysledekTestu($id);
		$spravne = 0;
		$pocet = 0;
		$nezod = 0;
		if (!empty($vys["ot"])) {
			foreach($vys["ot"] as $a) {
				$pocet++;
				if ($a["Spravna"] == 1) $spravne++;
			}

			$data["ota"] = $vys["ot"];
		}

		if ($pocet != 0) {
			$uspesnost = (($spravne / ($pocet)) * 100);
		}
		else {
			$uspesnost = 0;
		}

		$data["uspesnost"] = $uspesnost;
		return $data;
	}

	public	function vysledekTestu($id)
	{
		$otazky = $this->CI->TestModel->otazkyVyhodnoceni($id);
		if ($otazky != null) {
			foreach($otazky as $value) {
				if ($value->Odpoved_idOdpovedi != null) {
					$vys["a"][$value->Otazka_idOtazka] = $this->CI->TestModel->OdpovedV($value->Odpoved_idOdpovedi);
				}
				$vys["b"][$value->Otazka_idOtazka] = $this->CI->TestModel->OtazkaV($value->Otazka_idOtazka);
			}

			$var["uzivatel"] = $this->CI->TestModel->uzivatelT($id);
			foreach($vys["b"] as $key => $a) {
				if (isset($vys["a"][$key]->text)) $var["ot"][] = array(
					'Otazka' => $vys["b"][$key]->Otazka,
					'Odpoved' => $vys["a"][$key]->text,
					'Spravna' => $vys["a"][$key]->spravna
				);
				else {
					$var["ot"][] = array(
						'Otazka' => $vys["b"][$key]->Otazka,
						'Odpoved' => "Nezodpovězeno",
						'Spravna' => "2"
					);
				}
			}

			return $var;
		}
		else {
			return null;
		}
	}

	// statistika otazky jednotlivých testů

	public function statistikaOtazekVTestu($idTestu)
	{
		$test = $this->zavolatTest($idTestu, 1);
     	$udelaneTesty = $this->CI->TestModel->statistikaOtazkyA($idTestu);
		$spravne = 0;
		$pocet = 0;
		foreach($udelaneTesty as $val) {
			$udelane[] = $val->idUdelanyTest;
		}

		if (isset($udelane)) {
		     	for ($i = 0; $i < count($test); $i++) {
				$array = $test[$i]->getA();
				$array2 = $test[$i]->getB();
				$celkem = 0;
				foreach($array2 as $kek) {
					$stat[$array["idOtazka"]][$kek->idOdpovedi]['spravne'] = $this->CI->TestModel->odpovediStatistika($udelane, $kek->idOdpovedi);
					$celkem = $celkem + $stat[$array["idOtazka"]][$kek->idOdpovedi]['spravne'];
				}

				foreach($array2 as $kek) {
					$stat[$array["idOtazka"]][$kek->idOdpovedi]['otaz'] = $array["otazka"];
					$stat[$array["idOtazka"]][$kek->idOdpovedi]['spravne'] = $this->CI->TestModel->odpovediStatistika($udelane, $kek->idOdpovedi);
					$stat[$array["idOtazka"]][$kek->idOdpovedi]['textaspravne'] = $this->CI->TestModel->OdpovedV($kek->idOdpovedi);
					$pocet = $pocet + $stat[$array["idOtazka"]][$kek->idOdpovedi]['spravne'];
					if ($stat[$array["idOtazka"]][$kek->idOdpovedi]['textaspravne']->spravna == 1) $spravne = $spravne + $stat[$array["idOtazka"]][$kek->idOdpovedi]['spravne'];
					if ($celkem == 0) {
						$stat[$array["idOtazka"]][$kek->idOdpovedi]['vproc'] = 0;
					}
					else {
						$stat[$array["idOtazka"]][$kek->idOdpovedi]['vproc'] = ($stat[$array["idOtazka"]][$kek->idOdpovedi]['spravne'] / $celkem * 100);
					}
				}
			}

			return $stat;
		}
	}

	public function kontrolaTestu($otazky, $idT)
	{
		$pocet = 0;
		foreach($otazky as $ot) {
			$ota = $this->CI->TestModel->kontrolaTest($ot, $idT);
			if (count($ota) != 0) $pocet++;
		}

		if (count($otazky) == $pocet) {
			return true;
		}
		else {
			return false;
		}
	}
		//$trida = $this->CI->TestModel->myclass($idUzivatele);
	//	$pocet = $this->CI->TestModel->pocetOtazek($idTestu);

	public function vyhodnoceni($idTestu, $data, $idUzivatele, $otazky)
	{
	
		$ota = $this->CI->TestModel->nacteniOtazek($idTestu);
		$vyslednyTest = $this->CI->TestModel->novyzaznam($idTestu, $idUzivatele);
		if ($data != null) {
			foreach($data as $key => $val) {
				$var2[] = (string)$key;
			}

			// konec porovnávání

			if (isset($otazky) && isset($var2)) {
				$result = array_diff($otazky, $var2);
			}


			foreach($data as $key => $val) {
				$vys = $this->CI->TestModel->odpoved($val);
				if ($vys != null) {
					if ($vys->spravna == 1) {
						$this->CI->TestModel->odpovediTestu($key, $val);
					}
					elseif ($vys->spravna == 0) {
						$this->CI->TestModel->odpovediTestu($key, $val);
					}
				}
				else {
					$this->CI->TestModel->odpovediTestu($key, null);
				}
			}

			if (isset($result)) {
				foreach($result as $key => $val) {
					$this->CI->TestModel->odpovediTestu($val, null);
				}
			}
		}
		else {
			foreach($ota as $ota1) {
				$this->CI->TestModel->odpovediTestu($ota1->idOtazka, null);
			}
		}

		if ($idUzivatele == null) {
			$token = random_string('alnum', 32) . $vyslednyTest;
			$this->CI->TestModel->addHashToken($vyslednyTest, $token);
			redirect('vysledek/' . $token, 'refresh');
		}
		else {
			redirect('vysledek/' . $vyslednyTest, 'refresh');
		}
	}
}
