<?php
include('../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    // Debugging logs
    error_log("Received pid: " . $pid);

    $sql = "SELECT pname, pava, psellingcost FROM assets_tb WHERE pid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No product found"]);
    }

    $stmt->close();
    $conn->close();
}
?>
