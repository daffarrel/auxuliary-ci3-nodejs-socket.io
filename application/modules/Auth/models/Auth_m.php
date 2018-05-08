<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model {

	function checkLogin($username, $hashPassword) {
		$this->load->library('encryption');
		$this->db->select('empNIP, empPASSWORD');
		$this->db->from('employees');
		$this->db->where('empNIP = ', $username);
		$getUser = $this->db->get();
		if ($getUser->num_rows() > 0) {
			$getUsername = $getUser->row_array();
			$getPassword = $this->encryption->decrypt($getUsername['empPASSWORD']);
			if ($getPassword == $this->encryption->decrypt($hashPassword)) {
				$this->db->select('empNIP, empFULLNAME, empLEVEL');
				$this->db->from('employees');
				$this->db->where('empNIP', $getUsername['empNIP']);
				$getUserDetail = $this->db->get();
				$getDetail = $getUserDetail->row_array();

				return array_merge(array("onLoggedin" => TRUE), $getDetail);

			}
		}
	}
}

/* End of file auth_m.php */
/* Location: ./application/models/auth_m.php */