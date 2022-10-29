<?php

use App\authentication\validation;
use App\database\models\user;
use App\mail\verificationCode;

$title = "forget password";
include "structure/header.php";

$validate = new validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validate->setInput($_POST['email'] ?? "")->setInputName('email')->require()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->exist('users', 'email');
    if (empty($validate->getErrors())) {
        $forgetPassCode = rand(100000, 999999);
        $user = new user;
        $user->setVerification_code($forgetPassCode)->setEmail($_POST['email']);
        if ($user->updateVerificationCode()) {
            $body = "<p> hello {$_POST['email']}</p>
            <p> you forget ypur password your new verification code is <b style ='color:red;'> {$forgetPassCode}</b></p>";
            $verifactionCode = new verificationCode($_POST['email'], "verification code", $body);
            if ($verifactionCode->send()) {
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['page'] = "forgetPassword";
                header('location:verification_code.php');
                die;
            } else {
                $error = "<p class='alert alert-primary role='alert'> Please Try Again Later </p>";
            }
        } else {
            $error = "<p class='alert alert-primary' role='alert' > something went wrong please try again later </p>";
        }
    }
}




?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <h2 class="text-success"> forget Password </h2>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= $error ?? "" ?>
                                    <form action="#" method="post">
                                        <input type="email" name="email" placeholder="Enter your email address">
                                        <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('email') . "</p>" ?>
                                        <div class="button-box">
                                            <button type="submit" class=" mt-5 btn btn-lg btn-block bg-success"><span>send</span></button>
                                        </div>


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
include "structure/scripts.php";
