<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <?php
                if(!empty($list_cart_product)){ 
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($list_cart_product as $item){
                        ?>
                        <tr>
                            <td><?php echo $item['code'];?></td>
                            <td>
                                <a href="<?php echo friendly_url("chi-tiet-san-pham", $item['cat_name'], $item['id'])?>" title="" class="thumb">
                                    <img src="<?php echo "admin/".$item['thumb'];?>" alt="" class="img-thumbnail">
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo friendly_url("chi-tiet-san-pham", $item['cat_name'], $item['id'])?>" title="" class="name-product"><?php echo $item['title']; ?></a>
                            </td>
                            <td><?php echo currency_format($item['price']); ?></td>
                            <td>
                                <input type="number" name="num-order" min="0" max="100" value="<?php echo $item['qty']; ?>" class="num-order" data-id="<?php echo $item['id'];?>">
                            </td>
                            <td class="sub-total-<?php echo $item['id'];?>"><?php echo currency_format($item['sub_total']); ?></td>
                            <td>
                                <!-- Không cần tạo URL thân thiện, xóa cái quay lại rồi xóa chi -->
                                <a href="?mod=cart&controller=index&action=delete&id=<?php echo $item['id']; ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format(get_total_cart()); ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <!-- <a href="?mod=cart&controller=index&action=index" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                        <a href="thanh-toan-don-hang/thanh-toan-san-pham-gio-hang" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php
                }else{
                    echo "<div class='jumbotron' style='height:300px;'><div class='alert bg-light'> <p class='text-info h5 text-center'> Không có sản phẩm tồn tại trong giỏ hàng </p></div></div>";
                }
                ?>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <!-- <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p> -->
                <a href="?" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=cart&controller=index&action=deleteAll" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>