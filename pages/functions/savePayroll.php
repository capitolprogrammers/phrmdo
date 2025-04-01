<?php
include('../../assets/conn/etc.php');
session_start();
$jo_id  = p('jo_id');

$employee_id = p('id');

$payroll_id = p('payroll_id');
$datefrom = p('datefrom');
$dateto = p('dateto');
$workday = p('workday');
$undertime = p('undertime');
$pagibig = p('pagibig');

$sss = p('sss');

$gross = p('gross');
$deduction = p('deduction');
$total = p('total');
$user_id = $_SESSION["user_id"];

$check = get_value("SELECT count(*) from payrolltbl WHERE jo_id = '$jo_id' and datefrom = '$datefrom' and dateto = '$dateto' and workdays = '$workday'")[0];
if (empty($check) || $check == 0) {
	// insert record
	saveUserLog($employee_id, "ADDED PAYROLL RECORD $datefrom - $dateto. NETPAY: $total");

	qr("INSERT INTO payrolltbl (payroll_id, employee_id, jo_id, workdays, undertime, pagibig, sss, gross,netpay,datefrom, dateto, user_id) VALUES ('$payroll_id', '$employee_id', '$jo_id', '$workday', '$deduction', '$pagibig', '$sss', '$gross', '$total', '$datefrom', '$dateto', '$user_id')");
	echo 'SUCCESS: Record Saved';

}
else{
	echo 'ERROR: Duplicate Record';
}
//echo 'hello world'
?>