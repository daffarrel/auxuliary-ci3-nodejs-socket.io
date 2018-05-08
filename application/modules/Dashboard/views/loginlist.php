					<div class="row">
						<div class="col-lg-12">
							<div class="panel">
							    <div class="panel-heading">
							        <h3 class="panel-title">ALL LOGIN LIST</h3>
							    </div>
							    <div class="panel-body">
							    	<div class="row">
							    		<div class="col-lg-2">
								    		<div class="form-group">
								    			<label>Employee List</label>
								    			<?php echo form_dropdown('NIP', $eList, '', 'class="form-control chosens"') ?>
								    		</div>
							    		</div>
							    		<div class="col-lg-2">
								    		<div class="form-group">
								    			<label>Shifting List</label>
								    			<?php echo form_dropdown('SHIFT', $sList, '', 'class="form-control chosens"') ?>
								    		</div>
							    		</div>
							    		<div class="col-lg-2">
								    		<div class="form-group">
								    			<label>Date From</label>
								    			<input type="text" class="form-control input-sm">
								    		</div>
							    		</div>
							    		<div class="col-lg-2">
								    		<div class="form-group">
								    			<label>Date To</label>
								    			<input type="text" class="form-control input-sm">
								    		</div>
							    		</div>
							    		<div class="col-lg-2">
							    			<label> &nbsp;&nbsp;</label>
								    		<button type="button" class="btn btn-default btn-block btn-sm">RESET SEARCH</button>
							    		</div>
							    		<div class="col-md-2">
							    			<label> &nbsp;&nbsp;</label>
								    		<button type="button" class="btn btn-primary btn-block btn-sm">SEARCH</button>
							    		</div>
							    	</div><br/>
							        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
							            <thead>
							                <tr>
							                    <th>Name</th>
							                    <th>Position</th>
							                    <th class="min-tablet">Office</th>
							                    <th class="min-tablet">Extn.</th>
							                    <th class="min-desktop">Start date</th>
							                    <th class="min-desktop">Salary</th>
							                </tr>
							            </thead>
							            <tbody>
							            </tbody>
							        </table>
							    </div>
							</div>
						</div>
					</div>