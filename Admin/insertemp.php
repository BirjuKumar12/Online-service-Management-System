<?php
define('TITLE', 'Add New Technician');
define('PAGE', 'technician');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();

// Redirect if not logged in
if (!isset($_SESSION['is_adminlogin'])) {
    echo "<script> location.href='login.php'; </script>";
    exit;
}
$aEmail = $_SESSION['aEmail'];

if (isset($_REQUEST['empsubmit'])) {
    // Checking for Empty Fields
    if (empty($_REQUEST['empName']) || empty($_REQUEST['empCity']) || empty($_REQUEST['empMobile']) || empty($_REQUEST['empEmail'])) {
        $msg = '<div class="alert alert-warning text-center mt-2" role="alert"> <i class="fas fa-exclamation-triangle"></i> Please fill all fields! </div>';
    } else {
        // Assigning User Values to Variables
        $eName = $_REQUEST['empName'];
        $eCity = $_REQUEST['empCity'];
        $eMobile = $_REQUEST['empMobile'];
        $eEmail = $_REQUEST['empEmail'];

        $sql = "INSERT INTO technician_tb (empName, empCity, empMobile, empEmail) VALUES ('$eName', '$eCity','$eMobile', '$eEmail')";
        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success text-center mt-2" role="alert"> <i class="fas fa-check-circle"></i> Technician Added Successfully! </div>';
        } else {
            $msg = '<div class="alert alert-danger text-center mt-2" role="alert"> <i class="fas fa-times-circle"></i> Unable to Add Technician. </div>';
        }
    }
}
?>
<div class="container-fluid">
<div class="row">
<div class="col-md-3">
<?php include('includes/sidebar.php'); ?>

</div>
<div class="col-md-9">

    <div class="row justify-content-center">
        <div class="col-md-9 mt-5">
            <div class="card shadow-lg mt-3">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><i class="fas fa-user-cog"></i> Add New Technician</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="empName"><i class="fas fa-user"></i> Name</label>
                            <input type="text" class="form-control" id="empName" name="empName" placeholder="Enter Technician's Name">
                        </div>
                        <div class="form-group">
                            <label for="empCity"><i class="fas fa-city"></i> City</label>
                            <input type="text" class="form-control" id="empCity" name="empCity" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                            <label for="empMobile"><i class="fas fa-phone"></i> Mobile</label>
                            <input type="text" class="form-control" id="empMobile" name="empMobile" placeholder="Enter Mobile Number" onkeypress="isInputNumber(event)">
                        </div>
                        <div class="form-group">
                            <label for="empEmail"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="empEmail" name="empEmail" placeholder="Enter Email">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" id="empsubmit" name="empsubmit"><i class="fas fa-save"></i> Submit</button>
                            <a href="technician.php" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                        </div>
                    </form>
                    <?php if(isset($msg)) { echo '<div class="mt-3">'.$msg.'</div>'; } ?>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
</div>

<!-- Only allow numbers in the Mobile field -->
<script>
  function isInputNumber(evt) {
      var ch = String.fromCharCode(evt.which);
      if (!(/[0-9]/.test(ch))) {
          evt.preventDefault();
      }
  }
</script>

<?php include('includes/footer.php'); ?>
