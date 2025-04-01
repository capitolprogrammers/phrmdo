<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<h5 class="card-header">
				New Office Record
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="officeName" class="form-control" placeholder="Office Name">
				</div>
				<button class="btn btn-info btn-block" onclick="saveOffice()">SAVE</button>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">Offices</h5>
			<div class="card-body">
				<div class="table-responsive" style="max-height:65vh">
					<table class="table table-bordered">
						<thead>
							<th>#</th>
							<th>Office</th>
							<th>Date Added</th>
							<th>Added By</th>
						</thead>
						<tbody>
							<?php 
							$num= 1;
							$r = get_array("SELECT * from officetbl");
							foreach ($r as $key => $v) {
								$id = $v[0];
								?>
								<tr onclick="editOffice('<?php echo $id; ?>')">
									<td><?php echo $num ?></td>
									<td><?php echo c($v["office_name"]) ?></td>
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