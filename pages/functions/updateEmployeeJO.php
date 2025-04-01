<?php
include('../../assets/conn/etc.php');
$jonameid = p('jonameid');
$jonum = p('jonum');

$date_from = p('date_from');
$date_to = p('date_to');
$designations = p('designations');
$offices = p('offices');
$jo_remarks = p('jo_remarks');
$days = p('days');

$note = p('note');

//regular days = 1
//sat & holiday = 2
//sat & sun & holiday = 3

$datetime = getdatetime();

$r = get_value("SELECT * from jonamestbl WHERE id = '$jonameid'");
$designation = getDesignationName($r["designation_id"]);
$designation2 = getDesignationName($designations);

$office = getOfficeName($r["office_id"]);
$office2 = getOfficeName($offices);


$dateFrom = $r["contract_start"];
$dateTo = $r["contract_end"];
$daysz = $r["days"];
$contract_status = $r["contract_status"];

saveUserLog($jonameid, "UPDATED EMPLOYEE JO CONTRACT RECORD. JO NUMBER: $jonum DES: $designation OFFICE: $office FROM: $dateFrom TO: $dateTo DAYS: $days STATUS: $contract_status TO $designation2 $office2 $date_from $date_to $daysz $jo_remarks");

qr("UPDATE jonamestbl set office_id = '$offices', designation_id = '$designations', contract_start = '$date_from', contract_end = '$date_to', contract_status = '$jo_remarks', days = '$days', note = '$note' WHERE id = '$jonameid'");

// qr("INSERT INTO jonamestbl (jo_number, employee_id, office_id,designation_id,contract_start, contract_end, contract_status, days, date_added, added_by, note) VALUES ('$jonum', '$emp_id', '$offices', '$designations', '$date_from', '$date_to', '$jo_remarks', '$days', '$datetime', '$user_id', '$note')");

?>