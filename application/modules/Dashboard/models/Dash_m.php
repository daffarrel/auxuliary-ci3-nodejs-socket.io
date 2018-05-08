<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dash_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datagrabs');
	}

	function getLogList($getNIP, $getSHIFT, $dateSHIFT1, $dateSHIFT2) {
		$project = $this->datagrabs->empDetails();
		$this->db->select('a.empNIP, a.empFULLNAME, b.hsDATE, d.shiftSTART, c.logSTART, c.logEND, c.lateSTATUS');
		$this->db->from('employees a');
		$this->db->join('historiesshift b', 'b.hsNIP = a.empNIP', 'left');
		$this->db->join('historieslogin c', 'c.logNIP = a.empNIP', 'left');
		$this->db->join('empshift d', 'd.shiftCODE = b.hsCODE', 'left');
		if ($getNIP != NULL) {
			if ($this->session->userdata('empLEVEL') == 1) {
				$this->db->where('a.empNIP', $getNIP);
			} elseif ($this->session->userdata('empLEVEL') == 2) {
				$this->db->where('a.empNIP', $getNIP);
				$this->db->where('a.empPROJECT', $project['empPROJECT']);
			} else {
				$this->db->where('a.empNIP', $getNIP);
			}
		}
		if ($getSHIFT != NULL) {
			$this->db->where('b.hsCODE', $getSHIFT);
		}
		if ($dateSHIFT != NULL) {
			$this->db->where('b.hsDATE', $dateSHIFT);
		}

		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return FALSE;
		}

	}

	function getAuxList($getNIP, $getSHIFT, $dateSHIFT) {
		$project = $this->datagrabs->empDetails();
		$this->db->select('auxNIP, empFULLNAME, auxSTART, auxEND, auxREASON, overLIMIT, overLIMITREASON');
		$this->db->from('historiesaux a');
		$this->db->join('employees b', 'b.empNIP = a.auxNIP', 'left');
		if ($getNIP != NULL) {
			if ($this->session->userdata('empLEVEL') == 1) {
				$this->db->where('b.empNIP', $getNIP);
			} else if ($this->session->userdata('empLEVEL') == 2) {
				$this->db->where('b.empNIP', $getNIP);
				$this->db->where('a.empPROJECT', $project['empPROJECT']);
			} else {
				$this->db->where('b.empNIP', $getNIP);
			}
		}
		if ($getSHIFT != NULL) {
			$this->db->where('b.hsCODE', $getSHIFT);
		}
		if ($dateSHIFT != NULL) {
			$this->db->where('b.hsDATE', $dateSHIFT);
		}

		$result = $this->db->get();

		return $result->result_array();

	}

	function empListOpt() {
		$project = $this->datagrabs->empDetails();
		$this->db->select('empNIP, empFULLNAME');
		$this->db->from('employees');
		if ($this->session->userdata('empLEVEL') != 1) {
			if ($this->session->userdata('empLEVEL') == 2) {
				$this->db->where('empPROJECT', $project['empPROJECT']);
			} else {
				$this->db->where('empNIP', $this->session->userdata('empNIP'));
			}
		}

		$result = $this->db->get();

	    $data[null] = 'Select Employee Name';
	    foreach($result->result_array() as $row)
	    {
	        $data[$row['empNIP']] = $row['empFULLNAME'];
	    }
	    return $data;
	}

	function shiftListOpt() {
		$result = $this->db->get('empshift');

	    $data[null] = 'Select Shift';
	    foreach($result->result_array() as $row)
	    {
	        $data[$row['shiftCODE']] = $row['shiftCODE'];
	    }
	    return $data;
	}

}

/* End of file dash_m.php */
/* Location: ./application/models/dash_m.php */