<?php
// session_start();
// include('../../assets/conn/etc.php');
// $cleanjono = p('cleanjono');

// $month = preg_replace('/[^a-zA-Z]/', '', $cleanjono);

// $r = get_value("SELECT TRIM(SUBSTR(jotbl.jo_number, -5, 10)) FROM jotbl  ORDER BY SUBSTR(jotbl.jo_number, -5, 10) DESC LIMIT 1");

// $last_digit = str_replace(" ", "", $r[0]);

// $newJONO = $cleanjono . ($last_digit + 1);
// echo $newJONO;



?>

	<?php
	session_start();
	include('../../assets/conn/etc.php');
	$cleanjono = p('cleanjono');
	$year = p('year');
	if ($year == '2023') {
		$year == "";
	}

	function formatToTenThousands($number) {
	    // Use str_pad to add zeros to the left of the number
	    $formattedNumber = str_pad($number, 5, '0', STR_PAD_LEFT);

	    return $formattedNumber;
	}

	//$month = preg_replace('/[^a-zA-Z]/', '', $cleanjono);

	if ($year == "24") {
		$cnt = get_value("SELECT count(*) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY jo_id desc LIMIT 1");
		if ($cnt[0] == 0) {
			//$last_digit = '00000';
			$newJONO = $cleanjono. $year ."-" .  '00001';
			echo $newJONO;
		}
		else{
			$r = get_value("SELECT TRIM(SUBSTR(jotbl.jo_number, -5, 10)) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY TRIM(SUBSTR(jotbl.jo_number, -5, 10)) desc LIMIT 1");
			$last_digit = $r[0];
			$newJONO = $cleanjono . $year ."-" .  formatToTenThousands(($last_digit + 1));
			echo $newJONO;
		}


	}
	else if ($year == "25") {
		$cnt = get_value("SELECT count(*) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY jo_id desc LIMIT 1");
		if ($cnt[0] == 0) {
			//$last_digit = '00000';
			$newJONO = $cleanjono. $year ."-" .  '00001';
			echo $newJONO;
		}
		else{
			$r = get_value("SELECT TRIM(SUBSTR(jotbl.jo_number, -5, 10)) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY TRIM(SUBSTR(jotbl.jo_number, -5, 10)) desc LIMIT 1");
			$last_digit = $r[0];
			$newJONO = $cleanjono . $year ."-" .  formatToTenThousands(($last_digit + 1));
			echo $newJONO;
		}


	}
		else if ($year == "26") {
		$cnt = get_value("SELECT count(*) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY jo_id desc LIMIT 1");
		if ($cnt[0] == 0) {
			//$last_digit = '00000';
			$newJONO = $cleanjono. $year ."-" .  '00001';
			echo $newJONO;
		}
		else{
			$r = get_value("SELECT TRIM(SUBSTR(jotbl.jo_number, -5, 10)) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY TRIM(SUBSTR(jotbl.jo_number, -5, 10)) desc LIMIT 1");
			$last_digit = $r[0];
			$newJONO = $cleanjono . $year ."-" .  formatToTenThousands(($last_digit + 1));
			echo $newJONO;
		}


	}
		else if ($year == "27") {
		$cnt = get_value("SELECT count(*) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY jo_id desc LIMIT 1");
		if ($cnt[0] == 0) {
			//$last_digit = '00000';
			$newJONO = $cleanjono. $year ."-" .  '00001';
			echo $newJONO;
		}
		else{
			$r = get_value("SELECT TRIM(SUBSTR(jotbl.jo_number, -5, 10)) FROM phrmdo_jorecdbb.jotbl WHERE TRIM(SUBSTR(jotbl.jo_number, -8, 2)) = '$year' ORDER BY TRIM(SUBSTR(jotbl.jo_number, -5, 10)) desc LIMIT 1");
			$last_digit = $r[0];
			$newJONO = $cleanjono . $year ."-" .  formatToTenThousands(($last_digit + 1));
			echo $newJONO;
		}


	}
	else{
		$r = get_value("SELECT TRIM(SUBSTR(jotbl.jo_number, -5, 10)) FROM jotbl ORDER BY TRIM(SUBSTR(jotbl.jo_number, -5, 10)) DESC LIMIT 1");

		$last_digit = str_replace(" ", "", $r[0]);

		$newJONO = $cleanjono . ($last_digit + 1);

		echo $newJONO;
	}
	?>