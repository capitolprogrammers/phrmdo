<?php
include('../../assets/conn/etc.php');
$employeeid = p('employeeid');
$SSSNumber = p('SSSNumber');
$bankName = p('bankName');
$acctNumber = p('acctNumber');

$MonthlyContribution  = p('MonthlyContribution'); 
$remarks = p('remarks');

$checkFirst = get_value("SELECT count(*) from employeedata WHERE employee_id = '$employeeid'")[0];

if ($checkFirst == 0) {
	qr("INSERT INTO employeedata (employee_id, SSSNumber, bankName, acctNumber, monthlyContribution, remarks) VALUES ('$employeeid', '$SSSNumber', '$bankName', '$acctNumber', '$MonthlyContribution', '$remarks')");
	saveUserLog($employeeid, "SAVED Employee Data \n SSS Number: $SSSNumber \n Bank Name: $bankName \n Acct Number: \n $acctNumber \n MonthlyContribution: $MonthlyContribution \n remarks: $remarks");
}
else{
	qr("UPDATE employeedata SET SSSNumber = '$SSSNumber', bankName = '$bankName', acctNumber = '$acctNumber', monthlyContribution = '$MonthlyContribution', remarks = '$remarks' WHERE employee_id = '$employeeid'");
	saveUserLog($employeeid, "UPDATED Employee Data \n SSS Number: $SSSNumber \n Bank Name: $bankName \n Acct Number: \n $acctNumber \n MonthlyContribution: $MonthlyContribution \n remarks: $remarks");
}
?>