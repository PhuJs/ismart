<?php
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">   
            <h3 class="h4 mb-3">Cập nhật thông tin khách hàng</h3>                    
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="fullName">Tên hiển thị</label>
                        <input type="text" name="fullname" id="display-name" value="<?php echo $customer['fullname']; ?>">
                        <?php echo form_error('fullname');?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $customer['email']; ?>">
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo $customer['phone_number']; ?>">
                        <?php echo form_error('tel');?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $customer['address']; ?></textarea>
                        <?php echo form_error('address');?>
                        <input type="submit" name="btn_update_customer" id="" value="Cập nhật" class="btn bg-info text-white">
                    </form>
                </div>
            </div>
            <a href="?mod=sell&controller=index&action=<?php echo $action; ?>&id=<?php echo $map; ?>" class="btn btn-success btn-link text-white fl-right">Trở lại</a>
        </div>
    </div>
</div>
<?php
get_footer();
?>