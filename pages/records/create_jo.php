<?php
$user_id = $_SESSION["user_id"];

$funding = get_array("SELECT funding_name, funding_code, fund_id from fundingtbl");

$program = get_array("SELECT program_id, program_name from programtbl");
?>
<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<h5 class="card-header">
				Create JO
			</h5>
			<div class="card-body">
				<form  id="myForm">
					<div class="form-group">
						<label for="jono">Job Order Number</label>
						<input type="text" class="form-control" placeholder="J.O Number" id="jono" name="jono">
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="date_from">Year</label>
								<select class="form-control" name="year" id="year" onchange="select_fund()">
									<option>-Select Year-</option>
									<option>2023</option>
									<option value="24">2024</option>
									<option value="25">2025</option>
									<option value="26">2026</option>
									<option value="27">2027</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="date_from">From</label>
								<select class="form-control" name="date_from" id="date_from" onchange="select_fund()">
									<option value="0">-Select Month-</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="date_to">To</label>
								<select class="form-control" name="date_to" id="date_to" onchange="select_fund()">
									<option value="0">-Select Month-</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="funding">Funding</label>
								<select class="form-control" id="funding" name="funding" onchange="select_fund()">
									<option value="0">-Select Funding-</option>
									<?php 
									foreach ($funding as $key => $f) {
										?>
										<option value="<?php echo $f[1] ?>" fund_id="<?php echo $f[2] ?>"><?php echo $f[0] ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="program">Program</label>
								<select class="form-control" id="program" name="program">
									<option value="0">-Select Program-</option>
									<?php 
									foreach ($program as $key => $p) {
										?>
										<option value="<?php echo $p[0] ?>"><?php echo $p[1] ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<textarea class="form-control" id="jo_note" name="jo_note" rows="5" placeholder="Note" style="display:none"></textarea>
							</div>
							<button type="button" class="btn btn-primary btn-block" onclick="saveJO()">SAVE</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">JO Records</h5>

			<div class="card-body">
				<div class="m2">
					<h5>Filters</h5>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<select class="form-control" id="searchStatus">
									<option value="">Filter by status</option>
									<?php 
									$r = get_array("SELECT status from jotbl GROUP BY status");
									foreach ($r as $key => $value) {
										?>
										<option><?php echo getStatus($value[0]); ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<select class="form-control" id="searchFunding">
									<option value="">Filter by funding</option>
									<?php 
									$r = get_array("SELECT fundingtbl.fund_id, funding_name from jotbl INNER JOIN fundingtbl ON jotbl.fund_id = fundingtbl.fund_id GROUP BY funding_name");
									foreach ($r as $key => $value) {
										?>
										<option value="<?php echo $value[1] ?>"><?php echo $value[1]; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<select class="form-control" id="searchProgram">
									<option value="">Filter by program</option>
									<?php 
									$r = get_array("SELECT programtbl.program_id, program_name from jotbl INNER JOIN programtbl ON programtbl.program_id = programtbl.program_id GROUP BY program_name");
									foreach ($r as $key => $value) {
										?>
										<option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<select class="form-control" id="searchCode">
									<option value="">Filter by account code</option>
									<?php 
									$r = get_array("SELECT acct_code from jotbl GROUP BY acct_code");
									foreach ($r as $key => $value) {
										?>
										<option><?php echo $value[0]; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="searchTxt" id="searchTxt" placeholder="Input Name...">
				</div>
				<button class="btn btn-info btn-block" name="searchBtn" onclick="searchJOName()">Search Name</button>

				<div class="table-responsive" id="joRecords" style="max-height:60vh">

				</div>
			</div>
		</div>
	</div>
</div>
