   const functions = 'pages/functions/';
   const tables = 'pages/tables/';
   const modals = 'pages/modals/';
   const shortMonthNames = [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

   function openModal(size, data){
   // $("#myModal").modal('hide');
   // $("#modal-body").html("");
   // $('#modalDialog').removeClass("modal-sm");
   // $('#modalDialog').removeClass("modal-lg");

      if (size == "small") {
         $('#modalDialog').addClass("modal-sm");
         $("#myModal").modal('show');
         $("#modal-body").html(data);
      }
      else if(size == "large"){
         $('#modalDialog').addClass("modal-lg");
         $("#myModal").modal('show');
         $("#modal-body").html(data);
      }
      else{
       $("#myModal").modal('show');
       $("#modal-body").html(data); 
    }

 }

 function openModalSecond(size, data){
   if (size == "small") {
      $('#modalDialog').addClass("modal-sm");
      $("#myModal2").modal('show');
      $("#modal-body2").html(data);
   }
   else if(size == "large"){
      $('#modalDialog2').addClass("modal-lg");
      $("#myModal2").modal('show');
      $("#modal-body2").html(data);
   }
   else{
    $("#myModal2").modal('show');
    $("#modal-body2").html(data); 
 }

}

function closeModal(){
   $("#myModal").modal('hide');
   $("#modal-body").html("");
}

function closeModal2(){
   $("#myModal2").modal('hide');
   $("#modal-body2").html("");
}

function loademployees(){
 $("#employee_table").html("Loading...");
 $.ajax({
    url: tables + "employees.php",
    method:"post",
    success: function (data) {
      $("#employee_table").html(data);
   }
});
}




function viewRecord(id){
   $.ajax({
    url: tables + "employee_view.php",
    method:"post",
    data:{id:id},
    success: function (data) {
     openModal(null, data);
  }
});
}


function saveemployee(){
 var fname = $('#fname').val();
 var mname = $('#mname').val();
 var lname = $('#lname').val();
 var address = $('#address').val();
 var phonenum = $('#phonenum').val();
 var gender = $('#gender').val();
 var birthday = $('#birthday').val();
 var c_o = $('#c_o').val();
 var note = $('#note').val();
 if (fname == null || fname == "") {
  alert("Please input the fields.");
}
else{
  $.ajax({
   url: functions + "employee_save.php",
   data:{fname:fname, mname:mname, lname:lname, address:address, phonenum:phonenum, gender:gender, birthday:birthday, c_o:c_o, note:note},
   method:"post",
   success: function (data) {
      $('#fname').val(null);
      alert(data);
      loademployees();
   }
});
}
}


function search_employee(){
 var value = $('#search').val();
 $("#employees").find("tr").each(function(index) {
  if (!index) return;
  var id = $(this).find("td").eq(1).text();
  $(this).toggle(id.indexOf(value) !== -1);
});
}

function delete_employee(id){
 if (confirm("Are you sure you want to delete this employee record?")) 
 {
  $.ajax({
     url: functions + "employee_delete.php",
     data:{id:id},
     method:"post",
     success: function (data) {
      alert(data);
      loademployees();
   }
});
}
}




function search_designation(){
   var txt = $('#search_designation').val();
   if (txt != "" || txt != null) {
     $.ajax({
      url: tables + "designation_search.php",
      data:{txt:txt},
      method:"post",
      success: function (data) {
         $("#designations").removeAttr("style");
         $('#designations').html(data);
      }
   });
  }
  else{
   $("#designations").css("display", "none");
}
}

function search_office(){
   var txt = $('#search_office').val();
   if (txt != "" || txt != null) {
     $.ajax({
      url: tables + "office_search.php",
      data:{txt:txt},
      method:"post",
      success: function (data) {
         $("#offices").removeAttr("style");
         $('#offices').html(data);
      }
   });
  }
  else{
   $("#offices").css("display", "none");
}
}

function select_fund(){
   var from = $('#date_from').val();
   var to = $('#date_to').val();
   var fund = $('#funding').val();



   var jono = $('#jono').val();

   var fromtxt = $('#date_from').find('option:selected').text();

   var range = to - from;

   var cleanjono = fund + "-" + fromtxt + "-" + "0" + (range+1) + "-";

   console.log(cleanjono);
   //$('#jono').val(jonoTxt);

   $.ajax({
      url: functions + "getJOno.php",
      data:{cleanjono:cleanjono},
      method:"post",
      success: function (data) {
        //  if (data != null || data != "") {
        //     $('#jono').val(data);
        //  }
        //  else{
        //   
        // }
       $('#jono').val(data);
    }
 });
}

function load_for_jos(){
   $.ajax({
      url: tables + "employee_add.php",
      method:"post",
      success: function (data) {
         $('#employee_for_printing').html(data);
      }
   });
}

function save_jo_request(id){
  var formData = $("#myForm").serialize();
  var designations = $('#designations').val();
  var offices = $('#offices').val();
  var jo_remarks = $('#jo_remarks').val();

  var sathol= $('#sathol').prop('checked');
  var satsunhol= $('#satsunhol').prop('checked');


  const funding = document.getElementById('funding');
  var selectedOption = funding.options[funding.selectedIndex];
  var fund_id = selectedOption.getAttribute("fund_id");

  formData += "&designations="+designations;
  formData += "&offices="+offices;
  formData += "&jo_remarks="+jo_remarks;
  formData += "&id="+id;
  formData += "&fund_id="+fund_id;
  formData += "&sathol="+sathol;
  formData += "&satsunhol="+satsunhol;

  $.ajax({
   url: functions + "employee_jo_save.php",
   data:formData,
   method:"post",
   success: function (data) {
      // $('#employee_for_printing').html(data);
      closeModal();
      load_for_jos();
   }
});
 // console.log(formData);
}

function showMenu(id, joNum){
   // 
   $.ajax({
      url: modals + "addJOShowMenu.php",
      data:{id:id, joNum:joNum},
      method:"post",
      success: function (data) {
         openModal("large", data);
      }
   });
}

function checkCheckbox(){
   const sathol = $('#sathol');
   const satsunhol = $('#satsunhol');

   if(sathol.prop('checked') == true){
      satsunhol.prop('checked', false);
   }
}

function msg(title, message){
   const success = `
   <div class='card' style='padding:5px'>
   <h5 class='card-header'>`+ title +`</h5>
   <div class='card-body'>`+ message +
   `<button class='btn btn-success btn-block mt-4' align='right'>OK</button>
   </div>
   </div>`;
   return success;
}

function reload(){
   location.reload();
}

function tagPrinted(joid){
   if (confirm("Are you sure?") == true) {
      closeModal();
      $.ajax({
         url: functions + "tagPrinted.php",
         data:{joid:joid},
         method:"post",
         success: function (data) {
            openModal("small", msg("Success", "J.O Contract tagged as printed."));
            load_for_jos();
         }
      });
   }
}
function tagSigned(joid){
   if (confirm("Are you sure?") == true) {
      closeModal();
      $.ajax({
         url: functions + "tagSigned.php",
         data:{joid:joid},
         method:"post",
         success: function (data) {
            openModal("small", msg("Success", "J.O Contract tagged as signed and for approval on budget."));
            load_for_jos();
         }
      });
   }
}
function tagApprovedModal(joid){
   $.ajax({
      url: modals + "tagApproved.php",
      data:{joid:joid},
      method:"post",
      success: function (data) {
         openModal("small", data);
      }
   });
}

function tagApproved(joid){
   var account_code = $('#account_code').val();
   if (confirm("Are you sure?") == true) {
      $.ajax({
         url: functions + "tagApproved.php",
         data:{joid:joid,account_code:account_code},
         method:"post",
         success: function (data) {
            openModal("small", msg("Success", "J.O Contract tagged as approved on budget."));
            closeModal();
            showJO(joid);
            loadJO();
         }
      });
   }
}

function tagForSigningGov(joid){
   if (confirm("Are you sure?") == true) {
      closeModal();
      $.ajax({
         url: functions + "tagForSigningGov.php",
         data:{joid:joid},
         method:"post",
         success: function (data) {
            openModal("small", msg("Success", "J.O Contract tagged as signed by Governor."));
            load_for_jos();
         }
      });
   }
}  
function tagActive(joid, empid){
   $.ajax({
      url: functions + "tagActive.php",
      data:{joid:joid,empid:empid},
      method:"post",
      success: function (data) {
       showJO(joid);
    }
 });
}
function tagInActive(joid, empid){
   $.ajax({
      url: functions + "taginActive.php",
      data:{joid:joid,empid:empid},
      method:"post",
      success: function (data) {
       showJO(joid);
    }
 });
}

function login(){
   var username = $('#username').val();
   var password = $('#password').val();
   $.ajax({
      url: functions + "login.php",
      data:{username:username, password:password},
      method:"post",
      success: function (data) {
         if (data == 0 || data == "") {
          $("#errormsg").removeAttr("style"); 
          $('#errormsg').html("Error. Either username or password is incorrect.");
            //alert(data);
       }
       else{
         window.location.replace("main.php?page=");
      }
         // alert(data);
   }
});
}

function loadEmp(){
 $("#emptable").html("Loading...");
 $.ajax({
   url: tables + "employeePayroll.php",
   method:"post",
   success: function (data) {
      $("#emptable").html(data);
   }
});
}

function add_payroll(id){
  $.ajax({
     url: modals + "addPayroll.php",
     method:"post",
     data:{id:id},
     success: function (data) {
      openModal("", data);
   }
});
}

function get_rate(){
 var mySelect = document.getElementById("designation");
 var selectedOption = mySelect.options[mySelect.selectedIndex];
 var myAttributeValue = selectedOption.getAttribute("rate");
 $("#rate").val(myAttributeValue.replace(",", ""));
}

function get_rate_payroll(){
 var mySelect = document.getElementById("jo_list");
 var selectedOption = mySelect.options[mySelect.selectedIndex];
 var myAttributeValue = selectedOption.getAttribute("rate");

 $("#rate").val(myAttributeValue.replace(",", ""));

 get_deduction();
}

function get_gross(){
 var workday = $('#workday').val();
 var rate = $('#rate').val();
 var undertime= $('#undertime').val();
 var pagibig = $('#pagibig').val();
 var gross = $('#gross').val();
 var deduction = $('#deduction').val();
 var total = $('#total').val();

 workrate = workday * rate;
 deductions = workrate - pagibig - deduction;

 $('#gross').val(workrate.toFixed(2));

 $('#total').val(deductions.toFixed(2));
}

function get_deduction(){
   var undertime= $('#undertime').val();
   var deduction = $('#deduction').val();
   var rate = $('#rate').val();
   var hrsrate = rate / 8 /60;
   var total = hrsrate * undertime;

   $('#deduction').val(total.toFixed(2));
   get_gross();
}

function savePayroll(id){

 var mySelect = document.getElementById("jo_list");
 var selectedOption = mySelect.options[mySelect.selectedIndex];
 var jo_id = selectedOption.getAttribute("jono");
 var payroll_id = selectedOption.getAttribute("payrollid");

 var datefrom = $('#date_from').val();
 var dateto = $('#date_to').val();
 var workday = $('#workday').val();
 var undertime= $('#undertime').val();
 var pagibig = $('#pagibig').val();
 var gross = $('#gross').val();
 var deduction = $('#deduction').val();
 var total = $('#total').val();

 $.ajax({
  url: functions + "savePayroll.php",
  data:{
   datefrom:datefrom,
   dateto:dateto,
   workday:workday,
   undertime:undertime,
   pagibig:pagibig,
   gross:gross,
   deduction:deduction,
   total:total,
   jo_id:jo_id,
   payroll_id:payroll_id,
   id:id
},
method:"post",
success: function (data) {
   openModal("small", msg("Success", "Payroll added."));
   loadPayroll();
}
});

}

function loadPayroll(){
  $("#payroll_list").html("Loading...");
  $.ajax({
    url: tables + "loadPayroll.php",
    method:"post",
    success: function (data) {
     $("#payroll_list").html(data);
  }
});
}

function search_employee_payroll(){
 var value = $('#search').val();
 $("#employees").find("tr").each(function(index) {
  if (!index) return;
  var id = $(this).find("td").eq(1).text();
  $(this).toggle(id.indexOf(value) !== -1);
});
}


function print_menu(){
 $.ajax({
  url: modals + "printMenu.php",
  method:"post",
  success: function (data) {
   openModal("", data);
}
}); 
}

function print_now(){
  $('#print_obr').prop('disabled', false);

  var approved = $('#print_approved').val();
  var print_bank = $('#print_bank').val();
  window.open("pages/print/payroll.php?approved=" + approved + '&bank=' + print_bank, "_blank");
}

function print_now_obr(name, pos, office){
  $('#tag_printed').prop('disabled', false);

  var certifier = $('#certifier').val();
  var certifier_position = $('#certifier_position').val();
  var print_office = $('#print_office').val();
  var address = $('#print_address').val();

  var acct_code = $('#acct_code').val();
  var responsibility_center = $('#responsibility_center').val();

  window.open("pages/print/payrollObr.php?certifier=" + certifier + "&pos=" + certifier_position + "&print_office=" + print_office + "&address=" + address + "&acct_code=" + acct_code + "&responsibility_center=" + responsibility_center, "_blank");
}

function getMonthDifference(startDate, endDate) {
 var start = new Date(startDate);
 var end = new Date(endDate);

 var yearsDiff = end.getFullYear() - start.getFullYear();
 var monthsDiff = end.getMonth() - start.getMonth();
 var totalMonths = yearsDiff * 12 + monthsDiff;

  // Adjust for cases where the end day of the month is earlier than the start day
 if (end.getDate() < start.getDate()) {
  totalMonths--;
}

return totalMonths;
}

//note
function addNote(joid){
 $.ajax({
  url: modals + "addNote.php",
  method:"post",
  data:{joid:joid},
  success: function (data) {
   openModal("small", data);
}
}); 
}
function saveNote(joid){
   var note = $('#note').val();
   $.ajax({
      url: functions + "saveNote.php",
      method:"post",
      data:{joid:joid, note:note},
      success: function (data) {
         closeModal();
         showJO(joid);
         openModal("small", msg("Success", "J.O Note saved."));
      }
   }); 
}


//deletejo
function deleteJO(joid){
 if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "deleteJO.php", 
      method:"post",
      data:{joid:joid},
      success: function (data) {
         openModal("small", msg("Success", "JO deleted."));
      }
   }); 
 }
}

