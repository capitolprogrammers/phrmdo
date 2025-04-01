<?php
session_start();
include('../../assets/conn/etc.php');
$payroll_id = p('pid');
$newPayrollId = md5(uniqid());
$user_id = $_SESSION["user_id"];

qr("UPDATE payrolltbl SET status = null, print_date = null, payroll_id = '$newPayrollId', user_id = '$user_id' WHERE id = '$payroll_id'");
saveUserLog($payroll_id, "UPDATED PAYROLL STATUS TO FOR PRINTING(INDIVIDUAL).");
echo "PAYROLL TAGGED AS NOT PRINTED. PLEASE CHECK IN THE PAYROLL LIST";
?>