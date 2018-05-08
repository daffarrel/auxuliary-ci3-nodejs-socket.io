<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datagrabs');
		$this->load->model('config_m', 'cm');
	}

	public function index()
	{
		$this->load->view('configs');
	}

	function shiftList() {
		if ($this->input->post('getDate')) {
			$getDate = $this->input->post('getDate');
		} else {
			$getDate = NULL;
		}

		if ($this->input->post('empNIP')) {
			$empNIP = $this->input->post('empNIP');
		} else {
			$empNIP = NULL;
		}

		$item['dataShift'] = $this->cm->agentShiftList($getDate, $empNIP);
		$item['userOpt'] = $this->datagrabs->alluserproject();
		$item['empDetail'] = $this->datagrabs->empDetails();
		$item['shiftOpt'] = $this->cm->shiftOpt();
		$data['header'] = "SHIFT LIST";
		$data['content'] = $this->load->view('shifts', $item, TRUE);
		$data['script'] = $this->load->view('shift_js', '', TRUE);
		$this->load->view('layout', $data);
	}

	function userList() {
		$item['empDetail'] = $this->datagrabs->empDetails();
		$item['dataUsers'] = $this->cm->agentList();
		$item['levelOpt'] = $this->cm->levelOpt();
		$data['header'] = "USERS LIST";
		$data['content'] = $this->load->view('users', $item, TRUE);
		$data['script'] = $this->load->view('user_js', '', TRUE);
		$this->load->view('layout', $data);
	}

	function uploadShift() {
		$project = $this->datagrabs->empDetails();;
		$this->load->library('tcidexcel');
		$this->load->library('upload');
		$yearMonth = $this->input->post('selectMoth');
    	$objPHPExcel = PHPExcel_IOFactory::load($_FILES['uploadData']['tmp_name']);
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$getHighestCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$HighestcolNums = PHPExcel_Cell::columnIndexFromString($getHighestCol);
		$trueHCols = $HighestcolNums;
		$highestColName = PHPExcel_Cell::stringFromColumnIndex($trueHCols);
		$allrow = count($allDataInSheet);
		$countUpdate = array();
		$countInsert = array();
		for ($row=2; $row <= $allrow ; $row++) {
			for ($column = 'C'; $column != $highestColName; $column++) {
				$dataCols['hsNIP'] = $allDataInSheet[$row]['A'];
			    $dataCols['hsDATE'] = date('Y-m-d', strtotime($yearMonth.'-'.$allDataInSheet[1][$column]));
			    $dataCols['hsCODE'] = $allDataInSheet[$row][$column];
			    $dataCols['hsPROJECT'] = $project['empPROJECT'];
			    $checkExist = $this->db->select('hsID')->from('historiesshift')->where('hsNIP', $dataCols['hsNIP'])->where('hsDATE', $dataCols['hsDATE'])->where('hsCODE', $dataCols['hsCODE'])->get();
			    if ($checkExist->num_rows() > 0) {
			    	$getId = $checkExist->row_array();
			    	$this->db->update('historiesshift', $dataCols, array('hsID', $getId['hsID']));
			    	$countUpdate[] = $getId;
			    } else {
			    	$this->db->insert('historiesshift', $dataCols);
			    	$countInsert[] = $this->db->insert_id();
			    }

			}
		}
		redirect('configs/shiftList');
	}

	function uploadUser() {
		$this->load->library('encryption');
		$dataProj = $this->datagrabs->empDetails();
		ini_set('max_execution_time', 0);
		$this->load->library('tcidexcel');
		$this->load->library('upload');
    	$objPHPExcel = PHPExcel_IOFactory::load($_FILES['uploadData']['tmp_name']);
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$getHighestCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$HighestcolNums = PHPExcel_Cell::columnIndexFromString($getHighestCol);
		$trueHCols = $HighestcolNums - 2;
		$highestColName = PHPExcel_Cell::stringFromColumnIndex($trueHCols);
		$allrow = count($allDataInSheet);
		for ($row=2; $row <= $allrow ; $row++) {
			$data_col['empNIP'] = $allDataInSheet[$row]['A'];      
			$data_col['empFULLNAME'] = $allDataInSheet[$row]['B'];
			$data_col['empLEVEL'] = $allDataInSheet[$row]['C'];
			$data_col['empPROJECT'] = $dataProj['empPROJECT'];
			$data_col['empSTATUS'] = $allDataInSheet[$row]['D'];
			$result = $this->db->select('empID')->from('employees')->where('empNIP', $data_col['empNIP'])->get();

			if ($result->num_rows() > 0) {
				$getNip = $result->row_array();
				$this->db->update('employees', $data_col, array('empID', $getNip['empID']));
			} else {
				$data_col['empPASSWORD'] = $this->encryption->encrypt('TCID2017!');
				$this->db->insert('employees', $data_col);
			}
		}
		redirect('configs/userList');
		
	}

	function updateShift() {
		$data_save = array(
			'hsCHANGEDATE' => date('Y-m-d H:i:s'),
			'hsCODE' => $this->input->post('hsCODE'),
			'hsCHANGE' => $this->input->post('hsCHANGE'),
			'hsCHANGEBY' => $this->session->userdata('empNIP'),

		);
		$this->db->update('historiesshift', $data_save, array('hsID' => $this->input->post('hsID')));
		redirect('configs/shiftList');
	}

	function updateUser() {
		$data_save = array(
			'empNIP' => $this->input->post('empNIP'),
			'empLEVEL' => $this->input->post('empLEVEL'),
			'empSTATUS' =>$this->input->post('empSTATUS'),

		);
		$this->db->update('employees', $data_save, array('empNIP' => $this->input->post('empNIP')));
		redirect('configs/userList');
	}
}
