<?php
$data = ['user Name', 'Loan amount', 'Number of years', 'interest rate', 'interest', 'Amount after interest', 'Monthly Payment'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username = $_POST['username'];
	$loanAmount = $_POST['loanamount'];
	$loanyears = $_POST['loanyears'];


	if ($loanyears <= 3) {
		$interestRate = 0.10;
		$finalRate = 	$interestRate * 100;
		$interest = $loanAmount * $interestRate * $loanyears;
		$total = $loanAmount + $interest;
		$monthlypay = $total / ($loanyears * 12);
	} elseif ($loanyears > 3) {
		$interestRate = 0.15;
		$finalRate = 	$interestRate * 100;
		$interest = $loanAmount * $interestRate * $loanyears;
		$total = $loanAmount + $interest;
		$monthlypay = $total / ($loanyears * 12);
	} else {
		echo "please Enter valid number";
	}

	$tableResult = "<table border='1' class='table'>";
	"<tr class='table'>";
	foreach ($data as $title) {
		$tableResult .= "<th>{$title}</th>";
	}
	$tableResult .= "</tr>
<tr >
<td >{$username}</td>																					
<td>{$loanAmount}</td>
<td>{$loanyears}</td>
<td>{$finalRate}%</td>
<td>{$interest}</td>
<td>{$total}</td>
<td>{$monthlypay}</td>
</tr>
</table>";
}


?>

<!doctype html>
<html lang="en">

<head>
	<title>Bank</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		.div {
			background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("1.jpg")center center/cover;
			height: 100vh;
		}

		.table {
			background-color: transparent;
			color: #fff;
			width: 70%;
			margin: auto;
			margin-top: 300px;
			border: 1px solid #fff;

		}
	</style>
</head>

<body>
	<div class="div">
		<nav class="navbar navbar-expand-lg  d-flex justify-content-between">
			<div class="collapse navbar-collapse w-50" id="navbarNavDropdown">
				<a class="navbar-brand text-light" href="#">Bank</a>
			</div>

			<div class="collapse navbar-collapse w-50 pl-2 d-flex justify-content-end" id="navbarNavDropdown">
				<ul class="navbar-nav ">
					<li class="nav-item active">
						<a class="nav-link text-light " href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light " href="#">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light " href="#">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light " href="#">News</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light " href="#">contact us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light " href="#">Apply for loan </a>
					</li>
		</nav>
		<form class=" text-light w-50 mx-auto mt-5" method="post">
			<div class="form-group ">
				<label for="exampleInputtext">User Name</label>
				<input type="text" class="form-control" id="exampleInputtext" name="username" value="<?= $_POST['username'] ?? "" ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputnumber">Loan Amount</label>
				<input type="number" class="form-control" id="exampleInputnumber" name="loanamount" value="<?= $_POST['loanamount'] ?? "" ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputnumber">Loan Years</label>
				<input type="number" class="form-control" id="exampleInputnumber" name="loanyears" value="<?= $_POST['loanyears'] ?? "" ?>">
			</div>
			<button type="submit" class="btn btn-primary">Calculate</button>
		</form>
		<div class="test-danger ">

			<?= $tableResult ?? "" ?>

		</div>
	</div>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>