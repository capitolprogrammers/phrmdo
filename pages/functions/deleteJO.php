<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
saveUserLog($joid, "REMOVED JO CONTRACT record.");

qr("DELETE FROM jotbl WHERE jo_number = '$joid'");
qr("DELETE FROM jonamestbl WHERE jo_number = '$joid'");
?>