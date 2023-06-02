<?php
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Thông báo</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <h2>Thêm bài viết thành công</h2>
                    <a href="?mod=posts&controller=index&action=addPost">Quay lại thêm mới</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>