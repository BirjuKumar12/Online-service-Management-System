<?php    
define('TITLE', 'Buy A product');
define('PAGE', 'Product');
include('includes/header.php'); 

include('../dbConnection.php');  
session_start();
$rEmail = $_SESSION['rEmail'];
$rName = ""; 

// Fetch user details
$sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $rName = $row["r_name"];
    $r_email = $row["r_email"];
}

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
                <h5 class="text-center">Buy Product/Order Request</h5>

                <div class="form-group">
                    <label for="product_id">Product ID</label>
                    <select class="form-control" id="product_id" name="product_id">
                        <option value="">Select Request ID</option>
                        <?php
                        $sql = "SELECT pid FROM assets_tb";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['pid'].'">'.$row['pid'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="request_info">Product Name</label>
                    <input type="text" class="form-control" id="panme" name="pname"readonly>
                </div>
                <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="requestdesc">Product Date </label>
                    <input type="text" class="form-control" id="pdop" name="pdop"readonly>
                </div>   <div class="form-group col-md-6">
                    <label for="requestdesc">Product_availability</label>
                    <input type="text" class="form-control" id="pava" name="pava"readonly>
                </div> 
                <div class="form-group col-md-6">
                    <label for="requestdesc"> Date Of Purchase </label>
                    <input type="text" class="form-control" id="ptotal" name="ptotal"readonly>
                </div>
                    </div>
              

                <div class="form-row">

            

                <div class="form-group col-md-4">
                    <label for="technician_email">Customer Name :</label>
                    <input type="text" id="technician_email" name="customer_name" class="form-control" value="<?php echo $rName; ?>" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label for="technician_mobile">Customer Email:</label>
                    <input type="text" id="technician_mobile" name="customer_email" class="form-control"  value="<?php echo $r_email; ?>" readonly>
                </div>
                    </div>

                <div class="float-right">
                    <button type="submit" class="btn btn-success" name="assign">Buy A Product</button>
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

    $("#product_id").change(function() {
        console.log("Dropdown Changed");
        var product_id = $(this).val();
        if (product_id) {
            console.log("Request ID:", product_id);
            $.ajax({
                url: "product_request.php",
                type: "POST",
                data: { product_id: product_id },
                dataType: "json",
                success: function(data) {
                    console.log("Response Data:", data);
                    $("#pname").val(data.pname);
                    $("#pdop").val(data.pdop);
                    $("#pava").val(data.pava);
                    $("#ptotal").val(data.ptotal);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }
    });
});
</script>
</body>

<?php include('includes/footer.php'); ?>
