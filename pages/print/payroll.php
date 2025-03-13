<?php
include('../../assets/conn/etc.php');
include('../../phpqrcode/qrlib.php'); 

session_start();
$user_id = $_SESSION["user_id"];
$approved = $_GET["approved"];
$approved_pos = '';
if ($approved == 'JOSEPH C. CUA') {
	$approved_pos = 'PROVINCIAL GOVERNOR';
}
else{
	$approved_pos = 'PROVINCIAL VICE-GOVERNOR';
}


$tempDir = "../../qr/"; 

$pid = get_value("SELECT payroll_id from payrolltbl WHERE status is null and user_id = '$user_id'")[0];

$codeContents = $pid;

    // we need to generate filename somehow,  
    // with md5 or with database ID used to obtains $codeContents... 
$fileName = $pid . '.png'; 

$pngAbsoluteFilePath = $tempDir.$fileName; 

    // generating 
if (!file_exists($pngAbsoluteFilePath)) { 
	QRcode::png($codeContents, $pngAbsoluteFilePath); 

} else { 

} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PAYROLL_PRINT</title>
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
.box{
	border: solid black .5px;
	min-width: 20px;
	min-height: 15px;
	width:20px;
	float: left;
	margin-right: 5px;
}
.box-name{
	font-size: 10px;
}
th{
	font-size: 70%;
	padding:5px!important;
}
.letter{
	font-size: 12px;
	font-weight: 600;
}
.letter-name{
	margin-top:10px;
	font-weight: 800;
}
.payroll-period{
	border-left: 1px solid;
}
.payroll-period h5{
	font-size: 14px;
}
.payroll-period div{
	font-size: 13px;
}
.verified-name{
	margin-top: 40px;
	font-weight: 600;
	font-size:15px;
	text-align: center;
}
.verified-position{
	font-size: 12px;
	text-align: center;
	margin-bottom: 40px;
}
.verified-name-bot{
	margin-top: 20px;
	font-weight: 600;
	font-size:15px;
	text-align: center;
}
.verified-position-bot{
	font-size: 12px;
	text-align: center;
	margin-bottom: 20px;
}

.icu{
	font-size: 13px;
	font-weight: 400;
}
.fund{
	font-weight: 400;
	text-align: center;
	font-size: 12px;
}

table.table-bordered,
.table-bordered th,
.table-bordered td {
	border-width: .5px;
}

