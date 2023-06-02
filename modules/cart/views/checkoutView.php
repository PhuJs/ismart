<?php
get_header();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="" name="form-checkout">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <?php echo form_error('add_order'); ?>
                <div class="section-detail">
                    <div class="row align-items-center">
                        <div class="col-6 form-group">
                            <label for="fullname" class="form-label h6">Họ tên</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo set_value('fullname'); ?>">
                            <?php echo form_error('fullname'); ?>
                        </div>
                        <div class="col-6 form-group">
                            <label for="email" class="form-label h6">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6 form-group">
                            <label for="phone" class="form-label h6">Số điện thoại</label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone'); ?>">
                            <?php echo form_error('phone'); ?>
                        </div>
                        <div class="col-6 form-group">
                            <label for="province" class="form-label h6">Chọn Tỉnh/Thành Phố </label>
                            <select name="province" id="province" class="form-control">
                                <option value="0">--- Chọn ---</option>
                                <?php
                                foreach($list_province as $item){
                                 ?>
                                  <option value="<?php echo $item['province_id']; ?>"<?php if(!empty($province)){ if($province == $item['province_id']) echo "selected='selected'";} ?>><?php echo $item['name']; ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                            <?php echo form_error('province');?>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6 form-group">
                            <label for="district" class="form-label h6"> Chọn Quận/Huyện </label>
                            <select name="district" class="form-control" id="district">
                                <option value="0">--- Chọn ---</option>
                            </select>
                            <?php echo form_error('district');?>
                        </div>
                        <div class="col-6 form-group">
                            <label for="wards" class="form-label h6">Chọn Xã/Phường</label>
                            <select name="wards" id="wards" class="form-control">
                                <option value="0">--- Chọn ---</option>
                            </select>
                            <?php echo form_error('wards');?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="" class="form-label h6">Địa chỉ số nhà</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="notes" class="form-label h6">Ghi chú</label>
                            <textarea name="note" id="notes" class="form-control"><?php echo set_value('note'); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_product)) {
                    ?>
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_product as $item) {
                                ?>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $item['title']; ?><strong class="product-quantity">x <?php $item['qty']; ?></strong></td>
                                        <td class="product-total"><?php echo currency_format($item['sub_total']); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price"><?php echo currency_format($total); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    <?php
                    } else {
                        echo "<p class='text-danger h5'>Không có sản phẩm tồn tại trong giỏ hàng<p>";
                    }
                    ?>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="1">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="2" checked>
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <?php echo form_error('cart_null'); ?>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng" name="order-submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
?>