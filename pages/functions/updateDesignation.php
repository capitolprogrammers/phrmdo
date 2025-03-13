<?php
include('../../assets/conn/etc.php');

$id = p('id');
$designationName = p('designationName');
$rate = p('rate');
$datenow = getdatetime();

qr("UPDATE designationtbl SET designation_name = '$designationName', rate = '$rate' WHERE designation_id = '$id'");
saveUserLog($id, "UPDATED DESIGNATION RECORD $designationName RATE: $rate");
echo "Record Updated.";
?>