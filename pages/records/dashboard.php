<?php 
switch ($userType) {
	case 'admin':
	adminDashboard();
	break;
	
	default:
		// code...
	break;
}


function getCurrentQuarter() {
    $currentMonth = date('n'); // Get the current month (1-12)
    
    if ($currentMonth >= 1 && $currentMonth <= 3) {
        return 1;
    } elseif ($currentMonth >= 4 && $currentMonth <= 6) {
        return 4;
    } elseif ($currentMonth >= 7 && $currentMonth <= 9) {
        return 7;
    } else {
        return 10;
    }
}

function adminDashboard(){
	$currentMonth = getCurrentQuarter();
	$r = get_value("SELECT count(*) from jonamestbl INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number WHERE MONTH(jonamestbl.contract_start) = '$currentMonth'");
	?>
	<div class="row">
		<div class="col-sm-4 grid-margin">
			<div class="card">
				<div class="card-body">
					<h5>Recorded JO Employees</h5>
					<div class="row">
						<div class="col-8 col-sm-12 col-xl-8 my-auto">
							<div class="d-flex d-sm-block d-md-flex align-items-center">
								<h2 class="mb-0"><?php echo $r[0] ?></h2>
								<p class="text-success ml-2 mb-0 font-weight-medium"></p>
							</div>
							<h6 class="text-muted font-weight-normal">
								<?php 
								$activeJO = get_value("SELECT count(*) from jonamestbl INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number WHERE MONTH(jonamestbl.contract_start) = '$currentMonth' AND status = 6");
								echo $activeJO[0];
								?>
								Active J.Os this quarter
							</h6>
						</div>
						<div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
							<i class="icon-lg mdi mdi-account-multiple text-primary ml-auto"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 grid-margin">
			<div class="card">
				<div class="card-body">
					<h5>Approx Budget</h5>
					<div class="row">
						<div class="col-8 col-sm-12 col-xl-8 my-auto">
							<div class="d-flex d-sm-block d-md-flex align-items-center">
								<h2 class="mb-0">0</h2>
								<p class="text-success ml-2 mb-0 font-weight-medium"></p>
							</div>
							<h6 class="text-muted font-weight-normal"> 0% Since last quarter</h6>
						</div>
						<div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
							<i class="icon-lg mdi mdi-cash-multiple text-danger ml-auto"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 grid-margin">
			<div class="card">
				<div class="card-body">
					<h5>Balance</h5>
					<div class="row">
						<div class="col-8 col-sm-12 col-xl-8 my-auto">
							<div class="d-flex d-sm-block d-md-flex align-items-center">
								<h2 class="mb-0">0</h2>
								<p class="text-danger ml-2 mb-0 font-weight-medium"></p>
							</div>
							<h6 class="text-muted font-weight-normal">0% Since last quarter</h6>
						</div>
						<div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
							<i class="icon-lg mdi mdi-bank text-success ml-auto"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-4">
		


		<div class="col-lg-8">

			<div class="row">
				<div class="col-xl-6 col-sm-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-9">
									<div class="d-flex align-items-center align-self-start">
										<h3 class="mb-0">0</h3>
										<p class="text-success ml-2 mb-0 font-weight-medium"></p>
									</div>
								</div>
								<div class="col-3">
									<div class="icon icon-box-primary ">
										<span class="mdi mdi-gender-male icon-item"></span>
									</div>
								</div>
							</div>
							<h6 class="text-muted font-weight-normal">Male</h6>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-sm-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-9">
									<div class="d-flex align-items-center align-self-start">
										<h3 class="mb-0">0</h3>
										<p class="text-success ml-2 mb-0 font-weight-medium"></p>
									</div>
								</div>
								<div class="col-3">
									<div class="icon icon-box-danger">
										<span class="mdi mdi-gender-female icon-item"></span>
									</div>
								</div>
							</div>
							<h6 class="text-muted font-weight-normal">Female</h6>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-sm-6 grid-margin stretch-card mt-2">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-9">
									<div class="d-flex align-items-center align-self-start">
										<h3 class="mb-0">0</h3>
										<p class="text-danger ml-2 mb-0 font-weight-medium"></p>
									</div>
								</div>
								<div class="col-3">
									<div class="icon icon-box-danger">
										<span class="mdi mdi-arrow-bottom-left icon-item"></span>
									</div>
								</div>
							</div>
							<h6 class="text-muted font-weight-normal">Fundings</h6>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-sm-6 grid-margin stretch-card mt-2">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-9">
									<div class="d-flex align-items-center align-self-start">
										<h3 class="mb-0">0</h3>
										<p class="text-success ml-2 mb-0 font-weight-medium"></p>
									</div>
								</div>
								<div class="col-3">
									<div class="icon icon-box-success ">
										<span class="mdi mdi-arrow-top-right icon-item"></span>
									</div>
								</div>
							</div>
							<h6 class="text-muted font-weight-normal">Programs</h6>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card">
				<div class="card-body">
					<div class="d-flex flex-row justify-content-between">
						<h4 class="card-title">Users Activity</h4>
					</div>
					<div class="preview-list table-responsive" id="userLogsTbl"<?php responsive(40) ?>>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>