<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$user = $_POST['username'];
	$city = $_POST['city'];
	$productCount = $_POST['numberOfProducts'];



	$firstForm = "	<div class='table w-100 mx-auto text-light'>

			<div class='row my-4 round-0 justify-content-between'>
					<div class='col-4 rounded-50 p-2 bg-primary text-light font-weight-bold mr-3 text-center'>product name</div>
					<div class='col-4 p-2 bg-primary text-light font-weight-bold text-center'>price</div>
					<div class='col-4 p-2 bg-primary text-light font-weight-bold text-center '>quantity</div>
			</div>
			";
	if (isset($productCount)) {
		for ($i = 1; $i <= 	$productCount; $i++) {
			$firstForm .=	"<div class='row w-200 mb-3 justify-content-between'>
						<div class='col-4 '><input class='form-control w-100' name='product-name[]' type='text'></div>
						<div class='col-4 '><input type='number' class='form-control w-100' name='price[]' ></div>
						<div class='col-4'><input type='number' class='form-control w-100' name='quantity[]'></div>
				</div>
		";
		}
	}


	$firstForm .= "	<button value='submit' class='w-100 btn btn-primary' name='finalResult'>submit</button>

</div>
";
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['finalResult'])) {
	$user = $_POST['username'];
	$city = $_POST['city'];
	$result = "<table class=' table mt-5 text-dark'>
	<tr>
			<td class='bg-primary text-light '>productname</td>
			<td class='bg-primary text-light'>price</td>
			<td class='bg-primary text-light'>quantity</td>
			<td class='bg-primary text-light'>total price</td>
	</tr>

	";
	$arrayFilter = [

		'product-name' => $_POST['product-name'],
		'price' => $_POST['price'],
		'quantity' => $_POST['quantity']
	];


	$myStructureArray = filter_var_array($arrayFilter);
	$finalPrice = [];

	for ($i = 0; $i < count($myStructureArray['product-name']); $i++) {
		$result .= "<tr>";
		$subTotal = $myStructureArray['quantity'][$i]  *  $myStructureArray['price'][$i];
		$finalPrice[$i] =  $myStructureArray['quantity'][$i]  *  $myStructureArray['price'][$i];
		$result .= "<td>" . $myStructureArray['product-name'][$i] . "</td>";
		$result .= "<td>" . $myStructureArray['price'][$i] . "</td>";
		$result .= "<td>" . $myStructureArray['quantity'][$i] . "</td>";
		$result .= "<td>" . $subTotal . "</td>";
		$result .= "</tr>";
	}


	$priceBeforeDiscount = array_sum($finalPrice);


	if ($priceBeforeDiscount < 1000) {
		$discount = 0;
	} elseif ($priceBeforeDiscount >= 1000 && $priceBeforeDiscount < 3000) {
		$discount = 0.1;
	} elseif ($priceBeforeDiscount >= 3000 && $priceBeforeDiscount < 4500) {
		$discount = 0.15;
	} else {
		$discount = 0.2;
	}


	if ($city == "Cairo") {
		$deliveryFees = 0;
	} elseif ($city == "Giza") {
		$deliveryFees = 30;
	} elseif ($city == "Alex") {
		$deliveryFees = 50;
	} elseif ($city == "other") {
		$deliveryFees = 100;
	}



	$result .= "<tr>
	   <td > User Name: </td>
	<td colspan='3'> {$user}</td>
	 </tr>
	";

	$discountValue = $priceBeforeDiscount * $discount;
	$totalAfterDiscount = $priceBeforeDiscount - $discountValue;
	$finalTotal = $totalAfterDiscount + $deliveryFees;
	$result .= "<tr><td > City: </td> <td colspan='3'> {$city} </td> </tr>";
	$result .= "<tr><td > Total before discount:  </td> <td colspan='3'> {$priceBeforeDiscount} </td> </tr>";
	$result .= "<tr><td > Discount:  </td> <td colspan='3'> {$discountValue}  </td> </tr>";
	$result .= "<tr><td > Total after discount:  </td> <td colspan='3'> {$totalAfterDiscount} EGP</td> </tr>";
	$result .= "<tr><td > Net price:  </td> <td colspan='3'> {$finalTotal}EGP</td> </tr>";
	$result .= "</table>";



	
}



?>

</style>
<!DOCTYPE html>
<html lang="en">

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>


<body>


	<div class="content">
		<form class=" text-dark w-50 mx-auto mt-5 table-bordered" method="post">
			<div class="form-group">
				<label for="exampleInputtext mb-4">User Name</label>
				<input type="text" class="form-control mb-4" id="exampleInputtext" name="username" value="<?= $_POST['username'] ?? "" ?>">
			</div>

			<div class="form-group mb-4 text-dark">
				<select class="form-select w-100 text-dark" aria-label="Default select example" name="city"> City
					<option value="Cairo" <?= isset($_POST['city'])  &&  $_POST['city'] == "Cairo" ?  "selected"  :  "" ?>>Cairo</option>
					<option value="Giza" <?= isset($_POST['city'])  &&  $_POST['city'] == "Giza" ?  "selected"  :  ""  ?>>Giza</option>
					<option value="Alex" <?= isset($_POST['city'])  &&  $_POST['city'] == "Alex" ?  "selected"  :  ""  ?>> Alex</option>
					<option value="other" <?= isset($_POST['city']) && $_POST['city'] == "other" ?  "selected"  :  ""  ?>> other</option>
				</select>
			</div>

			<div class="form-group">
				<label for="exampleInputnumber mb-4">number of products</label>
				<input type="number" class="form-control mb-4" id="exampleInputnumber" name="numberOfProducts" value="<?= $_POST['numberOfProducts'] ?? "" ?>">
				<?= $message ?? "" ?>
			</div>

			<input type="submit" value="Enter" name="submit" class="w-100 btn btn-primary ">

			<?= $firstForm  ?? "" ?>
			<div class='mb-5'> <?= $result ?? "" ?> </div>
		</form>


	</div>

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin: 0 auto;
			border: 1px;

		}


		table td {
			border: 1px;
			text-align: center;
			border: 1px solid black;
			padding: 4px;
		}

		.content {
			position: relative;
			top: 50px;
		}

		/* body {
			height: 2000px;
		} */

		.header {
			position: fixed;
			top: 0;
			z-index: 1;
			width: 100%;
			background-color: #eee;
			margin-bottom: 100px;
		}


		.header {
			position: fixed;
			top: 0;
			z-index: 1;
			width: 100%;
			background-color: #f1f1f1;
		}



		.progress-container {
			width: 100%;
			height: 8px;
			background: #ccc;
		}

		.progress-bar {
			height: 8px;
			background: #04AA6D;
			width: 0%;
		}
	</style>

</body>

</html>