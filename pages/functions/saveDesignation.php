<?php
session_start();
include('../../assets/conn/etc.php');
$designationName = p('designationName');
$designationRate = p('designationRate');
$datenow = getdatetime();
$user_id = $_SESSION["user_id"];

$r = get_value("SELECT count(*) from designationtbl WHERE designation_name = '$designationName'");

if ($r[0] == 0) {
	saveUserLog(null, "CREATED NEW DESIGNATION RECORD $designationName $designationRate");
	qr("INSERT INTO designationtbl (designation_name,rate, date_saved, added_by) VALUES ('$designationName','$designationRate', '$datenow', '$user_id')");
	echo "Record Saved.";
}
else{
	echo "Duplicate Record.";
}
?>