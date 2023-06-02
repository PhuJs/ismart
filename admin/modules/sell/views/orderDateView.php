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
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tổng đơn hàng<span class="count"></span></a> </li>
                            <!-- <li class="publish"><a href=""><span class="count">(51)</span></a> |</li> -->
                            <li class="pending"><a href="?mod=sell&controller=index&action=orderConfirm">Chờ xác nhận<span class="count"></span></a></li>
                            <li class="pending"><a href="?mod=sell&controller=index&action=trash">Thùng rác<span class="count"></span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>

                    <div class="actions">
                            <select name="actions" id="select_status">
                                <option value=""></option>  
                            </select>
                            <input type="button" name="tacvu" value="Áp dụng" id="btn_apdung">
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
                                        <!-- <td><span class="thead-text">Trạng thái</span></td> -->
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = get_start_index($id);
                                    foreach ($list_order as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem" data-order-id="<?php echo $item['order_id'];?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['code_orders']; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=sell&controller=index&action=inforCustomer&id=<?php echo $item['order_id'];?>&map=<?php echo $id; ?>&pr=1" title=""><?php echo $item['fullname']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=sell&controller=index&action=updateCustomer&id=<?php echo $item['order_id'];?>&map=<?php echo $id;?>&pr=1" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=sell&controller=index&action=thrownTrash&id=<?php echo $item['order_id']?>&map=<?php echo $id; ?>" title="Đưa vào thùng rác" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['num_order']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['total_money']); ?></span></td>
                                            <!-- <td><span class="tbody-text"><?php echo $item['status_tag']; ?></span></td> -->
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', $item['order_date']) ?></span></td>
                                            <td><a href="?mod=sell&controller=index&action=orderDetail&id=<?php echo $item['order_id']; ?>&map=<?php echo $id; ?>&pr=1" title="" class="tbody-text">Chi tiết</a></td>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>