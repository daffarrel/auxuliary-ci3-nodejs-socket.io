<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 *  ======================================= 
 *  Author     : Suryo Galih Kencana Harianja 
 *  License    : Protected
 *  Email      : rhio.kencana@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  

require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Tcidexcel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 
}