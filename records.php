<?php 
include('header.php');
?>
<div class="content-wrapper">
  <!-- start content -->
  <div class="row"> 
    <div class="col-5 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">New Employee</h4>
          <form class="form-sample">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-12 col-form-label">First Name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Middle Name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Last Name</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-12 col-form-label">Address 1</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">

             <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">Phone</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">Gender</label>
                <div class="col-sm-12">
                  <select class="form-control">
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">Date of Birth</label>
                <div class="col-sm-12">
                  <input class="form-control" placeholder="dd/mm/yyyy">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">C/O</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">Note</label>
                <div class="col-sm-12">
                 <textarea class="form-control"></textarea>
               </div>
             </div>
           </div>
         </div>
         <button type="button" class="btn btn-primary mr-2">Submit</button>
       </form>
     </div>
   </div>
 </div>
 <div class="col-lg-7 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
     <div class="row">
       <div class="col-lg-8">
         <h4 class="card-title">Employees </h4>
         <p class="card-description">  <code></code>
         </p>
       </div>
       <div class="col-lg-4">
        <input type="text" class="form-control " placeholder="Search..." style="float: right;">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>User</th>
            <th>Product</th>
            <th>Sale</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Jacob</td>
            <td>Photoshop</td>
            <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
            <td><label class="badge badge-danger">Pending</label></td>
          </tr>
          <tr>
            <td>Messsy</td>
            <td>Flash</td>
            <td class="text-danger"> 21.06% <i class="mdi mdi-arrow-down"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>John</td>
            <td>Premier</td>
            <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i></td>
            <td><label class="badge badge-info">Fixed</label></td>
          </tr>
          <tr>
            <td>Peter</td>
            <td>After effects</td>
            <td class="text-success"> 82.00% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-success">Completed</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
          <tr>
            <td>Dave</td>
            <td>53275535</td>
            <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
            <td><label class="badge badge-warning">In progress</label></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

</div>
<!-- end content -->
</div>
<?php 
include('footer.php');
?>