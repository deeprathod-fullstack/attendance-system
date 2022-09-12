
	$(document).on("click", ".delete-btn", function () {
  var id1 = $(this).data("id");
  //var element = this;

  Swal.fire({
    title: "Are you sure to delete this Record ?",
    text: "You will not be able to recover this Data !!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it !!",
    reverseButtons: true,
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "teacher_delete.php",
        type: "POST",
        data: { id: id1 },
        success: function (data) {
		console.log(data,"aa")
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
      Swal.fire("Cancelled", "Your record is safe :)", "error");
    }
  });
});
