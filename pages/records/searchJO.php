	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h5 class="card-header">
					Search JO
				</h5>
				<div class="card-body">

					<form method="POST">
						<div class="form-group">
							<input type="text" class="form-control form-control-lg text-center" name="searchJOTxt"	placeholder="J.O Number, Employee Name, Office">
						</div>
						<div class="row">
							<div class="col-lg-2"></div>
							<div class="col-lg-8 text-center">
								<button type="submit" name="searchBtn" class="btn btn-lg btn-primary btn-outline">Search</button>
							</div>
							<div class="col-lg-2"></div>
						</div>
					</form>
					<?php 
					if (isset($_POST["searchBtn"])) {
						?>
						<div class="m2">
							<h5>Filters</h5>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<select class="form-control" id="searchStatus">
											<option value="">Filter by status</option>
											<?php 
											$r = get_array("SELECT status from jotbl GROUP BY status");
											foreach ($r as $key => $value) {
												?>
												<option><?php echo getStatus($value[0]); ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<select class="form-control" id="searchFunding">
											<option value="">Filter by funding</option>
											<?php 
											$r = get_array("SELECT fundingtbl.fund_id, funding_name from jotbl INNER JOIN fundingtbl ON jotbl.fund_id = fundingtbl.fund_id GROUP BY funding_name");
											foreach ($r as $key => $value) {
												?>
												<option value="<?php echo $value[1] ?>"><?php echo $value[1]; ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<select class="form-control" id="searchProgram">
											<option value="">Filter by program</option>
											<?php 
											$r = get_array("SELECT programtbl.program_id, program_name from jotbl INNER JOIN programtbl ON programtbl.program_id = programtbl.program_id GROUP BY program_name");
											foreach ($r as $key => $value) {
												?>
												<option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<select class="form-control" id="searchCode">
											<option value="">Filter by account code</option>
											<?php 
											$r = get_array("SELECT acct_code from jotbl GROUP BY acct_code");
											foreach ($r as $key => $value) {
												?>
												<option><?php echo $value[0]; ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive" <?php echo responsive(50) ?>>
								<table class="table table-condensed table-hover" id="tableJO">
									<thead>
										<th>#</th>
										<th width="300px">Action</th>
										<th>Status</th>
										<th>J.O #</th>
										<th>Additional Note</th>

										<th>Funding</th>
										<th>Program</th>
										<th>Account Code</th>
									</thead>
									<tbody>
										<?php
										$num=1; 
										if (isset($_POST["searchBtn"])) {
											$searchTxt = $_POST["searchJOTxt"];

											$r = get_array("SELECT jotbl.jo_number, jotbl.note, jotbl.status, jotbl.date_added, funding_name, program_name, acct_code  from jotbl LEFT JOIN fundingtbl ON fundingtbl.fund_id = jotbl.fund_id LEFT JOIN programtbl ON programtbl.program_id = jotbl.program_id LEFT JOIN jonamestbl ON jonamestbl.jo_number = jotbl.jo_number LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id LEFT JOIN officetbl ON officetbl.office_id = jonamestbl.office_id WHERE 
												((fname like '%$searchTxt%') or (lname like '%$searchTxt%') or (mname like '%$searchTxt%') or (CONCAT(lname, ' ', fname, ' ', mname) like '%$searchTxt%') 
													or (CONCAT(fname, ' ', mname, ' ', lname) like '%$searchTxt%') or (CONCAT(fname, ' ', lname) like '%$searchTxt%') or (CONCAT(lname, ' ', fname) like '%$searchTxt%')) or jotbl.jo_number like '%$searchTxt%' or office_name like '%$searchTxt%' GROUP BY jotbl.jo_number ORDER BY SUBSTR(jotbl.jo_number, -4, 6) ASC");

											foreach ($r as $key => $v) {
												$jonum = $v["jo_number"];
												$jonotes = '';
												$note = get_value("SELECT * from jonotestbl WHERE jo_number = '$jonum'");
												if (empty($note)) {
													$jonotes = 'No note recorded';
												}
												else{
													$jonotes = $note[2];
												}
												?>
												<tr data-toggle="tooltip" title="<?php echo $v["note"] ?>">
													<td><?php echo $num ?></td>
													<td>
														<button onclick="showJO('<?php echo $v["jo_number"] ?>')" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i> View</button>
													</td>
													<td><div class="badge badge-info badge-pill"><?php echo getStatus($v["status"]); ?></div></td>
													<td><?php echo $v["jo_number"] ?><br><small>Dated Saved: <?php echo $v["date_added"] ?></small></td>
													<td><div class="badge badge-primary badge-pill"><?php echo $jonotes; ?></div></td>
													
													<td><?php echo $v["funding_name"] ?></td>
													<td><?php echo $v["program_name"] ?></td>
													<td><?php echo $v["acct_code"] ?></td>
												</tr>
												<?php
												$num++;
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2"></div>
	</div>
