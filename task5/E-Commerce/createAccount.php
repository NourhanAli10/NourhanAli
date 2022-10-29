<?php

use  App\authentication\validation;
use App\database\models\user;
use App\mail\verificationCode;

$title = "Create Account";
include "structure/header.php";
include "App/authentication/middlewares/guest.php";
include "structure/nav.php";
include "structure/breadcrumb.php";

$validate = new validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validate->setInput($_POST['first_name'] ?? "")->setInputName('first_name')->require()->string()->between(2, 32);
    $validate->setInput($_POST['last_name'] ?? "")->setInputName('last_name')->require()->string()->between(2, 32);
    $validate->setInput($_POST['email'] ?? "")->setInputName('email')->require()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->unique('users', 'email');
    $validate->setInput($_POST['phone'] ?? "")->setInputName('phone')->require()->regex('/^01[0125][0-9]{8}$/')->unique('users', 'phone');
    $validate->setInput($_POST['password'] ?? "")->setInputName('password')->require()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character")->confirm($_POST['confirm_password']);
    $validate->setInput($_POST['confirm_password'] ?? "")->setInputName('confirm_password')->require();
    $validate->setInput($_POST['gender'] ?? "")->setInputName('gender')->require()->in(['m', 'f']);


    if (empty($validate->getErrors())) {
        $verificationCode = rand(100000, 999999);
        $user = new user;
        $user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])->setEmail($_POST['email'])->setPhone($_POST['phone'])->setPassword($_POST['password'])->setGender($_POST['gender'])->setVerification_code($verificationCode);
        if ($user->createNewAccount()) {
            $body = "<p> hello {$_POST['first_name']}</p>
            <p> your verification code is <b style ='color:red;'> {$verificationCode}</b></p>";
            $verifactionCode = new verificationCode($_POST['email'], "verification code", $body);
            if ($verifactionCode->send()) {
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['page'] = "createAccount";
                header('location:verification_code.php');
            } else {
                $error = "<p class='alert alert-primary' role='alert' >  please try again later </p>";
            }
        }
    } else {
        $error = "<p class='alert alert-primary' role='alert' > something went wrong please try again later </p>";
    }
}



?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a data-toggle="tab" href="#lg2">
                            <h4 class="text-primary"> <?= $title ?> </h4>
                        </a>
                    </div>

                    <div id="lg2" class="tab-pane active">
                        <div class="login-form-container">
                            <div class="login-register-form">
                                <?= $error ?? "" ?>
                                <form action="#" method="post">
                                    <input type="text" name="first_name" placeholder="First Name" value="<?= $_POST['first_name'] ?? "" ?>">
                                    <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('first_name') . "</p>" ?>
                                    <input type="text" name="last_name" placeholder="Last Name" value="<?= $_POST['last_name'] ?? "" ?>">
                                    <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('last_name') . "</p>" ?>
                                    <input type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? "" ?>">
                                    <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('email') . "</p>" ?>
                                    <input type="tel" name="phone" placeholder="Phone" value="<?= $_POST['phone'] ?? "" ?>">
                                    <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('phone') . "</p>" ?>
                                    <input type="password" name="password" placeholder="Password">
                                    <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('password') . "</p>" ?>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                                    <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('confirm_password') . "</p>" ?>
                                    <select name="gender" class="form-control">
                                        <option></option>
                                        <option value="m" <?= isset($_POST['gender'])  && $_POST['gender'] == "m" ? "selected" : "" ?>>Male</option>
                                        <option value="f" <?= isset($_POST['gender'])  && $_POST['gender'] == "f" ? "selected" : "" ?>>Female</option>
                                    </select>
                                    <?= "<p class ='text-primary font-weight-bold mt-4'>" . $validate->getError('gender') . "</p>" ?>
                                    <div class="button-box mt-5">
                                        <button type="submit" class="btn-lg btn-block bg-primary"><span>Register</span></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include "structure/footer.php";
include "structure/scripts.php";
?>