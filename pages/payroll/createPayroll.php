<?php
$user_id = $_SESSION["user_id"];
?>
<div class="card">
	<h5 class="card-header">Create Payroll</h5>
	<div class="card-body">
		<div class="form-group">
			<input type="text" class="form-control" id="searchName" placeholder="Search Employee.." onkeyup="searchPayrollName()">
		</div>
		<div id="searchResult"></div>
		<div class="table table-responsive" id="payroll_list" style="max-height:50vh;min-height: 50vh;">
		</div>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-lg-2">
				<button class="btn btn-info btn-block btn-lg" onclick="print_menu()"><i class="mdi mdi-print"></i> PRINT</button>
			</div>
		</div>
	</div>
</div>
</div>