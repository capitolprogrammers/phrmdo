<?php
include('../../assets/conn/etc.php');
$id = p('id');

$r = get_value("SELECT * from jonamestbl WHERE id = '$id'");
$emp_name = getData($r["employee_id"], 'name');
$jonum = $r["jo_number"];

saveUserLog($id, "REMOVED $emp_name FROM JO record $jonum.");
qr("DELETE FROM jonamestbl WHERE id = '$id'");

?>