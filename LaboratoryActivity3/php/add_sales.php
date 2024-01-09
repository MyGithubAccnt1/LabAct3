<?php
include("connect.php");
$product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$unit_price = mysqli_real_escape_string($conn, $_POST["unit_price"]);
$unit_cost = mysqli_real_escape_string($conn, $_POST["unit_cost"]);
$unit_sold = mysqli_real_escape_string($conn, $_POST["unit_sold"]);
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

$sql = "INSERT INTO sales (product_name, category, unit_price, unit_cost, unit_sold, deyt) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $product_name, $category, $unit_price, $unit_cost, $unit_sold, $date);
if ($stmt->execute()) {
    $stmt->close();
}
mysqli_close($conn);
?>
