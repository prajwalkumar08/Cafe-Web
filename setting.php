<?php require_once 'config/connection.php'; 

session_start();

if(empty($_SESSION['isLogin'])){
        
    echo "<script>alert('Kindly login to proceed');location.href='login.php?source=settings';</script>";
}
                                        
if(isset($_POST['reset'])){

    $roll_number = $_SESSION['roll_number'];

    $res = mysqli_query($conn, "SELECT user_password FROM login_master WHERE user_name = '$roll_number' AND user_password = '$_POST[cpassword]'");

    if(mysqli_num_rows($res)>0){

        if(mysqli_query($conn, "UPDATE login_master SET user_password = '$_POST[npassword]' WHERE user_name = '$roll_number'")){

            echo "<script type='text/javascript'>alert('Password updated successfully')</script>";
        } else{

            echo "<script type='text/javascript'>alert('Unable to process')</script>";
        }
    } else{

        echo "<script type='text/javascript'>alert('An invalid current password')</script>";
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect - Change Password</title>
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
        <h1 class="page-title">Change Password</h1>
    </div>
    
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">change Password</span></li>
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
                                    <label for="fid-pass">Current Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="cpassword" value="" class="txt-input" required>
                                </p>
                                <p class="form-row">
                                    <label for="fid-pass">New Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="npassword" value="" class="txt-input" required minlength="6" title="Must contain at least 6 or more characters">
                                </p>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit" name="reset">Update</button>
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