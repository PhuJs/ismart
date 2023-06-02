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
                    <h3 id="index" class="fl-left">Thùng rác</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tổng đơn hàng <span class="count">(<?php echo $num_order_trash;?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="search_order" id="s">
                            <input type="submit" name="btn_search_order" value="Tìm kiếm">
                        </form>
                    </div>

                    <div class="actions">
                            <select name="actions" id="select_delete_order">
                                <option value="0">Tác vụ</option>
                                <option value="1">Xóa tất cả</option>
                            </select>
                            <input type="button" name="tacvu" value="Áp dụng" id="btn_delete_order">
                    </div>
                    <?php
                    if (!empty($list_order_trash)) {
                    ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã đơn hàng</span></td>
                                        <td><span class="thead-text">Tên khách hàng</span></td>
                                        <td><span class="thead-text">Số sản phẩm</span></td>
                                        <td><span class="thead-text">Tổng giá</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = get_start_index($id, 10);
                                    foreach ($list_order_trash as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="orderItem" data-order-id="<?php echo $item['order_id']?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['code_orders']; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=sell&controller=index&action=inforCustomer&id=<?php echo $item['order_id'];?>&map=<?php echo $id; ?>&pr=2" title=""><?php echo $item['fullname']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sell&controller=index&action=delete&id=<?php echo $item['order_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['num_order']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['total_money']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $item['order_date']) ?></span></td>
                                            <td><a href="?mod=sell&controller=index&action=orderDetail&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>&pr=2" title="" class="tbody-text">Chi tiết</a></td>
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
                        echo "<p class='h3 text-danger'>Không có sản phẩm trong giỏ hàng</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php
                    get_pagging($num_page, "?mod=sell&controller=index&action=trash&id=", $id);
                    ?>
                </div>
            </div>
            <a href="?mod=sell&controller=index&action=index" class="btn bg-warning text-white">Danh sách đơn hàng</a>
        </div>
    </div>
</div>
<?php
get_footer();
?>