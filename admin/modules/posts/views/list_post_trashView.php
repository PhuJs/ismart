<?php
get_header();
$id = isset($_GET['id']) ? $_GET['id'] : 1;
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thùng rác</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count"><?php echo "(" . count($list_post) . ")"; ?></span></a> </li>
                        </ul>
                    </div>
                    <div class="actions">
                    </div>
                    <?php
                    if (!empty($list_post)) {
                    ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Tác vụ</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_post as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=posts&controller=index&action=infor_post&id=<?php echo $item['post_id']; ?>&map=<?php echo $id; ?>&act=1" title=""><?php echo substr($item['post_title'], 0, 80) . "..." ?></a>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['cat_name']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['author']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date("d/m/Y", $item['time']); ?></span></td>
                                            <td><span class="tbody-text"><a href="?mod=posts&controller=index&action=deletePost&id=<?php echo $item['post_id']; ?>">Xóa</a> | <a href="?mod=posts&controller=index&action=xet_duyet_post&id=<?php echo $item['post_id']; ?>">Xét duyệt</a></span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <div class="section" id="paging-wp">
                            <div class="section-detail clearfix">
                                <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "Không có bài viết tồn tại";
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <a href="?mod=posts&controller=index&action=listPost" class="btn btn-primary fl-right">Trở lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>