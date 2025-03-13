	<?php 
	include('../../assets/conn/etc.php');
	$txt = p('txt');

	$r = get_array("SELECT designation_id, designation_name, rate from designationtbl WHERE designation_name like '%$txt%' and status is null");
	foreach ($r as $key => $v) {
		?>
		<option value="<?php echo $v["designation_id"] ?>"><?php echo $v["designation_name"] ?> | <?php echo $v["rate"] ?></option>
		<?php
	}
	?>