//createJO
function saveJO(){
 if (confirm("Are you sure?") == true) {
    var formData = $("#myForm").serialize(); 
    var fund_id = $("#funding").find(':selected').attr('fund_id');
    var funding = $('#funding').val();
    var program = $('#program').val();

    formData += "&fund_id="+fund_id;

    if (funding == 0 || program == 0) {
      alert("SELECT FUNDING || PROGRAM!");
   }
   else{
    $.ajax({
      url: functions + "saveJO.php", 
      method:"post",
      data:formData,
      success: function (data) {
         openModal("small", msg("Success",data));
         loadJO();
      }
   }); 
 }
}
}

function loadJO(){
  $.ajax({
   url: tables + "joRecords.php", 
   method:"post",
   success: function (data) {
      $('#joRecords').html(data);
   }
}); 
}

function showJO(id){
  $.ajax({
   url: modals + "showJO.php", 
   method:"post",
   data:{id:id},
   success: function (data) {
      openModalSecond("large", data);
   }
}); 
}

function search_employee_jo(jonum){
   var txt = $('#search_jo').val();
   $.ajax({
     url: tables + "search_jo.php",
     data:{txt:txt,jonum:jonum},
     method:"post",
     success: function (data) {
      $('#searchjo').html(data);
   }
});
}

