<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">New Employee</h4>
				<p class="card-description"> Please input the fields. </p>
				<form class="forms-sample row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="fname">Firstname</label>
							<input type="text" class="form-control" id="fname" placeholder="First Name">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="mname">Middlename</label>
							<input type="text" class="form-control" id="mname" placeholder="Middle Name">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="lname">Lastname</label>
							<input type="text" class="form-control" id="lname" placeholder="Last Name">
						</div>
					</div>
					<div class="col-lg-7">
						<div class="form-group">
							<label for="lname">Address</label>
							<input type="text" class="form-control" id="address" placeholder="Address">
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group">
							<label for="lname">Phone Number</label>
							<input type="text" class="form-control" id="phonenum" placeholder="09123456789">
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="lname">Birthday</label>
							<input type="date" pattern="\d{2}-\d{2}-\d{4}"  class="form-control" id="birthday" placeholder="01-01-2023">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="lname">Gender</label>
							<select class="form-control" id="gender">
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="lname">C/O</label>
							<input type="text" class="form-control" id="c_o" placeholder="C/O">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="lname">Note</label>
							<textarea class="form-control" placeholder="Insert Note" id="note"></textarea>
						</div>
					</div>
					

					<div class="col-lg-12">
						<button type="button" class="btn btn-primary btn-icon-text" onclick="saveemployee()">
							<i class="mdi mdi-file-check btn-icon-prepend"></i> Save </button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Employees</h4>
					<p class="card-description"> <input type="text" class="form-control form-control-sm" placeholder="Search..." id="search" style="width:200px" onkeyup="search_employee()"></p>
					<div class="table-responsive" id="employee_table" style="max-height: 65vh;min-height: 65vh;">

					</div>
				</div>
			</div>
		</div>
	</div>