/* Optional: Set the border style and color */
table.table-bordered,
.table-bordered th,
.table-bordered td {
	border-style: solid;
	border-color: black;
	padding: 2px;
	font-size: 12px;
	text-align: center;
	vertical-align: middle;
}
.payroll_date{
	font-size: 12px;
	font-weight: 700;
	padding: 0px;
}
@media print 
{
	@page
	{
		size: legal;
		size: landscape;
		margin: 20px;
	}
}
</style>
</head>
<body>
<!-- <h1 class="text-center">PROVINCIAL GOVERNMENT OF CATANDUANES <br>
	GENERAL FUND <br><small>DAILY WAGE PAYROLL</small></h1> -->


	<div class="main main-border">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-sm-2 col-md-2 col-xl-2 col-xxl-2">
					<div class="row">
					    <div class="col-lg-12" style="border-top:solid 1px;border-bottom:solid 1px">
							<div class="letter">A.</div>
							<div class="letter-name mb-3">PREPARED BY:</div>
							<div class="box"></div> <div class="box-name"> DTR ATTACHED _______ </div>
							<div class="box"></div> <div class="box-name"> MAR ATTACHED _______ </div>
							<div class="box"></div> <div class="box-name"> COMPUTATION  _______ </div>
							<div class="verified-name">BRANDON M. GARCIA </div>
							<div class="verified-position">Computer Programmer I/Payroll In-charge</div>
						</div>

					    
						<div class="col-lg-12" style="border-top:solid 1px;border-bottom:solid 1px">
							<div class="letter">B.</div>
							<div class="letter-name">CERTIFIED: </div>
							<div style="font-size:8px;margin-bottom: 20px;">EACH PERSON WHOSE NAME APPEARS ON THE ROLL RENDERED SERVICES FOR THE TIME AND DATE AS VERIFIED AND CERTIFIED BY THE IMMEDIATE SUPERVISOR AS EVIDENCE BY THE FF DOCUMENTS ATTACHED TO THIS PAYROLL.</div>
							<!--<div class="box"></div> <div class="box-name"> DTR ATTACHED _______________</div>	-->
							<!--<div class="box"></div> <div class="box-name"> MAR ATTACHED _______________</div>-->
							<div class="verified-name">CHRISTOPHER A. TOMAGAN</div>
								<div class="verified-position">Administrative Officer V(HRMO III)</div>
						</div>


				
						<div class="col-lg-12">
							<div class="letter">C.</div>	
							<div class="letter-name">CERTIFIED CORRECT:</div>
							<div class="verified-name" style="letter-spacing: .5px;">SONIA P. VILLALUNA</div>
							<div class="verified-position">PROVINCIAL ACCOUNTANT</div>
							<div class="icu">ICU: ______________</div>
							<div class="icu">CARDING: _______________</div>
							<div class="icu">OBLIGATION: _______________</div>
						</div>
					</div>
				</div>
				<div class="col-lg-10 col-sm-10 col-md-10 col-xl-10 col-xxl-10">
					<div class="row">
						<div class="col-lg-10 col-sm-10 col-md-10 col-xl-10 col-xxl-10" style="border-left:solid 1px;border-right: solid 1px;">
							<div class="row">
								<div class="col-lg-10 col-sm-10 col-md-10 col-xl-10 col-xxl-10">
									<h3 class="text-center">PROVINCIAL GOVERNMENT OF CATANDUANES <br>
										GENERAL FUND 
										<br>
										<small>DAILY WAGE PAYROLL
										</small>
									</h3>
								</div>
								<div class="col-lg-2 col-sm-2 col-md-2 col-xl-2 col-xxl-2">
									<img src="../../qr/<?php echo $fileName ?>" style="float: right; margin-top:5px" width="80px">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 col-xxl-12">
									<span style="float:right;font-size: 15px;margin-top: -20px;">
										<?php 
										if ($_GET["bank"] == "DBP") {
											echo "<i>WITH ATM</i> <strong> DBP</strong>";
										}
										else if($_GET["bank"] == "LANDBANK"){

											echo "<i>WITH ATM</i> <strong> LBP</strong>";
										}
										?>
									</span>		
								</div>
							</div>

						</div>

						<div class="col-lg-2 col-sm-2 col-md-2 col-xl-2 col-xxl-2 payroll-period">
							<h5>PAYROLL PERIOD: </h5>
							<?php 
							$dates = get_array("SELECT datefrom,dateto from payrolltbl WHERE status is null and user_id = '$user_id' GROUP BY datefrom");
							foreach ($dates as $key => $value) {
								$datea = date_create($value["datefrom"]);
								$dateb = date_create($value["dateto"]);

								$datefrom = date_format($datea, 'F j');
								$dateto = date_format($dateb, 'j');

								$year = date_format($datea, 'Y');
								?>
								<div class="payroll_date"><?php echo $datefrom . ' - ' . $dateto . ', ' . $year; ?></div>
								<?php
							}
							?>
						</div>

						<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 col-xxl-12 x" style="padding:0px!important;height: 600px;">
							<!-- table -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="2" class="align-middle text-center">NO</th>
										<th rowspan="2" class="align-middle text-center col-2">NAMES</th>
										<th rowspan="2" class="align-middle text-center">DESIGNATION</th>
										<th rowspan="2" class="align-middle text-center">JOB ORDER NUMBER</th>
										<th rowspan="2" class="align-middle text-center">NO. OF DAYS WORK</th>
										<th rowspan="2" class="align-middle text-center">RATE PER DAY</th>
										<th rowspan="2" class="align-middle text-center">GROSS SALARY</th>
										<th colspan="3" class="align-middle text-center">
											DEDUCTIONS
										</th>
										<th rowspan="2" class="align-middle text-center">NETPAY</th>
										<th rowspan="2" class="align-middle text-center">SIGNATURE</th>
										<th colspan="3" class="align-middle text-center">COMMUNITY TAX</th>
									</tr>
									<tr>
										<th style="font-size: 8px;"class="align-middle text-center">UNDERTIME</th>
										<th style="font-size: 8px;"class="align-middle text-center">PAG-IBIG</th>
										<th style="font-size: 8px;"class="align-middle text-center">SSS</th>
										<th style="font-size: 8px;"class="align-middle text-center">NO</th>
										<th style="font-size: 8px;"class="align-middle text-center">DATE</th>
										<th style="font-size: 8px;"class="align-middle text-center">PLACE OF ISSUE</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$num = 1;
									$total_gross = 0;
									$total_undertime = 0;
									$total_pagibig = 0;
									$total_netpay = 0;
									$total_sss = 0;

									$get_emps = get_array("SELECT *, count(jo_id) as cnt from payrolltbl WHERE status is null and user_id = '$user_id' GROUP BY employee_id ORDER BY id");
									foreach ($get_emps as $key => $emp) {

										$emp_id = $emp[2];
										$jo_id = $emp[3];

										$payroll_id = $emp[0];

										$jonocnt = $emp['cnt'];

										$data = get_value("SELECT CONCAT(lname, ', ', fname) as fullname, mname from employeetbl WHERE employee_id = '$emp_id'");

										$jo_data = get_value("SELECT designation_name, jo_number, designationtbl.rate from designationtbl INNER JOIN jonamestbl ON jonamestbl.designation_id = designationtbl.designation_id WHERE jonamestbl.id = '$jo_id'");
										

										if ($data[1] == null || $data[1] == "N/A") {
											$minitial = "";
										}
										else{

											$minitial = $data[1] . '.';
										}
										$new_name = $data[0] . ' ' . str_replace(". .", ".", str_replace("..",".",$minitial));
										
										$rows = get_value("SELECT count(*), employee_id from payrolltbl WHERE employee_id = '$emp_id' and status is null and user_id = '$user_id'")[0];


										// if rows condition
										if ($rows > 1) {
											?>
											<tr>
												<td width="20px" rowspan="<?php echo $rows ?>" style="vertical-align: middle;"><?php echo $num; ?></td>
												<td style="text-align: left;vertical-align: middle;" width="200px" rowspan="<?php echo $rows?>">
													<?php 
													echo $new_name;
													?>
												</td>

												<td style="text-align:left;font-size: 9px;" width="200px"><?php echo $jo_data[0] ?></td>
												<td style="text-align:left;font-size: 10px;" width="150px"><?php echo $jo_data[1] ?></td>
												<td width="50px"><?php echo $emp["workdays"] ?></td>
												<td width="50px"><?php echo $jo_data[2] ?></td>
												<td width="100px">
													<?php echo number_format($emp["gross"], 2); 
													$total_gross = $total_gross + number_format($emp["gross"],2, '.', ''); 
													?>
												</td>
												<td width="50px"><?php echo number_format($emp["undertime"], 2); 
												$total_undertime = $total_undertime + number_format($emp["undertime"],2, '.', ''); 
											?></td>
											<td width="50px"><?php echo $emp["pagibig"]; $total_pagibig = $total_pagibig + $emp["pagibig"]; ?></td>
											<td width="50px"><?php echo $emp["sss"]; $total_sss = $total_sss + $emp["sss"]; ?></td>
											<td width="100px">
												<?php echo number_format($emp["netpay"], 2);
												$total_netpay = $total_netpay + number_format($emp["netpay"], 2, '.', '');
												?>
											</td>
											<td width="100px"><!-- signature --></td>
											<td width="50px"></td>
											<td width="50px"></td>
											<td width="50px"></td>
										</tr>	

										<?php 
										if ($jonocnt > 1) {

											$jos = get_array("SELECT 
												payrolltbl.jo_id, payrolltbl.id
												FROM
												payrolltbl
												INNER JOIN
												jonamestbl ON jonamestbl.id = payrolltbl.jo_id
												WHERE
												payrolltbl.employee_id = '$emp_id'
												AND user_id = '$user_id'
												AND payrolltbl.status IS NULL
												AND payrolltbl.id <> '$payroll_id'");

											foreach ($jos as $key => $jop) {

												$p_id = $jop[1];
												$jo_id2 = $jop[0];

												$get_emps = get_value("SELECT * from payrolltbl WHERE payrolltbl.id = '$p_id'");

												$jo_data2 = get_value("SELECT designation_name, jo_number, designationtbl.rate from designationtbl INNER JOIN jonamestbl ON jonamestbl.designation_id = designationtbl.designation_id WHERE jonamestbl.id = '$jo_id2'");
												?>
												<tr>
													<td style="text-align:left;font-size: 9px;" width="200px;"><?php echo $jo_data2[0]; ?></td>
													<td style="text-align:left;font-size: 10px;" width="150px"><?php echo $jo_data2[1]; ?></td>
													<td width="50px"><?php echo $get_emps["workdays"] ?></td>
													<td width="50px"><?php echo $jo_data2[2] ?></td>
													<td width="100px"><?php echo number_format($get_emps["gross"], 2); $total_gross = $total_gross + number_format($get_emps["gross"],2, '.', ''); ?></td>
													<td width="50px"><?php echo number_format($get_emps["undertime"], 2); $total_undertime = $total_undertime + number_format($get_emps["undertime"],2, '.', ''); ?></td>
													<td width="50px"><?php echo $get_emps["pagibig"]; $total_pagibig = $total_pagibig + $get_emps["pagibig"]; ?></td>
													<td width="50px"><?php echo $get_emps["sss"];$total_sss = $total_sss + $get_emps["sss"]; ?></td>
													<td width="100px">
														<?php
														echo number_format($get_emps["netpay"], 2); 
														$total_netpay = $total_netpay + number_format($get_emps["netpay"], 2, '.', ''); 
														?>
													</td>
													<td width="100px"><!-- signature --></td>
													<td width="50px"></td>
													<td width="50px"></td>
													<td width="50px"></td>
												</tr>
												<?php
											}
										}
										else {
											$jos = get_array("SELECT payrolltbl.jo_id, payrolltbl.id from payrolltbl INNER JOIN jonamestbl ON jonamestbl.id = payrolltbl.jo_id WHERE payrolltbl.employee_id = '$emp_id' and user_id = '$user_id' and status is null and jonamestbl.id = '$jo_id'");

											foreach ($jos as $key => $jop) {

												$p_id = $jop[1];
												$jo_id2 = $jop[0];

												$get_emps = get_value("SELECT * from payrolltbl WHERE payrolltbl.id = '$p_id'");

												$jo_data2 = get_value("SELECT designation_name, jo_number, designationtbl.rate from designationtbl INNER JOIN jonamestbl ON jonamestbl.designation_id = designationtbl.designation_id WHERE jonamestbl.id = '$jo_id2'");
												?>
												<tr>
													<td style="text-align:left;font-size: 9px;" width="200px;"><?php echo $jo_data2[0]; ?></td>
													<td style="text-align:left;font-size: 10px;" width="150px"><?php echo $jo_data2[1]; ?></td>
													<td width="50px"><?php echo $get_emps["workdays"] ?></td>
													<td width="50px"><?php echo $jo_data2[2] ?></td>
													<td width="100px"><?php echo number_format($get_emps["gross"], 2); $total_gross = $total_gross + number_format($get_emps["gross"],2, '.', ''); ?></td>
													<td width="50px"><?php echo number_format($get_emps["undertime"], 2); $total_undertime = $total_undertime + number_format($get_emps["undertime"],2, '.', ''); ?></td>
													<td width="50px"><?php echo $get_emps["pagibig"]; $total_pagibig = $total_pagibig + $get_emps["pagibig"]; ?></td>
													<td width="50px"><?php echo $get_emps["sss"];$total_sss = $total_sss + $get_emps["sss"]; ?></td>
													<td width="100px">
														<?php 
														echo number_format($get_emps["netpay"], 2);
														$total_netpay = $total_netpay + number_format($get_emps["netpay"], 2,'.',''); 
														?>
													</td>
													<td width="100px"><!-- signature --></td>
													<td width="50px"></td>
													<td width="50px"></td>
													<td width="50px">test</td>
												</tr>
												<?php
											}
										}
									}
									else{
										?>
										<tr>
											<td width="20px"><?php echo $num; ?></td>
											<td style="text-align: left;" width="200px">
												<?php 
												echo $new_name;
												?>
											</td>
											<td style="text-align:left;font-size: 9px;" width="200px"><?php echo $jo_data[0] ?></td>
											<td style="text-align:left;font-size: 10px;" width="150px"><?php echo $jo_data[1] ?></td>
											<td width="50px"><?php echo $emp["workdays"] ?></td>
											<td width="50px"><?php echo $jo_data[2] ?></td>
											<td width="100px"><?php echo number_format($emp["gross"], 2); $total_gross = $total_gross + number_format($emp["gross"],2, '.', ''); ?></td>
											<td width="50px"><?php echo number_format($emp["undertime"], 2); $total_undertime = $total_undertime + number_format($emp["undertime"],2, '.', ''); ?></td>
											<td width="50px"><?php echo $emp["pagibig"]; $total_pagibig = $total_pagibig + $emp["pagibig"]; ?></td>
											<td width="50px"><?php echo $emp["sss"];$total_sss = $total_sss + $emp["sss"]; ?></td>
											<td width="100px">
												<?php
												echo number_format($emp["netpay"], 2);
												$total_netpay = $total_netpay + number_format($emp["netpay"], 2, '.', ''); 
											?></td>
											<td width="100px"><!-- signature --></td>
											<td width="50px"></td>
											<td width="50px"></td>
											<td width="50px"></td>
										</tr>
										<?php
									}
									$num++;
								}
								?>
								<tr style="height:30px;margin-top: 410px;">
									<td colspan="6" style="text-align: left;"><strong>SUBTOTAL</strong></td>
									<td><strong><?php echo number_format($total_gross, 2); ?></strong></td>
									<td><strong><?php echo number_format($total_undertime, 2); ?></strong></td>
									<td><strong><?php echo number_format($total_pagibig, 2); ?></strong></td>
									<td><strong><?php echo number_format($total_sss, 2); ?></strong></td>
									<td colspan="6" style="text-align: left;text-indent: 20px"><strong><?php echo number_format($total_netpay, 2); ?></strong></td>
								</tr>
							</tbody>
						</table>
						<!-- end table -->
					</div>
					<!-- <div class="col-lg-12 x">SUBTOTAL</div> -->
					<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 col-xxl-12">
						<div class="row">
							<div class="col-lg-4 col-sm-4 col-md-4 col-xl-4 col-xxl-4" style="border-left:solid 1px">
								<div class="letter-name">D. FUNDS AVAILABILITY</div>
								<div class="verified-name-bot">ERME T. TABLANTE</div>
								<div class="verified-position-bot" style="margin-bottom: 10px;">ACTING PROVINCIAL TREASURER</div>
								<div class="fund">FUND CONTROL _________</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-md-4 col-xl-4 col-xxl-4" style="border-left:solid 1px; border-right: solid 1px;">
								<div class="letter-name">E. APPROVED FOR PAYMENT</div><br>
								<div class="verified-name-bot"><?php echo $approved ?></div>
								<div class="verified-position-bot"><?php echo $approved_pos ?></div>
							</div>
							<div class="col-lg-4 col-sm-4 col-md-4 col-xl-4 col-xxl-4">
								<div class="letter-name">F. CERTIFIED</div> <br>
								<div style="font-size:8px;margin-top:-20px">EACH PERSON WHOSE NAME APPEARS ON THE ABOVE ALL HAS BEEN PAID THE AMOUNT STATED OPPOSITE HIS NAME AFTER IDENTIFYING HIM.</div>
								<div class="verified-position-bot" style="margin-top:40px">NAME AND SIGNATURE OF THE DISBURSING OFFICER</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>