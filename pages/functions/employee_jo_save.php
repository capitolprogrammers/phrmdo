<?php
include('../../assets/conn/etc.php');
$emp_id = p('id');
$jono = p('jono');
$date_from = p('date_from');
$date_to= p('date_to');
$funding= p('funding');
$fund_id= p('fund_id');
$program= p('program');

$designations = p('designations');
$offices = p('offices');
$jo_remarks = p('jo_remarks');

$sathol = p('sathol');
$satsunhol = p('satsunhol');


//regular days = 1
//sat & holiday = 2
//sat & sun & holiday = 3
if ($sathol == "true" && $satsunhol == "false") {
	$days = "2";
}
else if($sathol == "false" && $satsunhol == "true"){
	$days = "3";
}
else {
	$days = "1";
}

$datetime = getdatetime();

saveUserLog($jono, "SAVED JO RECORD.");

qr("INSERT INTO jotbl (employee_id, jo_number, office_id,designation_id, contract_start, contract_end, contract_status, date_recorded, status, added_by, fund_id, program_id, days) VALUES ('$emp_id', '$jono', '$offices', '$designations', '$date_from', '$date_to', '$jo_remarks', '$datetime', '1', '$user_id', '$fund_id', '$program', '$days')");

?>