	<?php 
	include('../../assets/conn/etc.php');
	$txt = p('txt');
	$jonum = p('jonum');
	if ($txt != "") {
		$r = get_array("SELECT employee_id, trim(fname) as fname, trim(mname) as mname, trim(lname) as lname, address, bday, gender from employeetbl WHERE (trim(lname) like '%$txt%' or trim(fname) like '%$txt%' or trim(mname) like '%$txt%' or CONCAT(trim(lname), ' ', trim(fname), ' ', trim(mname)) like '%$txt%' or CONCAT(trim(lname), ', ', trim(fname), ' ', trim(mname)) like '%$txt%') LIMIT 10");

		foreach ($r as $key => $v) {
			$emp_id = $v[0];
			$r2 = get_value("SELECT count(*) from jonamestbl WHERE employee_id = '$emp_id'")[0];
			?>
			<button class="btn btn-dark m-1" type="button" data-toggle="tooltip" tabindex="0" title="Address : <?php echo $v["address"] ?>  Birthday: <?php echo $v["bday"] ?> <?php echo "JO Contracts: " . $r2; ?>" onclick="select_employee('<?php echo $emp_id; ?>','<?php echo $jonum ?>')"><?php echo $v["lname"] . ', ' . $v["fname"] . ' ' . $v["mname"]; ?></button>
			<?php
		}
	}
	?>