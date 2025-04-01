<?php 
include('../../assets/conn/etc.php');
$id = p('id');
$r = get_value("SELECT * from programtbl WHERE program_id = '$id'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				Edit Program
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="programNameEdit" class="form-control" value="<?php echo $r[1] ?>">
				</div>
				<div class="form-group">
					<select class="form-control" id="office_select_edit" name="office_select_edit">
						<?php 
						if ($r["office"] == "GO") {
							?>
							<option value="GO">Executive</option>
							<option value="SP">Legislative</option>
							<?php
						}
						else{
							?>
							<option value="SP">Legislative</option>
							<option value="GO">Executive</option>
							<?php
						}
						?>
					</select>
				</div>
				<button class="btn btn-info btn-block" id="updateOffice" onclick="programOption('update', '<?php echo $id ?>')">UPDATE</button>
				<button class="btn btn-danger btn-block mt-2" id="deleteOffice" onclick="programOption('delete', '<?php echo $id ?>')">DELETE</button>

			</div>
		</div>
	</div>
</div>