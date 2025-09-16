<?php    
define('TITLE', 'Work Order');
define('PAGE', 'work');
include('includes/header.php'); 
include('../dbConnection.php');

if(session_id() == '') {
    session_start();
}

if(!isset($_SESSION['is_adminlogin'])){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

$aEmail = $_SESSION['aEmail'];

if(isset($_POST['assign'])){
    $work_date = date("Y-m-d");  // Current work date
    $assign_date = date("Y-m-d"); // Assign date (since it's missing in $_POST)

    // Check if all required fields are filled
    $fields = ['request_id', 'request_info', 'request_desc', 'requester_name', 'requester_add1', 'requester_add2',
               'requester_city', 'requester_state', 'requester_zip', 'requester_email', 'requester_mobile',
               'technician_name', 'technician_email', 'technician_mobile'];

    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
            break;
        }
    }

    if (!isset($msg)) {
        $sql = "INSERT INTO assignwork_technical_tb 
                (request_id, request_info, request_desc, requester_name, requester_add1, requester_add2, 
                requester_city, requester_state, requester_zip, requester_email, requester_mobile, assign_date, 
                technician_name, technician_email, technician_mobile, work_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isssssssssssssss", 
                $_POST['request_id'], 
                $_POST['request_info'], 
                $_POST['request_desc'], 
                $_POST['requester_name'], 
                $_POST['requester_add1'], 
                $_POST['requester_add2'], 
                $_POST['requester_city'], 
                $_POST['requester_state'], 
                $_POST['requester_zip'], 
                $_POST['requester_email'], 
                $_POST['requester_mobile'], 
                $assign_date,  // Now manually set
                $_POST['technician_name'], 
                $_POST['technician_email'], 
                $_POST['technician_mobile'], 
                $work_date
            );

            if ($stmt->execute()) {
                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Work Assigned Successfully </div>';
            } else {
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Error: '.$stmt->error.' </div>';
            }

            $stmt->close();
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Database Error: '.$conn->error.'</div>';
        }
    }
}
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            <?php include('includes/sidebar.php'); ?>
        </div>

        <div class="col-md-9">
            <form action="" method="POST">
                <h5 class="text-center">Assign Work Order Request</h5>

                <div class="form-group">
                    <label for="request_id">Request ID</label>
                    <select class="form-control" id="request_id" name="request_id">
                        <option value="">Select Request ID</option>
                        <?php
                        $sql = "SELECT request_id FROM submitrequest_tb";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['request_id'].'">'.$row['request_id'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="request_info">Request Info</label>
                    <input type="text" class="form-control" id="request_info" name="request_info"readonly>
                </div>
                <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="requestdesc">Description</label>
                    <input type="text" class="form-control" id="request_desc" name="request_desc"readonly>
                </div> 
                <div class="form-group col-md-6">
                    <label for="requestdesc">Request Date </label>
                    <input type="text" class="form-control" id="requester_date" name="request_date"readonly>
                </div>
                    </div>
                <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="requestername">Name</label>
                    <input type="text" class="form-control" id="requester_name" name="requester_name"readonly>
                </div>
                <div class="form-group col-md-4">
                        <label for="address2">Email</label>
                        <input type="text" class="form-control" id="requester_email" name="requester_email"readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="address2">Mobile</label>
                        <input type="text" class="form-control" id="requester_mobile" name="requester_mobile"readonly>
                    </div>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address1">Address Line 1</label>
                        <input type="text" class="form-control" id="requester_add1" name="requester_add1" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address2">Address Line 2</label>
                        <input type="text" class="form-control" id="requester_add2" name="requester_add2"readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="address1">City</label>
                        <input type="text" class="form-control" id="requester_city" name="requester_city"readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="address2">State</label>
                        <input type="text" class="form-control" id="requester_state" name="requester_state"readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="address1">Zip</label>
                        <input type="text" class="form-control" id="requester_zip" name="requester_zip"readonly>
                    </div>
                </div>
                <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="technician_name">Technician Name:</label>
                    <select id="technician_name" name="technician_name" class="form-control">
                        <option value="">Select Technician</option>
                        <?php
                        $sql = "SELECT * FROM technician_tb";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['empName'].'">'.$row['empName'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="technician_email">Technician Email:</label>
                    <input type="text" id="technician_email" name="technician_email" class="form-control" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label for="technician_mobile">Technician Mobile:</label>
                    <input type="text" id="technician_mobile" name="technician_mobile" class="form-control" readonly>
                </div>
                    </div>

                <div class="float-right">
                    <button type="submit" class="btn btn-success" name="assign">Assign</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>

            <?php if(isset($msg)) {echo $msg; } ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#request_id").change(function() {
        var requestId = $(this).val();
        if (requestId) {
            $.ajax({
                url: "fetch_request.php",
                type: "POST",
                data: { request_id: requestId },
                dataType: "json",
                success: function(data) {
                    $("#request_info").val(data.request_info);
                    $("#request_desc").val(data.request_desc);
                    $("#requester_name").val(data.requester_name);
                    $("#requester_add1").val(data.requester_add1);
                    $("#requester_add2").val(data.requester_add2);
                    $("#requester_add2").val(data.requester_add2);
                    $("#requester_city").val(data.requester_city);
                    $("#requester_state").val(data.requester_state);
                    $("#requester_zip").val(data.requester_zip);
                    $("#requester_email").val(data.requester_email);
                    $("#requester_mobile").val(data.requester_mobile);
                    $("#requester_date").val(data.request_date);
                }
            });
        }
    });

    $("#technician_name").change(function() {
        var empName = $(this).val();
        if (empName) {
            $.ajax({
                url: "fetch_technician_details.php",
                type: "POST",
                data: { empName: empName },
                dataType: "json",
                success: function(data) {
                    $("#technician_email").val(data.empEmail);
                    $("#technician_mobile").val(data.empMobile);
                }
            });
        }
    });
});
</script>

<?php include('includes/footer.php'); ?>
