<?php
include('../../assets/conn/etc.php');
$userName = p('userName');
$password = p('password');
$userType = p('userType');
$nameUser = p('nameUser');
$userAddress = p('userAddress');
$contactNo = p('contactNo');
$datenow = getdatetime();

if(trim($userName) !== ""){
    $r = get_value("SELECT username from users WHERE username = '$userName'");
if (empty($r)) {
	qr("INSERT INTO users (username, password, name, address, contact_number, created_at, user_type) VALUES 
		('$userName', '$password', '$nameUser', '$userAddress', '$contactNo', '$datenow', '$userType')");
	saveUserLog(null, "CREATED NEW USER RECORD. $userName $userType");
	echo 'User recorded.';
}
else{
	echo 'Username already used.';
}
}


?>