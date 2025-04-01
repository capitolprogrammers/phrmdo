<?php
include('../../assets/conn/etc.php');
$id = p("payroll_id");
qr("DELETE from payrolltbl WHERE id = '$id'");
saveUserLog($id, "REMOVED Payroll record.");
echo "PAYROLL RECORD DELETED";
?>