function select_employee(id,jonum){
   $.ajax({
      url: modals + "employee_select.php",
      data:{id:id,jonum:jonum},
      method:"post",
      success: function (data) {
         openModal("small", data);
      }
   });
}


function saveEmployeeJO(id, jonum){
   var date_from = $('#date_from2').val()
   var date_to = $('#date_to2').val()
   var designations = $('#designations').val()
   var offices = $('#offices').val()
   var jo_remarks = $('#jo_remarks').val()

   var days= $('#daysTxt').val();

   var note= $('#noteTxt').val();
   $.ajax({
      url: functions + "saveEmployeeJO.php",
      data:{id:id,jonum:jonum, date_from:date_from, date_to:date_to, designations:designations,offices:offices, jo_remarks:jo_remarks,days:days, note:note},
      method:"post",
      success: function (data) {
        closeModal();
        showJO(jonum);
     }
  });
}

//approvejo

function tagApproveJO(joid){
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "approveJO.php", 
      method:"post",
      data:{joid:joid},
      success: function (data) {
         openModal("small", msg("Success", "JO approved."));
         showJO(joid);
      }
   }); 
 }
}

function tagdisapproveJO(joid){
   if (confirm("Please add some note first before disapproving. If you already did, please click OK.") == true) {
    $.ajax({
      url: functions + "disapproveJO.php", 
      method:"post",
      data:{joid:joid},
      success: function (data) {
         openModal("small", msg("Success", "JO disapproved."));
         showJO(joid);
      }
   }); 
 }
}


