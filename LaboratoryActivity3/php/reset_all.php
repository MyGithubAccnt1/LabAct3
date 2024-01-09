<?php
include("connect.php");

$sql = "TRUNCATE TABLE expenses";
if ($conn->query($sql) === TRUE) {
	$sql = "TRUNCATE TABLE inventory";
	if ($conn->query($sql) === TRUE) {
		$sql = "TRUNCATE TABLE sales";
		if ($conn->query($sql) === TRUE) {

		}
	}
}
mysqli_close($conn);
?>
