<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
$route['registrace'] = 'Sign/registerUser';
$route['login'] = 'Sign/login';
$route['loginDone'] = 'Sign/loginDone';
$route['registraceDone'] = 'Sign/registrace';
$route['main'] = 'Main/uvod';
$route['admin/mapy'] = 'MainU/mapyakategorie';
$route['upload/do_upload'] = 'MainU/do_upload';

$route['upload/do_upload1'] = 'MainU/do_upload1';
$route['upload'] = 'MainU/upload';
$route['success'] = 'MainU/success';
$route['mapy/(:num)'] = 'Map/mapy/$1';
$route['deaktivaceMapy/(:num)'] = 'Admin/deaktivaceMapy/$1';
$route['vysledek/(:num)'] = 'Main/vysledekPresID/$1';
$route['vysledek/(:any)'] = 'Main/vysledekPresToken/$1';
$route['logout'] = 'Sign/logout';
$route['videonavod'] = 'Main/videonavod';


$route['naucnemapy'] = 'Main/naucnemapy';
$route['naucnemapy/(:num)'] = 'Main/naucnemapyDleKategorie/$1';
$route['registraceConfirm'] = 'Sign/registerUserFinish';
$route['registraceHotovo'] = 'Sign/registerHotovo';
$route['novaotazka'] = 'MainU/novaotazka';
$route['zmena'] = 'Admin/zmenatridyDone';
$route['upravitTrida/(:num)'] = 'Admin/upravatridy/$1';
$route['smazatTrida/(:num)'] = 'Admin/smazanitridy/$1';
$route['smazatTridaHotovo/(:num)'] = 'Admin/smazanitridyHotovo/$1';
$route['otazkyatesty'] = 'Main/vsechnyMapy1';
$route['vsechnyotazky'] = 'Admin/editaceotazek';
$route['editaceotazky/(:num)'] = 'Admin/editaceotazky/$1';
$route['editacekategorie/(:num)'] = 'MainU/editacekategorie/$1';
$route['editacekategoriehotovo/(:num)'] = 'MainU/editacekategoriehotovo/$1';
$route['test'] = 'Main/test';

$route['tridy'] = 'MainU/tridy';
$route['novytest'] = 'MainU/newtest';
$route['error'] = 'Main/error';
$route['testVytvoreni/(:num)'] = 'MainU/testVytvoreni/$1';
$route['admin/neaktivnimapy'] = 'Admin/neaktivnimapy';
$route['aktivaceMapy/(:num)'] = 'Admin/aktivaceMapy/$1';
$route['statistika/(:num)'] = 'Main/statistika/$1';
$route['testovani/(:num)'] = 'Main/volaniTestu/$1';
$route['testHotovo'] = 'Main/testHotovo';
$route['testy'] = 'Main/testyList';

$route['testy/(:num)'] = 'Main/testyPodleKategorie/$1';
$route['statistikauvod'] = 'Main/statistikaMain';
$route['profil/main'] = 'Profil/profilMain';
$route['profil/trida'] = 'Profil/profilTrida';
$route['profil/trida/delete'] = 'Profil/profilDelete';
$route['zadostitrida/(:num)'] = 'MainU/zadostitrida/$1';
$route['jointrida/(:num)'] = 'Profil/profilJoinTrida/$1';
$route['admin/skoly'] = 'Admin/skoly';
$route['profil/mojetridy'] = 'MainU/mojetridy';
$route['zadostoprijeti/(:num)'] = 'Profil/zadostoprijeti/$1';
$route['zadostiDone'] = 'MainU/zadostiDone';
$route['zacitrida/(:num)'] = 'MainU/zacitrida/$1';
$route['vysledkyTridyTest/(:num)'] = 'MainU/vysledkyTridyTest/$1';
$route['zmenaLimitu/(:num)'] = 'MainU/zmenaLimitu/$1';
$route['vyhodit/(:num)'] = 'MainU/vyhodit/$1';
$route['faq'] = 'Main/faq';
$route['testy/edit/(:num)'] = 'MainU/editTest/$1';
$route['testy/smazat/(:num)'] = 'MainU/delTest/$1';
$route['upravaTestuDone'] = 'MainU/upravaTestuDone';

$route['znamkovani/(:num)'] = 'MainU/znamkovani/$1';
$route['znamkovaniDone/(:num)'] = 'MainU/znamkovaniDone/$1';
$route['statistikaSkol'] = 'Main/statistikaSkol';
$route['statistikaSkol/(:num)'] = 'Main/statistikaSkoly/$1';
$route['statistikaTridy/(:num)'] = 'Main/statistikaTridy/$1';
$route['profil/trida/zrusitzadost']= 'Profil/zrusitzadost';
$route['profil/zmenahesla']= 'Auth/change_password';
$route['profil/mojevysledky'] = 'Profil/strankovani';
$route['profil/mojevysledky/(:num)'] = 'Profil/strankovani/$1';
$route['admin/uzivatele'] = 'Auth/index';
$route['admin/skola/(:num)'] = 'Admin/skola/$1';
$route['admin/editskola/(:num)'] = 'Admin/editskola/$1';
$route['admin/editskolahotovo/(:num)'] = 'Admin/editskolahotovo/$1';






