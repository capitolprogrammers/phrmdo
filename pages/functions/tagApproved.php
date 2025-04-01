<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$account_code = p('account_code');
$res_center = p('res_center');

qr("UPDATE jotbl set status = '4', acct_code = '$account_code', res_center = '$res_center' WHERE jo_number = '$joid'");
saveUserLog($joid, "TAGGED JO CONTRACT AS APPROVED. ACCT CODE: $account_code RES CENTER: $res_center");
?>