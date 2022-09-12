
	$(document).on("click", ".update", function () {
  var id = $(this).data("id");

  var is_present = $(this).data("ispresent");
  
  
  if(is_present == 1){
	var is_present_text = "Absent"
  }
  
  if(is_present == -1){
	var is_present_text = "Present"
  }
  
  // console.log("one" , id)
  // console.log("two" , today_date)
  // console.log("three" , is_present)
  // var element = this;

  Swal.fire({
    title: `Are you sure you want ${is_present_text} this record ?`,
   // text: "You will not be able to recover this Data !!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "primary",
    confirmButtonText: `Yes, ${is_present_text}`,
    reverseButtons: true,
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "student_detail_update.php",
        type: "POST",
        data: { id,is_present },
        success: function (data) {

          if (data == 1) {
            window.location.reload();
          } 
		  
		  else
		  {
            toastr.error("Sorry, Some Problem While Deleting");
          }
        },
      });
    } else {
      Swal.fire("Cancelled", "Update Cancelled", "error");
    }
  });
});
