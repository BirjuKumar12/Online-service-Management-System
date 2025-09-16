<?php
include('../dbConnection.php');

if(isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = '$request_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
?>
