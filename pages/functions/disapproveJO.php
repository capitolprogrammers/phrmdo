<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$user_id = $_SESSION["user_id"];
saveUserLog($joid, "DISAPPROVED JO.");
qr("UPDATE jotbl set status = '7' WHERE jo_number = '$joid'");
?>