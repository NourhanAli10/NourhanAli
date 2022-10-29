<?php

use App\authentication\validation;
use App\database\models\user;
use App\mail\verificationCode;

$title = "login";
include "structure/header.php";
include "App/authentication/middlewares/guest.php";
include "structure/nav.php";
include "structure/breadcrumb.php";

$validate = new validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validate->setInput($_POST['email'] ?? "")->setInputName('email')->require()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', 'wrong email or password')->exist('users', 'email');
    $validate->setInput($_POST['password'] ?? " ")->setInputName('password')->require()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 'wrong email or password');
    if (empty($validate->getErrors())) {
        $user = new user;
        $user->setEmail($_POST['email'])->setPassword($_POST['password']);
        $result = $user->login();
        if ($result !== false) {
            if ($result->num_rows == 1) {
                $user = $result->fetch_object();
                if (password_verify($_POST['password'], $user->password)) {
                    if (is_null($user->email_verified_at)) {
                        $verificationCode = rand(100000, 999999);
                        $body = "<p> hello {$_POST['first_name']}</p>
                <p> your verification code is <b style ='color:red;'> {$verificationCode}</b></p>";
                        $verifactionCode = new verificationCode($_POST['email'], "verification code", $body);
                        if ($verifactionCode->send()) {
                            $_SESSION['email'] = $_POST['email'];
                            $_SESSION['page'] = "login";
                            // unset($_SESSION);
                            header('location:verification_code.php');
                            die;
                        } else {
                            if (isset($_POST['remember_me'])) {
                                setcookie('remember_me', $_POST['email'],  time() + 86400, '/');
                            }
                        }
                    } elseif (!is_null($user->email_verified_at)) {
                        // $_SESSION['email'] = $_POST['email'];
                        // $_SESSION['password'] = $_POST['password'];
                        // $_SESSION['page'] = "login";
                        $_SESSION['user'] = $user;
                        header('location:index.php');
                        die;
                    }
                }
            } else {
                $errorlog = "<p class='alert alert-primary' role='alert' > wrong email or password </p>";
            }
        } else {
            $errorlog = "<p class='alert alert-primary' role='alert' > wrong email or password </p>";
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
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4 class="text-primary"> <?= $title ?> </h4>
                        </a>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="#" method="post">
                                        <input type="text" name="email" placeholder=" Email">
                                        <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('email') . "</p>" ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('password') . "</p>" ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me ">
                                                <label>Remember me</label>
                                                <a href="forgetPassword.php" name="forget">Forgot Password?</a>
                                            </div>
                                            <button type="submit" class=" mt-5 btn btn-lg btn-block bg-primary"><span>Login</span></button>
                                        </div>
                                        <?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('phone') . "</p>" ?>
                                        <?= $error ?? "" ?>
                                        <?= $errorlog ?? "" ?>

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