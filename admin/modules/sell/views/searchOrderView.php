<?php
get_header();
$id = isset($_GET['id']) ? $_GET['id'] : 1;
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section " id="sales-report">
                <div class="row">
                    <div class="col-6 col-md-3 mb-3">
                        <div class="bg-success">
                            <h2 class="m-0 text-center text-white h5 py-3 border-bottom border-white">Đơn hàng thành công</h2>
                            <p class="text-center h3 text-white py-5 m-0"><?php echo $order_success; ?></p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="bg-warning">
                            <h2 class="m-0 text-center text-white h5 py-3 border-bottom border-white">Đang xử lí</h2>
                            <p class="text-center h3 text-white py-5 m-0"><?php echo $order_processing; ?></p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-info">
                            <h2 class="m-0 text-center text-white h5 py-3 border-bottom border-white">Doanh số</h2>
                            <p class="text-center h3 text-white py-5 m-0"><?php echo currency_format($sales); ?></p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light">
                            <h2 class="m-0 text-center text-dark h5 py-3  border-bottom border-dark">Hủy đơn hàng</h2>
                            <p class="text-center h3 py-5 m-0"><?php echo $order_failure ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tổng đơn hàng<span class="count">(<?php echo $total_order; ?>)</span></a> |</li>
                            <!-- <li class="publish"><a href=""><span class="count">(51)</span></a> |</li> -->
                            <li class="pending"><a href="?mod=sell&controller=index&action=orderConfirm">Chờ xác nhận<span class="count">(<?php echo $orders_confirmation; ?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=sell&controller=index&action=trash">Thùng rác<span class="count">(<?php echo $orders_trash; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="search_order" id="s">
                            <input type="submit" name="btn_search_order" value="Tìm kiếm">
                        </form>
                    </div>

                    <div class="actions">
                        <!-- <form method="POST" action="" class="form-actions"> -->
                            <select name="actions" id="select_status">
                                <option value="0">Tác vụ</option>
                                <?php 
                                foreach($list_status as $item){
                                ?>
                                <option value="<?php echo $item['status_id']; ?>"><?php echo $item['status_name'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="button" name="tacvu" value="Áp dụng" id="btn_apdung">
                        <!-- </form> -->
                    </div>
                    <?php
                    if (!empty($list_order)) {
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
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = get_start_index($id, 10);
                                    foreach ($list_order as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem" data-order-id="<?php echo $item['order_id'];?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['code_orders']; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=sell&controller=index&action=inforCustomer&id=<?php echo $item['order_id'];?>&map=<?php echo $id; ?>&pr=4&key=<?php echo $key; ?>" title=""><?php echo $item['fullname']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sell&controller=index&action=updateCustomer&id=<?php echo $item['order_id'];?>&map=<?php echo $id;?>&pr=3&key=<?php echo $key;?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=sell&controller=index&action=thrownTrash&id=<?php echo $item['order_id']?>&map=<?php echo $id;?>&ac=2&key=<?php echo $key; ?>" title="Đưa vào thùng rác" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['num_order']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['total_money']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['status_tag']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $item['order_date']) ?></span></td>
                                            <td><a href="?mod=sell&controller=index&action=orderDetail&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>&pr=4&key=<?php echo $key; ?>" title="" class="tbody-text">Chi tiết</a></td>
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
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả <br><br>
                        <a href="?mod=sell&controller=index&action=index" class="btn btn-link btn-primary text-white">Thoát tìm kiếm</a>
                    </p>
                    <?php
                    // Điều hướng phân trang
                    get_pagging($num_page, "?mod=sell&controller=index&action=searchOrder&key={$key}&id=", $id);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>