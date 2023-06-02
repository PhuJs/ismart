<?php
get_header();
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="?mod=products&controller=index&action=addCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                <ul class="d-flex align-items-center mb-2">
                    <li class="pr-1"><a href="">Tất cả <span class="count"><?php echo "(".count($list_cat).")"; ?></span></a> |</li>
                    <li class="pl-1"><a href="?mod=products&controller=index&action=trash_cat_product">Thùng rác<span class="count"><?php echo "({$cat_trash})"; ?></span></a></li>
                </ul>
            </div>
            <div class="section pb-3">
                <select name="" id="select_status_cat" class="p-1">
                    <option value="0">Tất cả</option>
                    <option value="1">Chờ duyệt</option>
                    <option value="2">Hoạt động</option>
                    <option value="3">Ẩn danh mục</option>
                </select>
                <input type="submit" name="btn" value="Chọn" class="border-light" id="btn_update_status_cat">
            </div>
            <?php
            if (!empty($list_cat)) {
            ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Thứ tự</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_cat as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItemCat" data-id="<?php echo $item['cat_id']; ?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo str_repeat("---", $item['level']) . $item['cat_name']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=products&controller=index&action=updateCat&id=<?php echo $item['cat_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=products&controller=index&action=out_of_trash_cat&id=<?php echo $item['cat_id'];?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['level']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo render_cat_product($item['status_cat']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['user_create']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date("d/m/Y", $item['time']); ?></span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo "<p> Không có danh mục trong sản phẩm </p>";
            }
            ?>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p>
                    <!-- <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>