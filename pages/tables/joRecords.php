	<?php 
	session_start();
	include('../../assets/conn/etc.php');
	
	$user_id = $_SESSION["user_id"];
	// $r = get_value("SELECT * from employeetbl WHERE employee_id = '$id'");


	// echo "SELECT * from jotbl INNER JOIN fundingtbl ON fundingtbl.fund_id = jotbl.fund_id INNER JOIN programtbl ON programtbl.program_id = jotbl.program_id $query ORDER BY monthno, jotbl.jo_number ASC";


	if (isset($_POST["searchTxt"]) && isset($_POST["searchTxt"]) != "") {
		$searchTxt = $_POST["searchTxt"];
		
		$query = '';
		$condition = '';

		if($_SESSION["user_type"] == "admin"){
			$query = " INNER JOIN jonotestbl ON jonotestbl.jo_number = jotbl.jo_number ";
			$condition = " AND jotbl.status = 1 AND jonotestbl.note like '%REVIEWED%' ";
		}
		else{
			$query = '';
			$condition = '';
		}


		$r = get_array("SELECT * from jotbl LEFT JOIN fundingtbl ON fundingtbl.fund_id = jotbl.fund_id LEFT JOIN programtbl ON programtbl.program_id = jotbl.program_id INNER JOIN jonamestbl ON jonamestbl.jo_number = jotbl.jo_number INNER JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id INNER JOIN officetbl ON officetbl.office_id = jonamestbl.office_id WHERE 
			((fname like '%$searchTxt%') or (lname like '%$searchTxt%') or (mname like '%$searchTxt%') or (CONCAT(lname, ' ', fname, ' ', mname) like '%$searchTxt%') 
				or (CONCAT(fname, ' ', mname, ' ', lname) like '%$searchTxt%') or (CONCAT(fname, ' ', lname) like '%$searchTxt%') or (CONCAT(lname, ' ', fname) like '%$searchTxt%')) or jotbl.jo_number like '%$searchTxt%' or office_name like '%$searchTxt%' GROUP BY jotbl.jo_number ORDER BY SUBSTR(jotbl.jo_number, -4, 6) ASC");
	}
	else{

		$query = '';
		
		if($_SESSION["user_type"] == "admin"){
			$query = " INNER JOIN jonotestbl ON jonotestbl.jo_number = jotbl.jo_number WHERE status = 1 AND jonotestbl.note like '%REVIEWED%' ";
		}
		else{
			$query = '';
		}

		$r = get_array("SELECT * from jotbl LEFT JOIN fundingtbl ON fundingtbl.fund_id = jotbl.fund_id LEFT JOIN programtbl ON programtbl.program_id = jotbl.program_id $query ORDER BY SUBSTR(jotbl.jo_number, -4, 6) ASC");

	}
	?>
	<table class="table table-condensed table-hover" id="tableJO">
		<thead>
			<th>#</th>
			<th width="300px">Action</th>
			<th>Status</th>

			<th>J.O #</th>
			<th>Additional Note</th>
			<th>C/O</th>
			<th>Funding</th>
			<th>Program</th>
			<th>Account Code</th>
		</thead>
		<tbody>
			<?php
			$num=1; 
			foreach ($r as $key => $v) {
				$jonum = $v["jo_number"];
				$jonotes = '';
				$conotes = '';
				$note = get_value("SELECT note, co_note from jonotestbl WHERE jo_number = '$jonum'");
				if (empty($note)) {
					$jonotes = 'No note recorded';
						$conotes = 'None';
				
				}
				else{
					$jonotes = $note["note"];
						 $conotes = $note["co_note"];
				}
				?>
				<tr data-toggle="tooltip" title="<?php echo $v["note"] ?>">
					<td><?php echo $num ?></td>
					<td>
						<?php 
						if ($_SESSION["user_type"] == "admin") {
							?>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" style="margin-top: 20px!important;" id="<?php echo $v["jo_number"] ?>" onclick="selectJO('<?php echo $v["jo_number"] ?>')"/> <i class="input-helper"></i>
									<button onclick="showJO('<?php echo $v["jo_number"] ?>')" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i> View</button>
								</label>
							</div>
							<?php
						}
						else{
							?>
							<button onclick="showJO('<?php echo $v["jo_number"] ?>')" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i> View</button>
							<?php
						}
						?>
						
					</td>
					<td><div class="badge badge-info badge-pill"><?php echo getStatus($v["status"]); ?></div></td>
					
					<td><?php echo $v["jo_number"] ?><br><small>Dated Saved: <?php echo $v["date_added"] ?></small></td>
					<td><div class="badge badge-primary badge-pill"><?php echo $jonotes; ?></div></td>
						<td><div class="badge badge-info badge-pill"><?php echo $conotes; ?></div></td>
					<td><?php echo $v["funding_name"] ?></td>
					<td><?php echo $v["program_name"] ?></td>
					<td><?php echo $v["acct_code"] ?></td>
				</tr>
				<?php
				$num++;
			}
			?>
		</tbody>
	</table>