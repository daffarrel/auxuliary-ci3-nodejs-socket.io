<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datagrabs');
	}

	function agentList(){
		$projectID = $this->datagrabs->empDetails();
		$this->db->select('empID, empNIP, empFULLNAME, empLEVEL, empSTATUS');
		$this->db->from('employees');
		$this->db->where('empPROJECT', $projectID['empPROJECT']);
		$datas = $this->db->get();

		return $datas->result_array();
	}

	function agentShiftList($getDate, $empNIP) {
		if ($getDate != NULL) {
			$dateSHIFT1 = $getDate;
			$dateSHIFT2 = $getDate;
		}
		if ($getDate == NULL) {
			$dateSHIFT1 = date('Y-m-d');
			$dateSHIFT2 = date('Y-m-d H:i:s', strtotime('+3 days', strtotime($dateSHIFT1)));
		}
		$projectID = $this->datagrabs->empDetails();
		$this->db->select('a.hsID, a.hsPROJECT, a.hsNIP, a.hsDATE, a.hsCODE, a.hsCHANGE, a.hsCHANGEDATE, b.empFULLNAME, c.empFULLNAME as ChangeBY');
		$this->db->from('historiesshift a');
		$this->db->join('employees b', 'b.empNIP = a.hsNIP', 'left');
		$this->db->join('employees c', 'c.empNIP = a.hsCHANGEBY', 'left');
		$this->db->where('hsPROJECT', $projectID['empPROJECT']);
		$this->db->where('hsDATE >=', $dateSHIFT1);
		$this->db->where('hsDATE <=', $dateSHIFT2);

		if ($empNIP != NULL) {
			$this->db->where('hsNIP', $empNIP);
		}
		$datas = $this->db->get();

		return $datas->result_array();
	}

	function levelOpt() {
		$this->db->select('levelID, levelNAME');
		$this->db->from('emplevels');
		$this->db->where('levelSTATUS', 'Y');
		$res = $this->db->get();

		$data[null] = "Select Level";
		foreach ($res->result_array() as $row) {
			$data[$row['levelID']] = $row['levelNAME'];
		}

		return $data;
	}

	function shiftOpt() {
		$result = $this->db->get('empshift');

	    $data[null] = 'Select Shift';
	    foreach($result->result_array() as $row)
	    {
	        $data[$row['shiftCODE']] = $row['shiftCODE'];
	    }
	    return $data;
	}

}

/* End of file config_m.php */
/* Location: ./application/models/config_m.php */