<?php
include('../../assets/conn/etc.php');
session_start();
$id = p('id');
$joid = p('joNum');
$user_id = $_SESSION['user_id'];

$off = get_value("SELECT office_name from jotbl INNER JOIN officetbl ON officetbl.office_id = jotbl.office_id WHERE jo_number = '$joid'");
$r = get_value("SELECT status from jotbl WHERE jo_number = '$joid'")[0];
// $d = '';
// $x = '';
// if ($r[0] != 1) {
// 	$d = 'none';
// }
// else{
// 	$x = 'none';
// }
?>
<div class="card">
	<h5 class="card-header">J.O Number : <?php echo $joid; ?><br><small>Office : <?php echo $off[0] ?></small></h5>
	<div class="card-body">
		<div class="row">
			<div class="col-lg-3">
				<?php 
				switch ($r[0]) {
					case '1':
					?>
					<div class="row">
						<div class="col-lg-12 mb-5">
							<div class="align-item-center">
								<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagPrinted('<?php echo $joid ?>')">Tag as Printed</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="#" class="btn btn-lg btn-primary btn-block" onclick="addNote('<?php echo $joid ?>')">Add Note</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_letter.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print Availability of Funds</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_contract.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print J.O Contract</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="#" class="btn btn-lg btn-warning btn-block" onclick="deleteJO('<?php echo $joid ?>')">Delete</a>
							</div>
						</div>
					</div>
					<?php
					break;

					case '2':
					?>
					<div class="row">
						<div class="col-lg-12 mb-2">
							<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagSigned('<?php echo $joid ?>')">Tag as Signed(HRMO)</a>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_letter.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print Availability of Funds</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_contract.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print J.O Contract</a>
							</div>
						</div>
					</div>
					<?php
					break;

					case '3':
					?>
					<div class="row">
						<div class="col-lg-12 mb-2">
							<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagApprovedModal('<?php echo $joid ?>')">Tag as Budget Approved</a>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_letter.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print Availability of Funds</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_contract.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print J.O Contract</a>
							</div>
						</div>
					</div>
					<?php
					break;

					case '4':
					?>
					<div class="row">
						<div class="col-lg-12 mb-2">
							<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagForSigningGov('<?php echo $joid ?>')">Tag as Signed by Gov</a>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_letter.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print Availability of Funds</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_contract.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print J.O Contract</a>
							</div>
						</div>
					</div>
					<?php
					break;

					case '5':
					?>
					<div class="row">
						<div class="col-lg-12 mb-2">
							<a href="#" class="btn btn-lg btn-info btn-block" onclick="tagActive('<?php echo $joid ?>')">Tag as Active</a>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_letter.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print Availability of Funds</a>
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="align-item-center">
								<a href="pages/print/print_contract.php?joid=<?php echo $joid ?>" target="_blank" class="btn btn-lg btn-primary btn-block">Print J.O Contract</a>
							</div>
						</div>
					</div>
					<?php
					break;
					
					default:

					break;
				}
				?>
			</div>			

			<div class="col-lg-9">
				<table class="table table-condensed">
					<thead>
						<th>#</th>
						<th>Fullname</th>
						<th>Designation</th>
						<th>Rate</th>
						<th>Period</th>
						<th>Remarks</th>
					</thead>
					<tbody>
						<?php 
						$num = 1;
						$r = get_array("SELECT * from jotbl INNER JOIN officetbl ON officetbl.office_id = jotbl.office_id INNER JOIN designationtbl ON designationtbl.designation_id = jotbl.designation_id WHERE jotbl.jo_number = '$joid'");
						foreach ($r as $key => $v) {
							$emp_id = $v["employee_id"];
							?>
							<tr>
								<td><?php echo $num; ?></td>
								<td><?php echo getData($emp_id, 'name'); ?></td>
								<td><?php echo $v["office_name"] ?></td>
								<td><?php echo $v["rate"] ?></td>
								<td><?php echo formatdate($v["contract_start"], '') . ' - ' . formatdate($v["contract_end"], '') ; ?></td>
								<td><?php echo getContract($v["contract_status"]); ?></td>
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