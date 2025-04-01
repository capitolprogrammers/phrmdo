<?php 
include('../../assets/conn/etc.php');
$joid = p('joid');

$funding = get_array("SELECT funding_name, funding_code, fund_id from fundingtbl");

$program = get_array("SELECT program_id, program_name from programtbl");

?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo $joid ?><br>
				<small>Add note</small>
			</h5>
			<div class="card-body">
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
					<div class="col-lg-6">
						<div class="form-group">
							<label for="date_from">Contract Start</label>
							<input type="date" id="select_date_from" class="form-control">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="date_to">Contract End</label>
							<input type="date" id="select_date_to" class="form-control">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<select class="form-control" id="contract_stats">
								<option value="1">Renewal</option>
								<option value="2">Original</option>
								<option value="3">Re-Employment</option>
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
						<button class="btn btn-info btn-block" id="renewJO" onclick="renewJO('<?php echo $joid ?>')">SAVE</button>
					</div>
				</div>
			</div>
		</div>