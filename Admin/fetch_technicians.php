<?php
include 'db_connect.php'; // Ensure database connection

$sql = "SELECT empID, empName FROM technician_tb";
$result = $conn->query($sql);

$technicians = [];
while ($row = $result->fetch_assoc()) {
    $technicians[] = $row;
}

echo json_encode($technicians);
?>
