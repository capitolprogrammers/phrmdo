<?php
include('../../assets/conn/etc.php');
$id = p('id');
$type = p("type");
$fundingNameEdit = p('fundingNameEdit');
$fundingCodeEdit = p('fundingCodeEdit');

switch ($type) {
	case 'update':
	saveUserLog($id, "UPDATED FUNDING DATA $fundingNameEdit  $fundingCodeEdit");
	qr("UPDATE fundingtbl SET funding_name = '$fundingNameEdit', funding_code = '$fundingCodeEdit' WHERE fund_id = '$id'");
	echo 'FUNDING UPDATED';
	break;
	
	case 'delete':
	saveUserLog($id, "DELETED FUNDING DATA $fundingNameEdit  $fundingCodeEdit");
	qr("DELETE from fundingtbl WHERE fund_id = '$id'");
	echo 'FUNDING REMOVED';
	break;

	default:
		// code...
	break;
}

?>