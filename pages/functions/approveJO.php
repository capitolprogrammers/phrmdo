<?php
include('../../assets/conn/etc.php');
$joid = p('joid');

qr("UPDATE jotbl set status = '2' WHERE jo_number = '$joid'");
saveUserLog($joid, "APPROVED JO CONTRACT RECORD.");
?>