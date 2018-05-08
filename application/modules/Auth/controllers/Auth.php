<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model('auth_m', 'am');
	}

	function index()
	{
		if ($this->session->userdata('onLoggedin')) {
			redirect('dashboard');
		} else {
			$this->load->view('login');
		}
	}

	function logInAction() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$hashPassword = $this->encryption->encrypt($password); // hash for superadmin is "Harianja"
		$dataLog  = $this->am->checkLogin($username, $hashPassword);
		if (!$dataLog) {
			$this->session->set_flashdata('error', 'Wrong Type Username Or Password');
			redirect('auth');
		} else {
			$dataLog['onLoggedIn'] = TRUE;
			$this->session->set_userdata($dataLog);
			$this->load->library('datagrabs');
			$getDetail = $this->datagrabs->currLog();
			$this->session->set_flashdata('success', "Welcome Back !!!");
			if ($getDetail) {
				$currentDT = date('Y-m-d H:i:s');
				if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
					$getCurrD = date('Y-m-d', strtotime('-1 day'));
				} else {
					$getCurrD = date('Y-m-d');
				}
				$this->db->select('a.hsCODE, a.hsDATE, b.shiftSTART');
				$this->db->from('historiesshift a');
				$this->db->join('empshift b', 'b.shiftCODE = a.hsCODE', 'left');
				$this->db->where('a.hsNIP', $this->session->userdata('empNIP'));
				$this->db->where('a.hsDATE', $getCurrD);
				$compareShifts = $this->db->get();
				$compareShift = $compareShifts->row_array();
				$getEnds = date('Y-m-d H:i:s', strtotime($compareShift['hsDATE']." ".$compareShift['shiftSTART']));
				$getEnd = date('Y-m-d H:i:s', strtotime('+ 12 hours', $getEnds));
				if (date('Y-m-d H:i:s') > $getEnd) {
					$this->db->update('historieslogin', array('logEND' => date("Y-m-d H:i:s")), array('logID' => $getDetail['logID']));
					$this->db->insert('historieslogin', array('logNIP' => $this->session->userdata('empNIP'), 'logSTART' => date('Y-m-d H:i:s')));
					$newLogID = $this->db->insert_id();
					$this->db->update('employees', array('lastLOGIN' => $newLogID, 'statusLOGIN' => 'Y'), array('empNIP' => $this->session->userdata('empNIP')));

					redirect('dashboard');
				} else {
					redirect('dashboard');
				}

			} else {
				$this->db->insert('historieslogin', array('logNIP' => $this->session->userdata('empNIP'), 'logSTART' => date('Y-m-d H:i:s')));
				$newLogID = $this->db->insert_id();
				$this->db->update('employees', array('lastLOGIN' => $newLogID, 'statusLOGIN' => 'Y'), array('empNIP' => $this->session->userdata('empNIP')));

			redirect('dashboard');
			}
		}
	}

	function logOutAction() {
		$this->load->library('datagrabs');
		$getDetail = $this->datagrabs->currLog();
		$currDetail = $this->datagrabs->empDetails();
		$this->db->update('historieslogin', array('logEND' => date("Y-m-d H:i:s")), array('logID' => $getDetail['logID']));
		$this->db->update('employees', array('lastLOGIN' => "", 'statusLOGIN' => 'N'), array('empNIP' => $this->session->userdata('empNIP')));
		$dataBAck = $this->db->select('empNIP, empFULLNAME')->from('employees')->where('empNIP', $this->session->userdata('empNIP'))->get();
		// $this->session->sess_destroy();
		$this->session->unset_userdata('onLoggedin');
		$this->session->unset_userdata('empNIP');
		$this->session->unset_userdata('empFULLNAME');
		$this->session->unset_userdata('empLEVEL');
		$this->session->set_flashdata('success', $dataBAck->row_array());
		redirect('auth');
	}

	function testdata() {
		$q = $this->db->select('empNIP')->from('employees')->get();
		foreach ($q->result_array() as $v) {
			$dass = $this->db->insert('historiesshift', array('hsPROJECT' => '2', 'hsNIP' => $v['empNIP'], 'hsDATE' => date("Y-m-d H:i:s"), 'hsCODE' => 'P4'));
			if ($dass) {
				echo "Oke";
				echo "<br/><br/>";
			}
		}
	}

	function testPass() {
		$this->load->library('encryption');
		echo $this->encryption->encrypt('TCIDTVL2017!');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
