<?php
session_start();
include('../../assets/conn/etc.php');
$payroll_id = p('pid');
$user_id = $_SESSION['user_id'];


qr("UPDATE payrolltbl SET status = null, print_date = null, user_id = '$user_id' WHERE payroll_id = '$payroll_id'");
saveUserLog($payroll_id, "UPDATED PAYROLL STATUS TO FOR PRINTING.");
echo "PAYROLL TAGGED AS NOT PRINTED. PLEASE CHECK IN THE PAYROLL LIST";
?>