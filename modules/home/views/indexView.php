<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    // Khu vực đổ dữ liệu slider
                    foreach ($list_slider as $item) {
                    ?>
                        <div class="item">
                            <a href="<?php echo $item['link']; ?>" target="_blank">
                                <img src="<?php echo "admin/" . $item['image']; ?>" alt="">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        // Xuất dữ liệu sản phẩm bán chạy
                        foreach ($product_selling as $v) {
                        ?>
                            <li>
                                <a href="<?php echo friendly_url("chi-tiet-san-pham", $v['cat_name'], $v['product_id']); ?>" title="" class="thumb">
                                    <img src="<?php echo render_url($v['product_thumb']); ?>" class="img-fluid">
                                </a>
                                <a href="<?php echo friendly_url("chi-tiet-san-pham", $v['cat_name'], $v['product_id']); ?>" title="" class="product-name"><?php echo $v['product_name']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($v['product_price']); ?></span>
                                    <span class="old"><?php echo currency_format($v['discount']); ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left" data-id="<?php echo $v['product_id']; ?>">Thêm giỏ hàng</a>
                                    <a href="?mod=cart&controller=index&action=buyNow&id=<?php echo $v['product_id']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
            // Hiển thị sản phẩm theo danh mục
            foreach ($filter_product as $key => $sub) {
            ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title"><?php echo $key; ?></h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            $count = 1;
                            foreach ($sub as $item) {
                                if ($count <= 8) {
                            ?>
                                    <li>
                                        <a href="<?php echo friendly_url("chi-tiet-san-pham", $item['cat_name'], $item['product_id']); ?>" title="" class="thumb">
                                            <img src="<?php echo render_url($item['product_thumb']); ?>">
                                        </a>
                                        <a href="<?php echo friendly_url("chi-tiet-san-pham", $item['cat_name'], $item['product_id']); ?>" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                            <span class="old"><?php echo currency_format($item['discount']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="" title="Thêm giỏ hàng" class="add-cart fl-left" data-id="<?php echo $item['product_id']; ?>">Thêm giỏ hàng</a>
                                            <a href="?mod=cart&controller=index&action=buyNow&id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php
                                }
                                $count++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        get_sidebar();
        ?>
    </div>
</div>
<?php
get_footer();
?>