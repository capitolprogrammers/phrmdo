 <div class="row">
      <div class="col-lg-12">
        <div class="container mt-4">

        </div>
      </div>

      <div class="col-lg-12">
        <div class="card card-body">
          <h2 class="card-title" style="border-bottom: solid 1px #f8f7f7">Payroll Records </h2>
          <div class="row">
            <div class="col-lg-8"></div>

          </div>
          <div class="row">
           <div class="col-lg-4 mb-1">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="search_printed" placeholder="Search Employee" onchange="search_printed()">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group mb-1">
              <label>From</label>
              <input type="date" id="search_from_date" class="form-control" onchange="search_printed()" >
            </div>              
          </div>
          <div class="col-lg-4">
           <div class="form-group mb-1">
            <label>To</label>
            <input type="date" id="search_to_date" class="form-control" onchange="search_printed()">
          </div> 
        </div>
      </div>
      <div id="payroll_records"  class="chart-scroll-box table-responsive" style="max-height:500px">
        <h2>Search payroll to show record.</h2>
      </div>
    </div>
  </div>
</div>