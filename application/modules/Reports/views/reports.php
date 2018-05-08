					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Form Export Excel</h3>
								</div>
								<div class="panel-body">
									<form class="row" action="<?php echo base_url(); ?>reports/exportExcel" method="POST">
										<div class="col-lg-6 date-range-wrap">
										    <div class="input-daterange input-group input-group-sm" id="datepicker">
										        <input name="getDate1" type="text" class="input-sm form-control" name="start" placeholder="Select Start Date" />
										        <span class="input-group-addon">to</span>
										        <input name="getDate2" type="text" class="input-sm form-control" name="end" placeholder="Select End Date"/>
										    </div>
										</div>
										<div class="col-lg-3">
											<?php echo form_dropdown('empNIP', $userOpt, '', 'id="empNIP" class="form-control" title="Select EMployee Name FOr Specific Report"'); ?>
										</div>
										<div class="col-lg-3">
											<button type="submit" class="btn btn-primary btn-block btn-sm"> Export Excel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
							    <div class="panel-heading">
							        <h3 class="panel-title">ALL AGENT ON SHIFT TODAY</h3>
							    </div>
							    <div class="panel-body">
							    	<form class="row" action="<?php echo base_url(); ?>reports/index" method="POST">
										<div class="col-lg-3">
										    <input type="text" name="getDate" id="getDate" class="form-control input-sm" placeholder="Select Shift Date">
										</div>
										<div class="col-lg-3">
											<?php echo form_dropdown('empNIP2', $userOpt, '', 'id="empNIP2" class="form-control" title="Select EMployee Name FOr Specific Report"'); ?>
										</div>
										<div class="col-lg-3">
											<button type="submit" class="btn btn-success btn-block btn-sm"> Search Data</button>
										</div>
										<div class="col-lg-3">
											<a href="<?php echo base_url(); ?>reports" class="btn btn-info btn-block btn-sm"> Reset</a>
										</div>
									</form> <br/><br/>
							        <table id="reportDT" class="table table-striped table-bordered" cellspacing="0" width="100%">
							            <thead>
							                <tr>
							                	<th class="text-center" style="width: 8,3%;">Details</th>
							                    <th class="text-center">NIP</th>
							                    <th class="text-center">FULL NAME</th>
							                    <th class="text-center">DATE SHIFT</th>
							                    <?php
							                    	$getTypeList = $this->db->select('typeNAME')->from('auxtype')->order_by('typeID', 'ASC')->get();
							                    	foreach ($getTypeList->result_array() as $vtypelist) {
							                    		echo '<th class="text-center">'.$vtypelist['typeNAME'].'</th>';
							                    	}
							                    ?>
							                    <th>Summaries</th>
							                </tr>
							            </thead>
							            	<?php foreach ($allReport as $vR) { ?>
							            		<?php if($vR['hsDATE'] == $selectedDate) { ?>
							            			<tr>
							            				<td><button class="btn btn-info btn-active-success add-popover btn-block btn-xs" data-toggle="popover" data-container="body" role="button" data-html="true" data-original-title="Current User Aux Details" data-content="<?php echo $vR['auxListDetail']; ?>">Detail</button></td>
							            				<td><?php echo $vR['empNIP']; ?></td>
							            				<td><?php echo $vR['empFULLNAME']; ?></td>
							            				<td><?php echo $vR['hsDATE']; ?></td>
							            				<?php if(!empty($vR['auxCount'])) {foreach ($vR['auxCount'] as $vTimes) { ?>
							            					<td><?php echo $vTimes; ?></td>
							            				<?php }} ?>
							            				<td><?php echo $vR['auxCounts']; ?></td>
							            			</tr>
							            		<?php } ?>
							            	<?php } ?>
							            <tbody>

							            </tbody>
							        </table>
							    </div>
							</div>
						</div>
					</div>