<?php
include('../../assets/conn/etc.php');
$id = p('id');

qr("UPDATE designationtbl SET status = 1 WHERE designation_id = '$id'");
saveUserLog($id, "REMOVED DESIGNATION record.");
echo "Designation record removed.";
?>