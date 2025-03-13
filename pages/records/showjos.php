<?php
$user_id = $_SESSION["user_id"];

// $funding = get_array("SELECT funding_name, funding_code, fund_id from fundingtbl");

// $program = get_array("SELECT program_id, program_name from programtbl");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">JO Records</h5>

			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<button class="btn btn-success btn-block btn-lg" name="approveBtn"  id="approveBtn" onclick="approveOption()" disabled>Approve Selected</button>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="searchTxt" id="searchTxt" placeholder="Input Name...">
						</div>
					</div>
					<div class="col-lg-2 col-md-2">
						<button class="btn btn-info btn-block btn-md" name="searchBtn" onclick="searchJOName()">Search</button>
					</div>
				</div>	
				<div class="row">
					<div class="col-lg-2">
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" style="margin-top: 20px!important;"  id="selectAll" onclick="selectAllJO()"/> <i class="input-helper"></i> Select All
							</label>
						</div>
					</div>
				</div>			
				<div class="table-responsive" id="joRecords" style="max-height:60vh">

				</div>
			</div>
		</div>
	</div>
</div>