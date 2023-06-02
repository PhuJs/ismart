<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix pb-4 pt-2">
                    <h3 class="fl-left h3 pb-2 border-bottom">Thông tin sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="row">
                    <div class="col-4">
                        <div class="mt-2">
                            <img src="<?php echo $product['product_thumb']; ?>" alt="" class="img-fluid img-thumbnail">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="pl-3">
                            <div class="form-group ">
                                <p class="h5">Tên sản phẩm</p>
                                <span class="text-info"><?php echo $product['product_name']; ?></span>
                            </div>

                            <div class="form-group">
                                <p class="h5">Mã sản phẩm</p>
                                <span class="text-info"><?php echo $product['product_code']; ?></span>
                            </div>

                            <div class="form-group">
                                <p class="h5">Giá sản phẩm</p>
                                <span class="text-info"><?php echo currency_format($product['product_price']); ?></span>
                            </div>

                            <div class="form-group">
                                <p class="h5">Giá cũ</p>
                                <span class="text-info"><?php echo currency_format($product['discount']); ?></span>
                            </div>

                            <div class="form-group">
                                <p class="h5">Mô tả ngắn</p>
                                <span class="text-info"><?php echo $product['product_description']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="h4 border-bottom pt-3 pb-2 mb-3">Chi tiết sản phẩm</p>
                        <?php echo $product['product_detail']; ?>
                    </div>
                </div>
                <a href="?mod=products&controller=index&action=<?php echo $action; ?>&id=<?php echo $map; ?>" title="Quay lại danh sách sản phẩm" class="btn btn-link btn-danger text-white fl-right mt-3">Quay lại</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>