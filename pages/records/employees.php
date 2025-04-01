	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h5 class="card-header">
					Employee(s)
				</h5>
				<div class="card-body">

					<form method="POST">

						<div class="row">
							
							<div class="col-lg-6">
								<div class="form-group">
									<input type="text" class="form-control form-control-lg text-center" name="searchEmployee" placeholder="Employee Name">
								</div>
								
							</div>
							<div class="col">
								<button type="submit" name="searchBtn" class="btn btn-lg btn-primary btn-outline btn-block">SEARCH</button>
							</div>
							<div class="col"><button type='button' class="btn btn-info btn-lg mb-2 btn-block" onclick="newEmployee()">NEW EMPLOYEE</button></div>

						</div>
					</form>
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive"  style="min-height: 200px;" <?php echo responsive(50) ?>>
								<table class="table table-condensed table-hover" id="tableJO">
									<thead>
										<th>#</th>
										<th>Fullname</th>
										<th>Address</th>
										<th>Gender</th>
										<th>Birthday</th>
										<th>Phonenum</th>
										<th>Contracts</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
										$num=1; 
										if (isset($_POST["searchBtn"])) {
											$searchTxt = $_POST["searchEmployee"];

											$num = 1;

											$r = get_array("SELECT employee_id, CONCAT(lname, ', ', fname, ' ', mname)as fullname, address, gender, bday, phonenum, note, c_o from employeetbl WHERE 	((fname like '%$searchTxt%') or (lname like '%$searchTxt%') or (mname like '%$searchTxt%') or (CONCAT(lname, ' ', fname, ' ', mname) like '%$searchTxt%') 
												or (CONCAT(fname, ' ', mname, ' ', lname) like '%$searchTxt%') or (CONCAT(fname, ' ', lname) like '%$searchTxt%') or (CONCAT(lname, ' ', fname) like '%$searchTxt%'))  order by lname, fname asc");

											foreach ($r as $key => $v) {
												$id = $v[0];
												?>
												<tr>
													<td><?php echo $num ?></td>
													
													<td><?php echo getData($id, 'name'); ?></td>
													<td><?php echo $v["address"] ?></td>
													<td><?php echo $v["gender"] ?></td>
													<td><?php echo $v["bday"] ?></td>
													<td><?php echo $v["phonenum"] ?></td>
													<td>
														<?php 
														$r2 = get_value("SELECT count(*) from jonamestbl WHERE employee_id = '$id'")[0];
														echo "JO Contracts: " . $r2;
														?>
													</td>
													<td>
														<div class="dropdown">
															<button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="mdi mdi-settings"></i>
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6" style="">
																<!-- <h6 class="dropdown-header">Settings</h6> -->
																<a class="dropdown-item" href="#" onclick="viewRecord('<?php echo $v["employee_id"] ?>')">View record</a>
																<a class="dropdown-item" href="#" onclick="showJORecords('<?php echo $v["employee_id"] ?>')">Show JO Records</a>
																<a class="dropdown-item" href="#" onclick="addData('<?php echo $v["employee_id"] ?>')">Add Data</a>
																<a class="dropdown-item" href="#" onclick="editEmployee('<?php echo $v["employee_id"] ?>')">Edit basic info</a>
																<a class="dropdown-item" href="#">Add PDS data</a>
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="#" onclick="delete_employee('<?php echo $v["employee_id"] ?>')">Delete</a>
															</div>
														</div>
													</td>
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
