<?php
include('../../assets/conn/etc.php');
$arr = $_POST['myArray'];

// qr("UPDATE jotbl set status = '2' WHERE jo_number = '$joid'");
// saveUserLog($joid, "APPROVED JO CONTRACT RECORD.");

foreach ($arr as $key => $value) {
	$jonum = $value;

	qr("UPDATE jotbl set status = '2' WHERE jo_number = '$jonum'");

	qr("UPDATE jonotestbl SET note = CONCAT(note, '/', 'APPROVED AS RECOMMENDED') WHERE jo_number = '$jonum'");
	saveUserLog($jonum, "APPROVED JO CONTRACT RECORD AS RECOMMENDED.");
}
?>