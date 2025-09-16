<?php 
define('TITLE', 'Requester Profile');
define('PAGE', 'RequesterProfile');
include('includes/header.php'); 
include('../dbConnection.php');

session_start();
if(!isset($_SESSION['is_login'])){
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit();
}

$rEmail = $_SESSION['rEmail'];
$rName = ""; 

// Fetch user details
$sql = "SELECT r_name FROM requesterlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $rName = $row["r_name"];
}

// Handle profile update
if(isset($_REQUEST['nameupdate'])){
    $rName = trim($_REQUEST["rName"]); 
    if(empty($rName)){
        $passmsg = '<div class="alert alert-warning mt-2" role="alert">Please enter your name!</div>';
    } else {
        $sql = "UPDATE requesterlogin_tb SET r_name = '$rName' WHERE r_email = '$rEmail'";
        if($conn->query($sql) === TRUE){
            $passmsg = '<div class="alert alert-success mt-2" role="alert">Profile Updated Successfully!</div>';
        } else {
            $passmsg = '<div class="alert alert-danger mt-2" role="alert">Unable to Update Profile!</div>';
        }
    }
}
?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <?php include('includes/sidebar.php'); ?>
        </div>

        <!-- Profile Content -->
        <div class="col-md-9">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3><i class="fas fa-user-circle"></i> My Profile</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="inputEmail"><strong>Email</strong></label>
                            <input type="email" class="form-control" id="inputEmail" 
                                   value="<?php echo htmlspecialchars($rEmail); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputName"><strong>Name</strong></label>
                            <input type="text" class="form-control" id="inputName" name="rName" 
                                   value="<?php echo htmlspecialchars($rName); ?>">
                        </div>
                    
                        <?php if(isset($passmsg)) { echo $passmsg; } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
