<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Develope By 	: Suryo galih Kencana harianja
	Email 			: rhio.kencana@gmail.com
	Corporate		: Transcosmos Indonesia
	Website / Blog 	: rhionair3.blogspot.com
*/
$route['auth'] = 'Auth';
$route['configs'] = 'configs';
$route['dashboard'] = 'Dashboard';
$route['usermanual'] = 'Usermanual';
$route['reports'] = 'Reports';
$route['auth/(:any)'] = 'Auth/$1';
$route['configs/(:any)'] = 'Configs/$1';
$route['dashboard/(:any)'] = 'Dashboard/$1';
$route['usermanual/(:any)'] = 'Usermanual/$1';
$route['reports/(:any)'] = 'Reports/$1';
$route['auth/(:any)/(:any)'] = 'Auth/$1/$2';
$route['configs/(:any)/(:any)'] = 'Configs/$1/$2';
$route['dashboard/(:any)/(:any)'] = 'Dashboard/$1/$2';
$route['usermanual/(:any)/(:any)'] = 'Usermanual/$1/$2';
$route['reports/(:any)/(:any)'] = 'Reports/$1/$2';
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
