<?php
session_start();
include('../../assets/conn/etc.php');
$joid = p('joid');
$user_id = $_SESSION["user_id"];

qr("UPDATE jotbl set status = '3' WHERE jo_number = '$joid' AND added_by = '$user_id'");
saveUserLog($joid, "TAGGED JO EMPLOYEE CONTRACT AS SIGNED BY HRMO.");
?>