	<?php 
	include('../../assets/conn/etc.php');
	$txt = p('txt');

	$r = get_array("SELECT office_id, office_name from officetbl WHERE office_name like '%$txt%'");
	foreach ($r as $key => $v) {
		?>
		<option value="<?php echo $v["office_id"] ?>"><?php echo $v["office_name"] ?></option>
		<?php
	}
	?>