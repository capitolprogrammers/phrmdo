<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$empid = p('empid');
qr("UPDATE jonamestbl set jo_status = '8' WHERE jo_number = '$joid' AND employee_id = '$empid'");
saveUserLog($joid, "CANCELLED JO CONTRACT OF EMPLOYEE " . getData($empid, 'name'));
?>