	<?php 
	include('../../assets/conn/etc.php');
	session_start();
	$user_id = $_SESSION["user_id"];
	// $r = get_value("SELECT * from employeetbl WHERE employee_id = '$id'");
	$r = get_array("SELECT * from jotbl INNER JOIN employeetbl ON jotbl.employee_id = employeetbl.employee_id INNER JOIN designationtbl ON designationtbl.designation_id = jotbl.designation_id INNER JOIN officetbl ON officetbl.office_id = jotbl.office_id WHERE added_by = '$user_id' GROUP BY jo_number ORDER BY jo_id DESC");
	?>
	<table class="table table-condensed">
		<thead>
			<th>#</th>
			<th>Status</th>
			<th>J.O #</th>
			<th>Period</th>
			<th>Office</th>
		</thead>
		<tbody>
			<?php
			$num=1; 
			foreach ($r as $key => $v) {
				$id = $v["employee_id"];
				$joid = $v["jo_number"];

				$start = formatdate($v["contract_start"], '');
				$end = formatdate($v["contract_end"], '');

				$contract_name = $v["contract_status"];
				if ($contract_name == 1) {
					$contract = "Renewal";
				}
				else if($contract_name == 2){
					$contract = "Original";
				}
				else if($contract_name == 3){
					$contract = "Re-Employment";
				}
				?>
				<tr onclick="showMenu('<?php echo $id ?>', '<?php echo $joid ?>')">
					<td><?php echo $num; ?></td>
					<td><span class="badge badge-info badge-pill"><?php echo getStatus($v["status"]); ?></span></td>
					<td><?php echo $v["jo_number"] ?></td>
					<td>
						<?php 
						echo $start . ' - ' . $end;
						?>
					</td>
					<td><?php echo $v["office_name"] ?></td>
				</tr>
				<?php
				$num++;
			}
			?>
		</tbody>
	</table>