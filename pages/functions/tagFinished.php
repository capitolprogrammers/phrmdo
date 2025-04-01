<?php
include('../../assets/conn/etc.php');
$joid = p('joid');

qr("UPDATE jotbl set status = '6' WHERE jo_number = '$joid'");
saveUserLog($joid, "TAGGED JO CONTRACT AS ACTIVE.");
?>