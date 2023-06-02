<?php
get_header();
$id = isset($_GET['id'])?$_GET['id']:1;
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $total_customer; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="key_search_customer" id="s">
                            <input type="submit" name="search_customer" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="select_group_customer">
                                <option value="0">Tất cả khách hàng</option>
                                <option value="1" title="Đã mua hàng trong 5 ngày gần nhất">Khách hàng mới</option>
                                <option value="2" title="Đã mua hàng trong 10 ngày trở lại đây và số lượng đơn hàng lớn hơn 1">Khách hàng tiềm năng</option>
                            </select>
                            <input type="submit" name="btn_select_customer" value="Chọn">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <?php 
                        if(!empty($list_customer)){
                        ?>
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Đơn hàng</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count = get_start_index($id, 10);
                                foreach($list_customer as $item){
                                    $count++;
                                ?>
                                <tr>
                                    <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                                    <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['fullname'];?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=sell&controller=index&action=updateCustomerGp&id=<?php echo $item['order_id'];?>&map=<?php echo $id;?>&pr=1" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <!-- <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li> -->
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['phone_number'];?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['email'];?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['address'];?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['total_num'];?></span></td>
                                    <td><span class="tbody-text"><?php echo date("d/m/Y", $item['order_date']);?></span></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                              
                            </tfoot>
                        </table>
                        <?php
                        }else{
                            echo "<p class='text-warning h5'> Không có khách hàng trong danh sách</p>";
                        } 
                        ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <!-- <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p> -->
                     <?php 
                     // Điều hướng
                     get_pagging($num_page, "?mod=sell&controller=index&action=customerList&id=", $id);
                     ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>