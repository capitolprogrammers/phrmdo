<?php
include('../../assets/conn/etc.php');
$id = p('id');
$monthHoliday = p('monthHoliday');
$monthHolidayWeekend = p("monthHolidayWeekend");

qr("UPDATE holidaystbl set holidays = '$monthHoliday', holidaysweekend = '$monthHolidayWeekend' WHERE holiday_id = '$id'");
saveUserLog($id, "UPDATED holiday record into $monthHoliday & $monthHolidayWeekend.");
echo getMonthName($id) . ' Holiday record has been updated.';
?>