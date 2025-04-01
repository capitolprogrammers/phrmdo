<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<h5 class="card-header">
				New User Record
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="userName" class="form-control" placeholder="Username">
				</div>
				<div class="form-group">
					<input type="password" id="password" class="form-control" placeholder="Password">
				</div>
				<div class="form-group">
					<select class="form-control" id="userType">
						<option value="jo">J.O Recording</option>
						<option value="admin">Admin</option>
						<option value="payroll">Payroll</option>
						<option value="payroll_records">Payroll Records</option>
						<option value="jo_records">JO Records</option>
						<option value="findes">FINDES</option>
						<option value="pds">PDS</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" id="nameUser" class="form-control" placeholder="Name of the user">
				</div>
				<div class="form-group">
					<input type="text" id="userAddress" class="form-control" placeholder="Address">
				</div>
				<div class="form-group">
					<input type="text" id="contactNo" class="form-control" placeholder="Contact #">
				</div>
				<button class="btn btn-info btn-block" onclick="saveUser()">SAVE</button>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">Users</h5>
			<div class="card-body">
				<div class="table-responsive" style="max-height:65vh">
					<table class="table table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Username</th>
							<th>User Type</th>
							<th>Name</th>
							<th>Contact #</th>
						</thead>
						<tbody>
							<?php 
							$num= 1;
							$r = get_array("SELECT * from users WHERE password <> 'blocked123'");
							foreach ($r as $key => $v) {
								$id = $v[0];
								?>
								<tr onclick="editUser('<?php echo $id; ?>')">
									<td><?php echo $num ?></td>
									<td><?php echo c($v["username"]) ?></td>
									<td><?php echo $v["user_type"] ?></td>
									<td><?php echo $v["name"] ?></td>
									<td><?php echo $v["contact_number"] ?></td>
								</tr>
								<?php
								$num++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>