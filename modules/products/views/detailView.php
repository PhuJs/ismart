<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo get_name_cat($list_cat, $product_item['cat_id']); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left" style="position:relative">
                        <a href="chi-tiet-san-pham/<?php echo create_slug($product_item['cat_name']) ?>-<?php echo $product_item['product_id']; ?>.html" title="" id="main-thumb">
                            <img id="zoom" class="img-thumbnail" src="<?php echo "admin/" . $product_item['product_thumb']; ?>" data-zoom-image="<?php echo "admin/" . $product_item['product_thumb']; ?>" />
                        </a>
                        <div id="list-thumb" class="mt-4">
                            <?php
                            foreach ($list_image as $item) {
                                if (file_exists("admin/" . $item['img_link'])) {
                            ?>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($product_item['cat_name']) ?>-<?php echo $product_item['product_id']; ?>.html" data-image="<?php echo "admin/" . $item['img_link']; ?>" data-zoom-image="<?php echo "admin/" . $item['img_link']; ?>">
                                        <img id="zoom" src="<?php echo "admin/" . $item['img_link']; ?>" />
                                    </a>
                            <?php
                                }
                            }
                            ?>
                            <!-- <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a> -->
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="<?php echo "admin/" . $product_item['product_thumb']; ?>" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product_item['product_name']; ?></h3>
                        <div class="desc">
                            <?php
                            echo $product_item['product_description'];
                            ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <p class="price"><?php echo currency_format($product_item['product_price']); ?></p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <span title="Thêm giỏ hàng" class="add-cart btn btn-success" data-id="<?php echo $product_item['product_id']; ?>">Thêm giỏ hàng</span>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php
                    echo $product_item['product_detail'];
                    ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($list_product_team as $item) {
                        ?>
                            <li>
                                <a href="chi-tiet-san-pham/<?php echo create_slug($item['cat_name']); ?>-<?php echo $item['product_id']; ?>.html" title="" class="thumb">
                                    <img src="<?php echo "admin/" . $item['product_thumb']; ?>">
                                </a>
                                <a href="chi-tiet-san-pham/<?php echo create_slug($item['cat_name']); ?>-<?php echo $item['product_id']; ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                    <span class="old"><?php echo currency_format($item['discount']); ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left" data-id="<?php echo $item['product_id']; ?>">Thêm giỏ hàng</a>
                                    <a href="?mod=cart&controller=index&action=buyNow&id=<?php echo $item['product_id']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        get_sidebar();
        ?>
    </div>
</div>
<?php
get_footer();
?>