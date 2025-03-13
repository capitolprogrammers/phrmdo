<?php
session_start();
include('../../assets/conn/etc.php');
$officename = p('officename');
$datenow = getdatetime();
$user_id = $_SESSION["user_id"];

$r = get_value("SELECT count(*) from officetbl WHERE office_name = '$officename'");

if ($r[0] == 0) {
	saveUserLog(null, "CREATED NEW OFFICE RECORD $officename.");
	qr("INSERT INTO officetbl (office_name, date_saved, added_by) VALUES ('$officename', '$datenow', '$user_id')");
	echo "<div class='alert alert-info mt-2'>RECORD SAVED.</div>";
}
else{
	echo "<div class='alert alert-warning mt-2'>DUPLICATE RECORD.</div>";
}
?>