<?php
include('../../assets/conn/etc.php');
session_start();

if (!isset($_SESSION["user_id"])) {
	session_destroy();
	header("Location: index.php");
	die();
	$user_id = $_SESSION['user_id'];
}

$joid = $_GET["joid"];

$r = get_array("SELECT     
	jotbl.jo_number,
	jonamestbl.employee_id,
	office_name,
	designation_name,
	rate,
	contract_status,
	contract_start,
	contract_end,
	days,
	funding_name
	FROM jonamestbl INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number INNER JOIN officetbl ON officetbl.office_id = jonamestbl.office_id INNER JOIN designationtbl ON designationtbl.designation_id = jonamestbl.designation_id INNER JOIN fundingtbl ON jotbl.fund_id = fundingtbl.fund_id LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id WHERE jotbl.jo_number = '$joid' GROUP BY employeetbl.employee_id ORDER BY lname, mname, fname");

$program = get_value("SELECT * from jotbl INNER JOIN programtbl ON jotbl.program_id = programtbl.program_id WHERE jotbl.jo_number = '$joid' LIMIT 1");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PRINT_CONTRACT</title>
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
	<link
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	rel="stylesheet"
	/>
	<!-- Google Fonts -->
	<link
	href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
	rel="stylesheet"
	/>
	<!-- MDB -->
	<link
	href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
	rel="stylesheet"
	/>

	<style type="text/css">
		.row{
/*			border: solid black .5px;*/
padding:0px;
}
.main-border{
	border: solid 1px;
}
.x{
	border: solid black .5px;
}
.header-logo{

}

.cont {
	position: relative;
	display: inline-block;
}

.cont img {
	position: absolute;
	bottom: -50px;
	z-index: 1;
left:-10px;
}

.cont h1 {
	position: relative;
	z-index: 2;
}

.initial {
	position: relative;
	display: inline-block;
}

.initial img {
	position: absolute;
	bottom: -50px;
	z-index: 1;
/*	left: -50px;*/
left: 40px;
}

.initial h1 {
	position: relative;
	z-index: 2;
}


@media print 
{
	@page
	{
		size: legal;
		size: landscape;
		margin: 30px;
	}
}
.date{
	font-size: 15px;
	margin-bottom:25px;
}
.budget-head{
	font-weight: 500;
	font-size: 18px;
	text-transform: uppercase;
}
.budget-head-pos{
	line-height: 10px;
	font-size: 16px;
}
.office{
	line-height: 25px;
	font-size: 16px;
}
.address{
	line-height: 15px;
	font-size: 16px;
}


/* Optional: Set the border style and color */
table.table-bordered,
.table-bordered th,
.table-bordered td {
	border:solid 1px;
	padding: 2px;
	font-size: 15px;
	vertical-align: middle;
	text-indent: 10px;
}
.officegov{
	font-family: 'Roboto Slab', serif;
	letter-spacing: 1px;
	font-size: 20px;
	text-align: right;
}
.joborder{
	font-family: 'Roboto Slab', serif;
	letter-spacing: 2px;
	font-size: 40px;
	font-weight: 600;
}
</style>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap');
</style>
</head>
<body>
	<div class="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 mt-4">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td> <?php echo currentDateWords();; ?></td>
							</tr>
							<tr>
								<td> <?php echo $joid ?></td>
							</tr>
							<tr>
								<td>Program: <br>
									<h6 class="text-center"><?php echo $program["program_name"] ?></h6>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-2 mt-4">
					<img src="../../assets/images/hr/catlogo_vector.png" width="120px" height="120px">
				</div>
				<div class="col-lg-5 mt-5">
					<h1 class="text-center joborder">JOB ORDER</h1>
				</div>
				<div class="col-lg-3 mt-5" align="right">
					<p class="text-right">Republic of the Philippines <br>PROVINCE OF CATANDUANES <br><strong class="officegov">Office of the Governor</strong></p>
				</div>
				<div class="col-lg-12 mt-3">
					<table class="table table-bordered">
						<thead>
							<th class="text-center">No.</th>
							<th>Name</th>
							<th>Designation</th>
							<th class="text-center">Rate</th>
							<th class="text-center">Period of Employment</th>
							<th class="text-center">Funding</th>
							<th class="text-center">Office Assignment</th>
							<th class="text-center">No.</th>
							<th class="text-center">Acknowledgement</th>
							<th class="text-center">Remarks</th>
						</thead>
						<tbody>
							<?php 

							$two = array();
							$three = array();
							$four = array();
							$five = array();
							$six = array();
							$seven = array();
							$eight = array();
							$nine = array();
							$ten = array();
								$eleven = array();

	$twelve = array();



							$notes = array();

							$empNotes = array();

							$num=1;
							foreach ($r as $key => $v) {
								$emp_id = $v["employee_id"];

								$datea = date_create($v["contract_start"]);
								$dateb = date_create($v["contract_end"]);

								$datefrom = date_format($datea, 'F j');
								$dateto = date_format($dateb, 'F j');

								$year = date_format($datea, 'Y');

								$days = $v["days"];

								if ($days == "2") {
									array_push($two, $num);
								}
								if($days == "3"){
									array_push($three, $num);
								}
								if($days == "4"){
									array_push($four, $num);
								}
								if($days == "5"){
									array_push($five, $num);
								}
								if($days == "6"){
									array_push($six, $num);
								}
								if($days == "7"){
									array_push($seven, $num);
								}

								if($days == "8"){
									array_push($eight, $num);
								}
								if($days == "9"){
									array_push($nine, $num);
								}
								if($days == "10"){
									array_push($ten, $num);
								}
									if($days == "11"){
									array_push($eleven, $num);
								}
										if($days == "12"){
									array_push($twelve, $num);
								}
								$rEmpNotes = get_value("SELECT note from jonamestbl WHERE employee_id = '$emp_id' and jo_number = '$joid'");
								if ($rEmpNotes[0] != "") {
									array_push($empNotes, 'Item #. ' . $num . ' ' . $rEmpNotes[0]);
								}


								?>
								<tr>
									<td class="text-center"><?php echo $num; ?></td>
									<td><?php echo getData($emp_id, 'name'); ?></td>
									<td><?php echo $v["designation_name"] ?></td>
									<td class="text-center"><?php echo $v["rate"] ?></td>
									<td class="text-center"><?php echo $datefrom . ' - ' . $dateto . ', ' . $year;  ?></td>
									<td class="text-center"><?php echo $v["funding_name"] ?></td>
									<td class="text-center"><?php echo $v["office_name"] ?></td>
									<td class="text-center"><?php echo $num ?></td>
									<td class="text-center"></td>
									<td class="text-center"><?php echo getContract($v["contract_status"]) ?></td>
								</tr>
								<?php
								$num++;
							}
							?>
							<tr>
								<td colspan="10">****nothing follows****</td>
							</tr>
							<?php
							$rows = $num - 1;
							$otherRows = 15 - $rows;
							for ($i=0; $i < $otherRows; $i++) { 
								?>
								<tr>
									<td style="padding:12px"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?php
							}

							?>
							<tr>
								<td colspan="110">
									<strong>
										<?php
										$notes = ''; 
										if (!empty($two) || !empty($three) || !empty($four) || !empty($five) || !empty($six) || !empty($seven) || !empty($eight) || !empty($nine) || !empty($ten) || !empty($eleven)|| !empty($twelve)) {
											echo "Item #: ";
										}

										if (!empty($two)) {
											$tx = '';
											foreach ($two as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											$notes =  $notes . rtrim($tx, ', ') . ' ' .  getDays(2) . ' ';
										}

										if (!empty($three)) {
											$tx = '';
											foreach ($three as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes =  $notes . rtrim($tx, ', ') . ' ' . getDays(3) . ' ';
										}

										if (!empty($four)) {
											$tx = '';
											foreach ($four as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes =  $notes . rtrim($tx, ', ') . ' ' .  getDays(4) . ' ';
										}

										if (!empty($five)) {
											$tx = '';
											foreach ($five as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes =  $notes . rtrim($tx, ', ') . ' ' . getDays(5) . ' ';
										}

										if (!empty($six)) {
											$tx = '';
											foreach ($six as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(6) . ' ';
										}

										if (!empty($seven)) {
											$tx = '';
											foreach ($seven as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(7) . ' ';
										}

										if (!empty($eight)) {
											$tx = '';
											foreach ($eight as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(8) . ' ';
										}

										if (!empty($nine)) {
											$tx = '';
											foreach ($nine as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(9) . ' ';
										}
										if (!empty($ten)) {
											$tx = '';
											foreach ($ten as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(10) . ' ';
										}
											if (!empty($eleven)) {
											$tx = '';
											foreach ($eleven as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(11) . ' ';
										}
												if (!empty($twelve)) {
											$tx = '';
											foreach ($twelve as $key => $t) {
												$tx = $tx . $t . ', ';
											}
											if ($notes != "") {
												$notes = $notes . " & ";
											}
											$notes = $notes . rtrim($tx, ', ') . ' ' . getDays(12) . ' ';
										}
										echo $notes;
										?>
									</strong>
								</td>
							</tr>

							<?php
							if (!empty($empNotes)) {
								?>
								<tr>
									<td colspan="10">
										<strong>
											<?php 
											foreach ($empNotes as $key => $value) {
												echo $value;
											}
											?>
										</strong>
									</td>
								</tr>
								<?php
							}
							?>
							<?php
							$print_note = get_value("SELECT printing_note from jonotestbl WHERE jo_number = '$joid'");
							if ($print_note[0] != "" && $print_note[0] != "0") {
								?>
								<tr>
									<td colspan="10">
										<strong>
											<?php 											
											echo $print_note[0];
											?>
										</strong>
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-12 mt-4">
					<p style="font-size:14px"> The said JOB ORDER shall automatically cease upon its expiration as stipulated above, unless renewed.  Services of any or all of the above-named can be terminated prior to the expiration of the Job Order for lack of funds or when their services are no longer needed.  The above names hereby attest that he/she is not related within the fourth degree of consanguinity or affinity to the (1) Hiring Authority and/or (2) Representative of the Hiring Agency;and that he/she has not been previously dismissed from government service by reason of Administrative Offense. Furthermore, the service rendered hereunder is not considered or will never be accredited as Government Service.</p>
				</div>
				<div class="col-lg-12 mt-2">
					<p style="font-size:14px">CERTIFICATION AS TO THE AVAILABILITY OF APPROPRIATION/OBLIGATION AND CASH:</p>
				</div>
				<div class="clearfix mt-1"></div>
				<div class="clearfix mt-1"></div>
				<div class="col-lg-12 mt-2">
					<div class="row">
						<div class="col-lg-4" align="center">
							PREPARED & REVIEWED BY:<br>
							<div class="cont">
								<img src="../../assets/images/digisign.png" width="220px" style="margin-con">
								<div class="mt-4"><strong>PRINCE L. SUBION </strong></div>
								SAO(HRMO IV) / Acting PHRMO
							</div>
						</div>
						<div class="col-lg-4" align="center">
							AVAILABILITY OF APPROPRIATION:<br>
							<div class="mt-4"><strong>NEÑA V. GUERRERO</strong></div>
							Provincial Budget Officer	
						</div>
						<div class="col-lg-4" align="center">
							APPROVED:<br>
							<div class="initial">
								<?php 
								$checkNote = get_value("SELECT count(*) from jonotestbl WHERE jo_number = '$joid' and (note like '%APPROVED AS RECOMMENDED%') OR (note like '%RFA%')")[0];
								if ($checkNote != 0) {
									?>
									<img src="../../assets/images/initial.png" width="120px" style="">
									<?php
								}
								?>
								<div class="mt-4"><strong>JOSEPH C. CUA</strong></div>
								Governor	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>