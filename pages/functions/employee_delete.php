<?php
include('../../assets/conn/etc.php');
$id = p("id");
saveUserLog($id, "REMOVED EMPLOYEE RECORD.");
qr("DELETE from employeetbl WHERE employee_id = '$id'");
qr("DELETE from jonamestbl WHERE employee_id = '$id'");
qr("DELETE from banktbl WHERE employee_id = '$id'");
echo "EMPLOYEE RECORD DELETED";
?>