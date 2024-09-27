<?php require_once 'config/connection.php'; 

session_start();

if(!empty($_SESSION['isLogin'])){
        
    echo "<script>location.href='account.php';</script>";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
                                        
if(isset($_POST['login'])){

    $res = mysqli_query($conn, "SELECT s.student_name, l.user_password, s.student_email_address FROM student s, login_master l
        WHERE l.user_name = s.student_register_number AND l.user_type = 'Student' AND l.user_name = '$_POST[roll]'");

    if(mysqli_num_rows($res)>0){

        $row = mysqli_fetch_assoc($res);

        $title = "Cafe Connect";
        $name = $row['student_name'];
        $password = $row['user_password'];
        $email = $row['student_email_address'];

        require './vendor-email/autoload.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);

        $mail->Username = 'haitulunadu@gmail.com';
        $mail->Password = 'oynqcivlwgswtyrn';

        $mail->setFrom('haitulunadu@gmail.com', $title);
        $mail->addReplyTo('haitulunadu@gmail.com', $title);

        $mail->addAddress($email, $name);

        $mail->Subject = 'Password Reset Email - '.$title;
        $mail->Body = 'Dear '.$name.'<br> You recently requested reset your password<br> Password : '.$password.'<br><br> Thank you<br>Team '.$title;

        if ($mail->send()) {

            echo "<script type='text/javascript'>alert('Password has been sent to your registered email address!')</script>";
        } else {

            echo "<script type='text/javascript'>alert('Unable to process!')</script>";
        } 
        
    } else{
    
        echo "<script type='text/javascript'>alert('Registration number not found!')</script>";
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect - Forgot Password</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/logo.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main-color04.css">
</head>
<body class="biolife-body">
    
    <?php require_once 'include/header.php';?>

    <div class="hero-section hero-background">
        <h1 class="page-title">Forgot Password</h1>
    </div>
    
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Authentication</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form name="frm-login" method="post">
                                <p class="form-row">
                                    <label for="fid-name">Register Number:<span class="requite">*</span></label>
                                    <input type="text" id="fid-name" name="roll" value="" class="txt-input" required pattern="[a-zA-z0-9]{10}" title="Register number must be 10 character long">
                                </p>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit" name="login">Reset</button>
                                    <a href="login.php" class="link-to-help">Remember your password</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sm-margin-top-64px xs-margin-top-45px">
    </div>
    
    <?php require_once 'include/footer.php';?>