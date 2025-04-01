	<?php 
	include('../../assets/conn/etc.php');
	?>
	<table class="table table-hover" id="employees">
		<thead>
			<tr>
				<th width="20px">#</th>
				<th width="100px">Action</th>
				<th>Fullname</th>
				<th>Contracts</th>
				<!-- <th width="100px">Address</th> -->
				<!-- <th width="20px">Gender</th> -->
				<!-- <th>PhoneNum</th> -->
				<!-- <th>Notes</th> -->

			</tr>
		</thead>
		<tbody>
			<?php
			$r = get_array("SELECT employee_id, CONCAT(lname, ', ', fname, ' ', mname)as fullname, address, gender, bday, phonenum, note, c_o from employeetbl order by lname, fname asc");
			$num = 1;
			foreach ($r as $key => $value) {
				$id = $value[0];
				?>
				<tr data-toggle="tooltip" title="C/O: <?php echo c($value["c_o"]) ?>">
					<td width="20px"><?php echo $num; ?></td>
					<td>
						<div class="dropdown">
							<button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="mdi mdi-settings"></i>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6" style="">
								<!-- <h6 class="dropdown-header">Settings</h6> -->
								<a class="dropdown-item" href="#" onclick="viewRecord('<?php echo $value["employee_id"] ?>')">View record</a>
								<a class="dropdown-item" href="#" onclick="showJORecords('<?php echo $value["employee_id"] ?>')">Show JO Records</a>
								<a class="dropdown-item" href="#" onclick="addData('<?php echo $value["employee_id"] ?>')">Add Data</a>
								<a class="dropdown-item" href="#" onclick="editEmployee('<?php echo $value["employee_id"] ?>')">Edit basic info</a>
								<a class="dropdown-item" href="#">Add PDS data</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" onclick="delete_employee('<?php echo $value["employee_id"] ?>')">Delete</a>
							</div>
						</div>
					</td>
					<td><?php echo c($value["fullname"]); ?><br><small>ID: <?php echo $id; ?></small></td>
					<td>
						
						<?php 
						$r2 = get_value("SELECT count(*) from jonamestbl WHERE employee_id = '$id'")[0];
						echo "JO Contracts: " . $r2;
						?>

					</td>
					<!-- <td><?php echo c($value["address"]); ?></td> -->
					<!-- <td width="20px"><?php echo c($value["gender"]); ?></td> -->
					<!-- <td><?php echo c($value["phonenum"]); ?></td> -->
					<!-- <td><?php echo c($value["note"]); ?></td> -->

				</tr>
				<?php 
				$num++;
			} 
			?>
			<!-- add more rows as needed -->
		</tbody>
	</table>