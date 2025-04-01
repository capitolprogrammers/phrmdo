<?php
include('../../assets/conn/etc.php');
$jonum = p('jonum');
$account_code = p('account_code_edit');
$res_center = p('res_center_edit');

$programId = p('programEdit');

$statusEdit = p('statusEdit');


saveUserLog($jonum, "UPDATED JO RECORD ACCT CODE: $account_code $res_center $statusEdit");
qr("UPDATE jotbl set acct_code = '$account_code', res_center = '$res_center', program_id = '$programId', status = '$statusEdit' WHERE jo_number = '$jonum'");
?>