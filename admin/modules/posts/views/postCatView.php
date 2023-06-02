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
                    <a href="?mod=posts&controller=index&action=addPostCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section pb-3">
                <select name="" id="select_cat_post" class="p-1">
                    <option value="0">Tất cả</option>
                    <option value="1">Chờ duyệt</option>
                    <option value="2">Hoạt động</option>
                    <option value="3">Ẩn danh mục</option>
                </select>
                <input type="submit" name="btn" value="Chọn" class="border-light" id="btn_update_cat_post">
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <?php 
                        if(!empty($list_post_cat)){
                        ?>
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
                                foreach($list_post_cat as $item){
                                    $count++;
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="check_post_cat_item" data-id=<?php echo $item['cat_id']; ?>></td>
                                    <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo str_repeat(" -- ", $item['level']).$item['cat_name']; ?></a>
                                        </div> 
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=posts&controller=index&action=update_cat_post&id=<?php echo $item['cat_id'];?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=posts&controller=index&action=delete_cat_post&id=<?php echo $item['cat_id'];?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['level'];?></span></td>
                                    <td><span class="tbody-text"><?php echo render_cat_product($item['status']);?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['author'];?></span></td>
                                    <td><span class="tbody-text"><?php echo date("d/m/Y", $item['time']);?></span></td>
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
                            echo "<p>Chưa có danh mục sản phẩm nào tồn tại</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>