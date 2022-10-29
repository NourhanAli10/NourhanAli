<?php
$title = "My Account";
include "structure/header.php";
include "App/authentication/middlewares/auth.php";


use App\Services\Media;
use  App\database\models\user;
use  App\authentication\validation;

$validate = new validation;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['update_profile'])) {
		$validate->setInput($_POST['first_name'] ?? "")->setInputName('first_name')->require()->string()->between(2, 32);
		$validate->setInput($_POST['last_name'] ?? "")->setInputName('last_name')->require()->string()->between(2, 32);
		$validate->setInput($_POST['gender'] ?? "")->setInputName('gender')->require()->in(['m', 'f']);
		if (empty($validate->getErrors())) {
			$user = new user;
			$user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])->setGender($_POST['gender'])->setEmail($_SESSION['user']->email);
			if ($user->updateProfile()) {
				$_SESSION['user']->first_name = $_POST['first_name'];
				$_SESSION['user']->last_name = $_POST['last_name'];
				$_SESSION['user']->gender = $_POST['gender'];
				$message = "<p class='alert alert-primary' role='alert' > your profile has been updated successfully  </p>";
			} else {
				$error = "<p class='alert alert-primary' role='alert' > something went wrong please try again later </p>";
			}
		} else {
			$error = "<p class='alert alert-primary' role='alert' > something went wrong please try again later </p>";
		}
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['update_password'])) {
		$validate->setInput($_POST['oldPassword'] ?? "")->setInputName('oldPassword')->require()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character");
		$validate->setInput($_POST['newPassword'] ?? "")->setInputName('newPassword')->require()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character")->confirm($_POST['confirmPassword']);
		$validate->setInput($_POST['confirmPassword'] ?? "")->setInputName('confirmPassword')->require();
		if (empty($validate->getErrors())) {
			$user = new user;
			if (password_verify($_POST['oldPassword'], $_SESSION['user']->password)) {
				$user->setPassword($_POST['newPassword'])->setEmail($_SESSION['user']->email);
				if ($user->updatePassword()) {
					$newPasswordInSession = $user->getUserPassword()->fetch_object();
					$_SESSION['user']->password = $newPasswordInSession->password;
					$messagePassword = "<p class='alert alert-primary' role='alert' > your password has been updated successfully  </p>";
				} else {
					$error = "<p class='alert alert-primary' role='alert' > your password has not updated   </p>";
				}
			} else {
				$error = "<p class='alert alert-primary' role='alert' > wrong password  </p>";
			}
		} else {
			$error = "<p class='alert alert-primary' role='alert' > something went wrong please try again later </p>";
		}
	}


	if ($_FILES['image']['error'] == 0) {
		// validation
		$validation->setFile($_FILES['image'])->setInputName('image')->size(3 * 10 ** 6)->extensions(['png', 'jpg', 'jpeg']);
		if (empty($validation->getErrors())) {
			// upload image
			$media = new Media;
			if ($media->setFile($_FILES['image'])->upload('assets/img/users/')) {
				// elmost5dm lw byrf3 sora msh l awl mara => ams7 eladema
				if ($_SESSION['user']->image != 'default.jpg') {
					$media->delete('assets/img/users/' . $_SESSION['user']->image);
				}
				$user = new User;
				$user->setImage($media->getNewMediaName())->setEmail($_SESSION['user']->email);
				if ($user->updateImage()) {
					$_SESSION['user']->image = $media->getNewMediaName();
					$success = "<div class='alert alert-success text-center'> Profile Picture Uploaded Successfully </div>";
				} else {

					$error = "<div class='alert alert-danger text-center'> Something went wrong </div>";
				}
			} else {

				$error = "<div class='alert alert-danger text-center'> Something went wrong </div>";
			}
		}
	}
}


include "structure/nav.php";
include "structure/breadcrumb.php";
?>



<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	body {
		height: 100vh;
		width: 100%;
	}

	.profile-pic {
		height: 133px;
		width: 200px;
		position: relative;
		top: 96%;
		left: 50%;
		transform: translate(-50%, -24%);
		border-radius: 50%;
		overflow: hidden;
		border: 1px solid grey;
	}

	#photo {
		height: 100%;
		width: 100%;
	}

	#file {
		display: none;
	}

	#uploadBtn {
		height: 40px;
		width: 100%;
		position: absolute;
		bottom: 0;
		left: 50%;
		transform: translateX(-50%);
		text-align: center;
		background: rgba(0, 0, 0, 0.7);
		color: wheat;
		line-height: 30px;
		font-family: sans-serif;
		font-size: 15px;
		cursor: pointer;
		display: none;
	}
</style>



