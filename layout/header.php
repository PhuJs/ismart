<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="?" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="danh-muc-san-pham/dien-thoai-1.html" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="danh-sach/tong-hop-bai-viet" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="thong-tin/ve-chung-toi" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="thong-tin/chi-tiet-lien-he" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="index.php">
                                <input type="text" name="search" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="gio-hang/chi-tiet-gio-hang" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num"><?php echo (get_num_product_cart() > 0) ? get_num_product_cart() : "" ?></span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num"><?php echo (get_num_product_cart() > 0) ? get_num_product_cart() : ""; ?></span>
                                </div>
                                <div id="dropdown" class="overflow-auto">
                                    <?php
                                    // Kiểm tra và lấy sản phẩm trong giỏ hàng
                                    $collection_pd = get_product_cart();
                                    if (!empty($collection_pd)) {
                                    ?>
                                        <p class="desc"><?php echo "Có <span>".get_num_product_cart()." sản phẩm</span> trong giỏ hàng"?></p>
                                        <ul class="list-cart">
                                            <?php
                                            foreach ($collection_pd as $item) {
                                            ?>
                                                <li class="clearfix">
                                                    <a href="javascript:void(0)" title="" class="thumb fl-left">
                                                        <img src="<?php echo "admin/" . $item['thumb']; ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="javascript:void(0)" title="" class="product-name"><?php echo $item['title'] ?></a>
                                                        <p class="price"><?php echo currency_format($item['price']); ?></p>
                                                        <p class="qty">Số lượng: <span><?php echo $item['qty']; ?></span></p>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right"><?php echo currency_format(get_total_cart()); ?></p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="gio-hang/chi-tiet-gio-hang" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="thanh-toan-don-hang/thanh-toan-san-pham-gio-hang" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <p class='desc'> Không có sản phẩm </p>
                                        <div class="action-cart clearfix">
                                            <a href="gio-hang/chi-tiet-gio-hang" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="thanh-toan-don-hang/thanh-toan-san-pham-gio-hang" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </div>    
                                    <?php     
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>