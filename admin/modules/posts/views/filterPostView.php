<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=posts&controller=index&action=addPost" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <?php 
                if(!empty($list_posts)){
                ?>
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $num_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(0)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(0)</span> |</a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li>
                        </ul>

                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="cat_post">
                                <option value="0">Tất cả</option>
                                <?php
                                foreach($list_post_cat as $item){
                                ?>
                                <option value="<?php echo $item['cat_id'] ?>"><?php echo $item['cat_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="submit" name="btn_cat_post" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <!-- <td><span class="thead-text">Trạng thái</span></td> -->
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($list_posts as $item){
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $item['post_id'];?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['post_title'];?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=posts&controller=index&action=updatePost&id=<?php echo $item['post_id'];?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=posts&controller=index&action=deletePost&id=<?php echo $item['post_id'];?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $item['cat_name'];?></span></td>
                                    <!-- <td><span class="tbody-text">Hoạt động</span></td> -->
                                    <td><span class="tbody-text"><?php echo $item['author'];?></span></td>
                                    <td><span class="tbody-text"><?php echo date('d/m/Y', $item['time']);?></span></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <!-- <td><span class="tfoot-text">Trạng thái</span></td> -->
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <?php
                }else{
                    echo "Không có bài viết tồn tại";
                }
                ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                  <?php 
                  $id = isset($_GET['id'])?$_GET['id']:1;
                  get_pagging($num_page, "?mod=posts&controller=index&action=filterPost&cat={$cat}&id=", $id);
                  ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>