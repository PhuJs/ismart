<?php
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <!-- <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a> -->
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <h3 id="index" class="">Cập nhật tài khoản</h3>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="fullName">Tên hiển thị</label>
                        <input type="text" name="fullName" id="display-name" value="<?php echo $info_user['fullname']; ?>">
                        <?php echo form_error('fullName'); ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $info_user['email']; ?>">
                        <?php echo form_error('email'); ?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo $info_user['phone_number']; ?>">
                        <?php echo form_error('tel'); ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $info_user['address']; ?></textarea>
                        <?php echo form_error('address'); ?>
                        <input type="submit" name="btn_update_admin" id="btn_update_admin" value="Cập nhật">
                        <?php echo form_error('check_email'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>