					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Form Import Users</h3>
								</div>
								<div class="panel-body">
									<form class="row" action="<?php echo base_url(); ?>configs/uploadUser" method="POST" enctype="multipart/form-data">
	                                    <div class="form-group col-lg-6">
	                                        <label for="select_month">Select Data</label>
	                                        <input type="file" name="uploadData" id="uploadData" class="form-control btn btn-success btn-sm" data-filename-placement="inside"/>
	                                    </div>
	                                    <div class="form-group col-lg-6">
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
							    			<code>All Active Users </code><br/><br>
							    		</div>
							    	</div>
							        <table id="userList" class="table table-striped table-bordered" cellspacing="0" width="100%">
							            <thead>
							                <tr>
							                    <th class="text-center">NIP</th>
							                    <th class="text-center">FULL NAME</th>
							                    <th class="text-center">LEVEL</th>
							                    <th class="text-center">STATUS</th>
							                    <th class="text-center">SETTINGS</th>
							                </tr>
							            </thead>
							            	<?php foreach ($dataUsers as $vU) { $status = array('Y' => 'YES', 'N' => 'NO')?>
							            			<tr>
							            				<td><input type="hidden" id="empNIP" value="<?php echo $vU['empNIP']; ?>"><?php echo $vU['empNIP']; ?></td>
							            				<td><?php echo $vU['empFULLNAME']; ?></td>
							            				<td><?php echo form_dropdown('empLEVEL', $levelOpt, $vU['empLEVEL'], 'id="empLEVEL" class="form-control input-sm"  style="width: 100% !important;"'); ?></td>
							            				<td><?php echo form_dropdown('empSTATUSecho ', $status, $vU['empSTATUS'], 'id="empSTATUS" class="form-control input-sm"  style="width: 100% !important;"'); ?></td>
							            				<td><button class="sbtnUser btn btn-block btn-sm btn-success">Save</button></td>							            				
							            			</tr>
							            	<?php } ?>
							            <tbody>

							            </tbody>
							        </table>
							    </div>
							</div>
						</div>
					</div>