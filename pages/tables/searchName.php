	<?php 
	include('../../assets/conn/etc.php');
	$searchTxt = p('txt');


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
		WHERE jonamestbl.jo_status = '6' AND ((fname like '%$searchTxt%') or (lname like '%$searchTxt%') or (mname like '%$searchTxt%') or (CONCAT(lname, ' ', fname, ' ', mname) like '%$searchTxt%') 
			or (CONCAT(fname, ' ', mname, ' ', lname) like '%$searchTxt%') or (CONCAT(fname, ' ', lname) like '%$searchTxt%') or (CONCAT(lname, ' ', fname) like '%$searchTxt%'))
		GROUP BY jonamestbl.employee_id
		ORDER BY lname, mname, fname DESC LIMIT 5");

	foreach ($r as $key => $v) {
		?>
		<a href="#" onclick="add_payroll('<?php echo $v["employee_id"] ?>');" data-toggle="tooltip" title="<?php echo $v["office_name"] ?>"><?php echo $v["fullname"] ?></a> |  
		<?php
	}
?>
<hr>