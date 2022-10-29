<?php
session_start();




if ($_SESSION['hygine'] == 0) {

  $hegyine = "bad";
} elseif ($_SESSION['hygine'] == 3) {
  $hegyine = "good";
} elseif ($_SESSION['hygine'] == 5) {
  $hegyine = "very good";
} elseif ($_SESSION['hygine'] == 10) {
  $hegyine = "excellent";
}



if ($_SESSION['price'] == 0) {

  $price = "bad";
} elseif ($_SESSION['price'] == 3) {
  $price = "good";
} elseif ($_SESSION['price'] == 5) {
  $price = "very good";
} elseif ($_SESSION['price'] == 10) {
  $price = "excellent";
}




if ($_SESSION['nursing'] == 0) {

  $nursing = "bad";
} elseif ($_SESSION['nursing'] == 3) {
  $nursing = "good";
} elseif ($_SESSION['nursing'] == 5) {
  $nursing = "very good";
} elseif ($_SESSION['nursing'] == 10) {
  $nursing = "excellent";
}



if ($_SESSION['doctors'] == 0) {

  $doctors = "bad";
} elseif ($_SESSION['doctors'] == 3) {
  $doctors = "good";
} elseif ($_SESSION['doctors'] == 5) {
  $doctors = "very good";
} elseif ($_SESSION['doctors'] == 10) {
  $doctors = "excellent";
}



if ($_SESSION['hospital'] == 0) {

  $hospital = "bad";
} elseif ($_SESSION['hospital'] == 3) {
  $hospital = "good";
} elseif ($_SESSION['hospital'] == 5) {
  $hospital = "very good";
} elseif ($_SESSION['hospital'] == 10) {
  $hospital = "excellent";
}



if ($_SESSION['finalresult'] >= 0 && $_SESSION['finalresult'] <= 25) {
  $review="bad";
  $result = "<p class='text-danger text-center'> Thank you we will contact you {$_SESSION['tel']} to make the service better for you </p>";
} elseif ($_SESSION['finalresult'] > 25) {
  $review="Excellent";
  $result = "<p class='text-success text-center'> Thank you </p>";
}



?>

<!doctype html>
<html lang="en">

<head>
  <title>hospital</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .div {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('3.jpg') no-repeat center center /cover;
      height: 100vh;
      padding-top: 100px;
    }
      table {
        border-collapse: collapse;
      }

      td {
        text-align: center;
        padding: 20px;
      }


  </style>


</head>

<body>

  <div class="div">
       <table class="table table-header-rotated text-light mt-5">
      <thead>
        <tr>
          <th class="rotate">
            <div><span>Questions</span></div>
          </th>
          <th class="rotate">
            <div><span>Reviews</span></div>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="row-header">Are you satisfied with the level of hygine?</th>
          <td class="text-light"><?= $hegyine ?? "" ?></td>


        </tr>
        <tr>
          <th class="row-header">Are you satisfied with the price of service?</th>
          <td><?= $price ?? "" ?></td>
        </tr>
        <tr>
          <th class="row-header">Are satisfied with the nursing service?</th>
          <td><?= $nursing ?? "" ?></td>
        </tr>

        <tr>
          <th class="row-header">Are satisfied with the level of doctors?</th>
          <td><?= $doctors ?? "" ?></td>

        </tr>

        <tr>
          <th class="row-header">Are satisfied with the calmness of the hospital ?</th>
          <td><?= $hospital ?? "" ?></td>

        </tr>
      </tbody>
      <thead>
        <tr>
          <th>
            <div><span>total review</span></div>
          </th>
          <th>
            <div><span> <?=$review ?? ""?> </span></div>
          </th>
        </tr>
      </thead>
    </table>
    <?= $result ?? "" ?>
   


  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>


<?php





?>