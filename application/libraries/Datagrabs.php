<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Datagrabs
{
	protected $ci;

	function __construct()
	{
		$this->ci =& get_instance();
	}

	public function empDetails() {
		$currentDT = date('Y-m-d H:i:s');
		if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
			$getCurrD = date('Y-m-d', strtotime('-1 day'));
		} else {
			$getCurrD = date('Y-m-d');
		}
		$currNIP  = $this->ci->session->userdata('empNIP');
		$this->ci->db->select('a.*, b.hsCODE, b.hsDATE, c.projectNAME, d.shiftSTART');
		$this->ci->db->from('employees a');
		$this->ci->db->join('historiesshift b', 'b.hsNIP = a.empNIP', 'left');
		$this->ci->db->join('empproject c', 'c.projectID = a.empPROJECT', 'left');
		$this->ci->db->join('empshift d', 'd.shiftCODE = b.hsCODE', 'left');
		$this->ci->db->where('a.empNIP', $currNIP);
		// $this->ci->db->where('b.hsDATE', $getCurrD);
		$result = $this->ci->db->get();
		return $result->row_array();
	}



	public function empList() {
		$currProject = $this->empDetails();
		$this->ci->db->select('*');
		$this->ci->db->from('employees');
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$result = $this->ci->db->get();
		return $result->result_array();

	}

	function currAux() {
		$currAuxID = $this->empDetails();
		if ($currAuxID['lastAUX'] != 0 || $currAuxID['lastAUX'] != NULL || $currAuxID['lastAUX'] != "") {
			$this->ci->db->select('a.*, b.typeNAME');
			$this->ci->db->from('historiesaux a');
			$this->ci->db->join('auxtype b', 'b.typeID = a.auxREASON', 'left');
			$this->ci->db->where('auxID', $currAuxID['lastAUX']);
			$result = $this->ci->db->get();
			return $result->row_array();
		} else {
			return FALSE;
		}
	}

	function empTodayAllAux() {
		$currAuxID = $this->empDetails();
		$currentDT = date('Y-m-d H:i:s');
		if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
			$getCurrD = date('Y-m-d', strtotime('-1 day'));
		} else {
			$getCurrD = date('Y-m-d');
		}
		$dShifts = $this->ci->db->select('a.hsCODE, a.hsDATE, b.shiftSTART')
						 ->from('historiesshift a')
						 ->join('empshift b', 'b.shiftCODE = a.hsCODE')
						 ->where('hsDATE', $getCurrD)
						 ->where('hsNIP', $this->ci->session->userdata('empNIP'))

						 ->get();
		$dShift = $dShifts->row_array();
		$rS1 = date('Y-m-d H:i:s', strtotime($getCurrD." 06:00:00"));
		$rS2 = date('Y-m-d H:i:s', strtotime('+23 hours +59 Minutes +59 Seconds', strtotime($rS1)));
		$this->ci->db->select('statusAUX, auxEND, auxSTART, auxREASON, auxNIP');
		$this->ci->db->from('historiesaux a');
		$this->ci->db->join('employees b', 'b.empNIP = a.auxNIP', 'left');
		$this->ci->db->where('auxSTART >=', $rS1);
		$this->ci->db->where('auxSTART <=', $rS2);
		$this->ci->db->where('auxNIP', $this->ci->session->userdata('empNIP'));
		$this->ci->db->where('auxID !=', $currAuxID['lastAUX']);
		$gaShifts = $this->ci->db->get();
		$getdiff = 0;
		$datss = array();
		foreach ($gaShifts->result_array() as $vgaS) {
			$getdiff = $getdiff + (strtotime($vgaS['auxEND']) - strtotime($vgaS['auxSTART']));

			$datss[] = $getdiff;
		}
		$dataEmpAllAux = $this->sec2hms(array_sum($datss));

		return $dataEmpAllAux;

	}

	function currLog() {
		$currLogID = $this->empDetails();
		if ($currLogID['lastLOGIN'] != 0 || $currLogID['lastLOGIN'] != NULL || $currLogID['lastLOGIN'] != "") {
			$this->ci->db->select('*');
			$this->ci->db->from('historieslogin');
			$this->ci->db->where('logID', $currLogID['lastLOGIN']);
			$result = $this->ci->db->get();
			return $result->row_array();
		} else {
			return FALSE;
		}
	}

	function alluserproject() {
		$currProject = $this->empDetails();
		$this->ci->db->select('*');
		$this->ci->db->from('employees');
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL >=', 3);
		$result = $this->ci->db->get();
		$data[null] = 'Select Employee';
	    foreach($result->result_array() as $row)
	    {
	        $data[$row['empNIP']] = $row['empFULLNAME'];
	    }
	    return $data;
	}

	function allCurrEmpDetails() {
		$currProject = $this->empDetails();
		$currentDT = date('Y-m-d H:i:s');
		if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
			$getCurrD = date('Y-m-d', strtotime('-1 day'));
		} else {
			$getCurrD = date('Y-m-d');
		}
		$this->ci->db->select('empNIP, d.levelNAME, empFULLNAME, lastLOGIN, lastAUX, statusAUX, statusLOGIN, typeNAME');
		$this->ci->db->from('employees a');
		$this->ci->db->join('historiesaux b', 'b.auxID = a.lastAUX', 'left');
		$this->ci->db->join('auxtype c', 'c.typeID = b.auxREASON', 'left');
		$this->ci->db->join('emplevels d', 'd.levelID = a.empLEVEL', 'left');
		if ($currProject['empLEVEL'] >= 4) {
			$this->ci->db->where('empNIP', $currProject['empNIP']);
		}
		if($currProject['empLEVEL'] == 2 || $currProject['empLEVEL'] == 3) {
			$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		}
		$this->ci->db->where('statusLOGIN', 'Y');
		$result = $this->ci->db->get();
		$allEmp = array();
		foreach ($result->result_array() as $vEmp) {
			$dataEmpAll['NIP'] = $vEmp['empNIP'];
			$dataEmpAll['FULLNAME'] = $vEmp['empFULLNAME'];
			$dataEmpAll['levelNAME'] = $vEmp['levelNAME'];
			$dataEmpAll['typeNAME'] = $vEmp['typeNAME'];
			$this->ci->db->select('*');
			$this->ci->db->from('historieslogin');
			$this->ci->db->where('logID', $vEmp['lastLOGIN']);
			$this->ci->db->where('logNIP', $vEmp['empNIP']);
			$result1 = $this->ci->db->get();
			$dataLog = $result1->row_array();

			$dataEmpAll['logSTART'] = $dataLog['logSTART'];
			$dataEmpAll['logEND'] = $dataLog['logEND'];
			$dataEmpAll['lateSTATUS'] = $dataLog['lateSTATUS'];
			$dataEmpAll['lateRASON'] = $dataLog['lateRASON'];
			$dataEmpAll['earlierEND'] = $dataLog['earlierEND'];
			$dataEmpAll['earlierENDReason'] = $dataLog['earlierENDReason'];
			$dShifts = $this->ci->db->select('a.hsCODE, a.hsDATE, b.shiftSTART')
						 ->from('historiesshift a')
						 ->join('empshift b', 'b.shiftCODE = a.hsCODE')
						 ->where('hsDATE', $getCurrD)
						 ->where('hsNIP', $vEmp['empNIP'])
						 ->get();
			$dShift = $dShifts->row_array();
			$rS1 = date('Y-m-d 06:00:00');
			$rS2 = date('Y-m-d H:i:s', strtotime('+23 hours +59 Minutes +59 Seconds', strtotime($rS1)));
			$dataEmpAll['shiftCode'] = $dShift['hsCODE'];
			$dataEmpAll['shiftSTART'] = date('Y-m-d H:i:s', strtotime($dShift['hsDATE']." ".$dShift['shiftSTART']));			
				$reasons = $this->ci->db->get('auxtype');
				$datss = array();
				foreach ($reasons->result_array() as $vRes) {
					$getdiff = 0;
					$this->ci->db->select('statusAUX, auxEND, auxSTART, auxREASON, auxNIP');
					$this->ci->db->from('historiesaux a');
					$this->ci->db->join('employees b', 'b.empNIP = a.auxNIP', 'left');
					$this->ci->db->where('auxSTART >=', $rS1);
					$this->ci->db->where('auxSTART <=', $rS2);
					$this->ci->db->where('auxNIP', $vEmp['empNIP']);
					$this->ci->db->where('statusAUX', 'N');
					$gaShifts = $this->ci->db->get();
					foreach ($gaShifts->result_array() as $vgaS) {
						if ($vRes['typeID'] == $vgaS['auxREASON'] && $vEmp['empNIP'] == $vgaS['auxNIP']) {
								$getdiff = $getdiff + (strtotime($vgaS['auxEND']) - strtotime($vgaS['auxSTART']));

								$dataEmpAll['auxREASON'] = $vRes['typeNAME'];
						} else {
							$getdiff = 0;

								$dataEmpAll['auxREASON'] = "";
						}

					$datss[] = $getdiff;


					}
					$dataEmpAll['auxCounts'] = $this->sec2hms(array_sum($datss));
				}

			if ($vEmp['statusAUX'] == "Y") {
				$this->ci->db->select('*');
				$this->ci->db->from('historiesaux');
				$this->ci->db->where('auxID', $vEmp['lastAUX']);
				$this->ci->db->where('auxNIP', $vEmp['empNIP']);
				$result2 = $this->ci->db->get();
				$dataAUX = $result2->row_array();
				                                    
				$dataEmpAll['auxNIP'] = $dataAUX['auxNIP'];
				$dataEmpAll['auxSTART'] = $dataAUX['auxSTART'];
				$dataEmpAll['auxEND'] = $dataAUX['auxEND'];
				$dataEmpAll['auxREASON'] = $dataAUX['auxREASON'];
				$dataEmpAll['auxDesc'] = $dataAUX['auxDesc'];
				$dataEmpAll['overLIMIT'] = $dataAUX['overLIMIT'];
				$dataEmpAll['overLIMITREASON'] = $dataAUX['overLIMITREASON'];

			} else {
				$dataEmpAll['auxNIP'] = "";
				$dataEmpAll['auxSTART'] = "";
				$dataEmpAll['auxEND'] = "";
				$dataEmpAll['auxREASON'] = "";
				$dataEmpAll['auxDesc'] = "";
				$dataEmpAll['overLIMIT'] = "";
				$dataEmpAll['overLIMITREASON'] = "";
			}
			$allEmp[] = $dataEmpAll;
		}

		return $allEmp;
	}

	function getReportDash($getDate1, $getDate2, $agent) {
		if ($getDate1 != NULL && $getDate2 != NULL) {
			if ($getDate1 == $getDate2) {
				$dS1 = $getDate1;
				$dS2 = strtotime("+1 day", strtotime($getDate1));
			} else {
				$dS1 = $getDate1;
				$dS2 = $getDate2;
			}

			$dateSHIFT1 = date('Y-m-d 06:00:00', strtotime($dS1));
			$dateSHIFT2 = date('Y-m-d 05:59:59', strtotime($dS2));
		} else {
			$currentDT = date('Y-m-d H:i:s');
			if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
				$getCurrD = date('Y-m-d', strtotime('-1 day'));
			} else {
				$getCurrD = date('Y-m-d');
			}

			$dateSHIFT1 = $getCurrD." 06:00:00";
			$nextD = strtotime("+1 day", strtotime($getCurrD));
			$dateSHIFT2 = date("Y-m-d", $nextD)." 05:59:59";
		}

		$currProject = $this->empDetails();
		$this->ci->db->select('empNIP, empFULLNAME, hsDATE, hsCODE, shiftSTART, shiftEND');
		$this->ci->db->from('employees a');
		$this->ci->db->join('historiesshift b', 'b.hsNIP = a.empNIP', 'left');
		$this->ci->db->join('empshift c', 'c.shiftCODE = b.hsCODE', 'left');
		if ($currProject['empLEVEL'] >= 4) {
			$this->ci->db->where('empNIP', $currProject['empNIP']);
		}else if($currProject['empLEVEL'] >= 1 && $currProject['empLEVEL'] <= 3) {
			$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		}
		if ($agent != NULL) {
			$this->ci->db->where('empNIP', $agent);
		}
		$this->ci->db->where('hsDATE >=', date('Y-m-d', strtotime($dateSHIFT1)));
		$this->ci->db->where('hsDATE <=', date('Y-m-d', strtotime($dateSHIFT2)));
		$result = $this->ci->db->get();
		$allEmp = array();
		foreach ($result->result_array() as $vEmp) {
			$getData['empNIP'] = $vEmp['empNIP'];
			$getData['empFULLNAME'] = $vEmp['empFULLNAME'];
			$getData['hsDATE'] = $vEmp['hsDATE'];
			$this->ci->db->select('typeID, typeNAME');
			$this->ci->db->from('auxtype');
			$this->ci->db->order_by('typeID', 'ASC');
			$auxType = $this->ci->db->get();
			$datAll = array();
			$dat =array();
			foreach ($auxType->result_array() as $vType) {
				$this->ci->db->select('auxNIP, TIME_TO_SEC(TIMEDIFF(auxEND,auxSTART)) as diffTime, auxREASON');
				$this->ci->db->from('historiesaux');
				$this->ci->db->where('auxNIP', $vEmp['empNIP']);
				$this->ci->db->where('auxEND !=', NULL);
				$this->ci->db->where('auxREASON',$vType['typeID']);
				$this->ci->db->where('auxSTART >=', $dateSHIFT1);
				$this->ci->db->where('auxSTART <=', $dateSHIFT2);
				$gaShift = $this->ci->db->get();
				$datss = array();
				$getdiff = 0;
				if ($gaShift->result_array()) {
					foreach ($gaShift->result_array() as $vdiffS) {
						if ($vdiffS['auxREASON'] == $vType['typeID']) {
							// $getdiff = $getdiff + (strtotime($vdiffS['auxEND']) - strtotime($vdiffS['auxSTART']));
							$getdiff = $vdiffS['diffTime'];
							$datss[] = $getdiff;
							$dat[$vType['typeNAME']] = $this->sec2hms(array_sum($datss));
							// $dat[$vType['typeNAME']] = implode('_', $datss);
						} else {
							$datss[] = "00:00:00";
							$dat[$vType['typeNAME']] = "00:00:00";
						}
					}
				} else {
					$dat[$vType['typeNAME']] = "00:00:00";
				}

				$datAll[] = array_sum($datss);
			}
			$getData['auxCount'] = $dat;
			$getData['auxCounts'] = $this->sec2hms(array_sum($datAll));

			$getAuxList = $this->ci->db->select('a.auxSTART, a.auxEND, b.typeNAME, TIMEDIFF(auxEND,auxSTART) as diffTimes')
								       ->from('historiesaux a')
								       ->join('auxtype b', 'b.typeID = a.auxREASON', 'left')
								       ->where('a.auxNIP', $vEmp['empNIP'])
								       ->where('auxSTART >=', $dateSHIFT1)
								       ->where('auxSTART <=', $dateSHIFT2)
								       ->order_by('a.auxREASON', 'ASC')
								       ->get();
			$getLogss = $this->ci->db->select('logSTART, logEND')->from('historieslogin')->where('logNIP', $vEmp['empNIP'])->where('logSTART >=', $dateSHIFT1)->order_by('logSTART', 'DESC')->limit(1)->get();
			$getLogs = $getLogss->row_array();
			$html = "<table class='table table-bordered'>
						<tr>
							<td>Jam Masuk</td><td>".$getLogs['logSTART']."</td>
							<td>Jam Keluar</td><td>".$getLogs['logEND']."</td>						
						<tr>
						<tr>
							<td colspan='4' class='bg-primary'></td>					
						<tr>
						<tr>
							<td class='text-center'>Mulai</td>
							<td class='text-center'>Selesai</td>
							<td class='text-center'>Aux</td>
							<td class='text-center'>Durasi</td>						
						<tr>";

						foreach ($getAuxList->result_array() as $vAL) {
							$html .="<tr>";
							$html .="	<td>".date('H:i:s', strtotime($vAL['auxSTART']))."</td>";
							$html .="	<td>".date('H:i:s', strtotime($vAL['auxEND']))."</td>";
							$html .="	<td>".$vAL['typeNAME']."</td>";
							$html .="	<td>".$vAL['diffTimes']."</td>";
							$html .="</tr>";
						}
							$html .= "<tr><td colspan='4' class='bg-primary'></td></tr>";
			$html .="</table>";
			$getData['auxListDetail'] = $html;
			$getData['getLogs'] = $getLogs;

			$allEmp[] = $getData;

		}

		return $allEmp;
	}

	function getReportDash2($getDate1, $getDate2, $agent) {
		if ($getDate1 != NULL && $getDate2 != NULL) {
			if ($getDate1 == $getDate2) {
				$dS1 = $getDate1;
				$dS2 = strtotime("+1 day", strtotime($getDate1));
			} else {
				$dS1 = $getDate1;
				$dS2 = $getDate2;
			}

			$dateSHIFT1 = date('Y-m-d 06:00:00', strtotime($dS1));
			$dateSHIFT2 = date('Y-m-d 05:59:59', strtotime($dS2));
		} else {
			$currentDT = date('Y-m-d H:i:s');
			if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
				$getCurrD = date('Y-m-d', strtotime('-1 day'));
			} else {
				$getCurrD = date('Y-m-d');
			}

			$dateSHIFT1 = $getCurrD." 06:00:00";
			$nextD = strtotime("+1 day", strtotime($getCurrD));
			$dateSHIFT2 = date("Y-m-d", $nextD)." 05:59:59";
		}
		$currProject = $this->empDetails();
		$this->ci->db->select('empNIP, empFULLNAME, hsDATE, hsCODE, shiftSTART, shiftEND');
		$this->ci->db->from('employees a');
		$this->ci->db->join('historiesshift b', 'b.hsNIP = a.empNIP', 'left');
		$this->ci->db->join('empshift c', 'c.shiftCODE = b.hsCODE', 'left');
		if ($currProject['empLEVEL'] >= 4) {
			$this->ci->db->where('empNIP', $currProject['empNIP']);
		}else if($currProject['empLEVEL'] >= 1 && $currProject['empLEVEL'] <= 3) {
			$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		}
		if ($agent != NULL) {
			$this->ci->db->where('empNIP', $agent);
		}
		$this->ci->db->where('hsDATE >=', date('Y-m-d', strtotime($dateSHIFT1)));
		$this->ci->db->where('hsDATE <=', date('Y-m-d', strtotime($dateSHIFT2)));
		$result = $this->ci->db->get();
		$allEmp = array();
		foreach ($result->result_array() as $vEmp) {
			$getData['empNIP'] = $vEmp['empNIP'];
			$getData['empFULLNAME'] = $vEmp['empFULLNAME'];
			$getData['hsDATE'] = $vEmp['hsDATE'];
			$this->ci->db->select('typeID, typeNAME');
			$this->ci->db->from('auxtype');
			$this->ci->db->order_by('typeID', 'ASC');
			$auxType = $this->ci->db->get();
			$datAll = array();
			$dat =array();
			foreach ($auxType->result_array() as $vType) {
				$this->ci->db->select('auxNIP, TIME_TO_SEC(TIMEDIFF(auxEND,auxSTART)) as diffTime, auxREASON');
				$this->ci->db->from('historiesaux');
				$this->ci->db->where('auxNIP', $vEmp['empNIP']);
				$this->ci->db->where('auxEND !=', NULL);
				$this->ci->db->where('auxREASON',$vType['typeID']);
				$this->ci->db->where('auxSTART >=', $dateSHIFT1);
				$this->ci->db->where('auxSTART <=', $dateSHIFT2);
				$gaShift = $this->ci->db->get();
				$datss = array();
				$getdiff = 0;
				if ($gaShift->result_array()) {
					foreach ($gaShift->result_array() as $vdiffS) {
						if ($vdiffS['auxREASON'] == $vType['typeID']) {
							// $getdiff = $getdiff + (strtotime($vdiffS['auxEND']) - strtotime($vdiffS['auxSTART']));
							$getdiff = $vdiffS['diffTime'];
							$datss[] = $getdiff;
							$dat[$vType['typeNAME']] = $this->sec2hms(array_sum($datss));
							// $dat[$vType['typeNAME']] = implode('_', $datss);
						} else {
							$datss[] = "00:00:00";
							$dat[$vType['typeNAME']] = "00:00:00";
						}
					}
				} else {
					$dat[$vType['typeNAME']] = "00:00:00";
				}

				$datAll[] = array_sum($datss);
			}
			$getData['auxCount'] = $dat;
			$getData['auxCounts'] = $this->sec2hms(array_sum($datAll));

			// $getAuxList = $this->ci->db->select('a.auxSTART, a.auxEND, b.typeNAME, TIMEDIFF(auxEND,auxSTART) as diffTimes')
			// 					       ->from('histor/iesaux a')
			// 					       ->join('auxtype b', 'b.typeID = a.auxREASON', 'left')
			// 					       ->where('a.auxNIP', $vEmp['empNIP'])
			// 					       ->where('auxSTART >=', $dateSHIFT1)
			// 					       ->where('auxSTART <=', $dateSHIFT2)
			// 					       ->order_by('a.auxREASON', 'ASC')
			// 					       ->get();
			// $getLogss = $this->ci->db->select('logSTART, logEND')->from('historieslogin')->where('logNIP', $vEmp['empNIP'])->where('logSTART >=', $dateSHIFT1)->order_by('logSTART', 'DESC')->limit(1)->get();
			// $getLogs = $getLogss->row_array();
			// $html = "<table class='table table-bordered'>
			// 			<tr>
			// 				<td>Jam Masuk</td><td>".$getLogs['logSTART']."</td>
			// 				<td>Jam Keluar</td><td>".$getLogs['logEND']."</td>						
			// 			<tr>
			// 			<tr>
			// 				<td colspan='4' class='bg-primary'></td>					
			// 			<tr>
			// 			<tr>
			// 				<td class='text-center'>Mulai</td>
			// 				<td class='text-center'>Selesai</td>
			// 				<td class='text-center'>Aux</td>
			// 				<td class='text-center'>Durasi</td>						
			// 			<tr>";

			// 			foreach ($getAuxList->result_array() as $vAL) {
			// 				$html .="<tr>";
			// 				$html .="	<td>".date('H:i:s', strtotime($vAL['auxSTART']))."</td>";
			// 				$html .="	<td>".date('H:i:s', strtotime($vAL['auxEND']))."</td>";
			// 				$html .="	<td>".$vAL['typeNAME']."</td>";
			// 				$html .="	<td>".$vAL['diffTimes']."</td>";
			// 				$html .="</tr>";
			// 			}
			// 				$html .= "<tr><td colspan='4' class='bg-primary'></td></tr>";
			// $html .="</table>";
			// $getData['auxListDetail'] = $html;

			$allEmp[] = $getData;

		}

		return $allEmp;
	}

	function getAHT() {
		$currentDT = date('Y-m-d H:i:s');
		if ($currentDT >= date('Y-m-d 00:00:01') && $currentDT <= date('Y-m-d 05:59:59')) {
			$getCurrD = date('Y-m-d', strtotime('-1 day'));
		} else {
			$getCurrD = date('Y-m-d');
		}
		$currProject = $this->empDetails();
		$this->ci->db->select('empID');
		$this->ci->db->from('employees');
		$this->ci->db->where('statusLOGIN', "Y");
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL', 4);
		$ahtLOG = $this->ci->db->get();
		$data['ahtLOG'] = $ahtLOG->num_rows();

		$currProject = $this->empDetails();
		$this->ci->db->select('empID');
		$this->ci->db->from('employees');
		$this->ci->db->where('statusLOGIN', "Y");
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL <= ', 3);
		$ahtLOG = $this->ci->db->get();
		$data['ahtLOG_NA'] = $ahtLOG->num_rows();

		$this->ci->db->select('empID');
		$this->ci->db->from('employees');
		$this->ci->db->where('statusLOGIN', "Y");
		$this->ci->db->where('statusAUX', "Y");
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL', 4);
		$ahtAUX = $this->ci->db->get();
		$data['ahtAUX'] = $ahtAUX->num_rows();

		$this->ci->db->select('empID');
		$this->ci->db->from('employees');
		$this->ci->db->where('statusLOGIN', "Y");
		$this->ci->db->where('statusAUX', "Y");
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL <= ', 3);
		$ahtAUX = $this->ci->db->get();
		$data['ahtAUX_NA'] = $ahtAUX->num_rows();

		$this->ci->db->select('empID');
		$this->ci->db->from('employees');
		$this->ci->db->where('statusLOGIN', "Y");
		$this->ci->db->where('statusAUX', "N");
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL', 4);
		$ahtAVAIL = $this->ci->db->get();
		$data['ahtAVAIL'] = $ahtAVAIL->num_rows();

		$this->ci->db->select('empID');
		$this->ci->db->from('employees');
		$this->ci->db->where('statusLOGIN', "Y");
		$this->ci->db->where('statusAUX', "N");
		$this->ci->db->where('empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('empLEVEL <= ', 3);
		$ahtAVAIL = $this->ci->db->get();
		$data['ahtAVAIL_NA'] = $ahtAVAIL->num_rows();

		$this->ci->db->select('empID');
		$this->ci->db->from('employees a');
		$this->ci->db->join('historiesshift b', 'b.hsNIP = a.empNIP', 'left');
		$this->ci->db->where('hsDATE', $getCurrD);
		$this->ci->db->where('hsCODE !=', 'OFF');
		$this->ci->db->where('a.empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('a.empLEVEL', 4);
		$onShift = $this->ci->db->get();
		$data['onShift'] = $onShift->num_rows();

		$this->ci->db->select('empID');
		$this->ci->db->from('employees a');
		$this->ci->db->join('historiesshift b', 'b.hsNIP = a.empNIP', 'left');
		$this->ci->db->where('hsDATE', $getCurrD);
		$this->ci->db->where('hsCODE !=', 'OFF');
		$this->ci->db->where('a.empPROJECT', $currProject['empPROJECT']);
		$this->ci->db->where('a.empLEVEL <= ', 3);
		$onShift = $this->ci->db->get();
		$data['onShift_NA'] = $onShift->num_rows();

		return $data;

	}

	function getTypeAux() {
		// $result = $this->ci->db->get('auxtype');

		$this->ci->db->select('typeID, typeNAME');
		$this->ci->db->from('auxtype');
		$this->ci->db->where('typeSTATUS', "1");
		$result = $this->ci->db->get();

		$data[null] = 'Select Reason';
	    foreach($result->result_array() as $row)
	    {
	        $data[$row['typeID']] = $row['typeNAME'];
	    }
	    return $data;
	}

	function sec2hms ($sec, $padHours = false) 
    {

        // start with a blank string
        $hms = "";

         // do the hours first: there are 3600 seconds in an hour, so if we divide
         // the total number of seconds by 3600 and throw away the remainder, we're
         // left with the number of hours in those seconds
         $hours = intval(intval($sec) / 3600); 

         // add hours to $hms (with a leading 0 if asked for)
         $hms .= ($padHours) 
         ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
         : $hours. ":";

         // dividing the total seconds by 60 will give us the number of minutes
         // in total, but we're interested in *minutes past the hour* and to get
         // this, we have to divide by 60 again and then use the remainder
         $minutes = intval(($sec / 60) % 60); 

         // add minutes to $hms (with a leading 0 if needed)
         $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

        // seconds past the minute are found by dividing the total number of seconds
        // by 60 and using the remainder
        $seconds = intval($sec % 60); 

        // add seconds to $hms (with a leading 0 if needed)
        $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

       // done!
       return $hms;

     }

    function timetosec($getTime) {
     	$str_time = $getTime;

		$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);

		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

		$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

		return $time_seconds;
    }

    function createDateRangeArray($strDateFrom,$strDateTo)
	{

	    $aryRange=array();

	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}
}