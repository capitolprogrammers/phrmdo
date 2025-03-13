<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$empid = p('empid');
$emp_name = getData($empid, 'name');

qr("UPDATE jonamestbl set jo_status = '6' WHERE jo_number = '$joid' and employee_id = '$empid'");
saveUserLog($joid, "TAGGED JO EMPLOYEE AS ACTIVE/SIGNED CONTRACT. $emp_name");
?>