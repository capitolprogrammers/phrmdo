<?php 
include('../../assets/conn/etc.php');
$payroll_id = p('payrollId');
$id = p("id");
$emp_id = get_value("SELECT employee_id from payrolltbl WHERE id = '$id'")[0];
$datePrinted = get_value("SELECT print_date from payrolltbl WHERE payroll_id = '$payroll_id'")[0];
$r = get_array("SELECT 
	payroll_id,
	fname,
	mname,
	lname,
	designation_name,
	office_name,
	workdays, 
	undertime,
	pagibig,
	sss,
	gross,
	netpay,
	jo_number,
	datefrom,
	dateto,
	user_id,
	payrolltbl.id as payrolllegitid
	FROM
	payrolltbl
	INNER JOIN
	jonamestbl ON jonamestbl.id = payrolltbl.jo_id
	INNER JOIN
	employeetbl ON employeetbl.employee_id = payrolltbl.employee_id
	INNER JOIN
	designationtbl ON designationtbl.designation_id = jonamestbl.designation_id
	INNER JOIN 
	officetbl ON officetbl.office_id = jonamestbl.office_id WHERE payroll_id = '$payroll_id'");
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<h5 class="card-header">
					Date Printed: <?php echo $datePrinted ?><br>
					<small class="card-description">Payroll ID: <?php echo $payroll_id ?></small>
				</h5>
				<div class="card-body">
					<div class="table-responsive" <?php responsive(60); ?>>
						<table class="table table-bordered table-hover">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Designation</th>
								<th>Office</th>
								<th>Workdays</th>
								<th>Undertime</th>
								<th>Pagibig</th>
								<th>SSS</th>
								<th>Gross</th>
								<th>Netpay</th>
								<th>DateFrom</th>
								<th>DateTo</th>
							</thead>
							<tbody>
								<?php 
								$num =1;
								foreach ($r as $key => $v) {
									$sss = 0;
									if ($v["sss"] != "") {
										$sss = $v["sss"];
									}
									?>
									<tr onclick="editPayrollInfo('<?php echo $v['payrolllegitid'] ?>')">
										<td><?php echo $num; ?></td>
										<td><?php echo $v["lname"] . ', ' . $v["fname"] . ' ' . $v['mname']; ?></td>
										<td><?php echo $v["designation_name"] ?></td>
										<td><?php echo $v["office_name"] ?></td>
										<td><?php echo $v["workdays"] ?></td>
										<td><?php echo $v["undertime"] ?></td>
										<td><?php echo $v["pagibig"] ?></td>
										<td><?php echo $sss; ?></td>
										<td><?php echo $v["gross"] ?></td>
										<td><?php echo $v["netpay"] ?></td>
										<td><?php echo $v["datefrom"] ?></td>
										<td><?php echo $v["dateto"] ?></td>
									</tr>
									<?php
									$num++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<div class="row align-items-start">
						<div class="col-lg-2 mb-1">
							<button class="btn btn-info btn-lg btn-block" onclick="reprint('<?php echo $payroll_id ?>')">REPRINT <strong>ALL</strong></button>
						</div>
						<div class="col-lg-4 mb-1">
							<button class="btn btn-warning btn-lg btn-block" data-toggle="tooltip" title="REPRINT DATE: <?php echo formatdate($v["datefrom"], 0) . ' - ' . formatdate($v["dateto"], 1); ?>" onclick="reprint_individual('<?php echo $id ?>')">REPRINT <strong><?php echo strtoupper(getData($emp_id, 'name')); ?></strong></button>
						</div>
		
			    <?php
			        if($_SESSION["user_type"] == "findes"){
			            ?>
			            	<div class="col-lg-4 mb-1">
			            	<a href="./pages/print/findes_export.php?payroll_id=<?php echo $payroll_id ?>" class="btn btn-primary btn-lg btn-block" target="_blank">OPEN IN FINDES FORMAT</a>
			         	</div>
		
			            <?php
			        }
			    ?>
						
					
					</div>
				</div>
			</div>
		</div>
	</div>