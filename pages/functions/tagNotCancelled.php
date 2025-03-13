<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$empid = p('empid');
qr("UPDATE jonamestbl set jo_status = null WHERE jo_number = '$joid' AND employee_id = '$empid'");
saveUserLog($joid, "RESET JO CONTRACT STATUS OF EMPLOYEE " . getData($empid, 'name'));
?>