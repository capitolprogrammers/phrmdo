<?php
include('../../assets/conn/etc.php');
$id = p('id');
$type = p("type");
$programNameEdit = p('programNameEdit');
$office_select_edit = p('office_select_edit');

switch ($type) {
	case 'update':
	saveUserLog($id, "UPDATED PROGRAM RECORD $programNameEdit $office_select_edit");
	qr("UPDATE programtbl SET program_name = '$programNameEdit', office = '$office_select_edit' WHERE program_id = '$id'");
	echo 'PROGRAM UPDATED';
	break;
	
	case 'delete':
	saveUserLog($id, "DELETED PROGRAM RECORD $programNameEdit $office_select_edit");
	qr("DELETE from programtbl WHERE program_id = '$id'");
	echo 'PROGRAM REMOVED';
	break;

	default:
		// code...
	break;
}

?>