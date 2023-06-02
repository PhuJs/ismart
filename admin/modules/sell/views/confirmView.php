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
                    <h3 id="index" class="fl-left">Đơn hàng chờ xác nhận</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="" class="h5">Tổng đơn hàng: <?php echo $total_order_confirm; ?></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="search_order" id="s">
                            <input type="submit" name="btn_search_order" value="Tìm kiếm">
                        </form>
                    </div>

                    <div class="actions">
                        <select name="actions" id="select_confirm">
                            <option value="0">Tác vụ</option>
                            <option value="1">Xác nhận</option>
                        </select>
                        <input type="button" name="tacvu" value="Áp dụng" id="btn_confirm">
                    </div>
                    <?php
                    if (!empty($list_order_confirm)) {
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
                                        <td><span class="thead-text">Xác nhận</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = get_start_index($id);
                                    foreach ($list_order_confirm as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="confirmItem" data-order-id="<?php echo $item['order_id']; ?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['code_orders']; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=sell&controller=index&action=inforCustomer&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>&pr=3" title=""><?php echo $item['fullname']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sell&controller=index&action=updateCustomer&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>&pr=2" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['num_order']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['total_money']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $item['order_date']) ?></span></td>
                                            <td><a href="?mod=sell&controller=index&action=orderDetail&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>&pr=3" title="" class="tbody-text">Chi tiết</a></td>
                                            <td><a href="?mod=sell&controller=index&action=confirmOrder&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>" title="" class="tbody-text">Xác nhận</a></td>
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
                    // Điều hướng phân trang
                    get_pagging($num_page, "?mod=sell&controller=index&action=orderConfirm&id=", $id);
                    ?>
                </div>
            </div>
            <a href="?mod=sell&controller=index&action=index" class="btn bg-light border border-success">Danh sách đơn hàng</a>
        </div>
    </div>
</div>
<?php
get_footer();
?>