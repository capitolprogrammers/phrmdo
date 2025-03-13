
<!-- modals -->
<div class="modal fade" tabindex="1" role="dialog" id="myModal2">
  <div class="modal-dialog modal-dialog-centered" role="document" id="modalDialog2" style="z-index: 999;">
    <div class="modal-content">
      <div class="modal-body" id="modal-body2" style="padding:0px">

      </div>
    </div>
  </div>
</div>
<!-- end modals -->
<!-- modals -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-dialog-centered" role="document" id="modalDialog">
    <div class="modal-content">
      <div class="modal-body" id="modal-body" style="padding:0px">

      </div>
    </div>
  </div>
</div>
<!-- end modals -->


<!-- toast -->

<!-- end toast -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
         <!--    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"></span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span> -->
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>

<!-- Plugin js for this page -->
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="assets/js/select2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<!--<script type="text/javascript" src="myjs.js"></script>-->
 <script type="text/javascript" src="myjs-minify.js"></script>  
<script type="text/javascript">
//   load_for_jos();
//   loademployees();
//   loadEmp();
//   loadPayroll();
//   loadJO();
  <?php 
  
  $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  
//   if (strpos($url,'create_payroll') !== false) {
//     echo 'loadPayroll();';
// }

// if (strpos($url,'records') !== false) {
//     echo 'loademployees();';
// }

if (strpos($url,'create_payroll') !== false) {
    echo 'loadPayroll();';
}

if (strpos($url,'showjos') !== false) {
    echo 'loadJO();';
}
  
 if ($_SESSION["user_type"] == "admin") {
//   echo ' loadPayroll()';
  echo 'getNotifications();';
}

 if ($_SESSION["user_type"] == "payroll") {
//   echo ' loadPayroll()';
      echo 'loadPayroll();';
}
  ?>
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#searchStatus").on("change", function() {
      let searchText = $(this).val().toLowerCase();
      searchTableRows(searchText);
    });


    $("#searchFunding").on("change", function() {
      let searchText = $(this).val().toLowerCase();
      searchTableRows(searchText);
    });

    $("#searchProgram").on("change", function() {
      let searchText = $(this).val().toLowerCase();
      searchTableRows(searchText);
    });


    $("#searchCode").on("change", function() {
      let searchText = $(this).val().toLowerCase();
      searchTableRows(searchText);
    });

  });




  function searchTableRows(searchText) {
    $("#tableJO tbody tr").each(function() {
      let rowData = $(this).text().toLowerCase();
      if (rowData.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }
</script>
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
</body>
</html>