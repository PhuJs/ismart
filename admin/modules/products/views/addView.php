<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo form_error('add_product');?>
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php set_value('product_name');?>">
                        <?php echo form_error('product_name');?>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code">
                        <?php echo form_error('product_code');?>
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price">
                        <?php echo form_error('price');?>
                        <label for="price">Giá cũ sản phẩm</label>
                        <input type="text" name="discount" id="price">
                        <?php echo form_error('discount');?>
                        <label for="desc_short">Mô tả ngắn</label>
                        <textarea name="desc_short" id="desc"></textarea>
                        <?php echo form_error('desc_short'); ?>
                        <label for="desc">Chi tiết</label>
                        <textarea name="desc" id="desc" class="ckeditor"></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb"  onchange="chosseFile(this)">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="public/images/img-thumb.png" id="img-upload-thumb">
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            foreach ($list_cat as $item) {
                            ?>
                                <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('parent_id');?>
                        <label for="">Hình ảnh chi tiết sản phẩm</label>
                        <input type="file" name="file_detail[]" multiple><br><br>
                        <!-- <label>Trạng thái</label> -->
                        <!-- <select name="status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Đã đăng</option>
                        </select> -->
                        <input type="submit" name="btn-submit" id="btn_add_product" value="Thêm mới">
                    </form>
                </div>
                <a href="?mod=products&controller=index&acion=index" title="Quay lại danh sách sản phẩm" class="btn btn-link btn-danger text-white fl-right">Quay lại</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>