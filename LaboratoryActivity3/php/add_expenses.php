<?php
include("connect.php");
$store_rental = mysqli_real_escape_string($conn, $_POST["store_rental"]);
$electric_bill = mysqli_real_escape_string($conn, $_POST["electric_bill"]);
$water_bill = mysqli_real_escape_string($conn, $_POST["water_bill"]);
$sales_staff = mysqli_real_escape_string($conn, $_POST["sales_staff"]);
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$dayOfWeek = date('N', strtotime($date));
$firstDayOfWeek = date('Y-m-d', strtotime('-' . ($dayOfWeek - 1) . ' days', strtotime($date)));
$lastDayOfWeek = date('Y-m-d', strtotime('+' . (7 - $dayOfWeek) . ' days', strtotime($date)));

$sql = "SELECT deyt FROM expenses WHERE deyt BETWEEN '$firstDayOfWeek' AND '$lastDayOfWeek'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 'You already added your expenses for this week.';
} else {

    $sql = "INSERT INTO expenses (store_rental, electric_bill, water_bill, sales_staff, deyt) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $store_rental, $electric_bill, $water_bill, $sales_staff, $date);
    
    if ($stmt->execute()) {
        echo 'Expenses are added successfully for this week.';
    } else {
        echo 'Error adding expenses: ' . $stmt->error;
    }
    
    $stmt->close();

}

mysqli_close($conn);
?>
