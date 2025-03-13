<?php 
include('../../assets/conn/etc.php');
$joid = p('joid');
$r = get_value("SELECT note, printing_note, co_note from jonotestbl WHERE jo_number = '$joid'");
if (empty($r)) {
	$note = '';
	$print_note = '';
		$co_note = '';
}
else{
	$note = $r[0];
	$print_note = $r[1];
		$co_note = $r[2];
}
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
					<label>System Note</label>
					<textarea class="form-control" id="note" rows="5"><?php echo $note ?></textarea>
				</div>
				<div class="form-group">
					<label>Printing Note</label>
					<textarea class="form-control" id="print_note" rows="5"><?php echo $print_note ?></textarea>
				</div>
					<div class="form-group">
					<label>C/O Note</label>
					<textarea class="form-control" id="co_note" rows="5"><?php echo $co_note ?></textarea>
				</div>
				<button class="btn btn-info btn-block" id="saveNote" onclick="saveNote('<?php echo $joid ?>')">SAVE</button>
			</div>
		</div>
	</div>
</div>