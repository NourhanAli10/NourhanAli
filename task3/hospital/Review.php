<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['hygine']) && isset($_POST['price']) && isset($_POST['nursing']) &&  isset($_POST['doctors'])  && isset($_POST['hospital'])) {
    $finalresult = $_POST['hygine'] + $_POST['price'] + $_POST['nursing'] + $_POST['doctors'] + $_POST['hospital'];
    $_SESSION['finalresult'] = $finalresult;
    $_SESSION['hygine'] = $_POST['hygine'];
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['nursing'] = $_POST['nursing'];
    $_SESSION['doctors'] = $_POST['doctors'];
    $_SESSION['hospital'] = $_POST['hospital'];
    //
    header('location:Result.php');
    die;
  } else {
    $errors = "<p class='text-danger font-weight-bold'> Please select one </p>";
  }
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

    form {
      padding-top: 200px;
    }

    .table-header-rotated {
      border-collapse: collapse;

    }

    .csstransforms .table-header-rotated td {
      width: 30px;
    }

    .no-csstransforms .table-header-rotated th {
      padding: 5px 10px;
    }

    .table-header-rotated td {
      text-align: center;
      padding: 10px 5px;
      border: 1px solid #ccc;
    }

    .csstransforms .table-header-rotated th.rotate {
      height: 140px;
      white-space: nowrap;
    }

    .csstransforms .table-header-rotated th.rotate>div {
      -webkit-transform: translate(25px, 51px) rotate(315deg);
      transform: translate(25px, 51px) rotate(315deg);
      width: 30px;
    }

    .csstransforms .table-header-rotated th.rotate>div>span {
      border-bottom: 1px solid #ccc;
      padding: 5px 10px;
    }

    .table-header-rotated th.row-header {
      padding: 0 10px;
      border-bottom: 1px solid #ccc;
    }
  </style>


</head>

<body>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  <div class="div">
    <form method="POST">
      <table class="table table-header-rotated text-light">
        <thead>
          <tr>
            <th></th>
            <th class="rotate">
              <div><span>bad</span></div>
            </th>
            <th class="rotate">
              <div><span>good</span></div>
            </th>
            <th class="rotate">
              <div><span>very good</span></div>
            </th>
            <th class="rotate">
              <div><span>excellent</span></div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th class="row-header">Are you satisfied with the level of hygine?</th>
            <td><input name="hygine" type="radio" value="0"></td>
            <td><input name="hygine" type="radio" value="3"></td>
            <td><input name="hygine" type="radio" value="5"></td>
            <td><input name="hygine" type="radio" value="10"></td>

          </tr>
          <tr>
            <th class="row-header">Are you satisfied with the price of service?</th>
            <td><input name="price" type="radio" value="0"></td>
            <td><input name="price" type="radio" value="3"></td>
            <td><input name="price" type="radio" value="5"></td>
            <td><input name="price" type="radio" value="10"></td>
          </tr>
          <tr>
            <th class="row-header">Are satisfied with the nursing service?</th>
            <td><input name="nursing" type="radio" value="0"></td>
            <td><input name="nursing" type="radio" value="3"></td>
            <td><input name="nursing" type="radio" value="5"></td>
            <td><input name="nursing" type="radio" value="10"></td>

          </tr>

          <tr>
            <th class="row-header">Are satisfied with the level of doctors?</th>
            <td><input name="doctors" type="radio" value="0"></td>
            <td><input name="doctors" type="radio" value="3"></td>
            <td><input name="doctors" type="radio" value="5"></td>
            <td><input name="doctors" type="radio" value="10"></td>

          </tr>

          <tr>
            <th class="row-header">Are satisfied with the calmness of the hospital ?</th>
            <td><input name="hospital" type="radio" value="0"></td>
            <td><input name="hospital" type="radio" value="3"></td>
            <td><input name="hospital" type="radio" value="5"></td>
            <td><input name="hospital" type="radio" value="10"></td>

          </tr>
        </tbody>
      </table>
      <?= $errors ?? "" ?>
     <button type='submit' class='btn btn-outline-primary text-white w-40'>submit</button>
    </form>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>