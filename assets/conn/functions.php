  <?php
  //get date&time
  $datenow = date("Y-m-d");

  $datelastmonth = date('Y-m-d', strtotime('first day of last month'));

  $currentDate = new DateTime();  // Get the current date and time
  $currentDate->modify('first day of last month');  // Move to the first day of the last month
  $currentDate->modify('+19 days');  // Add 19 days to get to the 20th day

  $lastMonth20th = $currentDate->format('Y-m-d');  // Format the date as desired (e.g., 'Y-m-d')

  function getdatetime()
  {
    /*date & time*/
    date_default_timezone_set("Asia/Manila");
    $datenow = date("Y-m-d");
    $timenow = date("h:i:sa");
    $dateandtimenow = $datenow;

    return $dateandtimenow;
  }
  
  function savelog($event, $v_id, $v_id2)
  {
    date_default_timezone_set("Asia/Manila");
    $datenow = date("Y-m-d");
    $timenow = date("h:i:sa");
    $logtime = $datenow . ' ' . $timenow;
    $user_id = $_SESSION["user_id"];
    $ip =  $_SERVER['REMOTE_ADDR'];
    require("conn/conn.php");
    $q = "INSERT INTO userlogs (user_id, logtime, event, ip_address, v_id, v_id2) values ('$user_id', '$logtime', '$event', '$ip', '$v_id', '$v_id2')";
    $mq($c, $q);
  }



  function datetime()
  {
    /*date & time*/
    date_default_timezone_set("Asia/Manila");
    $datenow = date("Y-m-d");
    $timenow = date("h:i:s");
    $dateandtimenow = $datenow . ' ' . $timenow;

    return $dateandtimenow;
  }

  //get array of values from query
  function get_array($query)
  {
    include('conn.php');
    $arr = array();
    $r = $mq($c, $query);
    while ($rw = $mf($r)) {
      array_push($arr, $rw);
    }
    return $arr;
  }
  //get single value from query
  function get_value($query)
  {
    include('conn.php');
    $r = $mq($c, $query);
    $rw = $mf($r);
    if (isset($rw)) {
      return $rw;
    } else {
      return "0";
    }
  }

  function qr($q)
  {
    require("conn.php");
    $mq($c, $q);
  }
  //get i.p
  function getIPAddress()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
  }
  //convert ' to `
  function p($var)
  {
    $var2 = str_replace("'", "`", $_POST["$var"]);
    return trim($var2);
  }
  //convert ' to `
  function g($var)
  {
    $var2 = str_replace("'", "`", $_GET["$var"]);
    return $var2;
  }

  function c($var)
  {
    $var2 = str_replace("'", "`", $var);
    return $var2;
  }

  function redirect($x, $y)
  {
    $url = $x;
    echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $y . '; ' . $url . '">';
  }

  function getcount($q)
  {
  }

  function get_char($col, $id)
  {
    include('conn.php');
    $r = $mq($c, "SELECT $col from v_info WHERE v_id = '$id'");
    $rw = $mf($r);
    return $rw[0];
  }

  function get_num($id)
  {
    include('conn.php');
    $r = $mq($c, "SELECT contact_number from v_contact_numbers WHERE v_id = '$id'");
    while ($rw = $mf($r)) {
      if (count($rw) != 1) {
        echo $rw[0] . '<br>';
      } else {
        echo $rw[0];
      }
    }
  }

  function formatdate($date, $year)
  {
    $date = date_create($date);
    if ($year == 0) {
      $datefrom = date_format($date, 'M j');
    } else {
      $datefrom = date_format($date, 'M j, Y');
    }
    return $datefrom;
  }
