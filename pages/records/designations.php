<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<h5 class="card-header">
				New Designation Record
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="designationName" class="form-control" placeholder="Designation">
				</div>
				<div class="form-group">
					<input type="number" id="designationRate" class="form-control" placeholder="Rate">
				</div>
				<button class="btn btn-info btn-block" onclick="saveDesignation()">SAVE</button>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">Designations</h5>
			<div class="card-body">
				<div class="table-responsive" style="max-height:65vh">
					<table class="table table-bordered">
						<thead>
							<th>#</th>
							<th>Designation</th>
							<th>Rate</th>
							<th>Date Added</th>
							<th>Added By</th>
						</thead>
						<tbody>
							<?php 
							$num= 1;
							$r = get_array("SELECT * from designationtbl WHERE status is null ORDER BY designation_name ASC");
							foreach ($r as $key => $v) {
								$id = $v[0];
								?>
								<tr onclick="editDesignation('<?php echo $id; ?>')">
									<td><?php echo $num ?></td>
									<td><?php echo c($v["designation_name"]) ?></td>
									<td><?php echo $v["rate"] ?></td>
									<td><?php echo $v["date_saved"] ?></td>
									<td><?php echo getUser($v["added_by"]) ?></td>
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