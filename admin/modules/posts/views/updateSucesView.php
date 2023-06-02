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
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <h2>Cập nhật bài viết thành công</h2>
                    <a href="?mod=posts&controller=index&action=<?php echo $action; ?>&id=<?php echo $id; ?>">Xem danh sách bài viết</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>