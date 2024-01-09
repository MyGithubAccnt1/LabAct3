<?php
include("connect.php");

$sql = "SELECT * FROM inventory ORDER BY unit_sold DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    echo '
    <table class="table table-light text-center">
        <thead>
            <tr class="table-dark">
                <th scope="col" class="col-3 text-start">Product Name</th>
                <th scope="col" class="col-3 text-start">Category</th>
                <th scope="col" class="col-2">Unit Price</th>
                <th scope="col" class="col-2">Unit Cost</th>
                <th scope="col" class="col-1">Quantity</th>
                <th scope="col" class="col-1">Unit Sold</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '
            <tr>
                <th scope="row" class="text-start">'. $row['product_name'] .'</th>
                <td class="text-start">'. $row['category'] .'</td>
                <td>'. $row['unit_price'] .'</td>
                <td>'. $row['unit_cost'] .'</td>
                <td>'. $row['quantity'] .'</td>
                <td>'. $row['unit_sold'] .'</td>
            </tr>
        ';
    }

    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');
    $dayOfWeek = date('N', strtotime($date));
    $firstDayOfWeek = date('Y-m-d', strtotime('-' . ($dayOfWeek - 1) . ' days', strtotime($date)));
    $lastDayOfWeek = date('Y-m-d', strtotime('+' . (7 - $dayOfWeek) . ' days', strtotime($date)));

    $expenses_total = 0;

    $sql = "SELECT * FROM expenses WHERE deyt BETWEEN '$firstDayOfWeek' AND '$lastDayOfWeek'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $expenses_total = $row['store_rental'] + $row['electric_bill'] + $row['water_bill'] + $row['sales_staff'];
    }

    $sales_total = 0;
    $cost_total = 0;

    $sql = "SELECT * FROM sales WHERE deyt BETWEEN '$firstDayOfWeek' AND '$lastDayOfWeek'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sales_total = $sales_total + ($row['unit_price'] * $row['unit_sold']);
            $cost_total = $cost_total + ($row['unit_cost'] * $row['unit_sold']);
        }
    }

    $gross_income = $sales_total - $cost_total;
    $net_income = $sales_total - $expenses_total ;

    echo '
        </tbody>
    </table>
    <div class="row">
        <div class="col-6 text-end">
            <p>Gross Income:</p>
        </div>
        <div class="col-6 text-start">
            <p>PHP '. $gross_income .'</p>
        </div>
        <div class="col-6 text-end">
            <p>Net Income:</p>
        </div>
        <div class="col-6 text-start">
            <p>PHP '. $net_income .'</p>
        </div>
    </div>
    ';
} else {
    echo '
        <h6 class="text-center">No records found.</h6>
    ';
}
mysqli_close($conn);
?>
