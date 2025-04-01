<?php
include('../../assets/conn/etc.php');
$array = array();
$r = get_array("SELECT jotbl.jo_number from jotbl  INNER JOIN jonotestbl ON jotbl.jo_number = jonotestbl.jo_number WHERE status = 1 and jonotestbl.note like '%REVIEWED%'");
foreach ($r as $key => $value) {
	array_push($array, $value[0]);
}
echo json_encode($array);
?>