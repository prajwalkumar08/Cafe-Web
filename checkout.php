<?php require_once 'config/connection.php'; 

session_start();

if(empty($_SESSION['isLogin'])){
        
    echo "<script>alert('Kindly login to proceed');location.href='login.php?source=checkout';</script>";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_GET['delete'])){

    $prodId = $_GET['delete'];
    unset($_SESSION['cart_item'][$prodId]);
    
    echo "<script>alert('Product removed successfully');location.href='checkout.php';</script>";
}

if(isset($_GET['add'])) {

    foreach ($_SESSION["cart_item"] as $k => $v) {

        if($_GET['add'] == $k) {

            if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {

                $_SESSION["cart_item"][$k]["productQuantity"] = 1;
            }
            
            $_SESSION["cart_item"][$k]["productQuantity"] += 1;
            
            echo "<script>alert('Product updated successfully');location.href='checkout.php';</script>";
        }
    }
}

if(isset($_GET['remove'])){

    foreach ($_SESSION["cart_item"] as $k => $v) {

        if($_GET['remove'] == $k) {

            if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {

                $_SESSION["cart_item"][$k]["productQuantity"] = 0;
            }
            else if ($_SESSION["cart_item"][$k]["productQuantity"] > 1) {
              $_SESSION["cart_item"][$k]["productQuantity"] -= 1;
            }

            echo "<script>alert('Product updated successfully');location.href='checkout.php';</script>";
        }
    }
}

if(isset($_POST['place'])){

    $serve = $_POST['serve'];
    $token = rand(111111111111, 999999999999);
    $student_id = $_SESSION['student_id'];

    $resstud = mysqli_query($conn, "SELECT * FROM student WHERE student_id = '$student_id'");
    if(mysqli_num_rows($resstud)>0){

        $resstud = mysqli_fetch_assoc($resstud);
    }   
    
    $insertData = "INSERT INTO temp (token_number, item_id, quantity) VALUES";
    $i = 0;

    foreach($_SESSION['cart_item'] as $item){

        if($i > 0){
            $insertData .= ", ";
        }

        $insertData .= "('$token', '$item[productId]', '$item[productQuantity]')";

        $i++;
    }
        
    if(mysqli_query($conn, $insertData)){

        if(mysqli_query($conn, "INSERT INTO booking (student_id, barcode_number, serving_time, booking_status, booking_date) 
            VALUES ('$student_id', '$token', '$serve', 'Order Placed', NOW())")){

            unset($_SESSION['cart_item']);
            

            $title = "Cafe Connect";
            $name = $resstud['student_name'];
            $email = $resstud['student_email_address'];

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

            $mail->Subject = 'Order Placed successfully - '.$title;
            $mail->Body = 'Dear '.$name.'<br> Your order placed successfully<br>Your Token Nuber is: '.$token.'<br><br> Thank you<br>Team '.$title;

            if ($mail->send()) {

                echo "<script>alert('Your order placed successfully');location.href='account.php';</script>";
            } else {

                echo "<script>alert('Your order placed successfully');location.href='account.php';</script>";
            }
            
            

        } else{

            echo "<script>alert('Unable to process');</script>";
        }

    } else{
        
        echo "<script>alert('Unable to process');</script>";
    }
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect - Checkout</title>
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
        <h1 class="page-title">Checkout</h1>
    </div>

    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">ShoppingCart</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain shopping-cart">
        <div id="main-content" class="main-content">
            <div class="container">
            <?php
            if(!empty($_SESSION['cart_item'])){ ?>
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Your cart items</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total = 0;
                                    foreach ($_SESSION['cart_item'] as $item) {
                                        
                                        $total += ($item['productPrice'] * $item['productQuantity']);
                                        $amount = ($item['productPrice'] * $item['productQuantity']);
                                        ?>
                                    <tr class="cart_item">
                                        <td class="product-thumbnail" data-title="Product Name">
                                            <a class="prd-thumb" href="product.php?pref=<?php echo $item['productId'];?>">
                                                <figure><img width="113" height="113" src="admin/assets/img/product/<?php echo $item['productImage'];?>" alt="shipping cart"></figure>
                                            </a>
                                            <a class="prd-name" href="product.php?pref=<?php echo $item['productId'];?>"><?php echo $item['productName'];?></a>
                                            <div class="action">
                                                <a href="checkout.php?delete=<?php echo $item['productId'];?>" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">Rs. </span><?php echo number_format($item['productPrice'], 2);?></span></ins>
                                            </div>
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-box type1">
                                                <div class="qty-input">
                                                    <input type="text" name="qty12554" value="<?php echo $item['productQuantity'];?>" data-max_value="20" data-min_value="1" data-step="1">
                                                    <a href="checkout.php?add=<?php echo $item['productId'];?>" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                    <a href="checkout.php?remove=<?php echo $item['productId'];?>" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">Rs. </span><?php echo number_format($amount, 2);?></span></ins>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <form method="post">
                                <div class="shpcart-subtotal-block">
                                    <div class="subtotal-line">
                                        <b class="stt-name">Total</b>
                                        <span class="stt-price">Rs. <?php echo number_format($total, 2);?></span>
                                    </div>
                                    <div class="tax-fee">
                                        <p class="form-row">
                                            <label>Serving Time</label>
                                            <input type="time" class="form-control" name="serve" required min="10:00" max="17:59"/>
                                        </p>
                                    </div>
                                    <div class="btn-checkout">
                                        <button name="place" class="btn btn-submit">Place order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } else{ echo "<h5>Your shopping cart empty.</h5>";} ?>
            </div>
        </div>
    </div>
    
    <div class="sm-margin-top-64px xs-margin-top-45px">
    </div>

    <?php require_once 'include/footer.php';?>