function convertMiddleNameToInitial($middleName) {
    // Check if the middle name is not empty
    if (!empty($middleName)) {
        // Split the middle name into an array of words
        $middleNameWords = explode(' ', $middleName);
        
        // Initialize an empty string for the initials
        $initials = '';
        
        // Loop through each word and get the first character
        foreach ($middleNameWords as $word) {
            // Ensure the word is not empty (in case there are extra spaces)
            if (!empty($word)) {
                $initials .= substr($word, 0, 1) . '.';
            }
        }
        
        return $initials;
    } else {
        // If the middle name is empty, return an empty string or handle it as needed
        return '';
    }
}

 function getData($id, $data)
{
    $r = get_value("SELECT * from employeetbl WHERE employee_id = '$id'");

    // Check if middle name is "N/A" and make it blank
    $middleName = ($r["mname"] == "N/A") ? "" : convertMiddleNameToInitial($r["mname"]);

    $name =  $r["lname"] . ', ' . $r["fname"] . ' ' . $middleName;

    switch ($data) {
        case 'name':
            return $name;
            break;

        case 'bday':
            return $r["bday"];
            break;

        case 'gender':
            return $r["gender"];
            break;

        case 'phone':
            return $r["phonenum"];
            break;

        case 'address':
            if ($r["address"] == "") {
                return "No address data";
            } else {
                return $r["address"];
            }
            break;

        default:
            return "Please specify the data on the second parameter.";
            break;
    }
}


  function currentDateWords()
  {
    $currentDate = date("F d, Y");
    echo $currentDate;
  }


  function countWeekdays($startDate, $endDate)
  {
    $count = 0;
    $currentDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    while ($currentDate <= $endDate) {
      if (date('N', $currentDate) < 6) { // Monday to Friday (1 to 5)
        $count++;
      }
      $currentDate = strtotime('+1 day', $currentDate);
    }

    return $count;
  }

  function countWeekdaysAndSaturdays($startDate, $endDate)
  {
    $count = 0;
    $currentDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    while ($currentDate <= $endDate) {
      $dayOfWeek = date('N', $currentDate);
      if ($dayOfWeek < 6 || $dayOfWeek == 6) { // Monday to Saturday (1 to 6)
        $count++;
      }
      $currentDate = strtotime('+1 day', $currentDate);
    }

    return $count;
  }

  function countAllDays($startDate, $endDate)
  {
    $count = 0;
    $currentDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    while ($currentDate <= $endDate) {
      $count++;
      $currentDate = strtotime('+1 day', $currentDate);
    }

    return $count;
  }

  function getMonthNumbersInRange($startDate, $endDate)
  {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1M'); // 1 month interval
    $period = new DatePeriod($start, $interval, $end);

    $monthNumbers = [];
    foreach ($period as $date) {
      $monthNumbers[] = $date->format('n');
    }

    return $monthNumbers;
  }


  function getMonthNamesWithYear($startDate, $endDate)
  {
    $startYear = date('Y', strtotime($startDate));
    $startMonth = date('n', strtotime($startDate));
    $endYear = date('Y', strtotime($endDate));
    $endMonth = date('n', strtotime($endDate));

    $monthNames = [];

    for ($year = $startYear; $year <= $endYear; $year++) {
      $start = ($year == $startYear) ? $startMonth : 1;
      $end = ($year == $endYear) ? $endMonth : 12;

      for ($month = $start; $month <= $end; $month++) {
        $monthName = date('F', mktime(0, 0, 0, $month, 1, $year));
        $monthNames[] = $monthName;
      }
    }

    $formattedMonths = [];

    for ($i = 0; $i < count($monthNames); $i += 2) {
      $startMonthName = $monthNames[$i];
      $endMonthName = ($i + 1 < count($monthNames)) ? $monthNames[$i + 1] : '';
      $year = $startYear + intdiv($i, 12);

      if ($endMonthName) {
        $formattedMonths[] = "$startMonthName - $endMonthName $year";
      } else {
        $formattedMonths[] = "$startMonthName $year";
      }
    }

    return $formattedMonths;
  }

  // Example usage:
  // $startDate = '2023-05-01';
  // $endDate = '2024-04-30';
  // $months = getMonthNamesWithYear($startDate, $endDate);


  // echo "Month names with year between $startDate and $endDate: " . implode(', ', $months);

  function countFridaysAndWeekends($startDate, $endDate)
  {
  // Convert string dates to DateTime objects
    $from_date = new DateTime($startDate);
    $to_date = new DateTime($endDate);

    // Initialize the total count
    $weekend_count = 0;

    // Loop through the dates from the start date to the end date
    $current_date = $from_date;
    while ($current_date <= $to_date) {
        // Check if the current day is a weekend (Friday, Saturday, or Sunday)
        if ($current_date->format('w') == 5 || $current_date->format('w') == 6 || $current_date->format('w') == 0) {
            $weekend_count++;
        }

        // Move to the next day
        $current_date->modify('+1 day');
    }

    return $weekend_count;
    }

    function getContract($id)
    {
      switch ($id) {
        case '1':
        return 'Renewal';
        break;

        case '2':
        return 'Original';
        break;

        case '3':
        return 'Re-Employment';
        break;

        default:
        return 'No Remarks';
        break;
      }
    }

    function getStatus($stats)
    {
      switch ($stats) {
        case '1':
        return "For Signing (HRMO)";
        break;

        case '2':
        return "For Printing";
        break;

        case '3':
        return "For Budget Approval";
        break;

        case '4':
        return "For Signing (Governor)";
        break;

        case '5':
        return "For Signing of Contract";
        break;

        case '6':
        return "Active";
        break;

        case '7':
        return "Disapproved by HRMO";
        break;

        default:
        return "No Status";
        break;
      }
    }

    function getEmpJOStatus($stats)
    {
      switch ($stats) {

        case '6':
        return "Active/Signed";
        break;

        case '8':
        return "Cancelled";
        break;

        default:
        return "Inactive/UnSigned";
        break;
      }
    }


    function getUser($id)
    {
      $r = get_value("SELECT name from users WHERE id = '$id'");
      return $r[0];
    }

    function getDesignationName($id)
    {
      $r = get_value("SELECT designation_name from designationtbl WHERE designation_id = '$id'")[0];
      return $r;
    }

    function getRate($id)
    {
      $r = get_value("SELECT rate from designationtbl WHERE designation_id = '$id'")[0];
      return $r;
    }

    function getOfficeName($id)
    {
      $r = get_value("SELECT office_name from officetbl WHERE office_id = '$id'")[0];
      return $r;
    }

    function getMonthName($monthNumber)
    {
      return date('F', mktime(0, 0, 0, $monthNumber, 1));
    }

    function getFund($fundId)
    {
      $r = get_value("SELECT funding_name from fundingtbl WHERE fund_id = '$fundId'")[0];
      return $r;
    }

    function convertToDateWithMonthName($date)
    {
      $timestamp = strtotime($date);
      $formattedDate = date('F d, Y', $timestamp);
      return $formattedDate;
    }

    function responsive($size)
    {
      echo "style='max-height:$size" . "vh'";
    }

    function getDays($days)
    {
      switch ($days) {
        case '1':
        return 'Regular Days';
        break;

        case '2':
        return 'Including Saturdays and Holidays';
        break;

        case '3':
        return 'Including Saturdays, Sundays and Holidays';
        break;

        case '4':
        return 'Including Saturdays Only';
        break;

        case '5':
        return 'Including Holidays Only';
        break;

        case '6':
        return 'Including Saturdays, Sundays and Holidays (22days)';
        break;

        case '7':
        return 'Including Saturdays, Sundays and Holidays (1 Day off per week)';
        break;

        case '8':
        return 'Including Saturdays and Holidays (22days)';
        break;

        case '9':
        return 'Including Saturdays and Sundays';
        break;

        case '10':
        return 'Friday, Saturdays and Sundays only';
        break;
        
        case '11':
        return 'Saturdays and Sundays only';
        break;
        
        case '12':
        return 'Including Saturdays, Sundays and Holidays(26days)';
        break;

        default:
        return "ERROR FINDING DATA";
        break;
      }
    }

    function saveUserLog($EmployeeID, $EventLog)
    {
      session_start();
      date_default_timezone_set('Asia/Manila');
    // Create a new timestamp for the daterecorded column
      $dateRecorded = date('Y-m-d H:i:s');
    // Get the user's IP address
      $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userid = $_SESSION["user_id"]; // Replace with the user's ID if you have it available, otherwise leave it empty
    $daterecorded =  $dateRecorded;
    $employeeID = $EmployeeID;
    $event = strtoupper($EventLog);
    $ipaddress = $ipAddress;


    qr("INSERT INTO userlogs (userid, daterecorded, dataID, event, ipaddress) VALUES 
      ('$userid', '$daterecorded', '$employeeID', '$event', '$ipaddress')");
  }

  function getUserID()
  {
    $sessionStatus = session_status();

    // If sessions are disabled or already started, don't call session_start()
    if ($sessionStatus == PHP_SESSION_DISABLED || $sessionStatus == PHP_SESSION_ACTIVE) {
      // Do nothing or handle the case as needed
    } else {
      // Start the session
      session_start();
      return $_SESSION["user_id"];
    }
  }

  function getPastTime($datetime)
  {
    $currentDateTime = new DateTime(); // Get the current date and time

    // Calculate the difference between the current time and the provided DateTime
    $interval = $currentDateTime->diff($datetime);

    // Get the total minutes and hours difference
    $pastMinutes = $interval->i; // Minutes
    $pastHours = $interval->h; // Hours
    $pastDays = $interval->d; // Days

    // Calculate the total time difference in minutes
    $totalMinutes = $pastMinutes + ($pastHours * 60) + ($pastDays * 24 * 60);

    // Calculate the hours and remaining minutes
    $hours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;

    // Format the result
    $result = '';
    if ($hours > 0) {
      $result .= $hours . ' hour(s) ';
    }
    $result .= $minutes . ' minute(s) ago';

    return $result;
  }

  function getMonthsInRange($start_date, $end_date)
  {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);

    $months = [];
    while ($start <= $end) {
      $months[] = $start->format('m');
      $start->modify('+1 month');
    }

    return $months;
  }

  function getYearFromDate($dateString) {
    $date = new DateTime($dateString);
    $year = $date->format('Y');
    return $year;
  }




