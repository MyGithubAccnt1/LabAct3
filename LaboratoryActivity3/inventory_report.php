<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Laboratory Activity 3</title>
		<?php include('include/style.php') ?>
		<style type="text/css">
			section > div{
				position: relative;
				border: 1px solid #000;
				border-style: solid none none none;
			}
			section > div > h2{
				position: absolute;
				left: 5%;
				top: -25px;
				background-color: #fff;
			}
			section > div > div > div{
				overflow-x: auto;
			}
		</style>
	</head>
	<body>
		<main class="container-fluid p-0">
			<?php include('include/header.php') ?>
			<section class="container py-5">
				<div>
					<h2>Product List</h2>
					<div class="row mt-5">
						<div class="col-12" id="product_list_container">
							<!-- dynamic -->
						</div>
					</div>
				</div>
			</section>
			<script type="text/javascript">
				$(window).on('load', function() {
					function ShowProductList() {
					    $.ajax({
					        url: "./php/get_inventory.php",
					        method: "GET",
					        success: function (data) {
					            data = data.trim();
					            $("#product_list_container").html(data);
					        }
					    });
					}
					setInterval(ShowProductList, 1000);
				});

				$(document).keydown(function(event) {
				    if (event.shiftKey && event.key === "Delete") {
						$.ajax({
					        url: "./php/reset_all.php",
					        method: "POST",
					        success: function (data) {
					            data = data.trim();
					            if (!data) {
					            	window.location.href = 'inventory_report.php';
					            } else {
					            	alert('Unexpected Error: [' + data + ']');
					            }
 					        }
					    });
				    }
			  	});
			</script>
		</main>
	</body>
</html>