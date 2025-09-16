<?php
include('../dbConnection.php');

if(isset($_POST['empName'])) {
    $empName = $conn->real_escape_string($_POST['empName']);

    $sql = "SELECT empEmail, empMobile FROM technician_tb WHERE empName = '$empName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['empEmail' => '', 'empMobile' => '']);
    }
}
?>
