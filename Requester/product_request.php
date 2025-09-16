<?php
include('../dbConnection.php');

if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $sql = "SELECT * FROM assets_tb WHERE pid = '$product_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
?>
