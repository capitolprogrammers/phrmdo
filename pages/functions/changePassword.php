<?php
include('../../assets/conn/etc.php');
$password = p("pw");
$id = $_SESSION["user_id"];
qr("UPDATE users set password = '$password' WHERE id = '$id'");
saveUserLog($id, "UPDATED HIS/HER PASSWORD.");
?>