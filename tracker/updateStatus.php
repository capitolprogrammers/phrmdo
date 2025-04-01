<?php 
include('../assets/conn/etc.php');
$pid = $_POST["payrollId"];
$status = $_POST["status"];
$datenow = datetime();
$newstats = '';
switch ($status) {
	case 'HR':
	$newstats = '1';
	break;

	case 'Budget':
	$newstats = '2';
	break;

	case 'Accounting':
	$newstats = '3';
	break;

	case 'PTO':
	$newstats = '4';
	break;

	case 'GO':
	$newstats = '5';
	break;

	case 'PA':
	$newstats = '6';
	break;

	case 'HR Register':
	$newstats = '7';
	break;

	case 'PTO(ADA)':
	$newstats = '8';
	break;

	default:
	$newstats = '0';
	break;
}

$checkPayrolltimeline = get_value("SELECT status, type, datetime from payrolltimeline WHERE payroll_id = '$pid' ORDER by id DESC LIMIT 1");
if ($checkPayrolltimeline[0] == "") {
    $type = 'received';
	qr("INSERT INTO payrolltimeline (payroll_id, status, type, datetime) VALUES ('$pid', '$newstats', '$type', '$datenow')");
	echo "Updated Status to " . $status;
	mysqli_close($c);
}
else{
    if ($checkPayrolltimeline[1] == "received") {
    	$type = 'released';
    }
    else {
    	$type = 'received';
    }
    qr("INSERT INTO payrolltimeline (payroll_id, status, type, datetime) VALUES ('$pid', '$newstats', '$type', '$datenow')");
	echo "Updated Status to " . $status;
	mysqli_close($c);
}
?>