<?php require_once 'config/connection.php'; 

session_start();

if(empty($_SESSION['isLogin'])){
        
    echo "<script>alert('Kindly login to proceed');location.href='login.php?source=account';</script>";
}

$student_id = $_SESSION['student_id'];

$res = mysqli_query($conn, "SELECT barcode_number, booking_date, booking_id FROM booking WHERE student_id = '$student_id' ORDER BY booking_id DESC");
 
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect - Account</title>
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
        <h1 class="page-title">Account</h1>
    </div>
    
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Account</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">
        <div id="main-content" class="main-content">
            <div class="container">
                <?php 
                if(mysqli_num_rows($res)>0){
                    while($row = mysqli_fetch_assoc($res)){
                    ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12"><h4>ORDER NO: <?php echo $row['barcode_number'];?></h4><p>Date: <?php echo date_format(date_create($row['booking_date']), 'd, M Y');?></p></div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 text-right">
                            <a class="btn btn-submit btn-bold" href="order.php?pref=<?php echo $row['booking_id'];?>">View</a>
                        </div>
                    </div>
                    <hr>
                <?php }} else{echo "<h3>No order found!</h3>";}?>
            </div>
        </div>
    </div>

    <div class="sm-margin-top-64px xs-margin-top-45px">
    </div>
    
    <?php require_once 'include/footer.php';?>