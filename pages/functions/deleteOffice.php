<?php
include('../../assets/conn/etc.php');
$id = p('id');
saveUserLog($id, "REMOVED OFFICE record.");
qr("DELETE FROM officetbl WHERE office_id = '$id'");
echo "Office record removed.";
?>