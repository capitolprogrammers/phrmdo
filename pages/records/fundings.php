<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Add New Funding <br><small class="card-description">Please reload para mag take effect.</small></h5>
			</div>
			<div class="card-body">
				<form method="POST">
					<div class="form-group">
						<label for="program_name">Funding Name</label>
						<input type="text" id="funding_name" name="funding_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="funding_code">Funding Code</label>
						<input type="text" id="funding_code" class="form-control" name="funding_code">
					</div>
					<button type="submit" class="btn btn-info" name="saveFunding">SAVE</button>
				</form>
				<?php 
				if (isset($_POST["saveFunding"])) {
					$funding_name = p("funding_name");
					$funding_code = $_POST["funding_code"];

					$r = get_value("SELECT count(*) from fundingtbl WHERE funding_name = '$funding_name'")[0];
					if ($r == 0) {
						saveUserLog(null, "CREATED NEW FUNDING RECORD. $funding_name $funding_code");
						qr("INSERT INTO fundingtbl (funding_name, funding_code) VALUES ('$funding_name', '$funding_code')");
						?>
						<div class="alert alert-success mt-2">FUNDING SAVED.</div>
						<?php
					}
					else{
						?>
						<div class="alert alert-warning mt-2">DUPLICATE RECORD.</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">Fundings</h5>

			<div class="card-body">
				<div class="table-responsive" <?php echo responsive(50) ?>>
					<table class="table table-condensed">
						<?php 
						$r = get_array("SELECT * from fundingtbl");
						?>
						<thead>
							<th>#</th>
							<th>Funding Name</th>
							<th>Funding Code</th>
						</thead>
						<tbody>
							<?php 
							$num= 1;
							foreach ($r as $key => $p) {
							
								?>
								<tr onclick="editFunding('<?php echo $p["fund_id"] ?>')">
									<td><?php echo $num; ?></td>
									<td><?php echo $p["funding_name"]; ?></td>
									<td><?php echo $p["funding_code"] ?></td>
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