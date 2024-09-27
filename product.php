<?php require_once 'config/connection.php'; 

session_start();

$item_id = "0";

if(!empty($_GET['pref'])){

	$item_id = $_GET['pref'];
}


if(isset($_GET['add_to_cart'])) {
        
    $product_id = $_GET['id'];
    $product_name = $_GET['name'];
    $product_price = $_GET['price'];
    $product_image = $_GET['image'];

    $itemArray = array(
        $product_id => array(
            'productId' => $product_id, 
            'productName' => $product_name, 
            'productQuantity' => 1, 
            'productPrice' => $product_price,
            'productImage' => $product_image
        )
    );

    if (empty($_SESSION["cart_item"])) {
        
        $_SESSION["cart_item"] = $itemArray;

        echo "<script>alert('Product added to cart');location.href='product.php?pref=$item_id';</script>"; 
    } else {
        
        if (in_array($product_id, array_keys($_SESSION["cart_item"]))) {
            
            foreach($_SESSION["cart_item"] as $k => $v) {

                if($product_id == $k) {
                    if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
                        $_SESSION["cart_item"][$k]["productQuantity"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["productQuantity"] += 1;

                    echo "<script>alert('Product added to cart');location.href='product.php?pref=$item_id';</script>";  

                }
            }
        } else {
            
            $_SESSION["cart_item"] += $itemArray;
            
            echo "<script>alert('Product added to cart');location.href='product.php?pref=$item_id';</script>"; 

        }
    }
}

$res = mysqli_query($conn, "SELECT i.*, c.category_name FROM items i, category c WHERE i.category_id = c.category_id AND item_id = '$item_id'");

if(mysqli_num_rows($res)>0){

    $res = mysqli_fetch_assoc($res);
} else{

    echo "<script>alert('Unable to process');location.href='index.php';</script>";
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect - <?php echo $res['item_name'];?></title>
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
        <h1 class="page-title"><?php echo $res['item_name'];?></h1>
    </div>

    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page"><?php echo $res['item_name'];?></span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain single-product">
        <div class="container">
            <div id="main-content" class="main-content">
                <div class="sumary-product single-layout">
                    <div class="media">
                        <ul class="biolife-carousel slider-for" >
                            <li><img src="admin/assets/img/product/<?php echo $res['item_image'];?>" alt="" width="500" height="500"></li>
                        </ul>
                    </div>
                    <div class="product-attribute">
                        <h3 class="title"><?php echo $res['item_name'];?></h3>
                        <span class="sku"><?php echo $res['category_name'];?></span>
                        <div class="price">
                            <ins><span class="price-amount"><span class="currencySymbol">Rs. </span><?php echo number_format($res['item_price'], 2);?></ins>
                        </div>
                        
                    <div class="action-form">
                        <div class="buttons">
                            <a href="product.php?id=<?php echo $res['item_id']; ?>&name=<?php echo $res['item_name']; ?>&image=<?php echo $res['item_image']; ?>&price=<?php echo $res['item_price']; ?>&pref=<?php echo $item_id;?>&add_to_cart" class="btn add-to-cart-btn">add to cart</a>
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