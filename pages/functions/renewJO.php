	<?php
	session_start();
	include('../../assets/conn/etc.php');
	$joid = p('joid');
	
 
	
	
	$newJONO = p('newJONO');

	$monthfrom = p('from');
	$monthto = p('to');

	$fundingID = p('fundingID');
	$programID = p('programID');

	$user_id = $_SESSION["user_id"];
	
		$co_note = get_value("SELECT co_note from jonotestbl WHERE jo_number = '$joid'")[0];

	$jotblData = get_value("SELECT fund_id, program_id, note, date_added from jotbl WHERE jo_number = '$joid'");

	$fund_id = $jotblData["fund_id"];
	$program_id = $jotblData["program_id"];
	$note = $jotblData["note"];

	$contract = p('contract');

	$datenow = getdatetime();

	qr("INSERT INTO jotbl (jo_number, fund_id, program_id, note, status, date_added, added_by) VALUES
		('$newJONO', '$fundingID', '$programID', '$note', '1', '$datenow', '$user_id')");
		
		qr("INSERT INTO jonotestbl (jo_number, date_saved, co_note) VALUES ('$newJONO', '$datenow', '$co_note')");


	$jotblNameData = get_array("SELECT employee_id, office_id, designation_id, contract_start, contract_end, contract_status, days, note, date_added, added_by from jonamestbl WHERE jo_number = '$joid'");

	foreach ($jotblNameData as $key => $v) {
		$employee_id = $v["employee_id"];
		$office_id = $v["office_id"];
		$designation_id = $v["designation_id"];
		$contract_start = $monthfrom;
		$contract_end = $monthto; 
		$contract_status = $contract;
		$days = $v["days"];
		$note = $v["note"];
		$date_added = $v["date_added"];
		$added_by = $v["added_by"];

		qr("INSERT INTO jonamestbl (jo_number, employee_id, office_id, designation_id, contract_start, contract_end, contract_status, days, note, date_added, added_by) VALUES 
			('$newJONO', '$employee_id', '$office_id', '$designation_id', '$contract_start', '$contract_end', '$contract_status', '$days', '$note', '$datenow', '$user_id')");

		saveUserLog($employee_id, "ADDED ON $newJONO JO RECORD(RENEW JO).");
	}


	saveUserLog($joid, "RENEWED JO RECORD. NEW JO NUMBER $newJONO .");


	?>