function countSundays($start_date, $end_date) {
    // Convert string dates to DateTime objects
    $start_date = new DateTime($start_date);
    $end_date = new DateTime($end_date);

    // Initialize counter
    $sunday_count = 0;

    // Loop through the dates from start_date to end_date
    while ($start_date <= $end_date) {
        // Check if the current day is a Sunday (where format('w') returns 0 for Sunday)
        if ($start_date->format('w') == 0) {
            $sunday_count++;
        }

        // Move to the next day
        $start_date->modify('+1 day');
    }

    return $sunday_count;
}

function countWeekends($start_date, $end_date) {
    // Convert string dates to DateTime objects
    $start_date = new DateTime($start_date);
    $end_date = new DateTime($end_date);

    // Initialize counter
    $weekend_count = 0;

    // Loop through the dates from start_date to end_date
    while ($start_date <= $end_date) {
        // Check if the current day is a Saturday (6) or Sunday (0)
        if ($start_date->format('w') == 6 || $start_date->format('w') == 0) {
            $weekend_count++;
        }

        // Move to the next day
        $start_date->modify('+1 day');
    }

    return $weekend_count;
}

  function getDayWage($jonameid)
  {

    $r = get_value("SELECT contract_start, contract_end, days, designation_id from jonamestbl WHERE id = '$jonameid'");
    $rateData = get_value("SELECT rate from designationtbl WHERE designation_id = '$r[3]'");

    $rate = str_replace(",", "", $rateData[0]);

    $from = $r["contract_start"];
    $end = $r["contract_end"];

    $year = getYearFromDate($end);

    $month = getMonthsInRange($from, $end);

    $day = $r["days"];

    switch ($day) {
      case '1':
        //regular
      $days = countWeekdays($from, $end);
      //hardcodeshit lol
      
      $hols = 0;
      foreach ($month as $key => $value) {
        $hol = get_value("SELECT holidays from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
        $hols += $hol;
      }
    //  if($from == '2025-01-02' && $end == '2025-03-31'){
    //      $hols = 1;
    //  }
      $wage = ($days - $hols) * $rate;
      
      return $wage;
      break;

      case '2':
        //'Including Saturdays and Holidays';
      $days = countWeekdaysAndSaturdays($from, $end);
      $wage = $days * $rate;
      return $wage;
      break;

      case '3':
        //'Including Saturdays, Sundays and Holidays';
      $days = countAllDays($from, $end);
      $wage = $days * $rate;
      return $wage;
      break;

      case '4':
        // 'Including Saturdays Only';
      $hols = 0;
      $days = countWeekdaysAndSaturdays($from, $end);

    //   foreach ($month as $key => $value) {
    //     $hol = get_value("SELECT holidays as total from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
    //     $hols += $hol;
    //   }
    //     foreach ($month as $key => $value) {
    //     $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
    //     $hols += $hol;
    //   }

      $wage = ($days - $hols) * $rate;
      return $wage;
      break;

      case '5':
        //'Including Holidays Only';
      $hols = 0;
      $days = countWeekdays($from, $end);

      foreach ($month as $key => $value) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
        $hols += $hol;
      }

      $wage = ($days) * $rate;
      return $wage;
      break;

      case '6':
        //'Including Saturdays, Sundays and Holidays (22days)';
      $days = countWeekdays($from, $end);
      $wage = (22 * count($month)) * $rate;
      return $wage;
      break;

      case '7':
        //'Including Saturdays, Sundays and Holidays (1 dayoff per week)';
      $sundays = countSundays($from, $end);
      $days = countAllDays($from, $end);
      $wage = ($days - $sundays) * $rate;
      return $wage;
      break;


      case '8':
        //'Including Saturdays, Sundays and Holidays (22days)';
      $wage = (22 * count($month)) * $rate;
      return $wage;
      break;

      case '9':
        //'Including Saturdays, Sundays and Holidays (22days)';
      $hols = 0;
      foreach ($month as $key => $v1) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$v1' and year = '$year'")[0];
        $hols += $hol;
      }
      foreach ($month as $key => $v2) {
        $hol = get_value("SELECT holidays as total from holidaystbl WHERE month_no = '$v2' and year = '$year'")[0];
        $hols += $hol;
      }
      $days = countAllDays($from, $end);
      $wage = ($days - $hols) * $rate;
      return $wage;
      break;


      case '10':
          $hols = 0;
        //'Including Friday, Saturdays and Sundays';
        foreach ($month as $key => $v2) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$v2' and year = '$year'")[0];
        $hols += $hol;
        // if($v2 == '3'){
        //     $hols+=1;
        // }
      }
      $days = countFridaysAndWeekends($from, $end);
      
      $wage = ($days - $hols) * $rate;
      return $wage;
      break;
      
        case '11':
          $hols = 0;
        //'Including Saturdays and Sundays';
        foreach ($month as $key => $v2) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$v2' and year = '$year'")[0];
        $hols += $hol;
      }
      $days = countWeekends($from, $end);
      
      $wage = ($days - $hols) * $rate;
      return $wage;
      break;
      
       case '12':
        //'Including Saturdays, Sundays and Holidays (22days)';
      $hols = 0;
      $days = countAllDays($from, $end); 
      if($days > 26){
          $days = 26;
      }
      $wage = ($days - $hols) * $rate;
      return $wage;
      break;


      default:
      return "ERROR FINDING DATA";
      break;
    }
  }


  function generateDateRange($date_from, $date_to) {
    $start_date = new DateTime($date_from);
    $end_date = new DateTime($date_to);

    $dates = array();

    while ($start_date <= $end_date) {
      $dates[] = $start_date->format('Y-m-d');
      $start_date->modify('first day of next month');
    }

    return $dates;
  }

  function getLastDateOfMonth($date_string) {
    $date = new DateTime($date_string);
    $date->modify('last day of this month');
    return $date->format('Y-m-d');
  }

  function getMonthlyWage($jonameid)
  {

    $r = get_value("SELECT contract_start, contract_end, days, designation_id from jonamestbl WHERE id = '$jonameid'");
    $rateData = get_value("SELECT rate from designationtbl WHERE designation_id = '$r[3]'");

    $rate = str_replace(",", "", $rateData[0]);

    $endArr = explode("-", $r["contract_start"]);

    $dates = generateDateRange($r["contract_start"], $r["contract_end"]);

    $wages = array(); 


    for ($i=0; $i < count($dates) ; $i++) { 

      $from = $dates[$i];

      $end = getLastDateOfMonth($dates[$i]);

      $month = getMonthsInRange($from, $end);

      $day = $r["days"];
   $year = getYearFromDate($end);
      switch ($day) {
        case '1':
        //regular
        $days = countWeekdays($from, $end);
        $hols = 0;
        foreach ($month as $key => $value) {
          $hol = get_value("SELECT holidays from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
          $hols += $hol;
        }
        $wage = ($days - $hols) * $rate;
        array_push($wages, $wage);
        break;

        case '2':
        //'Including Saturdays and Holidays';
        $days = countWeekdaysAndSaturdays($from, $end);
        $wage = $days * $rate;
        array_push($wages, $wage);
        break;

        case '3':
        //'Including Saturdays, Sundays and Holidays';
        $days = countAllDays($from, $end);
        $wage = $days * $rate;
        array_push($wages, $wage);
        break;

        case '4':
        // 'Including Saturdays Only';
        $hols = 0;
        $days = countWeekdaysAndSaturdays($from, $end);

        // foreach ($month as $key => $value) {
        //   $hol = get_value("SELECT holidays as total from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
        //   $hols += $hol;
        // }

        $wage = ($days - $hols) * $rate;
        array_push($wages, $wage);
        break;

        case '5':
        //'Including Holidays Only';
        $hols = 0;
        $days = countWeekdays($from, $end);

        foreach ($month as $key => $value) {
          $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$value' and year = '$year'")[0];
          $hols += $hol;
        }

        $wage = ($days) * $rate;
        array_push($wages, $wage);
        break;

        case '6':
        //'Including Saturdays, Sundays and Holidays (22days)';
        $wage = (22 * count($month)) * $rate;
        array_push($wages, $wage);
        break;


        case '8':
        //'Including Saturdays, Sundays and Holidays (22days)';
        $wage = (22 * count($month)) * $rate;
        array_push($wages, $wage);
        break;

        case '7':
        //'Including Saturdays, Sundays and Holidays (1 dayoff per week)';
        $weeks = countWeeksInMonth($from, $end);
        $days = countAllDays($from, $end);
        $wage = ($days - $weeks) * $rate;
        array_push($wages, $wage);
        break;

         case '9':
        //'Including Saturdays, Sundays and Holidays (22days)';
      $hols = 0;
      foreach ($month as $key => $v1) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$v1' and year = '$year'")[0];
        $hols += $hol;
      }
      foreach ($month as $key => $v2) {
        $hol = get_value("SELECT holidays as total from holidaystbl WHERE month_no = '$v2' and year = '$year'")[0];
        $hols += $hol;
      }
      $days = countAllDays($from, $end);
      $wage = ($days - $hols) * $rate;
      array_push($wages, $wage);
      break;


      case '10':
          $hols = 0;
        //'Including Friday, Saturdays and Sundays';
        foreach ($month as $key => $v2) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$v2' and year = '$year'")[0];
        $hols += $hol;
        // if($v2 == '3'){
        //     $hols+=1;
        // }
      }
      $days = countFridaysAndWeekends($from, $end);
      
      $wage = ($days - $hols) * $rate;
       array_push($wages, $wage);
      break;

    case '11':
          $hols = 0;
        //'Including Saturdays and Sundays';
        foreach ($month as $key => $v2) {
        $hol = get_value("SELECT holidaysweekend as total from holidaystbl WHERE month_no = '$v2' and year = '$year'")[0];
        $hols += $hol;
      }
      $days = countWeekends($from, $end);
      
      $wage = ($days - $hols) * $rate;
      array_push($wages, $wage);
      break;
      
         case '12':
        //'Including Saturdays, Sundays and Holidays (26days)';
      $hols = 0;
      $days = countAllDays($from, $end);
       if($days > 26){
          $days = 26;
      }
      $wage = ($days - $hols) * $rate;
      array_push($wages, $wage);
      break;



      default:
      return "ERROR FINDING DATA";
      break;
     }
    }
    // $from = $endArr[0] . "-" . $month . "-01";
    // $end = $endArr[0] . "-" . $month . "-31";
    return $wages;
  }



  function downloadExcelFile($content, $filename)
  {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
    echo $content;
    exit();
  }
  function getQuarterFromMonth($monthName) {
    $monthsToQuarters = [
      'January'   => 1,
      'February'  => 1,
      'March'     => 1,
      'April'     => 2,
      'May'       => 2,
      'June'      => 2,
      'July'      => 3,
      'August'    => 3,
      'September' => 3,
      'October'   => 4,
      'November'  => 4,
      'December'  => 4
    ];

    $normalizedMonth = ucfirst(strtolower($monthName));

    if (array_key_exists($normalizedMonth, $monthsToQuarters)) {
      return $monthsToQuarters[$normalizedMonth];
    } else {
        return false; // Invalid month name
      }
    }
    function getCurrentYearShort() {
      $currentYear = date("Y");
      $shortYear = substr($currentYear, -2);
      return $shortYear;
    } 

    function abbreviateMonth($fullMonthName) {
      $monthAbbreviations = array(
        'January' => 'Jan',
        'February' => 'Feb',
        'March' => 'Mar',
        'April' => 'Apr',
        'May' => 'May',
        'June' => 'Jun',
        'July' => 'Jul',
        'August' => 'Aug',
        'September' => 'Sep',
        'October' => 'Oct',
        'November' => 'Nov',
        'December' => 'Dec'
      );

      if (array_key_exists($fullMonthName, $monthAbbreviations)) {
        return $monthAbbreviations[$fullMonthName];
      } else {
        return false; // Return false if the input is not a valid full month name
      }
    }

    function countWeeksInMonth($startDate, $endDate)
    {
    // Create DateTime objects for the start and end dates
      $startOfMonth = new DateTime($startDate);
      $endOfMonth = new DateTime($endDate);

    // Calculate the number of days between the two dates
      $interval = $startOfMonth->diff($endOfMonth);
      $days = $interval->days;

    // Calculate the number of weeks
      $weeks = ceil($days / 7);

      return $weeks;
    }
