<?php 
session_start();
include('../../assets/conn/etc.php');
$jo_num = p('id');
$get_status = get_value("SELECT status from jotbl WHERE jo_number = '$jo_num'")[0];
$r = get_array("SELECT id, employeetbl.employee_id, contract_start, contract_end, contract_status, days, office_id, designation_id, jonamestbl.note from jonamestbl  
	INNER JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id 
	INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number 
	WHERE jotbl.jo_number = '$jo_num' GROUP BY employeetbl.employee_id ORDER BY lname, fname, mname");
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h5 class="card-header">
					<?php echo $jo_num ?><br>
					<small class="card-description">
						<?php 
						$jotblData = get_value("SELECT * from jotbl INNER JOIN programtbl ON jotbl.program_id = programtbl.program_id INNER JOIN fundingtbl ON fundingtbl.fund_id = jotbl.fund_id WHERE jo_number = '$jo_num'");

						?>
						PROGRAM: <?php echo $jotblData["program_name"]; ?> | FUNDING: <?php echo $jotblData["funding_name"]; ?>
					</small>
				</h5>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-12">

											<?php 
											if ($_SESSION["user_type"] == "jo" && $get_status == 1 || $_SESSION['user_type'] == 'admin') {
												?>
												<div class="form-group">
													<input type="text" class="form-control" id="search_jo" placeholder="Search Employee..." onkeyup="search_employee_jo('<?php echo $jo_num ?>')">
												</div>
												<span id="searchjo"></span>
												<?php
											}
											?>
										</div>
										<div class="col-lg-12">
											<div class="table-responsive" id="joTable" <?php responsive(60) ?>>

												<table class="table table-bordered table-hover">
													<thead class="thead">
														<th>#</th>
														<?php 
														if ($get_status == "5" || $get_status == "6") {
															?>
															<th>Action</th>
															<?php
														}
														?>
														<th>Fullname</th>
														<th>Office</th>
														<th>Designation</th>
														<th>Rate</th>
														<th>Period</th>
														<th>Status</th>
														
														<th>Includings</th>

														<th>Note</th>
														<!-- <th>C/O</th> -->
													</thead>
													<tbody>	
														<?php 
														$num=1;
														foreach ($r as $key => $v) {
															$datea = date_create($v["contract_start"]);
															$dateb = date_create($v["contract_end"]);

															$joid = $v["id"];

															$datefrom = date_format($datea, 'F j');
															$dateto = date_format($dateb, 'F j');

															$year = date_format($datea, 'Y');
															$emp_id = $v["employee_id"];

															$offid = $v["office_id"];
															$desid = $v["designation_id"];

															$office = get_value("SELECT office_name from officetbl WHERE office_id = '$offid'")[0];
															$des = get_value("SELECT designation_name, rate from designationtbl WHERE designation_id = '$desid'");

															$x = get_value("SELECT jo_status from jonamestbl WHERE employee_id = '$emp_id' and jo_number = '$jo_num'");
															?>
															<?php 
															if ($get_status != "0") {
																?>
																<tr data-toggle="tooltip" title="<?php echo $v["note"] ?>" <?php if($get_status != "6"){
																	?>
																	onclick="editEmpJO('<?php echo $joid ?>', '<?php echo $jo_num ?>')"
																	<?php
																} ?> 
																<?php 
																if($x[0] == "8"){
																	echo "class='table-danger text-white'";
																}
																else if($x[0] == 6){
																	echo "class='table-success text-white'";
																}
															?>>
															<?php
														}
														else{
															?>
															<tr data-toggle="tooltip" title="<?php echo $v["note"] ?>">
																<?php
															}
															?>

															<td><?php echo $num ?></td>
															
															<?php 
															$status = $x[0];
															if ($get_status == "5" || $get_status == "6") {
																?>
																<td>
																	<?php
																// echo $status . '<br>';
																	if ($status == 8) {
																		?>
																		<button class="btn btn-warning btn-sm" onclick="tagNotCancelled('<?php echo $jo_num ?>', '<?php echo $emp_id ?>')" data-toggle="tooltip" title="Tag as not cancelled."><i class="mdi mdi-alert"></i> Uncancel</button>
																		<?php
																	}
																	else if($status == ""){
																		?>
																		<button class="btn btn-info btn-sm" onclick="tagActive('<?php echo $jo_num ?>', '<?php echo $emp_id ?>')" data-toggle="tooltip" title="Tag as signed and active."><i class="mdi mdi-check"></i> Signed</button>
																		<button class="btn btn-danger btn-sm" onclick="tagCancelled('<?php echo $jo_num ?>', '<?php echo $emp_id ?>')" data-toggle="tooltip" title="Tag as cancelled."><i class="mdi mdi-alert"></i> Cancel</button>
																		<?php
																	}
																	else if ($status == 6){
																		?>
																		<button class="btn btn-danger btn-sm" onclick="tagInActive('<?php echo $jo_num ?>', '<?php echo $emp_id ?>')" data-toggle="tooltip" title="Tag as inactive."><i class="mdi mdi-alert-outline"></i> Inactive</button>
																		<?php
																	}
																	?>
																</td>
																<?php
															}
															?>

															<td>
																<?php echo getData($v["employee_id"], 'name') ?><br>
																<small style="font-size: 10px;">
																	<?php 
																	$co = get_value("SELECT c_o from employeetbl WHERE employee_id = '$emp_id'");
																	if ($co[0] != "") {
																		echo "C/O: " . $co[0];
																	}
																	?>
																</small>
															</td>
															<td><?php echo $office ?></td>
															<td><?php echo $des[0] ?></td>
															<td><?php echo $des[1] ?></td>
															<td><?php echo $datefrom . ' - ' . $dateto . ', ' . $year;  ?></td>
															<td><?php echo getContract($v["contract_status"]) ?></td>
															<td><?php echo getDays($v["days"]) ?></td>

															<td><?php echo $v["note"] ?></td>
																		<!-- <td><?php 
																		
																	?></td> -->
																</tr>
																<?php
																$num++;
															}
															?>
														</tbody>
													</table>
												</div>

												<?php 
												if ($_SESSION["user_type"] == "admin") {
													$r = get_value("SELECT note from jonotestbl WHERE jo_number = '$jo_num'");
													if ($r != 0) {
														?>
														<div class="alert alert-info mt-3"><?php echo $r[0] ?></div>
														<?php
													}
													
														$r2 = get_value("SELECT co_note from jonotestbl WHERE jo_number = '$jo_num'");
													if ($r2 != 0) {
														?>
														<div class="alert alert-primary mt-3"><?php echo $r2[0] ?></div>
														<?php
													}
												}
												?>

											</div>
										</div>
									</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
								<?php 
								switch ($_SESSION['user_type']) {
									case 'jo':
									?>

									<?php 
									switch ($get_status) {
										case '1':
										?>
										<div class="col mb-1">
											<button class="btn btn-lg btn-primary btn-block" disabled>FOR APPROVAL...</button>
										</div>
										<?php
										break;

										case '2':
										?>
										<div class="col mb-1">
											<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagPrinted('<?php echo $jo_num ?>')">TAG AS PRINTED</a>
										</div>

										<div class="col mb-1">
											<a href="pages/print/print_letter.php?joid=<?php echo $jo_num ?>" target="_blank" class="btn btn-lg btn-primary btn-block btn-disabled">PRINT AVAILABILITY OF FUNDS</a>
										</div>

										<?php 
											//revitalistion 84
										$fund = get_value("SELECT fund_id from jotbl WHERE jo_number = '$jo_num'")[0];
										if ($fund == "84") {
											?>
											<div class="col-lg-12 mb-1">
												<a href="pages/print/print_contract_trust_fund.php?joid=<?php echo $jo_num ?>" target="_blank" class="btn btn-lg btn-primary btn-block btn-disabled">PRINT J.O CONTRACT</a>
											</div>
											<?php
										}
										else{
											?>
											<div class="col mb-1">
												<a href="pages/print/print_contract.php?joid=<?php echo $jo_num ?>" target="_blank" class="btn btn-lg btn-primary btn-block btn-disabled">PRINT J.O CONTRACT</a>
											</div>
											<?php
										}
										?>

										<?php
										break;

										case '3':
										?>
										<div class="col mb-1">
											<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagApprovedModal('<?php echo $jo_num ?>')">TAG AS APPROVED</a>
										</div>
										<?php
										break;


										case '4':
										?>
										<div class="col mb-1">
											<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagForSigningGov('<?php echo $jo_num ?>')">TAG AS SIGNED BY THE GOVERNOR</a>
										</div>
										<?php
										break;

										case '5':
										?>
										<div class="col mb-1">
											<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagFinished('<?php echo $jo_num ?>')">TAG AS ACTIVE JO</a>
										</div>
										<?php
										break;

										default:
												// code...
										break;
									}
									?>

									<?php
									break;


									case 'admin':
									?>
									<?php 
									if ($get_status == 1) {
										?>
										<div class="col mb-1">
											<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagApproveJO('<?php echo $jo_num ?>')">APPROVE J.O</a>
										</div>
										<div class="col mb-1">
											<a href="#" class="btn btn-lg btn-warning btn-block" onclick="tagdisapproveJO('<?php echo $jo_num ?>')">DISAPPROVE J.O</a>
										</div>
										<?php
									}
									?>

									<div class="col mb-1">
										<a href="pages/print/print_letter.php?joid=<?php echo $jo_num ?>" target="_blank" class="btn btn-lg btn-primary btn-block btn-disabled">PRINT AVAILABILITY OF FUNDS</a>
									</div>

									<?php 
											//revitalistion 84
									$fund = get_value("SELECT fund_id from jotbl WHERE jo_number = '$jo_num'")[0];
									if ($fund == "84") {
										?>
										<div class="col mb-1">
											<a href="pages/print/print_contract_trust_fund.php?joid=<?php echo $jo_num ?>" target="_blank" class="btn btn-lg btn-primary btn-block btn-disabled">PRINT J.O CONTRACT</a>
										</div>
										<?php
									}
									else{
										?>
										<div class="col mb-1">
											<a href="pages/print/print_contract.php?joid=<?php echo $jo_num ?>" target="_blank" class="btn btn-lg btn-primary btn-block btn-disabled">PRINT J.O CONTRACT</a>
										</div>
										<?php
									}
									?>

									<?php
									break;

									default:
											// code...
									break;
								}

								?>

								<div class="col mb-1">
									<a href="#" class="btn btn-lg btn-info btn-block" onclick="editJO('<?php echo $jo_num ?>')">EDIT JO</a>
								</div>
								<div class="col mb-1">
									<a href="#" class="btn btn-lg btn-primary btn-block" onclick="addNote('<?php echo $jo_num ?>')">ADD NOTE</a>
								</div>
								<div class="col mb-1">
									<a href="#" class="btn btn-lg btn-info btn-block" onclick="openRenewJO('<?php echo $jo_num ?>')">RENEW</a>
								</div>
								<?php 
								if($_SESSION["user_type"] == "admin"){ 
									?>
									<div class="col-lg-2 mb-1">
										<a href="#" class="btn btn-lg btn-danger btn-block" onclick="deleteJO('<?php echo $jo_num ?>')">DELETE</a>
									</div>
									<?php
								}
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
