<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="?mod=sliders&controller=index&action=add_slider" title="" id="add-new" class="fl-left bg-primary">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=sliders&controller=index&action=index">Tất cả <span class="count"> <?php echo "(".count($list_slider).")"; ?></span></a> |</li>
                            <li class="pending"><a href="?mod=sliders&controller=index&action=list_slider_trash">Thùng rác<span class="count"> <?php echo "(".count($slider_trash).")"; ?></span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <select name="actions" id="select_status_slider">
                            <option value="0">Tác vụ</option>
                            <option value="1">Chờ duyệt</option>
                            <option value="2">Công khai</option>
                            <option value="3">Thùng rác</option>
                        </select>
                        <input type="submit" name="" value="Áp dụng" id="btn_status_slider">
                    </div>
                    <?php
                    if (!empty($list_slider)) {
                    ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Link</span></td>
                                        <td><span class="thead-text">Thứ tự</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($list_slider as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="check_item_slider" data-id="<?php echo $item['id']; ?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $item['image']; ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['link']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sliders&controller=index&action=update_slider&id=<?php echo $item['id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=sliders&controller=index&action=add_trash_slider&id=<?php echo $item['id']; ?>" title="Cho vào thùng rác" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['num'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo render_stt_slider($item['status']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['user_created']; ?></span></td>
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
                    <?php
                    } else {
                        echo "<p>Không có slider tồn tại</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p>
                    <!-- <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title="">
                                << /a>
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