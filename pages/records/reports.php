<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Generate Report</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="pages/print/generatereport.php" method="GET" target="_blank">
                            <div class="form-group">
                                <label>YEAR</label>
                                <select class="form-control form-control-lg" name="year">
                                    <option>2025</option>
                                    <option>2024</option>
                                    <option>2023</option>
                                </select>
                            </div>
                                 <div class="form-group">
                                <label>DATE SAVED (FROM)</label>
                                <input type="date" class="form-control form-control-lg" name="date_saved_from">
                            </div>
                                    <div class="form-group">
                                <label>DATE SAVED (TO)</label>
                                <input type="date" class="form-control form-control-lg" name="date_saved_to">
                            </div>
                            <!-- <div class="form-group">-->
                            <!--    <label>CONTRACT MONTH START(LEAVE BLANK IF NOT NEEDED)</label>-->
                            <!--    <select class="form-control form-control-lg" name="contract_month_start">-->
                            <!--        <option value="0">BLANK</option>-->
                            <!--        <option value="01">January</option>-->
                            <!--        <option value="02">February</option>-->
                            <!--        <option value="03">March</option>-->
                            <!--        <option value="04">April</option>-->
                            <!--        <option value="05">May</option>-->
                            <!--        <option value="06">June</option>-->
                            <!--        <option value="07">July</option>-->
                            <!--        <option value="08">August</option>-->
                            <!--        <option value="09">September</option>-->
                            <!--        <option value="10">October</option>-->
                            <!--        <option value="11">November</option>-->
                            <!--        <option value="12">December</option>-->
                            <!--    </select>-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <label>CONTRACT MONTH END(LEAVE BLANK IF NOT NEEDED)</label>-->
                            <!--    <select class="form-control form-control-lg" name="contract_month_end">-->
                            <!--       <option value="0">BLANK</option>-->
                            <!--        <option value="02">February</option>-->
                            <!--        <option value="03">March</option>-->
                            <!--        <option value="04">April</option>-->
                            <!--        <option value="05">May</option>-->
                            <!--        <option value="06">June</option>-->
                            <!--        <option value="07">July</option>-->
                            <!--        <option value="08">August</option>-->
                            <!--        <option value="09">September</option>-->
                            <!--        <option value="10">October</option>-->
                            <!--        <option value="11">November</option>-->
                            <!--        <option value="12">December</option>-->
                            <!--    </select>-->
                            <!--</div>-->
                            <div class="form-group">
                                <label>TYPE</label>
                                <select class="form-control form-control-lg" name="type">
                                    <option>JOB ORDERS</option>
                                    <option>PAYROLL</option>
                                </select>
                            </div>
                            <?php
                                $r = get_array("SELECT * from fundingtbl");
                            ?>
                             <div class="form-group">
                                <label>FUNDING</label>
                                <select class="form-control form-control-lg" name="funding">
                                     <option value="">All funding</option>
                                    <?php
                                   		foreach ($r as $key => $value) {
                                   		?>
                                   		 <option value="<?php echo trim($value["fund_id"]);?>"><?php echo $value["funding_name"]?>[<?php echo $value["funding_code"]?>]</option>
                                   		  <?php  
                                   		}
                                    ?>
                           
                                </select>
                            </div>
                            <div class="form-group">
                                <label>GO/SP</label>
                                <select class="form-control form-control-lg" name="fund">
                                    <option>GO</option>
                                    <option>SP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>DOCUMENT</label>
                                <select class="form-control form-control-lg" name="doctype">
                                    <option>EXCEL</option>
                                    <option>WEB/PDF</option>
                                </select>
                            </div>
                           
                            <button class="btn btn-primary btn-lg mt-2" type="submit">GENERATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
