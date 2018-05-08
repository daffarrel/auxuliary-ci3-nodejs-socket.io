<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Datagrabs');
		$getDats = $this->datagrabs->empDetails();
		if (!$this->session->userdata('onLoggedin')) {
			redirect('auth');
		} else if($getDats['empLEVEL'] == 4) {
			redirect('dashboard');
		}
	}

	public function index()
	{
		if ($this->input->post('getDate') != NULL) {
			$getDate1 	= $this->input->post('getDate');
			$getDate2 	= $this->input->post('getDate');
		} else {
			$getDate1 	= NULL;
			$getDate2 	= NULL;
		}
		if ($this->input->post('empNIP2') != NULL) {
			$agent 	= $this->input->post('empNIP2');
		} else {
			$agent 	= NULL;
		}
		$item['empDetail'] = $this->datagrabs->empDetails();
		$item['userOpt'] = $this->datagrabs->alluserproject();
		$item['allReport']	= $this->datagrabs->getReportDash($getDate1, $getDate2, $agent);
		$item['selectedDate'] = (($this->input->post('getDate') != NULL) ? $this->input->post('getDate') : date('Y-m-d'));
		$data['header']		= "Activities Reports";
		$data['script']		= $this->load->view('reports_js', '', TRUE);
		$data['content']	= $this->load->view('reports', $item, TRUE);
		$this->load->view('layout', $data);
	}

	public function exportExcel() {
		if ($this->input->post('getDate1') != NULL) {
			$getDate1 	= $this->input->post('getDate1');
		} else {
			$getDate1 	= NULL;
		}
		if ($this->input->post('getDate2') != NULL) {
			$getDate2 	= $this->input->post('getDate2');
		} else {
			$getDate2 	= NULL;
		}
		if ($this->input->post('empNIP') != NULL) {
			$agent 	= $this->input->post('empNIP');
		} else {
			$agent 	= NULL;
		}
		// $item['allReport']	= $this->datagrabs->getReportDash($getDate1, $getDate2, $agent);
		$this->load->library('tcidexcel');
		$resultdate = $this->datagrabs->createDateRangeArray($getDate1, $getDate2, $agent);

		$HeaderS = array(
							'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '1E824C')
							),
							'font'  => array(
							'color' => array('rgb' => 'ffffff'),
							'size'  => 12
							),
						);
		$spvstyle = array(
							'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '4DAF7C')
							),
							'font'  => array(
							'color' => array('rgb' => '000000'),
							'size'  => 12
							),
						);
		$ldrstyle = array(
							'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '86E2D5')
							),
							'font'  => array(
							'color' => array('rgb' => '000000'),
							'size'  => 12
							),
						);
		$allBordered = array(
							'borders' => array(
								'outline' => array(
									'style' => PHPExcel_Style_Border::BORDER_DOUBLE
								),
								'inside' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							),
						);
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder());
		$objPHPExcel = new PHPExcel();
		$projects = $this->datagrabs->empDetails();
		$sheetNum = 0;
		foreach ($resultdate as $kDate => $vDate) {
			$objWorkSheet = $objPHPExcel->createSheet($sheetNum);
			$objWorkSheet->setTitle("LOGIN_AUX_".$vDate);
			$objWorkSheet->setCellValue('A1', "PROJECT NAME");
			$objWorkSheet->setCellValue('A2', "REPORT BY");
			$objWorkSheet->setCellValue('B1', $projects['projectNAME']);
			$objWorkSheet->setCellValue('B2', $projects['empFULLNAME']);
			$objWorkSheet->setCellValue('A5', 'NIP');
			$objWorkSheet->setCellValue('B5', 'FULLNAME');
			$objWorkSheet->setCellValue('C5', 'DATE SHIFT');
			$objWorkSheet->setCellValue('D5', 'LOGIN TIME');
			$objWorkSheet->setCellValue('E5', 'LOGOUT TIME');
			$getTypeList = $this->db->select('typeNAME')->from('auxtype')->order_by('typeID', 'ASC')->get();
			$cols = 'F';
        	foreach ($getTypeList->result_array() as $vtypelist) {
        		$objWorkSheet->setCellValue($cols.'5', strtoupper($vtypelist['typeNAME']));
        		$cols++;
        	}
        	$objWorkSheet->setCellValue($cols.'5', 'SUMMARIES');
        	$objWorkSheet->getStyle("A5:".$cols."5")->applyFromArray($HeaderS);
        	$rows = 6;
        	$dateOne = $vDate." 06:00:00";
        	$nextD1 = strtotime("+1 day", strtotime($dateOne));
			$dateTwo = date('Y-m-d', $nextD1)." 05:59:59";
			$itemData = $this->datagrabs->getReportDash($dateOne, $dateTwo, $agent);
        	foreach ($itemData as $vData) {
        		$getLogs = $vData['getLogs'];
        		if ($vDate == $vData['hsDATE']) {
        			$objWorkSheet->setCellValue('A'.$rows, $vData['empNIP']);
	        		$objWorkSheet->setCellValue('B'.$rows, $vData['empFULLNAME']);
	        		$objWorkSheet->setCellValue('C'.$rows, $vData['hsDATE']);
	        		$objWorkSheet->setCellValue('D'.$rows, $getLogs['logSTART']);
	        		$objWorkSheet->setCellValue('E'.$rows, $getLogs['logEND']);
	        		$colss = 'F';
	        		foreach ($vData['auxCount'] as $vReasonTime) {
	        			$objWorkSheet->setCellValue($colss.$rows, $vReasonTime);
	        			$colss++;
	        		}
	        		$objWorkSheet->setCellValue($colss.$rows, $vData['auxCounts']);
	        		$rows++;
        		}
        	}
			$sheetNum++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$projects['rojectNAME'].'('.$getDate1.'_To_'.$getDate2.').xlsx"');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		// $objWriter->setPreCalculateFormulas(FALSE);

		$objWriter->save('php://output');
		exit();

	}

	function testgetTime() {
		$data = array('1052', '1077', '1088', '1099', '1103', '1107');
		$sumdata = $this->datagrabs->sec2hms(array_sum($data));
		echo $sumdata. "<br/>";
		echo $this->datagrabs->sec2hms(1052). "<br/>";
		echo $this->datagrabs->sec2hms(1077). "<br/>";
		echo $this->datagrabs->sec2hms(1088). "<br/>";
		echo $this->datagrabs->sec2hms(1099). "<br/>";
		echo $this->datagrabs->sec2hms(1103). "<br/>";
		echo $this->datagrabs->sec2hms(1107). "<br/>";
	}

	public function exportExcel2() {
		$getDate1 	= '2017-10-28';
		$getDate2 	= '2017-10-30';
		// if ($this->input->post('getDate1') != NULL) {
		// 	// $getDate1 	= $this->input->post('getDate1');
		// 	$getDate1 	= '2017-10-01';
		// } else {
		// 	$getDate1 	= NULL;
		// }
		// if ($this->input->post('getDate2') != NULL) {
		// 	// $getDate2 	= $this->input->post('getDate2');
		// 	$getDate2 	= '2017-10-02';
		// } else {
		// 	$getDate2 	= NULL;
		// }
		if ($this->input->post('empNIP') != NULL) {
			$agent 	= $this->input->post('empNIP');
		} else {
			$agent 	= NULL;
		}
		// $item['allReport']	= $this->datagrabs->getReportDash($getDate1, $getDate2, $agent);
		$this->load->library('tcidexcel');
		$resultdate = $this->datagrabs->createDateRangeArray($getDate1, $getDate2, $agent);

		$HeaderS = array(
							'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '1E824C')
							),
							'font'  => array(
							'color' => array('rgb' => 'ffffff'),
							'size'  => 12
							),
						);
		$spvstyle = array(
							'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '4DAF7C')
							),
							'font'  => array(
							'color' => array('rgb' => '000000'),
							'size'  => 12
							),
						);
		$ldrstyle = array(
							'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '86E2D5')
							),
							'font'  => array(
							'color' => array('rgb' => '000000'),
							'size'  => 12
							),
						);
		$allBordered = array(
							'borders' => array(
								'outline' => array(
									'style' => PHPExcel_Style_Border::BORDER_DOUBLE
								),
								'inside' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							),
						);
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder());
		$objPHPExcel = new PHPExcel();
		$projects = $this->datagrabs->empDetails();
		$sheetNum = 0;
		foreach ($resultdate as $kDate => $vDate) {
			$objWorkSheet = $objPHPExcel->createSheet($sheetNum);
			$objWorkSheet->setTitle("LOGIN_AUX_".$vDate);
			$objWorkSheet->setCellValue('A1', "PROJECT NAME");
			$objWorkSheet->setCellValue('A2', "REPORT BY");
			$objWorkSheet->setCellValue('B1', $projects['projectNAME']);
			$objWorkSheet->setCellValue('B2', $projects['empFULLNAME']);
			$objWorkSheet->setCellValue('A5', 'NIP');
			$objWorkSheet->setCellValue('B5', 'FULLNAME');
			$objWorkSheet->setCellValue('C5', 'DATE SHIFT');
			$getTypeList = $this->db->select('typeNAME')->from('auxtype')->order_by('typeID', 'ASC')->get();
			$cols = 'D';
        	foreach ($getTypeList->result_array() as $vtypelist) {
        		$objWorkSheet->setCellValue($cols.'5', strtoupper($vtypelist['typeNAME']));
        		$cols++;
        	}
        	$objWorkSheet->setCellValue($cols.'5', 'SUMMARIES');
        	$objWorkSheet->getStyle("A5:".$cols."5")->applyFromArray($HeaderS);
        	$rows = 6;
        	$dateOne = $vDate." 06:00:00";
        	$nextD1 = strtotime("+1 day", strtotime($dateOne));
			$dateTwo = date('Y-m-d', $nextD1)." 05:59:59";
			$itemData = $this->datagrabs->getReportDash2($dateOne, $dateTwo, $agent);
			print_r($itemData);
        	foreach ($itemData as $vData) {
        		// if ($vDate == $vData['shiftSTART']) {
        			$objWorkSheet->setCellValue('A'.$rows, $vData['empNIP']);
	        		$objWorkSheet->setCellValue('B'.$rows, $vData['empFULLNAME']);
	        		$objWorkSheet->setCellValue('C'.$rows, $vData['hsDATE']);
	        		$colss = 'D';
	        		// foreach ($vData['auxCount'] as $vReasonTime) {
	        		// 	$objWorkSheet->setCellValue($colss.$rows, $vReasonTime);
	        		// 	$colss++;
	        		// }
	        		$objWorkSheet->setCellValue($colss.$rows, $vData['auxCounts']);
	        		$rows++;
        		// }
        	}
			$sheetNum++;
		}

		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment;filename="'.$projects['rojectNAME'].'('.$getDate1.'_To_'.$getDate2.').xlsx"');
		// header('Cache-Control: max-age=0');
		// ob_end_clean();
		// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		// // $objWriter->setPreCalculateFormulas(FALSE);

		// $objWriter->save('php://output');
		// exit();
		// print_r($objWorkSheet);

	}
}
