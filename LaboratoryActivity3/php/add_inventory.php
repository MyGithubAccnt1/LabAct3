<?php
include("connect.php");
$product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$unit_price = mysqli_real_escape_string($conn, $_POST["unit_price"]);
$unit_cost = mysqli_real_escape_string($conn, $_POST["unit_cost"]);
$quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
$unit_sold = '0';

$sql = "SELECT * FROM inventory WHERE product_name = '$product_name' AND category = '$category'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    echo 'This item is already added.';

} else {

    $sql = "INSERT INTO inventory (product_name, category, unit_price, unit_cost, quantity, unit_sold) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $product_name, $category, $unit_price, $unit_cost, $quantity, $unit_sold);
    if ($stmt->execute()) {
        $stmt->close();
    }

}
mysqli_close($conn);
?>
