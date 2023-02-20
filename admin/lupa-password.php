<?php
require_once('../includes/init.php');
if (isset($_REQUEST['pwdrst'])) {
    $email = $_POST['email'];
    $check_email = mysqli_query($koneksi, "SELECT email FROM user WHERE email='$email'");
    $res = mysqli_num_rows($check_email);
    if ($res > 0) {
        $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost/user-login/passwordreset.php?secret=' . base64_encode($email) . '">Reset Password</a></button></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';

        require_once("../assets/PHPMailer/class.phpmailer.php");
        require_once("../assets/PHPMailer/class.smtp.php");

        $email = $email;
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = "ygalf23@gmail.com";   //Enter your username/emailid
        $mail->Password = "23April.";   //Enter your password
        $mail->FromName = "PT. Cipta Adhi Potensia";
        $mail->AddAddress($email);
        $mail->Subject = "Reset Password";
        $mail->isHTML(TRUE);
        $mail->Body = $message;
        $mail->send();
        if ($mail->send()) {
            $msg = "We have e-mailed your password reset link!";
        }
    } else {
        $msg = "We can't find a user with that email address";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Sistem Informasi Kepegawaian PT. Cipta Adhi Potensia</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <style>
        .container {
            width: 500px;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-lg pb-3 pt-3 font-weight-bold">
        <div class="container">
            <a class="navbar-brand text-primary" style="font-weight: 900;" href="login.php"> <i class="fa fa-database mr-2 rotate-n-15"></i> Sistem Informasi Kepeawaian PT. Cipta Adhi Potensia</a>
        </div>
    </nav>

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Lupa password</h1>
                            </div>
                            <form class="user" action="" method="post">
                                <?php if (!empty($msg)) : ?>
                                    <div class="alert alert-danger text-center"><?php echo $msg; ?></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <input required autocomplete="off" type="email" class="form-control form-control-user" id="email" placeholder="Masukkan email" name="email" />
                                </div>
                                <button name="pwdrst" type="submit" class="btn btn-primary btn-user btn-block" value="Send Password Reset Link"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Kirim Link Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>

</html>