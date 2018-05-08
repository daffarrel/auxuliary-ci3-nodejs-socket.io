<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('onLoggedin')) {
			redirect('auth');
		}

		$this->load->model('dash_m', 'dm');

		$this->load->library('datagrabs');
	}

	public function index()
	{
		$item['allLogUser'] = $this->datagrabs->allCurrEmpDetails();
		$item['currLOG'] = $this->datagrabs->currLog();
		$item['empDetail'] = $this->datagrabs->empDetails();
		$item['getType'] = $this->datagrabs->getTypeAux();
		$item['getAHT'] =  $this->datagrabs->getAHT();
		$data['header']		= "Dashboard";
		$data['script']		= $this->load->view('dashboard_js', '', TRUE);
		$data['content'] 	= $this->load->view('dashboard', $item, TRUE);
		$this->load->view('layout', $data);
	}

	public function auxList()
	{
		$data['header']		= "AUX LIST";
		$data['script']		= $this->load->view('auxlist_js', '', TRUE);
		$data['content'] 	= $this->load->view('auxlist', '', TRUE);
		$this->load->view('layout', $data);
	}

	public function loginList()
	{
		$item['sList']		= $this->dm->shiftListOpt();
		$item['eList']		= $this->dm->empListOpt();
		$data['header']		= "LOGIN LIST";
		$data['script']		= $this->load->view('loginlist_js', '', TRUE);
		$data['content'] 	= $this->load->view('loginlist', $item, TRUE);
		$this->load->view('layout', $data);
	}

	function makesampleaux() {
		$this->db->select('*');
		$this->db->from('historiesaux');
		$dats = $this->db->get();
		foreach ($dats->result_array() as $value) {
			$dat['lastAUX'] = $value['auxID'];
			$dat['statusAUX'] = 'Y';
			$res = $this->db->update('employees', $dat, array('empNIP' => $value['auxNIP']));
			if ($res) {
				echo 'done<br/>';
			} else {
				echo "bah<br/>";
			}
		}
	}

	function auxStartAction() {
		$this->db->insert('historiesaux', 
						  array(
								'auxNIP' =>$this->session->userdata('empNIP'),
								'auxSTART' => date('Y-m-d H:i:s'),
								'auxREASON' => $this->input->post('auxREASON')
								)
						 );
		$newAux = $this->db->insert_id();
		$this->db->update('employees',
						   array('lastAUX' => $newAux, 'statusAUX' => 'Y'),
						   array('empNIP' => $this->session->userdata('empNIP')));
		redirect('dashboard');
	}

	function auxEndAction() {
		$this->load->library('datagrabs');
		$currAux = $this->datagrabs->currAux();
		$this->db->update('historiesaux',
						   array('auxEND' => date('Y-m-d H:i:s')),
						   array('auxID' => $currAux['auxID']));
		$this->db->update('employees',
						   array('lastAUX' => "", 'statusAUX' => 'N'),
						   array('empNIP' => $this->session->userdata('empNIP')));
		$this->session->set_flashdata('auxEnd', 'You Ended Aux !...');
		redirect('dashboard');
	}

	function forceLogout($getNip) {
		$this->db->select('empNIP, lastLOGIN, lastAUX');
		$this->db->from('employees');
		$this->db->where('empNIP', $getNip);
		$datEmp = $this->db->get();
		$empDetail = $datEmp->row_array();
		$this->db->update('employees', array('lastLOGIN' => 0, 'lastAUX' => 0, 'statusLOGIN' => 'N', 'statusAUX' => 'N'), array('empNIP' => $empDetail['empNIP']));
		$this->db->update('historieslogin', array('logEND' => date('Y-m-d H:i:s')), array('logNIP' => $empDetail['empNIP']));
		$this->db->update('historiesaux', array('auxEND' => date('Y-m-d H:i:s')), array('auxNIP' => $empDetail['empNIP']));

		echo json_encode(array('backNIP' => $empDetail['empNIP']));

	}

	function getAHT() {
		$getAHTALL = $this->datagrabs->getAHT();

		echo json_encode($getAHTALL);

	}
}
