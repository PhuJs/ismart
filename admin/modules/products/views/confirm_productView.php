<?php
get_header();
$id = isset($_GET['id']) ? $_GET['id'] : 1;
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm chờ xét duyệt</h3>
                </div>
            </div>
            <?php
            if (!empty($list_product)) {
            ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <div class="post-status fl-left">
                                <p class="h6">Tất cả: <span class="h6 text-info"><?php echo count($list_product)?> sản phẩm</span></li>
                            </div>
                            <form method="GET" action="" class="form-s fl-right">
                                <input type="text" name="key" id="s">
                                <input type="submit" name="search" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="actions">
                            <select name="select_status_product" id="select_status_product">
                                <option value="0">Tất cả</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Duyệt đơn hàng</option>
                                <option value="3">Hết hàng</option>
                                <option value="4">Thùng rác</option>
                                <option value="5">Xóa</option>
                            </select>
                            <input type="submit" name="btn_status_product" value="Chọn" id="btn_status_product">
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã sản phẩm</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = get_start_index($id, 6);
                                    foreach ($list_product as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkProductItem" data-id=<?php echo $item['product_id']; ?>></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['product_code'] ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $item['product_thumb']; ?>" alt="" class="img-thumbnail">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=products&controller=index&action=info_product&id=<?php echo $item['product_id']; ?>&map=<?php echo $id; ?>&act=2" title=""><?php echo $item['product_name']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=products&controller=index&action=updatePd&id=<?php echo $item['product_id']; ?>&page=<?php echo $id; ?>&act=3" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=products&controller=index&action=addTrash&id=<?php echo $item['product_id']; ?>&page=<?php echo $id ?>&act=2" title="Cho vào thùng rác" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['product_price']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['cat_name']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo render_status_product($item['status_product']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['maker']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date("d/m/Y", $item['product_time']) ?></span></td>
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
                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p>
                    </div>
                </div>
            <?php
            } else {
                echo "<h2>Không có sản phẩm trong danh sách</h2>";
            }
            ?>
            <a href="?mod=products&controller=index&action=index" class="btn btn-warning text-white fl-right">Trở lại</a>
        </div>
    </div>
</div>
<?php
get_footer();
?>