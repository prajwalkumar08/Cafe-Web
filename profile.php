<?php require_once 'config/connection.php'; 

session_start();

if(empty($_SESSION['isLogin'])){
        
    echo "<script>alert('Kindly login to proceed');location.href='login.php?source=profile';</script>";
}
                                        
$student_id = $_SESSION['student_id'];

$res = mysqli_query($conn, "SELECT * FROM student WHERE student_id = '$student_id'");

if(mysqli_num_rows($res)>0){

    $res = mysqli_fetch_assoc($res);
} else{

    echo "<script>alert('Kindly login to proceed');location.href='login.php?source=profile';</script>";
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect - Profile</title>
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
        <h1 class="page-title">Profile</h1>
    </div>
    
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Profile</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">
        <div id="main-content" class="main-content">
            <div class="container xs-margin-top-45px">
    

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="admin/assets/img/student/<?php echo $res['student_image'];?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $res['student_name'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Register Number</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $res['student_register_number'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $res['student_email_address'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $res['student_phone_number'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $res['student_address'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Available Credit</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo number_format($res['balance'], 2);?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
            </div>
        </div>
    </div>

    <div class="sm-margin-top-64px xs-margin-top-45px">
    </div>
    
    <?php require_once 'include/footer.php';?>