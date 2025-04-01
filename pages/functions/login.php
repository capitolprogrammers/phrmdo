<?php
session_start();
include('../../assets/conn/etc.php');
$username = p('username');
$password = p('password');
if($username !== "" && $password !== ""){
    $r = get_value("SELECT id, count(*) from users WHERE username = '$username' and password = '$password'");
if ($r[1] == 0) {
	echo "QWQWQWEQWEQWE";
}
else {
	$_SESSION["user_id"] = $r[0];
		saveUserLog(null, "LOGGED IN.");
}
}

?>