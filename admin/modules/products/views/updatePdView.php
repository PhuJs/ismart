<?php 
 $status_product = array(
        1 => array(
            'id' => 1,
            'status_name' => 'Chờ duyệt',
        ),
         2 => array(
            'id' => 2,
            'status_name' => 'Đã duyệt',
         ),
         3 => array(
            'id' => 3, 
            'status_name' => 'Hết hàng',
         ),
         4 => array(
            'id' => 4,
            'status_name' => 'Thùng rác'
         ),
        );
?>
<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật thông tin sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo form_error('add_product'); ?>
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo $product['product_name']; ?>">
                        <?php echo form_error('product_name');?>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?php echo $product['product_code']; ?>">
                        <?php echo form_error('product_code');?>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo $product['product_price'] ?>">
                        <?php echo form_error('product_price');?>
                        <label for="discount">Giá cũ sản phẩm</label>
                        <input type="text" name="discount" id="price" value="<?php echo $product['discount'] ?>">
                        <label for="desc_short">Mô tả ngắn</label>
                        <textarea name="desc_short" id="desc"> <?php echo $product['product_description']; ?></textarea>
                        <?php echo form_error('desc_short');?>
                        <label for="desc">Chi tiết</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $product['product_detail']; ?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" onchange="chosseFile(this)">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="public/images/img-thumb.png" id="img-upload-thumb">
                        </div>
                        <label for="">Hình ảnh chi tiết sản phẩm</label>
                        <input type="file" name="files[]" multiple><br><br>
                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            foreach ($list_cat as $item) {
                            ?>
                                <option value="<?php echo $item['cat_id']; ?>" <?php if ($product['cat_id'] == $item['cat_id']) echo "selected='selected'" ?>><?php echo $item['cat_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('parent_id');?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">--Chọn--</option>
                            <?php 
                            foreach($status_product as $item){
                            ?>
                              <option value="<?php echo $item['id'] ?>" <?php if($item['id'] == $product['status_product']) echo "selected='selected'"?>><?php echo $item['status_name']; ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        <?php echo form_error('status');?>
                        <input type="submit" name="btn_update" id="btn_add_product" value="Cập nhật">
                    </form>
                </div>
                <a href="?mod=products&controller=index&action=<?php echo $action; ?>&id=<?php echo $page; ?>" class="btn btn-link btn-primary text-white fl-right">Trở lại</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>