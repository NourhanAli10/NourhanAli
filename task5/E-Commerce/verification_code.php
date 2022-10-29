<?php

use App\authentication\validation;
use App\database\models\user;

$title = "verifiaction code";
include "structure/header.php";
echo $_SESSION['page'];
$validate = new validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validate->setInput($_POST['verification_code'] ?? "")->setInputName('verification_code')->require()->numeric()->numbers(6);
    if (empty($validate->getErrors())) {
        $user = new user;
        $user->setEmail($_SESSION['email'])->setVerification_code($_POST['verification_code']);
        $result = $user->checkVerificationCode();
        if ($result !== false) {
            if ($result->num_rows == 1) {
                $user->setEmail_verified_at(date('Y-m-d H:i:s'));
                if ($user->verify()) {
                    if ($_SESSION['page'] == "createAccount") {
                        // unset($_SESSION['email']);
                        //   unset($_SESSION['page']);
                        $message = "<p class='alert alert-primary' role='alert' > you are verified , you will be redirected to login shortly </p>";
                        header('refresh:3;url=login.php');
                    }elseif($_SESSION['page']=='forgetPassword') {
                        $message = "<p class='alert alert-primary' role='alert' > you are verified , you will be redirected to reset password shortly </p>";
                        header('refresh:3;url=resetPassword.php');
                    }
                } 
            } else{
                $errorCode = "<p class='alert alert-primary' role='alert' > code is wrong , please try again </p>";
            }
        }else {
            $error = "<p class='alert alert-primary' role='alert' > xsomething went wrong please try again later </p>";
        } 
    }else {
        $error = "<p class='alert alert-primary' role='alert' > ysomething went wrong please try again later </p>";
    }
}

?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <h2 class="text-success"> <?= $title ?> </h2>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= $error ?? "" ?>
                                    <?= $message ?? "" ?>
                                    <form action="#" method="post">
                                        <input type="number" name="verification_code" placeholder="Enter your verification code">

                                        <div class="button-box">
                                            <button type="submit" class=" mt-5 btn btn-lg btn-block bg-success"><span>submit</span></button>
                                        </div>
                                        <?= "<p class ='text-primary font-weight-bold mt-3'>" . $validate->getError('verification_code') . "</p>" ?>
                                        <?= $errorCode ?? "" ?>
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
include "structure/scripts.php";