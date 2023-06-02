<?php
// Thêm danh mục vào CSDL
function insert_cat_post($data){
    $result = db_insert("tbl_cat_posts", $data);
    return $result;
}

// Lấy danh sách danh mục bài viết
function get_list_post_cat(){
    $list_post_cat = db_fetch_array("SELECT * FROM `tbl_cat_posts` WHERE NOT `status` = '4'");
    return $list_post_cat;
}

// Lấy danh mục bài viết theo Id
function get_cat_post_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_cat_posts` WHERE `cat_id` = '{$id}'");
    return $result;
}

// Cập nhật danh mục bài viết theo Id
function update_cat_post_by_id($data, $id){
    $result = db_update("tbl_cat_posts", $data, "`cat_id` = '{$id}'");
    return $result;
}

// Đưa danh mục vào thùng rác
function add_cat_post_in_trash($id){
    $data = array(
        'status' => 4,
    );
    $result = db_update("tbl_cat_posts", $data, "`cat_id` = '{$id}'");
    return $result;
}

// Thêm bài viết vào CSDL
function insert_post($data){
    $result = db_insert("tbl_posts", $data);
    return $result;
}

// Lấy danh sách bài viết
function get_list_posts(){
    $result = db_fetch_array("SELECT *, `tbl_cat_posts`.`cat_name` FROM `tbl_posts` JOIN `tbl_cat_posts` ON `tbl_posts`.`cat_id` = `tbl_cat_posts`.`cat_id`");
    return $result;
}

// Cập nhật trạng thái bài viết theo Selected
function update_status_post_select($status, $str_id){
    $data = array(
        'status_post' => $status,
    );
    $result = db_update("tbl_posts", $data, "`post_id` IN ($str_id)");
    return $result;
}

// Lấy bài viết theo Id
function get_post_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = '{$id}'");
    return $result;
}

// Cập nhật bài viết
function update_post($data, $id){
    $result = db_update("tbl_posts", $data, "`post_id` = '{$id}'");
    return $result;
}

// Đưa vào viết có id đã cho vào thùng rác
function add_post_in_trash($id){
    $data = array(
        'status_post' => 3,
    );
    $result = db_update("tbl_posts", $data, "`post_id` = '{$id}'");
    return $result;
}

// Lấy số bản ghi của posts
function get_num_row_posts(){
    $result = db_num_rows("SELECT * FROM `tbl_posts` WHERE NOT `status_post` = '3'");
    return $result;
}

// Lấy bài viết theo phân trang
function get_list_post($start, $num_per_page){
    $result = db_fetch_array("SELECT *, `tbl_cat_posts`.`cat_name` FROM `tbl_posts` LEFT JOIN `tbl_cat_posts` ON `tbl_posts`.`cat_id` = `tbl_cat_posts`.`cat_id` WHERE NOT `tbl_posts`.`status_post` = '3' ORDER BY `tbl_posts`.`time` ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Lấy danh sách bài viết chờ xét duyệt
function get_list_post_confirm(){
    $result = db_fetch_array("SELECT *, `tbl_cat_posts`.`cat_name` FROM `tbl_posts` LEFT JOIN `tbl_cat_posts` ON `tbl_posts`.`cat_id` = `tbl_cat_posts`.`cat_id` WHERE `status_post` = '1'");
    return $result;
}

// Duyệt bài viết
function duyet_bai_viet($id){
    $data = array(
        'status_post' => 2,
    );
    $result = db_update("tbl_posts", $data, "`post_id` = '{$id}'");
    return $result;
}

// Đưa bài viết trở lại xét duyệt
function xet_duyet_bai_viet($id){
    $data = array(
        'status_post' => 1,
    );
    $result = db_update("tbl_posts", $data, "`post_id` = '{$id}'");
    return $result;
}

// Xóa bài viết theo Id
function delete_post_by_id($id){
    $result = db_delete("tbl_posts", "`post_id` = '{$id}'");
    return $result;
}

// Lấy tổng số bài viết chờ xác nhận
function get_total_post_confirm(){
    $result = db_num_rows("SELECT * FROM `tbl_posts` WHERE `status_post` = '1'");
    return $result;
}

// Lấy tổng số bài viết trong thùng rác
function get_total_post_trash(){
    $result = db_num_rows("SELECT * FROM `tbl_posts` WHERE `status_post` = '3'");
    return $result;
}

// Lấy danh sách bài viết trong thùng rác
function get_list_post_in_trash(){
    $result = db_fetch_array("SELECT *, `tbl_cat_posts`.`cat_name` FROM `tbl_posts` LEFT JOIN `tbl_cat_posts` ON `tbl_posts`.`cat_id` = `tbl_cat_posts`.`cat_id` WHERE `tbl_posts`.`status_post` = '3'");
    return $result;
}

// Tìm bài viết theo yêu cầu
function get_list_post_by_key($key){
    $result = db_fetch_array("SELECT *, `tbl_cat_posts`.`cat_name` FROM `tbl_posts` JOIN `tbl_cat_posts` ON `tbl_posts`.`cat_id` = `tbl_cat_posts`.`cat_id` WHERE  `tbl_posts`.`post_title` LIKE '%{$key}%' OR `tbl_posts`.`post_description` LIKE '%{$key}%' OR `tbl_posts`.`author` LIKE '%{$key}%' OR `tbl_posts`.`post_content` LIKE '%{$key}%' OR `tbl_cat_posts`.`cat_name` LIKE '%{$key}%' AND  (NOT `tbl_posts`.`status_post` = '3') ORDER BY `tbl_posts`.`time` ASC ");
    return $result;
}

// Lấy tổng số bản ghi được tìm kiếm
function get_total_row_search_post($value){
    $result = db_num_rows("SELECT * FROM `tbl_posts` WHERE `post_title` LIKE '%{$value}%'");
    return $result;
}

// Thay đổi trạng thái danh mục theo selected
function change_status_cat_post_select($status, $list_checked){
    $data = array(
        'status' => $status,
    );
    $result = db_update("tbl_cat_posts", $data, "`cat_id` IN ({$list_checked})");
    return $result;
}