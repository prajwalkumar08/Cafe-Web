<?php require_once 'config/connection.php'; 

session_start();

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

        echo "<script>alert('Product added to cart');location.href='index.php';</script>"; 
    } else {
        
        if (in_array($product_id, array_keys($_SESSION["cart_item"]))) {
            
            foreach($_SESSION["cart_item"] as $k => $v) {

                if($product_id == $k) {
                    if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
                        $_SESSION["cart_item"][$k]["productQuantity"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["productQuantity"] += 1;

                    echo "<script>alert('Product added to cart');location.href='index.php';</script>";  

                }
            }
        } else {
            
            $_SESSION["cart_item"] += $itemArray;
            
            echo "<script>alert('Product added to cart');location.href='index.php';</script>"; 

        }
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafe Connect | Home</title>
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
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
</head>
<body class="biolife-body">
    
    <?php require_once 'include/header.php';?>
    
    <div class="page-contain">
        <div id="main-content" class="main-content">
            <div class="main-slide block-slider nav-change hover-main-color type02">
                <ul class="biolife-carousel" data-slick='{"arrows": true, "dots": false, "slidesMargin": 0, "slidesToShow": 1, "infinite": true, "speed": 800}' >
                    <li>
                        <div class="slide-contain slider-opt04__layout01 light-version first-slide">
                            <div class="media"></div>
                            <div class="text-content lg-padding-left-50">
                                <!-- <i class="first-line">Good Food</i>
                                <h3 class="second-line">Where every flavor tells a story.</h3> -->
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="slide-contain slider-opt04__layout01 light-version second-slide">
                            <div class="media"></div>
                            <div class="text-content lg-padding-left-50">
                                <!-- <i class="first-line">Good Food</i>
                                <h3 class="second-line">For the love of delicious food.</h3> -->
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="slide-contain slider-opt04__layout01 light-version third-slide">
                            <div class="media"></div>
                            <div class="text-content lg-padding-left-50">
                                <!-- <i class="first-line">Good Food</i>
                                <h3 class="second-line">Low cost. High quality.</h3> -->
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- <div class="banner-block sm-margin-bottom-57px xs-margin-top-50px sm-margin-top-30px">
                <div class="container-fluid">
                    <ul class="biolife-carousel nav-center-bold nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":3, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 2}},{"breakpoint":768, "settings":{ "slidesToShow": 2}}, {"breakpoint":500, "settings":{ "slidesToShow": 1}}]}'>
                        <li>
                            <div class="biolife-banner biolife-banner__style-08">
                                <div class="banner-contain">
                                    <div class="media">
                                        <a class="bn-link"><img src="assets/images/home-04/bn_style08.png" width="193" height="185" alt=""></a>
                                    </div>
                                    <div class="text-content">
                                        <span class="text1">Sumer Fruit</span>
                                        <b class="text2">100% Pure Natural Fruit Juice</b>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="biolife-banner biolife-banner__style-09">
                                <div class="banner-contain">
                                    <div class="media">
                                        <a class="bn-link"><img src="assets/images/home-04/bn_style09.png" width="191" height="185" alt=""></a>
                                    </div>
                                    <div class="text-content">
                                        <span class="text1">California</span>
                                        <b class="text2">Fresh Fruit</b>
                                        <span class="text3">Association</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="biolife-banner biolife-banner__style-10">
                                <div class="banner-contain">
                                    <div class="media">
                                        <a class="bn-link"><img src="assets/images/home-04/bn_style10.png" width="185" height="185" alt=""></a>
                                    </div>
                                    <div class="text-content">
                                        <span class="text1">Naturally fresh taste</span>
                                        <p class="text2">With <span>25% Off</span> All Teas</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->

            <div class="product-tab z-index-20 sm-margin-top-59px xs-margin-top-20px">
                <div class="container">
                    <div class="biolife-title-box style-02">
                        <h3 class="main-title">Our Products</h3>
                    </div>
                    <div class="row sm-margin-top-59px xs-margin-top-30px">
                        <ul class="products-list" style="list-style: none;">
                        <?php
                            $res5 = mysqli_query($conn, "SELECT i.item_id, i.item_name, i.item_image, i.item_price, 
                                c.category_name FROM items i, category c WHERE i.category_id = c.category_id AND i.item_status = 'Active' LIMIT 12");
                            if(mysqli_num_rows($res5)>0){
                                while($row5 = mysqli_fetch_assoc($res5)){
                                ?>
                                    <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="product.php?pref=<?php echo $row5['item_id'];?>" class="link-to-product">
                                                    <img src="admin/assets/img/product/<?php echo $row5['item_image'];?>" alt="dd" width="270" height="270" class="product-thumnail" style="height:270px">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><?php echo $row5['category_name'];?></b>
                                                <h4 class="product-title"><a href="product.php?pref=<?php echo $row5['item_id'];?>" class="pr-name"><?php echo $row5['item_name'];?></a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">Rs. </span><?php echo number_format($row5['item_price'], 2);?></span></ins>
                                                </div>
                                                <div class="slide-down-box">
                                                    <div class="buttons">
                                                        <a href="index.php?id=<?php echo $row5['item_id']; ?>&name=<?php echo $row5['item_name']; ?>&image=<?php echo $row5['item_image']; ?>&price=<?php echo $row5['item_price']; ?>&add_to_cart" class="btn add-to-cart-btn" name="add_to_cart"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php 
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- <div class="banner-promotion-04 xs-margin-top-50px sm-margin-top-59px">
                <div class="biolife-banner promotion4 biolife-banner__promotion4 v2">
                    <div class="container">
                        <div class="banner-contain">
                            <div class="media">
                                <div class="img-moving position-1">
                                    <a class="banner-link"><img src="assets/images/home-04/bn_promotion-child01-2.png" width="780" height="450" alt="img msv"></a>
                                </div>
                                <div class="img-moving position-2">
                                    <img src="assets/images/home-04/bn_promotion-child02-2.png" width="149" height="139" alt="img msv">
                                </div>
                            </div>
                            <div class="text-content">
                                <span class="sub-line">Special Offer!</span>
                                <b class="first-line">Special discount<br>for all fruit products</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            
            <div class="wrap-category sm-margin-top-50px">
                <div class="container">
                    <div class="biolife-title-box style-02 sm-margin-bottom-57px xs-margin-bottom-33px">
                        <h3 class="main-title">Featured Categories</h3>
                    </div>
                    
                    <ul class="biolife-carousel nav-center-bold nav-none-on-mobile" data-slick='{"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}, {"breakpoint":500, "settings":{ "slidesToShow": 1}}]}'>
                    <?php
                        $res4 = mysqli_query($conn, "SELECT category_name, category_id, category_image FROM category WHERE category_status = 'Active'");
                        if(mysqli_num_rows($res4)>0){

                            while($row4 = mysqli_fetch_assoc($res4)){
                                ?>
                                    <li>
                                        <div class="biolife-cat-box-item">
                                            <div class="cat-thumb">
                                                <a href="category.php?pref=<?php echo $row4['category_id'];?>" class="cat-link">
                                                    <img src="admin/assets/img/category/<?php echo $row4['category_image'];?>" width="277" height="185" alt="">
                                                </a>
                                            </div>
                                            <a class="cat-info" href="category.php?pref=<?php echo $row4['category_id'];?>">
                                                <h4 class="cat-name"><?php echo $row4['category_name'];?></h4>
                                                <span class="cat-number">Fresh</span>
                                            </a>
                                        </div>
                                    </li>
                                <?php
                            }
                        }
                    ?>
                    </ul>
                    <div class="biolife-service type01 biolife-service__type01 sm-margin-top-45px">
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    
    <?php require_once 'include/footer.php';?>