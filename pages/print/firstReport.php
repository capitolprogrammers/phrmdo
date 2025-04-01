<?php
include('../../assets/conn/etc.php');
session_start();
if (!isset($_SESSION["user_id"])) {
	session_destroy();
	header("Location: index.php");
	die();
	$user_id = $_SESSION['user_id'];
}

$fromDate = $_GET["fromDate"];
$toDate = $_GET["toDate"];



$joNumber = $_GET["joNumber"];
$status =  $_GET["status"];
$funding =  $_GET["funding"];
$program =  $_GET["program"];
$acctCode = $_GET["acctCode"];
$office =  $_GET["office"];

$showStatus = '';
$showNotes = '';
$showJono = '';
if (isset($_GET["showStatus"])) {
    $showStatus = $_GET["showStatus"];
}
if (isset($_GET["showNotes"])) {
    $showNotes = $_GET["showNotes"];
}
if (isset($_GET["showJono"])) {
    $showJono = $_GET["showJono"];
}

$query = '';

if ($fromDate != "") {
    $date = explode("-", $fromDate);

    $endDate = $date[0] . '-' . $date[1] . '-31';

    $query = $query . "AND contract_start between '$fromDate' AND '$endDate' ";
}
if ($toDate != "") {

   $dateTo = explode("-", $toDate);

   $endDateTo = $dateTo[0] . '-' . $dateTo[1] . '-31';

   $query = $query . "AND contract_end between '$toDate' and '$endDateTo' ";
}

if ($joNumber != "") {
    $query = $query . " AND jonamestbl.jo_number = '$joNumber'";
}

if ($status != "") {
    if ($status == '1') {
        $query = $query . " AND jotbl.status = '$status' AND jonotestbl.note like '%REVIEWED%' ";
    } else if ($status == '5' || $status == '6') {
        $query = $query . " AND (jotbl.jo_number = '5' OR jotbl.status = '6') ";
    } else {
        $query = $query . " AND jotbl.status = '$status'";
    }
}

if ($funding != "") {
    $query = $query . " AND jotbl.fund_id = '$funding' ";
}

if ($program != "") {
    $query = $query . " AND jotbl.program_id = '$program' ";
}

if ($acctCode != "") {
    $query = $query . " AND jotbl.acct_code = '$acctCode' ";
}

if ($office != "") {
    $query = $query . " AND jonamestbl.office_id = '$office' ";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT_AVAILABILITY_OF_FUNDS</title>
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
        
    $r = get_array("SELECT jonamestbl.id, employeetbl.employee_id, contract_start, contract_end, contract_status, days, office_id, designation_id, jonamestbl.note, fund_id, jonamestbl.id as jonameid, jotbl.status, jotbl.jo_number, c_o, jonotestbl.note as jonote, jonamestbl.jo_status, program_name, programtbl.office as fund from jonamestbl  
        LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id 
        LEFT JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number 
        LEFT JOIN jonotestbl ON jonotestbl.jo_number = jotbl.jo_number
        LEFT JOIN programtbl ON jotbl.program_id = programtbl.program_id
        WHERE jonamestbl.id is not null $query ORDER BY office_id, lname, mname, fname");

        ?>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                     <th>#</th>
                     <th>Lastname</th>
                     <th>Firstname</th>
                     <th>Middlename</th>
                     <?php
                     if ($showJono == "on") {
                        ?>
                        <th class="text-center">JO Number</th>
                        <?php
                    }
                    ?>
                    <th class="text-center">Office</th>
                    <th class="text-center">Designation</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">Fund</th>
                    <th class="text-center">Employment Start</th>
                    <th class="text-center">Employment End</th>
                    <th class="text-center">Wage 1</th>
                    <th class="text-center">Wage 2</th>
                    <th class="text-center">Wage 3</th>
                    <?php
                    if ($showStatus == "on") {
                        ?>
                        <th>Status</th>
                        <th>JO Status</th>
                        <?php
                    }
                    if ($showNotes == "on") {
                        ?>
                        <th>Note(Emp)</th>
                        <th>Note(Contract)</th>
                        <?php
                    }
                    ?>
                    <th>Includings</th>
                    <th>Program</th>
                    <th>ProgramFund</th>
                    <th>C/O</th>
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
                            <?php
                            if ($showJono == "on") {
                                ?>
                                <td class="text-center"><?php echo $v["jo_number"]; ?></td>
                                <?php
                            }
                            ?>
                            <td><?php echo getOfficeName($v["office_id"]); ?></td>
                            <td><?php echo getDesignationName($v["designation_id"]) ?></td>
                            <td class="text-center"><?php echo getRate($v["designation_id"]); ?></td>
                            <td class="text-center"><?php echo getFund($v["fund_id"]); ?></td>
                            <td class="text-center"><?php echo convertToDateWithMonthName($v["contract_start"]); ?></td>
                            <td class="text-center"><?php echo convertToDateWithMonthName($v["contract_end"]); ?></td>
                            <td class="text-center"><?php echo $wage1;?></td>
                            <td class="text-center"><?php echo $wage2;?></td>
                            <td class="text-center"><?php echo $wage3;?></td>
                            <?php
                            if ($showStatus == "on") {
                                ?>
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
                            <?php
                        }
                        if ($showNotes == "on") {
                            ?>
                            <td><?php echo $v["note"] ?></td>
                            <td>
                                <?php 
                                echo $v["jonote"];
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                        <td><?php echo getDays($v["days"]); ?></td>
                        <td><?php echo $v["program_name"] ?></td>
                        <td><?php echo $v["fund"] ?></td>
                        <td><?php echo $v["c_o"] ?></td>
                        
                    </tr>
                    <?php
                    // $total += $wage;
                    $num++;
                }
                ?>
            </tbody>
            <tr>
                <td colspan="11" class="text-center"><strong>TOTAL <?php echo number_format($total, 2); ?></strong></td>

            </tr>
        </table>
    </div>
</div>
</body>

</html>