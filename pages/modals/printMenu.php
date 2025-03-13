<?php 
include('../../assets/conn/etc.php');
session_start();
//cert by name 
//cert by pos
//office
//address
//approved
?>
<div class="row" style="padding:20px">
	<div class="col-lg-12">
		<h5>Payroll Setting</h5><hr>
	</div>
	<div class="col-lg-6 mb-2">
		<div class="form-group">
			<select class="form-control form-select-lg" id="print_approved">
				<option>JOSEPH C. CUA</option>
				<option>PETER C. CUA</option>
			</select>
		</div>
	</div>
	<div class="col-lg-6 mb-2">
		<div class="form-group">
			<select class="form-control form-select-lg" id="print_bank">
				<option>DBP</option>
				<option>LANDBANK</option>
				<option>-Without ATM-</option>
			</select>
		</div>
	</div>
	<div class="col-lg-12 mt-2">
		<h5>OBR Setting</h5><hr>
	</div>
	<div class="col-lg-12 mb-2">
		<div class="form-group">
			<input type="text" class="form-control form-control-lg" id="responsibility_center" placeholder="RESPONSIBILITY CENTER" data-toggle="tooltip" title="Responsibility Center" value="1-01-001">
		</div>
	</div>
<!-- 	<div class="col-lg-12 mb-2">
		<div class="form-group">
			<input type="text" class="form-control form-control-lg" id="acct_code" placeholder="ACCOUNT CODE" data-toggle="tooltip" title="Account Code" value="502-99-990-GO">
		</div>
	</div> -->
	<div class="col-lg-12 mb-2">
		<div class="form-group">
			<input type="text" class="form-control form-control-lg" id="certifier" placeholder="Certified By" value="PRINCE L. SUBION" onkeyup="search_head()" data-toggle="tooltip" title="Certifier">
			<span id="search_head"></span>
		</div>
	</div>
	<div class="col-lg-12 mb-2">
		<div class="form-group">
			<input type="text" class="form-control form-control-lg" id="certifier_position" placeholder="Position" value="SAO(HRMO IV) / Acting PHRMO"  data-toggle="tooltip" title="Position">
		</div>
	</div>
	<div class="col-lg-12 mb-2">
		<div class="form-group">
			<input type="text" class="form-control form-control-lg" id="print_office" placeholder="Office" value="Governor's Office" data-toggle="tooltip" title="Office">
		</div>
	</div>

	<div class="col-lg-12 mb-2">
		<div class="form-group">
			<select class="form-control form-select-lg" id="print_address"  data-toggle="tooltip" title="Address">
				<option>VIRAC, CATANDUANES</option>
				<option>CARAMORAN, CATANDUANES</option>
				<option>SAN ANDRES, CATANDUANES</option>
			</select>
		</div>
	</div>
	<div class="col-lg-3">
		<button class="btn btn-info btn-block" onclick="print_now()"><i class="fa fa-print"></i> PAYROLL</button> 

	</div>
	<div class="col-lg-3">
		<button class="btn btn-primary btn-block" onclick="print_now_obr()" id="print_obr" disabled><i class="fa fa-print"></i> OBR</button>
	</div>
		<div class="col-lg-3">
		<button class="btn btn-info btn-block" onclick="findes()"><i class="fa fa-print"></i> FINDES</button> 

	</div>
	<div class="col-lg-3">
		<button class="btn btn-success  btn-block" id="tag_printed" onclick="tag_printed()" disabled><i class="fa fa-check"></i> PRINTED</button>
	</div>
</div>