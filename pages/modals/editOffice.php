<?php 
include('../../assets/conn/etc.php');
$id = p('id');
$r = get_value("SELECT office_name from officetbl WHERE office_id = '$id'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo $r[0] ?><br>
				<small>Edit Office</small>
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="officeNameEdit" class="form-control" value="<?php echo $r[0] ?>">
				</div>
				<button class="btn btn-info btn-block" id="updateOffice" onclick="updateOffice('<?php echo $id ?>')">UPDATE</button>
				<button class="btn btn-danger btn-block mt-2" id="deleteOffice" onclick="deleteOffice('<?php echo $id ?>')">DELETE</button>

			</div>
		</div>
	</div>
</div>