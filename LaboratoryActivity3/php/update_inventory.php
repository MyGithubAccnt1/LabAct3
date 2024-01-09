<?php
include("connect.php");

$product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$unit_price = mysqli_real_escape_string($conn, $_POST["unit_price"]);
$unit_cost = mysqli_real_escape_string($conn, $_POST["unit_cost"]);
$unit_sold = mysqli_real_escape_string($conn, $_POST["unit_sold"]);

$sql = "SELECT unit_sold, quantity FROM inventory WHERE product_name = '$product_name' and category = '$category' and unit_cost = '$unit_cost'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $database_unit_sold = $row['unit_sold'];
    $updated_unit_sold = $database_unit_sold + $unit_sold;
    $database_quantity = $row['quantity'];
    $updated_quantity = $row['quantity'] - $unit_sold;

    $sql = "UPDATE inventory SET unit_sold = '$updated_unit_sold', quantity = '$updated_quantity' WHERE product_name = '$product_name' and category = '$category' and unit_cost = '$unit_cost'";

    if ($conn->query($sql) === TRUE) {
        
    }
} else {
    echo 'This item does not exist in the inventory.';
}
mysqli_close($conn);
?>
