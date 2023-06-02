<?php
get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php echo form_error('no');?>
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tiêu đề bài viết</label>
                        <textarea name="title" id="product-name"><?php echo $post['post_title']; ?></textarea>
                        <?php echo form_error('title');?>
                        <label for="title" title="Tạo một đường link thân thiện cho người dùng dễ xem">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $post['slug_url'];?>">
                        <?php echo form_error('slug');?>
                        <label for="desc_short">Mô tả bài viết</label>
                        <textarea name="desc" id="desc"><?php echo $post['post_description']; ?></textarea>

                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="content" id="desc" class="ckeditor"><?php echo $post['post_content']; ?></textarea>
                        <?php echo form_error('content');?>
                        <label>Hình ảnh bài viết</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="chosseFile(this);">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="public/images/img-thumb.png" id="img-upload-thumb">
                        </div>
                        <?php echo form_error('file_error');?>
                        <label>Danh mục bài viết</label>
                        <select name="parent_cat">
                            <option value="0">-- Chọn danh mục --</option>
                            <?php
                            foreach($list_cat as $item){
                            ?>
                            <option value="<?php echo $item['cat_id'] ?>" <?php if($item['cat_id'] == $post['cat_id']) echo "selected = 'selected'" ?>><?php echo $item['cat_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('parent_cat');?>
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="1" <?php if($post['status_post'] == 1) echo "selected='selected'"; ?> >Chờ duyệt</option>
                            <option value="2" <?php if($post['status_post'] == 2) echo "selected='selected'"; ?> >Đã đăng</option>
                            <option value="2" <?php if($post['status_post'] == 3) echo "selected='selected'"; ?> >Cho vào thùng rác</option>
                        </select> 
                        <input type="submit" name="btn-submit" id="btn_add_product" value="Cập nhật">
                    </form>
                </div>
                <a href="?mod=posts&controller=index&action=<?php echo $action; ?>&id=<?php echo $map; ?>" class="btn btn-primary fl-right">Trở lại danh sách</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>