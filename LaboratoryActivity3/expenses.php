<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Laboratory Activity 3</title>
		<?php include('include/style.php') ?>
		<style type="text/css">
			form{
				position: relative;
				border: 1px solid #000;
				border-style: solid none none none;
			}
			form > h2{
				position: absolute;
				left: 5%;
				top: -25px;
				background-color: #fff;
			}
		</style>
	</head>
	<body>
		<main class="container-fluid p-0">
			<?php include('include/header.php') ?>
			<section class="container py-5">
				<form id="Expenses">
					<h2>Weekly Expenses</h2>
					<div class="row mt-5">
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Store Rental</label>
							<input type="number" class="form-control" name="store_rental" required>					</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Electric Bill</label>
							<input type="number" class="form-control" name="electric_bill" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Water Bill</label>
							<input type="number" class="form-control" name="water_bill" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Sales Staff</label>
							<input type="number" class="form-control" name="sales_staff" required>
						</div>
						<div class="col-sm-12 col-md-12 text-center mb-3">
							<button class="btn btn-sm btn-outline-primary py-1 w-75 rounded-pill" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</section>

			<section class="container py-5">
				<form id="New_Item">
					<h2>New Item</h2>
					<div class="row mt-5">
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Product Name</label>
							<input type="text" class="form-control" name="product_name" required>					</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Category</label>
							<input type="text" class="form-control" name="category" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Unit Price</label>
							<input type="number" class="form-control" name="unit_price" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Unit Cost</label>
							<input type="number" class="form-control" name="unit_cost" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Quantity</label>
							<input type="number" class="form-control" name="quantity" required>
						</div>
						<div class="col-sm-12 col-md-12 text-center mb-3">
							<button class="btn btn-sm btn-outline-primary py-1 w-75 rounded-pill" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</section>

			<section class="container py-5">
				<form id="Sold_Item">
					<h2>Sold Item</h2>
					<div class="row mt-5">
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Product Name</label>
							<input type="text" class="form-control" name="product_name" required>					</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Category</label>
							<input type="text" class="form-control" name="category" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Unit Price</label>
							<input type="number" class="form-control" name="unit_price" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Unit Cost</label>
							<input type="number" class="form-control" name="unit_cost" required>
						</div>
						<div class="col-sm-12 col-md-6 mb-3">
							<label class="form-label">Unit Sold</label>
							<input type="number" class="form-control" name="unit_sold" required>
						</div>
						<div class="col-sm-12 col-md-12 text-center mb-3">
							<button class="btn btn-sm btn-outline-primary py-1 w-75 rounded-pill" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</section>
		</main>
		<script type="text/javascript">
			$(window).on('load', function() {
				$('#Expenses').find("input[name='store_rental']").focus();
			});

			$("input[type='number']").on('change', function() {
			    if ($(this).val() < 0) {
			        $(this).val('');
			    }
			});

			$('#Expenses').on('submit', function(e) {
				e.preventDefault();

				var store_rental = $(this).find("input[name='store_rental']").val();
				var electric_bill = $(this).find("input[name='electric_bill']").val();
				var water_bill = $(this).find("input[name='water_bill']").val();
				var sales_staff = $(this).find("input[name='sales_staff']").val();

				$(this).find("input[name='store_rental']").val('');
				$(this).find("input[name='electric_bill']").val('');
				$(this).find("input[name='water_bill']").val('');
				$(this).find("input[name='sales_staff']").val('');

				$.ajax({
				    url: './php/add_expenses.php',
				    type: 'POST',
				    data: {
				        store_rental: store_rental,
				        electric_bill: electric_bill,
				        water_bill: water_bill,
				        sales_staff: sales_staff
				    },
				    success: function (data) {
				        data = data.trim();
				        alert('Notice: [' + data + ']');
				    }
				});
			})

			$('#New_Item').on('submit', function(e) {
				e.preventDefault();

				var product_name = $(this).find("input[name='product_name']").val();
				var category = $(this).find("input[name='category']").val();
				var unit_price = $(this).find("input[name='unit_price']").val();
				var unit_cost = $(this).find("input[name='unit_cost']").val();
				var quantity = $(this).find("input[name='quantity']").val();

				$(this).find("input[name='product_name']").val('');
				$(this).find("input[name='category']").val('');

				$.ajax({
				    url: './php/add_inventory.php',
				    type: 'POST',
				    data: {
				        product_name: product_name,
				        category: category,
				        unit_price: unit_price,
				        unit_cost: unit_cost,
				        quantity: quantity
				    },
				    success: function (data) {
				        data = data.trim();
				        if (!data) {
				            alert('Notice: An item has been successfully added.');
				            $(this).find("input[name='unit_price']").val('');
				            $(this).find("input[name='unit_cost']").val('');
				            $(this).find("input[name='quantity']").val('');
				        } else {
				            alert('Unexpected Error: [' + data + ']');
				            $(this).find("input[name='product_name']").focus();
				        }
				    }
				});
			})

			$('#Sold_Item').on('submit', function(e) {
				e.preventDefault();

				var product_name = $(this).find("input[name='product_name']").val();
				var category = $(this).find("input[name='category']").val();
				var unit_price = $(this).find("input[name='unit_price']").val();
				var unit_cost = $(this).find("input[name='unit_cost']").val();
				var unit_sold = $(this).find("input[name='unit_sold']").val();

				$(this).find("input[name='product_name']").val('');
				$(this).find("input[name='category']").val('');

				$.ajax({
				    url: './php/update_inventory.php',
				    type: 'POST',
				    data: {
				        product_name: product_name,
				        category: category,
				        unit_price: unit_price,
				        unit_cost: unit_cost,
				        unit_sold: unit_sold
				    },
				    success: function (data) {
				        data = data.trim();
				        if (!data) {
				            $.ajax({
				                url: './php/add_sales.php',
				                type: 'POST',
				                data: {
				                    product_name: product_name,
				                    category: category,
				                    unit_price: unit_price,
				                    unit_cost: unit_cost,
				                    unit_sold: unit_sold
				                },
				                success: function (data) {
				                    data = data.trim();
				                    if (!data) {
				                        alert('Notice: An item has been successfully updated.');
				                        $(this).find("input[name='unit_price']").val('');
				                        $(this).find("input[name='unit_cost']").val('');
				                        $(this).find("input[name='unit_sold']").val('');
				                    } else {
				                        alert('Unexpected Error: [' + data + ']');
				                        $(this).find("input[name='product_name']").focus();
				                    }
				                }
				            });
				        } else {
				            alert('Unexpected Error: [' + data + ']');
				            $(this).find("input[name='product_name']").focus();
				        }
				    }
				});
			})
		</script>
	</body>
</html>