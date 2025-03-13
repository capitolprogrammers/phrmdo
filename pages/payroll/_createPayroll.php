<?php
$user_id = $_SESSION["user_id"];
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">Create Payroll</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" class="form-control" id="search" placeholder="Search Employee...(Case sensitive)" onkeyup="search_employee_payroll()"></div>
					<div class="table-responsive" id="emptable" style="max-height:60vh;min-height: 60vh;">

					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="row card-header">
					<div class="col-lg-10">
						<h5 class="">Payroll List</h5>
					</div>
					<div class="col-lg-2">
						<button class="btn btn-info btn-block" onclick="print_menu()"><i class="mdi mdi-print"></i> Print</button>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table table-responsive" id="payroll_list" style="max-height:60vh;min-height: 60vh;">

					</div>
				</div>
			</div>
		</div>
	</div>