<?php 
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo set_value('title');?>">
                        <?php echo form_error('title'); ?>
                        <label for="title" title="Tạo một đường link thân thiện cho người dùng dễ xem">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug');?>">
                        <?php echo form_error('slug');?>
                        <label for="desc">Mô tả bài viết</label>
                        <textarea name="desc" id="desc"><?php echo set_value('desc'); ?></textarea>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="content" id="desc" class="ckeditor"><?php echo set_value('content'); ?></textarea>
                        <?php echo form_error('content');?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="chosseFile(this)">
                            <input type="button" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="public/images/img-thumb.png" id="img-upload-thumb">
                        </div>
                        <?php echo form_error('file_error');?>
                        <label>Danh mục cha</label>
                        <select name="parent-cat">
                            <option value="0">-- Chọn danh mục --</option>
                            <?php 
                            foreach($list_post_cat as $item){
                            ?>
                            <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('parent_cat');?>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
            <a href="?mod=posts&controllerr=index&action=listPost" class="btn btn-primary fl-right">Trở lại danh sách</a>
        </div>
    </div>
</div>
<?php
get_footer(); 
?>