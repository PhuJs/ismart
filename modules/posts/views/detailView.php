<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chi tiết bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $post['post_title']; ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo date("d/m/Y", $post['time']); ?></span>
                    <div class="detail">
                        <p><strong><?php echo $post['post_description'];?></strong></p>
                        <?php echo $post['post_content']; ?>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    <a href="danh-sach/tong-hop-bai-viet" class="btn btn-primary fl-right">Trở lại danh sách</a>
                </div>
            </div>
        </div>
        <?php
        get_sidebar('post');
         ?>
    </div>
</div>
<?php
get_footer();
?>