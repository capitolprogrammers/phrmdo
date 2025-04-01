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
	jonamestbl.id as jonameid
	FROM jonamestbl INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number INNER JOIN officetbl ON officetbl.office_id = jonamestbl.office_id INNER JOIN designationtbl ON designationtbl.designation_id = jonamestbl.designation_id  LEFT JOIN employeetbl ON employeetbl.employee_id = jonamestbl.employee_id WHERE jotbl.jo_number = '$joid' GROUP BY employeetbl.employee_id ORDER BY lname, mname, fname");
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
				bottom: -40px;
				z-index: 1;
    left: -20px;
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
			}
		</style>
	</head>

	<body>
		<div class="main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-4">
						<div class="date">
							<?php
							echo currentDateWords();
							?>
						</div>
						<div class="budget-head">
							MS. NEÑA V. GUERRERO
						</div>
						<div class="budget-head-pos">
							<i>Provincial Budget Officer</i>
						</div>
						<div class="office">Provincial Budget & Management Office</div>
						<div class="address">Virac, Catanduanes</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-lg-12 mt-4">
						<p>Madam: </p>
						<p class="mt-4">This is to respectfully submit the list of Job Order employee/s with approved contract/s of which this office is requesting for funds to be earnmark for wages covering the month/s
							<strong>
								<?php
								$x = get_value("SELECT contract_start, contract_end from jonamestbl INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number WHERE jotbl.jo_number = '$joid'");
								$start = $x[0];
								$end = $x[1];

							//echo $start . '<br>' . $end;
								$months =  getMonthNamesWithYear($start, $end);
								echo implode(', ', $months);



								$month = getMonthsInRange($start, $end);

							?></strong>.
						</p>
					</div>
					<div class="col-lg-12">
					<!-- 
					<option value="1">Regular Days</option>
					<option value="2">Including Saturdays and Holidays</option>
					<option value="3">Including Saturdays, Sundays and Holidays</option>
					<option value="4">Including Saturdays Only</option>
					<option value="5">Including Holidays Only</option>
					<option value="6">Including Saturdays, Sundays and Holidays (22days)</option> 
				-->
				<table class="table table-bordered">
					<thead>
						<th class="text-center">Item <br> No.</th>
						<th class="text-center">Job Order Contract <br> Number</th>
						<th style="text-indent: 5px;">Name</th>
						<th class="text-center">Rate per <br> day</th>
						<th class="text-center">Estimated Wage <br></th>
					</thead>
					<tbody>
						<?php
						$num = 1;
						$total = 0;
						foreach ($r as $key => $v) {
							$jonameid = $v["jonameid"];
							$wage = getDayWage($jonameid);
							$total += $wage;
							?>
							<tr>
								<td class="text-center"><?php echo $num ?></td>
								<td class="text-center"><?php echo $v["jo_number"] ?></td>
								<td style="text-indent: 5px;"><?php echo getData($v["employee_id"], 'name') ?></td>

								<td class="text-center"><?php echo number_format($v["rate"], 2) ?></td>
								<td class="text-center">
									<?php
								//	echo number_format($wage, 2) . ' totaldays: ' . $wage/$v['rate'] . ' includings: ' . $v["days"];
							 	echo number_format($wage, 2);
								// echo $wage;
									?>
								</td>
							</tr>
							<?php
							$num++;
						}
						?>
						<tr>
							<td class="text-center"><strong>Total</strong></td>
							<td colspan="3"></td>
							<td class="text-center"><strong><?php echo number_format($total, 2) ?></strong></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-lg-12 mt-2">
				<p class="mt-5">For your appropriate action, please.</p>
				<p class="mt-5">Very truly yours,</p>
			</div>
			<div class="col-lg-4 mt-5">
				<div class="cont">
					<img src="../../assets/images/digisign.png" width="220px" style="">
					<h6>PRINCE L. SUBION</h6>
					<i>SAO(HRMO IV) / Acting PHRMO</i>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

</html>