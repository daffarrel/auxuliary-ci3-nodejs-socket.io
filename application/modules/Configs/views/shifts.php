					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Form Import Shift</h3>
								</div>
								<div class="panel-body">
									<form class="row" action="<?php echo base_url(); ?>configs/uploadShift" method="POST" enctype="multipart/form-data">
	                                    <div class="form-group col-lg-4">
	                                        <label for="select_month">Select Month</label>
	                                        <input type="text" name="selectMoth" id="selectMoth" class="form-control" />
	                                    </div>
	                                    <div class="form-group col-lg-4">
	                                        <label for="select_month">Select Data</label>
	                                        <input type="file" name="uploadData" id="uploadData" class="form-control btn btn-success btn-sm" data-filename-placement="inside"/>
	                                    </div>
	                                    <div class="form-group col-lg-4">
	                                        <label for="select_month">&nbsp;&nbsp;</label>
	                                        <button type="submit" class="btn btn-primary btn-sm btn-block">Submit Upload</button>
	                                    </div>
	                                </form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
							    <div class="panel-body">
							    	<div class="row">
							    		<div class="col-lg-12">
							    			<h3>SHIFT LIST</h3>
							    			<code>Default View Used Tomorrow Shift</code><br/><br>
							    		</div>
							    	</div>
							    	<form class="row" action="<?php echo base_url(); ?>configs/shiftList" method="POST">
										<div class="col-lg-3 ">
											<input type="text" name="getDate" id="getDate" class="form-control input-sm" placeholder="Select Shift Date">
										</div>
										<div class="col-lg-3">
											<?php echo form_dropdown('empNIP', $userOpt, '', 'class="form-control chosend" title="Select EMployee Name For Specific Report"'); ?>
										</div>
										<div class="col-lg-3">
											<button type="submit" class="btn btn-primary btn-block btn-sm"> Search Shift</button>
										</div>
										<div class="col-lg-3">
											<a href="<?php echo base_url(); ?>configs/shiftList" class="btn btn-default btn-block btn-sm"> Reset Search Shift</a>
										</div>
									</form>
							        <table id="shiftList" class="table table-striped table-bordered" cellspacing="0" width="100%">
							            <thead>
							                <tr>
							                    <th class="text-center">NIP</th>
							                    <th class="text-center">FULL NAME</th>
							                    <th class="text-center">DATE SHIFT</th>
							                    <th style="width:120px;" class="text-center">SHIFT CODE</th>
							                    <th class="text-center">CHANGED FROM</th>
							                    <th class="text-center">CHANGED BY</th>
							                    <th class="text-center">SETTINGS</th>
							                </tr>
							            </thead>
							            	<?php foreach ($dataShift as $vS) { ?>
							            			<tr>
							            				<td><input type="hidden" id="hsID" value="<?php echo $vS['hsID']; ?>"><?php echo $vS['hsNIP']; ?></td>
							            				<td><?php echo $vS['empFULLNAME']; ?></td>
							            				<td><?php echo $vS['hsDATE']; ?></td>
							            				<td><?php echo form_dropdown('hsCODE', $shiftOpt, $vS['hsCODE'], 'id="hsCODE" class="form-control input-sm"  style="width: 100% !important;"'); ?>
                                                        <input type="hidden" id="currShift" value="<?php echo $vS['hsCODE']; ?>"></td>
							            				<td><?php echo $vS['hsCHANGE']; ?></td>
							            				<td><?php echo $vS['ChangeBY']; ?></td>
							            				<td><button class="sbtnShift btn btn-block btn-sm btn-success">Save</button></td>							            				
							            			</tr>
							            	<?php } ?>
							            <tbody>

							            </tbody>
							        </table>
							    </div>
							</div>
						</div>
					</div>