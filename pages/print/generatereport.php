<?php
$type = $_GET["type"];
$fund = $_GET["fund"];
$doctype = $_GET["doctype"];
$year = $_GET["year"];

$funding = $_GET["funding"];

$date_saved_from = $_GET["date_saved_from"];
$date_saved_to = $_GET["date_saved_to"];

// $contract_month_start = $_GET["contract_month_start"];
// $contract_month_end = $_GET["contract_month_end"];

// if($contract_month_start = 0){
//     $contract_month_start = "";
// }
// if($contract_month_end = 0){
//     $contract_month_end = "";
// }

$contract_start = $year; 
$contract_end = $year; 

if ($doctype == "EXCEL") {
    ini_set('max_execution_time', 0); 
    header('Content-type: application/excel');
    $filename = $type . '_' . $fund . "_" . getReportDate()  . '.xls';
    header('Content-Disposition: attachment; filename='.$filename);
    header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
}

include('../../assets/conn/etc.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    session_destroy();
    header("Location: index.php");
    die();
    $user_id = $_SESSION['user_id'];
}

function getReportDate()
{
    /*date & time*/
    date_default_timezone_set("Asia/Manila");
    $datenow = date("Y-m-d");
    $timenow = date("h:i:sa");
    $dateandtimenow = $datenow;

    return $dateandtimenow;
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $type . '_' . $fund . "_" . getdatetime(); ?></title>
    <!-- Bootstrap CSS (required for Material Design Bootstrap) -->
    <!-- Material Design Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/dist/css/mdb.min.css" integrity="sha384-p5z5DjkbGSMrAbMHrQ56U1RimAZD0o9xEpjfCcYIVaETqI6UWlBN0kg23NYj1Q2v" crossorigin="anonymous">

    <!-- Bootstrap CSS (required for Material Design Bootstrap) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-5+5z5K2/JmF43bGhKOLfOuqxW2QXsh4/z4vgMxKt8GVcsWJL/HtS0PpZqg3o0hWocTNYTmcC1ivCNQv7zR78Ww==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Material Design Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/dist/js/mdb.min.js" integrity="sha384-xT04TjjJv25NQsN8Rd7LHeJnx+aGv1Qf0J8F9+rlI00Gvy+aHq6xopzJhLyUg/+K" crossorigin="anonymous"></script>

    <!-- jQuery (required for Material Design Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Popper.js (required for Material Design Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmIzN+OvGpXpN0etV4Q6" crossorigin="anonymous"></script>

    <!-- Bootstrap JS (required for Material Design Bootstrap JS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-dh4E4uzikDvM8+MyZsiJGdss1OO02B6vG8LamWclR/HjJbjyKr9gZ+8SEZcxE6C2qPGU3zPv5m5J5I1+Qd5q3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    <style type="text/css">
        .row {
            /*			border: solid black .5px;*/
            padding: 0px;
        }

        .main-border {
            border: solid 1px;
        }

        .x {
            border: solid black .5px;
        }

        .header-logo {}


        .cont {
            position: relative;
            display: inline-block;
        }

        .cont img {
            position: absolute;
            right: 10px;
            bottom: -15px;
            z-index: 1;
            left: 5px;
        }

        .cont h1 {
            position: relative;
            z-index: 2;
        }


        @media print {
            @page {
                size: legal;
                size: portrait;
                margin-top: 150px;
                margin-left: 80px;
            }
        }

        .date {
            font-size: 16px;
            margin-bottom: 25px;
        }

        .budget-head {
            font-weight: 500;
            font-size: 18px;
            text-transform: uppercase;
        }

        .budget-head-pos {
            line-height: 10px;
            font-size: 16px;
        }

        .office {
            line-height: 25px;
            font-size: 16px;
        }

        .address {
            line-height: 15px;
            font-size: 16px;
        }


        /* Optional: Set the border style and color */
        table.table-bordered,
        .table-bordered th,
        .table-bordered td {
            padding: 2px;
            font-size: 15px;
            vertical-align: middle;
            text-indent: 10px;
        }
    </style>
</head>

<body>
    <?php
    // echo "SELECT jonamestbl.id, employeetbl.employee_id, contract_start, contract_end, contract_status, days, office_id, designation_id, jonamestbl.note, fund_id, jonamestbl.id as jonameid, jotbl.status, jotbl.jo_number, c_o, jonotestbl.note as jonote, jonamestbl.jo_status, program_name from jonamestbl  
    //     LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id 
    //     LEFT JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number 
    //     LEFT JOIN jonotestbl ON jonotestbl.jo_number = jotbl.jo_number
    //     LEFT JOIN programtbl ON jotbl.program_id = programtbl.program_id
    //     WHERE jonamestbl.id is not null $query ORDER BY office_id, lname, mname, fname";

    if ($type == "JOB ORDERS") {
        
        $query = "";
        if($date_saved_from != "" && $date_saved_to != ""){
            $query = " AND jotbl.date_added between '$date_saved_from' AND '$date_saved_to'";
        }
        
          $fundingQuery = "";
        if($funding != ""){
            $fundingQuery = " AND jotbl.fund_id = '$funding'";
        }
        // echo "SELECT jonamestbl.id, employeetbl.employee_id, contract_start, contract_end, contract_status, days, office_id, designation_id, jonamestbl.note, fund_id, jonamestbl.id as jonameid, jotbl.status, jotbl.jo_number, c_o, jonotestbl.note as jonote, jonotestbl.co_note as co_note, jonamestbl.jo_status, program_name, programtbl.office as fund, jotbl.date_added as added from jonamestbl  
        // LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id 
        // LEFT JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number 
        // LEFT JOIN jonotestbl ON jonotestbl.jo_number = jotbl.jo_number
        // LEFT JOIN programtbl ON jotbl.program_id = programtbl.program_id
        // WHERE programtbl.office = '$fund'  AND contract_start like '%$contract_start%' and contract_end like '%$contract_end%' $query $fundingQuery
        // ORDER BY office_id, lname, mname, fname";
        
      $r = get_array("SELECT jonamestbl.id, employeetbl.employee_id, contract_start, contract_end, contract_status, days, office_id, designation_id, jonamestbl.note, fund_id, jonamestbl.id as jonameid, jotbl.status, jotbl.jo_number, c_o, jonotestbl.note as jonote, jonotestbl.co_note as co_note, jonamestbl.jo_status, program_name, programtbl.office as fund, jotbl.date_added as added from jonamestbl  
        LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id 
        LEFT JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number 
        LEFT JOIN jonotestbl ON jonotestbl.jo_number = jotbl.jo_number
        LEFT JOIN programtbl ON jotbl.program_id = programtbl.program_id
        WHERE programtbl.office = '$fund'  AND contract_start like '%$contract_start%' and contract_end like '%$contract_end%' $query $fundingQuery
        ORDER BY office_id, lname, mname, fname");
        ?>
        <table class="table table-bordered">
            <thead>
             <th>#</th>
             <th>Lastname</th>
             <th>Firstname</th>
             <th>Middlename</th>
             <th class="text-center">JO Number</th>
             <th class="text-center">Office</th>
             <th class="text-center">Designation</th>
             <th class="text-center">Rate</th>
             <th class="text-center">Fund</th>
             <th class="text-center">Employment Start</th>
             <th class="text-center">Employment End</th>
             <th class="text-center">Wage 1</th>
             <th class="text-center">Wage 2</th>
             <th class="text-center">Wage 3</th>
             <th>Status</th>
             <th>JO Status</th>
             <th>Note(Emp)</th>
             <th>Note(Contract)</th>
             <th>Note(C/O)</th>
             <th>Includings</th>
             <th>Program</th>
             <th>ProgramFund</th>
             <th>C/O</th>
              <th>DATE JO SAVED</th>
         </thead>
         <tbody>
            <?php
            $num = 1;
            $total = 0;
            foreach ($r as $v) {
                        //$wage = getMonthWage($v["jonameid"]);
                        //$formattedWage = number_format($wage, 2);

                $emp_id = $v["employee_id"];

                $joid = $v[0];

                        // $numberOfMonths = count(getMonthsInRange($v["contract_start"], $v["contract_end"]));

                $wages = getMonthlyWage($joid);
                $wage1 = 0;
                $wage2 = 0;
                $wage3 = 0;

                if(count(getMonthlyWage($joid)) == 3)
                {
                    $wage1 = getMonthlyWage($joid)[0];
                    $wage2 = getMonthlyWage($joid)[1];
                    $wage3 = getMonthlyWage($joid)[2];
                }
                if(count(getMonthlyWage($joid)) == 2)
                {
                    $wage1 = getMonthlyWage($joid)[0];
                    $wage2 = getMonthlyWage($joid)[1];
                            //$wage3 = getMonthlyWage($joid)[2];
                }
                if(count(getMonthlyWage($joid)) == 1)
                {
                    $wage1 = getMonthlyWage($joid)[0];
                            // $wage2 = getMonthlyWage($joid)[1];
                            //$wage3 = getMonthlyWage($joid)[2];
                }


                $r = get_value("SELECT * from employeetbl WHERE employee_id = '$emp_id'");
                ?>
                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo $r["lname"]; ?></td>
                    <td><?php echo $r["fname"]; ?></td>
                    <td><?php echo $r["mname"]; ?></td>
                    <td class="text-center"><?php echo $v["jo_number"]; ?></td>
                    <td><?php echo getOfficeName($v["office_id"]); ?></td>
                    <td><?php echo getDesignationName($v["designation_id"]) ?></td>
                    <td class="text-center"><?php echo getRate($v["designation_id"]); ?></td>
                    <td class="text-center"><?php echo getFund($v["fund_id"]); ?></td>
                    <td class="text-center"><?php echo $v["contract_start"]; ?></td>
                    <td class="text-center"><?php echo $v["contract_end"]; ?></td>
                    <td class="text-center"><?php echo $wage1;?></td>
                    <td class="text-center"><?php echo $wage2;?></td>
                    <td class="text-center"><?php echo $wage3;?></td>
                    <td><?php echo getStatus($v["status"]) ?></td>
                    <td><?php 
                    if($v["jo_status"] == 8){
                        echo "Cancelled";
                    }
                    else if($v["jo_status"] == 6){
                        echo "Active";
                    }
                    else if($v["jo_status"] == ""){
                        echo "None";
                    }
                    ?>
                </td>

                <td><?php echo $v["note"] ?></td>
                <td>
                    <?php 
                    echo $v["jonote"];
                    ?>
                </td>
                <td>
                    <?php 
                    echo $v["co_note"];
                    ?>
                </td>
                <td><?php echo getDays($v["days"]); ?></td>
                <td><?php echo $v["program_name"] ?></td>
                <td><?php echo $v["fund"] ?></td>
                  <td><?php echo $v["c_o"] ?></td>
                  <td><?php echo $v["added"] ?></td>

            </tr>
            <?php
                    // $total += $wage;
            $num++;
        }
        ?>
    </tbody>
</table>
<?php
}
else if($type == "PAYROLL"){
    $payrolls = get_array("SELECT 
        payrolltbl.employee_id,
        lname,
        fname,
        mname,
        jotbl.jo_number,
        office_name,
        designation_name,
        contract_start,
        contract_end,
        payrolltbl.datefrom AS PayrollDateFrom,
        payrolltbl.dateto AS PayrollDateTo,
        print_date,
        program_name,
        funding_name,
        rate,
        workdays,
        undertime,
        pagibig,
        sss,
        gross,
        netpay,
        programtbl.office as gosp
        FROM
        phrmdo_jorecdbb.payrolltbl
        INNER JOIN
        jonamestbl ON jonamestbl.id = payrolltbl.jo_id
        INNER JOIN
        jotbl ON jotbl.jo_number = jonamestbl.jo_number
        INNER JOIN
        fundingtbl ON fundingtbl.fund_id = jotbl.fund_id
        LEFT JOIN
        employeetbl ON employeetbl.employee_id = payrolltbl.employee_id
        LEFT JOIN
        programtbl ON programtbl.program_id = jotbl.program_id
        LEFT JOIN
        officetbl ON officetbl.office_id = jonamestbl.office_id
        LEFT JOIN
        designationtbl ON designationtbl.designation_id = jonamestbl.designation_id
        WHERE contract_start like '%$year%' and programtbl.office = '$fund' ORDER BY office_name, lname, fname");

    $num = 1;
    ?>
    <table class="table table-bordered">
        <thead>
         <th>#</th>
         <th>Lastname</th>
         <th>Firstname</th>
         <th>Middlename</th>
         <th class="text-center">JO Number</th>
         <th class="text-center">Office</th>
         <th class="text-center">Designation</th>
         <th class="text-center">Fund</th>
         <th class="text-center">Payroll Date(from)</th>
         <th class="text-center">Payroll Date(to)</th>
         <!--<th class="text-center">Print Date</th>-->
         <th class="text-center">Rate</th>
         <th class="text-center">Workdays</th>
         <th class="text-center">Undertime</th>
         <th class="text-center">Pagibig</th>
         <th class="text-center">SSS</th>
         <th class="text-center">Gross</th>
         <th class="text-center">Netpay</th>
         <th class="text-center">GO/SP</th>
     </thead>
     <tbody>
        <?php 
        foreach ($payrolls as $key => $payroll) {
            ?>
            <tr>
                <td><?php echo $num ?></td>
                <td><?php echo $payroll["lname"] ?></td>
                <td><?php echo $payroll["fname"] ?></td>
                <td><?php echo $payroll["mname"] ?></td>
                <td><?php echo $payroll["jo_number"] ?></td>
                <td><?php echo $payroll["office_name"] ?></td>
                <td><?php echo $payroll["designation_name"] ?></td>
                <td><?php echo $payroll["funding_name"] ?></td>
                <td><?php echo $payroll["PayrollDateFrom"] ?></td>
                <td><?php echo $payroll["PayrollDateTo"] ?></td>
                <td><?php echo $payroll["rate"] ?></td>
                <td><?php echo $payroll["workdays"] ?></td>
                <td><?php echo $payroll["undertime"] ?></td>
                <td><?php echo $payroll["pagibig"] ?></td>
                <td><?php echo $payroll["sss"] ?></td>
                <td><?php echo $payroll["gross"] ?></td>
                <td><?php echo $payroll["netpay"] ?></td>
                <td><?php echo $payroll["gosp"] ?></td>
            </tr>
            <?php
            $num++;
        }
        ?>
    </tbody>
</table>
<?php
}
?>

</body>

</html>