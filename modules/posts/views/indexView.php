<?php
get_header();
$id = isset($_GET['id'])?$_GET['id']:1;
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <?php
                    if (!empty($list_post)) {
                    ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_post as $item) {
                            ?>
                                <li class="clearfix">
                                    <a href="bai-viet/<?php echo create_slug($item['slug_url']) ?>-<?php echo $item['post_id']?>" title="" class="thumb fl-left">
                                        <img src="<?php echo "admin/".$item['post_thumb']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="bai-viet/<?php echo create_slug($item['slug_url']) ?>-<?php echo $item['post_id']?>" title="" class="title"><?php echo $item['post_title']; ?></a>
                                        <span class="create-date"><?php echo date("d/m/Y", $item['time']); ?></span>
                                        <p class="desc"><?php echo $item['post_description']; ?></p>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    } else {
                        echo "<p> Không có bài viết tồn tại";
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                   <?php
                   echo create_nav_bar($num_page, "danh-sach/tong-hop-bai-viet-", $id); 
                   ?>
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