function tagFinished(joid){
  if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "tagFinished.php", 
      method:"post",
      data:{joid:joid},
      success: function (data) {
         openModal("small", msg("Success", "JO is now active."));
         showJO(joid);
      }
   }); 
 }

}

//addoffice
function saveOffice(){
   var officename = $('#officeName').val();
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "saveOffice.php", 
      method:"post",
      data:{officename:officename},
      success: function (data) {
         openModal("small", msg("Save Office", data));
         location.reload();
      }
   }); 
 }
}

function editOffice(id){
 $.ajax({
   url: modals + "editOffice.php", 
   method:"post",
   data:{id:id},
   success: function (data) {
      openModal("small", data);
   }
}); 
}

function updateOffice(id){
   var officeName = $('#officeNameEdit').val();
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "updateOffice.php", 
      method:"post",
      data:{id:id,officeName:officeName},
      success: function (data) {
         openModal("small", msg("Success", data));
         location.reload();
      }
   }); 
 }
}
function deleteOffice(id){
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "deleteOffice.php", 
      method:"post",
      data:{id:id},
      success: function (data) {
         openModal("small", msg("Success", data));
         location.reload();
      }
   }); 
 }
}

//designation
function saveDesignation(){
   var designationName = $('#designationName').val();
   var designationRate = $('#designationRate').val();
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "saveDesignation.php", 
      method:"post",
      data:{designationName:designationName,designationRate:designationRate},
      success: function (data) {
         openModal("small", msg("Save Designation", data));
         location.reload();
      }
   }); 
 }
}

