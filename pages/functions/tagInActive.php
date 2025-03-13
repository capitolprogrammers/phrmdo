<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$empid = p('empid');
$emp_name = getData($empid, 'name');

qr("UPDATE jonamestbl set jo_status = null WHERE jo_number = '$joid' and employee_id = '$empid'");
saveUserLog($joid, "TAGGED JO EMPLOYEE CONTRACT AS INACTIVE/UNSIGNED $emp_name");
?>