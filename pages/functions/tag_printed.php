<?php
include('../../assets/conn/etc.php');
session_start();
$user_id = $_SESSION["user_id"];
$datetime = datetime();


qr("UPDATE payrolltbl SET status = 1, print_date = '$datetime' WHERE status is null and user_id = '$user_id'");
saveUserLog(null, "TAGGED PAYROLL AS PRINTED. PRINTDATE: $datetime");
echo "PAYROLL TAGGED AS PRINTED";
?>