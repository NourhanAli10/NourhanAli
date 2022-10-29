<?php
$title = "reset password";
include "structure/header.php";

use App\authentication\validation;
use App\database\models\user;


$validate = new validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validate->setInput($_POST['password'] ?? "")->setInputName('password')->require()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character")->confirm($_POST['confirm_password']);
    $validate->setInput($_POST['confirm_password'] ?? "")->setInputName('confirm_password')->require();
    if (empty($validate->getErrors())) {
        $user = new user;
        $user->setPassword($_POST['password'])->setEmail($_SESSION['email']);

        if ($user->updatePassword()) {
            unset($_SESSION['email']);
            $message = "<p class='alert alert-primary' role='alert' > your password updated successfully  , you will be redirected shortly </p>";
            header('refresh:3;url=login.php');
            die;
        } else {
            $error = "<p class='alert alert-primary role='alert'> Please Try Again Later </p>";
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
                        <h2 class="text-success"> reset Password </h2>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">

                                    <form action="#" method="post">
                                        <input type="password" name="password" placeholder="Enter your new password">
                                        <input type="password" name="confirm_password" placeholder="Enter your  password again">
                                        <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('confirm_password') . "</p>" ?? "" ?>
                                        <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('password') . "</p>" ?? "" ?>

                                        <div class="button-box">
                                            <button type="submit" class=" mt-5 btn btn-lg btn-block bg-success"><span>send</span></button>
                                        </div>
                                    </form>
                                    <?= $error ?? "" ?>
                                    <?= $message ?? "" ?>
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