function editDesignation(id){
 $.ajax({
   url: modals + "editDesignation.php", 
   method:"post",
   data:{id:id},
   success: function (data) {
      openModal("small", data);
   }
}); 
}

function updateDesignation(id){
   var designationName = $('#designationNameEdit').val();
   var rate = $('#designationRateEdit').val();
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "updateDesignation.php", 
      method:"post",
      data:{id:id,designationName:designationName,rate:rate},
      success: function (data) {
         openModal("small", msg("Success", data));
         location.reload();
      }
   }); 
 }
}
function deleteDesignation(id){
   if (confirm("Are you sure?") == true) {
    $.ajax({
      url: functions + "deleteDesignation.php", 
      method:"post",
      data:{id:id},
      success: function (data) {
         openModal("small", msg("Success", data));
         location.reload();
      }
   }); 
 }
}

//admin notifs
function getNotifications(){
   setInterval(function() {
    $.ajax({
      url: functions + "getNotifications.php", 
      method:"post",
      success: function (data) {
         if(data != ""){
            openModal("small", msg("J.O", data));
         }
      }
   }); 
    console.log('This code will run every 2 minutes.');
 }, 120000);

}

function changeHoliday(id, type){
   var monthHoliday = $('#month_' + id).val();
   var monthHolidayWeekend = $('#month_' + id + "_weekend").val();
   $.ajax({
      url: functions + "changeHoliday.php", 
      data:{id:id, 
      monthHoliday:monthHoliday, 
      monthHolidayWeekend:monthHolidayWeekend},
      method:"post",
      success: function (data) {
         openModal("small", msg("Holidays", data));
      }
   }); 
}

