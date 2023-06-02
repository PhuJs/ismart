<?php
get_header();
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Tìm kiếm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Kết quả tìm kiếm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Tất cả <?php echo count($list_product); ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <?php
                                if(isset($_POST['select'])){
                                    $select = $_POST['select'];
                                } 
                                ?>
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1" <?php if(!empty($select)){if($select == 1) echo "selected='selected'";}?>>Từ A-Z</option>
                                    <option value="2" <?php if(!empty($select)){if($select == 2) echo "selected='selected'";}?>>Từ Z-A</option>
                                    <option value="3" <?php if(!empty($select)){if($select == 3) echo "selected='selected'";}?>>Giá cao xuống thấp</option>
                                    <option value="4" <?php if(!empty($select)){if($select == 4) echo "selected='selected'";}?>>Giá thấp lên cao</option>
                                </select>
                                <input type="submit" name="btn_filter" value="Lọc" id="btn_submit_filter">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php 
                    if(!empty($list_product)){
                    ?>
                    <ul class="list-item clearfix">
                        <?php
                        foreach($list_product as $item){
                        ?>
                        <li>
                            <a href="chi-tiet-san-pham/<?php echo create_slug($item['cat_name']);?>-<?php echo $item['product_id'];?>.html" title="" class="thumb">
                                <img src="<?php echo "admin/".$item['product_thumb']; ?>">
                            </a>
                            <a href="chi-tiet-san-pham/<?php echo create_slug($item['cat_name']);?>-<?php echo $item['product_id'];?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                <span class="old"><?php echo currency_format($item['discount']);?></span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left" data-id="<?php echo $item['product_id']; ?>" >Thêm giỏ hàng</a>
                                <a href="?mod=cart&controller=index&action=buyNow&id=<?php echo $item['product_id'];?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <?php
                    }else{
                        echo "<p> Không có sản phẩm trong danh mục </p>";
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <!-- <?php
                    //$id = isset($_GET['id'])?$_GET['id']:1;
                    //create_nav_bar($num_page, $url, $id);
                    ?> -->
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