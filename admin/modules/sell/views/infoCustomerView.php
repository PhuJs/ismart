<?php
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">   
            <h3 class="h4 mb-3">Thông tin khách hàng</h3>                    
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="fullName" class="form-label">Tên khách hàng</label>
                        <input type="text" class="form-control" name="fullname" id="display-name" value="<?php echo $customer['fullname']; ?>" readonly>
                    
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $customer['email']; ?>" readonly>
                       
                        <label for="tel" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" name="tel" id="tel" value="<?php echo $customer['phone_number']; ?>" readonly>
                        
                        <label for="address" class="form-label">Địa chỉ</label>
                        <textarea name="address" class="form-control" id="address" readonly ><?php echo $customer['address']; ?></textarea>
                     
                        <label for="address" class="form-label">Thông tin ghi chú</label>
                        <textarea name="address" class="form-control" id="address" readonly ><?php echo $customer['note']; ?></textarea>

                       <a href="?mod=sell&controller=index&action=<?php echo $action; ?>&id=<?php echo $map;?>" class="btn bg-info text-white">Trở lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>