//saveusers

function saveUser(){
   var userName = $('#userName').val();
   var password= $('#password').val();
   var userType= $('#userType').val();
   var nameUser= $('#nameUser').val();
   var userAddress= $('#userAddress').val();
   var contactNo= $('#contactNo').val();

   $.ajax({
      url: functions + "saveUser.php", 
      data:{userName:userName, password:password, userType:userType, nameUser:nameUser, userAddress:userAddress, contactNo:contactNo},
      method:"post",
      success: function (data) {
         openModal("small", msg("Save User", data));
      }
   }); 
}

function selectUser(userId){
   $.ajax({
      url: functions + "saveUser.php", 
      data:{userId:userId},
      method:"post",
      success: function (data) {
         openModal("small", msg("Save User", data));
      }
   }); 
}


//program
function editProgram(id){
  $.ajax({
   url: modals + "editProgram.php", 
   data:{id:id},
   method:"post",
   success: function (data) {
      openModal("small", data);
   }
}); 
}

function programOption(type, id){
   var programNameEdit = $('#programNameEdit').val();
   var office_select_edit = $('#office_select_edit').val();
   $.ajax({
      url: functions + "programOption.php", 
      data:{id:id, programNameEdit:programNameEdit, office_select_edit:office_select_edit, type:type},
      method:"post",
      success: function (data) {
         openModal("small", msg("Program", data));
      }
   }); 
}

function deleteEmpJO(id, jonum){
   if (confirm("Remove this employee on this JO?") == true) {
    $.ajax({
      url: functions + "deleteEmpJO.php", 
      data:{id:id},
      method:"post",
      success: function (data) {
         showJO(jonum);
      }
   }); 
 }
}

//funding
function editFunding(id){
  $.ajax({
   url: modals + "editFunding.php", 
   data:{id:id},
   method:"post",
   success: function (data) {
      openModal("small", data);
   }
}); 
}

function fundingOption(type, id){
   var fundingNameEdit = $('#fundingNameEdit').val();
   var fundingCodeEdit = $('#fundingCodeEdit').val();
   $.ajax({
      url: functions + "fundingOption.php", 
      data:{id:id, fundingNameEdit:fundingNameEdit, fundingCodeEdit:fundingCodeEdit, type:type},
      method:"post",
      success: function (data) {
         openModal("small", msg("Funding", data));
      }
   }); 
}


function delete_payroll(payroll_id){
   if (confirm("Are you sure you want to delete this Payroll Record?")) 
   {
     $.ajax({
       url:functions + "delete_payroll.php",
       data:{payroll_id:payroll_id},
       method:"post",
       success: function (data) {
         alert(data);
         loadPayroll();
      }
   });
  }
}


function tag_printed(){
 $.ajax({
   url: functions + "tag_printed.php",
    method:"post",
    success: function (data) {
      alert(data);
      loadPayroll();
      closeModal();
   }
}); 
}