<div class="checkout-area pb-80 pt-100 mt-5">

	<div class="container ">
		<div class=" ">

			<div class="ml-auto mr-auto col-lg-9">
				<div id="faq" class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="panel-title "><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
						</div>
						<div id="my-account-1" class="panel-collapse collapse show">
							<div class="panel-body">

								<form method="post" class="form-control" enctype="multipart/form-data">
									<div class="col-12">
										<div class="row">
											<div class="col-4 offset-4 text-center my-3">
												<?php
												if ($_SESSION['user']->image == 'default.jpg') {
													if ($_SESSION['user']->gender == 1) {
														$image = 'male.png';
													} else {
														$image = 'female.png';
													}
												} else {
													$image = $_SESSION['user']->image;
												}
												?>
												<label for="file"><img src="assets/img/users/<?= $image ?>" id="image" class="w-100 rounded-circle" style="cursor: pointer;" alt=""></label>
												<input type="file" name="image" id="file" class="d-none" onchange="loadFile(event)">
												<?= $validate->getError('image') ?>
												<button class="btn btn-success rounded my-3" style="cursor: pointer"> <i class="fa fa-camera" aria-hidden="true"></i> Upload </button>
											</div>
										</div>
									</div>


									<?= $error ?? "" ?>
									<?= $message  ?? "" ?>
									<div class="billing-information-wrapper">
										<div class="account-info-wrapper">
											<h4>My Account Information</h4>
											<h5>Your Personal Details</h5>
										</div>
										<div class="row">
											<div class="col-lg-6 col-md-6">
												<div class="billing-info">
													<label>First Name</label>
													<input type="text" name="first_name" value="<?= $_SESSION['user']->first_name ?>">
													<?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('first_name') . "</p>" ?>

												</div>
											</div>
											<div class="col-lg-6 col-md-6">
												<div class="billing-info">
													<label>Last Name</label>
													<input type="text" name="last_name" value="<?= $_SESSION['user']->last_name ?>">
													<?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('last_name') . "</p>" ?>

												</div>
											</div>

											<div class="col-lg-12 col-md-12 mt-4">
												<div class="billing-info">
													<select name="gender" class="form-control">
														<option></option>
														<option value="m" <?= $_SESSION['user']->gender == "m" ? "selected" : "" ?>>Male</option>
														<option value="f" <?= $_SESSION['user']->gender == "f" ? "selected" : "" ?>>Female</option>

													</select>
													<?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('gender') . "</p>" ?>

												</div>
											</div>
											<div class="billing-back-btn w-100">
												<div class="billing-back ml-4">
													<a href="#"><i class="ion-arrow-up-c"></i> back</a>
												</div>
												<div class="billing-btn mr-4">
													<button type="submit" name="update_profile">update profile</button>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>

				</form>

			</div>



			<div class=" ">

				<div class="ml-auto mr-auto col-lg-9">
					<div id="faq" class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
							</div>
							<div id="my-account-1" class="panel-collapse collapse show">
								<div class="panel-body">
									<form method="post" class="form-control ">
										<div class="billing-information-wrapper">
											<?= $error ?? "" ?>
											<?= $messagePassword  ?? "" ?>
											<div class="account-info-wrapper">
												<h4>Change Password</h4>
												<h5>Your Password</h5>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<div class="billing-info ">
														<label for="oldPassword">old password</label>
														<input type="password" name="oldPassword" id="oldPassword" class="border border-dark">
														<?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('oldPassword') . "</p>" ?>

													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<div class="billing-info ">
														<label for="newPassword"> NEW Password</label>
														<input type="password" name="newPassword" id="newPassword" class="border border-dark">
														<?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('newPassword') . "</p>" ?>

													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<div class="billing-info ">
														<label for="confirmPassword">Password Confirm</label>
														<input type="password" name="confirmPassword" id="confirmPassword" class="border border-dark">
														<?= "<p class ='text-primary font-weight-bold'>" . $validate->getError('confirmPassword') . "</p>" ?>

													</div>
												</div>
											</div>
											<div class="billing-back-btn">
												<div class="billing-back">
													<a href="#"><i class="ion-arrow-up-c"></i> back</a>
												</div>
												<div class="billing-btn">
													<button type="submit" name="update_password">Continue</button>
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
						</form>

					</div>


				</div>
			</div>

			<!-- my account end -->
			<script>
				var loadFile = function(event) {
					var reader = new FileReader();
					reader.onload = function() {
						var output = document.getElementById('image');
						output.src = reader.result;
					};
					reader.readAsDataURL(event.target.files[0]);
				};
			</script>
			<?php

			include "structure/footer.php";
			include "structure/scripts.php";
			?>