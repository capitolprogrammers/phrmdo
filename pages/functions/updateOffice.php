<?php
include('../../assets/conn/etc.php');

$id = p('id');
$officename = p('officeName');
$datenow = getdatetime();


saveUserLog($id, "UPDATED OFFICE RECORD $officename");
qr("UPDATE officetbl SET office_name = '$officename' WHERE office_id = '$id'");
echo "Record Updated.";
?>