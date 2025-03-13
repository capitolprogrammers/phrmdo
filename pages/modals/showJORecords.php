<?php 
include('../../assets/conn/etc.php');
$id = p("id");
$r = get_array("SELECT id, employeetbl.employee_id, contract_start, contract_end, contract_status, days, office_id, designation_id, jonamestbl.note, jotbl.status, jonamestbl.jo_number from jonamestbl  
	INNER JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id 
	INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number 
	WHERE jonamestbl.employee_id = '$id' GROUP BY jotbl.jo_number ORDER BY contract_start ASC");
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h5 class="card-header">
					<?php echo getData($id, 'name'); ?><br>
					<small>Show JO Records</small>
				</h5>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered table-hover">
								<thead class="thead">
									<th>#</th>
									<th>JO Number</th>
									<th>Office</th>
									<th>Designation</th>
									<th>Rate</th>
									<th>Period</th>
									<th>Status</th>
									<!-- <th>Includings</th> -->
									<th>JO Status</th>
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

										$x = get_value("SELECT jo_status from jonamestbl WHERE id = '$joid'");
										?>
										<tr data-toggle="tooltip" title="<?php echo $v["note"] ?>" onclick="showJO('<?php echo $v["jo_number"] ?>')"
											<?php 
											if($x[0] == "8"){
												echo "class='table-danger text-white'";
											}
											else if($x[0] == 6){
												echo "class='table-info text-white'";
											}
											?>
											>
											<td><?php echo $num ?></td>
											<td><?php echo $v["jo_number"] ?><br><small style="font-size: 10px;">
												<?php 
												$co = get_value("SELECT c_o from employeetbl WHERE employee_id = '$emp_id'");
												if ($co[0] != "") {
													echo "C/O: " . $co[0];
												}
												?>
											</small></td>
											<td><?php echo $office ?></td>
											<td><?php echo $des[0] ?></td>
											<td><?php echo $des[1] ?></td>
											<td><?php echo $datefrom . ' - ' . $dateto . ', ' . $year;  ?></td>
											<td><?php echo getContract($v["contract_status"]) ?></td>
											<!-- <td><?php echo getDays($v["days"]) ?></td>								 -->
											<td>
												<?php 
												if($x[0] == "8"){
													echo "Cancelled";
												}
												else{
													echo getStatus($v["status"]); 
												}
												?>
											</td>
										</tr>
										<?php
										$num++;
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