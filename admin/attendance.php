<?php  include "include/header.php";
   $title = "Attendance";
 ?>

    <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">
        <?php echo $title; ?>
      </h1>
      <div class="row">
        <div class="col-lg-12 marginAuto mb-3" id="loadRecord"></div>
	 </div>
      <div class="row">
        <div class="col-lg-6">
		 <button class="btn btn-danger" id="Absent">Absent</button> 
        <button class="btn btn-success" id="Present">Present</button>
		</div>
     </div>
    </div>
    <script src="assets/custom/js/attendance.js"></script>

<?php  include "include/footer.php"; ?>