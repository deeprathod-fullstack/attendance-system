loadRecord() 
function loadRecord(roll_no = null) {
	
	var action = "SELECT_STUDENT_LIMIT_1";
	
	$.ajax({
    url: "attendance_master.php",
    type: "POST",
	data: {
		action,roll_no
		
	},
    success: function (data) {
      $("#loadRecord").html(data);
	  if(data == "Attendance already taken"){
		  $("#Absent").hide();
		  $("#Present").hide();
		  $(window).off('beforeunload');
		  
	  }
	  else{
		   $(window).on('beforeunload', function(){
                  return 'Are you sure you want to leave?';
           });
	  }
      
    },
  });
}



function attendance_master(parameter){
	
	var roll_no = $("#roll_no").val()
	
	var is_present = parameter;
	var action = "INSERT";
	
	if(is_present == 1){
		var status = "Present";
		var Toastr = toastr.success;
	}
	if(is_present == -1){
		var status = "Absent";
		var Toastr = toastr.error;
	}

		$.ajax({
			url: "attendance_master.php",
			type: "POST",
			data: {
				action, roll_no, is_present
			},
			success: function (data) {
				if(data == 1){
					 Toastr(`Roll No ${roll_no} is ${status}`);
					
					var no = parseInt(roll_no) + 1;
					
					 loadRecord(no);
				}
				else{
					toastr.error("Sorry, Some Problem ");
				}
			},
	});
}


$(document).ready(function () {
	let check = false;
	  $("#Present").on("click", function (e) {
	  console.log("click");
		// $(this).css("pointer-events", "none")
		// $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
		var is_present = 1;
		attendance_master(is_present)
	  });
	  
	   $("#Absent").on("click", function (e) {
	    var is_present = -1;
		attendance_master(is_present)
	  });
	  
});
