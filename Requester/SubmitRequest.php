<?php
define('TITLE', 'Submit Request');
define('PAGE', 'SubmitRequest');
include('includes/header.php');
include('../dbConnection.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit;
} else {
    $rEmail = $_SESSION['rEmail'];
}

$msg = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitrequest'])) {
    // Validate required fields
    $requiredFields = [
        'requestinfo', 'requestdesc', 'requestername', 'requesteradd1', 'requesteradd2',
        'requestercity', 'requesterstate', 'requesterzip', 'requesteremail', 
        'requestermobile', 'requestdate'
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $msg = '<div class="alert alert-warning mt-2" role="alert"> Please fill all fields! </div>';
            break;
        }
    }

    if (empty($msg)) {
        // Assign form values to variables
        $rinfo   = trim($_POST['requestinfo']);
        $rdesc   = trim($_POST['requestdesc']);
        $rname   = trim($_POST['requestername']);
        $radd1   = trim($_POST['requesteradd1']);
        $radd2   = trim($_POST['requesteradd2']);
        $rcity   = trim($_POST['requestercity']);
        $rstate  = trim($_POST['requesterstate']);
        $rzip    = trim($_POST['requesterzip']);
        $remail  = trim($_POST['requesteremail']);
        $rmobile = trim($_POST['requestermobile']);
        $rdate   = trim($_POST['requestdate']);

        // Insert Data Using Prepared Statement
        $sql = "INSERT INTO submitrequest_tb 
                (request_info, request_desc, requester_name, requester_add1, requester_add2, 
                requester_city, requester_state, requester_zip, requester_email, requester_mobile, request_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssssss", $rinfo, $rdesc, $rname, $radd1, $radd2, 
                                              $rcity, $rstate, $rzip, $remail, $rmobile, $rdate);

            if ($stmt->execute()) {
                $_SESSION['myid'] = $conn->insert_id;
                echo "<script> location.href='submitrequestsuccess.php'; </script>";
                exit;
            } else {
                $msg = '<div class="alert alert-danger mt-2" role="alert"> Unable to submit request. Error: ' . $stmt->error . '</div>';
            }
            $stmt->close();
        } else {
            $msg = '<div class="alert alert-danger mt-2" role="alert"> SQL Prepare Failed: ' . $conn->error . '</div>';
        }
    }
}
$conn->close();
?>

<!-- Request Form Section -->
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <?php include('includes/sidebar.php'); ?>
        </div>

        <!-- Request Form -->
        <div class="col-sm-9 mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3>Submit Request</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="inputRequestInfo">Request Info</label>
                            <input type="text" class="form-control" id="inputRequestInfo" name="requestinfo" placeholder="Request Info">
                        </div>
                        <div class="form-group">
                            <label for="inputRequestDescription">Description</label>
                            <textarea class="form-control" id="inputRequestDescription" name="requestdesc" rows="3" placeholder="Write Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" name="requestername" placeholder="Your Name">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Address Line 1</label>
                                <input type="text" class="form-control" id="inputAddress" name="requesteradd1" placeholder="House No, Street">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Address Line 2</label>
                                <input type="text" class="form-control" id="inputAddress2" name="requesteradd2" placeholder="City, Landmark">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity" name="requestercity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <input type="text" class="form-control" id="inputState" name="requesterstate">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Zip Code</label>
                                <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="requesteremail">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputMobile">Mobile</label>
                                <input type="text" class="form-control" id="inputMobile" name="requestermobile" onkeypress="isInputNumber(event)">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputDate">Date</label>
                                <input type="date" class="form-control" id="inputDate" name="requestdate">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-info px-4" name="submitrequest">Submit</button>
                            <button type="reset" class="btn btn-secondary px-4">Reset</button>
                        </div>
                    </form>

                    <!-- Display Message -->
                    <?php if (!empty($msg)) { echo '<div class="mt-3">'.$msg.'</div>'; } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Allow Only Numbers for Specific Fields -->
<script>
function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
        evt.preventDefault();
    }
}
</script>

<?php include('includes/footer.php'); ?>
