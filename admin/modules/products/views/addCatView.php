<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="cat_name">Tên danh mục</label>
                        <input type="text" name="cat_name" id="product-name" value="<?php if (isset($item_cat)) echo $item_cat['cat_name']; ?>">
                        <?php echo form_error('cat_name'); ?>

                        <label>Thuộc danh mục</label>
                        <?php
                        if (isset($item_cat)) {
                        ?>
                            <select name="parent_id">
                                <option value="0">-- Chọn danh mục --</option>
                                <?php
                                foreach ($list_cat as $item) {
                                ?>
                                    <option value="<?php echo $item['cat_id']; ?>" <?php if ($item['cat_id'] == $item_cat['parent_id']) echo "selected = 'selected'"; ?>><?php echo $item['cat_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        } else {
                        ?>
                            <select name="parent_id">
                                <option value="0">-- Chọn danh mục --</option>
                                <?php
                                foreach ($list_cat as $item) {
                                ?>
                                    <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        }
                        ?>
                        <label>Trạng thái</label>
                        <?php
                        if (isset($item_cat)) {
                        ?>
                            <select name="status">
                                <option value="1" <?php if($item_cat['status_cat'] == 1) echo "selected = 'selected'"; ?>>Chờ duyệt</option>
                                <option value="2" <?php if($item_cat['status_cat'] == 2) echo "selected = 'selected'"; ?>>Hoạt động</option>
                                <option value="3" <?php if($item_cat['status_cat'] == 3) echo "selected = 'selected'"; ?>>Ẩn danh mục</option>
                            </select>
                        <?php
                        } else {
                        ?>
                            <select name="status">
                                <option value="1" selected='selected'>Chờ duyệt</option>
                                <option value="2">Hoạt động</option>
                                <option value="3">Ẩn danh mục</option>
                            </select>
                        <?php
                        }
                        ?>
                        <input type="submit" name="btn_add_cat" id="btn_add_product" value="Thêm mới">
                        <?php echo form_error('no') ?>
                        <?php echo form_success('yes'); ?>
                    </form>
                </div>
                <div class="text-center mt-5">
                    <a href="?mod=products&controller=index&action=listCat" class="btn btn-primary">Trở lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>