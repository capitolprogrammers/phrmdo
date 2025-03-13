	<?php 
	include('../../assets/conn/etc.php');
	?>
	<table class="table table-hover" id="employees">
		<thead>
			<tr>
				<th width="20px">#</th>
				<th width="200px">Fullname</th>
				<th width="20px">Office</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$r = get_array("SELECT 
				employeetbl.employee_id,
				CONCAT(lname, ', ', fname, ' ', mname) AS fullname,
				address,
				gender,
				bday,
				phonenum,
				c_o, 
				office_name
				FROM
				employeetbl
				INNER JOIN jonamestbl ON jonamestbl.employee_id = employeetbl.employee_id
				INNER JOIN officetbl ON jonamestbl.office_id = officetbl.office_id
				INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number
				WHERE jonamestbl.jo_status = '6'
				GROUP BY jonamestbl.employee_id
				ORDER BY lname, mname, fname DESC");
			$num = 1;
			foreach ($r as $key => $value) {
				$id = $value[0];
				?>
				<tr onclick="add_payroll('<?php echo $value["employee_id"] ?>')">
					<td><?php echo $num ?></td>
					<td><?php echo getData($id, 'name') ?></td>
					<td><?php echo $value["office_name"] ?></td>
				</tr>
				<?php 
				$num++;
			} 
			?>
			<!-- add more rows as needed -->
		</tbody>
	</table>