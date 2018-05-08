					<div class="row">
						<div class="col-md-3">
							<div class="panel media middle">
			                    <div class="media-left bg-primary pad-all">
			                        <i class="fa fa-users fa-3x"></i>
			                    </div>
			                    <div class="media-body pad-all">
			                    	<p>On Logged In</p>
			                    	<div class="row">
			                    		<div class="col-xs-6">
					                        <p id="AllLogingIn" class="text-left text-2x mar-no text-semibold"><?php echo $getAHT['ahtLOG']; ?></p>
					                        <p class="text-left text-muted mar-no">Agent (s)</p>
			                    		</div>
			                    		<div class="col-xs-6">
					                        <p id="AllLogingIn2" class="text-right text-2x mar-no text-semibold"><?php echo $getAHT['ahtLOG_NA']; ?></p>
					                        <p class="text-right text-muted mar-no">Non Agent (s)</p>
			                    		</div>
			                    	</div>
			                    </div>
			                </div>
						</div>
						<div class="col-md-3">
							<div class="panel media middle">
			                    <div class="media-left bg-danger pad-all">
			                        <i class="fa fa-comments-o fa-3x"></i>
			                    </div>
			                    <div class="media-body pad-all">
			                    	<p>ALL On Aux</p>
			                    	<div class="row">
			                    		<div class="col-xs-6">
					                        <p id="AllOnAux" class="text-2x mar-no text-semibold"><?php echo $getAHT['ahtAUX']; ?></p>
					                        <p class="text-left text-muted mar-no">Agent (s)</p>
			                    		</div>
			                    		<div class="col-xs-6">
					                        <p id="AllOnAux2" class="text-right text-2x mar-no text-semibold"><?php echo $getAHT['ahtAUX_NA']; ?></p>
					                        <p class="text-right text-muted mar-no">Non Agent (s)</p>
			                    		</div>
			                    	</div>
			                    </div>
			                </div>
						</div>
						<div class="col-md-3">
							<div class="panel media middle">
			                    <div class="media-left bg-success pad-all">
			                        <i class="fa fa-coffee fa-3x"></i>
			                    </div>
			                    <div class="media-body pad-all">
			                    	<p>All Available</p>
			                    	<div class="row">
			                    		<div class="col-xs-6">
			                        		<p id="AllAvail" class="text-2x mar-no text-semibold"><?php echo $getAHT['ahtAVAIL']; ?></p>
					                        <p class="text-left text-muted mar-no">Agent (s)</p>
			                    		</div>
			                    		<div class="col-xs-6">
			                        		<p id="AllAvail2" class="text-right text-2x mar-no text-semibold"><?php echo $getAHT['ahtAVAIL_NA']; ?></p>
					                        <p class="text-right text-muted mar-no">Non Agent (s)</p>
			                    		</div>
			                    	</div>
			                    </div>
			                </div>
						</div>
						<div class="col-md-3">
							<div class="panel media middle">
			                    <div class="media-left bg-warning pad-all">
			                        <i class="fa fa-address-book-o fa-3x"></i>
			                    </div>
			                    <div class="media-body pad-all">
			                    	<p>On Shift Today</p>
			                    	<div class="row">
			                    		<div class="col-xs-6">
			                        		<p id="AllOnShift" class="text-2x mar-no text-semibold"><?php echo $getAHT['onShift']; ?></p>
					                        <p class="text-left text-muted mar-no">Agent (s)</p>
			                    		</div>
			                    		<div class="col-xs-6">
			                        		<p id="AllOnShift2" class="text-right text-2x mar-no text-semibold"><?php echo $getAHT['onShift_NA']; ?></p>
					                        <p class="text-right text-muted mar-no">Non Agent (s)</p>
			                    		</div>
			                    	</div>
			                    </div>
			                </div>
						</div>
						<div class="col-md-6">
							<form class="panel media middle" action="<?php echo base_url(); ?>dashboard/auxStartAction" method="POST">
			                    <div class="media-body pad-all">
			                        <p class="text-semibold">
			                        	Default Quota : <code>01:15:00</code>
			                        </p>
			                        <p class="text-muted mar-no form-group form-group-sm">
			                        	<?php echo form_dropdown('auxREASON', $getType, '', 'id="auxREASON" class="form-control" title="Select This Aux Reason Before Press The AUx Button" required'); ?>
			                        </p>
			                    </div>
			                    <div class="media-left pad-all">
			                    	<button type="submit" id="submitAux" class="media-left btn btn-warning pad-all" title="Please Select Reason On Left Dropdown Then Press This Button">
				                        <i class="fa fa-coffee fa-3x"></i>
				                    </button>
			                    </div>
			                </form>
						</div>
						<div class="col-md-6">
							<div class="panel media middle">
			                    <div class="media-body pad-all">
			                    	<?php
			                    		if ($empDetail['hsCODE'] != NULL || $empDetail['hsCODE'] != "") {
			                    			$hsCODE = $empDetail['hsCODE'];
			                    		} else {
			                    			$hsCODE = "No Shift";
			                    		}

			                    		if ($empDetail['hsDATE'] != NULL || $empDetail['hsDATE'] != "") {
			                    			$hsDATE = $empDetail['hsDATE'];
			                    		} else {
			                    			$hsDATE = "No Date";
			                    		}
			                    	?>
			                        <p class="text-semibold">Welcome, <?php echo $this->session->userdata('empFULLNAME'); ?></p>
			                        <p class="text-muted mar-no">You've Logging On : <code> <?php echo date('H:i:s', strtotime($currLOG['logSTART'])) ?></code> In Shift <code> <?php echo $hsCODE; ?></code> With Shift Date <code><?php echo $hsDATE; ?></code></p>
			                    </div>
			                    <div class="media-left pad-all">
				                    <a href="<?php echo base_url(); ?>auth/logOutAction?getNIP=<?php echo $this->session->userdata('empNIP'); ?>" class="btn btn-danger pad-all" title="Press This Button To Log-Out From Aux System">
				                        <i class="fa fa-coffee fa-3x"></i>
				                    </a>
			                    </div>
			                </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel">
							    <div class="panel-heading">
							        <h3 class="panel-title">ALL AGENT ON SHIFT TODAY</h3>
							    </div>
							    <div class="panel-body">
							        <table id="loginDT" class="table table-striped table-bordered" cellspacing="0" style="min-height: 100px; width: 100%;">
							            <thead>
							                <tr>
							                    <th class="text-center">NIP</th>
							                    <th class="text-center">FULL NAME</th>
							                    <th class="text-center">EMP LEVEL</th>
							                    <th class="text-center">SHIFT</th>
							                    <th class="text-center">LOGIN AT</th>
							                    <th class="text-center">AUX REASON</th>
							                    <th class="text-center">AUX STATUS</th>
							                    <th class="text-center">LIMIT AUX</th>
							                    <th class="text-center">SETTINGS</th>
							                </tr>
							            </thead>
							            <tbody>
							            <?php $no=0; foreach ($allLogUser as $value) { ?>
							                <tr class="row_user_<?php echo $value['NIP']; ?>">
							                    <td class="center"><?php echo $value['NIP']; ?></td>
							                    <td><?php echo $value['FULLNAME']; ?></td>
							                    <td><?php echo $value['levelNAME']; ?></td>
							                    <td class="text-center"><?php echo $value['shiftCode'] ?></td>
							                    <td class="text-center dataLog">
							                    	<?php if(isset($value['logSTART'])) { 
							                    			if($value['logSTART'] > $value['shiftSTART']) {

							                    				echo "<button class='btn btn-block btn-danger btn-xs'> Late At : ".date('H:i:s', strtotime($value['logSTART']))."</button>"; 
							                    			} else {
							                    				echo "<button class='btn btn-block btn-info btn-xs'> On Time At : ".date('H:i:s', strtotime($value['logSTART']))."</button>"; 
							                    			}
						                    			} else { 
						                    				echo "<button class='btn btn-block btn-default btn-xs'>Not Login Or Had Logout</button>"; ; 
						                    			} ?>
							                    		
							                    </td>
							                    <td class="getReasons"><?php echo $value['typeNAME'] ?></td>
							                    <td class="nums counter<?php echo $no; ?>">
							                    	
							                    		<?php 
							                    			if($value['auxSTART'] != "") {
							                    				echo "<input type='hidden' class='getdaux' value='".$value['auxSTART']."'/>";
							                    				echo '<button class="btn btn-danger btn-block btn-xs counters">On Aux</button>'; 
							                    			} else { 
							                    				echo '<button class="btn btn-info btn-block btn-xs">Available</button>'; 
							                    			} ?>
							                    </td>
							                    <td class="text-center">
							                    	<?php 
							                    	$this->load->library('datagrabs');
							                    	$quota = $this->datagrabs->timetosec('01:15:00');
							                    	if(isset($value['auxCounts'])) { 
							                    		// $limitdiff = strtotime('00:10:00');
							                    		$limitdiff = $this->datagrabs->timetosec($value['auxCounts']);
							                    		if($limitdiff == 0) {
							                    			$getp = 0;
							                    			$percentages = "0";
							                    			$getTime = "00:00:00";
							                    		} else {
							                    			$getp = ($limitdiff / $quota) * 100;
							                    			$percentages =  $getp;
							                    			$getTime = $value['auxCounts'];
							                    		}
							                    		if ($percentages >= 86 ) {
							                    			$getcalls = 'progress-bar-danger';
							                    		} else if ($getp >= 65 && $getp <= 85 ) {
							                    			$getcalls = 'progress-bar-warning';
							                    		} else {
							                    			$getcalls = 'progress-bar-success';
							                    		}
							                    	?>
							                    	<?php
							                    		if ($percentages >= 101) {
							                    			$getPerc = 100;
							                    		} else {
							                    			$getPerc = $percentages;
							                    		}
							                    	?>
													<div class="progress progress-lg text-center" style="margin-bottom:0px !important;" >
														<div class="progress-bar <?php echo $getcalls; ?> progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $limitdiff; ?>" aria-valuemin="0" aria-valuemax="<?php echo $quota; ?>" style="width: <?php echo $getPerc."%"; ?>">
															<span><?php echo $getTime; ?></span>
														</div>
													</div><?php } ?>
												</td>
												<td><button class="btn btn-danger btn-block btn-xs" onclick="forceLogout('<?php echo $value['NIP']; ?>');">FORCE LOGOUT</button></td>
							                </tr>
							            <?php $no++; } ?>
							            </tbody>
							        </table>
							    </div>
							</div>
						</div>
					</div>