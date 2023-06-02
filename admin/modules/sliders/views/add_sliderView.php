<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên slider</label>
                        <input type="text" name="title" id="title" value="<?php if(isset($slider)){ echo $slider['title'];} ?>">
                        <?php echo form_error('title'); ?>
                        <label for="title">Link</label>
                        <input type="text" name="slug" id="slug" value="<?php if(isset($slider)) echo $slider['link']; ?>">
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php if(isset($slider)) echo $slider['description']; ?></textarea>
                        <label for="title">Thứ tự</label>
                        <input type="number" name="num" id="num-order" min="0" max="100" value="<?php  if(isset($slider)) echo $slider['num']; ?>">
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="chosseFile(this)">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img style="width:500px; height:230px;" src="public/images/img-thumb.png" id="img-upload-thumb">
                        </div>
                        <?php echo form_error('file_error'); ?>
                        <label>Trạng thái</label>
                        <?php
                        if (isset($slider)) {
                        ?>
                            <select name="status">
                                <option value="0">-- Chọn trạng thái --</option>
                                <option value="1" <?php if($slider['status'] == 1) echo "selected='selected'";?>>Chờ duyệt</option>
                                <option value="2" <?php if($slider['status'] == 2) echo "selected='selected'";?>>Công khai</option>
                            </select>
                        <?php
                        } else {
                        ?>
                            <select name="status">
                                <option value="0">-- Chọn trạng thái --</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Công khai</option>
                            </select>
                        <?php
                        }
                        ?>
                        <?php echo form_error('status'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>